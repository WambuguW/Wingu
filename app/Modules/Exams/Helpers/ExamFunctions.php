<?php
namespace App\Modules\Exams\Helpers;

use App\Modules\Core\Models\Studentdetails;
use App\Modules\Core\Models\Studentclass;
use App\Modules\Core\Models\Examresults;
use App\Modules\Core\Models\Classes;
use App\Modules\Core\Models\Subjects;
use App\Modules\Core\Models\Examtypes;

/**
 * Contains validation functions and other computations
 * required in the Exams Module
 */
class ExamFunctions
{
    /**
     * Check if a student is registered
     * @param type $admno
     * @return boolean
     */
    public static function valid_student($admno)
    {
        $student = Studentdetails::where('admno', '=', $admno)->first();
        if(count($student)< 1){
            return false;
        } else{
            return true;
        }
    }
    
    /**
     * Check if a class is registered
     * 
     * @param type $id
     * @return boolean
     */
    public static function valid_class($id)
    {
        $classes = Classes::where('id', '=', $id)->first();
        if(count($classes)< 1){
            return false;
        } else{
            return true;
        }
    }

    /**
     * Check if a subject is registered
     * 
     * @param type $id
     * @return boolean
     */
    public static function valid_subject($id)
    {
        $subjects = Subjects::where('id', '=', $id)->first();
        if(count($subjects)< 1){
            return false;
        } else{
            return true;
        }
    }

    /**
     * Check is an exam type is registered
     * 
     * @param type $id
     * @return boolean
     */
    public static function valid_exam($id)
    {
        $exams = Examtypes::where('id', '=', $id)->first();
        if(count($exams)< 1){
            return false;
        } else{
            return true;
        }
    }
    
    /**
     * Get the subject name
     * 
     * @param type $id
     * @return string
     */
    public static function get_subject_name($id)
    {
        $name = Subjects::where('id', '=', $id)->first();
        if(count($name) < 1){
            $unknown = "Unkown subject";
            return $unknown;
        } else {
            return $name->name;
        }

    }
    
    /**
     * Get the students in a given class in a given year
     * 
     * @param type $class
     * @param type $year
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function class_student_year($class, $year){
        $data = Studentclass::where('class', '=', $class)->where('year', '=', $year)->get();
        return $data;
    }
    
    /**
     * Get a student's marks for a given subject in a specified term, exam and year
     * 
     * @param type $admno
     * @param type $term
     * @param type $exam
     * @param type $year
     * @param type $subjectid
     * @return string
     */
    public static function get_subject_marks($admno, $term, $exam, $year, $subjectid)
    {
        $marks = Examresults::where('admno', '=', $admno)->where('term', '=', $term)
                            ->where('exam', '=', $exam)->where('subjectid', '=', $subjectid)
                            ->where('year', '=', $year)->first();
        if(count($marks) < 1){//the marks for the given subject not yet entered
           return "__"; 
        } else{
            return $marks->marks;
        }

    }
    
    /**
     * Get the name of a class
     * 
     * @param type $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getclassname($id)
    {
        $class = Classes::where('id', '=', $id)->first();
        return $class->name;
    }
    
    /**
     * Get the name of an exam type
     * 
     * @param type $id
     * @return string
     */
    public static function getexamname($id)
    {
        $name = Examtypes::where('id', '=', $id)->first();
        return ucfirst($name->name);
    }
    
    /**
     * Get the student's marks for a given subject, term and year when in a given class
     * 
     * @param type $admno
     * @param type $subjid
     * @param type $class
     * @param type $term
     * @param type $year
     * @param type $exam
     * @return string
     */
    public static function getstud_subject_marks($admno, $subjid, $class, $term, $year, $exam)
    {
        $subject = Examresults::where('admno', '=', $admno)->where('subjectid', '=', $subjid)
                                ->where('class', '=', $class)->where('term', '=', $term)
                                ->where('year', '=', $year)->where('exam', '=', $exam)
                                ->first();
        if(count($subject) < 1){//marks for this subject for the given student have not been entered.
            return '____';
        } else{
            return $subject->marks;
        }
    }
    
