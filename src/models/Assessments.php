<?php

namespace src\models;

use core\Model;
use core\helpers\GenerateToken;
use core\validators\UniqueValidator;
use core\validators\RequiredValidator;

class Assessments extends Model
{
    protected static string $table = 'assessments';


    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'session', 'msg' => 'Session is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'assessment_type', 'msg' => 'Type is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'assessment_title', 'msg' => 'Title is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'assessment_instruction', 'msg' => 'Instruction is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'course_code', 'msg' => 'Course Code is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'assessment_time', 'msg' => 'Time is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'assessment_semester', 'msg' => 'Semester is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'faculty', 'msg' => 'Faculty is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'department', 'msg' => 'Department is required']));
        
        $this->runValidation(new UniqueValidator($this, ['field' => ['session', 'assessment_title', 'assessment_type', 'course_code'], 'msg' => 'Assessment Already Exists']));
        if ($this->isNew()) {
            $this->assessment_id = GenerateToken::randomString(10);
        }
    }
}
