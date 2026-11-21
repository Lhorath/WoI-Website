<?php

/**
 * @author megosh
 * @copyright 2010
 */
 
require_once ('header.php');

//=========================================================================
//   GM FUNCTIONS
//=========================================================================

function show_gm_tools()
{
    global $config;
    $gmlevel = getgmlevel();
    $txt = '';
    if ($gmlevel > 0)
    {
        $txt .= "<li class='current'>
                <a href='/gm/'>GM Tools</a>
                <ul>
                    <li><a href='/gm/player.php'>Player Info</a></li>
                    <li><a href='/gm/account.php'>Account Info</a></li>
					<li><a href='/gm/promo.php'>Promotion Check</a></li>
                    <li><a href='/gm/donation.php'>Donation Info</a></li>
                    <li><a href='/gm/vote.php'>Vote Info</a></li>
                    <li><a href='/gm/walls.php'>Invis Wall Fix</a></li>";
        if ($gmlevel > 2)
        {
            $txt .= "<li><a href='/gm/instance.php'>Instance Reset</a></li>";
        }
        if ($gmlevel > 3)
        {
            $txt .= "<li><a href='/gm/vp.php'>VP Add</a></li>";
        }
        $txt .= "</ul> 
            </li>";
    }
    return $txt;
}

function show_voted_for($voteid, $playername)
{
    global $config;
    //echo " <center> NOTE: All votes made before 2009-12-20 03:32:21 will have an incorrect hour time.</center><br>";
    $loadtable = "<table width='100%' height='1' border='0' valign='top' cellpadding='0' cellspacing='0' id='2'>
		<tr>
		<td align='center'><b>Vote ID</b></td>
		<td><b>Player Name</b></a></td>
		<td align='center'><b>Date Recieved</b></td>
		<td align='center'><b>Item ID</b></a></td>
		<td align='center'><b>Quantity</b></a></td>
		</tr>";

    $qery = "SELECT * FROM `voted_for` WHERE";
    if (empty($voteid) && empty($playername))
    {
        return "<br>Both feilds are blank. Aborting.<br>";
    }
    if (!empty($voteid) && empty($playername))
        $qery .= " `vote_id` = '$voteid'";
    if (empty($voteid) && !empty($playername))
        $qery .= " `char_name` = '$playername'";
    if (!empty($voteid) && !empty($playername))
        $qery .= " `vote_id` = '$voteid' AND `char_name` = '$playername'";
    $d = new db($config['realm_db']);
    $data = $d->fetch($qery);
    foreach ($data as $row)
    {
        $vote_id = $row['vote_id'];
        $acct_id = $row['acc_id'];
        $char_name = $row['char_name'];
        $date = $row['date'];
        $item_link = "<a href='http://www.wowhead.com/?item=" . $row['item'] .
            "' target='_blank'><font color='orange'>" . $row['item'] . "</font></a>";
        $quantity = $row['num_of_item'];
        $loadtable .= "<tr>
				<td align='center'>$vote_id</td>
				<td>$char_name</td>
				<td align='center'>$date</td>
				<td align='center'>$item_link</td>				
				<td align='center'>$quantity</td>
			</tr>";
    }
    $loadtable .= "</table>";
    return $loadtable;
}
function build_voted_for()
{
    if (isset($_GET['voteid']) || isset($_GET['playername']))
    {
        $voteid = intval($_GET['voteid']);
        if (allowed_characters($_GET['playername']) == false)
            return "Invalid characters in player name.";
        return show_voted_for($_GET['voteid'], $_GET['playername']);
    }
    else
    {
        return "<center> This tool can show items that players voted for. Fill in either Vote ID, Player Name or both.</center>
            <br>
            <center> NOTE: All votes made before 2009-12-20 03:32:21 will have an incorrect hour time.</center>
            <br>
            <form action='" . $_SERVER['PHP_SELF'] . "?tool=ivf' method='GET'>
                Vote ID: <input type='text' name='voteid'>
                <br>
                Player Name: <input type='text' name='playername'>
                <br>
                <INPUT class=button  
                tabIndex=5 type=submit 
                alt='submit' src='images/create_en.gif' 
                value='Submit' name='Submit'>
            </form>
            <br>";
    }
}

function show_promo_check($ip)
{
    global $config;
    $qry = "SELECT `id`,`username` FROM `account` WHERE `last_ip` = '$ip'";
    $d = new db($config['realm_db']);
    $data = $d->fetch($qry);
    $i = 0;
    if (!$data)
        return "There are no accounts on this IP.";
    foreach ($data as $row)
    {
        $account_array[$i][0] = $row["id"];
        $account_array[$i][1] = $row["username"];
        $i++;
    }
    $tot_accnts = $i;
    $loadtable = "<table width='100%' height='1' border='1' valign='top' cellpadding='1' cellspacing='1'>
		<tr>
		<td align='center'><b>#</b></td>
		<td><b>Account</b></a></td>
		<td><b>Account Name</b></a></td>
		<td><b>lvl 80 Character Names</b></a></td>
		<td align='center'><b># of 80(s)</b></td>
		</tr>";
    $i = 0;
    while ($i < $tot_accnts)
    {
        $qry = "SELECT `name` FROM `characters` WHERE `account` = " . $account_array[$i][0] .
            " and `level` = '80'";
        $d = new db($config['blizz_char_db']);
        $result = $d->fetch($qry);
        $x = 0;
        $name = '';
        if ($result)
        {
            foreach ($result as $row)
            {
                $name .= $row['name'] . ", ";
                $x++;
            }
        }
        $t80onacct = $x;
        $counter = $i + 1;
        $loadtable .= "<tr>
			<td align='center'>" . $counter . "</td>
			<td>" . $account_array[$i][0] . "</td>
			<td>" . $account_array[$i][1] . "</td>
			<td>" . $name . "</td>
			<td align='center'>$t80onacct</td>
		</tr>";
        $total_80s = $t80onacct + $total_80s;
        $i++;
    }
    $loadtable .= "</table>";
    $loadtable .= "<br><br>Player IP: $ip has $tot_accnts total account(s) and $total_80s level 80(s).<br><br>";
    if ($total_80s > 0)
        $loadtable .= "<font color=red>Transfer is not recomended. Please inform the player that there is only 1 lvl 80 per IP/person.</font>";
    else
        $loadtable .= "<font color=green>Transfer is approved. Please remind the player that there is only 1 transfer per person.</font>";
    return $loadtable;
}

function account_name_to_account_id($name)
{
    global $config;
    
    if (!allowed_characters($name))
        return false;
        
    $d = new db($config['realm_db']);
    return $d->fetchCell("SELECT `id` FROM `account` WHERE `username` = '".$name."';");
}

function get_previous_pass($account)
{
    global $config;
    
    $d = new db($config['realm_db']);
    return $d->fetchCell("SELECT `sha_pass_hash` FROM `account_passhistory` WHERE `id` = '".$account."' ORDER BY `date_changed` LIMIT 1;");
}

function get_previous_pass_date($account)
{
    global $config;
    
    $d = new db($config['realm_db']);
    return $d->fetchCell("SELECT `date_changed` FROM `account_passhistory` WHERE `id` = '".$account."' ORDER BY `date_changed` LIMIT 1;");
}
?>