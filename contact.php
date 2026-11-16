<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu('register');

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Account Creation</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left">
                      
						
<p>                
                    World of Immortality has over 30 active members of volunteer staff, and boasts 24/7 ingame support.  Contacting a member of staff may be done in any of the following ways:        <br /><br />
                    
                    <br />
                   <br />
                    <font size="2"><span>Ingame Ticket: </font> Creating a ticket ingame is the fastest way to reach a member of our staff.  Our volunteer staff is on call 24/7 to meet your needs..
                   <br />
                    <font size="2"><span>Forums:</span> </font> If your question could be answered by a more general audience, you may ask for help on our forums.  Furthermore, you can contact a staff member directly there via private message.
                   <br />

                    <font size="2"><span>Ventrilo:</span></font> Our staff members utilize the Ventrilo voice service to provide realtime voice-over-ip services to its users.  We also allow free membership to our vent server, where you may contact a member of our staff.
                    <br>
                
                <br />

                <br />
                If you have any questions, please contact a member of our staff via our forums or in-game.  Having trouble setting up your realmlist? You can also use our custom launcher, <a href="http://www.worldofimmortality.com/utility/launcher.zip">here!</a>
             <br /><br /><br />
</p>

                    </div>
                    <div class="right">
                         <p><span><font size="2"><b>Reminder:</b></font> </span>We currently run on World of Warcraft version 3.3.3a.  If you do not have this version, you will be unable to access our server.</p>
						<br /><br />
						<p><span><font size="2" color="#ff0000"><b>Warning:</b></font> </span>For security reasons, we ask that you do NOT use the same username/password on this server as you do for your retail account, or for other servers.</p><br /><br /><br /><br />
                    
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>