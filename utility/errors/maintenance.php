<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='5'>Website Offline</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left">
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
						<font size="6" face="arial">
						We'll be right back!
						</font>
						<br>
						<br>
						<font size="4" color="orange" face="arial">
						Our website is currently offline, please check back later.
						</font>
						<br>
						<br>
						<a href='/forums/'>
							<font size="3" color="grey" face="arial">Alternatively you can check our forums</font>
						</a> 
                        <br />
                        <br />
                        <br />
						Moving to a new host... stay with us.
                        <br />
                        <br />
                        <br />
                    </div>
                    <div class="right">
                    
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <font size="6" color="white" face="arial">
                We'll be right back!
                </font>
                <br>
                <br>
                <font size="4" color="orange" face="arial">
                Our website is currently offline, please check back later.
                </font>
                <br>
                <br>
                <a href='/forums/'>
                    <font size="3" color="grey" face="arial">Alternatively you can check our forums</font>
                </a> 
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                