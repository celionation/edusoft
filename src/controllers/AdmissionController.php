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
use src\models\Departments;
use src\models\Faculties;

class AdmissionController extends Controller
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

    public function admission(Request $request)
    {
        $faculties = Faculties::find(['order' => 'faculty']);
        $facultyOptions = ['' => '---'];
        foreach ($faculties as $fac) {
            $facultyOptions[$fac->faculty] = $fac->faculty;
        }

        if($request->isPost()) {
            Session::csrfCheck();
            $surname = $request->get('surname');
            $firstname = $request->get('firstname');
            $lastname = $request->get('lastname');
            $faculty = $request->get('faculty');

            Response::redirect("admin/admission/new?surname=$surname&firstname=$firstname&lastname=$lastname&faculty=$faculty");
        }

        $view = [
            'errors' => [],
            'faculty' => $facultyOptions,
        ];

        return View::make('pages/admin/admission/admission', $view);
    }

    public function createAdmission(Request $request)
    {
        $depts = Departments::find([
            'conditions' => "faculty = :faculty",
            'bind' => ['faculty' => $_GET['faculty']],
            'order' => 'faculty'
        ]);
        $deptOptions = ['' => '---'];
        foreach ($depts as $dept) {
            $deptOptions[$dept->department] = $dept->department;
        }

        // CoreHelpers::dnd($deptOptions);

        $view = [
            'errors' => [],
            'deptOpt' => $deptOptions,
        ];

        return View::make('pages/admin/admission/form', $view);
    }

}
