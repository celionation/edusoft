<?php

namespace src\models;

use core\Model;
use core\helpers\GenerateToken;
use core\validators\UniqueValidator;
use core\validators\RequiredValidator;

class Courses extends Model
{
    protected static string $table = 'courses';
    public $id, $course_id, $course, $department, $faculty, $lecturer, $ass_lecturer;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'course', 'msg' => 'Course is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'lecturer', 'msg' => 'Lecturer is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'department', 'msg' => 'Department is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'faculty', 'msg' => 'Faculty is required']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'course', 'msg' => 'That Course already Exists.']));

        if ($this->isNew()) {
            $this->course_id = GenerateToken::randomString(10);
        }
    }
}
