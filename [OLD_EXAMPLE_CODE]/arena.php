<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Arena Ranks</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left">
                        <div align="center">
                            <a href='arena.php?r=1&bracket=<?php echo $_GET['bracket']; ?>'><b>Immortality <?php echo $config['game_version']; ?> </b></a>|<a href='arena.php?r=2&bracket=<?php echo $_GET['bracket']; ?>'><b> Envy <?php echo $config['game_version']; ?></b></a>
                            <br />
                            <a href='arena.php?r=<?php echo $_GET['r']; ?>&bracket=2'><b>2v2</b></a> | <a href='arena.php?r=<?php echo $_GET['r']; ?>&bracket=3'><b>3v3</b></a> | <a href='arena.php?r=<?php echo $_GET['r']; ?>&bracket=5'><b>5v5</b></a>
                            <br />                        
							<?php //Get the DB and set it for other function use | Prevent injection | this could get messy later on, needs work
                                switch ($_GET['r'])
                                {
                                    case '2':
                                        $db = $config['pvp_char_db'];
                                        $port = $config['pvp_world_port'];
                                        $id = '2';
                                        $name = 'Envy (Funserver)';
                                    break;
                                    default:
                                        $db = $config['blizz_char_db'];
                                        $port = $config['blizz_world_port'];
                                        $id = '1';
                                        $name = 'Immortality (Blizzlike)';
                                    break;
                                }
                                switch (intval($_GET['bracket']))
                                {
                                    default://2v2
                                        $type = '2';
                                    break;
                                    case '3':
                                        $type = '3';
                                    break;
                                    case '5':
                                        $type = '5';
                                    break;
                                }
                            ?>
                            <br />
                            <br />
                            <b><font size="5"><?php echo $name;?></font></b>
                            <br />
                            <br />
            				<br />
        					<table border="0" valign="top" cellpadding="0" cellspacing="5" BORDER CLASS="boldtable" >
        						<tr><td>Total Arena Teams: </td><td><font color="black"><?php echo total_arena_teams($db);?></td></tr>
                                <tr><td>Total 2v2 Teams: </td><td><?php echo total_arena_teams($db, '2');?></td></tr>
                                <tr><td>Total 3v3 Teams: </td><td><?php echo total_arena_teams($db, '3');?></td></tr>
                                <tr><td>Total 5v5 Teams: </td><td><?php echo total_arena_teams($db, '5');?></td></tr>
        						</tr>
        					</table>
            				<br />
            				<br />
            				<br />				  
            				<?php
                                echo arena_list($db, $type);
            				?>
                            <br />
                            <br />
                            <br />
                        </div>
                    </div>
                    <div class="right">
                        Remember, World of Immortality will never ask for your password.  Sharing accounts increases security risks and can put you at risk for a ban, so make sure your password is secure!
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>