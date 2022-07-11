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
use src\models\Faculties;
use src\classes\Permission;
use src\models\Departments;
use src\models\Lecturers;
use src\models\Levels;

class CourseController extends Controller
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

    public function courses(Request $request)
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
                Response::redirect("admin/courses");
            }

            Response::redirect("admin/courses/new?faculty=$faculty");
        }

        $view = [
            'errors' => [],
            'faculty' => $facultyOptions,
            'courseCount' => Courses::findTotal($params),
        ];

        return View::make('pages/admin/courses/courses', $view);
    }

    public function createCourse(Request $request)
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "course_id = :course_id",
            'bind' => ['course_id' => $id]
        ];

        $course = $id == 'new' ? new Courses() : Courses::findFirst($params);
        if (!$course) {
            Session::msg("You do not have permission to edit this Course Form", 'info');
            Response::redirect('admin/courses/lists');
        }

        $faculty = $request->sanitize($_GET['faculty']);

        $depts = Departments::find([
            'conditions' => "faculty = :faculty",
            'bind' => ['faculty' => $faculty],
            'order' => 'faculty'
        ]);
        $deptOptions = [
            '' => '---',
            'general' => 'General'
        ];
        foreach ($depts as $dept) {
            $deptOptions[$dept->department] = $dept->department;
        }

        $levels = Levels::find(['order' => 'level']);
        $levelOptions = ['' => '---'];
        foreach ($levels as $level) {
            $levelOptions[$level->level] = $level->level;
        }

        $lects = Lecturers::find([
            'conditions' => "faculty = :faculty",
            'bind' => ['faculty' => $faculty],
            'order' => 'faculty'
        ]);
        $lectOptions = ['' => '---'];
        foreach ($lects as $lect) {
            $lectOptions[$lect->lecturer_no] = $lect->position . '.'. $lect->surname . ' ' . $lect->firstname;
        }

        if ($request->isPost()) {
            Session::csrfCheck();
            $fields = ['course_title', 'course_code', 'course_credit', 'semester', 'course_type', 'department', 'level', 'lecturer', 'ass_lecturer'];
            foreach ($fields as $field) {
                $course->{$field} = $request->get($field);
            }
            $course->course = strtolower($request->get('course'));
            $course->faculty = strtolower($faculty);

            if ($course->save()) {
                Session::msg("{$course->course_title}... Saved Successfully!.", 'success');
                Response::redirect('admin/courses/lists');
            }
        }

        $view = [
            'errors' => $course->getErrors(),
            'course' => $course,
            'levelOpt' => $levelOptions,
            'deptOpt' => $deptOptions,
            'lectOpt' => $lectOptions,
        ];

        return View::make('pages/admin/courses/course', $view);
    }

    public function courseLists(Request $request): View
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');
        
        $params = [
            'columns' => "courses.*, lecturers.surname, lecturers.firstname, lecturers.position",
            'conditions' => "courses.lecturer = lecturers.lecturer_no",
            'joins' => [
                ['lecturers', 'courses.lecturer = lecturers.lecturer_no'],
            ],
            'order' => 'courses.course_code'
        ];

        $view = [
            'courseLists' => Courses::find($params),
        ];

        return View::make('pages/admin/courses/lists', $view);
    }

    public function deleteCourse(Request $request)
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

    public function coursePreview(Request $request)
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');

        $params = [
            'columns' => "courses.*, lecturers.surname, lecturers.firstname, lecturers.position",
            'conditions' => "courses.lecturer = lecturers.lecturer_no",
            'joins' => [
                ['lecturers', 'courses.lecturer = lecturers.lecturer_no'],
            ],
            'order' => 'courses.course_code'
        ];

        $view = [
            'courseLists' => Courses::find($params),
        ];

        return View::make('pages/admin/courses/preview', $view);
    }

}
