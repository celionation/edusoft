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

class AssessmentController extends Controller
{
    public function onConstruct()
    {
        $this->setLayout('portal');

        /** @var mixed $currentUser */

        $this->currentUser = Users::getCurrentUser();

        Permission::permRedirect(['staff', 'admin'], '');
    }

    /**
     * @throws Exception
     */
    public function continousAssessment(): View
    {
        Permission::permRedirect(['staff', 'admin'], '');

        $view = [];

        return View::make('pages/portals/contAsses/questions', $view);
    }

    /**
     * @throws Exception
     */
    public function examAssessment(): View
    {
        Permission::permRedirect(['staff', 'admin'], '');

        $view = [
            'errors' => [],
        ];

        return View::make('pages/portals/exams/questions', $view);
    }
}
