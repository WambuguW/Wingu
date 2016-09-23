<?php

namespace App\Modules\Exams\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Exams\Helpers\ExamFunctions;
use App\Modules\Core\Models\Studentdetails;
use App\Modules\Core\Models\Examresults;
use App\Modules\Core\Models\Examtypes;
use App\Modules\Core\Models\Subjects;
use App\Modules\Core\Models\Classes;

class ResultsController extends Controller
{
    /**
     * Render the view for selecting the exam to view results
     * 
     * @return \Illuminate\View\View
     */
    public function viewresults()
    {
        $classes = Classes::all();
        $exams = Examtypes::all();
        return view('exams::exams.allresults', ['classes' => $classes, 'exams' => $exams]);
    }
    
    /**
     * Render the ranked class list for a given exam
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function viewclassresults(Request $request)
    {
        $class = $request->input('class');        $term = $request->input('term');        $year = $request->input('year');        $exam = $request->input('exam');
        $students_examined = 0;
        if(count(ExamFunctions::class_student_year($class, $year)) < 1){
            return $this->viewresults()->with('error', 'Please confirm that the class has registered students');
        }
        foreach(ExamFunctions::class_student_year($class, $year) as $student){
            //get the results for all students in that class
            $stdresults = Examresults::where('term', '=', $term)
                            ->where('class', '=', $class)
                            ->where('admno', '=', $student->admno)
                            ->where('exam', '=', $exam)
                            ->where('year', '=', $year)->get();
            $studenttotal = 0;
            if(count($stdresults) > 0){
                foreach($stdresults as $stdresult){
                    $students_examined += 1;
                    $subjectmarks = ExamFunctions::get_subject_marks($stdresult->admno, $term, $exam, $year, $stdresult->subjectid);
                    $studenttotal += $subjectmarks;//the total marks for this student
                }
                //add the student's total marks to array.
                $stdarray[] = array('admno' => $student->admno, 'marks' => $studenttotal);
                //$array = array($student->admno => $studenttotal);
                //$student_marks_array = array_add($array, $student->admno, $studenttotal);
            } else{
                $stdarray[] = array('admno' => $student->admno, 'marks' => $studenttotal);
            }
            
        }
        foreach ($stdarray as $key => $value) {
            $adm[$key] = $value['admno'];
            $marks[$key] = $value['marks'];
        }
        array_multisort($marks, SORT_DESC, $stdarray);
        //print_r($stdarray);
        $subjects = Subjects::all();
        return view('exams::exams.classresults', ['resultarray' => $stdarray, 'subjects' => $subjects, 
                                            'class' => $class, 'term' => $term, 'year' => $year, 'exam' => $exam]);
    }
    
    /**
     * Get the students of a given class
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function classstudents(Request $request)
    {
        $studentclass = intval($request->input('class_id'));
        $filterstudents = Studentdetails::where('currentclass', '=', $studentclass)->get();
        return response()->json($filterstudents);
    }
    
    /**
     * Render the view to help generate report card
     * 
     * @return \Illuminate\View\View
     */
    public function individualresults(){
        $students = Studentdetails::all();
        $exams = Examtypes::all();
        $classes = Classes::all();
        return view('exams::exams.individualresults', ['students' => $students, 'exams' => $exams, 'classes' => $classes]);
    }
    
    
    /**
     * Render a student's report card
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function show_individual_results(Request $request){
        if(request()->ajax()){
            return view('exams::exams.personalresults', ['admno' => $request->input('admno'),
                        'term' => $request->input('term'),
                        'year' => $request->input('year'),
                        'exam' => $request->input('exam'),
                        'theclass' => $request->input('classe')]);
        } else{
            return view('exams::exams.personalresults', ['admno' => $request->input('admno'),
                        'term' => $request->input('term'),
                        'year' => $request->input('year'),
                        'exam' => $request->input('exam'),
                        'theclass' => $request->input('class')]);
        }    
        
    }
}
