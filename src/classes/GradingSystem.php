<?php

namespace src\classes;

use core\helpers\CoreHelpers;
use src\models\Grades;

class GradingSystem
{
    public static function Grading($data)
    {
        $params = [
            'conditions' => "score = :score",
            'bind' => ['score' => $data],
        ];

        $score = Grades::findFirst($params);

        if(range($score->score, 100)) {
            echo 'A';
        } elseif($score->score >= 60) {
            echo 'B';
        } elseif($score->scorw >= 50) {
            echo 'C';
        } elseif($score->score >= 40) {
            echo 'D';
        } elseif($score->score <= 39){
            echo 'F';
        }

        // CoreHelpers::dnd($score);

        return $score;
    }
}
