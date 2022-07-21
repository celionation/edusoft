<?php

declare(strict_types=1);

/**
 * Class n00016_assessment_answer
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n00016_assessment_answer
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE assessment_answer ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `roll_no` VARCHAR(100) NULL,
            `matriculation_no` VARCHAR(100) NULL,
            `question_id` VARCHAR(30) NULL,
            `answer` TEXT NULL,
            `mark` VARCHAR(20) NULL DEFAULT 'pending',
            `comment` VARCHAR(1024) NULL,
            PRIMARY KEY (id), 
            INDEX roll_no (roll_no), 
            INDEX mark (mark), 
            INDEX question_id (question_id) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE assessment_answer";
        $db->_dbh->exec($SQL);
    }
}