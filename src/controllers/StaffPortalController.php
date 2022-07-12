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

class StaffPortalController extends Controller
{
    public function onConstruct()
    {
        $this->setLayout('portal');

        /** @var mixed $currentUser */

        $this->currentUser = Users::getCurrentUser();

        Permission::permRedirect(['staff'], '');
    }

    /**
     * @throws Exception
     */
    public function staffs(): View
    {
        Permission::permRedirect(['staff'], '');

        $view = [];

        return View::make('pages/portals/staffs/dashboard', $view);
    }

}
