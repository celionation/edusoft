<?php

namespace src\classes;

use core\Response;
use core\Session;
use Exception;
use src\models\Users;

class Permission
{
    /**
     * @throws Exception
     */
    public static function permRedirect($perm, $redirect, $msg = "You do not have access to this page."): void
    {
        /** @var mixed $user */

        $user = Users::getCurrentUser();
        $allowed = $user && $user->hasPermission($perm);
        if (!$allowed) {
            Session::msg($msg);
            Response::redirect($redirect);
        }
    }
}