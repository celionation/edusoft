<?php

namespace src\models;

use core\Model;
use core\helpers\GenerateToken;
use core\validators\RequiredValidator;

class Grades extends Model
{
    protected static string $table = 'grades';
    public $grade_id, $grade, $point, $score;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'grade', 'msg' => 'Role is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'point', 'msg' => 'Point is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'score', 'msg' => 'Score is required']));

        if ($this->isNew()) {
            $this->grade_id = GenerateToken::randomString(10);
        }
    }
}
