<?php

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');

require_once APP_PATH . '/Core/Environment.php';
require_once APP_PATH . '/Core/View.php';
require_once ROOT_PATH . '/utility/site_structure.php';

function send_login()
{
    return '<span id="login-fixture">Login fixture</span>';
}

function getuserid()
{
    return false;
}

$config = array(
    'css_dir' => 'css/',
    'js_dir' => 'js/',
    'img_dir' => 'images/',
    'root_dir' => '/'
);

$structure = new Structure();
ob_start();
$structure->Header('<meta name="layout-smoke" content="ok" />');
$structure->Top_Menu('index');
$structure->Title_Bar('Layout title fixture');
$structure->UserInfo();
$structure->Footer();
$html = ob_get_clean();

$checks = array(
    strpos($html, '<!DOCTYPE html') !== false,
    strpos($html, 'layout-smoke') !== false,
    strpos($html, 'login-fixture') !== false,
    strpos($html, "class='active'") !== false,
    strpos($html, 'Connection Guide') !== false,
    strpos($html, 'Layout title fixture') !== false,
    strpos($html, 'You must log in to see user data.') !== false,
    strpos($html, 'All content &copy; 2009-2011 World of Immortality.') !== false,
    strpos($html, '</html>') !== false
);

foreach ($checks as $passed) {
    if (!$passed) {
        fwrite(STDERR, "Layout smoke test failed.\n");
        exit(1);
    }
}

echo "Layout smoke test passed.\n";
