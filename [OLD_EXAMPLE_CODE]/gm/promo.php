<?php
include_once("includes.php");

$structure = new Structure;  

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Promotion Check</font></h2>");

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
                        if (getgmlevel() > 0)
                        {
                ?>
                            <br /><br /><br />
                            <div align="center">
                            Enter an account IP address to show the donation history for that user.
                            <br />
                            <br />
                            <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='GET'>
                                IP Address: <input type='text' value='<?php echo $_GET['ip']; ?>' name='ip' />
                                <input type='submit' />
                            </form>
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
                        else
                            echo "You are not a GM, you cannot use these tools.";
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