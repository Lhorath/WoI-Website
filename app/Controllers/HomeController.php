<?php
namespace WoI\Controllers;

class HomeController extends LegacyController
{
    public function index()
    {
        chdir(ROOT_PATH);
        require APP_PATH . '/Legacy/Pages/home.php';
    }
}
