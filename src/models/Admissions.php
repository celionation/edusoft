<?php

namespace src\models;

use core\Model;
use core\helpers\GenerateToken;
use core\validators\UniqueValidator;
use core\validators\RequiredValidator;

class Admissions extends Model
{
    protected static string $table = 'admissions';

    const BSC_DEGREE = 'BSc';
    const BED_DEGREE = 'BEd';
    const BA_DEGREE = 'BA';

    const JAMB_ENTRY = 'jamb';
    const DIRECT_ENTRY = 'direct';


    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'jamb_reg_no', 'msg' => 'Jam Reg No is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'duration', 'msg' => 'Duration is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'faculty', 'msg' => 'Faculty is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'department', 'msg' => 'Department is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'degree', 'msg' => 'Degree is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'entry_mode', 'msg' => 'Entry Mode is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'level', 'msg' => 'Level is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'status', 'msg' => 'Status is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'surname', 'msg' => 'Surname is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'firstname', 'msg' => 'FirstName is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'lastname', 'msg' => 'LastName is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => 'E-Mail is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'phone', 'msg' => 'Phone is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'dob', 'msg' => 'Date of Birth is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'martial_status', 'msg' => 'Martial Status is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'guardian_name', 'msg' => 'Guardian Name is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'guardian_phone', 'msg' => 'Guardian Phone is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'kin_name', 'msg' => 'Next of Kin Name is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'kin_phone', 'msg' => 'Next of Kin Phone is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'kin_email', 'msg' => 'Next of Kin E-Mail is required']));
        $this->runValidation(new UniqueValidator($this, ['field' => ['surname', 'firstname', 'lastname'], 'msg' => 'User Already Exists']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'matriculation_no', 'msg' => 'MatriculationNo Already Exists']));

        if($this->isNew()) {
            $this->runValidation(new UniqueValidator($this, ['field' => ['surname', 'firstname', 'lastname'], 'msg' => 'User Already Exists']));
            $this->runValidation(new UniqueValidator($this, ['field' => 'jamb_reg_no', 'msg' => 'Jamb Reg No Already Exists']));
            $this->admission_id = GenerateToken::randomString(10);
            $this->ref_no = date('Y') . '/' . GenerateToken::RandomNumber(6);
        }
    }
}
