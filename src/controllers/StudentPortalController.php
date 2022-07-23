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
use src\models\AssessmentAttendance;
use src\models\AssessmentQuestions;
use src\models\Assessments;
use src\models\Courses;
use src\models\CourseStudents;
use src\models\Students;

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
        $codeOptions = ['' => '---'];
        foreach ($courses as $course) {
            $courseOptions[$course->course_id] = $course->course_code . ' ' . $course->course_title;
            $codeOptions[$course->course_code] = $course->course_code;
        }

        $courseStudent = new CourseStudents;

        if($request->isPost()) {
            Session::csrfCheck();
            $courseStudent->course_id = $request->get('course_id');
            $courseStudent->course_code = $request->get('course_code');
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
            'codeOptions' => $codeOptions,
            'courseStdLists' => CourseStudents::find($courseStudentParams),
        ];

        return View::make('pages/portals/students/courses/registerCourses', $view);
    }

    public function exams(Request $request): View
    {
        Permission::permRedirect(['student'], '');

        $params = [
            'columns' => "assessments.*, course_students.course_code, course_students.status as courseStatus",
            'conditions' => "course_students.matriculation_no = :code_id AND course_students.user_id = :user_id AND assessments.status = 'active' AND course_students.status = 'waiting'",
            'joins' => [
                ['course_students', 'assessments.course_code = course_students.course_code'],
            ],
            'bind' => ['code_id' => $this->currentUser->code_id, 'user_id' => $this->currentUser->user_id],
            'order' => "assessments.created_at"
        ];

        $examPermParams = [
            'conditions' => "exam_permission = 'accepted' AND matriculation_no = :matriculation_no",
            'bind' => ['matriculation_no' => $this->currentUser->code_id],
        ];

        $assessments = Assessments::find($params);

        $view = [
            'assessments' => $assessments,
            'student' => Students::findFirst($examPermParams),
        ];

        return View::make('pages/portals/students/exams/exams', $view);
    }

    public function confirmExam(Request $request): View
    {
        Permission::permRedirect(['student'], '');

        $id = $request->getParam('id');

        if(isset($_GET['matriculation_no'])) {
            $matriculation_no = $request->sanitize($_GET['matriculation_no']);
        }

        if(isset($_GET['user_id'])) {
            $user_id = $request->sanitize($_GET['user_id']);
        }

        $params = [
            'conditions' => "assessment_id = :assessment_id",
            'bind' => ['assessment_id' => $id],
        ];

        $view = [
            'assessment' => Assessments::findFirst($params),
            'matriculation_no' => $matriculation_no,
            'user_id' => $user_id,
        ];

        return View::make('pages/portals/students/exams/startModal', $view);
    }

    public function startExam(Request $request)
    {
        if($request->isGet()) {
            Session::msg("You don't have the permission to write exam.", 'info');
            Response::redirect('student/exams');
        }

        if($request->isPost()) {
            Session::csrfCheck();

            $id = $request->getParam('id');

            if (isset($_GET['matriculation_no'])) {
                $matriculation_no = $request->sanitize($_GET['matriculation_no']);
            }

            if (isset($_GET['user_id'])) {
                $user_id = $request->sanitize($_GET['user_id']);
            }

            //Updating the Assessments editable table.
            $params = [
                'conditions' => "assessment_id = :assessment_id",
                'bind' => ['assessment_id' => $id],
            ];
            $assessment = Assessments::findFirst($params);

            $assessment->inlineUpdate(['editable' => 'disabled'], ['assessment_id' => $assessment->assessment_id]);

            //End of Updating the Assessments editable table.

            $assesAttendparams = [
                'conditions' => "assessment_id = :assessment_id AND user_id = :user_id AND matriculation_no = :matriculation_no",
                'bind' => ['assessment_id' => $id, 'user_id' => $user_id, 'matriculation_no' => $matriculation_no]
            ];

            // Save student to assessment_attendance lists.
            $extAttendance = AssessmentAttendance::findFirst($assesAttendparams);

            if ($extAttendance) {
                Session::msg("You can't attend examination twice.", 'info');
                Response::redirect('student/exams');
            }

            if (empty($assessmentAttendance)) {
                $assessmentAttendance = new AssessmentAttendance();

                $assessmentAttendance->user_id = $user_id;
                $assessmentAttendance->matriculation_no = $matriculation_no;
                $assessmentAttendance->assessment_id = $id;
                $assessmentAttendance->assessment_duration = $assessment->assessment_time;

                if ($assessmentAttendance->save()) {
                    if(Session::exists('exam_token')) {
                        Session::delete('exam_token');
                    }
                    Session::set('exam_token', GenerateToken::RandomNumber(6));
                    Session::msg('Attedance Marked...', 'success');
                    Response::redirect("students/examination/{$id}");
                }
            }
        }

    }

    public function result(Request $request): View
    {
        $view = [];

        return View::make('pages/portals/students/results/result', $view);
    }

    public function results(Request $request): View
    {
        $view = [];

        return View::make('pages/portals/students/results/results', $view);
    }

    public function payments(): View
    {
        return View::make('pages/portals/payments/payments');
    }

}
