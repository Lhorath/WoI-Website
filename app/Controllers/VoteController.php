<?php
namespace WoI\Controllers;

class VoteController extends LegacyController
{
    public function index() { $this->renderLegacy('vote/index.php'); }
    public function rewards() { $this->renderLegacy('vote/rewards.php'); }
}
