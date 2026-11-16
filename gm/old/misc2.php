<html>
<body>
<center>
<?php
$disabled = true;
if ($disabled == true)
    die('Tool Disabled');

/*Config*/
$realmd = array(
'db_host'      => 'localhost',   //ip of db realm
'db_username' => 'root',      //realm user
'db_password' => 'root',              //realm password
'rdb_name'        => 'dev_world',      //realm db name
'cdb_name'		=> 'fun_world', 			//char db name
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
function sha_password2($user,$pass){
    $user = strtoupper($user);
    $pass = strtoupper($pass);
    
    return SHA1($user.':'.$pass);
}
if ($_POST['Submit'])
{
    mysql_select_db($realmd[rdb_name],$realmd_bc_new_connect);
    $x = 0;
    while ($row = mysql_fetch_array($qry, MYSQL_ASSOC)) 
	{
        $fundata[x][0] = $row["unit_class"];
        $x++;
	}
    mysql_select_db($realmd[rdb_name],$realmd_bc_new_connect);
    $i = 0;
	$qry = mysql_query("select `entry`, `unit_class` from `creature_template_tdb`");
	while ($row = mysql_fetch_array($qry, MYSQL_ASSOC)) 
	{
        $devdata[x][0] = $row["unit_class"];
        $i++;
	}
    echo "<br><br>".$i." Queries Made.<br><br>";
	
	
	
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