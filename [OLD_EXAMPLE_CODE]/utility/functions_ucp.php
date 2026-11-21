<?php

/**
 * @author megosh
 * @copyright 2010
 */
 
require_once ('header.php');

function setupdb()
{
	global $config;
	if (isset($_POST['realm']))
    {
        $db = intval($_POST['realm']);
		$txt = "<font color='black'>Your session is being updated. Please wait while we redirect you...</font><br><center><img src='".$config['img_dir']."loading.gif' /></center>";
		if ($db == '1')
		{
            setcharname('');
            setcharguid('');
			setchardb($config['blizz_char_db']);
			show_popup($txt, 5);
			echo "<META HTTP-EQUIV='Refresh' CONTENT=\"2; URL=".$_SERVER['REQUEST_URI']."\"><META HTTP-EQUIV='PRAGMA' CONTENT='NO-CACHE'>";
		}
		else if ($db == '2')
		{
            setcharname('');
            setcharguid('');
			setchardb($config['pvp_char_db']);
			show_popup($txt, 5);
			echo "<META HTTP-EQUIV='Refresh' CONTENT=\"2; URL=".$_SERVER['REQUEST_URI']."\"><META HTTP-EQUIV='PRAGMA' CONTENT='NO-CACHE'>";
		}
		else if ($db == '0')
			continue;
		else
			echo "Invalid Selection. Go away, we cleanse our posts.";
    }
    
    if (getchardb() == $config['blizz_char_db'])
        $blizz = 'selected';
    else if (getchardb() == $config['pvp_char_db'])
        $fun_pvp = 'selected';
        
	return "<form action='".$_SERVER['REQUEST_URI']."' method='post' >
			<table width='275' border='0'>
				<tr>
                <td>Select a realm: </td>
                <td>
					<select name=realm onchange='this.form.submit();'>
						<option ".$blizz." value='1'>Immortality Blizzlike</option>
						<option ".$fun_pvp." value='2'>Envy PVP</option>
					</select>
                </td>
				</tr>
			</table>
		</form>
		<br />";
}

function getrace($guid)
{
	global $config;
	$guid = intval($guid);
	$qry = "SELECT `race` FROM `characters` WHERE `guid`='".$guid."' AND `account` = '".getuserid()."'";
	$d = new db(getchardb());
	$data = $d->fetch($qry);
	if (!$data)
		return false;
				
	foreach($data as $row)
		return $row['race'];
}

function showCharacters()
{
	global $config;
	$qry = "SELECT `guid`, `name` FROM `characters` WHERE `account`='".getuserid()."'";
	$d = new db(getchardb());
	$data = $d->fetch($qry);
	if (!$data)
		return;
	$txt = "";
		foreach($data as $row)
			$txt .= "<option value='".$row['guid']."'>".$row['name']."</option>";
	return $txt;
}

function unstuck($char_guid)
{
    global $config;
    if (ischaronacct($char_guid) == false)
        return "The selcted character is not on your account";
    
    $qry = "SELECT `map`, `zone`, `position_x`, `position_y`, `position_z` FROM `character_homebind` WHERE `guid` = '".$char_guid."'";
    $d = new db(getchardb());
    $data = $d->fetch($qry);
    if (!$data)
        return "Error retrieving unstuck location";
        
    foreach($data as $row)
    {
        $map = $row['map'];
        $zone = $row['zone'];
        $pos_x = $row['position_x'];
        $pos_y = $row['position_y'];
        $pos_z = $row['position_z'];
    }
    
    $qry = "UPDATE `characters` SET `map` = '$map', `zone` = '$zone', `position_x` = '$pos_x', `position_y` = '$pos_y', `position_z` = '$pos_z' WHERE `guid` = '$char_guid'";
    $d = new db(getchardb());
    $data = $d->exec($qry);
    
    return "Your character was sent to their home bind location. <br>Remember, if your character was logged in, this will not work.";
}

