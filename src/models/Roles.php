<?php

namespace src\models;

use core\Model;
use core\validators\RequiredValidator;

class Roles extends Model
{
    protected static string $table = 'roles';
    public $role_id, $role, $doctype;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'role', 'msg' => 'Role is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'doctype', 'msg' => 'Doc Type is required']));
    }
}