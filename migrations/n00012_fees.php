<?php

declare(strict_types=1);

/**
 * Class n00012_fees
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n00012_fees
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE fees ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `fee_id` VARCHAR(10) NULL,
            `level` VARCHAR(10) NULL,
            `department` VARCHAR(100) NULL,
            `faculty` VARCHAR(100) NULL,
            PRIMARY KEY (id), 
            INDEX level (level), 
            INDEX department (department), 
            INDEX faculty (faculty) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE fees";
        $db->_dbh->exec($SQL);
    }
}
