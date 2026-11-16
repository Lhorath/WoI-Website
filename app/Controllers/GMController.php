<?php
namespace WoI\Controllers;

class GMController extends LegacyController
{
    public function index() { $this->renderLegacy('gm/index.php'); }
    public function banchecker() { $this->renderLegacy('gm/banchecker.php'); }
    public function donation() { $this->renderLegacy('gm/donation.php'); }
    public function instance() { $this->renderLegacy('gm/instance.php'); }
    public function instanceBlizzOnly() { $this->renderLegacy('gm/instance_blizzonly.php'); }
    public function passchange() { $this->renderLegacy('gm/passchange.php'); }
    public function promo() { $this->renderLegacy('gm/promo.php'); }
    public function vote() { $this->renderLegacy('gm/vote.php'); }
}
