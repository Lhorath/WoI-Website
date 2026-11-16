<?php
namespace WoI\Controllers;

class StatusController extends LegacyController
{
    public function index() { $this->renderLegacy('status.php'); }
    public function arena() { $this->renderLegacy('arena.php'); }

    public function online($server)
    {
        if (!ctype_digit((string) $server)) {
            (new ErrorController())->notFound();
            return;
        }
        $_GET['svr'] = (string) $server;
        $_REQUEST['svr'] = (string) $server;
        $this->renderLegacy('online.php');
    }
}
