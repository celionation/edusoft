<?php

namespace src\models;

use core\Model;
use core\helpers\GenerateToken;
use core\validators\UniqueValidator;
use core\validators\RequiredValidator;

class InstituteFees extends Model
{
    protected static string $table = 'institute_fees';
    public $id, $fee_id, $amount, $department, $level, $faculty;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'amount', 'msg' => 'Amount is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'level', 'msg' => 'Level is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'department', 'msg' => 'Department is required']));
        $this->runValidation(new UniqueValidator($this, ['field' => ['amount', 'level', 'department'], 'msg' => 'That Department Fee already Exists.']));

        if ($this->isNew()) {
            $this->fee_id = GenerateToken::randomString(10);
        }
    }
}
