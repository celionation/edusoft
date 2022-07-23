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
use src\models\Levels;
use src\models\Students;
use src\models\Lecturers;
use src\models\Admissions;
use src\classes\Permission;
use core\helpers\FileUpload;
use core\helpers\CoreHelpers;
use core\helpers\GenerateToken;
use src\models\Grades;

class AdminController extends Controller
{
    /**
     * @throws Exception
     */
    public function onConstruct()
    {
        $this->setLayout('admin');

        /** @var mixed $currentUser */

        $this->currentUser = Users::getCurrentUser();

        Permission::permRedirect(['admin'], '');
    }

    public function dashboard(): View
    {
        Permission::permRedirect(['admin', 'principal', 'vc'], '');

        $view = [];

        return View::make('pages/admin/dashboard', $view);
    }

    public function account(): View
    {
        Permission::permRedirect(['admin', 'principal', 'vc'], '');

        $view = [

        ];

        return View::make('pages/admin/account', $view);
    }

    public function users(Request $request): View
    {
        Permission::permRedirect(['admin', 'vc'], '');

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $recordsPerPage = 5;

        $params = [
            'conditions' => "acl != 'guests' OR 'student'",
            'order' => 'surname', 'firstname',
            'limit' => $recordsPerPage,
            'offset' => ($currentPage - 1) * $recordsPerPage
        ];

        $total = Users::findTotal();
        $numberOfPages = ceil($total / $recordsPerPage);

        $view = [
            'users' => Users::find($params),
            'total' => $total,
            'prevPage' => $currentPage > 1 ? $currentPage - 1 : false,
            'nextPage' => $currentPage + 1 <= $numberOfPages ? $currentPage + 1 : false,
        ];

        return View::make('pages/admin/users/users', $view);
    }

    public function createuser(Request $request)
    {
        Permission::permRedirect(['admin', 'vc'], '');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "user_id = :user_id",
            'bind' => ['user_id' => $id]
        ];

        $user = $id == 'new' ? new Users() : Users::findFirst($params);

        if (!$user) {
            Session::msg("You do not have permission to this User", 'info');
            Response::redirect('admin/users/new');
        }

        $roles = Roles::find([
            'conditions' => "role != 'student'",
            'order' => 'role'
        ]);
        $roleOptions = ['' => '---'];
        foreach ($roles as $role) {
            $roleOptions[$role->role] = $role->role;
        }

        // For Registering a new Student
        if (isset($_GET['matriculation_no'])) {
            $roles = Roles::find([
                'conditions' => "role = 'student'",
                'order' => 'role'
            ]);
            $roleOptions = ['' => '---'];
            foreach ($roles as $role) {
                $roleOptions[$role->role] = $role->role;
            }

            $matricNo = $request->sanitize($_GET['matriculation_no']);
            $admParams = [
                'columns' => "surname, firstname, lastname, email, matriculation_no",
                'conditions' => "matriculation_no = :matriculation_no",
                'bind' => ['matriculation_no' => $matricNo],
            ];

            $student = Students::findFirst($admParams);

            $user->surname = $student->surname;
            $user->firstname = $student->firstname;
            $user->lastname = $student->lastname;
            $user->email = $student->email;
        }

        // For Registering a new Lecturer
        if (isset($_GET['lecturer_no'])) {

            //     'conditions' => "role LIKE '%lecturer%' OR role LIKE 'prof%'",

            $roleOptions = [
                '' => '---',
                'staff' => 'Staff'
            ];

            $lecturerNo = $request->sanitize($_GET['lecturer_no']);
            $admParams = [
                'columns' => "surname, firstname, lastname, email, lecturer_no, position",
                'conditions' => "lecturer_no = :lecturer_no",
                'bind' => ['lecturer_no' => $lecturerNo],
            ];

            $lecturer = Lecturers::findFirst($admParams);

            $user->surname = $lecturer->surname;
            $user->firstname = $lecturer->firstname;
            $user->lastname = $lecturer->lastname;
            $user->email = $lecturer->email;
            $user->status = $lecturer->position;
        }

        if ($request->isPost()) {
            Session::csrfCheck();
            $fields = ['surname', 'firstname', 'lastname', 'email', 'acl', 'gender', 'state', 'country', 'address', 'password', 'confirmPassword'];
            foreach ($fields as $field) {
                $user->{$field} = $request->get($field);
            }
            $user->user_id = GenerateToken::randomString(60);

            if(isset($_GET['matriculation_no'])) {
                $user->code_id = $student->matriculation_no;
            }
            if(isset($_GET['lecturer_no'])) {
                $user->code_id = $lecturer->lecturer_no;
            }

            $upload = new FileUpload('img');

            $upload->required = true;

            $uploadErrors = $upload->validate();

            if (!empty($uploadErrors)) {
                foreach ($uploadErrors as $field => $error) {
                    $user->setError($field, $error);
                }
            }

            if (empty($user->getErrors())) {
                $upload->directory('uploads/users');

                if ($user->save()) {
                    if (!empty($upload->tmp)) {
                        if ($upload->upload()) {
                            if (file_exists($user->img) && $id != 'new') {
                                unlink(Application::$ROOT_DIR . '/' . $user->img);
                                $user->img = '';
                            }
                            $user->img = $upload->fc;
                            $user->save();
                        }
                    }
                    Session::msg("User Registration was saved Successfully!.", 'success');
                    Response::redirect('admin/users');
                }
            }
        }

