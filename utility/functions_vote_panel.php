<?php

/**
 * @author megosh
 * @copyright 2010
 */
 
require_once ('header.php');

function findItems($string, $type)
{
    global $config;

    $string = stripslashes($string);

    echo "<font color='grey'>Search Results for \"</font><font color=orange>".$string."</font><font color=grey>\"</font><br/>";

    if (empty($string))
    {
        echo 'Your search string was empty.<br/>';
        return;
    }
    if (strlen($string) < $config[$type.'_min_char_search'])
    {
        echo 'Your search string needs to have a size of at least ' . $config[$type.'_min_char_search'] . ' characters.<br/>';
        return;
    }
    if (strlen($string) > $config[$type.'_max_char_search'])
    {
        echo 'Your search string exceeded the maximum size of ' . $config[$type.'_max_char_search'] . ' characters.<br/>';
        return;
    }
    $string = mysql_real_escape_string($string);

    $qry = "SELECT `entry`,`name`,`Quality`, `ItemLevel` FROM `".$config[$type.'_item_table']."` WHERE `Quality` < '".$config[$type.'_max_item_quality'] ."' AND `name` LIKE '%$string%' AND !(`entry` < '".$config[$type.'_min_entry']."')
                AND !(`entry` > '".$config[$type.'_max_entry']."') AND `ItemLevel` < '".$config[$type.'_max_item_level']."' ORDER BY `ItemLevel` DESC LIMIT ".$config[$type.'_max_results'].";";
    $d = new db($config[$type.'_item_db']);
    $data = $d->fetch($qry);

    return $data;
}

function getItems($db_result, $type)
{
    global $config;
    $items = array();
    $i = 0;
    if(!$db_result)
        return;
    foreach ($db_result as $row)
    {
        $ilevel_cost = $row['ItemLevel']*$config[$type.'_item_point_multiple'];
        if ($ilevel_cost <= $config[$type.'_item_lowest_price'])
            $ilevel_cost =  $config[$type.'_item_lowest_price'];
        $item = new Item;
        $item->entry = $row['entry'];
        $item->item_name = $row['name'];
        $item->item_quality = $row['Quality'];
        $item->item_cost = round($ilevel_cost);
        $item->item_level = $row['ItemLevel'];
        $items[$i] = $item;
        $i++;
    }

    return $items;
}

function ShowItems($items, $items_found, $type)
{
    global $config;
    if ($type == 'vp')
        $currency = getVotePoints();
    else
        $currency = getImmortalCoins();
    echo '<table align="center" cellspacing="0">
            <tr>
                <th>Item name</th>
                <th>Voting points</th>
                <th>Choose</th>
            </tr>';
    //For each item
    $i=0;
    while ($i < $items_found)
    {//Remove target="_blank" when CSS3 is up
        $background_color = "#383838";
        if ($i%2 != 0)
        {
            $background_color = "#606060";
        }
        echo  '<tr style="background-color:' . $background_color . '">
                    <td><a href="http://www.wowhead.com/?item=' . $items[$i]->entry . '" style="color:#' . $config['item_quality_colours'][$items[$i]->item_quality] . '" target="_blank" onclick="return false;">[' . $items[$i]->item_name . ']</a></td>
                    <td><a style="color:orange">' . $items[$i]->item_cost . ' Points</a></td>
                    <td style="font-size:0px;">
                        <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
                            <input type="hidden" name="secret_itemsubmit" value="' . $items[$i]->entry . '"/>
                            <input type="submit" value="Choose" ';
        if ($currency < $items[$i]->item_cost)
        {
            echo			' DISABLED';
        }
        echo 				'/>
                        </form>
                    </td>
                </tr>';
        $i++;
    }

    echo '</table>';
}

function setItem($item_entry, $type)
{
    global $config;
    $item_entry = intval($item_entry);

    //sanitize entry
    if ($item_entry < $config[$type.'_min_entry'] || $item_entry > $config[$type.'_max_entry'])
        return false;

    $qry = "SELECT `entry`,`name`,`Quality`, `ItemLevel` FROM `".$config[$type.'_item_table']."` WHERE `entry`='".$item_entry."' LIMIT 1;";
    $d = new db($config[$type.'_item_db']);
    $data = $d->fetch($qry);
    if(!$data)
        return false;

    foreach($data as $row)
    {
        $ilevel_cost = $row['ItemLevel']*$config[$type.'_item_point_multiple'];
        if ($ilevel_cost <= $config[$type.'_item_lowest_price'])
            $ilevel_cost =  $config[$type.'_item_lowest_price'];
        $item = new Item;
        $item->entry = $row['entry'];
        $item->item_name = $row['name'];
        $item->item_quality = $row['Quality'];
        $item->item_cost = round($ilevel_cost);
        $item->item_level = $row['ItemLevel'];

        //sanitize the item's stats
        if ($item->item_level > $config[$type.'_max_item_level'] || $item->item_quality > $config[$type.'_max_item_quality'] || $item->entry > $config[$type.'_max_entry'])
            return false;

        return $item;
    }
}

