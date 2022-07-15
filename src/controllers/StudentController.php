<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use core\helpers\CoreHelpers;
use core\helpers\Pagination;
use src\classes\Extras;
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
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $recordsPerPage = 10;

        $params = [
            'order' => 'surname', 'firstname',
            'limit' => $recordsPerPage,
            'offset' => ($currentPage - 1) * $recordsPerPage
        ];

        $total = Students::findTotal();
        $numberOfPages = ceil($total / $recordsPerPage);

        $view = [
            'students' => Students::find($params),
            'total' => $total,
            'prevPage' => $currentPage > 1 ? $currentPage - 1 : false,
            'nextPage' => $currentPage + 1 <= $numberOfPages ? $currentPage + 1 : false,
        ];

        return View::make('pages/admin/students/students', $view);
    }

    public function studentProfile(Request $request): View
    {
        Permission::permRedirect(['admin', 'dean'], 'admin/dashboard');

        $id = $request->getParam('id');

        if (isset($_GET['matriculation_no'])) {
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

    public function studentExamPerm(Request $request)
    {
        Permission::permRedirect(['admin', 'dean'], 'admin/dashboard');

        $id = $request->getParam('id');

        if (isset($_GET['matriculation_no'])) {
            $matriculation_no = $request->sanitize($_GET['matriculation_no']);
        }
        if (isset($_GET['exam_perm'])) {
            $exam_perm = $request->sanitize($_GET['exam_perm']);
        }

        $params = [
            'conditions' => "student_id = :student_id AND matriculation_no = :matriculation_no",
            'bind' => ['student_id' => $id, 'matriculation_no' => $matriculation_no],
            'order' => "surname, firstname, lastname",
        ];

        $student = Students::findFirst($params);

        $student->exam_permission = $exam_perm;

        if ($student->inlineUpdate(['exam_permission' => $exam_perm], ['student_id' => $id])) {
            Session::msg('Examination Permission Saved', 'success');
            Response::redirect("admin/students");
        }
    }
}
