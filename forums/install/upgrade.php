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

//this file needs to parse with php4 so that we can do the version check
//otherwise we end up with some ugly parse errors.
//we don't include the language file to translate this error because that
//starts getting into other dependancies that might not not work in php4
if (!function_exists('version_compare') OR version_compare(PHP_VERSION, '5.0.0', '<'))
{
	echo "Upgrade not compatible with PHP 4";
	exit;
}

require_once('./upgrademain.php');

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 21:31, Wed Feb 3rd 2010
|| # CVS: $RCSfile$ - $Revision: 34709 $
|| ####################################################################
\*======================================================================*/
