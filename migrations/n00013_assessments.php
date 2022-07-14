<?php

declare(strict_types=1);

/**
 * Class n00013_assessments
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n00013_assessments
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE assessments ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `assessment_id` VARCHAR(10) NULL,
            `assessment_type` VARCHAR(10) NULL,
            `assessment_title` VARCHAR(255) NULL,
            `assessment_time` VARCHAR(40) NULL,
            `assessment_semester` VARCHAR(10) NULL,
            `assessment_instruction` VARCHAR(255) NULL,
            `department` VARCHAR(100) NULL,
            `faculty` VARCHAR(100) NULL,
            `user_id` VARCHAR(65) NULL,
            `course_code` VARCHAR(60) NULL,
            `course_level` VARCHAR(10) NULL,
            `session` VARCHAR(255) NULL,
            `status` VARCHAR(10) NOT NULL DEFAULT 'disabled',
            PRIMARY KEY (id), 
            INDEX assessment_title (assessment_title), 
            INDEX assessment_semester (assessment_semester), 
            INDEX course_code (course_code), 
            INDEX course_level (course_level), 
            INDEX department (department), 
            INDEX faculty (faculty) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE assessments";
        $db->_dbh->exec($SQL);
    }
}
