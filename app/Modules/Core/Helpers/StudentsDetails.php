<?php
namespace App\Modules\Core\Helpers;

use Illuminate\Http\Request;
use App\Modules\Core\Models\Studentdetails;
use App\Modules\Core\Models\Studentclass;

class StudentsDetails
{
    
    public static function get_allstudents()
    {
        $allstudents = Studentdetails::all();
        return $allstudents;
    }
    
    
    /**
     * Get the student full name
     * @param type $admno
     * @return string
     */
    public static function getstudentname($admno)
    {
        $name = Studentdetails::where('admno', '=', $admno)->first();
        if (count($name) < 1) {
            return "Not found";
        } else {
            return strtoupper($name->surname) . ', ' . $name->fname . ' ' . $name->lname;
        }
    }
    
    /**
     * Get the student's guardians'/parents' mobile contact
     * @param type $admno
     * @return string
     */
    
    public static function getstudentcontact($admno)
    {
        $contacts = Studentdetails::where('admno', '=', $admno)->first();
        return $contacts->contact;
    }
    
    /**
     * Get the selected student's current class
     * @param type $admno
     * @return integer
     */

    public static function get_student_current_class($admno) 
    {
        $currentclass = Studentdetails::where('admno', '=', $admno)->first();
        return $currentclass->currentclass;
    }
    
    /**
     * Get the students belonging to a class in a given year.
     * 
     * @param type $class
     * @param type $year
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function get_class_students($class, $year)
    {
        $class_students = Studentclass::where('class', '=', $class)->where('year', '=', $year)->get();
        return $class_students;
    }
    
    
    /**
     * Get the student's photo name
     * @param type $admno
     * @return type
     */
    public static function get_student_photo($admno){
        $details = Studentdetails::where('admno', '=', $admno)->first();
        return $details->photo;
    }
    
    public static function allStudents()
    {
        $students = Studentdetails::all();
        return $students;
    }
        
        
    

}
