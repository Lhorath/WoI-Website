<?php
/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.0.1 - Licence Number VBF4D25FD1
|| # ---------------------------------------------------------------- # ||
|| # Copyright ©2000-2010 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

// ######################## SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);

// ##################### DEFINE IMPORTANT CONSTANTS #######################
define('CVS_REVISION', '$RCSfile$ - $Revision: 32878 $');

// #################### PRE-CACHE TEMPLATES AND DATA ######################
$phrasegroups = array();

$specialtemplates = array();

// ########################## REQUIRE BACK-END ############################
require_once('./global.php');
require_once(DIR . '/includes/class_rss_poster.php');

header('Content-Type: text/xml; charset=utf-8');

if ($result = fetch_file_via_socket('http://version.vbulletin.com/news.xml?v=' . SIMPLE_VERSION . '&id=VBF4D25FD1', array('type' => '')))
{	
	echo $result['body'];
}
else
{
	echo 'Error';
}


/*======================================================================*\
|| ####################################################################
|| # Downloaded: 21:31, Wed Feb 3rd 2010
|| # CVS: $RCSfile$ - $Revision: 32878 $
|| ####################################################################
\*======================================================================*/
?>