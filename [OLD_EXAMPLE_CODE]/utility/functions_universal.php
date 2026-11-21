<?php

/**
 * @author megosh
 * @copyright 2010
 */
 
require_once ('header.php');

//=========================================================================
//   UNIVERSAL FUNCTIONS
//=========================================================================	

function save_log_file($data, $filename = "general_error.log")
{
	global $config;
	$savename = $config['debug_log_dir'];
	$savename.= $filename;
	$time = date("Y-m-d H:i:s");
	$msg = "--------------ERROR-----------\r\nDate:  $time\r\n\r\n".$data."\r\n\r\n----------END-ERROR-----------\r\n";
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
function save_to_file($data, $filename = "save_file.log")
{
    global $config;
	$savename = $config['debug_log_dir'];
	$savename.= $filename;
	$time = date("Y-m-d H:i:s");
	$msg = $data;
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
function show_popup($txt, $timer=0)
{
	echo "<script type='text/javascript'>
		TINY.box.show(\"$txt\",0,0,0,0,$timer);
	</script>";
}
/*function execute_query($query, $error = "")
{
	$query_result = @mysql_query($query);
	if ($query_result)
		return $query_result;
	else
	{
		save_log_file($query.mysql_error(), "sql_query_error.log");
		die("<br>SQL Error. This has been loged.<br>");
		return false;
	}
}*/
function allowed_characters($onlyallowedchars_func_input) 
{ 
	$input = (string)$onlyallowedchars_func_input; 
	$allowed = "ABCDEFGHIJKLMNOPQURSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890!@#$%_-"; 
	$l = strlen($input);
	for ($i = 0;$i < $l; $i++) 
	{ 
		if (!strstr($allowed, strtolower($input{$i}))) 
			return false; 
	} 
	return true; 
}
function allowed_characters_ip($onlyallowedchars_func_input) 
{ 
	$input = (string)$onlyallowedchars_func_input; 
	$allowed = ".1234567890."; 
	$l = strlen($input);
	for ($i = 0;$i < $l; $i++) 
	{ 
		if (!strstr($allowed, strtolower($input{$i}))) 
			return false; 
	} 
	return true; 
}

function sha_password($user,$pass)
{
    $user = strtoupper($user);
    $pass = strtoupper($pass);
    return strtoupper(SHA1($user.':'.$pass));
}
function check_email_address($email) 
{
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    return false;
  }
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
      return false;
    }
  }
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
      return false;
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}
function sec_to_days_hours_mins_sec($time)
{
    $days = floor($time/60/60/24);
    $hours = $time/60/60%24;
    $mins = $time/60%60;
    $secs = $time%60;
    if ($days)
    {
        $txt = $days." Day(s)";
        if ($hours)
            $txt.= ", $hours Hour(s)";
        if ($mins)
            $txt.= ", $mins Minute(s)";
    }
    else if ($hours)
    {
        $txt = $hours." Hour(s)";
        if ($mins)
            $txt.=", $mins Minute(s)";
    }
    else if ($mins)
        $txt = $mins." Minute(s)";
    else
        $txt = "N/A";
    return $txt;
}
function endKey($array)
{
    end($array);
    return key($array);
}
function copper_to_gsc($amnt)
{
    $gold = floor($amnt/10000);
    $silver = floor($amnt/100%100);
    $copper = floor($amnt%100);
    
    return $gold."g ".$silver."s ".$copper."c";
}
function back($text = "Back")
{
    return "<a href='".$_SERVER['HTTP_REFERER']."'>".$text."</a>";
}
function ShortenText($text, $chars = 30) 
{
    if (strlen($text) >= $chars)
    {    
        $text = $text." "; 
        $text = substr($text,0,$chars); 
        $text = substr($text,0,strrpos($text,' ')); 
        $text = $text."..."; 
    }

    return $text;
}

function is_odd($number)
{
    return $number & 1; // 0 = even, 1 = odd
}

function generate_string()
{
    $length = 4;
    $character = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for ($i = 0; $i < $length; $i++)
    {
        $string .= mt_rand(0, 9);
        $string .= strtoupper($character[mt_rand(0, strlen($character))]);
    }
    return $string;
}

?>