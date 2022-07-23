<?php

use src\controllers\FeeController;
use src\controllers\AuthController;
use src\controllers\DocsController;
use src\controllers\SiteController;
use src\controllers\AdminController;
use src\controllers\CourseController;
use src\controllers\StudentController;
use src\controllers\LecturerController;
use src\controllers\MarkingsController;
use src\controllers\AdmissionController;
use src\controllers\AssessmentController;
use src\controllers\ExaminationController;
use src\controllers\StaffPortalController;
use src\controllers\StudentPortalController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/** @var TYPE_NAME $app */

$app->router->get('/', [SiteController::class, 'index']);

// Students Examiantion --- Using Jquery
$app->router->get('/students/examination/{id}', [ExaminationController::class, 'examination']);
$app->router->post('/students/examination/{id}', [ExaminationController::class, 'examination']);
$app->router->get('/examination/submitted/{id}', [ExaminationController::class, 'submitted']);


// Portals

//---students
$app->router->get('/students_portal', [StudentPortalController::class, 'students']);
$app->router->get('/student/courses', [StudentPortalController::class, 'studentCourses']);
$app->router->get('/student/courses/registration', [StudentPortalController::class, 'selectCourseSemester']);
$app->router->post('/student/courses/registration', [StudentPortalController::class, 'selectCourseSemester']);
$app->router->get('/student/courses/registration/{id}', [StudentPortalController::class, 'registerCourses']);
$app->router->post('/student/courses/registration/{id}', [StudentPortalController::class, 'registerCourses']);
//Student Examination
$app->router->get('/student/exams', [StudentPortalController::class, 'exams']);
$app->router->get('/student/exams/confirm_exam/{id}', [StudentPortalController::class, 'confirmExam']);
//doing exam.
$app->router->get('/student/exam/{id}', [StudentPortalController::class, 'startExam']);
$app->router->post('/student/exam/{id}', [StudentPortalController::class, 'startExam']);

// Results.
$app->router->get('/student/result', [StudentPortalController::class, 'result']);
$app->router->get('/student/results', [StudentPortalController::class, 'results']);

//---payments -to be remove cause am not using it anymore.
$app->router->get('/student/payments', [StudentPortalController::class, 'payments']);

$app->router->get('/staffs_portal', [StaffPortalController::class, 'staffs']);

//---lecturers
$app->router->get('/staffs_portal/lecturers', [StaffPortalController::class, 'lecturers']);
$app->router->get('/lecturer/exams', [StaffPortalController::class, 'exams']);
$app->router->get('/lecturer/exam/students/{id}', [StaffPortalController::class, 'examStudents']);
// --- Assessment To Mark.
$app->router->get('/assessments/to_mark', [MarkingsController::class, 'toMark']);
$app->router->get('/assessments/marked', [MarkingsController::class, 'marked']);
$app->router->get('/assessments/marked/student/{id}', [MarkingsController::class, 'student']);
$app->router->get('/assessments/to_mark/student/{id}', [MarkingsController::class, 'student']);
$app->router->post('/assessments/to_mark/student/{id}', [MarkingsController::class, 'student']);
$app->router->get('/assessments/student/decline/{id}', [MarkingsController::class, 'decline']);

//Assessment - Continous Assessment
$app->router->get('/lecturer/cont_asses/questions', [AssessmentController::class, 'continousAssessment']);

//Assessment - Examination
$app->router->get('/lecturer/exam/questions/{id}', [AssessmentController::class, 'examAssessment']);
$app->router->post('/lecturer/exam/questions/{id}', [AssessmentController::class, 'examAssessment']);
$app->router->get('/lecturer/exam/questions/lists', [AssessmentController::class, 'examLists']);
$app->router->get('/lecturer/exam/questions/status/{id}', [AssessmentController::class, 'examStatus']);
$app->router->get('/lecturer/exam/question/view/{id}', [AssessmentController::class, 'examView']);
$app->router->get('/lecturer/exam/question/create/{id}', [AssessmentController::class, 'examCreate']);
$app->router->post('/lecturer/exam/question/create/{id}', [AssessmentController::class, 'examCreate']);
$app->router->get('/lecturer/exam/questions/delete/{id}', [AssessmentController::class, 'examDelete']);
$app->router->get('/lecturer/exam/question/delete/{id}', [AssessmentController::class, 'questionDelete']);


$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/logout', [AuthController::class, 'logout']);

