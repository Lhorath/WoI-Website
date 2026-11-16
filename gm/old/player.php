<?php
require_once( 'includes.php' );
?>
<html>
    <?php echo $structure['Main_Header'];?>
    <center>
        <div class="topbox">
            <!-- Main Logo -->
        </div>
    </center>
    <br>
    <center>
        <div class="wrap">
            <div class="transbox">
                <?php echo $structure['Left_Menu'];?>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br><font face="arial" size="2" color="white"><b>For information about advertising in this space (150x300px), please contact Sero on the Community Forums.</b></font>
            </div>
            <div class="middlebox">
                <!--Content Start -->
                <font size='6' color='white'>Player Info</font><br><br><br>
                <?php
                    if (!getuserid())
                        echo "<br><br><br><br><br>".send_login()."<br><br><br><br><br>";
                    else if (getgmlevel() < 1)
                        echo "<br><br><br><br><br>You must be a GM to use these features.<br><br><br><br><br>";
                    else
                    {
                ?>
                        <font color=orange>You must enter the characters name exactly, not case sensitive.</font><br><br>
                        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='GET'>
                            Player Name: <input type='text' value='<?php echo $_GET['playername']; ?>' name='playername'>
                            <input type=submit>
                        </form>
                        <br><br><br>
                <?php
                        if (isset($_GET['playername']) && allowed_characters($_GET['playername']))
                        {
                            $player = pinfo($_GET['playername']);
                        }
                        if ($player)
                        {
                            echo "<table width='75%' height='1' border='1' valign='top' cellpadding='1' cellspacing='1'>
                                    <tr align=center>
                                        <th colspan=2><font color=white size=5>".$player->name." - Level ".$player->level."</font></th>
                                    </tr>
                                    <tr align=center>
                                        <td colspan=2>".$player->class."".$player->race."</td>
                                    </tr>
                                    <tr>
                                        <td>Player GUID: </td>
                                        <td>".$player->guid."</td>
                                    </tr>
                                    <tr>
                                        <td>Account Name: </td>
                                        <td>".$player->account_name."</td>
                                    </tr>
                                    <tr>
                                        <td>Account ID: </td>
                                        <td>".$player->account_id."</td>
                                    </tr>
                                    <tr>
                                        <td>Email: </td>
                                        <td>".$player->email."</td>
                                    </tr>
                                    <tr>
                                        <td>Last IP: </td>
                                        <td>".$player->last_ip."</td>
                                    </tr>
                                    <tr>
                                        <td>Join Date: </td>
                                        <td>".$player->joindate."</td>
                                    </tr>
                                    <tr>
                                        <td>Last Login: </td>
                                        <td>".$player->last_login."</td>
                                    </tr>
                                    <tr>
                                        <td>Played Time: </td>
                                        <td>".sec_to_days_hours_mins_sec($player->playedtime)."</td>
                                    </tr>
                                    <tr>
                                        <td>Money: </td>
                                        <td>".copper_to_gsc($player->money)."</td>
                                    </tr>
                                    <tr>
                                        <td>Zone: </td>
                                        <td>".$player->zonename."</td>
                                    </tr>
                                    <tr>
                                        <td>At Login: </td>
                                        <td>".$player->atlogin."</td>
                                    </tr>
                                </table>
                                <br>
                                <table width='80%' height='1' border='0' valign='top' cellpadding='1' cellspacing='1'>
                                    <tr>
                                        <td valign='top' width=50%>
                                            <table width='100%' height='1' border='1' valign='top' cellpadding='1' cellspacing='1'>
                                                <tr align=center>
                                                    <th colspan=2><font color=white size=4>Friends List</font></th>
                                                </tr>
                                                <tr>
                                                    <th width='50%'>Name</th>
                                                    <th width='50%'>Note</th>
                                                </tr>";
                                            $friends = social_list($player->guid, 1);
                                            if ($friends)
                                            {
                                                for ($i = 0; $i <= endKey($friends); $i++)
                                                {
                                                    echo "<tr>
                                                        <td>".$friends[$i][0]."</td>
                                                        <td><font TITLE='".$friends[$i][1]."'>".ShortenText($friends[$i][1], 10)."</font></td>
                                                    </tr>";
                                                }
                                            }
                                            unset($friends);
                                            echo "</table>
                                        </td>
                                        <td valign='top' width=50%>
                                            <table width='100%' height='1' border='1' valign='top' cellpadding='1' cellspacing='1'>
                                                <tr align=center>
                                                    <th colspan=2><font color=white size=4>Ignore List</font></th>
                                                </tr>
                                                <tr>
                                                    <th width='50%'>Name</th>
                                                    <th width='50%'>Note</th>
                                                </tr>";
                                            $friends = social_list($player->guid, 2);
                                            if ($friends)
                                            {
                                                for ($i = 0; $i <= endKey($friends); $i++)
                                                {
                                                    echo "<tr>
                                                        <td>".$friends[$i][0]."</td>
                                                        <td><font TITLE='".$friends[$i][1]."'>".ShortenText($friends[$i][1], 10)."</font></td>
                                                    </tr>";
                                                }
                                            }
                                            echo "</table>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <a href='#' onclick='showhide(\"tickets\"); return(false);'><font color=orange>Show/Hide Tickets</font></a>
                                <div style='display: none;' id='tickets'>
                                <table width='80%' height='1' border='1' valign='top' cellpadding='1' cellspacing='1'>
                                    <tr align=center>
                                        <th colspan=2><font color=white size=4>GM Tickets</font></th>
                                    </tr>
                                    <tr>
                                        <th width='15%'>ID</th>
                                        <th>Message</th>
                                    </tr>";
                                    $tickets = player_tickets($player->guid);
                                    if ($tickets)
                                    {
                                        for ($i = 0; $i <= endKey($tickets); $i++)
                                        {
                                            echo "<tr>
                                                <td>".$tickets[$i][0]."</td>
                                                <td><a href='#' onclick='showhide(\"tickmsg_".$i."\"); return(false);'><font color=orange>Show/Hide</font></a><div style='display: none;' id='tickmsg_".$i."'> ".$tickets[$i][1]."</div></td>
                                            </tr>";
                                        }
                                    }
                          echo "</table></div>
                                <br><br>
                                <a href='#' onclick='showhide(\"spells\"); return(false);'><font color=orange>Show/Hide Spells</font></a>
                                <div style='display: none;' id='spells'>
                                <table width='80%' height='1' border='1' valign='top' cellpadding='1' cellspacing='1'>
                                    <tr align=center>
                                        <th colspan=2><font color=white size=4>Player Spells</font></th>
                                    </tr>
                                    <tr>
                                        <th width='50%'>Spell ID</th>
                                        <th>Disabled</th>
                                    </tr>";
                                    $spells = player_spells($player->guid);
                                    if ($spells)
                                    {
                                        for ($i = 0; $i <= endKey($spells); $i++)
                                        {
                                            echo "<tr>
                                                <td><a href='www.wowhead.com/spell=".$spells[$i][0]."' onclick='return(false);'>".$spells[$i][0]."</a></td>
                                                <td>".$spells[$i][1]."</td>
                                            </tr>";
                                        }
                                    }
                            echo "</table></div>
                                <br><br>
                                <a href='#' onclick='showhide(\"auras\"); return(false);'><font color=orange>Show/Hide Auras</font></a>
                                <div style='display: none;' id='auras'>
                                <table width='80%' height='1' border='1' valign='top' cellpadding='1' cellspacing='1'>
                                    <tr align=center>
                                        <th colspan=2><font color=white size=4>Player Auras</font></th>
                                    </tr>
                                    <tr>
                                        <th width='50%'>Spell ID</th>
                                        <th>Stack</th>
                                    </tr>";
                                    $auras = player_auras($player->guid);
                                    if ($auras)
                                    {
                                        for ($i = 0; $i <= endKey($auras); $i++)
                                        {
                                            echo "<tr>
                                                <td><a href='www.wowhead.com/spell=".$auras[$i][0]."' onclick='return(false);'>".$auras[$i][0]."</a></td>
                                                <td>".$auras[$i][1]."</td>
                                            </tr>";
                                        }
                                    }
                            echo "</table></div>
                                <br><br>
                                <a href='#' onclick='showhide(\"items\"); return(false);'><font color=orange>Show/Hide Items</font></a>
                                <div style='display: none;' id='items'>
                                <table height='1' border='1' valign='top' cellpadding='1' cellspacing='1'>
                                    <tr align=center>
                                        <th><font color=white size=4>Player Items</font></th>
                                    </tr>
                                    <tr>
                                        <th>Item ID</th>
                                    </tr>";
                                    $items = player_items($player->guid);
                                    if ($items)
                                    {
                                        for ($i = 0; $i <= endKey($items); $i++)
                                        {
                                            echo "<tr>
                                                <td align=center><a href='www.wowhead.com/item=".$items[$i][0]."' onclick='return(false);'>".$items[$i][0]."</a></td>
                                            </tr>";
                                        }
                                    }
                            echo "</table></div>";
                        }
                    }
                ?>
                <br><br><br>
                <font color=grey>If you see nothing, you most likely used invalid characters or the specified character does not exist.<br>Valid characters are [A-Z]</font>
                <br><br><br>
            </div>
            <div class="rightbox">
                <?php echo $structure['Right_Menu']; ?>
            </div>
        </div>
        <br>
        <div class="bottombox">
            <?php echo $structure['Bottom_Box'];?>
        </div>
        <br>
        <br>
    </center>
</html>