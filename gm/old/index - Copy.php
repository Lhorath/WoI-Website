<html>
<body>
<center>
<font color="white" size="4"><a href="index.php">Promo Checker</a> | <a href="voteitems.php">Items Voted For</a></font><br><br>
<font size="6"> Promotion Checker </font>
<br>
<br>
<?php

//delete from `character_instance`;

/*Config*/
$realmd = array(
'db_host'      => 'localhost',   //ip of db realm
'db_username' => 'root',      //realm user
'db_password' => 'root',              //realm password
'rdb_name'        => 'i_realmd',      //realm db name
'cdb_name'		=> 'i_char', 			//char db name
);
/*Connect and Select*/
$realmd_bc_new_connect = mysql_connect($realmd[db_host],$realmd[db_username],$realmd[db_password]);
$selectdb = mysql_select_db($realmd[rdb_name],$realmd_bc_new_connect);
if (!$realmd_bc_new_connect || !$selectdb)
{
	echo "Could NOT connect to db!";
	die;
}
function onlyallowedchars($onlyallowedchars_func_input) 
{ 
	$input = (string)$onlyallowedchars_func_input; 
	$allowed = "0ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
	$l = strlen($input);
	for ($i = 0;$i < $l; $i++) 
	{ 
		if(!strstr($allowed, strtolower($input{$i}))) 
			return false; 
	} 
	return true; 
}
function onlyallowedcharsip($onlyallowedchars_func_input) 
{ 
	$input = (string)$onlyallowedchars_func_input; 
	$allowed = "1234567890."; 
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
	$ip = $_POST['ipdd'];
	if (onlyallowedchars($username) == FALSE)
	{
		echo "<br>INVALID CHARS<br><br><br>";
		return;
	}
	if (onlyallowedcharsip($ip) == FALSE)
	{
		echo "<br>This is not an ip address.";
		return;
	}
	$qry_check_username = mysql_query("SELECT `id` FROM `account` WHERE username='$username'");
	if (mysql_num_rows($qry_check_username) == 0) 
	{
		die('Username does not exist. Check your spelling?');
		return;
	}
	$qry_check_pass = mysql_query("SELECT `sha_pass_hash` FROM `account` WHERE username='$username'");
	if (!$qry_check_pass) 
	{
		die('Could not query:' . mysql_error());
		return;
	}
	$acctid = mysql_result($qry_check_username, 0);
	$qry_check_gmlevel = mysql_query("SELECT `gmlevel` FROM `account_access` WHERE id='$acctid'");
	if (!$qry_check_gmlevel) 
	{
		die('Could not query:' . mysql_error());
		return;
	}
	$qry_gmlevel = mysql_result($qry_check_gmlevel, 0); //change to result comparable
	if($qry_gmlevel == 0)
	{
		echo "<br>Only a GM can use this tool<br>";
		return;
	}
	$qry_pass = mysql_result($qry_check_pass, 0); //change to result comparable
	if ($password != $qry_pass)
	{
		echo "Wrong pass?";
		return;
	}
	$qry = mysql_query("SELECT `id`,`username` FROM `account` WHERE `last_ip` = '$ip'");
	$numofacct = mysql_num_rows($qry);
	$i = 0;
	
	while ($row = mysql_fetch_array($qry, MYSQL_ASSOC)) 
	{
		$account_array[$i][0] = $row["id"];
		$account_array[$i][1] = $row["username"];
		$i++;
	}
	$tot_accnts = $i;
	if ($tot_accnts == 0)
	{
		echo "<br>There are no accounts on this IP.<br>";
		return;
	}
	
	$selectdb = mysql_select_db($realmd[cdb_name],$realmd_bc_new_connect); // CHANGE TO CHAR DB
	$i = 0;
	while($i < $tot_accnts)
	{
		$qry = mysql_query("SELECT `name` FROM `characters` WHERE `account` = ".$account_array[$i][0]." and `level` = '80'");
		$t80onacct = mysql_num_rows($qry);
		echo "Account array $i, account ID ".$account_array[$i][0]." Username: ".$account_array[$i][1].". Account has $t80onacct level 80(s).<br>";
		$total_80s = $t80onacct + $total_80s;
	$i++;
	}
	//$total_80s = $total_80s + 1;
	//if ($total_80s == 0)
	
	
	echo "<br><br>Player IP: $ip has $tot_accnts total account(s) and $total_80s level 80(s).<br><br>";
	if($total_80s > 0)
	{
		echo "<font>Transfer is not recomended. Please inform the player that there is only 1 lvl 80 per IP/person.";
	}
	else
	{
		echo "Transfer is approved. Please remind the player that there is only 1 transfer per person.";
	}
	
	
	mysql_close($realmd_bc_new_connect);
}
else
{
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

Username:  <input type="text" name="username">
<br>
Password:  <input type="password" name="password">
<br>
IP: <input type="text" name="ipdd">
<br>
                <INPUT class=button  
                         tabIndex=5 type=submit 
                         alt="submit" src="images/create_en.gif" 
                         value="Submit" name="Submit">
</form>

<?php
}
?>
<br>
<br>
You must be a GM to use this tool.
</center>
</body>
</html>