// Admin
$app->router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
$app->router->get('/admin/account', [AdminController::class, 'account']);

//Admission
$app->router->get('/admin/admission', [AdmissionController::class, 'admission']);
$app->router->post('/admin/admission', [AdmissionController::class, 'admission']);
$app->router->get('/admin/admission/lists', [AdmissionController::class, 'admissionLists']);
$app->router->get('/admin/admission/lists/admitted', [AdmissionController::class, 'admissionListsAdmitted']);
$app->router->get('/admin/admission/{id}', [AdmissionController::class, 'createAdmission']);
$app->router->post('/admin/admission/{id}', [AdmissionController::class, 'createAdmission']);
$app->router->get('/admin/admission/delete/{id}', [AdmissionController::class, 'deleteAdmission']);
$app->router->get('/admin/admission/verify/{id}', [AdmissionController::class, 'verify']);

// Students
$app->router->get('/admin/students', [StudentController::class, 'students']);
$app->router->get('/admin/students/profile/{id}', [StudentController::class, 'studentProfile']);
$app->router->get('/admin/students/exam_perm/{id}', [StudentController::class, 'studentExamPerm']);

//Lecturer
$app->router->get('/admin/lecturers', [LecturerController::class, 'lecturers']);
$app->router->post('/admin/lecturers', [LecturerController::class, 'lecturers']);
$app->router->get('/admin/lecturers/lists', [LecturerController::class, 'lecturerLists']);
$app->router->get('/admin/lecturers/{id}', [LecturerController::class, 'createLecturer']);
$app->router->post('/admin/lecturers/{id}', [LecturerController::class, 'createLecturer']);
$app->router->get('/admin/lecturers/delete/{id}', [LecturerController::class, 'deleteLecturer']);
$app->router->get('/admin/lecturers/profile/{id}', [LecturerController::class, 'lecturerProfile']);

//Admin Docs
$app->router->get('/admin/faculties', [DocsController::class, 'faculties']);
$app->router->get('/admin/faculty/create/{id}', [DocsController::class, 'createFaculty']);
$app->router->post('/admin/faculty/create/{id}', [DocsController::class, 'createFaculty']);
//Departments
$app->router->get('/admin/departments', [DocsController::class, 'departments']);
$app->router->get('/admin/department/create/{id}', [DocsController::class, 'createDepartment']);
$app->router->post('/admin/department/create/{id}', [DocsController::class, 'createDepartment']);
//Courses
$app->router->get('/admin/courses', [CourseController::class, 'courses']);
$app->router->post('/admin/courses', [CourseController::class, 'courses']);
$app->router->get('/admin/courses/lists', [CourseController::class, 'courseLists']);
$app->router->get('/admin/courses/{id}', [CourseController::class, 'createCourse']);
$app->router->post('/admin/courses/{id}', [CourseController::class, 'createCourse']);
$app->router->get('/admin/courses/delete/{id}', [CourseController::class, 'deleteCourse']);

//Users
$app->router->get('/admin/users', [AdminController::class, 'users']);
$app->router->get('/admin/users/create/{id}', [AdminController::class, 'createuser']);
$app->router->post('/admin/users/create/{id}', [AdminController::class, 'createuser']);

// Fees
$app->router->get('/admin/institute_fees', [FeeController::class, 'fees']);
$app->router->post('/admin/institute_fees', [FeeController::class, 'fees']);
$app->router->get('/admin/institute_fees/lists', [FeeController::class, 'feeLists']);
$app->router->get('/admin/institute_fees/{id}', [FeeController::class, 'createFee']);
$app->router->post('/admin/institute_fees/{id}', [FeeController::class, 'createFee']);
$app->router->get('/admin/institute_fees/delete/{id}', [FeeController::class, 'deleteFee']);


//Access Control Roles
$app->router->get('/admin/roles', [AdminController::class, 'roles']);
$app->router->get('/admin/roles/create/{id}', [AdminController::class, 'createrole']);
$app->router->post('/admin/roles/create/{id}', [AdminController::class, 'createrole']);

// Institute Levels
$app->router->get('/admin/levels/{id}', [AdminController::class, 'levels']);
$app->router->post('/admin/levels/{id}', [AdminController::class, 'levels']);

//Grade Point
$app->router->get('/admin/grades', [AdminController::class, 'grades']);
$app->router->get('/admin/grades/create/{id}', [AdminController::class, 'creategrade']);
$app->router->post('/admin/grades/create/{id}', [AdminController::class, 'creategrade']);