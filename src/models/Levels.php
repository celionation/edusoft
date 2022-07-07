<?php

namespace src\models;

use core\Model;
use core\validators\RequiredValidator;
use core\validators\UniqueValidator;

class Levels extends Model
{
    protected static string $table = 'levels';
    public $id, $level;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'level', 'msg' => 'Level is required']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'level', 'msg' => 'That Level already Exists.']));
    }
}
