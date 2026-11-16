<?php
include_once("includes.php");

$structure = new Structure;
        
$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>GM Panel</font></h2>");

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
                            <h2>Greetings, <?php echo getaccount(); ?> - GM Lvl [<?php echo getgmlevel(); ?>]<p>Use the links below to access the specific functions of the GM panel.  If you have any questions please contact a higher member of staff. </p></h2>
                            <center><h2>GM Tools</h2></center>
                            <div class="block2"> <img src="<?php echo $config['img_dir']; ?>promocheckicon.png" alt="picture" width="53" height="53" />
                            <p><strong>Promo Checker </strong><br>Check to see if a player is eligible for a promo here. <br /><a href="<?php echo $config['root_dir']; ?>gm/promo.php">Promo Checker»</a></p>
                            </div>
                            <div class="block2"> <img src="<?php echo $config['img_dir']; ?>donatecheckicon.png" alt="picture" width="53" height="53" />
                            <p><strong>Vote Checker </strong><br>Check the vote history of a player to determine if an item was voted for or not.<br /><a href="<?php echo $config['root_dir']; ?>gm/vote.php">Vote Check»</a></p>
                            </div>
                            <div class="block2"> <img src="<?php echo $config['img_dir']; ?>votecheckicon.png" alt="picture" width="53" height="53" />
                            <p><strong>Donation Checker</strong><br>Check the date of a player's donation to to determine reroll and swap eligibility. <br /><a href="<?php echo $config['root_dir']; ?>gm/donation.php">Donation Check»</a></p>
                            </div>
                            <div class="block2"> <img src="<?php echo $config['img_dir']; ?>instancereseticon.png" alt="picture" width="53" height="53" />
                            <p><strong>Instance Reset </strong><br>This option will reset all instances. To be done at 5:00pm server time every day. <br /><a href="<?php echo $config['root_dir']; ?>gm/instance.php">Reset Now»</a></p>
                            </div>
                            <div class="block2"> <img src="<?php echo $config['img_dir']; ?>passwordicon.png" alt="picture" width="53" height="53" />
                            <p><strong>Password Reset </strong><br>Reset player passes - Recover previous passes from account/passchange.<br /><a href="<?php echo $config['root_dir']; ?>gm/passchange.php">Reset Now»</a></p>
                            </div>
                            <p>&nbsp;</p>
                            <br />
                            <br />
                        </div>
                        <div class="right">
                            <?php $structure->UserInfo(); ?>
                        </div>
                        <div class="clr"></div>
                <?php
                        }
                        else
                            echo "You are not a GM, you cannot use these tools.";
                    }
                ?>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>