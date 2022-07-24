<?php

namespace src\classes;

use core\helpers\CoreHelpers;
use src\models\CourseStudents;
use src\models\Grades;

class GradingSystem
{
    public static function SetGrade($course_code, $matriculation_no, $score)
    {
        $cond = [
            'conditions' => "course_code = :course_code AND matriculation_no = :matriculation_no",
            'bind' => ['course_code' => $course_code, 'matriculation_no' => $matriculation_no]
        ];

        $courseStudent = CourseStudents::findFirst($cond);

        if($courseStudent) {
            if ($score >= 70) {
                $courseStudent->grade = 'A';
                $courseStudent->grade_point = $score;
            } elseif ($score >= 60) {
                $courseStudent->grade = 'B';
                $courseStudent->grade_point = $score;
            } elseif ($score >= 50) {
                $courseStudent->grade = 'C';
                $courseStudent->grade_point = $score;
            } elseif ($score >= 40) {
                $courseStudent->grade = 'D';
                $courseStudent->grade_point = $score;
            } elseif ($score <= 39) {
                $courseStudent->grade = 'F';
                $courseStudent->grade_point = $score;
            }

            $courseStudent->save();
        }
    }
    
}