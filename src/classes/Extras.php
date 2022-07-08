<?php

namespace src\classes;

use src\models\Courses;

class Extras
{
    public static function GetImage($image, $gender = 'male')
    {
        if (!file_exists($image)) {
            $image = ROOT . "assets/img/user_female.jpg";
            if ($gender == 'male') {
                $image = ROOT . "assets/img/user_male.jpg";
            }
        }
        return $image;
    }

    public static function getAssLeturer($no)
    {
        $params = [
            'columns' => "courses.*, lecturers.surname, lecturers.firstname, lecturers.position",
            'conditions' => "courses.ass_lecturer = :ass_lecturer",
            'bind' => ['ass_lecturer' => $no],
            'joins' => [
                ['lecturers', 'courses.ass_lecturer = lecturers.lecturer_no'],
            ],
            'order' => 'courses.course DESC'
        ];

        $list = Courses::findFirst($params);
        
        if($list == NULL) {
            return '---';
        }

        return $list->position . '.' . $list->surname . ' ' . $list->firstname;
    }
}