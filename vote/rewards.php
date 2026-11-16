<?php
include_once("includes.php");

$structure = new Structure;

$extra = "<script src='http://static.wowhead.com/widgets/power.js' type='text/javascript'></script>";
$structure->Header($extra);

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
                        if (isset($_POST['secret_itemsubmit']))
                        {
                            $item = setItem($_POST['secret_itemsubmit'], 'vp');
                            //did sanitization pass?
                            if (!$item)
                                echo "This item does not meet the predefined requirements.";
                            else if (!getcharguid())
                                echo "You have not selected a character";
                            else
                                echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">
                                    Are you sure you would like to spend <font color="#CC6600"><b>'.$item->item_cost .'</b></font> Vote Points on <a href="http://www.wowhead.com/?item='.$item->entry.'"
                                    style="color:#'.$config['item_quality_colours'][$item->item_quality].'" target="_blank" onclick="return false;">['.$item->item_name . ']</a>?
                                    <br><br>
                                    <input type="hidden" name="itemsubmit_final" value="' . $item->entry . '"/>
                                    <input type="submit" value="Yes">
                                    </form>
                                    <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
                                    <input type="submit" value="No"/>
                                    </form>
                                    <br><br><font color=red size=4>Reminder: Items are NON-REFUNDABLE</font><br>
									<br><font color=red size=4>Reminder: Make sure your CLASS/RACE/FACTION can use the item!</font><br>
									<br><font color=red size=4>Reminder: You MUST fully exit your account ingame to receive your item in the mail.</font><br><br><br><br>';
                        }
                        else if (isset($_POST['itemsubmit_final']))
                        {
                            $item = setItem($_POST['itemsubmit_final'], 'vp');
                            //did sanitization pass?
                            if (!$item)
                                echo "This item does not meet the predefined requirements.";
                            else if (!getcharguid())
                                echo "You have not selected a character";
                            else
                            {
                                $vote_id = $item->Reward('vp');
                                //lack of vp
                                if (!$vote_id)
                                    echo "<font color=red>Could not send </font><a href='http://www.wowhead.com/?item=".$item->entry."'style='color:#".$config['item_quality_colours'][$item->item_quality]."' target='_blank'
                                    onclick='return false;'>[".$item->item_name."]</a> to [<b>".getcharname()."</b>] <font color=red>due to a lack of Vote Points.</font><br><br><br>";
                                else
                                    echo "<a href='http://www.wowhead.com/?item=".$item->entry."'style='color:#".$config['item_quality_colours'][$item->item_quality]."' target='_blank'
                                        onclick='return false;'>[".$item->item_name."]</a> sent to [<b>".getcharname()."</b>] for a cost of <font color='#CC6600'><b>".$item->item_cost."</b></font> Vote Points<br><br><br>
                                        Your vote Transaction ID is: <b><font color='#CC6600'>".$vote_id."</font></b><br><br><br>
                                        Please take a screen shot of this page or note the Transaction ID. This tool is used to recover missing vote items.<br><br><br>
                                        <font color=green>It may take up to 2 minutes and a relog, for your item to appear in your mailbox.</font><br><br><br>";
                            }
                        }
                        else
                        {
                    ?>
                            <br>
                        <?php
                            //get selected character, sanitize and set
                            if(isset($_POST['character']))
                                if (!ischaronacct(intval($_POST['character'])))
                                    die ('You tried to set a character that is not on your account.');
                        ?>
                            <form action='<?php echo $_SERVER['REQUEST_URI']; ?>' method='post'>
                                <table width='300' border='0'>
                                    <tr>
                                        <td>Select a Character:</td>
                                        <td><select name='character' width='50' onchange="this.form.submit();" >
                                            <option value='0'></option>
                                            <?php echo showCharacters(); ?>
                                        </select></td>
                                    </tr>
                                    <tr>
                                        <td>Selected Character: </td>
                                        <td> <?php echo getcharname(); ?></td>
                                    </tr>
                                </table>
                            </form>
                            <br>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                                <table align="center" style="text-align:top">
                                    <tr>
                                        <font color='#CC6600'>A maximum of <?php echo $config['vp_max_results']; ?> results are displayed</font>
                                    </tr>
                                    <tr>
                                        <td>
                                            Item Name:
                                            <input type="text" name="search" value="<?php echo stripslashes($_GET["search"]); ?>" /><br/>
                                        </td>
                                        <td>
                                            <input type="submit" value="Find Items">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        <?php
                            if ($_GET["search"])
                            {
                                $result = findItems($_GET["search"], 'vp');
                                $items = getItems($result, 'vp');
                                $items_shown = sizeof($items);
                                echo "<br><font color=grey>Showing </font><font color=orange>$items_shown </font><font color=grey>items.</font><br>";
                                ShowItems($items, $items_shown, 'vp');
                            }
                        }
                        echo "<br /><br />";
                        echo setupdb();
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

