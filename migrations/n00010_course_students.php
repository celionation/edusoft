<?php

declare(strict_types=1);

/**
 * Class n00010_course_students
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n00010_course_students
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE course_students ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `cs_id` VARCHAR(10) NULL,
            `course_id` VARCHAR(100) NOT NULL,
            `matriculation_no` VARCHAR(20) NOT NULL,
            `user_id` VARCHAR(100) NOT NULL,
            `status` VARCHAR(20) NULL DEFAULT 'waiting',
            `grade` VARCHAR(10) NULL,
            `result` VARCHAR(100) NULL,
            PRIMARY KEY (id)  
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE course_students";
        $db->_dbh->exec($SQL);
    }
}
