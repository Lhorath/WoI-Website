<?php
namespace WoI\Controllers;

class AccountController extends LegacyController
{
    public function index() { $this->renderLegacy('account/index.php'); }
    public function bancheck() { $this->renderLegacy('account/bancheck.php'); }
    public function revive() { $this->renderLegacy('account/revive.php'); }
    public function teleport() { $this->renderLegacy('account/teleport.php'); }
    public function userdetails() { $this->renderLegacy('account/userdetails.php'); }
    public function ucp() { $this->renderLegacy('ucp.php'); }
    public function logout() { $this->renderLegacy('logout.php'); }
}
