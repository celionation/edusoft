<?php

namespace src\models;

use core\Model;
use core\helpers\GenerateToken;
use core\validators\UniqueValidator;
use core\validators\RequiredValidator;

class AssessmentQuestions extends Model
{
    protected static string $table = 'assessment_questions';


    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'question', 'msg' => 'Question is required']));

        if(isset($_GET['type']) && $_GET['type'] == 'multiple') {
            $this->runValidation(new RequiredValidator($this, ['field' => 'option_one', 'msg' => 'Option One is required']));
            $this->runValidation(new RequiredValidator($this, ['field' => 'option_two', 'msg' => 'Option Two is required']));
            $this->runValidation(new RequiredValidator($this, ['field' => 'option_three', 'msg' => 'Option Three is required']));
            $this->runValidation(new RequiredValidator($this, ['field' => 'option_four', 'msg' => 'Option Four is required']));
            $this->runValidation(new RequiredValidator($this, ['field' => 'correct_answer', 'msg' => 'Correct Answer is required']));
        }
        if(isset($_GET['type']) && $_GET['type'] == 'objective') {
            $this->runValidation(new RequiredValidator($this, ['field' => 'correct_answer', 'msg' => 'Correct Answer is required']));
        }

        if ($this->isNew()) {
            $this->question_id = GenerateToken::randomString(10);
        }
    }

}
