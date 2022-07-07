<?php

declare(strict_types=1);

/**
 * Class n0002_user_sessions
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n0002_user_sessions
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE user_sessions ( 
            id INT NOT NULL AUTO_INCREMENT,
            user_id INT NULL,
            hash VARCHAR(50) NULL,
            PRIMARY KEY (id), 
            INDEX user_id (user_id), 
            INDEX hash (hash)
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE user_sessions;";
        $db->_dbh->exec($SQL);
    }
}
