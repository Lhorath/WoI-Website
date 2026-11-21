<?php

/**
 * @author megosh
 * @copyright 2010
 */

//root dir function to allow easy calling from any subdir - must be here because this is the first file called
function GetRootDir()
{
    $rootaccess = "";
    $i = 1;
    while ($i < substr_count($_SERVER['PHP_SELF'],"/")) 
    {
        $rootaccess .= "../";
        $i++;
    }
    return $rootaccess;
}

//=========================================================================
//   OBJECT AND DIRECTORY SETTINGS
//=========================================================================	
	
	$config['main_dir']				    = ""; // folder path from root to the site ex: "test/" (leave blank if in root)
    $config['root_dir']                 = GetRootDir().$config['main_dir'];
	$config['cache_dir']				= $config['root_dir']."utility/cache/"; // Cache directory's adress
	$config['debug_log_dir']			= $config['root_dir']."utility/logs/"; // debug log directory
	$config['img_dir'] 					= $config['root_dir']."utility/images/"; // Image directory's adress
	$config['js_dir'] 					= $config['root_dir']."utility/js/"; // JavaScript directory's adress
	$config['css_dir'] 					= $config['root_dir']."utility/css/"; // CSS directory's adress
    $config['swf_dir']                  = $config['root_dir']."utility/swf/"; // SWF directory's adress
	$config['onpic'] 					= "online.png"; // online img
	$config['offpic']					= "offline.png"; // offline img
	$config['text_or_pic']				= "1";	// Use text: "OFFLINE" or pic (text=1, pic=0)
	$config['offline_text']				= "<font color='RED'>OFFLINE</font><br />"; //offline text, html included
	$config['online_text']				= "<font color='GREEN'>ONLINE</font><br />"; //online text, html included

//=========================================================================
//   GENERAL SETTINGS
//=========================================================================	
	
    $config['game_version']             = "3.3.5a";
	$config['online_count'] 			= true; //Show # of players online on all pages else "Disabled"
	$config['online_count_cache_timer']	= "300"; //time interval between cache update query for $config['online_count'] 
	$config['show_online_list'] 		= true; //Show online list on "online.php"
	$config['online_list_cache_timer']	= "300"; //time interval between cache update query for $config['show_online_list'], also uptime function
	$config['acc_create'] 				= true; //account creation enabled/disabled
	$config['acc_min_chars_pass']		= "4"; // min # of chars in pass
	$config['acc_min_chars_username']	= "4"; // min # of chars in username
	//$config['acc_create_ip_limit']		= "0"; //max # of accts per IP. 0=disabled  NOT USED
	$config['acc_create_lock']			= "0"; // Lock a IP adress to account (1 - on, 0 - off)
    $config['news_limit']               = "99"; // Max number of news blobs to be shown on the main page
	$config['num_arena_teams']          = "50";
    $config['website_offline']          = false; //true false "We'll be right back!" page displayed instead of content
    $config['item_quality_colours']     = array(0 => '9d9d9d', 1 => 'ffffff', 2 => '1eff00', 3 => '0070dd', 4 => 'a335ee', 5 => 'ff8000', 6 => 'e5cc80', 7 => 'e5cc80', 8 => 'ffff98');

//=========================================================================
//   DATABASE, STATUS, SOCKET AND RA SETTINGS
//=========================================================================

    //mysql settings
	$config['host'] 					= "127.0.0.1";	//if local must be 127.0.0.1, not localhost for online check
	$config['user'] 					= "site";		
	$config['pass'] 					= "E4PJ1H";	
	$config['realm_db'] 				= "auth";
    $config['port']                     = "3306";
	$config['blizz_char_db'] 			= "b_char";
	$config['blizz_world_db'] 			= "blizz_world2";
	$config['pvp_char_db'] 				= "f_char";
	$config['pvp_world_db'] 			= "fun_new_test";
	$config['dev_char_db'] 				= "f_char";
	$config['dev_world_db'] 			= "fun_new_test";
    $config['site_db']                  = "site";
	$config['blizz_char_backup_db']		= "i_char_backup";
    $config['vp_item_db']               = "blizz_world";
    $config['dn_item_db']               = "blizz_world";
    
    //remote access
    $config['ra_host']                  = "127.0.0.1";
    $config['ra_username']              = "RA"; // must be CAPS
    $config['ra_pass']                  = "ra";
    $config['ra_blizz_port']            = "3445";
    $config['pvp_ra_port']              = "";
    
    //socket settings
	$config['dev_world_port']			= "7000";
	$config['pvp_world_port']			= "7003";
	$config['blizz_world_port']			= "7002";
	
