<?php
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');

require_once APP_PATH . '/Core/Router.php';

$actualServer = null;
$router = new \WoI\Core\Router();
$router->any('/online/{server}', function ($server) use (&$actualServer) {
    $actualServer = $server;
});

$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = '/online/12/?view=all';
$router->dispatch();

if ($actualServer !== '12') {
    fwrite(STDERR, "Router smoke test failed: expected route parameter 12.\n");
    exit(1);
}

echo "Router smoke test passed.\n";
