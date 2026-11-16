<?php

/**
 * @author megosh
 * @copyright 2010
 */
 
require_once ('header.php');

//=========================================================================
//   STATS FUNCTIONS
//=========================================================================	

function total_online($server)
{
	global $config;
	if (!$config['online_count'])
		return "[Hidden]";
	$sql = "SELECT count(*) FROM `characters` WHERE `online`='1' ORDER BY `name`";
	$d = new db($server);
	$total_on = $d->fetchCell($sql, $config['online_count_cache_timer'], "total_online_".$server);
	if (!$total_on)
		$total_on = 0;
	return $total_on;
}

function online_list($server)
{
	global $config, $def;
	
	if ($config['show_online_list'] == false)
	{
		echo "<center><font color='RED'>Online player list disabled.</font></center><br><br>";
		return;
	}
	$sql = "SELECT `guid`, `map`, `race`, `class`, `name`, `level`, `zone`, `latency` FROM `characters` WHERE `online`='1' ORDER BY `name`";
	$d = new db($server);
	$data = $d->fetch($sql, $config['online_list_cache_timer'], "online_list_".$server);
	$i=0;
	if (!$data)
    {
		echo "<center>No Members Online.</center><br><br><br>";
        return;
    }
	else
	{
		foreach($data as $result)
		{
			$memberid = $result["guid"];
			$res_pos=get_zone_name($result['zone']);
			$latency=$result['latency'];
			if ('200' >= $latency)
			  $cc = '<font color="green">';
			else if ('200' <= $latency AND '350' > $latency)
			  $cc = '<font color="orange">';
			else
			  $cc = '<font color="#FF0000">';

			if ($latency AND $latency < '1000')
			  $cc .= $latency."</font> ms";
			else
			  $cc = '<i>Pending...</i>';
			if ($result['race'] == 1 || $result['race'] == 3 || $result['race'] == 4 || $result['race'] == 7 || $result['race'] == 11) { $char_side=1; } else { $char_side=2; };
			$pl_array[$i] = Array($result['name'], $result['race'], $result['class'], $result['level'], $res_pos, $char_side, $result['guid'], $cc);
			$i++;
		}
	}
	//$onlineplayers=make_players_arrayrealm($server);
	$onlineplayers = $i;
	$listone= "<table width='100%' height='1' border='0' valign='top' cellpadding='0' cellspacing='0' id='2'>
		<tr class='realms'>
		<td class='realms'></td>
		<td class='realms' align='center'><b>Faction</b></td>
		<td class='realms'><b>Name</b></a></td>
		<td class='realms' align='center'><b>Level</b></td>
		<td class='realms' align='center'><b>Race</b></td>
		<td class='realms' align='center'><b>Class</b></td>
		<td class='realms' align='center'><b>Location</b></td>
		<td class='realms'><b>Latency</b></td>
		</tr>";

	$i=0;
	while ($i < $onlineplayers)
	{
	    $bkg = '';
	    if (is_odd($i))
            $bkg = ' bgcolor="#C8C8C8" ';
		$member=$pl_array[$i][6];
        if ($server == $config['blizz_char_db'])/*/armory/index.php?searchType=profile&character=Aphro&realm=Immortality%20Blizzlike*/
            $name = "<a href='/armory/index.php?searchType=profile&character=".$pl_array[$i][0]."&realm=Immortality%20Blizzlike' target='_blank'>".$pl_array[$i][0]."</a>";
        else
		$name=$pl_array[$i][0];
		$race=$pl_array[$i][1];
		$class=$pl_array[$i][2];
		$res_race = $def['character_race'][$race];
		$res_class = $def['character_class'][$class];
		$lvl=$pl_array[$i][3];
		$loc=$pl_array[$i][4];
		if ($pl_array[$i][5]==1) 
			$side='alliance';
		else 
			$side='horde';
		$rank = $pl_array[$i][5];
		if ($rank==1) 	
			$rankshow="<IMG src=\"".$config['img_dir']."Alliance.gif\" width=20 alt=\"\">";
		else 
			$rankshow="<IMG src=\"".$config['img_dir']."Horde.gif\" width=20 alt=\"\">";
		$latency=$pl_array[$i][7];
		$listone.= "<tr ".$bkg." class='realms'>
				<td class='realms'></td>
				<td class='realms' align='center'>".$rankshow."</td>
				<td class='realms'>".$name."</td>
				<td class='realms' align='center'>".$lvl."</td>
				<td class='realms' align='center'>".$res_race."</td>
				<td class='realms' align='center'>".$res_class."</td>					
				<td class='realms' align='center'>".$loc."</td>
				<td class='realms'>$latency</td>
			</tr>";
		$i++;
	}
	$listone.="</table>";
	return $listone;
}
	

