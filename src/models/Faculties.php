<?php

namespace src\models;

use core\Model;
use core\validators\RequiredValidator;
use core\validators\UniqueValidator;

class Faculties extends Model
{
    protected static string $table = 'faculties';
    public $id, $faculty_id, $faculty;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'faculty', 'msg' => 'Faculty is required']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'faculty', 'msg' => 'That Faculty already Exists.']));
    }
}
