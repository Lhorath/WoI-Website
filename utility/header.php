<?php

/**
 * @author megosh
 * @copyright 2010
 */

session_start();
if (!isset($_SESSION['logged_in']))
{
    session_regenerate_id();
    $_SESSION['initiated'] = 1;
}
//This file includes all the functions into one, removing the requirement for each file to be called on each page

require_once ('settings.php');
require_once ('functions_cache.php');
require_once ('functions_universal.php');
require_once ('functions_storage.php');
require_once ('functions_player.php');
require_once ('functions_vote.php');
require_once ('functions_news.php');
require_once ('functions_session.php');
require_once ('functions_stats.php');
require_once ('functions_register.php');
require_once ('functions_gm.php');
require_once ('functions_ucp.php');
require_once ('site_structure.php');
require_once ('functions_vote_panel.php');
require_once ('functions_donation_panel.php');
require_once ('recaptchalib.php');

//offline page, true/false in confg, applies to all pages. forums and armory exempt 
if ($config['website_offline'])
{
    include_once ('errors/maintenance.php');
    die;
}
?>