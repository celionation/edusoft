<?php

namespace src\models;

use core\Model;
use core\helpers\GenerateToken;
use core\validators\UniqueValidator;

class AssessmentAttendance extends Model
{
    protected static string $table = 'assessment_attendance';


    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new UniqueValidator($this, ['field' => ['assessment_id', 'user_id', 'matriculation_no'], 'msg' => 'Student have already taken this Examination.']));

        if ($this->isNew()) {
            $this->roll_no = 'Roll_' . GenerateToken::RandomNumber(4);
        }
    }
}