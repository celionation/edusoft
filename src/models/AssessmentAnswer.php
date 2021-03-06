<?php

namespace src\models;

use core\Model;

class AssessmentAnswer extends Model
{
    protected static string $table = 'assessment_answer';
    public $id = '', $comment = '';

    public function beforeSave()
    {
        $this->timeStamps();
    }
}
