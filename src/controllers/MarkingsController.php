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
use src\models\CourseStudents;
use src\models\AssessmentAnswer;
use src\models\SubmittedAssessment;
use src\models\AssessmentAttendance;

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

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $recordsPerPage = 5;

        $params = [
            'columns' => "submitted_assessment.*, assessments.assessment_title, assessments.course_code, assessments.course_level, assessments.user_id, users.surname, users.firstname, users.lastname",
            'conditions' => "submitted_assessment.submitted = 'yes' AND submitted_assessment.marked = 'no' AND assessments.user_id = :user_id",
            'joins' => [
                ['users', 'submitted_assessment.matriculation_no = users.code_id'],
                ['assessments', 'submitted_assessment.assessment_id = assessments.assessment_id'],
            ],
            'bind' => ['user_id' => $this->currentUser->user_id],
            'order' => "users.surname, users.firstname",
            'limit' => $recordsPerPage,
            'offset' => ($currentPage - 1) * $recordsPerPage
        ];

        $total = SubmittedAssessment::findTotal();
        $numberOfPages = ceil($total / $recordsPerPage);

        $view = [
            'toMarks' => SubmittedAssessment::find($params),
            'prevPage' => $currentPage > 1 ? $currentPage - 1 : false,
            'nextPage' => $currentPage + 1 <= $numberOfPages ? $currentPage + 1 : false,
        ];

        return View::make('pages/portals/staffs/lecturers/toMark', $view);
    }


    /**
     * @throws Exception
     */
    public function marked(): View
    {
        Permission::permRedirect(['staff'], '');

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $recordsPerPage = 5;

        $params = [
            'columns' => "submitted_assessment.*, assessments.assessment_title, assessments.course_code, assessments.course_level, assessments.user_id, users.surname, users.firstname, users.lastname",
            'conditions' => "submitted_assessment.submitted = 'yes' AND submitted_assessment.marked = 'yes' AND assessments.user_id = :user_id",
            'joins' => [
                ['users', 'submitted_assessment.matriculation_no = users.code_id'],
                ['assessments', 'submitted_assessment.assessment_id = assessments.assessment_id'],
            ],
            'bind' => ['user_id' => $this->currentUser->user_id],
            'order' => "users.surname, users.firstname",
            'limit' => $recordsPerPage,
            'offset' => ($currentPage - 1) * $recordsPerPage
        ];

        $total = SubmittedAssessment::findTotal();
        $numberOfPages = ceil($total / $recordsPerPage);

        $view = [
            'marked' => SubmittedAssessment::find($params),
            'prevPage' => $currentPage > 1 ? $currentPage - 1 : false,
            'nextPage' => $currentPage + 1 <= $numberOfPages ? $currentPage + 1 : false,
        ];

        return View::make('pages/portals/staffs/lecturers/marked', $view);
    }

    public function student(Request $request): View
    {
        Permission::permRedirect(['staff'], '');

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $recordsPerPage = 5;

        $id = $request->getParam('id');

        $submittedParams = [
            'conditions' => "roll_no = :roll_no AND submitted = 'yes' AND marked = 'no'",
            'bind' => ['roll_no' => $id],
        ];

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
            'limit' => $recordsPerPage,
            'offset' => ($currentPage - 1) * $recordsPerPage
        ];

        $total = AssessmentAttendance::findTotal($params);
        $numberOfPages = ceil($total / $recordsPerPage);

        // Update Submitted data, as Marked.
        if (isset($_GET['marked']) && isset($_GET['percent'])) {
            $marked = $request->sanitize($_GET['marked']);
            $percent = $request->sanitize($_GET['percent']);

            if($percent < 100) {
                Session::msg("{$percent}% Marked: You can only set Exam as Marked after all Question has been Marked.", 'warning');
                Response::redirect("assessments/to_mark/student/{$id}");
            }

            $markedDetails = [
                'marked' => $marked,
                'marked_by' => $this->currentUser->status . '. ' . $this->currentUser->surname . ' ' . $this->currentUser->firstname . ' ' . $this->currentUser->lastname
            ];

            $submitAssessment = new SubmittedAssessment();

            if ($submitAssessment->inlineUpdate($markedDetails, ['roll_no' => $id])) {
                Session::msg('Examination Markings Completed.', 'success');
                Response::redirect("assessments/to_mark/student/{$id}");
            }
        }

        if($request->isPost()) {
            
            foreach($_POST as $key => $value) {
                $question_id = $key;
                $mark = $value;

                $answerParams = [
                    'conditions' => "roll_no = :roll_no AND question_id = :question_id",
                    'bind' => ['roll_no' => $id, 'question_id' => $question_id],
                ];

                $answer = AssessmentAnswer::findFirst($answerParams);
            
                if($answer->inlineUpdate(['mark' => $mark], ['question_id' => $question_id, 'roll_no' => $id])) {
                    // Session::msg('Marked.', 'success');
                }
            }
            Session::msg('Marked.', 'success');

        }

        $view = [
            'submitted' => SubmittedAssessment::findFirst($submittedParams),
            'assessment' => AssessmentAttendance::findFirst($assessmentParams),
            'questions' => AssessmentAttendance::find($params),
            'prevPage' => $currentPage > 1 ? $currentPage - 1 : false,
            'nextPage' => $currentPage + 1 <= $numberOfPages ? $currentPage + 1 : false,
        ];

        return View::make('pages/portals/staffs/lecturers/studentMark', $view);
    }

    public function decline(Request $request)
    {
        Permission::permRedirect(['staff'], '');

        $id = $request->getParam('id');

        $submitParams = [
            'conditions' => "roll_no = :roll_no",
            'bind' => ['roll_no' => $id],
        ];

        $submitAssessment = SubmittedAssessment::findFirst($submitParams);
        
        if($submitAssessment) {

            $attendanceParams = [
            'conditions' => "roll_no = :roll_no AND matriculation_no = :matriculation_no AND assessment_id = :assessment_id",
            'bind' => ['roll_no' => $submitAssessment->roll_no, 'matriculation_no' => $submitAssessment->matriculation_no, 'assessment_id' => $submitAssessment->assessment_id],
        ];

            $answerParams = [
            'conditions' => "roll_no = :roll_no AND matriculation_no = :matriculation_no",
            'bind' => ['roll_no' => $submitAssessment->roll_no, 'matriculation_no' => $submitAssessment->matriculation_no],
        ];

            $assessmentAttendance = AssessmentAttendance::findFirst($attendanceParams);
            $assessmentAnswers = AssessmentAnswer::find($answerParams);


            $studentCourse = new CourseStudents();

            $studentCourse->inlineUpdate(['status' => 'declined'], ['matriculation_no' => $submitAssessment->matriculation_no]);

            foreach($assessmentAnswers as $answers) {
                $answers->delete();
            }
            $assessmentAttendance->delete();
            $submitAssessment->delete();

            Session::msg('Examination Decline Now Student Can retake Exam!.', 'success');
            Response::redirect('assessments/to_mark');
        }
    }

}