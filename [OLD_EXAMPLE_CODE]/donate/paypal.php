<?php

class PayPal
{
	private $sql;
	
	function __construct(&$sql)
	{
		$this->sql = $sql;
	}
	
	function handleCompleted()
	{
		//check txn id recycling
		$user = addslashes($_POST['payer_email']);
		$txn = addslashes($_POST['txn_id']);
		$amount = addslashes($_POST['mc_gross']);
		$account = addslashes($_POST['custom']);
		
		if($this->sql->getField("SELECT COUNT(*) FROM ds_logs WHERE transaction_id='$txn'") != 0)
		{
			//recycled.
			$this->sql->query("INSERT INTO ds_logs (status,gateway,user,date,transaction_id,amount,account,info) VALUES (1,'PayPal','$user',NOW(),'$txn','$amount','$account','Transaction id was recycled.')");
			return false;
		}
		
		//we're all good.
		//log it
		$this->sql->query("INSERT INTO ds_logs (status,gateway,user,date,transaction_id,amount,account) VALUES (0,'PayPal','$user',NOW(),'$txn','$amount','$account')");
		return array($account,$amount);
	}
	
	function handleReversed()
	{
		global $CONFIG;
		$account = addslashes($_POST['custom']);
		$txn = addslashes($_POST['parent_txn_id']);
		//auto-ban?
		if($CONFIG['autoBan'] == true)
		{
			$a = new Auth($this->sql);
			$a->ban($account);
			$info = ' Auto-banned.';
		}
		$this->sql->query("UPDATE ds_logs SET status=1,info='Payment reversed.$info' WHERE status=0 AND transaction_id='$txn'");
	}
	
	function handleRefunded()
	{
		global $CONFIG;
		$account = addslashes($_POST['custom']);
		$txn = addslashes($_POST['parent_txn_id']);
		$this->sql->query("UPDATE ds_logs SET status=1,info='Payment refunded by you.' WHERE status=0 AND transaction_id='$txn'");
	}
	
	function handleBadPayment()
	{
		$user = addslashes($_POST['payer_email']);
		$status = addslashes($_POST['payment_status']);
		$txn = addslashes($_POST['txn_id']);
		$amount = addslashes($_POST['mc_gross']);
		$account = addslashes($_POST['custom']);
		$this->sql->query("INSERT INTO ds_logs (status,gateway,user,date,transaction_id,amount,account,info) VALUES (1,'PayPal','$user',NOW(),'$txn','$amount','$account','Payment status was: $status.')");
	}
	
	function handleVerified()
	{
		global $CONFIG;
		if($_POST['receiver_email'] != $CONFIG['paypal']['email'])
		{
			//if its not sent to us, we won't care any way.
			//log it and quit.
			$user = addslashes($_POST['payer_email']);
			$recv = addslashes($_POST['receiver_email']);
			$txn = addslashes($_POST['txn_id']);
			$amount = addslashes($_POST['mc_gross']);
			$account = addslashes($_POST['custom']);
			$this->sql->query("INSERT INTO ds_logs (status,gateway,user,date,transaction_id,amount,account,info) VALUES (1,'PayPal','$user',NOW(),'$txn','$amount','$account','Payment was sent to $recv, not you.')");
			return false;
		}
		switch($_POST['payment_status'])
		{
		case 'Completed':
			return $this->handleCompleted();
			break;
		case 'Reversed':
			$this->handleReversed();
			return false;
			break;
		case 'Refunded':
			$this->handleRefunded();
			return false;
			break;
		default:
			$this->handleBadPayment();
			return false;
			break;
		}
	}
	
	function handleInvalid()
	{
		$user = addslashes($_POST['payer_email']);
		$txn = addslashes($_POST['txn_id']);
		$amount = addslashes($_POST['mc_gross']);
		$account = addslashes($_POST['custom']);
		$this->sql->query("INSERT INTO ds_logs (status,gateway,user,date,transaction_id,amount,account,info) VALUES (2,'PayPal','$user',NOW(),'$txn','$amount','$account','Request declared invalid by PayPal.')");
	}
	
	function validate()
	{
		global $CONFIG;
		
		if(empty($_POST))
			return false; //no data posted, skip.
			
		//ask paypal if the donation is valid
		$post = 'cmd=_notify-validate';
		foreach($_POST as $key => $value)
		{
			$post .= "&$key=$value";
		}
		
		//connect to paypal
		$addr = $CONFIG['test'] == true ? 'www.paypal.com' : 'www.sandbox.paypal.com';
		$sock = fsockopen($addr,80);
		if(!$sock)
		{
			trigger_error('Failed to connect to PayPal.',E_USER_ERROR);
		}
		
		//send for validation
		$head .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$head .= "Content-type: application/x-www-form-urlencoded\r\n";
		$head .= "Content-length: ".strlen($post)."\r\n\r\n";
		fputs($sock,$head.$post,strlen($head.$post));
		while(!feof($sock))
		{
			$recv = fgets($sock,256);
			if(!strcmp($recv,'VERIFIED'))
			{
				fclose($sock);
				return $this->handleVerified();
			}
			if(!strcmp($recv,'INVALID'))
			{
				fclose($sock);
				$this->handleInvalid();
				return false;
			}
		}
	}
	
}
?>