<?php

/**
 * @author megosh
 * @copyright 2010
 */
 
require_once ('header.php');

//=========================================================================
//   VOTE FUNCTIONS
//=========================================================================	

//todo: throw this in one massive class and merge most of the functions together

function accountexistcheck($account)
{
	global $config;
	$user_ip=getenv('REMOTE_ADDR');
	$d = new db($config['realm_db']);
	$acctid = $d->fetchCell("SELECT `id` FROM `account` WHERE `username` = '$account'");
	return $acctid;
}

function show_time_to_vote($user_time)
{
    global $config;
	$today = time();
	$remaining = $config['vote_cooldown_duration'] - ($today - $user_time);
    if ($remaining > 0)
    {
        $remaining_seconds = $remaining % 60;
        $remaining_minutes_in_seconds = ($remaining - $remaining_seconds) % 3600;
        $remaining_minutes = $remaining_minutes_in_seconds/60;
        $remaining_hours = ($remaining - ($remaining_seconds + $remaining_minutes_in_seconds)) / 3600;
        $user_remaining_time = $remaining_hours." Hours ".$remaining_minutes." minutes and ".$remaining_seconds." seconds";
    }
    else
        $user_remaining_time = "Now!";
	return $user_remaining_time;
}

function check_ip_vote_timer($voting_site)
{
	global $config;
    $d = new db($config['realm_db']);
	$user_ip = getenv("REMOTE_ADDR");
    $data = $d->fetch("SELECT `time`, `sites` FROM `voting` WHERE `user_ip` LIKE '".$user_ip."'");
	if (!$data)//never voted before on ip
	{
        $d->exec("INSERT INTO `voting` (`user_ip`) VALUES ('".$user_ip."')");
		return true;
	}
    foreach ($data as $row)
    {
        $rowtime = $row['time'];
        $site = $row['sites'];
    }
	if ((time() - $rowtime) > $config['vote_cooldown_duration']) // if outside timer, set sites 0 and allow vote
    {
	    $d->exec("UPDATE `voting` SET `sites`= '0' WHERE `user_ip` = '".$user_ip."'");
		return true;
    }
    if (!($site & $voting_site)) // if within timer, and site is not already voted for, allow vote
        return true;
    else
        return false;
}

// im sure theres a way to merge these, but im lazy and two work just as well

function check_acct_vote_timer($voting_site)
{
	global $config;
    $acctid = getuserid();
    $d = new db($config['realm_db']);
    $data = $d->fetch("SELECT `time`, `sites` FROM `voting_points` WHERE `id` = '".$acctid."'");
    if (!$data) // never voted before
    {
        $d->exec("INSERT INTO `voting_points` (`id`) VALUES (".$acctid.")");
        return true;
    }
    foreach ($data as $row)
    {
        $rowtime = $row['time'];
        $site = $row['sites'];
    }
	if ((time() - $rowtime) > $config['vote_cooldown_duration'])// if outside timer, set sites 0 and allow vote
    {
        $d->exec("UPDATE `voting_points` SET `sites`= '0' WHERE `id` = '".$acctid."'");
		return true;
    }
    if (!($site & $voting_site)) // if within timer, and site is not already voted for, allow vote
        return true;
    else
        return false;
}

function get_vote_data()
{
    global $config;
    //get acct and ip vote timers and bitmask
    $rdb = new db($config['realm_db']);
    $data = $rdb->fetchRow("SELECT `time`, `sites` FROM `voting` WHERE `user_ip` LIKE '".getenv('REMOTE_ADDR')."'");
    $vd[0][0] = intval($data['sites']);
    $vd[0][1] = intval($data['time']);
    unset($data);
    $data = $rdb->fetchRow("SELECT `time`, `sites` FROM `voting_points` WHERE `id` = '".getuserid()."'");
    $vd[1][0] = intval($data['sites']);
    $vd[1][1] = intval($data['time']);
    unset($data);
    
    return $vd;
}

function show_vote_sites()
{
	global $config;
    $txt = '';
	foreach($config['vote_sites'] as $key => $value)
	{
        $txt .= "<form action='".basename($_SERVER['REQUEST_URI'])."?i=".$value[3]."' name='vote_redirect' method='POST' target='_blank'>
                <input type=hidden name='u' value='".$value[1]."'> 
                <input type=hidden name='n' value='".$value[0]."'> 
                <input type=hidden name='i' value='".$value[3]."'> 
                <input type=image target='_blank' alt='".$value[0]."' src='".$value[2]."' value='1' name='vote_redirect'>
            </form>";
	}
    return $txt;
}

function retrieve_vote_redirect()
{
    global $config;
    if ($_POST['u'])
    {
        if (!vote($_POST['i']))
            return true;
        else
        {
            echo "<br>Redirecting to ".$_POST['n']."<br>";
            echo "<META HTTP-EQUIV='Refresh' CONTENT=\"0; URL=".$_POST['u']."\"><META HTTP-EQUIV='PRAGMA' CONTENT='NO-CACHE'>";
        }
        return true;
    }
    return false;
}

