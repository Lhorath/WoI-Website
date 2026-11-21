<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu('vp');

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Vote For Us!</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left" align="center">
                <?php
                    if (!getuserid())
                        echo "<div align='center'><br><br><br><br><br>".send_login('black')."<br><br><br><br><br></div>";
                    else
                    {
                        if ($_POST['u']) //vote redirect
                        {
                            if (vote($_POST['i']))
                            {
                                echo "<br>Redirecting to ".$_POST['n']."<br>
                                    <META HTTP-EQUIV='Refresh' CONTENT=\"0; URL=".$_POST['u']."\"><META HTTP-EQUIV='PRAGMA' CONTENT='NO-CACHE'>";
                            }
                        }
                        else
                        {
                            $vote_data = get_vote_data();
                            ?>
                            <font size='5'><b>Vote Tool</b></font>
                            <br><br>
                            Click on a site to vote for.<br />
                            Your account will receive vote points for every vote. <br />
                            You may vote once every 12 hours. <br />
                            <br>
                            Time until you may vote on this account: <font color="#CC6600"><?php echo show_time_to_vote($vote_data[1][1]); ?></font> <br />
                            Time until you may vote on this IP: <font color="#CC6600"><?php echo show_time_to_vote($vote_data[0][1]); ?></font> <br />
                            <br>
                        <?php
                            echo "<br><br>";
                            //show site buttons
                            $txt = '';
                            $timer = $vote_data[0][1] > $vote_data[1][1] ? $vote_data[0][1] : $vote_data[1][1];
                            $sites = $vote_data[1][0] > $vote_data[0][0] ? $vote_data[1][0] : $vote_data[0][0];
                        	foreach($config['vote_sites'] as $key => $value)
                        	{
                                $txt .= "<form action='".basename($_SERVER['REQUEST_URI'])."?i=".$value[3]."' name='vote_redirect' method='POST' target='_blank'>
                                        <input type=hidden name='u' value='".$value[1]."'> 
                                        <input type=hidden name='n' value='".$value[0]."'> 
                                        <input type=hidden name='i' value='".$value[3]."'> 
                                        <input type=image target='_blank' alt='".$value[0]."' ";
                                if (((time() - $timer) > $config['vote_cooldown_duration']) || !($sites & $value[3]))
                                    $txt .= "src='".$config['img_dir'].$value[2]."' value='1' name='vote_redirect'>";
                                else
                                    $txt .= "src='".$config['img_dir']."grey_".$value[2]."' disabled='disabled'";
                                $txt .= "</form>";
                        	}
                            echo $txt;
                        }
                        echo "<br><br><br>";
                        if (points_per_vote() == $config['reg_point_per_vote'])
                                echo "<font color='red'>All votes done within the first ".$config['bonus_days_duration']." days of the month will recieve ".$config['bonus_point_per_vote']." points per vote.</font>";
                            else
                                echo "<font color='red'>Currently, all votes reward ".$config['bonus_point_per_vote']." points per vote. This lasts for the first ".$config['bonus_days_duration']." days of every month.</font>";
                    }      
                ?>
                    <br />
                    <br />
                    <table>
                        <tr>
                            <td><img src="<?php echo $config['img_dir']; ?>voteicon.png" alt="picture" width="53" height="53" /></td>
                            <td><p><strong>Vote Rewards</strong><br /><a href="<?php echo $config['root_dir']; ?>vote/rewards.php">Be Rewarded!</a></p></td>
                        </tr>
                    </table>
                    <br />
                    </div>
                    <?php $structure->UserInfo(); ?>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>