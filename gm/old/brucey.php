<font color="white" size="4"><a href="index.php">Promo Checker</a> | <a href="voteitems.php">Items Voted For</a></font><br><br>

<?php

/*Connecting*/
$db_host = 'localhost';
$db_username = 'root';
$db_password = 'P*L&j%2';
$rdb_name = 'realmd';
$cdb_name = 'i_char_restore_2';

/*Connect*/
$realmd_connect = mysql_connect($db_host,$db_username,$db_password);

if (!$realmd_connect)
{
	die("". mysql_error());
}

?>