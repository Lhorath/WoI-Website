<?php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}
if (!defined('APP_PATH')) {
    define('APP_PATH', ROOT_PATH . '/app');
}

require_once APP_PATH . '/Core/Environment.php';
\WoI\Core\Environment::load(ROOT_PATH . '/.env');

$timezone = \WoI\Core\Environment::get('APP_TIMEZONE', 'UTC');
if (in_array($timezone, timezone_identifiers_list(), true)) {
    date_default_timezone_set($timezone);
}

spl_autoload_register(function ($className) {
    $prefix = 'WoI\\';
    if (strncmp($className, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $relative = substr($className, strlen($prefix));
    $file = APP_PATH . '/' . str_replace('\\', '/', $relative) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

$GLOBALS['appConfig'] = require ROOT_PATH . '/config/app.php';
$GLOBALS['databaseConfig'] = require ROOT_PATH . '/config/database.php';
