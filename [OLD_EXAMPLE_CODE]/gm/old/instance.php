
<font color="white" size="4"><a href="index.php">Promo Checker</a> | <a href="voteitems.php">Items Voted For</a></font><br><br>
<?php

//delete from `character_instance`;

/*Config*/
/*$realmd = array(
'db_host'      => 'localhost',   //ip of db realm
'db_username' => 'cores',      //realm user
'db_password' => 'C0R3$0K',              //realm password
'rdb_name'        => 'realmd',      //realm db name
'cdb_name'		=> 'i_char', 			//char db name
);*/
/*Connect and Select*/
/*$realmd_bc_new_connect = mysql_connect($realmd[db_host],$realmd[db_username],$realmd[db_password]);
$selectdb = mysql_select_db($realmd[rdb_name],$realmd_bc_new_connect);
if (!$realmd_bc_new_connect || !$selectdb)
{
	echo "Could NOT connect to db!";
	die;
}*/
/*Config*/
$db_host = $config['host']; //IP of DB Realm
$db_username = $config['user']; //Realm User
$db_password = $config['pass']; //Realm Password
$rdb_name = $config['realmd_db']; //Realm DB Name
$cdb_name = $config['blizz_char_db']; //Char DB Name

/*Connect*/
$realmd_connect = mysql_connect($db_host,$db_username,$db_password);

if (!$realmd_connect)
{
	die("Could NOT connect to DB:" . mysql_error());
}

/*Select*/
$selectdb = mysql_select_db($rdb_name,$realmd_connect);

if (!$selectdb)
{
	die("Could NOT select DB:" . mysql_error());
}

function onlyallowedchars($onlyallowedchars_func_input) 
{ 
	$input = (string)$onlyallowedchars_func_input; 
	$allowed = "ABCDEFGHIJKLMNOPQURSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
	$l = strlen($input);
	for ($i = 0;$i < $l; $i++) 
	{ 
		if(!strstr($allowed, strtolower($input{$i}))) 
			return false; 
	} 
	return true; 
}

function sha_password2($user,$pass){
    $user = strtoupper($user);
    $pass = strtoupper($pass);
    
    return SHA1($user.':'.$pass);
}
if ($_POST['Submit'])
{
	$username = $_POST['username'];
	$password = sha_password2($username,$_POST['password']);
	if (onlyallowedchars($username) == FALSE)
	{
		echo "<br>INVALID CHARS<br><br><br>";
		return;
	}
	$qry_check_username = mysql_query("SELECT `username` FROM `account` WHERE username='$username'");
	if (mysql_num_rows($qry_check_username) == 0) 
	{
		die('Username does not exist. Check your spelling?');
		return;
	}
	$qry_check_pass = mysql_query("SELECT `sha_pass_hash` FROM `account` WHERE username='$username'");
	if (!$qry_check_pass) 
	{
		die('Could not query:' . mysql_error());
	}
	$qry_check_gmlevel = mysql_query("SELECT `gmlevel` FROM `account` WHERE username='$username'");
	if (!$qry_check_gmlevel) 
	{
		die('Could not query:' . mysql_error());
	}
	$qry_gmlevel = mysql_result($qry_check_gmlevel, 0); //change to result comparable
	if($qry_gmlevel == 0)
	{
		echo "<br>Only a GM can use this tool<br>";
		return;
	}
	$qry_pass = mysql_result($qry_check_pass, 0); //change to result comparable

	//change to chardb and prepare for delete
	$selectdb = mysql_select_db($realmd[cdb_name],$realmd_bc_new_connect);
	if (!$realmd_connect || !$selectdb)
	{
		echo "Could NOT connect to db!";
		die;
	}
	if ($password == $qry_pass)
	{
		echo "Correct password!<br><br>Instance timers have been cleared.";
		mysql_query("DELETE FROM `character_instance`;");
	}
	else
	{
		echo "Wrong pass?";
	}
mysql_close($realmd_connect);
	//mysql_query("DELETE FROM `character_instance`;");
}
else
{
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

Username:  <input type="text" name="username">
<br>
Password:  <input type="password" name="password">
<br>
                <INPUT class=button  
                         tabIndex=5 type=submit 
                         alt="submit" src="images/create_en.gif" 
                         value="Submit" name="Submit">
</form>

<?php
}
?>