function get_zone_name($mapid)
{
	global $zone;

	if (!empty($zone[$mapid]))
	{
		return $zone[$mapid];
	} 
	else 
		$zmap="Northrend Instance";
	return $zmap;
}

function total_char($server)
{
	global $config;
	$sql = "SELECT `guid` FROM `characters` ORDER BY `guid` DESC LIMIT 1";
	$d = new db($server);
	$max_char = $d->fetchCell($sql, $config['online_list_cache_timer'], "total_char_".$server);
    if (!$max_char)
        return "N/A";
	return($max_char);
}

function current_char($server)
{
	global $config;
	$sql = "SELECT count(*) FROM `characters`";
	$d = new db($server);
	$total_char = $d->fetchCell($sql, $config['online_list_cache_timer'], "current_char_".$server);
    if (!$total_char)
        return "N/A";
	return($total_char);
}

function avg_latency($server)
{
	global $config;
	$sql = "SELECT AVG(`latency`) FROM `characters` WHERE `online` = '1' AND `latency` < '1000'";
    $avg_latency = '';
	$d = new db($server);
	$data = $d->fetch($sql, $config['online_list_cache_timer'], "avg_latency_".$server);
	if (!$data)
		return "<center><i>Pending...</i></center>";
	foreach($data as $result)
	{
		$avg_latency += $result['AVG(`latency`)'];
	}
	$avg_latency = round($avg_latency);
	if ('200' >= $avg_latency)
	  $cc = '<font color="green">';
	else if ('200' <= $avg_latency AND '350' > $avg_latency)
	  $cc = '<font color="#FFFF00">';
	else
	  $cc = '<font color="#FF0000">';
	if ($avg_latency)
	  $cc .= $avg_latency."</font> ms";
	else
	  $cc = '<i>Pending...</i>';
	return($cc);
}
function max_acc()
{
	global $config;
	$sql = "SELECT count(*) FROM `account`";
	$d = new db($config['realm_db']);
	$max_acc = $d->fetchCell($sql, $config['online_list_cache_timer'], 'max_acc');
    if (!$max_acc)
        return "N/A";
	return($max_acc);
}
function max_gm()
{
	global $config;
	$sql = "SELECT count(*) FROM `account` WHERE gmlevel > '0'";
	$d = new db($config['realm_db']);
	$max_gm = $d->fetchCell($sql, $config['online_list_cache_timer'], 'max_gm');
    if (!$max_gm)
        return "N/A";
	return($max_gm);
}
function get_realm_name($server_id = '1')
{
	global $config;
	$sql = "SELECT `name` FROM `realmlist` WHERE id = '$server_id' LIMIT 1";
	$d = new db($config['realm_db']);
	$data = $d->fetch($sql, $config['online_list_cache_timer'], "realmname_".$server_id);
	if (!$data)
		return "Unknown Realm";
	foreach($data as $result)
	{
		$realm_name = $result['name'];
	}
	// this is really messy, but temp till we get the fun/pvp realm up
	if ($realm_name == 'World of Immortality')
		$realm_name = "Immortality ".$config['game_version']." Blizzlike";
	else if ($realm_name == '[BETA] Envy (Pure PVP)')
		$realm_name = "Envy ".$config['game_version']." PVP";
	return($realm_name);
}
function is_server_online($port)
{
	global $config;
	$s = @fsockopen($config['host'], $port, $ERROR_NO, $ERROR_STR,(float)0.5);
	if ($s)
	{
		@fclose($s);
		if ($config['text_or_pic'] == 0)
			return "<img alt=Online src='".$config['img_dir']."".$config['onpic']."' height='24' width='24'>";
		else 		
			return "<font color='GREEN'>ONLINE</font>";
	}
	else
	{
		if ($port == $config['pvp_world_port'])
			return "<font color='GREEN'>UNDER DEVELOPMENT</font>";
		if ($config['text_or_pic'] == 0)
			return "<img alt=Offline src='".$config['img_dir']."".$config['offpic']."' height='24' width='24'>";
		else
			return "<font color='RED'>OFFLINE</font>";
	}
}
function get_uptime($server_id)
{
	global $config;
	$sql = "select `uptime`, `startstring` FROM uptime WHERE realmid = '$server_id' ORDER BY starttime DESC LIMIT 1";
	$d = new db($config['realm_db']);
	$data = $d->fetch($sql, $config['online_list_cache_timer'], "uptime_".$server_id);
	if (!$data)
		return "N/A";
	else
	{
		foreach($data as $result)
		{
			echo sec_to_days_hours_mins_sec($result["uptime"]);
		}
	}
}

