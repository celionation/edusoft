<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use core\helpers\CoreHelpers;
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

    public function students(Request $request): View
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

    public function studentProfile(Request $request): View
    {
        Permission::permRedirect(['admin', 'dean'], 'admin/dashboard');

        $id = $request->getParam('id');

        if(isset($_GET['matriculation_no'])) {
            $matriculation_no = $request->sanitize($_GET['matriculation_no']);
        }

        $ExtUserParams = [
            'conditions' => "code_id = :code_id",
            'bind' => ['code_id' => $matriculation_no],
            'order' => "surname, firstname, lastname",
        ]; // check if student exst in users table to remove verify

        $params = [
            'conditions' => "student_id = :student_id",
            'bind' => ['student_id' => $id],
            'order' => "surname, firstname, lastname",
        ];

        $extUser = Users::findFirst($ExtUserParams);
        
        $view = [
            'student' => Students::findFirst($params),
            'extUser' => $extUser,
        ];

        return View::make('pages/admin/students/profile', $view);
    }

}
