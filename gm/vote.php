<?php
include_once("includes.php");

$structure = new Structure;  

$extra = "<script src='http://static.wowhead.com/widgets/power.js' type='text/javascript'></script>";
$structure->Header($extra);

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Vote Checker</font></h2>");

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
                            This tool can show items that players voted for. Fill in either Vote ID, Player Name or both.
                            <br />
                            <br />
                            <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='GET'>
                                Vote ID: <input type='text' name='voteid' /><br />
    							Player Name: <input type='text' name='playername' /><br />
                                <input type='submit' />
                            </form>
                            <?php
                                if (isset($_GET['voteid']) || isset($_GET['playername']) && (allowed_characters($_GET['playername'])))
                                {
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
    													echo show_voted_for(intval($_GET['voteid']), $_GET['playername']);
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