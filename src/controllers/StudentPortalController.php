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
use src\classes\Permission;
use src\models\Courses;

class StudentPortalController extends Controller
{
    public function onConstruct()
    {
        $this->setLayout('portal');

        /** @var mixed $currentUser */

        $this->currentUser = Users::getCurrentUser();

        Permission::permRedirect(['student'], '');
    }

    /**
     * @throws Exception
     */
    public function students(): View
    {
        Permission::permRedirect(['student'], '');

        $view = [];

        return View::make('pages/portals/students/students', $view);
    }

    public function studentCourses(): View
    {
        Permission::permRedirect(['student'], '');
        
        $view = [];

        return View::make('pages/portals/students/courses/courses', $view);
    }

    public function selectCourseSemester(Request $request): View
    {
        Permission::permRedirect(['student'], '');

        if ($request->isPost()) {
            Session::csrfCheck();
            $semester = $request->get('semester');
            $matriculation_no = $this->currentUser->code_id;

            if (empty($semester)) {
                Session::msg("Please Select semester!.", 'warning');
                Response::redirect("student/courses/registration");
            }

            Response::redirect("student/courses/registration/new?semester=$semester&matriculation_no=$matriculation_no");
        }
        
        $view = [
            'errors' => [],
            'semester' => [
                '' => '---',
                'first' => 'First Semester',
                'second' => 'Second Semester',
            ],
        ];

        return View::make('pages/portals/students/courses/selectCourseSemester', $view);
    }

    public function registerCourses(Request $request)
    {
        Permission::permRedirect(['student'], '');

        $semester = $request->sanitize($_GET['semester']);
        $matriculation_no = $request->sanitize($_GET['matriculation_no']);

        /**
         * Params is for getting all course of a particular student and level for registration
         */
        $params = [
            'columns' => "courses.*, students.level, students.faculty, students.department",
            'conditions' => "courses.level = students.level AND courses.faculty = students.faculty AND courses.semester = :semester AND students.matriculation_no = :matriculation_no AND courses.course_type IN ('compulsory', 'elective')",
            'joins' => [
                ['students', 'courses.level = students.level'],
            ],
            'bind' => ['semester' => $semester, 'matriculation_no' => $matriculation_no],
            'order' => 'courses.course_code'
        ];

        $courses = Courses::find($params);
        $courseOptions = ['' => '---'];
        foreach ($courses as $course) {
            $courseOptions[$course->course_id] = $course->course_code . '' . $course->course_title;
        }

        if($request->isPost()) {
            CoreHelpers::dnd($_POST);
        }
        
        $view = [
            'errors' => [],
            'courseOptions' => $courseOptions,
        ];

        return View::make('pages/portals/students/courses/registerCourses', $view);
    }

}
