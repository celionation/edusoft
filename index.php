<?php

//define constant
use core\Application;
use core\Config;
use src\models\Users;


require __DIR__ . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//const PROOT = __DIR__;
const DS = DIRECTORY_SEPARATOR;
const TimeZone = 'Africa/Lagos';

define("ROOT", Config::get('ROOT_DIR'));

require_once __DIR__ . '/config/functions.php';

error_reporting(E_ALL);
ini_set('display_errors', Config::get('APP_DEBUG'));

$config = [
    'dsn' => Config::get('MAILER_DSN') ?? '',
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

$app->on(Application::EVENT_BEFORE_REQUEST, function () {
    // echo "Before request from second installation </br>";
});

try {
    $currentUser = Users::getCurrentUser();
} catch (Exception $e) {
    echo $e;
}

$url = $_SERVER['REQUEST_URI'];
if (ROOT != '/') {
    $url = str_replace(ROOT, '', $url);
} else {
    $url = ltrim($url, '/');
}
$url = preg_replace('/(\?.+)/', '', $url);

$currentPage = $url;
$currentLink = $url;

//\core\helpers\CoreHelpers::dnd($currentPage);

require __DIR__ . '/routes/web.php';

$app->run();