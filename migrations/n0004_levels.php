<?php

declare(strict_types=1);

/**
 * Class n0004_levels
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n0004_levels
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE levels ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            `level` VARCHAR(50) NULL,
            PRIMARY KEY (id), 
            INDEX level (level) 
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE levels";
        $db->_dbh->exec($SQL);
    }
}
