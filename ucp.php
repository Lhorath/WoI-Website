<?php
include_once("includes.php");

$structure = new Structure;
        
$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu('ucp');

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Player Control Panel</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left">
                        <h2>Greetings.<p>Use the links below to access the specific functions of your user control panel.  If you have any questions please contact a member of our staff. </p></h2>
                        <center><h2>Player Tools</h2></center>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>voteicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Vote Panel</strong><br>Vote for our server, spend vote points, and more! <a href="#">Vote Now!»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>donateicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Donation Panel </strong><br>Add donation coins, receive ingame rewards, and build your equipment wishlist. <a href="#">Donation Panel»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>teleporticon.png" alt="picture" width="53" height="53" />
                        <p><strong>Offline Teleporter </strong><br>Stuck?  Use our Offline Teleporter! <a href="#">Offline Teleporter»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>reviveicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Offline Revive </strong><br>Unable to revive your character? No need to wait for a GM!  <a href="#">Revive Me!»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>banicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Ban Checker </strong><br>Find out if you have been banned, for what reason, and for how long. <br /><a href="#">Am I Banned?»</a></p>
                        </div>
                        <div class="block2"> <img src="<?php echo $config['img_dir']; ?>passwordicon.png" alt="picture" width="53" height="53" />
                        <p><strong>Change Password </strong><br>Change your password every 30 days to keep your account secure! <br /><a href="#">Password Changer»</a></p>
                        </div>
                        <p>&nbsp;</p>
                        <!--<center><h2>GM Tools</h2></center>
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
                        <div class="clr"></div>
               
                        <div class="clr"></div>
                        <p>&nbsp;</p>
                        <h2>Important Reminders</h2>
                        <p>
                        <strong>Account Security</strong><br />
                        Remember, you are responsible for anything that happens on your account. NEVER give anyone your password. <br /><br />World of Immortality staff will not ask for your password for any reason. <br /><br />
                        </p>
                        <p>
                        <strong>Donation Reminder</strong><br />
                        Remember, you can use the Character Wishlist in the Donation Panel to customize a donation package even if you haven't donated yet.<br /><br /><br />
                        </p>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>