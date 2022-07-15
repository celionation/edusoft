<?php

namespace src\models;

use core\Model;
use core\validators\RequiredValidator;
use core\validators\UniqueValidator;

class CourseStudents extends Model
{
    protected static string $table = 'course_students';

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'course_id', 'msg' => 'Course is required']));
        $this->runValidation(new UniqueValidator($this, ['field' => ['course_id', 'user_id', 'matriculation_no'], 'msg' => 'Course Already Exists']));
    }
}
