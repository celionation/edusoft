<?php

namespace src\models;

use core\Model;

class SubmittedAssessment extends Model
{
    protected static string $table = 'submitted_assessment';

    public function beforeSave()
    {
        $this->timeStamps();
    }
}