function show_unstucker()
{
    if (isset($_POST['submit']))
    {
        if (allowed_characters($_POST['character']) == false)
            return "Invalid characters in character name.";
        return unstuck($_POST['character']);
    }
    else
    {
        return "<form action='".$_SERVER['REQUEST_URI']."' method='post' name='myform' id='myform'>
                <table width='300' border='0'>
                    <tr>
                        <td>Select a character:</td>
						<td><select name='character' width='50' >
							<option value='0'></option>
							".showCharacters()."
						</select></td>
                    </tr>
                </table>
                <input type='submit' name='submit' value='Unstuck' />
            </form>
            <br />";
    }
}

function change_pass($acctid, $acctname, $cur_pass, $new_pass, $conf_n_pass)
{
    global $config;
	
	if (allowed_characters($cur_pass) == false)
		return "Invalid characters in old password.";
	if (allowed_characters($new_pass) == false)
		return "Invalid characters in new password.";
	if (allowed_characters($conf_n_pass) == false)
		return "Invalid characters in confirmation password.";
    if ($new_pass != $conf_n_pass)
		return "Your passwords do not match.";
	if (strlen($new_pass) < $config['acc_min_chars_pass'])
		return "Your new pass is too short.";
    if (allowed_characters($new_pass) == false)
        return "Invalid characters in new password";
		
	$cur_pass = sha_password($acctname, $cur_pass);
    $d = new db($config['realm_db']);
    $data = $d->fetch("SELECT `sha_pass_hash` FROM `account` WHERE `id` = '".$acctid."' AND `sha_pass_hash` = '".$cur_pass."'");
	if (!$data)
		return "The current password is incorrect.";
		
    $new_pass = sha_password($acctname, $new_pass);    
   
    if (!$d->exec("UPDATE `account` SET `sha_pass_hash` = '".$new_pass."', `sessionkey` = null, `v` = null, `s` = null, `username` = UPPER(`username`) WHERE `id` = '".$acctid."'"))
        return "Error updating password"; 
	
    $d->exec("INSERT INTO `account_passhistory` (`id`, `sha_pass_hash`, `date_changed`) VALUES ('".$acctid."', '".$new_pass."', '".date("Y-m-d H:i:s")."')
    ON DUPLICATE KEY UPDATE `sha_pass_hash` = '".$new_pass."', `date_changed` = '".date("Y-m-d H:i:s")."';");
    
    return "Password successfully changed.";
}

function change_email($cur_email, $new_email, $conf_n_email)
{
    global $config;
	
	if (!check_email_address($cur_email))
		return "Invalid characters in old email.";
	if (!check_email_address($new_email))
		return "Invalid characters in new email.";
	if (!check_email_address($conf_n_email))
		return "Invalid characters in confirmation email.";
    if ($new_email != $conf_n_email)
		return "Your emails do not match.";
		
    $d = new db($config['realm_db']);
    $data = $d->fetch("SELECT `email` FROM `account` WHERE `id` = '".getuserid()."' AND `email` = '".$cur_email."'");
	if (!$data)
		return "The current email is incorrect.";  
   
    if (!$d->exec("UPDATE `account` SET `email` = '".$new_email."' WHERE `id` = '".getuserid()."'"))
        return "Error updating email."; 
		
    return "Email successfully changed.";
}

function show_change_pass()
{
    if (isset($_POST['new_pass']))
    {
        if (allowed_characters($_POST['cur_pass']) == false)
            return "Invalid characters in old pass name.";
		if (allowed_characters($_POST['new_pass']) == false)
            return "Invalid characters in new password name.";
		if (allowed_characters($_POST['conf_n_pass']) == false)
            return "Invalid characters in confirmation password name.";
        return change_pass(getuserid(), getaccount(), $_POST['cur_pass'], $_POST['new_pass'], $_POST['conf_n_pass']);
    }
    else
    {
        return "<form action='".$_SERVER['REQUEST_URI']."' method='post' >
            <table width='300' border='0'>
            <tr>
            <td>Current Password:</td>
            <td><input type='password' name='cur_pass' value='' /></td>
            </tr>
			<tr>
            <td>New Password:</td>
            <td><input type='password' name='new_pass' value='' /></td>
            </tr>
			<tr>
            <td>Confirm New Pass:</td>
            <td><input type='password' name='conf_n_pass' value='' /></td>
            </tr>
            </table>
            <input type='submit' name='submit' value='Change Pass' />
            </form>
            <br />";
    }
}

function show_change_email()
{
    if (isset($_POST['new_email']))
    {
        return change_email($_POST['cur_email'], $_POST['new_email'], $_POST['conf_n_email']);
    }
    else
    {
        return "<form action='".$_SERVER['REQUEST_URI']."' method='post' >
            <table width='300' border='0'>
            <tr>
            <td>Current Email:</td>
            <td><input type='text' name='cur_email' value='' /></td>
            </tr>
			<tr>
            <td>New Email:</td>
            <td><input type='text' name='new_email' value='' /></td>
            </tr>
			<tr>
            <td>Confirm New Email:</td>
            <td><input type='text' name='conf_n_email' value='' /></td>
            </tr>
            </table>
            <input type='submit' name='submit' value='Change Email' />
            </form>
            <br />";
    }
}

function teleport($guid, $race, $location)
{
	global $config;
	$map = "";
	$x = "";
	$y = "";
	$z = "";
	$place = "";
	switch($location)
	{
		//stormwind
		case 1:
			$map = "0";
			$x = "-8913.23";
			$y = "554.633";
			$z = "93.7944";
			$place = "Stormwind City";
			break;
		//ironforge
		case 2:
			$map = "0";
			$x = "-4981.25";
			$y = "-881.542";
			$z = "501.66";
			$place = "Ironforge";
			break;
		//darnassus
		case 3:
			$map = "1";
			$x = "9951.52";
			$y = "2280.32";
			$z = "1341.39";
			$place = "Darnassus";
			break;
		//exodar
		case 4:
			$map = "530";
			$x = "-3987.29";
			$y = "-11846.6";
			$z = "-2.01903";
			$place = "The Exodar";
			break;
		//orgrimmar
		case 5:
			$map = "1";
			$x = "1676.21";
			$y = "-4315.29";
			$z = "61.5293";
			$place = "Orgrimmar";
			break;
		//thunderbluff
		case 6:
			$map = "1";
			$x = "-1196.22";
			$y = "29.0941";
			$z = "176.949";
			$place = "Thunder Bluff";
			break;
		//undercity
		case 7:
			$map = "0";
			$x = "1586.48";
			$y = "239.562";
			$z = "-52.149";
			$place = "The Undercity";
			break;
		//silvermoon
		case 8:
			$map = "530";
			$x = "9473.03";
			$y = "-7279.67";
			$z = "14.2285";
			$place = "Silvermoon City";
			break;
		//shattrath
		case 9:
			$map = "530";
			$x = "-1863.03";
			$y = "4998.05";
			$z = "-21.1847";
			$place = "Shattrath City";
			break;
		//dalaran
		case 20:
			$map = "571"; // Need Coords
			$x = "5812.79"; // Need Coords
			$y = "647.158"; // Need Coords
			$z = "647.413"; // Need Coords
			$place = "Dalaran";
			break;
		//valiance keep
		case 21:
			$map = "571"; // Need Coords
			$x = "2285.24"; // Need Coords
			$y = "5244.92"; // Need Coords
			$z = "11.3552"; // Need Coords
			$place = "Valiance Keep";
			break;
		//warsong hold
		case 22:
			$map = "571"; // Need Coords
			$x = "2508.75"; // Need Coords
			$y = "6172.98"; // Need Coords
			$z = "53.1912"; // Need Coords
			$place = "Warsong Hold";
			break;
		//for unknowness -> Shattrath City
		default:
			echo "That is an invalid location!";
			return false;
			break;
	}

	//disallows factions to use enemy portals
	switch($race)
	{
		//alliance
		case 1:
		case 3:
		case 4:
		case 7:
		case 11:
			if ((($location >=5) && ($location <=8)) && ($location != 9))
			{
				echo "<center>Alliance players can <b>NOT</b> Teleport to Horde areas!</center>";
				return false;
			}	
			break;
		//horde
		case 2:
		case 5:
		case 6:
		case 8:
		case 10:
			if ((($location >=1) && ($location <=4)) && ($location != 9))
			{
				echo "<center>Horde Players can <b>NOT</b> Teleport to Alliance areas!</center>";
				return false;
			}
			break;
		default:
			echo "<center>That is not a valid Race!</center>";
			return false;
			break;
	}
	$qry = "UPDATE characters SET position_x = ".$x.", position_y = ".$y.", position_z = ".$z.", map = ".$map." WHERE account = ".getuserid()." AND guid = ".$guid;
	$d = new db(getchardb());
	$data = $d->exec($qry);
	if (!$data)
	{
		echo "Teleport Failed";
		return false;
	}
	echo "Character teleported to $place.";
	return true;
}
function revive($guid)
{
	global $config;
	
	$qry = "DELETE FROM `character_aura` WHERE `spell` = '8326' AND `guid` = '$guid'";
	$d = new db(getchardb());
	$data = $d->exec($qry);
}

function build_reviver()
{
    if (isset($_POST['submit']))
    {
        if (allowed_characters($_POST['character']) == false)
            return "Invalid characters in character name.";
        if (ischaronacct($_POST['character']))
            return revive($_POST['character']);
        else
            return "Character was not on your account!";
    }
    else
    {
        return "<form action='".$_SERVER['REQUEST_URI']."' method='post'>
                <table width='300' border='0'>
                    <tr>
                        <td>Select a character:</td>
						<td><select name='character' width='50' >
							<option value='0'></option>
							".showCharacters()."
						</select></td>
                    </tr>
                </table>
                <input type='submit' name='submit' value='Revive' />
            </form>
            <br />";
    }
}

function show_teleporter()
{
	global $config;
    if (isset($_POST['telesubmit']))
	{
		$char_guid = intval($_POST['character']);
		$location = intval($_POST['location']);
		if ($char_guid != '0' && $location != '0')
		{
			if (!ischaronacct($char_guid))
				return "The selected character is not on your account";
			teleport($char_guid, getrace($char_guid), $location);
			revive($char_guid);
		}
		else
			return "You did not select both fields";
	}
	else
	{
	    $txt = "
		<br /><br />
            <form action='".$_SERVER['REQUEST_URI']."' method='POST'>
                <table width='400' border='0'>
					<tr>
						<td>Select a character:</td>
						<td><select name='character' width='50' >
							<option value='0'></option>
							".showCharacters()."
						</select></td>
					</tr>
					<tr>
						<td>Location:</td>
						<td><select name=location>
							<option value='--------'>---Alliance---</option>
							<option value='1'>Stormwind City</option>
							<option value='2'>Ironforge</option>
							<option value='3'>Darnassus</option>
							<option value='4'>The Exodar</option>
							<option value='21'>Valiance Keep</option>
							<option value='--------'>---Horde---</option>
							<option value='5'>Orgrimmar</option>
							<option value='6'>Thunder Bluff</option>
							<option value='7'>The Undercity</option>
							<option value='8'>Silvermoon City</option>
							<option value='22'>Warsong Hold</option>
							<option value='--------'>---Neutral---</option>
							<option value='9'>Shattrath City</option>
							<option value='20'>Dalaran</option>
						</select></td>
					</tr>
                    </table>
                <input type='submit' name='telesubmit' value='Teleport'/>
            </form>
		<br /><br />
		You <b>MUST</b> be offline for this tool to successfully work</small><br />
		";
	}
	return $txt;
}

function ban_check()
{
    global $config;
    
    $d = new db($config['realm_db']);
    $ip_ban = $d->fetchRow("SELECT `bandate`, `unbandate` FROM `ip_banned` WHERE `ip` = '".$_SERVER['REMOTE_ADDR']."';");
    
    if ($ip_ban && $ip_ban['unbandate'] > time())
        $txt .= "You are IP banned. It will expire in ".sec_to_days_hours_mins_sec($ip_ban['unbandate'] - $ip_ban['bandate'])."<br />";
    
    $acc_ban = $d->fetchRow("SELECT `bandate`, `unbandate` FROM `account_banned` WHERE `id` = '".getuserid()."';");
    
    if ($acc_ban && $acc_ban['unbandate'] > time())
        $txt .= "Your account is banned. It will expire in ".sec_to_days_hours_mins_sec($acc_ban['unbandate'] - $acc_ban['bandate'])."<br />";
    
    if ($txt)
        return $txt;
    else
        return "Neither your account or your IP is banned.<br />";
}

?>