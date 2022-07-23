<?php

declare(strict_types=1);

/**
 * Class n00018_grades
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n00018_grades
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE grades ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            grade_id VARCHAR(60) NULL,
            `grade` VARCHAR(50) NULL,
            `point` INT NULL,
            `score` BIGINT NULL,
            PRIMARY KEY (id), 
            INDEX grade_id (grade_id), 
            INDEX grade (grade)
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE grades";
        $db->_dbh->exec($SQL);
    }
}