<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use src\models\Users;
use src\classes\Permission;
use src\models\Students;

class StudentController extends Controller
{
    /**
     * @throws Exception
     */
    public function onConstruct()
    {
        $this->setLayout('admin');

        /** @var mixed $currentUser */

        $this->currentUser = Users::getCurrentUser();

        Permission::permRedirect(['admin', 'registrar'], '');
    }

    public function students(Request $request)
    {
        $params = [
            'order' => 'surname', 'firstname'
        ];

        $params = Students::mergeWithPagination($params);

        $view = [
            'students' => Students::find($params),
            'total' => Students::findTotal($params),
        ];

        return View::make('pages/admin/students/students', $view);
    }

}
