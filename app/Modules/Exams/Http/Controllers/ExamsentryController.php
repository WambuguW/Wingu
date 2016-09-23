<?php

namespace App\Modules\Exams\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Core\Models\Studentdetails;
use App\Modules\Core\Models\Examresults;
use App\Modules\Core\Models\Examtypes;
use App\Modules\Core\Models\Subjects;
use App\Modules\Core\Models\Classes;
use App\Modules\Exams\Helpers\ExamFunctions;
use App\Modules\Core\Helpers\UserAccounts;

class ExamsentryController extends Controller
{
    /**
     * Displays the marks entry view with the required variables
     * @return type
     */
    public function marksentry () 
    {
        //make the marks entry view with all the dynamically set elements eg classes, grades, subjects...
        $student = Studentdetails::all();
        $examtypes = Examtypes::all();
        $subjects = Subjects::all();
        $classes = Classes::all();
        return view('exams::exams.entry', ['stude' => $student, 'examtypes' => $examtypes, 'classes' => $classes, 'subjects' => $subjects]);
    }
    
    /**
     * Saves a single result record if it does not exist
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function saveresults(Request $request)
    {        
        $check = Examresults::where('admno', '=', $request->input('admno'))->where('exam', '=', $request->input('examtype'))
                            ->where('term', '=', $request->input('term'))->where('subjectid', '=', $request->input('subject'))
                            ->where('class', '=', $request->input('class'))->get();
        if (count($check) > 0){//to avoid duplicates.
            return $this->marksentry()->with('error', 'Sorry, details have already been captured!');
        } else{
            $exam = Examresults::create(['admno' => $request->input('admno'), 'class' => $request->input('class'),
                    'exam' => $request->input('exmtype'), 'term' => $request->input('term'), 'year' => $request->input('year'), 
                    'subjectid' => $request->input('subject'), 'marks' => $request->input('marks'), 'comments' => $request->input('comments')]);
            
            $action = "Added " . ExamFunctions::get_subject_name($request->input('subject')) . " results for Adm: " . $request->input('admno');
            UserAccounts::system_audit(auth()->user()->id, $action);
            return $this->marksentry()->with('success', 'Exam details saved!');
        }       
        
    }
    
    /**
     * Reads exam results from a csv or xls file and saves
     * the records if no similar records have been saved
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function file_upload_results(Request $request)
    {   
        $filename = $request->file('file')->getClientOriginalName();
        $mime = $request->file('file')->getClientOriginalExtension();
        if($mime != 'csv' || $mime != 'xls'){
            $error = "The file should be in CSV or XLS format. Found '" . $mime . "'. Please save the document as CSV(Comma delimited) or XLS(Excel Sheet)";
            return $this->marksentry()->with('error', $error);
        }
        //echo $filename;
        $handle = fopen($request->file('file'), "r");
        //skip first row
        fgets($handle);
        $count = 0;
        $err_count = 1;
        $dub_error = 0;//to store the number of duplicated records
        $error_array[] = "The following rows have problems and were not added. Please check them then try again.";
        while ($data = fgetcsv($handle, 1000, ",", "'")) {   
            //validate all records before saving
            if(!ExamFunctions::valid_student($data[2]) || !ExamFunctions::valid_class($data[1]) || !ExamFunctions::valid_exam($data[3]) || !ExamFunctions::valid_subject($data[6])){
                $row = $err_count + 1;
                $er = "Row number " . $row;
                $error_array[] = $er;
                $err_count++;
            } else{
                //check if results for the same admn, year, term and exam type have been entered
                $exists = Examresults::where('admno', '=', $data[2])->where('exam', '=', $data[3])
                                    ->where('term', '=', $data[4])->where('year', '=', $data[5])
                                    ->where('subjectid', '=', $data[6])->get();
                
                if(count($exists) > 0){//similar records found
                    $dub_error += 1;
                } else{
                    $exam = Examresults::create(['admno' => $data[2], 'class' => $data[1], 'exam' => $data[3], 'term' => $data[4], 'year' => $data[5], 'subjectid' => $data[6], 'marks' => $data[7], 'comments' => $data[8]]);
                    
                    $action = "Added " . ExamFunctions::get_subject_name($data[6]) . " results for Adm: " . $data[2];
                    UserAccounts::system_audit(auth()->user()->id, $action);
                    $count++;
                }                    
            }

        } 
        if($dub_error > 0){
            $error_array[] = $dub_error . " Duplicate record(s) found";
        }
        if(count($error_array) > 1){
            $success = "" . $count . " record(s) uploaded";
            return $this->marksentry()->with('success', $success)->with('error_array', $error_array);
        } else{
            $success = "Done. " . $count . " record(s) uploaded";
        return $this->marksentry()->with('success', $success);
        }
        
            
    }
    
}
