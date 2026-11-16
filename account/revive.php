<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu('ucp');

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Revive Character</font></h2>");

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
                            <?php echo build_reviver(); ?>
                        </div>
                        <br /><br /><br />
                        <div align="center">
                            <font color='red'>*Note: You must be offline for this tool to successfully work.*</font>
                            <br /><br /><br />
                            <?php echo setupdb(); ?>
                        </div>
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