function return_voted_sites_ip()
{
	global $config;
	$user_ip = getenv('REMOTE_ADDR');
    $d = new db($config['realm_db']);
	$data = $d->fetch("SELECT `sites` FROM `voting` WHERE `user_ip` LIKE '$user_ip'");
	foreach($data as $row)
		$sites = $row["sites"];
	return $sites;
}

function return_voted_sites_acct()
{
	global $config;
    $acctid = getuserid();
    $d = new db($config['realm_db']);
	$data = $d->fetch("SELECT `sites` FROM `voting_points` WHERE `id` LIKE '$acctid'");
	foreach($data as $row)
		$sites = $row["sites"];
	return $sites;
}

function points_per_vote()
{
	global $config;
	$day = date("j");
	if ($day <= $config['bonus_days_duration'])
		return $config['bonus_point_per_vote'];
	else
		return $config['reg_point_per_vote'];
}

function vote($site)
{
	global $config;
    $acctid = getuserid();
	$user_ip = getenv('REMOTE_ADDR');
	if (check_ip_vote_timer($site) == true)
    {
        if (check_acct_vote_timer($site) == true)
        {
            $d = new db($config['realm_db']);
            $d->exec("UPDATE `voting` SET `sites`=(`sites` + ".$site."), `time`='".time()."' WHERE `user_ip` LIKE '$user_ip'");
            $d->exec("UPDATE `voting_points` SET `points`=(`points` + ".points_per_vote()."), `sites`=(`sites` + ".$site."), `time`='".time()."' WHERE `id` = ".$acctid);
            return true;
        }
        else
            echo "<center>You have already voted for this site on this account.<br> You may do so again in ".show_time_to_vote_acct().".</center>";
    }
	else
		echo "<center>You have already voted for this site on this IP address.<br> You may do so again in ".show_time_to_vote_ip().".</center>";
}

/*function vote_limit_reached($acctid)
{
	global $config;
    $d = new db($config['realm_db']);
	$data = $d->fetch("SELECT `date_points`, `date` FROM `voting_points` WHERE `id` = '$acctid'");
    foreach($data as $row)
    {
        $date_points = $row['date_points'];
        $date = $row['date'];
    }
    $limit = points_per_vote()*3;
	if ($date_points >= $limit)
		return true;
	else
		return false;
}*/

/*function show_time_to_vote_acct()
{
	global $config;
    $acctid = getuserid();
	$d = new db($config['realm_db']);
	$user_time = $d->fetchCell("SELECT `time` FROM `voting_points` WHERE `id` LIKE '$acctid'");
	$today = time();
	$remaining = $config['vote_cooldown_duration'] - ($today - $user_time);
    if ($remaining > 0)
    {
        $remaining_seconds = $remaining % 60;
        $remaining_minutes_in_seconds = ($remaining - $remaining_seconds) % 3600;
        $remaining_minutes = $remaining_minutes_in_seconds/60;
        $remaining_hours = ($remaining - ($remaining_seconds + $remaining_minutes_in_seconds)) / 3600;
        $user_remaining_time = $remaining_hours." Hours ".$remaining_minutes." minutes and ".$remaining_seconds." seconds";
    }
    else
        $user_remaining_time = "Now!";
	return $user_remaining_time;
}

function show_time_to_vote_ip()
{
	global $config;
	$d = new db($config['realm_db']);
	$user_time = $d->fetchCell("SELECT `time` FROM `voting` WHERE `user_ip` LIKE '".getenv("REMOTE_ADDR")."'");
	$today = time();
	$remaining = $config['vote_cooldown_duration'] - ($today - $user_time);
    if ($remaining > 0)
    {
        $remaining_seconds = $remaining % 60;
        $remaining_minutes_in_seconds = ($remaining - $remaining_seconds) % 3600;
        $remaining_minutes = $remaining_minutes_in_seconds/60;
        $remaining_hours = ($remaining - ($remaining_seconds + $remaining_minutes_in_seconds)) / 3600;
        $user_remaining_time = $remaining_hours." Hours ".$remaining_minutes." minutes and ".$remaining_seconds." seconds";
    }
    else
        $user_remaining_time = "Now!";
	return $user_remaining_time;
}*/

/*function create_vote_lists($acctid)
{
	global $config;
    $d = new db($config['realm_db']);
    $data = $d->fetch("SELECT `id` FROM `voting_points` WHERE `id` = '".$acctid."'");
    if (!$data)
        $d->exec("INSERT INTO `voting_points` (`id`) VALUES (".$acctid.")");
	$user_ip = getenv("REMOTE_ADDR");
    $data = $d->fetch("SELECT `time` FROM `voting` WHERE `user_ip` LIKE '".$user_ip."'");
	if (!$data)
	{
        $d->exec("INSERT INTO `voting` (`user_ip`) VALUES ('".$user_ip."')");
		return;
	}
    foreach($data as $row)
        $rowtime = $row['time'];
	if ((time() - $rowtime) > $config['vote_cooldown_duration'])
    {
		$d->exec("UPDATE `voting` SET `sites`= '0' WHERE `user_ip` LIKE '".$user_ip."'");
        $d->exec("UPDATE `voting_points` SET `date_points`= '0' WHERE `id` = '".$acctid."'");
    }
}*/
?>