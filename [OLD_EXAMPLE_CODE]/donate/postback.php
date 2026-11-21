<?php
require("includes.php");
set_time_limit(15);

function handlePayment()
{
    global $config;
    $d = new db($config['realm_db']);
	
	$Itemcount = (int)$_POST['num_cart_items'];
	$Money = (float)$_POST['mc_gross'];
    $account_id = 0;
    
    //Get info of each item.
	for($i = 1;$i<=$Itemcount;$i++)
	{
		$quantity = (int)$_POST['quantity'.$i];
		for ($j = 0;$j<$quantity;$j++)
		{
			$info = explode("-",$_POST['item_number'.$i]);
			$Items[$j+$i-1]["id"] = (int)$info[1]; // reward id
			$Items[$j+$i-1]["realm"] = (int)$info[0]; // realm id
			$Items[$j+$i-1]["character"] = (int)$info[2]; // account id
            (int)$account_id = (int)$info[2];
		}
	}
    
	//Prevent txn_id recycling.
	$res = $d->fetchCell("SELECT COUNT(*) FROM donation_log WHERE txn_id = '{$_POST['txn_id']}'");
	if($res != 0)
	{
		$d->exec("INSERT INTO donation_log (date,email,txn_id,status,amount,info,account_id) VALUES (NOW(),'{$_POST['payer_email']}','{$_POST['txn_id']}','failed','{$_POST['mc_gross']}','This transaction id is a duplicate.', $account_id)");
		die;
	}
	
	//Check payment status.
	if($_POST['payment_status'] != "Completed")
	{
		$d->exec("INSERT INTO donation_log (date,email,txn_id,status,amount,info,account_id) VALUES (NOW(),'{$_POST['payer_email']}','{$_POST['txn_id']}','failed','{$_POST['mc_gross']}','Payment status was not \"Completed\", but \"{$_POST['payment_status']}\".', $account_id)");
		die;
	}
	
	//Check availability of rewards on realms.
	foreach($Items as $key => $value)
	{
        if($config['dn_coin_prices'][$value['id']][0] == '')
		{
			$d->exec("INSERT INTO donation_log (date,email,txn_id,status,amount,info,account_id) VALUES (NOW(),'{$_POST['payer_email']}','{$_POST['txn_id']}','failed','{$_POST['mc_gross']}','Requested reward id ".$value['id'].", which is not available on realm ".$value['realm'].".',$account_id)");
			die;
		}
	}
	
	//Check total payment amount.
	$sum = 0;
	foreach($Items as $key => $value)
	{
		$sum += (float)$config['dn_coin_prices'][$value["id"]][2];
	}
	if($sum > $Money)
	{
		$info = "";
		foreach($Items as $key => $value)
		{
			$info .= "Reward: ".$config['dn_coin_prices'][$value['id']][0]." Cost: ".$config['dn_coin_prices'][$value['id']][2]."<br>\n";
		}
		$d->exec("INSERT INTO donation_log (date,email,txn_id,status,amount,info,account_id) VALUES (NOW(),'{$_POST['payer_email']}','{$_POST['txn_id']}','failed','{$_POST['mc_gross']}','Cost of rewards ({$sum}) was not paid in full:<br>\n{$info}', $account_id)");
		die;
	}
	
	//Begin rewarding items.
	foreach($Items as $key => $value)
	{
        $d->exec("INSERT INTO `donation_coins` (id, coins) VALUES ('".$value['character']."', '".$config['dn_coin_prices'][$value['id']][1]."') ON DUPLICATE KEY UPDATE `coins` = `coins` + '".$config['dn_coin_prices'][$value['id']][1]."'");
    }
	
	//log time
	$Info = "Successful transaction:<br>\n";
	foreach($Items as $key => $value)
	{
		$Info .= $config['dn_coin_prices'][$value['id']][0]."<br>\n";
	}
	$d->exec("INSERT INTO donation_log (date,email,txn_id,status,amount,info,account_id) VALUES (NOW(),'{$_POST['payer_email']}','{$_POST['txn_id']}','completed','{$_POST['mc_gross']}','{$Info}', {$account_id})");
}
//instead of character it used to say account_id at the end of the previous line.
function handleInvalidPayment()
{
    global $config;
	$Info = "";
	foreach($_POST as $key => $value)
	{
		$Info .= "{$key} = {$value} <br>\n";
	}
    $d = new db($config['realm_db']);
    $data = $d->exec("INSERT INTO donation_log (date,status,info) VALUES (NOW(),'invalid','An invalid request was made. Postdata info:<br>\n{$Info}')");
}

function verifyPayment()
{
    global $config;
	if(sizeof($_POST) == 0)
	{
		//dont bother, maybe an accidental page visit.
		?><h1>Restricted Area</h1>
		<p>You are not permitted to access this page.</p><?php
		return;
	}
	$Postback = "cmd=_notify-validate";
	foreach($_POST as $key => $value)
	{
		$key = urlencode(stripslashes($key));
		$value = urlencode(stripslashes($value));
		$Postback .= "&{$key}={$value}";
	}
	$Sock = fsockopen("www.paypal.com",80,$errno,$errstr,30);
	if(!$Sock)
	{
		//handleInvalidPayment();
	}
	$Head .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$Head .= "Content-type: application/x-www-form-urlencoded\r\n";
	$Head .= "Content-length: ".strlen($Postback)."\r\n\r\n";
	fputs($Sock,$Head.$Postback,strlen($Head.$Postback));
	while(!feof($Sock))
	{
		$txt = fgets($Sock,1024);
		if(strcmp($txt,"VERIFIED") == 0)
		{
			handlePayment();
		}
		elseif(strcmp($txt,"INVALID") == 0)
		{
			handleInvalidPayment();
		}
	}
	fclose($Sock);
}

verifyPayment();

?>