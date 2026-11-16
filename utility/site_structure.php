<?php

/**
 * @author megosh
 * @copyright 2010
 */

require_once('header.php');

//Each definition is the code for each section of the site

//Only use apostraphies, never quotation marks unless escaped or matched with a period

/**********************************************************/
/*** 					GLOBAL CODE						***/
/**********************************************************/

class Structure
{
    function Header($extra_info = '')
    {
        global $config;
        
        $text = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <title>World of Immortality | The best in Private Server Emulation</title>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <link href='".$config['css_dir']."style.css' rel='stylesheet' type='text/css' />
        <script type='text/javascript' src='".$config['js_dir']."swfobject.js'></script>
        <script type='text/javascript' src='".$config['js_dir']."woi.js'></script>
        ".$extra_info."
    </head>
    <body>
        <div align='right'>
            ".send_login()."&nbsp;&nbsp;&nbsp;
        </div>
        <br />";
        echo $text;
    }
	//<script src='http://static.wowhead.com/widgets/power.js' type='text/javascript'></script>
    
    function Top_Menu($page = '')
    {
        global $config;
        
        // these two lines handle which menu button is 'active'
        // on each page $structure->Top_Menu(); is called. between the brackets, place the page name. EX:
        // $structure->Top_Menu('index'); for index.php. $structure->Top_Menu('ucp'); for ucp.php
        // look below for each specific name
        if ($page)
            $page_index[$page] = "class='active'";
        
        $text = "<div class='main'>
            <div class='blok_header'>
                <div class='header'>
                    <div class='logo'>
                        <a href='index.php'><img src='".$config['img_dir']."toplogo.png' width='169' height='99' border='0' alt='logo' /></a>
                    </div>
                    <div class='menu'>
                        <ul>
                            <li><a href='".$config['root_dir']."index.php' ".$page_index['index']."><span>Home</span></a></li>
                            <li><a href='".$config['root_dir']."connect.php' ".$page_index['connect']."><span>Connection Guide</span></a></li>
                            <li><a href='".$config['root_dir']."register.php' ".$page_index['register']."><span>Create Account</span></a></li>
                            <li><a href='".$config['root_dir']."forums/'<span>Community Forums</span></a></li>
                            <li><a href='".$config['root_dir']."vote/index.php' ".$page_index['vp']."><span>Vote for Us</span></a></li>
                            <li><a href='".$config['root_dir']."donate/index.php' ".$page_index['donate']."><span>Donation Panel</span></a></li>
                            <li><a href='".$config['root_dir']."account/index.php' ".$page_index['ucp']."><span>Player Tools</span></a></li>
                        </ul>
                        <div class='clr'></div>
                    </div>
                    <div class='clr'></div>
                </div>
                <div class='clr'></div>
            </div>
            <div class='clr'></div>";
            
        echo $text;
    }
    
    function Title_Bar($title_text = '', $type = '')
    {
        global $config;
        
        switch($type)
        {
            case 'front_page':
            
                $text = "<div class='header_text_bg'>
                <div class='header_text'>
                    <h2>
                        <font size='5' color='white'>World of Immortality </font><font color='gray' size='5'>| </font><font size='4'>Setting a new standard for private server emulation.</font><br /><span></span>
                    </h2>
                    <div class='clr'></div>
                </div>
                <div class='cu3er_resize'>
                    <div id='cu3er-container'>
                        <a href='http://www.adobe.com/go/getflashplayer'> <img src='http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>
                    </div>
                </div>
                <div class='clr'></div>
            </div>";
            
            break;
            default:
                $text = "<div class='header_text_bg2'>
                <div class='header_text2'>
                    ".$title_text."
                    <div class='clr'></div>
                </div>
                <div class='clr'></div>
            </div>";
            break;
        }
            
        echo $text;
    }
    
