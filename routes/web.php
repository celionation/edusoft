<?php

use src\controllers\AuthController;
use src\controllers\DocsController;
use src\controllers\SiteController;
use src\controllers\AdminController;
use src\controllers\PortalController;
use src\controllers\AdmissionController;



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

// Portals
$app->router->get('/students_portal', [PortalController::class, 'students']);


$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/logout', [AuthController::class, 'logout']);

// Admin
$app->router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
$app->router->get('/admin/account', [AdminController::class, 'account']);

//Admission
$app->router->get('/admin/admission', [AdmissionController::class, 'admission']);
$app->router->post('/admin/admission', [AdmissionController::class, 'admission']);
$app->router->get('/admin/admission/{id}', [AdmissionController::class, 'createAdmission']);
$app->router->post('/admin/admission/{id}', [AdmissionController::class, 'createAdmission']);

//Admin Docs
$app->router->get('/admin/faculties', [DocsController::class, 'faculties']);
$app->router->get('/admin/faculty/create/{id}', [DocsController::class, 'createFaculty']);
$app->router->post('/admin/faculty/create/{id}', [DocsController::class, 'createFaculty']);
//Departments
$app->router->get('/admin/departments', [DocsController::class, 'departments']);
$app->router->get('/admin/department/create/{id}', [DocsController::class, 'createDepartment']);
$app->router->post('/admin/department/create/{id}', [DocsController::class, 'createDepartment']);
//Courses
$app->router->get('/admin/courses', [DocsController::class, 'courses']);
$app->router->get('/admin/course/create/{id}', [DocsController::class, 'createCourse']);
$app->router->post('/admin/course/create/{id}', [DocsController::class, 'createCourse']);

$app->router->get('/admin/users', [AdminController::class, 'users']);
$app->router->get('/admin/users/create/{id}', [AdminController::class, 'createuser']);
$app->router->post('/admin/users/create/{id}', [AdminController::class, 'createuser']);

//Access Control Roles
$app->router->get('/admin/roles', [AdminController::class, 'roles']);
$app->router->get('/admin/roles/create/{id}', [AdminController::class, 'createrole']);
$app->router->post('/admin/roles/create/{id}', [AdminController::class, 'createrole']);

// Institute Levels
$app->router->get('/admin/levels/{id}', [AdminController::class, 'levels']);
$app->router->post('/admin/levels/{id}', [AdminController::class, 'levels']);