class Item
{
	public $entry;
	public $item_name;
	public $item_quality;
	public $item_cost;
	public $item_level;

    public function Reward($type)
    {
        global $config;
        if ($type == 'vp')
        {
            $currency = getVotePoints();
            $currency_table = 'voting_points';
            $currency_field = 'points';
            $xyz_for = 'voted_for';
        }
        else
        {
            $currency = getImmortalCoins();
            $currency_table = 'donation_coins';
            $currency_field = 'coins';
            $xyz_for = 'donated_for';
        }
        if ($currency >= $this->item_cost && getcharguid())
        {
            $d = new db($config['realm_db']);
            $charge = $d->exec("UPDATE `$currency_table` SET `$currency_field`=(`$currency_field` - ".$this->item_cost.") WHERE `id`='".getuserid()."'");
            if (!$charge)
            {
                echo "Could not charge this account. Aborting.<br>";
                return false;
            }
            $time = date("Y-m-d H:i:s");
            $xyzated_for_insert = $d->exec("INSERT INTO $xyz_for (acc_id, char_name, date, item, num_of_item) VALUES ('".getuserid()."', '".getcharname()."', '$time', '".$this->entry."', '1') ");
            $c = new db(getchardb());
            $mail_insert = $c->exec("INSERT INTO mail_external (receiver, subject, message) VALUES ('".getcharguid()."', '".$config[$type.'_mail_subject']."', '".$config[$type.'_mail_contents']."') ");
			if ($mail_insert)
				$mail_item_insert = $c->exec("INSERT INTO mail_external_items (mail_id, item, count) VALUES ('".$c->last_id."', '".$this->entry."', '1')");
            if ($xyzated_for_insert)
                return $d->last_id;
        }
        else
            return false;
    }
	
	/*public function Reward($type)
    {
        global $config;
        if ($type == 'vp')
        {
            $currency = getVotePoints();
            $currency_table = 'voting_points';
            $currency_field = 'points';
            $xyz_for = 'voted_for';
        }
        else
        {
            $currency = getImmortalCoins();
            $currency_table = 'donation_coins';
            $currency_field = 'coins';
            $xyz_for = 'donated_for';
        }
        if ($currency >= $this->item_cost && getcharguid())
        {
            $d = new db($config['realm_db']);
            $charge = $d->exec("UPDATE `$currency_table` SET `$currency_field`=(`$currency_field` - ".$this->item_cost.") WHERE `id`='".getuserid()."'");
            if (!$charge)
            {
                echo "Could not charge this account. Aborting.<br>";
                return false;
            }
            $time = date("Y-m-d H:i:s");
            $xyzated_for_insert = $d->exec("INSERT INTO $xyz_for (acc_id, char_name, date, item, num_of_item) VALUES ('".getuserid()."', '".getcharname()."', '$time', '".$this->entry."', '1') ");
            $c = new db(getchardb());
            $mail_insert = $c->exec("INSERT INTO mail_external (receiver, subject, message, item, item_count) VALUES ('".getcharguid()."', '".$config[$type.'_mail_subject']."', '".$config[$type.'_mail_contents']."', '".$this->entry."', '1') ");
            if ($xyzated_for_insert)
                return $d->last_id;
        }
        else
            return false;
    }*/

    public function Reward_telenet()
    {
        global $config;
		$telnet = @fsockopen($config['ra_host'], $config['ra_blizz_port'], $errno, $errstr, 3);
		if($telnet)
		{
			fgets($telnet,1024);
			$send1 = fputs($telnet, "USER " . $remote[2] . "\n");
			sleep(3);
			$send2 = fputs($telnet, "PASS " . $remote[3] . "\n");
			sleep(3);
			if(($send1) && ($send2) && (fgets($telnet,1024) <> ""))
			{
				if(getVotePoints() >= $this->item_cost)
				{
					$send3 = fputs($telnet, "send items " . $this->character . " \"".$config[$type.'_mail_subject']."\" \"".$config[$type.'_mail_contents']."\" " . $this->entry . ":1\n");
					sleep(5);
					if($send3)
					{
                        $qry = "UPDATE `voting_points` SET `points`=(`points` - ".$this->item_cost.") WHERE `id`='".getuserid()."'";
                        $d = new db($config['realm_db']);
                        $d->exec($qry);
						$time = date("Y-m-d H:i:s");
						$qry = "INSERT INTO voted_for (acc_id, char_name, date, item, num_of_item) VALUES ('$this->user_id', '$this->character', '$time', '$this->entry ', '1') ";
                        $data = $d->exec($qry);
						echo '<center><font color="lightgreen" size="4">' . $this->item_name . ' was given to ' . $this->character . ' for ' .$this->item_cost. ' voting points.</font></center><br/>';
					}
				}
			}
			@fclose($telnet);
        }
        if ($data)
            return $d->last_id;
    }
}
?>