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
    function save_log_file($entry, $spell, $reqlvl, $cost)
    {
        $savename= "fix_health_killcredit.sql";
        $msg = "INSERT INTO `npc_trainer` (entry, spell, spellcost, reqskill, reqskillvalue, reqlevel) VALUES ('$entry', '$spell', '$cost', '0', '0', '$reqlvl');\r\n";
        if (!$fp=@fopen($savename,"a")) 
        {
          echo "<br>Error logging failed, could not open log file.<br />";
        }
        if (!@fwrite($fp,$msg)) 
        {
            echo "<br>Error Logging failed, could not write to log file.<br />";
        }
        @fclose($fp);
    }
    
    $i = 0;
	$qry = mysql_query("select `entry` from `npc_trainer` WHERE `spell` = '3044'");
    $spell = '883';
    $reqlvl = '7';
    $cost = '500';
    
	while ($row = mysql_fetch_array($qry, MYSQL_ASSOC)) 
	{
        save_log_file($row["entry"], $spell, $reqlvl, $cost);
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