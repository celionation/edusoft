<?php

declare(strict_types=1);

/**
 * Class n0003_roles
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @package Laraton Migrations
 * @version 1.0.0
 * @copyright 2022 Laraton
 */

class n0003_roles
{
    public function up()
    {
        $db = \core\Application::$app->db;
        $SQL = "CREATE TABLE roles ( 
            id INT NOT NULL AUTO_INCREMENT,
            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME NULL ,
            role_id VARCHAR(60) NULL,
            `role` VARCHAR(50) NULL,
            `doctype` VARCHAR(100) NULL,
            `read` TINYINT(1) NOT NULL DEFAULT '0',
            `write` TINYINT(1) NOT NULL DEFAULT '0',
            `delete` TINYINT(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (id), 
            INDEX role_id (role_id), 
            INDEX role (role)
            ) ENGINE = InnoDB;";
        $db->_dbh->exec($SQL);
    }

    public function down()
    {
        $db = \core\Application::$app->db;
        $SQL = "DROP TABLE roles";
        $db->_dbh->exec($SQL);
    }
}
