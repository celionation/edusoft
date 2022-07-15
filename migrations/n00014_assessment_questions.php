<?php

declare(strict_types=1);

/**
 * Class n00014_assessment_questions
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n00014_assessment_questions
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE assessment_questions ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `question_id` VARCHAR(10) NULL,
            `assessment_id` VARCHAR(20) NULL,
            `question` TEXT NULL,
            `comment` VARCHAR(300) NULL,
            `image` VARCHAR(500) NULL,
            `question_type` VARCHAR(20) NULL,
            `correct_answer` TEXT NULL,
            `option_one` VARCHAR(500) NULL,
            `option_two` VARCHAR(500) NULL,
            `option_three` VARCHAR(500) NULL,
            `option_four` VARCHAR(500) NULL,
            `user_id` VARCHAR(100) NULL,
            PRIMARY KEY (id), 
            INDEX question_id (question_id), 
            INDEX question_type (question_type) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE assessment_questions";
        $db->_dbh->exec($SQL);
    }
}
