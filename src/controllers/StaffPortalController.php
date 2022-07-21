<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use src\models\Users;
use src\models\Courses;
use src\models\Students;
use src\classes\Permission;
use src\models\Assessments;
use core\helpers\CoreHelpers;
use src\models\CourseStudents;
use core\helpers\GenerateToken;
use src\models\AssessmentAnswer;
use src\models\AssessmentAttendance;
use src\models\SubmittedAssessment;

class StaffPortalController extends Controller
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
    public function staffs(): View
    {
        Permission::permRedirect(['staff'], '');

        $toMarkParams = [
            'conditions' => "submitted = 'yes' AND marked = 'no' AND assessments.user_id = :user_id",
            'joins' => [
                ['assessments', 'submitted_assessment.assessment_id = assessments.assessment_id'],
            ],
            'bind' => ['user_id' => $this->currentUser->user_id],
        ];

        $markedParams = [
            'conditions' => "submitted = 'yes' AND marked = 'yes' AND assessments.user_id = :user_id",
            'joins' => [
                ['assessments', 'submitted_assessment.assessment_id = assessments.assessment_id'],
            ],
            'bind' => ['user_id' => $this->currentUser->user_id],
        ];

        $view = [
            'tomarkTotal' => SubmittedAssessment::findTotal($toMarkParams),
            'markedTotal' => SubmittedAssessment::findTotal($markedParams),
        ];

        return View::make('pages/portals/staffs/dashboard', $view);
    }

    public function exams(Request $request): View
    {
        Permission::permRedirect(['staff'], '');

        $params = [
            'conditions' => "user_id = :user_id AND status = 'active'",
            'bind' => ['user_id' => $this->currentUser->user_id],
            'order' => 'assessment_semester, assessment_title',
        ];

        $view = [
            'assessments' => Assessments::find($params),
        ];

        return View::make('pages/portals/staffs/lecturers/exams', $view);
    }

    public function examStudents(Request $request): View
    {
        Permission::permRedirect(['staff'], '');

        $id = $request->getParam('id');

        $assessParams = [
            'conditions' => "assessment_id = :assessment_id",
            'bind' => ['assessment_id' => $id],
        ];

        $params = [
            'columns' => "assessment_attendance.*, students.surname, students.firstname, students.lastname, assessments.assessment_title",
            'conditions' => "assessment_attendance.assessment_id = :assessment_id",
            'joins' => [
                ['students', 'assessment_attendance.matriculation_no = students.matriculation_no'],
                ['assessments', 'assessment_attendance.assessment_id = assessments.assessment_id'],
            ],
            'bind' => ['assessment_id' => $id],
            'order' => "students.surname, students.firstname"
        ];

        $view = [
            'assessment' => Assessments::findFirst($assessParams),
            'students' => AssessmentAttendance::find($params),
            'studentsTotal' => AssessmentAttendance::findTotal($params),
        ];

        return View::make('pages/portals/staffs/lecturers/examStudents', $view);
    }

}
