<?php
$config['ip'] = "worldofimmortality.servegame.org";
$config['user'] = "abub";
$config['pass'] = "brazil";
$config['char_db'] = "i_char";
$config['world_db'] = "blizz_world";

if(is_numeric($_REQUEST["guid"])){
    $player_guid = $_REQUEST["guid"];
}else {
    $player_guid = 0;
}

mysql_connect($config['ip'], $config['user'], $config['pass']);
mysql_select_db($config['char_db']);

$sql = mysql_query("SELECT `data`, `race`, `gender`, `playerBytes`, `playerBytes2` FROM `characters` WHERE `guid` = '".mysql_real_escape_string($player_guid)."'");
$result = mysql_fetch_array($sql);

$data = explode(' ',$result['data']);
$b = $result['playerBytes'];
$b2 = $result['playerBytes2'];
$ha = ($b>>16)%256;
$hc = ($b>>24)%256;
$fa = ($b>>8)%256;
$sk = $b%256;
$fh = $b2%256;

$item_head = $data[283];
$item_neck = $data[285];
$item_shoulder = $data[287];
$item_shirt = $data[289];
$item_chest = $data[291];
$item_belt = $data[293];
$item_legs = $data[295];
$item_feet = $data[297];
$item_wrist = $data[299];
$item_gloves = $data[301];
$item_finger1 = $data[303];
$item_finger2 = $data[305];
$item_trinket1 = $data[307];
$item_trinket2 = $data[309];
$item_back = $data[311];
$item_main_hand = $data[313];
$item_off_hand = $data[315];
$item_ranged_slot = $data[317];

function wowhead_did($item) {
    global $config;
    mysql_select_db($config['world_db']);
    $sql = mysql_query("SELECT `displayid` FROM `item_template` WHERE `entry` = `".$item."`");
    $displayid = mysql_result($sql, 0);  
    
    echo $displayid;
}

function char_racegender($race, $gender) {

    $char_race = array(
        1 => 'human',
        2 => 'orc',
        3 => 'dwarf',
        4 => 'nightelf',
        5 => 'scourge',
        6 => 'tauren',
        7 => 'gnome',
        8 => 'troll',
        10 => 'bloodelf',
        11 => 'draenei');
        
    $char_gender = array(
        0 => 'male',
        1 => 'female');

    echo $char_race[$race].$char_gender[$gender];
}

function inventory_type($inventory) {    
    
    $inventory_type = array(
        1 => 'item_head',
        2 => 'item_neck',
        3 => 'item_shoulder',
        4 => 'item_shirt',
        5 => 'item_chest',
        6 => 'item_waist',
        7 => 'item_legs',
        8 => 'item_feet',
        9 => 'item_wrists',
        10 => 'item_hands',
        11 => 'item_finger1',
        11 => 'item_finger2',
        12 => 'item_trinket1',
        12 => 'item_trinket2',
        16 => 'item_back',
        21 => 'item_main_hand',
        22 => 'item_off_hand');
        
    echo $inventory_type[$inventory];
}

?>
<html>
    <head>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html">
        <title>3D Character Viewer</title>
    </head>
    <body>
        <div id="model_scene" align="center">
            <object id="wowhead" type="application/x-shockwave-flash" data="http://static.wowhead.com/modelviewer/ModelView.swf" height="800px" width="600px">
                <param name="quality" value="high">
                <param name="allowscriptaccess" value="always">
                <param name="menu" value="false">
                <param value="transparent" name="wmode">
                <param name="flashvars" value="model=<?php char_racegender($result['race'], $result['gender']); ?>&amp;modelType=16&amp;ha=<?php echo $ha;?>&amp;hc=<?php echo $hc;?>&amp;fa=<?php echo $fa;?>&amp;sk=<?php echo $sk;?>&amp;fh=<?php echo $fh;?>&amp;fc=0&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=0&amp;equipList=1<?php wowhead_did($item_head); ?>,3,<?php wowhead_did($item_shoulder); ?>,16,<?php wowhead_did($item_back); ?>,5,<?php wowhead_did($item_chest); ?>,9,<?php wowhead_did($item_wrist); ?>,10,<?php wowhead_did($item_gloves); ?>,6,<?php wowhead_did($item_belt); ?>,7,<?php wowhead_did($item_legs); ?>,8,<?php wowhead_did($item_feet); ?>,14,<?php wowhead_did($item_off_hand); ?>,21,<?php wowhead_did($item_main_hand); ?>">
                <param name="movie" value="http://static.wowhead.com/modelviewer/ModelViewer.swf">
            </object>
        </div>  
  </body>
</html>