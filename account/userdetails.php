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
$structure->Top_Menu('ucp');

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>User Details</font></h2>");

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
                            <?php echo show_change_pass(); ?>
                            <br />
                            <br />
                            <br />
                            <!--<?php echo show_change_email(); ?>-->
                        </div>
                        <br /><br /><br />
                        <p><span><font size="2">Note:</font></span> Please use an email that you will have constant access to.  If your account becomes compromised or you must prove that you are the legitimate owner of your account, you may be required to validate your email address.</p>
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