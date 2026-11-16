<?php

/**
 * @author megosh
 * @copyright 2010
 */
 
require_once ('header.php');
//=========================================================================
//   NEWS FUNCTIONS
//=========================================================================	
function show_news()
{
    global $config;
	$txt = '';
    $sql = "SELECT * FROM `news` WHERE `show`='1' ORDER BY `sort` LIMIT ".$config['news_limit'];
    $d = new db($config['site_db']);
    $data = $d->fetch($sql, $config['online_count_cache_timer'], "show_news");
    //echo $d->log;
    if (!$data)
        echo "Error Displaying News";
    else
    {
        foreach($data as $result)
        {
            //$txt.= "<br>Post ID: ".$result['post_id'];
            $txt.= "<h2>".$result['title']."<br />";
            $txt.= "<span> Posted by <font color='red'>".$result['posted_by']."</font> on ".$result['display_date']."</span>";
            $txt.= "<p>".$result['contents']."</p></h2><br />";
        }
    }
    return $txt;
}
?>