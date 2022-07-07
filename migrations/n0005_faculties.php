<?php

declare(strict_types=1);

/**
 * Class n0005_faculties
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n0005_faculties
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE faculties ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `faculty_id` VARCHAR(10) NULL,
            `faculty` VARCHAR(100) NULL,
            PRIMARY KEY (id), 
            INDEX faculty (faculty) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE faculties";
        $db->_dbh->exec($SQL);
    }
}
