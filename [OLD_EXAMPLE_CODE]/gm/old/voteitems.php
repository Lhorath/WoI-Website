<html>
<head>
<script src="http://www.wowhead.com/widgets/power.js"></script>
</head>
<body>
<center>
<font color="white" size="4"><a href="index.php">Promo Checker</a> | <a href="voteitems.php">Items Voted For</a></font><br><br>
<font size="6"> Rewarded Items</font>
<br>
<br>
Currently, this should only be used as a resource. Only BOP items should be replaced, and all transactions must be approved by an Administrator.
<br>
<br>
<?php

/*Config*/
$realmd = array(
'db_host'      => 'localhost',   //ip of db realm
'db_username' => 'cores',      //realm user
'db_password' => 'C0R3$0K',              //realm password
'rdb_name'        => 'realmd',      //realm db name
'cdb_name'		=> 'i_char', 			//char db name
);

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
function onlyallowedcharsnum($onlyallowedchars_func_input) 
{ 
	$input = (string)$onlyallowedchars_func_input; 
	$allowed = "0123456789"; 
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
	/*Connect and Select*/
	$realmd_bc_new_connect = mysql_connect($realmd[db_host],$realmd[db_username],$realmd[db_password]);
	$selectdb = mysql_select_db($realmd[rdb_name],$realmd_bc_new_connect);
	if (!$realmd_bc_new_connect || !$selectdb)
	{
		echo "Could NOT connect to db!";
		die;
	}
	$username = $_POST['username'];
	$password = sha_password2($username,$_POST['password']);
	$voteid = $_POST['voteid'];
	$playername = $_POST['playername'];
	if (onlyallowedchars($username) == FALSE)
	{
		echo "<br>Invalid Chars in Username<br><br><br>";
		mysql_close();
		return;
	}
	if (onlyallowedchars($playername) == FALSE)
	{
		echo "<br>Invalid Chars in Player Name<br><br><br>";
		mysql_close();
		return;
	}
	if (onlyallowedcharsnum($voteid) == FALSE)
	{
		echo "<br>This is not a valid Vote ID.";
		mysql_close();
		return;
	}
	$qry_check_username = mysql_query("SELECT `username` FROM `account` WHERE username='$username'");
	if (mysql_num_rows($qry_check_username) == 0) 
	{
		die('Username does not exist. Check your spelling?');
		mysql_close();
		return;
	}
	$qry_check_pass = mysql_query("SELECT `sha_pass_hash` FROM `account` WHERE username='$username'");
	if (!$qry_check_pass) 
	{
		die('Could not query:' . mysql_error());
		mysql_close();
		return;
	}
	$qry_check_gmlevel = mysql_query("SELECT `gmlevel` FROM `account` WHERE username='$username'");
	if (!$qry_check_gmlevel) 
	{
		die('Could not query:' . mysql_error());
		mysql_close();
		return;
	}
	$qry_gmlevel = mysql_result($qry_check_gmlevel, 0); //change to result comparable
	if($qry_gmlevel < 0)
	{
		echo "<br>Only a GM level 3 or higher can use this tool<br>";
		mysql_close();
		return;
	}
	$qry_pass = mysql_result($qry_check_pass, 0); //change to result comparable
	if ($password != $qry_pass)
	{
		echo "Wrong pass...?";
		mysql_close();
		return;
	}
	echo " <center> NOTE: All votes made before 2009-12-20 03:32:21 will have an incorrect hour time.</center>
 <br>";
	$loadtable = "<table width='50%' height='1' border='0' valign='top' cellpadding='0' cellspacing='0' id='2'>
		<tr class='votetable'>
		<td class='votetable' align='center'><b>Vote ID</b></td>
		<td class='votetable'><b>Player Name</b></a></td>
		<td class='votetable' align='center'><b>Date Recieved</b></td>
		<td class='votetable' align='center'><b>Item ID</b></a></td>
		<td class='votetable' align='center'><b>Quantity</b></a></td>
		</tr>";
	
	$qery = "SELECT * FROM `voted_for` WHERE";
	if (empty($voteid) && empty($playername))
	{
		echo "<br>Both feilds are blank. Aborting.<br>";
		mysql_close();
		return;
	}
	if (!empty($voteid) && empty($playername))
		$qery.= " `vote_id` = '$voteid'";
	if (empty($voteid) && !empty($playername))
		$qery.= " `char_name` = '$playername'";
	if (!empty($voteid) && !empty($playername))
		$qery.= " `vote_id` = '$voteid' AND `char_name` = '$playername'";
	$qry = mysql_query($qery);
	//echo $qery;
	while ($row = mysql_fetch_array($qry, MYSQL_ASSOC)) 
	{
		$vote_id = $row['vote_id'];
		$acct_id = $row['acc_id'];
		$char_name = $row['char_name'];
		$date = $row['date'];
		$item_link = "<a href='http://www.wowhead.com/?item=".$row['item']."' target='_blank'>".$row['item']."</a>";
		$quantity = $row['num_of_item'];
		$loadtable.= "<tr class='votetable'>
				<td class='votetable' align='center'>$vote_id</td>
				<td class='votetable'>$char_name</td>
				<td class='votetable' align='center'>$date</td>
				<td class='votetable' align='center'>$item_link</td>				
				<td class='votetable' align='center'>$quantity</td>
			</tr>";
	}
	$loadtable.="</table>";
	echo $loadtable;
	mysql_close();
}
else
{
?>
<center> This tool can show items that players voted for. Fill in either Vote ID, Player Name or both.</center>
<br>
 <center> NOTE: All votes made before 2009-12-20 03:32:21 will have an incorrect hour time.</center>
 <br>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

Username:  <input type="text" name="username">
<br>
Password:  <input type="password" name="password">
<br>
Vote ID: <input type="text" name="voteid">
<br>
Player Name: <input type="text" name="playername">
<br>
                <INPUT class=button  
                         tabIndex=5 type=submit 
                         alt="submit" src="images/create_en.gif" 
                         value="Submit" name="Submit">
</form>
<br>
You must be a GM to use this tool.
<?php
}
?>
</center>
</body>
</html>