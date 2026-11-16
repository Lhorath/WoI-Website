<?php

/**
 * Legacy-compatible facade for the extracted MVC layout templates.
 *
 * Existing pages can continue calling Structure methods while the markup
 * itself is maintained under app/Views/layouts.
 */

require_once dirname(__DIR__) . '/app/bootstrap.php';

class Structure
{
    public function Header($extra_info = '')
    {
        \\WoI\\Core\\View::render('layouts/header', array('extra_info' => $extra_info));
    }

    public function Top_Menu($page = '')
    {
        \\WoI\\Core\\View::render('layouts/navbar', array('active_page' => $page));
    }

    public function Title_Bar($title_text = '', $type = '')
    {
        \\WoI\\Core\\View::render('layouts/title-bar', array(
            'title_text' => $title_text,
            'title_type' => $type
        ));
    }

    public function UserInfo($type = '')
    {
        \\WoI\\Core\\View::render('layouts/user-info', array('info_type' => $type));
    }

    public function Footer()
    {
        \\WoI\\Core\\View::render('layouts/footer');
    }
}
