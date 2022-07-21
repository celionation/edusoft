<?php

namespace src\classes;

use core\helpers\CoreHelpers;
use src\models\AssessmentAnswer;
use src\models\AssessmentQuestions;
use src\models\Courses;
use src\models\Lecturers;
use src\models\SubmittedAssessment;
use src\models\Users;

class Extras
{
    public static function GetImage($image, $gender = 'male')
    {
        if (!file_exists($image)) {
            $image = ROOT . "assets/img/user_female.jpg";
            if ($gender == 'male') {
                $image = ROOT . "assets/img/user_male.jpg";
            }
        }
        return $image;
    }

    public static function getLeturer($id)
    {
        $params = [
            'columns' => "surname, firstname, status",
            'conditions' => "user_id = :user_id",
            'bind' => ['user_id' => $id],
        ];

        $lecturer = Users::findFirst($params);
        
        if($lecturer == NULL) {
            return '---';
        }

        return str_replace('I', '', $lecturer->status) . '. ' . $lecturer->surname . ' ' . $lecturer->firstname;
    }

    public static function getAssLeturer($no)
    {
        $params = [
            'columns' => "courses.*, lecturers.surname, lecturers.firstname, lecturers.position",
            'conditions' => "courses.ass_lecturer = :ass_lecturer",
            'bind' => ['ass_lecturer' => $no],
            'joins' => [
                ['lecturers', 'courses.ass_lecturer = lecturers.lecturer_no'],
            ],
            'order' => 'courses.course_code'
        ];

        $list = Courses::findFirst($params);
        
        if($list == NULL) {
            return '---';
        }

        return $list->position . '.' . $list->surname . ' ' . $list->firstname;
    }

    public static function savedAnswer($saved_answer, $id)
    {
        if(!empty($saved_answer)) {
            foreach($saved_answer as $sv) {
                if($id == $sv->question_id) {
                    return $sv->answer;
                }
            }
        }
        return '';
    }

    public static function getAnswerPercentage($assessment_id, $user_id)
    {
        $questionParams = [
            'conditions' => "assessment_id = :assessment_id",
            'bind' => ['assessment_id' => $assessment_id]
        ];

        $answerParams = [
            'columns' => "assessment_answer.question_id, assessment_answer.answer, assessment_attendance.assessment_id",
            'conditions' => "assessment_answer.matriculation_no = :matriculation_no",
            'bind' => ['matriculation_no' => $user_id],
            'joins' => [
                ['assessment_attendance', 'assessment_answer.roll_no = assessment_attendance.roll_no'],
            ],
        ];

        $questions = AssessmentQuestions::find($questionParams);
        $saved_answer = AssessmentAnswer::find($answerParams);

        $total_answer_count = 0;
        if (!empty($questions)) {
            foreach ($questions as $quest) {
                $answer = Self::savedAnswer($saved_answer, $quest->question_id);
                if (trim($answer) != "") {
                    $total_answer_count++;
                }
            }
        }

        if ($total_answer_count > 0) {
            $total_questions = count($questions);

            return floor(($total_answer_count / $total_questions) * 100);
        }

        return 0;
    }
    
    public static function getPercentage($questions, $saved_answer)
    {
        $total_answer_count = 0;
        if (!empty($questions)) {
            foreach ($questions as $quest) {
                $answer = Self::savedAnswer($saved_answer, $quest->question_id);
                if (trim($answer) != "") {
                    $total_answer_count++;
                }
            }
        }

        if ($total_answer_count > 0) {
            $total_questions = count($questions);

            return floor(($total_answer_count / $total_questions) * 100);
        }

        return 0;
    }

    public static function sumittedAssessment($assessment_id, $roll_no, $user_id)
    {
        $params = [
            'conditions' => "assessment_id = :assessment_id AND roll_no = :roll_no AND matriculation_no = :matriculation_no",
            'bind' => ['assessment_id' => $assessment_id, 'roll_no' => $roll_no, 'matriculation_no' => $user_id],
            'limit' => '1',
        ];

        return $submittedData = SubmittedAssessment::findFirst($params);
    }
}