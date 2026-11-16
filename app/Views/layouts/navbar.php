<?php
require_once APP_PATH . '/Legacy/bootstrap.php';

if (!isset($structure) || !($structure instanceof \Structure)) {
    $structure = new \Structure();
}

$structure->Top_Menu(isset($activePage) ? $activePage : '');
