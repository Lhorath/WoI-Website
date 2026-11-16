<?php
include_once("includes.php");

$structure = new Structure;  

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Password Reset</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left">
                <?php
                    if (!getuserid())
                        echo "<div align='center'><br><br><br><br><br>".send_login('black')."<br><br><br><br><br></div>";
                    else
                    {
                        if (getgmlevel() > 3)
                        {
                            if (intval($_POST['rid']))
                            {
                                $d = new db($config['realm_db']);
                                $acc_id = intval($_POST['rid']);
								$acc_acc = $d->fetchRow("SELECT `gmlevel` FROM `account_access` WHERE `id`='".$acc_id."';");
								if(!$acc_acc) {
								
									$row = $d->fetchRow("SELECT `sha_pass_hash`, `date_changed` FROM `account_passhistory` WHERE `id` = '".$acc_id."';");
									if (!$row)
										echo "<br /><br /><br /><center>No password history for this account yet...<br /><br /><br /></center>";
									else
									{
										$d->exec("UPDATE `account` SET `sha_pass_hash` = '".$row['sha_pass_hash']."' WHERE `id` = '".$acc_id."'");
										echo "<br /><br /><br /><center>Set password back to the date of: ".$row['date_changed']."<br />
										If this pass isn't known to the user, a wipe may be required.<br /><br /><br /></center>"; 
									}
								} else
									echo "You cannot change the password of a GM account";
                            }
                            else if (intval($_POST['wid']))
                            {
                                $d = new db($config['realm_db']);
                                $acc_id = intval($_POST['wid']);
								
								$acc_acc = $d->fetchRow("SELECT `gmlevel` FROM `account_access` WHERE `id`='".$acc_id."';");
								if(!$acc_acc) {
									$acc_info = $d->fetchRow("SELECT `username`, `sha_pass_hash` FROM `account` WHERE `id` = '".$acc_id."';");
									if (!$acc_info)
										echo "<br /><br /><br /><center>User doesnt exist<br /><br /><br /></center>";
									else
									{
										$d->exec("INSERT INTO `account_passhistory` (`id`, `sha_pass_hash`, `date_changed`) VALUES ('".$acc_id."', '".$acc_info['sha_pass_hash']."', '".date("Y-m-d H:i:s")."')
										ON DUPLICATE KEY UPDATE `sha_pass_hash` = '".$acc_info['sha_pass_hash']."', `date_changed` = '".date("Y-m-d H:i:s")."';");
										$new_pass = generate_string();
										$final = $d->exec("UPDATE `account` SET `sha_pass_hash` = '".sha_password($acc_info['username'],$new_pass)."' WHERE `id` = '".$acc_id."';");
										if (!$final)
											echo "<br /><br /><br /><center>Password reset failed.<br /><br /><br /></center>";
										else
											echo "<br /><br /><br /><center>Password changed. New pass: ".$new_pass."<br /><br /><br /></center>";
									}
								} else
									echo "You cannot change the password of a GM account";
                            }
                            else
                            {
                    ?>
                                <br /><br /><br />
                                <div align="center">
                                Choose one option:
                                <br />
                                <br />
                                <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
                                    Account ID: <input type='text' name='wid' />
                                    <input value="Wipe Pass" type='submit' />
                                </form>
                                <br />
                                This option will wipe the old password and set it to a randomly generated string.
                                <br />
                                <br />
                                <br />
                                <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
                                    Account ID: <input type='text' name='rid' />
                                    <input value="Reset Pass" type='submit' />
                                </form>
                                <br />
                                <br />
                                This option will allow you to reset the password to what it was previous set to.
                                <br />
                                <?php
                                    if (isset($_GET['ip']))
                                    {
                                        $ip_address = addslashes($_GET['ip']);
                                ?>
        								<br /><br /><br />
        								<table width="100%">
        									<tbody>
        										<tr>
        											<td><b><font size="4">Promo Info:</font></b></td>
        										</tr>
        										<tr>
        											<td>
        												<?php
        													echo show_promo_check($ip_address);
        												?>
        											</td>
        										</tr>
        									</tbody>
        								</table>
        						<?php
        							}
        						?>
                                </div>
                                <br /><br /><br />
                    <?php
                            }
                        }
                        else
                            echo "Your access level is not high enough to use this feature.";
                    }       
                ?>
                    </div>
                    <?php $structure->UserInfo(); ?>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>