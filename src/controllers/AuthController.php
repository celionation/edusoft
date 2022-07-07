<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use src\models\Users;

class AuthController extends Controller
{
    public function onConstruct()
    {
        $this->setLayout('default');
    }

    /**
     * @throws Exception
     */
    public function login(Request $request): View
    {
        $user = new Users();
        $isError = true;

        if ($request->isPost()) {
            Session::csrfCheck();
            $user->email = $request->get('email');
            $user->password = $request->get('password');
            $user->remember = $request->get('remember');
            $user->validateLogin();
            if (empty($user->getErrors())) {
                $u = $user->findFirst([
                    'conditions' => "email = :email",
                    'bind' => ['email' => $request->get('email')]
                ]);
                if ($u) {
                    $verified = password_verify($request->get('password'), $u->password);
                    if ($verified) {
                        //log the user in
                        $isError = false;
                        $remember = $request->get('remember') == 'on';
                        $u->login($remember);
                        Response::redirect('');
                    }
                }
            }
            if ($isError) {
                $user->setError('email', 'Something is wrong with the Email or Password. Please try again.');
                $user->setError('password', '');
            }
        }
        $view = [
            'errors' => $user->getErrors(),
            'user' => $user,
        ];

        return View::make('pages/auth/login', $view);
    }

    public function logout()
    {
        /** @var mixed $currentUser */
        global $currentUser;
        if ($currentUser) {
            $currentUser->logout();
        }
        Response::redirect('');
    }

}
