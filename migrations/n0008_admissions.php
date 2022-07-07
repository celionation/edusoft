<?php

declare(strict_types=1);

/**
 * Class n0008_admissions
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n0008_admissions
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE admissions ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `ref_no` VARCHAR(20) NOT NULL,
            `degree` VARCHAR(6) NOT NULL,
            `matriculation_no` VARCHAR(20) NOT NULL,
            `jamb_reg_no` VARCHAR(20) NULL,
            `entry_mode` VARCHAR(10) NULL DEFAULT 'jamb',
            `faculty` VARCHAR(100) NOT NULL,
            `department` VARCHAR(100) NOT NULL,
            `course` VARCHAR(100) NOT NULL,
            `course_duration` VARCHAR(10) NOT NULL,
            `surname` VARCHAR(100) NOT NULL,
            `firstname` VARCHAR(100) NOT NULL,
            `lastname` VARCHAR(100) NOT NULL,
            `email` VARCHAR(200) NOT NULL,
            `phone` VARCHAR(20) NOT NULL,
            `dob` DATETIME NULL,
            `martial_status` VARCHAR(10) NOT NULL,
            `guardian_name` VARCHAR(100) NULL,
            `guardian_phone` VARCHAR(20) NULL,
            `kin_name` VARCHAR(100) NULL,
            `kin_phone` VARCHAR(20) NULL,
            `kin_email` VARCHAR(200) NULL,
            `result_file` VARCHAR(300) NULL,
            `dob_file` VARCHAR(300) NULL,
            PRIMARY KEY (id), 
            INDEX ref_no (ref_no), 
            INDEX matriculation_no (matriculation_no), 
            INDEX faculty (faculty), 
            INDEX departments (departments), 
            INDEX course (course), 
            INDEX surname (surname), 
            INDEX entry_mode (entry_mode), 
            INDEX degree (degree) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE admissions";
        $db->_dbh->exec($SQL);
    }
}
