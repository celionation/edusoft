<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Controller;
use src\models\Users;
use src\classes\Permission;

class PortalController extends Controller
{
    public function onConstruct()
    {
        $this->setLayout('main');

        /** @var mixed $currentUser */

        $this->currentUser = Users::getCurrentUser();

        Permission::permRedirect(['student', 'staff'], 'login');
    }

    /**
     * @throws Exception
     */
    public function students(): View
    {
        Permission::permRedirect(['student'], '');

        $view = [];

        return View::make('pages/portals/students', $view);
    }

    /**
     * @throws Exception
     */
    public function staffs(): View
    {
        Permission::permRedirect(['staff'], '');

        $view = [];

        return View::make('pages/portals/staff', $view);
    }

}
