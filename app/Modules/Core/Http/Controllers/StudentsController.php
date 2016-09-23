<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Core\Models\Audit;
use App\Modules\Core\Models\Classes;
use App\Modules\Core\Models\Dormitories;
use App\Modules\Core\Models\Examresults;
use App\Modules\Core\Models\Streams;
use App\Modules\Core\Models\Studentclass;
use App\Modules\Core\Models\Studentdetails;
use App\Modules\Core\Models\Subjects;
use Illuminate\Support\Facades\Storage;
use App\Modules\Core\Helpers\UserAccounts;
use App\Modules\Core\Helpers\StudentsDetails;

class StudentsController extends Controller
{
    /**
     * Display the student registration view with the necessary variables
     * 
     * @return type
     */
    public function stdregister(){
        $classes = Classes::all();
        $streams = Streams::all();
        $regnom = Studentdetails::orderBy('admno', 'DESC')->first();
        $regno = $regnom->admno + 1;
        return view('core::students.registration', ['classes' => $classes, 'streams' => $streams, 'regno' => $regno]);
    }
    
    /**
     * Registers a new student if the supplied admission number does not exist
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
     public function register(Request $request){
        $found = Studentdetails::where('admno', '=', $request->input('admno'))->first();
        //ensure uniqueness of registration number.
        if(!empty($found)){
            return $this->stdregister()->with('error', 'Admission number already taken');
        }
        //upload image
        $img_name = $request->file('file')->getClientOriginalName();
        if(Storage::put($img_name, file_get_contents($request->file('file')))){//only save the student details if the photo is successfully uploaded
            
            $student = Studentdetails::firstOrCreate(['admno' => $request->input('admno'), 'fname' => $request->input('fname'),
                    'lname' => $request->input('lname'), 'surname' => $request->input('sname'), 'contact' => $request->input('phone'),
                    'address' => $request->input('address'), 'dob' => $request->input('dob'), 'sex' => $request->input('sex'), 'dormitory' => $request->input('dorm'),
                    'classofadm' => $request->input('class'), 'currentclass' => $request->input('currentclass'), 'year' => date('Y'),
                    'stream' => $request->input('stream'), 'admdate' => $request->input('regdate'), 'photo' => $img_name]);
            $success = 'Student details saved.';
            
            $stdclass = Studentclass::firstOrCreate(['admno' => $request->input('admno'), 'class' => $request->input('currentclass'), 'year' => date('Y')]);
            
            $action = "Registered new student Adm: " . $request->input('admno');
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            return $this->stdregister()->with('success', $success);
        } else{
            return $this->stdregister()->with('error', 'Photo upload failed. Please try again');
        }
        
    }
    
    public function getallstudents()
    {
        $students = StudentsDetails::allStudents();
        return view('core::students.details', ['students' => $students]);
    }
    
    /**
     * Deletes student whose admission number matches the one supplied if it exists
     * @param \Illuminate\Http\Request $request
     * @param type $admno
     * @return type
     */
    public function deletestudent(Request $request, $admno)
    {
        $found = Studentdetails::where('admno', '=', $admno)->first();
        if(count($found) < 1){
            return Redirect::to('core/students/details')->with('error', 'No student found with that admission number');
        }else{
        
            if(Studentdetails::where('admno', '=', $admno)->delete()){

                $action = "Deleted student Adm: " . Input::get('admno');
                UserAccounts::system_audit(auth()->user()->id, $action);

                return Redirect::to('core/students/details')->with('success', 'Student has been deleted.');
            } else{
                return Redirect::to('core/students/details')->with('error', 'Student could not be deleted.');
            }
        }
    }
    
    public function editstudent ($admno) 
    {
        $details = Studentdetails::where('admno', '=', $admno)->first();
        return view('core::students.edit', ['student' => $details]);
    }
    
    public function updatedetails(Request $request)
    {
        $student = Studentdetails::where('admno', '=', $request->input('admno'))
                                    ->update(array('fname' => $request->input('fname'),
                                        'lname' => $request->input('lname'),
                                        'dob' => $request->input('dob'),
                                        'surname' => $request->input('sname'),
                                        'contact' => $request->input('phone'),
                                        'address' => $request->input('address')
                                        ));
        $action = "Updated details for Adm: " . $request->input('admno');
        UserAccounts::system_audit(auth()->user()->id, $action);
        
        return $this->getallstudents()->with('success', 'Student details updated!');        
    }
    
    public function nextclass()
    {
        $classes = Classes::all();
        return view('core::students.nextclass', ['classes' => $classes]);
    }
    
    public function show_class_students(Request $request)
    {
        $students = Studentdetails::where('currentclass', '=', $request->input('classs'))->get();
        
        if(count($students) > 0){
            return response()->json($students);
        } else{
            return response()->json('0');
        }
    }
    
    public function selected_to_next_class(Request $request)
    {
        $selected = $request->input('std_group');
        if(count($selected) < 1){
            return $this->nextclass()->with('error', 'You must select some students to graduate!');
        }
        $count = 0;
        $curr_class = $request->input('currclass');
        $new_class = $curr_class + 1;
        $year = Studentdetails::where('currentclass', '=', $curr_class)->first();
        //dd($year->year);
        $newyear = date('Y') + 1; //$year->year + 1;
        $error_arr[] = "";
        foreach($request->input('std_group') as $std){
            
            $upd = Studentdetails::where('currentclass', '=', $curr_class)->update(array('currentclass' => $new_class, 'year' => $newyear));
            
            $push = Studentclass::firstOrCreate(['admno' => $std, 'class' => $new_class, 'year' => $newyear]);
            
            $count++;
            
            $action = "Moved student Adm no.: " . $std . " from class " . $curr_class . " to class " . $new_class;
            UserAccounts::system_audit(auth()->user()->id, $action);          
        }
        $graduated = "Done. " . $count . " student(s) graduated to class " . $new_class;
        if(count($error_arr) > 1){
            return $this->nextclass()->with('success', $graduated)->with('error_array', $error_arr);
        } else{
            return $this->nextclass()->with('success', $graduated);
        }
    }
    
    public function alltonext(Request $request)
    {
        if(request()->ajax()){
            $success = 'Done!';
            $former = $request->input('former');
            $year = Studentdetails::where('currentclass', '=', $former)->pluck('year');
            
            if(empty($former)){
                $error = "You must select a class!";
                return response()->json($error);
            } else{
                $newclass = $former + 1;
                $newyear = $year + 1;
                $students = Studentdetails::where('currentclass', '=', $former)->get();
                //if new class is greater than the available classes, then students has finished school
                
                foreach($students as $std){
                    $upd = Studentdetails::where('admno', '=', $std->admno)->update(array('currentclass' => $newclass, 'year' => $newyear));
                    
                    $push = Studentclass::create(['admno' => $std->admno, 'class' => $newclass, 'year' => $newyear]);
                }
                
                $success = "All class " . $former . " students moved to class " . $newclass;
                $action = "Moved all students from class " . $former . " to class " . $newclass;
                UserAccounts::system_audit(auth()->user()->id, $action);

                return response()->json($success);
            }
        }
        
    }
    
    public function getdormgender(Request $request)
    {
        $gender = $request->input('thegender');
        $dormitories = Dormitories::where('sex', '=', $gender)->get();
        return response()->json($dormitories);
    }
    
    
}