    /**
     * Get the students of a given class in a given year
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
     * Get all the subjects
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getsubjects()
    {
        $subjects = Subjects::all();
        return $subjects;
    }
    
    /**
     * Get a student's position in a given subject for a given 
     * term, exam, and year when they are in a given class
     * 
     * @param type $admno
     * @param type $term
     * @param type $year
     * @param type $exam
     * @param type $subj
     * @param type $class
     * @return string
     */
    public static function get_subject_position($admno, $term, $year, $exam, $subj, $class)
    {
        //select * marks for the subject
        $allmarks = Examresults::where('term', '=', $term)->where('exam', '=', $exam)
                                    ->where('year', '=', $year)
                                    ->where('class', '=', $class)
                                    ->where('subjectid', '=', $subj)->get();
        //add them to array if found
        if(count($allmarks) > 0){
            foreach ($allmarks as $sbjmarks){
                $subjects_array[] = array('admno' => $sbjmarks->admno, 'subjectmarks' => $sbjmarks->marks);
            }
        } else{
            $subjects_array[] = array('admno' => $admno, 'subjectmarks' => 0);
        }

        //sort the array DESC
        foreach ($subjects_array as $key => $value) {
            $adm[$key] = $value['admno'];
            $marks[$key] = $value['subjectmarks'];
        }
        array_multisort($marks, SORT_DESC, $adm, SORT_ASC, $subjects_array);
        /* the array is now sorted */
            $position = 0; 
            //get the index of the supplied admno
            foreach($subjects_array as $sbj){
                $position += 1;
                if($sbj['admno'] == $admno){//position found
                    $position = $position;
                    break;
                }
            }
        $retn = $position . " Out of " . count($subjects_array);
        return $retn;
    }
    
    /**
     * Get the comments of the subject mark
     * 
     * @param type $admno
     * @param type $term
     * @param type $exam
     * @param type $year
     * @param type $subjectid
     * @return string
     */
    public static function get_subject_comments($admno, $term, $exam, $year, $subjectid)
    {
        $comment = Examresults::where('admno', '=', $admno)->where('term', '=', $term)
                            ->where('exam', '=', $exam)->where('subjectid', '=', $subjectid)
                            ->where('year', '=', $year)->first();
        if(count($comment) < 1){
            return ""; //marks for the subject not entered, thus no comments
        } else{
            return $comment->comments;
        }

    }
    
    /**
     * Get the mean grade for the mark scored
     * 
     * @param type $marks
     * @return string
     */
    public static function get_mean_grade($marks)
    {
        if($marks >= 80){
            return "A";
        } else if($marks >= 75 && $marks <= 79){
            return "A-";
        } else if($marks >= 70 && $marks <= 74){
            return "B+";
        } else if($marks >= 65 && $marks <= 69){
            return "B";
        } else if($marks >= 60 && $marks <= 64){
            return "B-";
        } else if($marks >= 55 && $marks <= 59){
            return "C+";
        } else if($marks >= 50 && $marks <= 54){
            return "C";
        } else if($marks >= 45 && $marks <= 49){
            return "C-";
        } else if($marks >= 40 && $marks <= 44){
            return "D+";
        } else if($marks >= 35 && $marks <= 39){
            return "D";
        } else if($marks >= 30 && $marks <= 34){
            return "D-";
        } else if($marks > 0 && $marks <= 29){
            return "E";
        }
    }
    
    
    /**
     * Get the student's overall position in a given exam
     * 
     * @param type $ad
     * @param type $term
     * @param type $year
     * @param type $exam
     * @param type $class
     * @return string
     */
    public static function rank($ad, $term, $year, $exam, $class)
    {
        $students_examined = 0;
        foreach(self::get_class_students($class, $year) as $student){
            //get the results for all students in that class
            $stdresults = Examresults::where('term', '=', $term)
                            ->where('class', '=', $class)
                            ->where('admno', '=', $student->admno)
                            ->where('exam', '=', $exam)
                            ->where('year', '=', $year)->get();
            $studenttotal = 0;
            foreach($stdresults as $stdresult){
                $students_examined += 1;
                $subjectmarks = self::get_subject_marks($stdresult->admno, $term, $exam, $year, $stdresult->subjectid);
                $studenttotal += $subjectmarks;//the total marks for this student
            }
            //add the student's total marks to array.
            $stdarray[] = array('admno' => $student->admno, 'marks' => $studenttotal);
            //$array = array($student->admno => $studenttotal);
            //$student_marks_array = array_add($array, $student->admno, $studenttotal);
        }
        foreach ($stdarray as $key => $value) {
            $adm[$key] = $value['admno'];
            $marks[$key] = $value['marks'];
        }
        array_multisort($marks, SORT_DESC, $adm, SORT_ASC, $stdarray);
        //print_r($stdarray);
            $position = 0;
            foreach($stdarray as $std){
                //echo "ADM: " . $std['admno'] . " MARKS: " . $std['marks'] . "<br>";
                $position += 1;
                if($std['admno'] == $ad){//position found
                    $position = $position;
                    break;
                }
            }
        $rtn = $position . " Out of " . count($stdarray);
        //return $position;
        return $rtn;
    }
}

