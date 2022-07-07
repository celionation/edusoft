<?php

declare(strict_types=1);

/**
 * Class n0006_departments
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n0006_departments
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE departments ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `department_id` VARCHAR(10) NULL,
            `department` VARCHAR(100) NULL,
            `faculty` VARCHAR(100) NULL,
            PRIMARY KEY (id), 
            INDEX department (department) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE departments";
        $db->_dbh->exec($SQL);
    }
}