    function UserInfo($type = '')
    {
        global $config;
        
        $text = "<div class='right'>
            <b><a href='".$config['root_dir']."account/index.php'><font size='5'>User Info</font></a></b>
            <br />
            <br />
            <div class='clr'></div>";
        
        if (getuserid()) //only show user information if they are logged in.
        {
            $text .= "<p><a href='".$config['root_dir']."account/index.php'>".getaccount()."'s</a> last login was ".get_last_login().".</p>
                <p><strong>Vote Points</strong><br />
                <a href='".$config['root_dir']."account/index.php'>".getaccount()."</a> has <a href='".$config['root_dir']."vote/rewards.php'>".getVotePoints()." Vote Points.</a></p>
                <p><strong>Immortal Coins</strong><br />
                <a href='".$config['root_dir']."account/index.php'>".getaccount()."</a> has <a href='".$config['root_dir']."donate/history.php'>".getImmortalCoins()." Immortal Coins.</a></p>";
        }
        else //they arent logged in
        {
            $text .= "You must log in to see user data.";
        }
        //continue UserInfo 
        $text .= "<div class='clr'></div>
            <p>&nbsp;</p>
            <h2>Quick Links</h2>";
            
        switch ($type) //quick switch to show different quick links for each page called by $structure->UserInfo('type'); on each page more types can be added if needed.
        {
            default:
                $text .= "<li><a href='".$config['root_dir']."account/index.php'>User Control Panel</a></li>
                    <li><a href='".$config['root_dir']."vote/index.php'>Vote For Us</a></li>
                    <li><a href='".$config['root_dir']."vote/rewards.php'>Vote Rewards</a></li>
                    <li><a href='".$config['root_dir']."donate/index.php'>Donate</a></li>
                    <li><a href='".$config['root_dir']."donate/packages.php'>Donation Packages</a></li>";
            break;
            case 'donate_block':
                $text .= "<li><a onclick='show_alert()' href='#'>Donate</a></li>
                    <li><a onclick='show_alert()' href='#'>My Donation History</a></li>
                    <li><a onclick='show_alert()' href='#'>Donation Packages</a></li>";
            break;
        }
        $text .= "<br />
            <h2>Important Reminders</h2>
            <p>
            <strong>Account Security</strong><br />
            Remember, you are responsible for anything that happens on your account. NEVER give anyone your password. <br /><br />World of Immortality staff will not ask for your password for any reason. <br /><br />
            </p>
            <p>
            <strong>Donation Reminder</strong><br />
            Remember, you can use the Character Wishlist in the Donation Panel to customize a donation package even if you haven't donated yet.<br /><br /><br />
            </p>
            </div>";
        echo $text;
    }
    
    function Footer()
    {
        global $config;
        
        $text = "</div>
        <div class='FBG'>
            <div class='FBG_resize'>
                <div class='left'>
                    <h2>Getting Started </h2>
                    <ul>
                    <li><a href='".$config['root_dir']."connect.php'>Connection Guide</a></li>
                    <li><a href='".$config['root_dir']."register.php'>Create an Account</a></li>
                    <li><a href='".$config['root_dir']."tos.php'>Server Rules</a></li>
                    <li><a href='".$config['root_dir']."utility/launcher.zip'>Launcher</a></li>
                    </ul>
                </div>
                <div class='left'>
                    <h2>Player Tools</h2>
                    <ul>
                    <li><a href='".$config['root_dir']."vote/index.php'>Vote Panel</a></li>
                    <li><a href='".$config['root_dir']."donate/index.php'>Donation Panel</a></li>
                    <li><a href='".$config['root_dir']."account/teleport.php'>Offline Teleport</a></li>
                    <li><a href='".$config['root_dir']."account/bancheck.php'>Ban Check</a></li>
                    </ul>
                </div>
                <div class='left'>
                    <h2>Community Forums</a></h2>
                    <ul>
                    <li><a href='".$config['root_dir']."forums/forumdisplay.php?2-Server-News'>Server News</a></li>
                    <li><a href='".$config['root_dir']."forums/forumdisplay.php?17-Chatbox'>Chatbox</a></li>
                    <li><a href='".$config['root_dir']."forums/forumdisplay.php?19-General-Support'>Help and Support</a></li>
                    <li><a href='".$config['root_dir']."forums/forumdisplay.php?47-Support'>Reports and Appeals</a></li>
                    </ul>
                </div>
                <div class='left'>
                    <h2>Server Status</h2>
                    <ul>
                    <li><a href='".$config['root_dir']."status.php'>Players Online</a></li>
                    <li><a href='".$config['root_dir']."arena.php?svr=1&type=2'>Arena Ladder</a></li>
                    <li><a href='".$config['root_dir']."forums/forumdisplay.php?5-Changelogs'>Changelogs</a></li>
                    <li><a href='".$config['root_dir']."status.php'>Realm Info</a></li>
                    </ul>
                </div>
                    <div class='left'>
                    <h2>Contact Us </h2>
                    <ul>
                    <li><a href='".$config['root_dir']."forums/forumdisplay.php?19-General-Support'>Support Forums</a></li>
                    
                    <li><a href='".$config['root_dir']."forums/forumdisplay.php?54-Bugs'>Report a Bug</a></li>
                    <li><a href='".$config['root_dir']."contact.php'>Contact our Staff</a></li>
                    </ul>
                </div>
                <div class='clr'></div>
            </div>
            <div class='clr'></div>
        </div>
        <div class='footer'>
            <div class='footer_resize'>
                <center><strong><font color='#999999' face='arial' size='2'>All content &copy; 2009-2011 World of Immortality. All rights reserved.</font></strong></center></a>
                <div class='clr'></div>
            </div>
            <div class='clr'></div>
        </div>
		<script src='http://www.wowhead.com/widgets/power.js'>
    </body>
</html>";
    echo $text;
    }    
}
?>