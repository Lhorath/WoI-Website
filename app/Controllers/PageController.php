<?php
namespace WoI\Controllers;

class PageController extends LegacyController
{
    public function about() { $this->renderLegacy('about.php'); }
    public function connect() { $this->renderLegacy('connect.php'); }
    public function contact() { $this->renderLegacy('contact.php'); }
    public function faq() { $this->renderLegacy('faq.php'); }
    public function rules() { $this->renderLegacy('tos.php'); }
    public function terms() { $this->renderLegacy('tos.php'); }
    public function vent() { $this->renderLegacy('vent.php'); }
}
