<?php

namespace src\models;

use core\Model;
use core\validators\RequiredValidator;
use core\validators\UniqueValidator;

class Departments extends Model
{
    protected static string $table = 'departments';
    public $id, $department_id, $department;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'department', 'msg' => 'Department is required']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'department', 'msg' => 'That Department already Exists.']));
    }
}
