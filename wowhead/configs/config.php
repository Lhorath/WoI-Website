<?php
global $AoWoWconf;

// -- MaNGOS Database --
$AoWoWconf['mangos']['host']	= '127.0.0.1';
$AoWoWconf['mangos']['user']	= 'cores';
$AoWoWconf['mangos']['pass']	= 'C0R3$0K';
$AoWoWconf['mangos']['db']	= 'blizz_world2';
$AoWoWconf['mangos']['aowow']	= 'aowow_'; // AoWoW table prefix
// -- Realmd Database --
$AoWoWconf['realmd']['host']	= '127.0.0.1';
$AoWoWconf['realmd']['user']	= 'cores';
$AoWoWconf['realmd']['pass']	= 'C0R3$0K';
$AoWoWconf['realmd']['db']	= 'auth';
// -- Characters Database -- currently unused
$AoWoWconf['characters']['host']	= '127.0.0.1';
$AoWoWconf['characters']['user']	= 'cores';
$AoWoWconf['characters']['pass']	= 'C0R3$0K';
$AoWoWconf['characters']['db']	= 'b_char';
// -- Site Configuration --
// Title of the website
$AoWoWconf['aowow']['name'] = 'World of Immortality Wowhead';
// Skin, only 'wowhead' is supported currently
$AoWoWconf['aowow']['template'] = 'wowhead';
// Time to keep cache in seconds (Default: 1 week)
$AoWoWconf['aowow']['cache_time'] = (60*60*24*7);
// Default locale
$AoWoWconf['locale'] = 0;
// Allow account creating
$AoWoWconf['register'] = true;
// Used with register, account expansion
$AoWoWconf['expansion'] = 2;
// Limit of some SQL queries
$AoWoWconf['limit'] = 300;
// Disable cache, show smarty console panel
$AoWoWconf['debug'] = false;
// Map object grouping factor. Meters = 10^param.
// 0 to disable.
// 1 is default and highly recommended.
// Do not use float values or values > 3.
$AoWoWconf['map_grouping'] = 0;

?>