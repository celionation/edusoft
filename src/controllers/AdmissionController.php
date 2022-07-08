<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use core\Application;
use src\models\Roles;
use src\models\Users;
use src\models\Courses;
use src\models\Faculties;
use src\models\Admissions;
use src\classes\Permission;
use src\models\Departments;
use core\helpers\FileUpload;
use core\helpers\CoreHelpers;
use core\helpers\GenerateToken;

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

        Permission::permRedirect(['admin', 'registrar'], '');
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
            $faculty = $request->get('faculty');

            if (empty($faculty)) {
                Session::msg("Please Select faculty!.", 'warning');
                Response::redirect("admin/admission");
            }

            Response::redirect("admin/admission/new?faculty=$faculty");
        }

        $view = [
            'errors' => [],
            'faculty' => $facultyOptions,
        ];

        return View::make('pages/admin/admission/admission', $view);
    }

    public function createAdmission(Request $request)
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');
        
        $id = $request->getParam('id');

        $params = [
            'conditions' => "admission_id = :admission_id",
            'bind' => ['admission_id' => $id]
        ];

        $admission = $id == 'new' ? new Admissions() : Admissions::findFirst($params);
        if (!$admission) {
            Session::msg("You do not have permission to edit this Admission Form", 'info');
            Response::redirect('admin/admission/lists');
        }

        $depts = Departments::find([
            'conditions' => "faculty = :faculty",
            'bind' => ['faculty' => $_GET['faculty']],
            'order' => 'faculty'
        ]);
        $deptOptions = ['' => '---'];
        foreach ($depts as $dept) {
            $deptOptions[$dept->department] = $dept->department;
        }

        $faculties = Faculties::find(['order' => 'faculty']);
        $facultyOptions = ['' => '---'];
        foreach ($faculties as $fac) {
            $facultyOptions[$fac->faculty] = $fac->faculty;
        }

        if($request->isPost()) {
            Session::csrfCheck();
            $fields = ['jamb_reg_no', 'duration', 'faculty', 'department', 'degree', 'entry_mode', 'status', 'matriculation_no', 'surname', 'firstname', 'lastname', 'email', 'phone', 'dob', 'martial_status', 'guardian_name', 'guardian_phone', 'kin_name', 'kin_phone', 'kin_email'];
            foreach ($fields as $field) {
                $admission->{$field} = $request->get($field);
            }
            $admission->matriculation_no = strtolower($request->get('matriculation_no'));
            $resultUpload = new FileUpload('result_file');
            $dobUpload = new FileUpload('dob_file');

            if ($id == 'new') {
                $resultUpload->required = true;
                $dobUpload->required = true;
            }

            $resultUploadErrors = $resultUpload->validate();
            $dobUploadErrors = $dobUpload->validate();

            if (!empty($resultUploadErrors)) {
                foreach ($resultUploadErrors as $field => $error) {
                    $admission->setError($field, $error);
                }
            }
            if (!empty($dobUploadErrors)) {
                foreach ($dobUploadErrors as $field => $error) {
                    $admission->setError($field, $error);
                }
            }

            if (empty($admission->getErrors())) {
                $resultUpload->directory('uploads/admission');
                $dobUpload->directory('uploads/admission');

                if ($admission->save()) {
                    if (!empty($resultUpload->tmp && $dobUpload->tmp)) {
                        if ($resultUpload->upload()) {
                            $admission->result_file = $resultUpload->fc;
                        }
                        if ($dobUpload->upload()) {
                            $admission->dob_file = $dobUpload->fc;
                        }
                        $admission->save();
                    }
                    Session::msg("{$admission->surname}... Admitted Successfully!.", 'success');
                    Response::redirect('admin/admission/lists');
                }
            }
        }

        $view = [
            'errors' => $admission->getErrors(),
            'admission' => $admission,
            'degreeOpt' => [
                '' => '---',
                Admissions::BSC_DEGREE => 'BSc',
                Admissions::BED_DEGREE => 'BEd',
                Admissions::BA_DEGREE => 'BA'
            ],
            'deptOpt' => $deptOptions,
            'facOpt' => $facultyOptions,
            'courseDuration' => [
                '' => '---',
                'one year' => '1 Year',
                'two years' => '2 Years',
                'three years' => '3 Years',
                'four years' => '4 Years',
                'five years' => '5 Years',
                'six years' => '6 Years',
                'seven years' => '7 Years',
                'eight years' => '8 Years',
                'nine years' => '9 Years',
                'ten years' => '10 Years',
            ],
            'entryOpt' => [
                '' => '---',
                Admissions::JAMB_ENTRY => 'Jamb',
                Admissions::DIRECT_ENTRY => 'Direct',
            ],
            'martialStatus' => [
                '' => '---',
                'single' => 'Single',
                'dating' => 'Dating',
                'engaged' => 'Engaged',
                'married' => 'Married',
                'divorced' => 'Divorced',
                'others' => 'Others'
            ],
            'statusOpt' => [
                '' => '---',
                'progress' => 'Progress',
                'admitted' => 'Admitted'
            ],
        ];

        return View::make('pages/admin/admission/form', $view);
    }

    public function admissionLists(Request $request): View
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');
        $params = [
            'conditions' => "status = 'progress'",
            'order' => 'surname', 'firstname'
        ];

        $view = [
            'admissionLists' => Admissions::find($params),
        ];

        return View::make('pages/admin/admission/lists', $view);
    }

    public function deleteAdmission(Request $request)
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "admission_id = :admission_id",
            'bind' => ['admission_id' => $id]
        ];

        $admission = Admissions::findFirst($params);

        if($admission) {
            Session::msg("Admission Deleted Successfully.", 'success');
            unlink(Application::$ROOT_DIR . '/' . $admission->result_file);
            unlink(Application::$ROOT_DIR . '/' . $admission->dob_file);
            $admission->delete();
        }
        Response::redirect('admin/admission');
    }

}
