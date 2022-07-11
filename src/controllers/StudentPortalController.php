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

            if (empty($semester)) {
                Session::msg("Please Select semester!.", 'warning');
                Response::redirect("student/courses/registration");
            }

            Response::redirect("student/courses/registration/new?semester=$semester");
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

        $params = [
            'columns' => "courses.*, lecturers.surname, lecturers.firstname, lecturers.position",
            'conditions' => "courses.lecturer = lecturers.lecturer_no",
            'joins' => [
                ['lecturers', 'courses.lecturer = lecturers.lecturer_no'],
            ],
            'order' => 'courses.course_code'
        ];
        
        $view = [
            'errors' => [],
        ];

        return View::make('pages/portals/students/courses/registerCourses', $view);
    }

}
