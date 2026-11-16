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
$structure->Title_Bar("<h2><font size='4'>My Donation History</font></h2>");

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
                ?>
                        <br /><br /><br />
                        <div align="center">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h1 style="margin:0px"><?php echo getaccount(); ?></h1>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br /><br /><br />
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td><b><font size="4">Donation History:</font></b></td>
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
                                                        echo show_donation_history();
                                                    ?>
                                                </tbody>
                                            </table>    
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br /><br /><br />
                        <!--Random info on contacting a gm ingame to proceed with character gearing. ask to include "transaction ID in tickets" will be used in retrieving donation history by gms.-->
                        <br /><br /><br />
                <?php
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