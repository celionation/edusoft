<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Request;
use core\Session;
use core\Response;
use core\Controller;
use core\Application;
use src\models\Users;
use src\models\Courses;
use src\classes\Permission;
use src\models\Assessments;
use core\helpers\FileUpload;
use core\helpers\CoreHelpers;
use core\helpers\GenerateToken;
use src\models\AssessmentQuestions;

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
    public function examAssessment(Request $request): View
    {
        Permission::permRedirect(['staff', 'admin'], '');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "assessment_id = :assessment_id AND user_id = :user_id",
            'bind' => ['assessment_id' => $id, 'user_id' => $this->currentUser->user_id]
        ];

        $assessment = $id == 'new' ? new Assessments() : Assessments::findFirst($params);
        if (!$assessment) {
            Session::msg("You do not have permission to edit this assessment", 'info');
            Response::redirect('lecturer/exam/questions/new');
        }

        $courseParams = [
            'conditions' => "lecturer = :lecturer",
            'bind' => ['lecturer' => $this->currentUser->code_id],
        ];

        $courses = Courses::find($courseParams);

        $deptOptions = ['' => '---'];
        $titleOptions = ['' => '---'];
        $semesterOptions = ['' => '---'];
        $facultyOptions = ['' => '---'];
        $departmentOptions = ['' => '---'];
        $codeOptions = ['' => '---'];
        $levelOptions = ['' => '---'];
        foreach ($courses as $course) {
            $deptOptions[$course->department] = $course->department;
            $titleOptions[$course->course_title] = $course->course_title;
            $semesterOptions[$course->semester] = $course->semester;
            $facultyOptions[$course->faculty] = $course->faculty;
            $departmentOptions[$course->department] = $course->department;
            $codeOptions[$course->course_code] = $course->course_code;
            $levelOptions[$course->level] = $course->level;
        }

        if($request->isPost()) {
            Session::csrfCheck();
            $fields = ['session', 'course_level', 'assessment_type', 'assessment_title', 'assessment_instruction', 'course_code', 'assessment_time', 'assessment_semester', 'faculty', 'department'];
            foreach ($fields as $field) {
                $assessment->{$field} = $request->get($field);
            }

            $assessment->user_id = $this->currentUser->user_id;
            $assessment->status = 'disabled';

            if ($assessment->save()) {
                Session::msg('Examination Created Now Proceed to add Questions...', 'success');
                Response::redirect('lecturer/exam/questions/lists');
            }
        }

        $view = [
            'errors' => [],
            'assessment' => $assessment,
            'types' => [
                '' => '---',
                'cont_asses' => 'Continous Assessment',
                'exam' => 'Examination'
            ],
            'titleOptions' => $titleOptions,
            'semesterOptions' => $semesterOptions,
            'facultyOptions' => $facultyOptions,
            'departmentOptions' => $departmentOptions,
            'codeOptions' => $codeOptions,
            'levelOptions' => $levelOptions,
        ];

        return View::make('pages/portals/exams/questions', $view);
    }

    public function examLists(Request $request): View
    {
        Permission::permRedirect(['staff', 'admin'], '');

        $params = [
            'conditions' => "user_id = :user_id",
            'bind' => ['user_id' => $this->currentUser->user_id],
            'order' => 'assessment_semester, assessment_title',
        ];

        $view = [
            'assessments' => Assessments::find($params),
        ];

        return View::make('pages/portals/exams/lists', $view);
    }

    /**
     * View Single Examination Question
     */
    public function examView(Request $request): View
    {
        Permission::permRedirect(['staff', 'admin'], '');
        
        $id = $request->getParam('id');

        $params = [
            'conditions' => "assessment_id = :assessment_id",
            'bind' => ['assessment_id' => $id],
        ];

        $assesParams = [
            'conditions' => "assessment_id = :assessment_id",
            'bind' => ['assessment_id' => $id],
            'order' => 'created_at DESC',
        ];

        $view = [
            'assessment' => Assessments::findFirst($params),
            'questions' => AssessmentQuestions::find($assesParams),
            'totalQues' => AssessmentQuestions::findTotal($assesParams),
        ];

        return View::make('pages/portals/exams/question', $view);
    }

    public function examCreate(Request $request): View
    {
        Permission::permRedirect(['staff', 'admin'], '');

        $id = $request->getParam('id');

        $exam_id = $request->sanitize($_GET['exam_id']);
        $type = $request->sanitize($_GET['type']);

        $params = [
            'conditions' => "assessment_id = :assessment_id",
            'bind' => ['assessment_id' => $exam_id],
        ];

        $assesQuestParams = [
            'conditions' => "question_id = :question_id AND user_id = :user_id",
            'bind' => ['question_id' => $id, 'user_id' => $this->currentUser->user_id]
        ];

        $assessmentQuestion = $id == 'new' ? new AssessmentQuestions() : AssessmentQuestions::findFirst($assesQuestParams);

        if (!$assessmentQuestion) {
            Session::msg("You do not have permission to edit this Examination Question", 'info');
            Response::redirect("lecturer/exam/question/view/$exam_id");
        }

        if($request->isPost()) {
            Session::csrfCheck();
            $fields = ['question', 'comment', 'correct_answer', 'option_one', 'option_two', 'option_three', 'option_four'];
            foreach ($fields as $field) {
                $assessmentQuestion->{$field} = $request->get($field);
            }
            $assessmentQuestion->assessment_id = $exam_id;
            $assessmentQuestion->question_type = $type;
            $assessmentQuestion->user_id = $this->currentUser->user_id;
            $upload = new FileUpload('image');

            if ($id != 'new') {
                $upload->required = false;
            }

            if (isset($type) && $type == "multiple") {
                //for multiple choice
                
            }

            $uploadErrors = $upload->validate();

            if (!empty($uploadErrors)) {
                foreach ($uploadErrors as $field => $error) {
                    $assessmentQuestion->setError($field, $error);
                }
            }

            if (empty($assessmentQuestion->getErrors())) {
                $upload->directory('uploads/examination');

                if ($assessmentQuestion->save()) {
                    if (!empty($upload->tmp)) {
                        if ($upload->upload()) {
                            if (file_exists($assessmentQuestion->image) && $id != 'new') {
                                unlink(Application::$ROOT_DIR . '/' . $assessmentQuestion->image);
                                $assessmentQuestion->image = '';
                            }
                            $assessmentQuestion->image = $upload->fc;
                            $assessmentQuestion->save();
                        }
                    }
                    Session::msg('Question Saved Successfully!...', 'success');
                    Response::redirect("lecturer/exam/question/view/$exam_id");
                }
            }
        }
        
        $view = [
            'errors' => $assessmentQuestion->getErrors(),
            'assessment' => Assessments::findFirst($params),
            'questions' => $assessmentQuestion,
            'Options' => [
                '' => '---',
                'option_one' => 'Option One',
                'option_two' => 'Option Two',
                'option_three' => 'Option Three',
                'option_four' => 'Option Four'
            ],
        ];

        return View::make('pages/portals/exams/create', $view);
    }

    public function examDelete(Request $request)
    {
        Permission::permRedirect(['staff', 'admin'], '');

        $id = $request->getParam('id');

        $params = [
            'conditions' => "assessment_id = :assessment_id",
            'bind' => ['assessment_id' => $id],
        ];

        $assessment = Assessments::findFirst($params);

        if ($assessment) {
            Session::msg("Examination Deleted Successfully.", 'danger');
            $assessment->delete();
        }
        Response::redirect("lecturer/exam/questions/lists");
    }

    public function questionDelete(Request $request)
    {
        Permission::permRedirect(['staff', 'admin'], '');

        $id = $request->getParam('id');

        $exam_id = $request->sanitize($_GET['exam_id']);

        $params = [
            'conditions' => "question_id = :question_id",
            'bind' => ['question_id' => $id]
        ];

        $question = AssessmentQuestions::findFirst($params);

        if($question) {
            Session::msg("Question Deleted Successfully.", 'danger');
            unlink(Application::$ROOT_DIR . '/' . $question->image);
            $question->delete();
        }
        Response::redirect("lecturer/exam/question/view/$exam_id");
    }

    public function examStatus(Request $request)
    {
        Permission::permRedirect(['staff', 'admin'], '');

        $id = $request->getParam('id');

        if (isset($_GET['exam_status'])) {
            $exam_status = $request->sanitize($_GET['exam_status']);
        }

        $params = [
            'conditions' => "assessment_id = :assessment_id",
            'bind' => ['assessment_id' => $id],
        ];

        $assessment = Assessments::findFirst($params);

        $assessment->status = $exam_status;

        if ($assessment->inlineUpdate(['status' => $exam_status], ['assessment_id' => $id])) {
            Session::msg('Examination Status Updated...', 'success');
            Response::redirect("lecturer/exam/questions/lists");
        }
    }

}
