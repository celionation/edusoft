<?php

namespace src\models;

use core\Model;
use core\helpers\GenerateToken;
use core\validators\UniqueValidator;
use core\validators\RequiredValidator;

class Lecturers extends Model
{
    protected static string $table = 'lecturers';

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'position', 'msg' => 'Position is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'faculty', 'msg' => 'Faculty is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'department', 'msg' => 'Department is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'degree', 'msg' => 'Degree is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'status', 'msg' => 'Status is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'surname', 'msg' => 'Surname is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'firstname', 'msg' => 'FirstName is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'lastname', 'msg' => 'LastName is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => 'E-Mail is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'phone', 'msg' => 'Phone is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'dob', 'msg' => 'Date of Birth is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'martial_status', 'msg' => 'Martial Status is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'kin_name', 'msg' => 'Next of Kin Name is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'kin_phone', 'msg' => 'Next of Kin Phone is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'kin_email', 'msg' => 'Next of Kin E-Mail is required']));
        $this->runValidation(new UniqueValidator($this, ['field' => ['surname', 'firstname', 'lastname'], 'msg' => 'User Already Exists']));

        if ($this->isNew()) {
            $this->runValidation(new UniqueValidator($this, ['field' => ['surname', 'firstname', 'lastname'], 'msg' => 'User Already Exists']));
            $this->lecturer_id = GenerateToken::randomString(10);
            $this->lecturer_no = strtolower(GenerateToken::RandomNumber(8));
        }
    }
}
