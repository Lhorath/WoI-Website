<?php

/**
 * @author megosh
 * @copyright 2010
 */
 

require_once ('header.php');


function show_donation_history($user = '')
{
    global $config;
    
    if (!$user)
        $user = getuserid();
    
    $rdb = new db($config['realm_db']);
    $data = $rdb->fetch("SELECT donation_log.txn_id, donation_log.account_id, date, amount, status, donation_history.comment, gear_status FROM donation_log LEFT JOIN donation_history ON donation_log.account_id = donation_history.account_id WHERE donation_log.account_id = '".$user."' ORDER BY donation_history.entry;");
    
    $counter = 1;
    if ($data)
    {
        foreach ($data as $row)
        {
            $gear_status = !$row['gear_status'] ? "Pending..." : $row['gear_status'];
            $text .= "<tr><td align='center'>".$counter."</td>
                <td>".$row['date']."</td>
                <td align='center'>".$row['amount']."</td>
                <td>".$row['comments']."</td>
                <td>".$row['status']."</td>
                <td>".$gear_status."</td>
                <td><a href='#' onclick='showhide(\"txn_id".$counter."\"); return(false);'><font color=orange>Show/Hide</font></a><div style='display: none;' id='txn_id".$counter."'> ".$row['txn_id']."</div></td>
                </tr>";
            $counter++;
        }
    }
    else
    {
        $text .= "<td colspan='7'>No Donation History...</td>";
    }
    return $text;
}

function BuildDonationForm()
{
    global $config;
    $txt = '';
    foreach ($config['dn_coin_prices'] as $key => $value)
    {
        $txt .= '<option value="' . $value[2] . '-' . $value[0] . '-' . $value[3] . '">' .
            $value[0] . ' ($' . $value[2] . ')</option>';
    }
    return $txt;
}

function load_items()
{
    global $config;
    $rdb = new db($config['realm_db']);
    $data = $rdb->fetchRow("SELECT * FROM `donation_sets` WHERE `guid` = '" .
        getcharguid() . "'");
    if (!$data)
        return false;

    $items['name'] = $data['name'];
    $items['set_guid'] = $data['setguid'];

    for ($i = 0; $i <= 18; $i++)
    {
        $items[$i][0] = $data["item" . $i];
        $items[$i][1] = "<a href='http://www.wowhead.com/item=" . $data['item' . $i] .
            "' target='_blank' onclick='return false;'>[" . $data['item' . $i] . "]</a>";
    }
    return $items;
}

function get_item($entry)
{
    global $config;
    $wdb = new db($config['blizz_world_db']);
    $item = new Item;

    $row = $wdb->fetchRow("SELECT `entry`,`name`,`Quality`, `ItemLevel` FROM `donation_items` WHERE `entry`='" .
        $entry . "' LIMIT 1");
    if (!$row)
        return false;

    $item->entry = $row['entry'];
    $item->item_name = $row['name'];
    $item->item_quality = $row['Quality'];
    $item->item_level = $row['ItemLevel'];

    return $item;
}

function requirement_check($item_object)
{
    global $config;


}

function update_slot($item_id, $slot)
{
    global $config;
    $cdb = new db($config['realm_db']);
    $item_id = intval($item_id);
    $slot = intval($slot);

    $cdb = exec("UPDATE `donation_sets` SET `item" . $slot . "` = '" . $item_id .
        "' WHERE `guid` = '" . getcharguid() . "'");

    echo "<meta http-equiv=refresh content='5;url=" . $_SERVER['PHP_SELF'] . "'>";
    show_popup("", $timer = 0);
}

function show_item($item_id, $slot)
{
    global $config;
    //$cdb = new db($config['realm_db']);
    $item_id = intval($item_id);

    if ($item_id != 0)
    {
        $item = get_item(intval($item_id));
        if (!$item)
            return "An error has occured, this item does not exist in our database";

        //requirement check

        return "<a href=http://www.wowhead.com/?item=" . $item->entry .
            "' style='color:#" . $config["item_quality_colours"][$item->item_quality] .
            "' target='_blank' onclick='return false;'>[" . $item->item_name . "]</a>
        <br>
        <form action='process.php' method='POST'>
            <input type='hidden' name='a' value='dn_set_slot'>
            <input type='hidden' name='s' value='" . $slot . "'>
            <input type='hidden' name='oi' value='" . $item_id . "'>
            <input type='hidden' name='url' value='".$_SERVER['PHP_SELF']."'>
            <input type='submit' value='choose'>
        </form>";
    }
    else
    {
        return "<form action='process.php' method='POST'>
            <input type='hidden' name='a' value='dn_set_slot'>
            <input type='hidden' name='s' value='" . $slot . "'>
            <input type='hidden' name='url' value='".$_SERVER['PHP_SELF']."'>
            <input type='submit' value='choose'>
        </form>";
    }
}

function dn_findItems($string, $type)
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
    $string = addslashes($string);

    $qry = "SELECT `entry`,`name`,`Quality`, `ItemLevel` FROM `".$config[$type.'_item_table']."` WHERE `Quality` < '".$config[$type.'_max_item_quality'] ."' AND `name` LIKE '%$string%' AND !(`entry` < '".$config[$type.'_min_entry']."')
                AND !(`entry` > '".$config[$type.'_max_entry']."') AND `ItemLevel` < '".$config[$type.'_max_item_level']."' ORDER BY `ItemLevel` DESC LIMIT ".$config[$type.'_max_results'].";";
    $d = new db($config[$type.'_item_db']);
    $data = $d->fetch($qry);

    return $data;
}

function dn_getItems($db_result, $type)
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

function dn_ShowItems($items, $items_found, $type)
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
        $background_color = "#000000";
        if ($i%2 != 0)
        {
            $background_color = "#101010";
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

function dn_show_sets()
{
    global $config;
    $rdb = new db($config['realm_db']);
    $data = $rdb->fetch("SELECT `setguid`, `name` FROM `donation_sets` WHERE `guid` = '".getcharguid()."'");
    if ($data)
    {
        $txt = '<table>
                <tr>
                    <td colspan="3">
                        <font color="orange">Showing available packages:</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        Set Name
                    </td>
                    <td>
                        Action 1
                    </td>
                    <td>
                        Action 2
                    </td>
                </tr>';
        foreach ($data as $row)
        {
            $txt .= "<tr>
                <td>".$row['name']."</td>
                    <td>
                        <a href='process.php?a=select_set&id=".$row['setguid']."'><font color='orange'>Select</font></a>
                    </td>
                    <td>
                        <a href='process.php?a=delete_set&id=".$row['setguid']."'><font color='red'>Delete</font></a>
                    </td>
                </tr>";
        }
        $txt .= '<tr>
                </table>';
        return $txt;
    }
    else 
        return "No previously saved sets.";
    
}

?>