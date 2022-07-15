<?php

namespace src\classes;

use src\models\Courses;
use src\models\Lecturers;
use src\models\Users;

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

    public static function getLeturer($id)
    {
        $params = [
            'columns' => "surname, firstname, status",
            'conditions' => "user_id = :user_id",
            'bind' => ['user_id' => $id],
        ];

        $lecturer = Users::findFirst($params);
        
        if($lecturer == NULL) {
            return '---';
        }

        return str_replace('I', '', $lecturer->status) . '. ' . $lecturer->surname . ' ' . $lecturer->firstname;
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
            'order' => 'courses.course_code'
        ];

        $list = Courses::findFirst($params);
        
        if($list == NULL) {
            return '---';
        }

        return $list->position . '.' . $list->surname . ' ' . $list->firstname;
    }
}