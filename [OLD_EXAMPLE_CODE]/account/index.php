<?php
include_once("includes.php");

$structure = new Structure;
        
$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu('ucp');

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>User Control Panel</font></h2>");

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
                        <h2>Greetings, <?php echo getaccount(); ?>.<p>Use the links below to access the specific functions of your user control panel.  If you have any questions please contact a member of our staff. </p></h2>
                        <center><h2>Player Tools</h2></center>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>voteicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Vote Panel</strong><br>Vote for our server, spend vote points, and more! <a href="<?php echo $config['root_dir']; ?>vote/index.php">Vote Now!»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>donateicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Donation Panel </strong><br>Add donation coins, receive ingame rewards, and build your equipment wishlist. <a href="<?php echo $config['root_dir']; ?>donate/index.php">Donation Panel»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>teleporticon.png" alt="picture" width="53" height="53" />
                        <p><strong>Offline Teleporter </strong><br>Stuck?  Use our Offline Teleporter! <a href="<?php echo $config['root_dir']; ?>account/teleport.php">Offline Teleporter»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>reviveicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Offline Revive </strong><br>Unable to revive your character? No need to wait for a GM!  <a href="<?php echo $config['root_dir']; ?>account/revive.php">Revive Me!»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>banicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Ban Checker </strong><br>Find out if you have been banned, for what reason, and for how long. <br /><a href="<?php echo $config['root_dir']; ?>account/bancheck.php">Am I Banned?»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>passwordicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Change Password </strong><br>Change your password every 30 days to keep your account secure! <br /><a href="<?php echo $config['root_dir']; ?>account/userdetails.php">Password Changer»</a></p>
                        </div>
                        <p>&nbsp;</p>
                       <!-- <center><h2>GM Tools</h2></center>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>promocheckicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Promo Checker </strong><br>Check to see if a player is eligible for a promo here. <br /><a href="#">Promo Checker»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>donatecheckicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Vote Checker </strong><br>Check the vote history of a player to determine if an item was voted for or not.<br /><a href="#">Vote Check»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>votecheckicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Donation Checker</strong><br>Check the date of a player's donation to to determine reroll and swap eligibility. <br /><a href="#">Donation Check»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>instancereseticon.png" alt="picture" width="53" height="53" />
                        <p><strong>Instance Reset </strong><br>This option will reset all instances. To be done at 5:00pm server time every day. <br /><a href="#">Reset Now»</a></p>
                        </div>-->
                        <p>&nbsp;</p>
                        <br>
                        <br>
                    </div>
                    <div class="right">
                        <?php $structure->UserInfo(); ?>
                    </div>
                    <div class="clr"></div>
                <?php
                }
                ?>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>