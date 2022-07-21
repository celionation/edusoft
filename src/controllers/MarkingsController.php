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
use src\models\AssessmentAttendance;
use src\models\SubmittedAssessment;

class MarkingsController extends Controller
{
    public function onConstruct()
    {
        $this->setLayout('portal');

        /** @var mixed $currentUser */

        $this->currentUser = Users::getCurrentUser();

        Permission::permRedirect(['staff'], '');
    }

    /**
     * @throws Exception
     */
    public function toMark(): View
    {
        Permission::permRedirect(['staff'], '');

        $params = [
            'columns' => "submitted_assessment.*, assessments.assessment_title, assessments.course_code, assessments.course_level, assessments.user_id, users.surname, users.firstname, users.lastname",
            'conditions' => "submitted_assessment.submitted = 'yes' AND submitted_assessment.marked = 'no' AND assessments.user_id = :user_id",
            'joins' => [
                ['users', 'submitted_assessment.matriculation_no = users.code_id'],
                ['assessments', 'submitted_assessment.assessment_id = assessments.assessment_id'],
            ],
            'bind' => ['user_id' => $this->currentUser->user_id],
            'order' => "users.surname, users.firstname"
        ];

        $view = [
            'toMarks' => SubmittedAssessment::find($params),
        ];

        return View::make('pages/portals/staffs/lecturers/toMark', $view);
    }


    /**
     * @throws Exception
     */
    public function marked(): View
    {
        Permission::permRedirect(['staff'], '');

        $params = [
            'columns' => "submitted_assessment.*, assessments.assessment_title, assessments.course_code, assessments.course_level, assessments.user_id, users.surname, users.firstname, users.lastname",
            'conditions' => "submitted_assessment.submitted = 'yes' AND submitted_assessment.marked = 'yes' AND assessments.user_id = :user_id",
            'joins' => [
                ['users', 'submitted_assessment.matriculation_no = users.code_id'],
                ['assessments', 'submitted_assessment.assessment_id = assessments.assessment_id'],
            ],
            'bind' => ['user_id' => $this->currentUser->user_id],
            'order' => "users.surname, users.firstname"
        ];

        $view = [
            'marked' => SubmittedAssessment::find($params),
        ];

        return View::make('pages/portals/staffs/lecturers/marked', $view);
    }

    public function student(Request $request): View
    {
        Permission::permRedirect(['staff'], '');

        $id = $request->getParam('id');

        $assessmentParams = [
            'columns' => "assessment_attendance.*, assessments.*, users.surname, users.firstname, users.lastname",
            'conditions' => "assessment_attendance.roll_no = :roll_no AND assessment_attendance.assessment_id = assessments.assessment_id",
            'joins' => [
                ['assessments', 'assessment_attendance.assessment_id = assessments.assessment_id'],
                ['users', 'assessment_attendance.matriculation_no = users.code_id'],
            ],
            'bind' => ['roll_no' => $id],
        ];

        $params = [
            'columns' => "assessment_attendance.*, assessment_answer.*, assessment_questions.question, assessment_questions.correct_answer",
            'conditions' => "assessment_attendance.roll_no = :roll_no AND assessment_attendance.assessment_id = assessment_questions.assessment_id",
            'joins' => [
                ['assessment_answer', 'assessment_attendance.roll_no = assessment_answer.roll_no'],
                ['assessment_questions', 'assessment_answer.question_id = assessment_questions.question_id'],
            ],
            'bind' => ['roll_no' => $id],
        ];
            // CoreHelpers::dnd(AssessmentAttendance::find($params));

        $view = [
            'assessment' => AssessmentAttendance::findFirst($assessmentParams),
            'questions' => AssessmentAttendance::find($params),
        ];

        return View::make('pages/portals/staffs/lecturers/studentMark', $view);
    }

}