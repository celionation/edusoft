<?php

declare(strict_types=1);

/**
 * Class n0007_courses
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n0007_courses
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE courses ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `course_id` VARCHAR(10) NULL,
            `course` VARCHAR(100) NULL,
            `department` VARCHAR(100) NULL,
            PRIMARY KEY (id), 
            INDEX course (course) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE courses";
        $db->_dbh->exec($SQL);
    }
}
