<?php

namespace src\models;

use core\Model;
use core\helpers\GenerateToken;
use core\validators\UniqueValidator;
use core\validators\RequiredValidator;

class Students extends Model
{
    protected static string $table = 'students';

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'level', 'msg' => 'Level is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'degree', 'msg' => 'Degree is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'faculty', 'msg' => 'Faculty is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'department', 'msg' => 'Department is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'ref_no', 'msg' => 'Ref No is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'matriculation_no', 'msg' => 'Matriculation No is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'ass_permission', 'msg' => 'Assessment Permission is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'standing', 'msg' => 'Student Standing is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'surname', 'msg' => 'Surname is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'firstname', 'msg' => 'FirstName is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'lastname', 'msg' => 'LastName is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => 'E-Mail is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'phone', 'msg' => 'Phone is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'dob', 'msg' => 'Date of Birth is required']));
        $this->runValidation(new UniqueValidator($this, ['field' => ['surname', 'firstname', 'email'], 'msg' => 'User Already Exists']));

        if ($this->isNew()) {
            $this->runValidation(new UniqueValidator($this, ['field' => ['surname', 'firstname', 'email'], 'msg' => 'User Already Exists']));
            $this->student_id = GenerateToken::randomString(10);
        }
    }
}