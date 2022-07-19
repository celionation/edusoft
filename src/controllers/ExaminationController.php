<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use src\models\Users;
use src\classes\Permission;
use src\models\Assessments;
use core\helpers\CoreHelpers;
use src\models\AssessmentAnswer;
use src\models\AssessmentQuestions;
use src\models\AssessmentAttendance;

class ExaminationController extends Controller
{
    public function onConstruct()
    {
        $this->setLayout('exam');

        /** @var mixed $currentUser */

        $this->currentUser = Users::getCurrentUser();

        Permission::permRedirect(['student'], '');
    }

    public function examination(Request $request)
    {
        $id = $request->getParam('id');

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $recordsPerPage = 1;

        $assesAttendparams = [
            'conditions' => "assessment_id = :assessment_id AND user_id = :user_id AND matriculation_no = :matriculation_no",
            'bind' => ['assessment_id' => $id, 'user_id' => $this->currentUser->user_id, 'matriculation_no' => $this->currentUser->code_id]
        ];

        // Save student to assessment_attendance lists.
        $extAttendance = AssessmentAttendance::findFirst($assesAttendparams);

        if(!$extAttendance) {
            Session::msg("Access Denied. Try Starting Exam Again.", 'warning');
            Session::delete('exam_token');
            Response::redirect("student/exams/confirm_exam/{$id}?matriculation_no={$this->currentUser->code_id}&user_id={$this->currentUser->user_id}");
        }
        
        /**
         * This Session Query Here is for security check and for confirming the right student in the examination portal.
         */
        if(!Session::exists('exam_token')) {
            Session::msg("Try again...", 'info');
            Session::delete('exam_token');
            Response::redirect('student/exams');
        }

        // Display Questions.
        $params = [
            'conditions' => "assessment_id = :assessment_id",
            'bind' => ['assessment_id' => $id],
        ];
        $assessment = Assessments::findFirst($params);

        $questionsParams = [
            'conditions' => 'assessment_id = :assessment_id',
            'bind' => ['assessment_id' => $id],
            'limit' => $recordsPerPage,
            'offset' => ($currentPage - 1) * $recordsPerPage
        ];

        $total = AssessmentQuestions::findTotal($questionsParams);
        $numberOfPages = ceil($total / $recordsPerPage);

        if($request->isPost()) {
            $question_id = $request->sanitize($_POST['question_id']);
            $answer = $request->sanitize($_POST['answer']);

            $answerParams = [
                'conditions' => "question_id = :question_id AND matriculation_no = :matriculation_no",
                'bind' => ['matriculation_no' => $this->currentUser->code_id, 'question_id' => $question_id],
                'limit' => '1',
            ];

            if(empty(AssessmentAnswer::findFirst($answerParams))) {
                $assessmentAnswer = new AssessmentAnswer();
            } else {
                $assessmentAnswer = AssessmentAnswer::findFirst($answerParams);
            }

            $assessmentAnswer->roll_no = $extAttendance->roll_no;
            $assessmentAnswer->matriculation_no = $this->currentUser->code_id;
            $assessmentAnswer->question_id = $question_id;
            $assessmentAnswer->answer = $answer;

            if($assessmentAnswer->save()) {
                Session::msg('Question Saved.', 'info');
            }
        }

        $savedAnswerParams = [
            'columns' => "assessment_answer.*, assessment_attendance.assessment_id",
            'conditions' => "assessment_answer.matriculation_no = :matriculation_no AND assessment_attendance.assessment_id = :assessment_id",
            'bind' => ['matriculation_no' => $this->currentUser->code_id, 'assessment_id' => $id],
            'joins' => [
                ['assessment_attendance', 'assessment_answer.roll_no = assessment_attendance.roll_no'],
            ],
        ];


        $view = [
            'errors' => [],
            'total' => $total,
            'assessment' => $assessment,
            'savedAnswer' => AssessmentAnswer::find($savedAnswerParams),
            'questions' => AssessmentQuestions::find($questionsParams),
            'prevPage' => $currentPage > 1 ? $currentPage - 1 : false,
            'nextPage' => $currentPage + 1 <= $numberOfPages ? $currentPage + 1 : false,
        ];

        return View::make('pages/examination/examination', $view);
    }

}