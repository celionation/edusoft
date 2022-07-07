<?php

namespace src\models;

use core\Model;
use core\validators\RequiredValidator;
use core\validators\UniqueValidator;

class Courses extends Model
{
    protected static string $table = 'courses';
    public $id, $course_id, $course, $department;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'course', 'msg' => 'Course is required']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'course', 'msg' => 'That Course already Exists.']));
    }
}
