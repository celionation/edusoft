<?php

declare(strict_types=1);

/**
 * Class n00017_answered_assessment
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n00017_answered_assessment
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE answered_assessment ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `assessment_id` VARCHAR(100) NULL,
            `roll_no` VARCHAR(100) NULL,
            `matriculation_no` VARCHAR(100) NULL,
            `submitted` VARCHAR(30) NOT NULL DEFAULT 'no',
            `submitted_date` DATETIME NULL ,
            `marked` VARCHAR(30) NOT NULL DEFAULT 'no',
            `marked_by` VARCHAR(100) NULL,
            `marked_date`DATETIME NULL,
            PRIMARY KEY (id), 
            INDEX assessment_id (assessment_id), 
            INDEX roll_no (roll_no), 
            INDEX matriculation_no (matriculation_no), 
            INDEX submitted (submitted), 
            INDEX marked_by (marked_by) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE answered_assessment";
        $db->_dbh->exec($SQL);
    }
}
