<?php
namespace WoI\Controllers;

class DonationController extends LegacyController
{
    public function index() { $this->renderLegacy('donate.php'); }
    public function terms() { $this->renderLegacy('donate/index.php'); }
    public function donate() { $this->renderLegacy('donate/agree.php'); }
    public function history() { $this->renderLegacy('donate/history.php'); }
    public function preview() { $this->renderLegacy('donate/preview.php'); }
    public function paypal() { $this->renderLegacy('donate/paypal.php'); }
    public function postback() { $this->renderLegacy('donate/postback.php'); }
    public function packages() { $this->renderLegacy('donate/hidden/packages.php'); }
    public function agree() { $this->renderLegacy('agree.php'); }
    public function accepted() { $this->renderLegacy('accepted.php'); }
    public function cancelled() { $this->renderLegacy('cancelled.php'); }
}
