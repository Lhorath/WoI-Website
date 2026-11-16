<?php
include_once("includes.php");

$structure = new Structure;  

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Instance Reset</font></h2>");

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
						if (getgmlevel() < '4')
							echo "You must be a GM rank 4 or higher to use this utility";
						else
						{
				?>
							<br /><br /><br />
							<div align="center">
							<?php
							if ($_POST['a'] == 'Reset Instances')
							{
								echo "<font color='red' size='4'>Are you sure you want to reset instances?</font>
									<form action='".$_SERVER['PHP_SELF']."' method='POST'>
										<input type='submit' name='a' value='Yes'/>
										<input type='submit' value='no'/>
									</form>";
							}
							else if ($_POST['a'] == 'Yes')
							{
								$cdb = new db(getchardb());
								$cdb->exec("DELETE FROM `character_instance`");
								$amnt = $cdb->rows_affected;
								echo "$amnt instances cleared";
							}
							else
							{
								echo "<form action='".$_SERVER['PHP_SELF']."' method='POST'>
									<input type='submit' name='a' value='Reset Instances'/>
								</form>";
							}
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