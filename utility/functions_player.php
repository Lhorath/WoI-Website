<?php

/**
 * @author megosh
 * @copyright 2010
 */
 
require_once ('header.php');

//=========================================================================
//   PLAYER FUNCTIONS
//=========================================================================	

function pinfo($playername)
{
    global $config, $def;
    
    $plr = new Player;
    $cdb = new db(getchardb());
    $rdb = new db($config['realm_db']);
    
    $charinfo = $cdb->fetchRow("SELECT * FROM `characters` WHERE `name` = '$playername' LIMIT 1");
    if (!$charinfo)
        return false;
        
    $plr->account_id = $charinfo['account'];
    $plr->guid = $charinfo['guid'];
    $plr->name = $charinfo['name'];
    $plr->race = $def['character_race'][$charinfo['race']];
    $plr->class = $def['character_class'][$charinfo['class']];
    $plr->gender = $def['character_gender'][$charinfo['gender']];
    $plr->level = $charinfo['level'];
    $plr->xp = $charinfo['xp'];
    $plr->money = $charinfo['money'];
    $plr->online = $charinfo['online'];
    $plr->playedtime = $charinfo['totaltime'];
    if ($charinfo['at_login'] & 1)
        $atlogin .= "Force character to change name, ";
    if ($charinfo['at_login'] & 2)
        $atlogin .= "Reset spells (professions as well), ";
    if ($charinfo['at_login'] & 4)
        $atlogin .= "Reset talents, ";
    if ($charinfo['at_login'] & 8)
        $atlogin .= "Customize character, ";
    if (!$atlogin)
        $atlogin = "Nothing.";
    $plr->atlogin = $atlogin;
    $plr->zone = $charinfo['zone'];
    $plr->zonename = get_zone_name($charinfo['zone']);
    
    $accinfo = $rdb->fetchRow("SELECT * FROM `account` WHERE `id` = '".$plr->account_id."'");
    
    if (!$accinfo)
        return false;
    
    $plr->account_name = $accinfo['username'];
    $plr->email = $accinfo['email'];
    $plr->joindate = $accinfo['joindate'];
    $plr->last_ip = $accinfo['last_ip'];
    $plr->last_login = $accinfo['last_login'];
    
    return $plr;
}

function social_list($player_guid, $flags = 1)
{
    global $config;
    $cdb = new db(getchardb());
    $data = $cdb->fetch("SELECT * FROM `character_social` WHERE `guid` = '$player_guid' AND `flags` = '$flags'");
    if (!$data)
        return false;
    $string = '';
    $end = endKey($data);
    $i = 0;
    foreach ($data as $row)
    {
        $string .= $row['friend'];
        $note[$i] = $row['note'];
        if ($i < $end)
            $string .= ", ";
        $i++;
    }
    unset($data);
    unset($row);
    $data = $cdb->fetch("SELECT `name` FROM `characters` WHERE guid IN($string)");
    $i = 0;
    foreach ($data as $row)
    {
        $result[$i][0] = $row['name'];
        $result[$i][1] = $note[$i];
        $i++;
    }
    return $result;
}

function player_tickets($player_guid)
{
    global $config;
    $cdb = new db(getchardb());
    $data = $cdb->fetch("SELECT * FROM `gm_tickets` WHERE `playerGuid` = '$player_guid' ORDER BY guid DESC");
    if (!$data)
        return false;
    $i = 0;
    foreach ($data as $row)
    {
        $data[$i][0] = $row['guid'];
        $data[$i][1] = $row['message'];
        $i++;
    }
    return $data;
}

function player_spells($player_guid)
{
    global $config;
    $cdb = new db(getchardb());
    $data = $cdb->fetch("SELECT * FROM `character_spell` WHERE `guid` = '$player_guid' ORDER BY spell DESC");
    if (!$data)
        return false;
    $i = 0;
    foreach ($data as $row)
    {
        $data[$i][0] = $row['spell'];
        $data[$i][1] = $row['disabled'];
        $i++;
    }
    return $data;
}

function player_auras($player_guid)
{
    global $config;
    $cdb = new db(getchardb());
    $data = $cdb->fetch("SELECT * FROM `character_aura` WHERE `guid` = '$player_guid' ORDER BY spell DESC");
    if (!$data)
        return false;
    $i = 0;
    foreach ($data as $row)
    {
        $data[$i][0] = $row['spell'];
        $data[$i][1] = $row['stackcount'];
        $i++;
    }
    return $data;
}

function player_items($player_guid)
{
    global $config;
    $cdb = new db(getchardb());
    $data = $cdb->fetch("SELECT * FROM `character_inventory` WHERE `guid` = '$player_guid' ORDER BY item_template DESC");
    if (!$data)
        return false;
    $i = 0;
    foreach ($data as $row)
    {
        $data[$i][0] = $row['item_template'];
        $i++;
    }
    return $data;
}

class Player
{
	public $name;
	public $guid;
	public $account_id;
	public $account_name;
	public $race;
	public $class;
	public $gender;
	public $level;
	public $xp;
	public $money;
	public $online;
	public $playedtime;
	public $atlogin;
	public $zone;
	public $zonename;
	public $lastip;
	public $email;
	public $joindate;
	public $last_ip;
	public $last_login;
}
?>