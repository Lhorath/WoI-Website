<?php
include_once("includes.php");

$structure = new Structure;

if ($_GET['alert'] = true)
{
    $msg = "<script type='text/javascript'> 
        function show_alert() { 
        alert('You must agree to our ToS!'); 
        }
        </script>";
}  

$structure->Header($msg);

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu('donate');

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Donate to World of Immortality</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left">
					
					
					
					
					<!-- New donation form
					
					
					
                        <script type="text/javascript"> 
                    function GetPrice()
                    {
                        var id = document.getElementById("item").value;
                        price = id.split("-");
                        aid = "<?php echo getuserid(); ?>";
                        usrnme = "<?php echo getaccount(); ?>";
                        document.getElementById("amount").value = price[0];
                        document.getElementById("item_name").value = price[1]+' for '+usrnme;
                        document.getElementById("item_number").value = '1-'+price[2]+'-'+aid;
                    }
                </script>
                <?php
                    if (!getuserid())
                        echo "<div align='center'><br><br><br><br><br>".send_login('black')."<br><br><br><br><br></div>";
                    else
                    {
                ?>
                        <br /><br />
                        <font face="arial" size="4">
                        By donating you agree to be bound by our <a href="index.php"><u><font color='green'>donation terms and conditions.</font></u></a></font><br><br>
                        <font color='#484848'>All amounts are in US($) Dollars</font>
                        <br /><br />
                        <br />
                        <br />
                        <form action="<?php echo $config['paypal_url']; ?>" method="post" onsubmit="GetPrice()">
                        <table border="0" align="center" cellpadding="0">
                            <tr>
                                <td scope="col">Select Option: </td> 
                                <td scope="col">
                                    <select id="item" name="item" onchange="GetPrice()">
                                    <?php echo BuildDonationForm(); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                            <td align='center' colspan='2'>
                                <input type="hidden" name="add" value="1" />
                                <input type="hidden" name="cmd" value="_donations" />
                                <input type="hidden" name="notify_url" value="<?php echo $config['paypal_postback_url'];?>" />
                                <input type="hidden" id="item_name" name="item_name" value="" />
                                <input type="hidden" id="id" name="id" value="1" />
                                <input type="hidden" id="amount" name="amount" value="" />
                                <input type="hidden" id="item_number" name="item_number" value="" />
                                <input type="hidden" name="quantity" value="" />
                                <input type="hidden" name="business" value="<?php echo $config['paypal_email']; ?>" />
                                <input type="hidden" name="currency_code" value="<?php echo $config['paypal_currency']; ?>" />
                                <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_cart_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" />
                            </td>
                            </tr>
                        </table>
                        </form>
                        <br /><br /><br />
                        <br /><br /><br />
                <?php
                    }       
                ?>
				
				-->
				
				<table width="500" border="0"><tr><td>Please select the item that you would like to donate for below.  If you would like to donate for more than one item or multiple copies of the same item, please use the option at the bottom to make a single, easy payment.
                        <br>
                        <br>
                        
                        By donating you agree to be bound by our <a href="donate.php"><u>donation terms and conditions.</u></a></td></tr>
                    </table>
                    <font color="white" face="arial" size="3">
                    <br>
                    <br>
					<center><font color="black" face="verdana" size="4">Immortality (Blizzlike)</font></center>
					<center>
                    <table width="500" bgcolor="#336699" border="1">

					
					                        <tr>
                            <td><font color="white">INSTANT Cast Mount - Your choice of a Magic Rooster, Swift Magic Broom, or Swift Flying Broom (limited time only!)</font></td>
                            <td><font color="white">$20.00 USD</font></td>
                            <td>
                                <center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="23NMSQZRZ2JKC">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

                                </center>
                            </td>
                        </tr>

					
					
                        <tr>
                            <td><font color="white">10,000 Gold</font></td>
                            <td><font color="white">$10.00 USD</font></td>
                            <td>
                                <center>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="6631032">
                                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>
                                </center>
                            </td>
                        </tr>

                        <tr>
                            <td width="400"><font color="white">Level 80 Promo - Level 80 with full blue gear</font></td>
                            <td width="100"><font color="white">$15.00 USD</font></td>
                            <td width="100">
                                <center>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="6630708">
                                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>
                                </center>
                            </td>
                        </tr>

                        <tr>
                            <td width="400"><font color="white">Tier 7 Armor Set - 5 piece</font></td>
                            <td width="100"><font color="white">$20.00 USD</font></td>
                            <td width="100">
                                <center>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="6630784">
                                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td width="400"><font color="white">Tier 7.5 Armor Set - 5 piece</font></td>
                            <td width="100"><font color="white">$25.00 USD</font></td>
                            <td width="100">
                                <center>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="6630792">
                                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td width="400"><font color="white">Tier 8 Armor Set - 5 piece</font></td>
                            <td width="100"><font color="white">$30.00 USD</font></td>
                            <td width="100">
                                <center>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="6630805">
                                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td width="400"><font color="white">Tier 9 Armor Set - 5 piece</font></td>
                            <td width="100"><font color="white">$35.00 USD</font></td>
                            <td width="100">
                                <center>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="9757032">
                                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td width="400"><font color="white">Tier 8/Season 6 Full Package Promo - Every character slot (Armor, rings, trinkets, weapons, etc.) filled with full Ulduar or Season 6 PvP gear.</font></td>
                            <td width="100"><font color="white">$35.00 USD</font></td>
                            <td width="100">
                                <center>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="8032961">
                                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td width="400"> <font color="white">Tier 9/Season 7 ULTIMATE Promo - Every character slot (Armor, rings, trinkets, weapons, etc.) filled with full Tier 9 PvE or Relentless PvP gear.</font></td>
                            <td width="100"><font color="white">$45.00 USD</font></td>
                            <td width="100">
                                <center>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="9756936">
                                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>
                                </center>
                            </td>
                        </tr>
						
						<tr>
	                            <td width="400"><b><font color="red">***SPECIAL***</font></b> <font color="white">Tier 10/Season 8 ULTIMATE Promo - Every character slot (Armor, rings, trinkets, weapons, etc.) filled with full Tier 10 or Season 8 gear.</font></td>
                            <td width="100"><font color="white">$55.00 USD</font></td>
                            <td width="100" align='center'>
						  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="PPYSWPAZ5L6LU">
						<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</form>
                            </td>
                        </tr>					
						<tr>
			                <td width="400"><b><font color="red">***NEW!***</font></b> <font color="white">Shadowmourne, complete with three epic gems of your choice.</font></td>
                            <td width="100"><font color="white">$45.00 USD</font></td>
                            <td width="100" align='center'>
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="hosted_button_id" value="4KMQBJ5TN3DZJ">
								<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
								<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
								</form>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" width="600">
                                <center><font color="white">If you would like to donate to receive multiple items, please use the donation button below:</font>
                                    <br>
                                    <br>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="6631053">
                                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
										</font></font></font></font>
                                    </form>
                                </center>
                            </td>
                        </tr>
                    </table>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<br />
					<br />
					
					
					
					
					
					<center><font color="black" face="verdana" size="4">Envy (Funserver)</font></center>
					<center>
                    <table width="500" bgcolor="#bb0000" border="1">

                        <tr>
                            <td><font color="white">10,000 Gold</font></td>
                            <td><font color="white">$5.00 USD</font></td>
                            <td>
                                <center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="WGBWF9NL2BGYE">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

                                </center>
                            </td>
                        </tr>

                        <tr>
                            <td width="400"><font color="white">Level 80 Promo - Level 80 with full blue gear</font></td>
                            <td width="100"><font color="white">$10.00 USD</font></td>
                            <td width="100">
                                <center>
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="4V4723DM3AK36">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

                                </center>
                            </td>
                        </tr>


                        <tr>
                            <td width="400"><font color="white">Tier 8 Armor Set - 5 piece</font></td>
                            <td width="100"><font color="white">$20.00 USD</font></td>
                            <td width="100">
                                <center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="946A775CR248N">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td width="400"><font color="white">Tier 9 Armor Set - 5 piece</font></td>
                            <td width="100"><font color="white">$25.00 USD</font></td>
                            <td width="100">
                                <center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="34PLGBPMWAP52">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td width="400"><font color="white">Tier 8/Season 6 Full Package Promo - Every character slot (Armor, rings, trinkets, weapons, etc.) filled with full Ulduar or Season 6 PvP gear.</font></td>
                            <td width="100"><font color="white">$25.00 USD</font></td>
                            <td width="100">
                                <center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="B2D8W8P3NKDBY">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td width="400"> <font color="white">Tier 9/Season 7 ULTIMATE Promo - Every character slot (Armor, rings, trinkets, weapons, etc.) filled with full Tier 9 PvE or Relentless PvP gear.</font></td>
                            <td width="100"><font color="white">$35.00 USD</font></td>
                            <td width="100">
                                <center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="9PL3UTKCZDSKJ">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

                                </center>
                            </td>
                        </tr>
						
						<tr>
	                            <td width="400"><font color="white">Tier 10/Season 8 ULTIMATE Promo - Every character slot (Armor, rings, trinkets, weapons, etc.) filled with full Tier 10 or Season 8 gear.</font></td>
                            <td width="100"><font color="white">$45.00 USD</font></td>
                            <td width="100" align='center'>
						  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="8VKNK8TQJRBD4">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

                            </td>
                        </tr>					
						<tr>
			                <td width="400"> <font color="white">Shadowmourne, complete with three epic gems of your choice.</font></td>
                            <td width="100"><font color="white">$45.00 USD</font></td>
                            <td width="100" align='center'>
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="A9FKGU53YKX9Q">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

                            </td>
                        </tr>
						
						
						
						
						
						
								                        					
						<tr>
			                <td width="400"><b><font color="white">***NEW!***</font></b> <font color="white">One piece of Immortal Tier A or Season A gear, with gems.</font></td>
                            <td width="100"><font color="white">$15.00 USD</font></td>
                            <td width="100" align='center'>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="THLDKCCC3SURG">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

                            </td>
                        </tr>
											                        					
						<tr>
			                <td width="400"><b><font color="white">***NEW!***</font></b> <font color="white">Season A / Tier A full gear set w/ level 80.</font></td>
                            <td width="100"><font color="white">$55.00 USD</font></td>
                            <td width="100" align='center'>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="4759K2URQUT3A">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


                            </td>
                        </tr>				
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
                        <tr>
                            <td colspan="3" width="600">
                                <center><font color="white">If you would like to donate to receive multiple items, please use the donation button below:</font>
                                    <br>
                                    <br>
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="6631053">
                                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
										</font></font></font></font>
                                    </form>
                                </center>
                            </td>
                        </tr>
                    </table>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<font color="black">
					
					
                    </div>
                    <?php $structure->UserInfo(); ?>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>