//=========================================================================
//   VOTE SETTINGS
//=========================================================================	

	$config['reg_point_per_vote'] 		= "1"; 
	$config['bonus_point_per_vote']		= "2";
	$config['votelogname']				= "vote_error.log";
	$config['bonus_days_duration']		= "7"; // # of days after xtreme reset duration of bonus
    $config['vote_cooldown_duration']   = "43200"; //(seconds) /3600 = hours
    $config['vote_cooldown_offset']     = "3600"; //(seconds) 1 hour ovelap where people can still use the telenpc and can still vote
	
	$config['vote_sites'] = // bit_value (1,2,4,8,16... etc) => (site_name, site_url, site_pic_url, array_id)
        //using this system allows us to add and remove vote sites easily without major changes to the code
        //all images must be cnverted to jpg and saved on the server. /utility/function_grey_image.php can convert it to greyscale
        //grey images must have "grey_" infront of the image name in order for it to display correctly.
        Array(
            1	=> Array("XtremeTop100","http://www.xtremetop100.com/in.php?site=1132287808", "xtremetop100.jpg", '1'),
            2	=> Array("Gamestop Top 100","http://www.gtop100.com/in.php?site=36732", "gtop100.jpg", '2'),
            4	=> Array("Top Game Sites","http://topg.org/in-345618", "topg.jpg", '4')
            );
            
//=========================================================================
//   VOTE PANEL SETTINGS
//=========================================================================	

    //db specific
    $config['vp_item_table']            = "vote_items";
    //search filters, limits and settings
    $config['vp_min_char_search']       = "3";
    $config['vp_max_char_search']       = "20";
    $config['vp_max_results']           = "50";
    $config['vp_min_entry']             = "1";
    $config['vp_max_entry']             = "60000";
    $config['vp_max_item_level']        = "252";
    $config['vp_max_item_quality']      = "5";
    //item cost
    $config['vp_item_lowest_price']     = "5";
    $config['vp_item_point_multiple']   = "0.133";
    //mail settings
    $config['vp_mail_subject']          = "Voting Reward";
    $config['vp_mail_contents']         = "Here is your voting reward!\n\nThank you for choosing World of Immortality!"; //a new line is represented by \n
    
//=========================================================================
//   DONATION PANEL SETTINGS
//=========================================================================	

    $config['dn_item_table']            = "donation_items";
    $config['dn_min_char_search']       = "3";
    $config['dn_max_char_search']       = "20";
    $config['dn_max_results']           = "50";
    $config['dn_min_entry']             = "1";
    $config['dn_max_entry']             = "60000";
    $config['dn_max_item_level']        = "233";
    $config['dn_max_item_quality']      = "5";
    //item cost
    $config['dn_item_lowest_price']     = "5";
    $config['dn_item_point_multiple']   = "0.166";
    //mail settings
    $config['dn_mail_subject']          = "Donation Reward";
    $config['dn_mail_contents']         = "Here is your donation reward!\n\nThank you for choosing World of Immortality!"; //a new line is represented by \n
    $config['dn_coin_prices'] = // bit_value (1,2,4,8,16... etc) => (Name, Number of coins, Cost in $USD, array_id)
        Array(
            1	=> Array("10 Immortal Coins", "10", "10", '1'),
            2	=> Array("20 Immortal Coins", "20", "20", '2'),
            4	=> Array("40 Immortal Coins", "40", "40", '4'),
            8	=> Array("60 Immortal Coins", "60", "55", '8'),
            16   => Array("80 Immortal Coins", "80", "70", '16'),
            32  => Array("105 Immortal Coins", "100", "90", '32'),
            64  => Array("120 Immortal Coins", "120", "100", '64'),
            128  => Array("140 Immortal Coins", "140", "115", '128'),
            256  => Array("160 Immortal Coins", "160", "130", '256')
            );
    
//=========================================================================
//   PAYPAL SETTINGS
//=========================================================================	

    $config['paypal_url']               = "https://www.paypal.com/cgi-bin/webscr";//https://www.paypal.com/cgi-bin/webscr
    $conifg['paypal_socket_url']        = "www.paypal.com";
    $config['paypal_postback_url']      = "http://68.168.100.76/sero/donate/postback.php"; //http://worldofimmortality.servegame.org/donate/postback.php
    $config['paypal_email']             = "xxjustsurfinxx@aol.com";
    $config['paypal_currency']          = "USD";
	
//=========================================================================
//   DEBUG SETTINGS
//=========================================================================	

	$config['debug'] 					= false;
	$config['debug_qry'] 				= false;
	
?> 