<?php

namespace App\Modules\Core\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\Core\Helpers\UserAccounts;

class SetupController extends Controller
{
    public function classes(){
        $classes = \App\Modules\Core\Models\Classes::all();
        return view('core::classes', ['classes' => $classes]);
    }
    
    /**
     * Register a new class if it does not exist
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function addclasses(Request $request){
        $check = \App\Modules\Core\Models\Classes::where('name', '=', $request->input('classname'))->get();
        if(count($check) > 0){
            return $this->classes()->with('error', 'Sorry, a class with a similar name already exists!');
        } else{
            $class = \App\Modules\Core\Models\Classes::create(['name' => $request->input('classname')]);
            
            $action = "Added new class: " . $request->input('classname');
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            $classes = \App\Modules\Core\Models\Classes::all();
            return response()->json($classes);
        }
    }
    
    /**
     * Delete the class whose id is passed
     * 
     * @param \Illuminate\Http\Request $request
     * @param type $id
     * @return type
     */
    public function deleteclass(Request $request, $id){
        if(\App\Modules\Core\Models\Classes::where('id', '=', $id)->delete()){
            
            $action = "Deleted class id: " . $id;
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            return $this->classes()->with('success', 'Class deleted');
        }
        else{
            return $this->classes()->with('error', 'Failed to delete class');
        }
    }
    
        public function streams(){
        $streams = \App\Modules\Core\Models\Streams::all();
        return view('core::streams', ['streams' => $streams]);
    }
    
    /**
     * Registers a new stream if it does not exist
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function addstreams(Request $request){
        $check = \App\Modules\Core\Models\Streams::where('name', '=', $request->input('streamname'))->get();
        if(count($check) > 0){
            return $this->streams()->with('error', 'Sorry, a stream with a similar name already exists!');
        } else{
            $stream = \App\Modules\Core\Models\Streams::create(['name' => $request->input('streamname')]);
            
            $action = "Added new stream: " . $request->input('streamname');
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            $streams = \App\Modules\Core\Models\Streams::all();
            return response()->json($streams);
        }
    }
    
    /**
     * Deletes a stream whose id is passed
     * 
     * @param type $id
     * @return type
     */
    public function deletestream($id){
        if(\App\Modules\Core\Models\Streams::where('id', '=', $id)->delete()){
            
            $action = "Deleted Stream id: " . $id;
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            return $this->streams()->with('success', 'Stream deleted');
        }
        else{
            return $this->streams()->with('error', 'Failed to delete stream');
        }
    }
    
    public function subjects(){
        $subjects = \App\Modules\Core\Models\Subjects::all();
        return view('core::subjects', ['subjects' => $subjects]);
    }
    
    /**
     * Registers a new subject if it does not exist
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function addsubjects(Request $request){
        if(request()->ajax()){
            $check = \App\Modules\Core\Models\Subjects::where('name', '=', $request->input('subjectname'))->where('code', '=', $request->input('subjectcode'))->get();
            if(count($check) > 0){
                return $this->subjects()->with('error', 'Sorry, a subject with a similar name already exists!');
            } else{
                $subject = \App\Modules\Core\Models\Subjects::create(['code' => $request->input('subjectcode'), 'name' => $request->input('subjectname')]);
                
                $action = "Added new subject, code: " . $request->input('subjectcode');
                UserAccounts::system_audit(auth()->user()->id, $action);

                $subjects = \App\Modules\Core\Models\Subjects::all();
                return response()->json($subjects);
            }
        }
    }
    
    /**
     * Deletes a subject whose id is passed.
     * 
     * @param type $id
     * @return type
     */
    public function deletesubject($id){
        if(\App\Modules\Core\Models\Subjects::where('id', '=', $id)->delete()){
            
            $action = "Deleted subject id: " . $id;
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            return $this->subjects()->with('success', 'Subject deleted');
        }
        else{
            return $this->subjects()->with('error', 'Failed to delete subject');
        }
    }
    
    public function exams(){
        $exams = \App\Modules\Core\Models\Examtypes::all();
        return view('core::exams', ['exams' => $exams]);
    }
    
    /**
     * Registers a new type of exam if it does not exist
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function addexams(Request $request){
        $check = \App\Modules\Core\Models\Examtypes::where('name', '=', $request->input('examname'))->get();
        if(count($check) > 0){
            return $this->exams()->with('error', 'Sorry, an exam with a similar name already exists!');
        } else{
            $exam = \App\Modules\Core\Models\Examtypes::create(['name' => $request->input('examname'), 'outof' => $request->input('outof')]);
            
            $action = "Added new exam type: " . $request->input('examname');
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            $exams = \App\Modules\Core\Models\Examtypes::all();
            return response()->json($exams);
        }
    }
    
    /**
     * Deletes the exam whose id matches the one passed
     * 
     * @param type $id
     * @return type
     */
    public function deleteexam($id){
        if(\App\Modules\Core\Models\Examtypes::where('id', '=', $id)->delete()){
            
            $action = "Deleted exam type id " . $id;
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            return $this->exams()->with('success', 'Exam deleted');
        }
        else{
            return $this->exams()->with('error', 'Failed to delete exam type');
        }
    }
    
    public function dorms(){
        $dorms = \App\Modules\Core\Models\Dormitories::all();
        return view('core::dorms', ['dorms' => $dorms]);
    }
    
    /**
     * Registers a new dormitory if it does not exist
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function adddorms(Request $request){
        $check = \App\Modules\Core\Models\Dormitories::where('name', '=', $request->input('dormname'))->get();
        if(count($check) > 0){
            return $this->dorms()->with('error', 'Sorry, a dormitory with a similar name already exists!');
        } else{
            $dorm = \App\Modules\Core\Models\Dormitories::create(['name' => $request->input('dormname'), 'capacity' => $request->input('capacity'), 'sex' => $request->input('sex')]);
            
            $action = "Added new dormitory " . $request->input('dormname');
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            $dorms = \App\Modules\Core\Models\Dormitories::all();
            return response()->json($dorms);
        }
    }
    
    /**
     * Deletes the dormitory whose id matches the id supplied
     * 
     * @param type $id
     * @return type
     */
    public function deletedorm($id){
        if(\App\Modules\Core\Models\Dormitories::where('id', '=', $id)->delete()){
            
            $action = "Deleted dormitory id " . $id;
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            return $this->dorms()->with('success', 'Dormitory deleted');
        }
        else{
            return $this->dorms()->with('error', 'Failed to delete dormitory');
        }
    }
    
}
