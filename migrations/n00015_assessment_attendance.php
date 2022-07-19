<?php

declare(strict_types=1);

/**
 * Class n00015_assessment_attendance
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n00015_assessment_attendance
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE assessment_attendance ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `roll_no` VARCHAR(100) NULL,
            `user_id` VARCHAR(100) NULL,
            `matriculation_no` VARCHAR(100) NULL,
            `assessment_id` VARCHAR(30) NULL,
            `assessment_duration` VARCHAR(30) NULL,
            `time_left` VARCHAR(100) NULL,
            PRIMARY KEY (id), 
            INDEX roll_no (roll_no), 
            INDEX matriculation_no (matriculation_no), 
            INDEX assessment_id (assessment_id) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE assessment_attendance";
        $db->_dbh->exec($SQL);
    }
}