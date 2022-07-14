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

        if ($this->isNew()) {
            $this->question_id = GenerateToken::randomString(10);
        }
    }

    public function validate()
    {
        $errors = [];

        $num = 0;
        $letters = ['A', 'B', 'C', 'D', 'F', 'G', 'H', 'I', 'J'];

        foreach ($_POST as $key => $value) {
            if (strstr($key, 'choice')) {
                if (empty($value)) {
                    $this->errors['choice' . $num] =  "Choice $letters[$num] is required";
                }
            }
            $num++;
        }

        return $errors;
    }
}
