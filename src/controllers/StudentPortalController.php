<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use core\helpers\CoreHelpers;
use core\helpers\GenerateToken;
use src\models\Users;
use src\classes\Permission;
use src\models\Courses;
use src\models\CourseStudents;

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

        $params = [
            'columns' => "courses.*, course_students.course_id, course_students.status",
            'conditions' => "courses.course_id = course_students.course_id AND course_students.matriculation_no = :matriculation_no",
            'joins' => [
                ['course_students', 'courses.course_id = course_students.course_id'],
            ],
            'bind' => ['matriculation_no' => $this->currentUser->code_id],
            'order' => "courses.course_title"
        ];
        
        $view = [
            'courses' => Courses::find($params),
        ];

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

        /**
         * Select all form both courses and course_students table to display on table as registered course.
         */
        $courseStudentParams = [
            'columns' => "course_students.*, courses.course_title, courses.course_code, courses.course_credit",
            'conditions' => "matriculation_no = :matriculation_no AND user_id = :user_id",
            'joins' => [
                ['courses', 'course_students.course_id = courses.course_id'],
            ],
            'bind' => ['matriculation_no' => $matriculation_no, 'user_id' => $this->currentUser->user_id],
            'order' => "created_at"
        ];

        $courses = Courses::find($params);
        $courseOptions = ['' => '---'];
        foreach ($courses as $course) {
            $courseOptions[$course->course_id] = $course->course_code . ' ' . $course->course_title;
        }

        $courseStudent = new CourseStudents;

        if($request->isPost()) {
            Session::csrfCheck();
            $courseStudent->course_id = $request->get('course_id');
            $courseStudent->cs_id = GenerateToken::randomString(10);
            $courseStudent->user_id = $this->currentUser->user_id;
            $courseStudent->matriculation_no = $this->currentUser->code_id;
            $courseStudent->status = 'waiting';

            if ($courseStudent->save()) {
                Session::msg("Course Saved Successfully!.", 'success');
                Response::redirect("student/courses/registration/new?semester=$semester&matriculation_no=$matriculation_no");
            }

        }
        
        $view = [
            'errors' => $courseStudent->getErrors(),
            'courseOptions' => $courseOptions,
            'courseStdLists' => CourseStudents::find($courseStudentParams),
        ];

        return View::make('pages/portals/students/courses/registerCourses', $view);
    }

    public function payments(): View
    {
        return View::make('pages/portals/payments/payments');
    }

}
