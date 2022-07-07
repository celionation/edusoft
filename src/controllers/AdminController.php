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
use src\models\Levels;

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

        Permission::permRedirect(['admin', 'principal', 'vc'], '');
    }

    public function dashboard(): View
    {
        $view = [];

        return View::make('pages/admin/dashboard', $view);
    }

    public function account(): View
    {
        $view = [

        ];

        return View::make('pages/admin/account', $view);
    }

    public function users(Request $request): View
    {
        $params = [
            'conditions' => "acl != 'guests' OR 'student'",
            'order' => 'lastname', 'firstname'
        ];

        $params = Users::mergeWithPagination($params);

        $view = [
            'users' => Users::find($params),
            'total' => Users::findTotal($params),
        ];

        return View::make('pages/admin/users/users', $view);
    }

    public function createuser(Request $request)
    {
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

        $roles = Roles::find(['order' => 'role']);
        $roleOptions = ['' => '---'];
        foreach ($roles as $role) {
            $roleOptions[$role->role] = $role->role;
        }

        if ($request->isPost()) {
            Session::csrfCheck();
            $fields = ['surname', 'firstname', 'lastname', 'email', 'acl', 'gender', 'state', 'country', 'address', 'password', 'confirmPassword'];
            foreach ($fields as $field) {
                $user->{$field} = $request->get($field);
            }
            $user->user_id = GenerateToken::randomString(60);

            $upload = new FileUpload('img');

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
        $params = [
            'order' => 'created_at'
        ];

        $params = Roles::mergeWithPagination($params);

        $view = [
            'roles' => Roles::find($params),
            'total' => Roles::findTotal($params),
        ];

        return View::make('pages/admin/roles/roles', $view);
    }

    public function createrole(Request $request): View
    {
        $id = $request->getParam('id');

        if ($id == 'new') {
            $role = new Roles();
        } else {
            $role = Roles::findById($id);
        }

        if (!$role) {
            Session::msg("You do not have permission to edit this role", "info");
            Response::redirect('admin/roles');
        }

        $params = [
            'order' => 'id DESC'
        ];
        $params = Roles::mergeWithPagination($params);

        if ($request->isPost()) {
            Session::csrfCheck();
            $fields = ['role', 'doctype', 'read', 'write', 'delete'];
            foreach ($fields as $field) {
                $role->{$field} = strtolower($request->get($field));
            }
            $role->role_id = GenerateToken::randomString(60);
            $role->read = $role->read ? 1 : 0;
            $role->write = $role->write ? 1 : 0;
            $role->delete = $role->delete ? 1 : 0;

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

}