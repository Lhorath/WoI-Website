<?php
namespace WoI\Controllers;

use WoI\Core\View;

class PageController extends LegacyController
{
    public function about() { $this->renderLegacy('about.php'); }

    public function connect()
    {
        $this->renderInformationalPage('connect', 'connect', "<h2><font size='4'>Connection Guide</font></h2>");
    }

    public function contact()
    {
        $this->renderInformationalPage('contact', 'register', "<h2><font size='4'>Account Creation</font></h2>");
    }

    public function faq()
    {
        $this->renderInformationalPage('faq', '', "<h2><font size='4'>World of Immortality - FAQ</font></h2>");
    }

    public function rules()
    {
        $this->renderInformationalPage('tos', 'register', "<h2><font size='4'>Terms of Service</font></h2>");
    }

    public function terms() { $this->rules(); }

    public function vent() { $this->renderLegacy('vent.php'); }

    /**
     * Render a migrated informational page using the shared MVC layout.
     * Legacy bootstrap is retained for its established session and helper setup.
     */
    private function renderInformationalPage($view, $activePage, $title)
    {
        require_once APP_PATH . '/Legacy/bootstrap.php';

        global $config;
        $structure = new \Structure();

        $structure->Header();
        $structure->Top_Menu($activePage);
        $structure->Title_Bar($title);

        View::render('pages/' . $view, array('config' => $config));

        $structure->Footer();
    }
}
