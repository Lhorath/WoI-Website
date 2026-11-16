<?php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__, 2));
}
if (!defined('APP_PATH')) {
    define('APP_PATH', ROOT_PATH . '/app');
}

$previousDirectory = getcwd();
chdir(ROOT_PATH);
require_once ROOT_PATH . '/includes.php';

if ($previousDirectory !== false) {
    chdir($previousDirectory);
}
