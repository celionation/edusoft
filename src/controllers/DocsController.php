<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use src\models\Users;
use src\models\Roles;
use src\classes\Permission;
use core\helpers\FileUpload;
use core\helpers\CoreHelpers;
use core\helpers\GenerateToken;
use src\models\Courses;
use src\models\Departments;
use src\models\Faculties;
use src\models\Levels;

class DocsController extends Controller
{
    /**
     * @throws Exception
     */
    public function onConstruct()
    {
        $this->setLayout('admin');

        /** @var mixed $currentUser */

        $this->currentUser = Users::getCurrentUser();

        Permission::permRedirect(['admin', 'principal', 'vc'], '');
    }

    public function faculties(): View
    {
        $params = [
            'order' => 'created_at'
        ];

        $params = Faculties::mergeWithPagination($params);

        $view = [
            'faculties' => Faculties::find($params),
            'total' => Faculties::findTotal($params),
        ];

        return View::make('pages/admin/docs/faculties', $view);
    }

    
    public function createFaculty(Request $request)
    {
        $id = $request->getParam('id');

        $params = [
            'conditions' => "faculty_id = :faculty_id",
            'bind' => ['faculty_id' => $id]
        ];

        $faculty = $id == 'new' ? new Faculties() : Faculties::findFirst($params);

        if (!$faculty) {
            Session::msg("You do not have permission to this User", 'info');
            Response::redirect('admin/faculties');
        }

        if ($request->isPost()) {
            Session::csrfCheck();
            $faculty->faculty = strtolower($request->get('faculty'));
            $faculty->faculty_id = GenerateToken::randomString(10);

            if ($faculty->save()) {
                Session::msg("Faculty saved Successfully!.", 'success');
                Response::redirect('admin/faculties');
            }
        }

        $view = [
            'errors' => $faculty->getErrors(),
            'faculty' => $faculty,
        ];

        return View::make('pages/admin/docs/faculty', $view);
    }

    public function departments(): View
    {
        $params = [
            'order' => 'created_at'
        ];

        $params = Departments::mergeWithPagination($params);

        $view = [
            'departments' => Departments::find($params),
            'total' => Departments::findTotal($params),
        ];

        return View::make('pages/admin/docs/departments', $view);
    }


    public function createDepartment(Request $request)
    {
        $id = $request->getParam('id');

        $params = [
            'conditions' => "department_id = :department_id",
            'bind' => ['department_id' => $id]
        ];

        $department = $id == 'new' ? new Departments() : Departments::findFirst($params);

        if (!$department) {
            Session::msg("You do not have permission to this Department", 'info');
            Response::redirect('admin/departments');
        }

        $faculties = Faculties::find(['order' => 'faculty']);
        $facultyOptions = ['' => '---'];
        foreach ($faculties as $faculty) {
            $facultyOptions[$faculty->faculty] = $faculty->faculty;
        }

        if ($request->isPost()) {
            Session::csrfCheck();
            $fields = ['department', 'faculty'];
            foreach ($fields as $field) {
                $department->{$field} = strtolower($request->get($field));
            }
            $department->department_id = GenerateToken::randomString(10);

            if ($department->save()) {
                Session::msg("Department saved Successfully!.", 'success');
                Response::redirect('admin/departments');
            }
        }

        $view = [
            'errors' => $department->getErrors(),
            'department' => $department,
            'faculties' => $facultyOptions,
        ];

        return View::make('pages/admin/docs/department', $view);
    }

    public function courses(): View
    {
        $params = [
            'order' => 'created_at'
        ];

        $params = Courses::mergeWithPagination($params);

        $view = [
            'courses' => Courses::find($params),
            'total' => Courses::findTotal($params),
        ];

        return View::make('pages/admin/docs/courses', $view);
    }


    public function createCourse(Request $request)
    {
        $id = $request->getParam('id');

        $params = [
            'conditions' => "course_id = :course_id",
            'bind' => ['course_id' => $id]
        ];

        $course = $id == 'new' ? new Courses() : Courses::findFirst($params);

        if (!$course) {
            Session::msg("You do not have permission to this Course", 'info');
            Response::redirect('admin/courses');
        }

        $departments = Departments::find(['order' => 'department']);
        $departmentOptions = ['' => '---'];
        foreach ($departments as $department) {
            $departmentOptions[$department->department] = $department->department;
        }

        if ($request->isPost()) {
            Session::csrfCheck();
            $fields = ['course', 'department'];
            foreach ($fields as $field) {
                $course->{$field} = strtolower($request->get($field));
            }
            $course->course_id = GenerateToken::randomString(10);

            if ($course->save()) {
                Session::msg("Course saved Successfully!.", 'success');
                Response::redirect('admin/courses');
            }
        }

        $view = [
            'errors' => $course->getErrors(),
            'course' => $course,
            'departments' => $departmentOptions,
        ];

        return View::make('pages/admin/docs/course', $view);
    }

}
