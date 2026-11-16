<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Donation History</font></h2>");

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
                        Enter an account name to show the donation history for that user. (exact spelling required)
                        <br />
                        <br />
                        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='GET'>
                            Account Name: <input type='text' value='<?php echo $_GET['account_name']; ?>' name='account_name' />
                            <input type='submit' />
                        </form>
                        <?php
                            if (isset($_GET['account_name']) && allowed_characters($_GET['account_name']))
                            {
                                $account_id = account_name_to_account_id($_GET['account_name']);
                            }
                            if ($account_id)
                            {
                        ?>
                                <br /><br /><br />
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td><b><font size="4">Donation Info:</font></b></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" border="1" cellspacing="1" cellpadding="2">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" width="4%">#</td>
                                                            <td align="center">Date</td>
                                                            <td width="7%">Amount</td>
                                                            <td width="35%">Comments</td>
                                                            <td align='center'>Payment Status</td>
                                                            <td width="10%" align="center">Gear Status</td>
                                                            <td width="20%">Transaction ID</td>
                                                        </tr>
                                                        <?php
                                                            echo show_donation_history($account_id);
                                                        ?>
                                                    </tbody>
                                                </table>    
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php
                                }
                            ?>
                            </div>
                            <br /><br /><br />
                            Random info on contacting a gm ingame to proceed with character gearing. ask to include "transaction ID in tickets" will be used in retrieving donation history by gms.
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