        $view = [
            'errors' => $user->getErrors(),
            'user' => $user,
            'roles' => $roleOptions,
            'gender' => [
                '' => '',
                Users::MALE_GENDER => 'Male',
                Users::FEMALE_GENDER => 'Female',
            ]
        ];

        return View::make('pages/admin/users/createUser', $view);
    }

    public function roles(Request $request): View
    {
        Permission::permRedirect(['admin', 'vc'], '');

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $recordsPerPage = 5;

        $params = [
            'order' => 'created_at',
            'limit' => $recordsPerPage,
            'offset' => ($currentPage - 1) * $recordsPerPage
        ];

        $total = Roles::findTotal();
        $numberOfPages = ceil($total / $recordsPerPage);

        $view = [
            'roles' => Roles::find($params),
            'total' => $total,
            'prevPage' => $currentPage > 1 ? $currentPage - 1 : false,
            'nextPage' => $currentPage + 1 <= $numberOfPages ? $currentPage + 1 : false,
        ];

        return View::make('pages/admin/roles/roles', $view);
    }

    public function createrole(Request $request): View
    {
        Permission::permRedirect(['admin', 'vc'], '');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "role_id = :role_id",
            'bind' => ['role_id' => $id]
        ];

        if ($id == 'new') {
            $role = new Roles();
        } else {
            $role = Roles::findFirst($params);
        }

        if (!$role) {
            Session::msg("You do not have permission to edit this role", "info");
            Response::redirect('admin/roles');
        }

        if ($request->isPost()) {
            Session::csrfCheck();
            $fields = ['role', 'doctype'];
            foreach ($fields as $field) {
                $role->{$field} = strtolower($request->get($field));
            }

            if ($role->save()) {
                Session::msg('Roles Saved Successfully', 'success');
                Response::redirect('admin/roles');
            }
        }
        
        $view = [
            'errors' => $role->getErrors(),
            'role' => $role,
        ];

        return View::make('pages/admin/roles/create', $view);
    }

    public function levels(Request $request): View
    {
        Permission::permRedirect(['admin', 'vc'], '');

        $id = $request->getParam('id');

        if ($id == 'new') {
            $level = new Levels();
        } else {
            $level = Levels::findById($id);
        }

        if (!$level) {
            Session::msg("You do not have permission to edit this level", "info");
            Response::redirect('admin/levels/new');
        }

        $params = [
            'order' => 'id DESC'
        ];
        $params = Levels::mergeWithPagination($params);

        if ($request->isPost()) {
            Session::csrfCheck();
            $level->level = $request->get('level');

            if ($level->save()) {
                Session::msg('Level Saved Successfully', 'success');
                Response::redirect('admin/levels/new');
            }
        }
        $view = [
            'errors' => $level->getErrors(),
            'level' => $level,
            'levels' => Levels::find($params),
            'total' => Levels::findTotal($params),
            'heading' => $id === 'new' ? "Create" : "Edit Level",
            'btn' => $id === 'new' ? "Create" : "Update",
        ];

        return View::make('pages/admin/levels/levels', $view);
    }

    public function grades(Request $request): View
    {
        Permission::permRedirect(['admin', 'vc'], '');

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $recordsPerPage = 5;

        $params = [
            'order' => 'created_at',
            'limit' => $recordsPerPage,
            'offset' => ($currentPage - 1) * $recordsPerPage
        ];

        $total = Grades::findTotal();
        $numberOfPages = ceil($total / $recordsPerPage);

        $view = [
            'grades' => Grades::find($params),
            'total' => $total,
            'prevPage' => $currentPage > 1 ? $currentPage - 1 : false,
            'nextPage' => $currentPage + 1 <= $numberOfPages ? $currentPage + 1 : false,
        ];

        return View::make('pages/admin/grades/grades', $view);
    }

    public function creategrade(Request $request): View
    {
        Permission::permRedirect(['admin', 'vc'], '');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "grade_id = :grade_id",
            'bind' => ['grade_id' => $id]
        ];

        if ($id == 'new') {
            $grade = new Grades();
        } else {
            $grade = Grades::findFirst($params);
        }

        if (!$grade) {
            Session::msg("You do not have permission to edit this grade", "info");
            Response::redirect('admin/grades');
        }

        if ($request->isPost()) {
            Session::csrfCheck();
            $fields = ['grade', 'point', 'score'];
            foreach ($fields as $field) {
                $grade->{$field} = strtolower($request->get($field));
            }

            if ($grade->save()) {
                Session::msg('Grades Saved Successfully', 'success');
                Response::redirect('admin/grades');
            }
        }

        $view = [
            'errors' => $grade->getErrors(),
            'grade' => $grade,
        ];

        return View::make('pages/admin/grades/create', $view);
    }

    // To be deleted after testing is done.
    public function reports(Request $request): View
    {
        $view = [];

        return View::make('pages/admin/reports', $view);
    }

}