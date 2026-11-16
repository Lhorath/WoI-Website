<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu('ucp');

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Ban Checker</font></h2>");

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
                        
                        This page shows you information in regards to any bans on your current account and your current IP.
                        <br />
                        <br />
                        Your account: <?php echo getaccount(); ?><br />
                        Your IP: <?php echo $_SERVER['REMOTE_ADDR']; ?><br />
                        <br />
                        <br />
                        <br />
                        <br />
                            <?php echo ban_check(); /*Shows the bans*/ ?>
                        </div>
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