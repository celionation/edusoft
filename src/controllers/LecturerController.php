<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use core\Application;
use src\models\Roles;
use src\models\Users;
use src\models\Courses;
use src\models\Faculties;
use src\models\Admissions;
use src\classes\Permission;
use src\models\Departments;
use core\helpers\FileUpload;
use core\helpers\CoreHelpers;
use core\helpers\GenerateToken;
use src\models\Lecturers;

class LecturerController extends Controller
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

    public function lecturers(Request $request)
    {
        $faculties = Faculties::find(['order' => 'faculty']);
        $facultyOptions = ['' => '---'];
        foreach ($faculties as $fac) {
            $facultyOptions[$fac->faculty] = $fac->faculty;
        }

        $params = [
            'conditions' => "status = 'active'",
        ];

        if ($request->isPost()) {
            Session::csrfCheck();
            $faculty = $request->get('faculty');

            if(empty($faculty)) {
                Session::msg("Please Select faculty!.", 'warning');
                Response::redirect("admin/lecturers");
            }
            Response::redirect("admin/lecturers/new?faculty=$faculty");

        }

        $view = [
            'errors' => [],
            'faculty' => $facultyOptions,
            'lecturersCount' => Lecturers::findTotal($params),
        ];

        return View::make('pages/admin/lecturers/lecturers', $view);
    }

    public function createLecturer(Request $request)
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "lecturer_id = :lecturer_id",
            'bind' => ['lecturer_id' => $id]
        ];

        $lecturer = $id == 'new' ? new Lecturers() : Lecturers::findFirst($params);
        if (!$lecturer) {
            Session::msg("You do not have permission to edit this Lecturer Form", 'info');
            Response::redirect('admin/lecturers/lists');
        }

        $depts = Departments::find([
            'conditions' => "faculty = :faculty",
            'bind' => ['faculty' => $_GET['faculty']],
            'order' => 'faculty'
        ]);
        $deptOptions = ['' => '---'];
        foreach ($depts as $dept) {
            $deptOptions[$dept->department] = $dept->department;
        }

        $faculties = Faculties::find(['order' => 'faculty']);
        $facultyOptions = ['' => '---'];
        foreach ($faculties as $fac) {
            $facultyOptions[$fac->faculty] = $fac->faculty;
        }

        if ($request->isPost()) {
            Session::csrfCheck();
            $fields = ['degree', 'position', 'faculty', 'department', 'status', 'surname', 'firstname', 'lastname', 'email', 'phone', 'dob', 'martial_status', 'kin_name', 'kin_phone', 'kin_email'];
            foreach ($fields as $field) {
                $lecturer->{$field} = $request->get($field);
            }

            if ($lecturer->save()) {
                Session::msg("{$lecturer->surname}... Saved Successfully!.", 'success');
                Response::redirect('admin/lecturers/lists');
            }
        }

        $view = [
            'errors' => $lecturer->getErrors(),
            'lecturer' => $lecturer,
            'deptOpt' => $deptOptions,
            'facOpt' => $facultyOptions,
            'positions' => [
                '' => '---',
                'Mr' => 'Mr',
                'Dr' => 'Mr',
                'Prof' => 'Prof',
                'Ass Lecturer' => 'Ass Lecturer',
                'Lecturer I' => 'Lecturer I',
                'Lecturer II' => 'Lecturer II',
                'Snr Lecturer' => 'Snr Lecturer',
            ],
            'martialStatus' => [
                '' => '---',
                'single' => 'Single',
                'dating' => 'Dating',
                'engaged' => 'Engaged',
                'married' => 'Married',
                'divorced' => 'Divorced',
                'others' => 'Others'
            ],
            'statusOpt' => [
                '' => '---',
                'active' => 'Active',
                'blocked' => 'Blocked'
            ],
        ];

        return View::make('pages/admin/lecturers/form', $view);
    }

    public function lecturerLists(Request $request): View
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');
        $params = [
            // 'conditions' => "status = 'active'",
            'order' => 'surname', 'firstname'
        ];

        $view = [
            'lecturerLists' => Lecturers::find($params),
        ];

        return View::make('pages/admin/lecturers/lists', $view);
    }

    public function deleteLecturer(Request $request)
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "lecturer_id = :lecturer_id",
            'bind' => ['lecturer_id' => $id]
        ];

        $lecturer = Lecturers::findFirst($params);

        if ($lecturer) {
            Session::msg("Lecturer Deleted Successfully.", 'success');
            $lecturer->delete();
        }
        Response::redirect('admin/lecturers');
    }
    public function lecturerProfile(Request $request): View
    {
        Permission::permRedirect(['admin', 'dean'], 'admin/dashboard');

        $id = $request->getParam('id');

        if (isset($_GET['lecturer_no'])) {
            $lecturer_no = $request->sanitize($_GET['lecturer_no']);
        }

        $ExtUserParams = [
            'conditions' => "code_id = :code_id",
            'bind' => ['code_id' => $lecturer_no],
            'order' => "surname, firstname, lastname",
        ]; // check if student exst in users table to remove verify

        $params = [
            'conditions' => "lecturer_id = :lecturer_id",
            'bind' => ['lecturer_id' => $id],
            'order' => "surname, firstname, lastname",
        ];

        $extUser = Users::findFirst($ExtUserParams);

        $view = [
            'lecturer' => Lecturers::findFirst($params),
            'extUser' => $extUser,
        ];

        return View::make('pages/admin/lecturers/profile', $view);
    }

}