<?php

declare(strict_types=1);

/**
 * Class n00011_students
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n00011_students
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE students ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `student_id` VARCHAR(10) NOT NULL,
            `ref_no` VARCHAR(20) NOT NULL,
            `fee_amount` BIGINT NOT NULL,
            `matriculation_no` VARCHAR(20) NOT NULL,
            `degree` VARCHAR(10) NOT NULL,
            `faculty` VARCHAR(100) NOT NULL,
            `department` VARCHAR(100) NOT NULL,
            `level` VARCHAR(10) NOT NULL,
            `surname` VARCHAR(100) NOT NULL,
            `firstname` VARCHAR(100) NOT NULL,
            `lastname` VARCHAR(100) NOT NULL,
            `email` VARCHAR(200) NOT NULL,
            `phone` VARCHAR(20) NOT NULL,
            `dob` DATE NULL,
            `standing` VARCHAR(20) NULL DEFAULT 'good',
            `ass_permission` VARCHAR(20) NULL DEFAULT 'declined',
            PRIMARY KEY (id), 
            INDEX ref_no (ref_no), 
            INDEX matriculation_no (matriculation_no), 
            INDEX faculty (faculty), 
            INDEX department (department), 
            INDEX surname (surname), 
            INDEX level (level) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE students";
        $db->_dbh->exec($SQL);
    }
}