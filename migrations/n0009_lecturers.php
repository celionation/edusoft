<?php

declare(strict_types=1);

/**
 * Class n0009_lecturers
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n0009_lecturers
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE lecturers ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `lecturer_id` VARCHAR(10) NOT NULL,
            `lecturer_no` VARCHAR(20) NOT NULL,
            `degree` VARCHAR(100) NOT NULL,
            `faculty` VARCHAR(100) NOT NULL,
            `department` VARCHAR(100) NOT NULL,
            `position` VARCHAR(60) NOT NULL,
            `surname` VARCHAR(100) NOT NULL,
            `firstname` VARCHAR(100) NOT NULL,
            `lastname` VARCHAR(100) NOT NULL,
            `email` VARCHAR(200) NOT NULL,
            `phone` VARCHAR(20) NOT NULL,
            `dob` DATE NULL,
            `martial_status` VARCHAR(10) NOT NULL,
            `kin_name` VARCHAR(100) NULL,
            `kin_phone` VARCHAR(20) NULL,
            `kin_email` VARCHAR(200) NULL,
            `status` VARCHAR(10) NULL DEFAULT 'active',
            PRIMARY KEY (id), 
            INDEX lecturer_id (lecturer_id), 
            INDEX lecturer_no (lecturer_no), 
            INDEX faculty (faculty), 
            INDEX department (department), 
            INDEX surname (surname), 
            INDEX position (position) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE lecturers";
        $db->_dbh->exec($SQL);
    }
}
