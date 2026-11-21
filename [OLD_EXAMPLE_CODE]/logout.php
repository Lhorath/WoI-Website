<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Logout</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left">
                        <p>
                        <?php
                            if(isset($_SESSION['logged_in']))
                            {
                                session_destroy();
                                echo "Logout Successful<br>Redirecting";
                            }
                            else
                                echo "You are not logged in.";
                            echo "<meta http-equiv=refresh content='0;url=/index.php'>";
                        ?>
                        </p>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>