function max_online($server_id)
{
	global $config;
	$sql = "select `maxplayers` FROM uptime WHERE realmid = '$server_id' ORDER BY starttime DESC LIMIT 1";
	$d = new db($config['realm_db']);
	$maxonline = $d->fetchCell($sql, $config['online_list_cache_timer'], "max_online".$server_id);
	if (!$maxonline)
		return "N/A";
	return $maxonline;
}
function total_arena_teams($db, $type='')
{
    global $config;
    $sql = "SELECT count(*) FROM `arena_team` WHERE `type` LIKE '%$type%'";
	$d = new db($db);
	$data = $d->fetch($sql, $config['online_list_cache_timer'], "arena_total_".$type."_".$db);
	$i=0;
	if (!$data)
		return "<center>N/A</center><br><br><br>";
    foreach($data as $row)
        return $row['count(*)'];
}

function top_arena_teams($server, $type)
{
    global $config;
    
    $sql = "SELECT name,rating,played,wins2 FROM arena_team LEFT JOIN arena_team_stats ON arena_team.arenateamid = arena_team_stats.arenateamid WHERE arena_team.type = '$type' ORDER BY arena_team_stats.rating DESC LIMIT 1";
    $d = new db($server);
	$data = $d->fetchRow($sql, $config['online_list_cache_timer'], "arena_top_teams_".$type."_".$server);
    
    if ($data)
    {
        $team_name = $data['name'];
        $team_rating = $data['rating'];
        $winperc = round(($data['wins2']/$data['played'])*100, 0)."%";
    }
    return "<strong>".$team_name."</strong><br />".$winperc." Win Percentage, ".$team_rating." Rating <br />";
}

function arena_list($server, $type)
{
	global $config /*$pl_array,*/;
    $limit = $config['num_arena_teams'];
	$sql = "SELECT arena_team.arenateamid,name,captainguid,type,rating,played,wins2,rank FROM arena_team LEFT JOIN arena_team_stats ON arena_team.arenateamid = arena_team_stats.arenateamid WHERE arena_team.type = '$type' ORDER BY arena_team_stats.rating DESC LIMIT $limit";
	$d = new db($server);
	$data = $d->fetch($sql, $config['online_list_cache_timer'], "arena_list_".$type."_".$server);
	$i=0;
	if (!$data)
		return "<center>N/A.</center><br><br><br>";
	
    $txt = "<table width='100%' height='1' border='0' valign='top' cellpadding='1' cellspacing='1'>
		<tr>
		<td ><b>Rank</b></td>
		<td align='center'><b>Team Name</b></a></td>
		<td align='center'><b>Type</b></td>
		<td align='center'><b>Rating</b></a></td>
		<td align='center'><b>Win %</b></a></td>
        <td align='center'><b>Total Games</b></a></td>
		<td align='center'><b>Last Rank</b></a></td>
		<td align='center'><b></b></a></td>
		</tr>";
	
    $rank = '1';
    foreach($data as $result)
    {
        $type = $result['type'];
        if ($type == '2')
            $type = "2v2";
        else if ($type == '3')
            $type = "3v3";
        else if ($type == '5')
            $type = "5v5";
            
        if ($result['wins2'] != '0' && $result['played'] != '0')
            $winperc = round(($result['wins2']/$result['played'])*100, 0)."%";
        else
            $winperc = "N/A";
            
        $teamname = ShortenText($result['name']);
        
        if ($server == $config['blizz_char_db'])
            $name = "<strong>$teamname</strong>";
        else
            $name = $teamname;
        
        $txt .= "<tr>
				<td align='center'>$rank</td>
				<td align='center'>$name</td>
				<td align='center'>$type</td>
				<td align='center'>".$result['rating']."</td>
				<td align='center'>$winperc</td>					
				<td align='center'>".$result['played']."</td>
				<td align='center'>".$result['rank']."</td>
			</tr>";
        $rank++;
    }

	$txt.="</table>";
    
	return $txt;
}
function show_teamtypes()
{
    if (isset($_POST['']))
    {
    }
    else
    {
        $txt = "<form action='".$_SERVER['REQUEST_URI']."' method='POST'>
            <tr>
                <td>Select a character:</td>
                <td><select name='character' width='50' >
                    <option value='0'></option>
                    ".showCharacters()."
                </select></td>
            </tr>
            <br/>
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
            <tr>
                <input type='submit' name='telesubmit' value='Teleport'/>
            </tr>
        </form>";
    }
}
?>