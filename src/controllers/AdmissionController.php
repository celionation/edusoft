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
use src\models\InstituteFees;
use src\models\Levels;
use src\models\Students;

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

        $params = [
            'conditions' => "status = 'progress'",
        ];

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
            'admissionCount' => Admissions::findTotal($params),
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

        $levels = Levels::find(['order' => 'level']);
        $levelOptions = ['' => '---'];
        foreach ($levels as $level) {
            $levelOptions[$level->level] = $level->level;
        }

        if($request->isPost()) {
            Session::csrfCheck();
            $fields = ['jamb_reg_no', 'duration', 'faculty', 'department', 'degree', 'entry_mode', 'status', 'matriculation_no', 'level', 'surname', 'firstname', 'lastname', 'email', 'phone', 'dob', 'martial_status', 'guardian_name', 'guardian_phone', 'kin_name', 'kin_phone', 'kin_email'];
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
                            if (file_exists($admission->result_file) && $id != 'new') {
                                unlink(Application::$ROOT_DIR . '/' . $admission->result_file);
                                $admission->result_file = '';
                            }
                            $admission->result_file = $resultUpload->fc;
                        }
                        if ($dobUpload->upload()) {
                            if (file_exists($admission->dob_file) && $id != 'new') {
                                unlink(Application::$ROOT_DIR . '/' . $admission->dob_file);
                                $admission->dob_file = '';
                            }
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
            'levelOpt' => $levelOptions,
        ];

        return View::make('pages/admin/admission/form', $view);
    }

    public function admissionLists(Request $request): View
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $recordsPerPage = 5;

        $params = [
            'conditions' => "status = 'progress'",
            'order' => 'surname', 'firstname',
            'limit' => $recordsPerPage,
            'offset' => ($currentPage - 1) * $recordsPerPage
        ];

        $total = Admissions::findTotal();
        $numberOfPages = ceil($total / $recordsPerPage);

        $view = [
            'admissionLists' => Admissions::find($params),
            'prevPage' => $currentPage > 1 ? $currentPage - 1 : false,
            'nextPage' => $currentPage + 1 <= $numberOfPages ? $currentPage + 1 : false,
        ];

        return View::make('pages/admin/admission/lists', $view);
    }

    
    /**
     * To check aleardy admitted Students.
     *
     * @param Request $request
     * @return View
     */
    public function admissionListsAdmitted(Request $request): View
    {
        Permission::permRedirect(['admin', 'registrar'], 'admin/dashboard');

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $recordsPerPage = 1;

        $params = [
            'conditions' => "status = 'admitted'",
            'order' => 'surname', 'firstname',
            'limit' => $recordsPerPage,
            'offset' => ($currentPage - 1) * $recordsPerPage
        ];

        $total = Admissions::findTotal();
        $numberOfPages = ceil($total / $recordsPerPage);

        $view = [
            'admissionLists' => Admissions::find($params),
            'prevPage' => $currentPage > 1 ? $currentPage - 1 : false,
            'nextPage' => $currentPage + 1 <= $numberOfPages ? $currentPage + 1 : false,
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

    public function verify(Request $request)
    {
        $id = $request->getParam('id');

        if(isset($_GET['matriculation_no'])) {
            $matriculation_no = $request->sanitize($_GET['matriculation_no']);
        }

        $student = new Students();

        /**
         * Params is to check existing Student.
         */
        $stdparams = [
            'conditions' => "matriculation_no = :matriculation_no",
            'bind' => ['matriculation_no' => $matriculation_no],
        ];

        $params = [
            'columns' => "ref_no, matriculation_no, degree, faculty, department, level, surname, firstname, lastname, email, phone, dob, status",
            'conditions' => "matriculation_no = :matriculation_no",
            'bind' => ['matriculation_no' => $matriculation_no],
        ];

        $extStudent = $student::findFirst($stdparams);

        /**
         * if Student already exists redirect.
         */
        if($extStudent) {
            Session::msg('Student Already Admitted!.', 'info');
            Response::redirect('admin/admission/lists/admitted?list=admitted');
        }

        $admittedStudent = Admissions::findFirst($params);

        /**
         * feeParams is to get each student fee amount based on department.
         */
        $feeParams = [
            'columns' => "institute_fees.*, admissions.faculty, admissions.department",
            'conditions' => "institute_fees.level = admissions.level AND institute_fees.faculty = admissions.faculty AND institute_fees.department = :department",
            'joins' => [
                ['admissions', 'institute_fees.level = admissions.level'],
            ],
            'bind' => ['department' => $admittedStudent->department],
        ];

        $instAmount = InstituteFees::findFirst($feeParams);

        $student->ref_no = $admittedStudent->ref_no;
        $student->matriculation_no = $admittedStudent->matriculation_no;
        $student->degree = $admittedStudent->degree;
        $student->faculty = $admittedStudent->faculty;
        $student->department = $admittedStudent->department;
        $student->level = $admittedStudent->level;
        $student->surname = $admittedStudent->surname;
        $student->firstname = $admittedStudent->firstname;
        $student->lastname = $admittedStudent->lastname;
        $student->email = $admittedStudent->email;
        $student->phone = $admittedStudent->phone;
        $student->dob = $admittedStudent->dob;
        $student->fee_amount = $instAmount->amount ?? 0000;
        $student->standing = 'good';
        $student->ass_permission = 'declined';

        if($student->save()) {
            Session::msg('New Student Admitted Successfully', 'success');
            Response::redirect('admin/admission/lists');
        }
    }

}
