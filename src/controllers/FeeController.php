<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use core\helpers\CoreHelpers;
use src\models\Users;
use src\models\Courses;
use src\models\Faculties;
use src\classes\Permission;
use src\models\Departments;
use src\models\InstituteFees;
use src\models\Levels;

class FeeController extends Controller
{
    /**
     * @throws Exception
     */
    public function onConstruct()
    {
        $this->setLayout('admin');

        /** @var mixed $currentUser */

        $this->currentUser = Users::getCurrentUser();

        Permission::permRedirect(['admin', 'registrar'], '');
    }

    public function fees(Request $request)
    {
        $faculties = Faculties::find(['order' => 'faculty']);
        $facultyOptions = ['' => '---'];
        foreach ($faculties as $fac) {
            $facultyOptions[$fac->faculty] = $fac->faculty;
        }

        $params = [
            'order' => "created_at",
        ];

        if ($request->isPost()) {
            Session::csrfCheck();
            $faculty = $request->get('faculty');

            if (empty($faculty)) {
                Session::msg("Please Select faculty!.", 'warning');
                Response::redirect("admin/institute_fees");
            }

            Response::redirect("admin/institute_fees/new?faculty=$faculty");
        }

        $view = [
            'errors' => [],
            'faculty' => $facultyOptions,
            'feesCount' => InstituteFees::findTotal($params),
        ];

        return View::make('pages/admin/fees/fees', $view);
    }

    public function createFee(Request $request)
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "fee_id = :fee_id",
            'bind' => ['fee_id' => $id]
        ];

        $fees = $id == 'new' ? new InstituteFees() : InstituteFees::findFirst($params);
        if (!$fees) {
            Session::msg("You do not have permission to edit this Fee Form", 'info');
            Response::redirect('admin/institute_fees/lists');
        }

        $faculty = $request->sanitize($_GET['faculty']);

        $depts = Departments::find([
            'conditions' => "faculty = :faculty",
            'bind' => ['faculty' => $faculty],
            'order' => 'faculty'
        ]);
        $deptOptions = ['' => '---'];
        foreach ($depts as $dept) {
            $deptOptions[$dept->department] = $dept->department;
        }

        $levels = Levels::find(['order' => 'level']);
        $levelOptions = ['' => '---'];
        foreach ($levels as $level) {
            $levelOptions[$level->level] = $level->level;
        }

        if ($request->isPost()) {
            Session::csrfCheck();
            $fields = ['amount', 'department', 'level'];
            foreach ($fields as $field) {
                $fees->{$field} = $request->get($field);
            }
            $fees->faculty = strtolower($faculty);

            if ($fees->save()) {
                Session::msg("Amount Saved Successfully!.", 'success');
                Response::redirect('admin/institute_fees/lists');
            }
        }

        $view = [
            'errors' => $fees->getErrors(),
            'fees' => $fees,
            'levelOpt' => $levelOptions,
            'deptOpt' => $deptOptions,
        ];

        return View::make('pages/admin/fees/fee', $view);
    }

    public function feeLists(Request $request): View
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');

        $params = [
            'order' => 'faculty, department'
        ];

        $view = [
            'feeLists' => InstituteFees::find($params),
        ];

        return View::make('pages/admin/fees/lists', $view);
    }

    public function deleteFee(Request $request)
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "course_id = :course_id",
            'bind' => ['course_id' => $id]
        ];

        $course = Courses::findFirst($params);

        if ($course) {
            Session::msg("Course Deleted Successfully.", 'danger');
            $course->delete();
        }
        Response::redirect('admin/courses');
    }

}
