<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='5'>404 - Object not found!</font></h2>");

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
                        Oops! It looks like you followed an invalid link. Please report this on the community forums.
                        <br />
                        <br />
                        <br />
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