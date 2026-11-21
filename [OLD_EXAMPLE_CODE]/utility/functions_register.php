<?php

/**
 * @author megosh
 * @copyright 2010
 */
 
require_once ('header.php');

//=========================================================================
//   REGISTER FUNCTIONS
//=========================================================================	

function register($username, $password, $conf_pass, $email, $conf_email)
{
	global $config;
	if ($config['acc_create'] == false)
	{	
		echo "<center><font color='RED'>Online registration is currently disabled.</font></center><br>";
		return;
	}
	if (allowed_characters($password) == FALSE)
	{
		echo "<center>Error creating account.<br><br>Invalid symbols in password.</center>";
		return;
	}
	else if (allowed_characters($username) == FALSE)
	{
		echo "<center>Error creating account.<br><br>Invalid symbols in username.</center>";
		return;
	}
	else if (check_email_address($email) == FALSE)
	{
		echo "<center>Error creating account.<br><br>Invalid email address.</center>";;
		return;
	}
	else if (strlen($username) < $config['acc_min_chars_username'])
	{
		echo "<center>Error creating account.<br><br>Your account name needs to be at least ".$config['acc_min_chars_username']." long.</center>";;
		return;
	}
	else if (strlen($password) < $config['acc_min_chars_pass'])
	{
		echo "<center>Error creating account.<br><br>Your password needs to be at least ".$config['acc_min_chars_pass']." long.</center>";;
		return;
	}
	else if ($password != $conf_pass)
	{
		echo "<center>Error creating account.<br><br>The passwords you enter do not match.</center>";;
		return;
	}
	else if ($email != $conf_email)
	{
		echo "<center>Error creating account.<br><br>The email addresses you entered do not match.</center>";;
		return;
	}
	$rdb = new db($config['realm_db']);
	$qry_check_username = $rdb->fetchCell("SELECT username FROM `account` WHERE username='$username'");
	$sha_password = sha_password($username,$password);
	if ($qry_check_username)
	{
		echo "<center>Error creating account.<br><br>Account already exists.</center>";
		return;
	}
	else
	{
		$username = strtoupper($username);//convert username to UPPERCASE
		$rdb->exec("INSERT INTO account (`username`,`sha_pass_hash`,`email`,`locked`,`expansion`,`last_ip`) VALUES ('$username','$sha_password','$email','$config[acc_create_lock]','2', '".getenv("REMOTE_ADDR")."')");
		echo "<center>Account created.</center>";
	}
	mysql_close();
}
?>