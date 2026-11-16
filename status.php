<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu();

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Server Stats</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left">
                        <div align="center">
                            <a href='status.php?r=1'><b>Immortality <?php echo $config['game_version']; ?> </b></a>|<a href='status.php?r=2'><b> Envy <?php echo $config['game_version']; ?></b></a>                           
							<?php //Get the DB and set it for other function use | Prevent injection | this could get messy later on, needs work
                                switch ($_GET['r'])
                                {
                                    case '2':
                                        $db = $config['pvp_char_db'];
                                        $port = $config['pvp_world_port'];
                                        $id = '5';
                                        $name = 'Envy (Funserver)';
                                    break;
                                    default:
                                        $db = $config['blizz_char_db'];
                                        $port = $config['blizz_world_port'];
                                        $id = '1';
                                        $name = 'Immortality (Blizzlike)';
                                    break;
                                }
                            ?>
                            <br />
                            <br />
                            <b><font size="5"><?php echo $name;?></font></b>
                            <br />
                            <br />
            				<br />
        					<table border="0" cellpadding="0" cellspacing="5" class="boldtable" >
        						<tr><td>Total Accounts: </td><td><?php echo max_acc();?></td></tr>
        						<tr><td>Total Characters: </td><td><?php echo total_char($db);?></td></tr>
                                <tr><td>Current Characters: </td><td><?php echo current_char($db);?></td></tr>
        						<tr><td>Total GMs: </td><td><?php echo max_gm();?></td></tr>
        						<tr><td>Average Latency: </td><td><?php echo avg_latency($db);?></td></tr>
                                <tr><td>Max Online: </td><td><?php echo max_online($id);?></td></tr>
                                <tr><td>Uptime: </td><td><?php echo get_uptime($id);?></td></tr>
        						<tr><td>Server Status: </td><td><?php echo is_server_online($port);?></td></tr>
        					</table>
            				<br />
            				<br />
            				<br />				  
            				<?php
                                echo online_list($db);
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