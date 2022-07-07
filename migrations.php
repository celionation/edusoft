<?php

//define constant
use core\Application;
use core\Config;


require __DIR__ . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$config = [
    'db' => [
        'drivers' => Config::get('DB_DRIVERS') ?? 'mysql',
        'host' => Config::get('DB_HOST'),
        'port' => Config::get('DB_PORT'),
        'database' => Config::get('DB_DATABASE'),
        'username' => Config::get('DB_USERNAME'),
        'password' => Config::get('DB_PASSWORD'),
        'activate' => Config::get('DB_ACTIVATE'),
    ]
];

// Initialize the Application
try {
    $app = new Application(__DIR__, $config);
} catch (Exception $e) {
    echo $e;
}

$app->db->applyMigrations();