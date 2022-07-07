<?php

namespace src\classes;

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
}