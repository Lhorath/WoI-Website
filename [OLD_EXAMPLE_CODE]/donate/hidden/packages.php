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
                <br><center><font face="arial" size="2" color="white"><b>For information about advertising in this space (150x300px), please contact Sero on the Community Forums.</b></font></center>
            </div>
            <div class="middlebox">
                <!--Content Start -->
                <center><font size='6' color='white'>Donation Packages</font></center><br><br>
                <?php
                    if (!getuserid())
                        echo "<br><br><br><br><br>".send_login()."<br><br><br><br><br>";
                    else
                    {
                        if (!getcharname())
                            echo "You need to select a character before continuing with item selection.<br>";
                        else
                        {
                            $items = load_items();
                            echo "Loading itemset: ".$items['name']." | GUID: ".$items['set_guid']."<br><br>";
                            echo "<table border='1' width='95%'> 
                            <tr> 
                                <td>
                                head ".show_item($items[0][0], 0)."
                                </td>
                                <td rowspan='7' colspan='3'> 
                                    TODO: place 3d model in here
                                </td> 
                                <td>
                                gloves
                                ".show_item($items[9][0], 9)."
                                </td>
                            </tr> 
                            <tr> 
                                <td> 
                                neck
                                ".show_item($items[1][0], 1)."
                                </td> 
                                <td> 
                                belt
                                ".show_item($items[5][0], 5)."
                                </td> 
                            </tr> 
                            <tr> 
                                <td> 
                                shoulder
                                ".show_item($items[2][0], 2)."
                                </td> 
                                <td> 
                                pants
                                ".show_item($items[6][0], 6)."
                                </td> 
                            </tr> 
                            <tr> 
                                <td> 
                                back
                                ".show_item($items[14][0], 14)."
                                </td> 
                                <td>
                                boots
                                ".show_item($items[7][0], 7)."
                                </td> 
                            </tr> 
                            <tr> 
                                <td> 
                                chest
                                ".show_item($items[4][0], 4)."
                                </td> 
                                <td> 
                                ring1
                                ".show_item($items[10][0], 10)."
                                </td> 
                            </tr> 
                            <tr> 
                                <td> 
                                tabard
                                ".show_item($items[18][0], 18)."
                                </td> 
                                <td> 
                                ring2
                                ".show_item($items[11][0], 11)."
                                </td> 
                            </tr> 
                            <tr> 
                                <td> 
                                shirt
                                ".show_item($items[3][0], 3)."
                                </td> 
                                <td> 
                                trinket1
                                ".show_item($items[12][0], 12)."
                                </td> 
                            </tr> 
                            <tr> 
                                <td> 
                                bracer
                                ".show_item($items[8][0], 8)."
                                </td> 
                                <td>
                                mhwep1
                                ".show_item($items[15][0], 15)."
                                </td> 
                                <td> 
                                ohwep
                                ".show_item($items[16][0], 16)."
                                </td> 
                                <td> 
                                ranged
                                ".show_item($items[17][0], 17)."
                                </td> 
                                <td> 
                                trinket2
                                ".show_item($items[13][0], 13)."
                                </td> 
                            </tr> 
                        </table>";
                        }
                        ?>
                            <br><br>
                        <?php
                            if ($_GET['a'] == 'choose')
                            {
                                if (isset($_GET['s']))
                                {
                                    //meet req?
                                    
                                    update_slot($item_id, $slot);
                                }
                            }
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
                                        <td> <?php echo getcharname()." GUID: ".getcharguid(); ?></td>
                                    </tr>
                                </table>
                            </form>
                            <br>
                            <form action="index.php" method="POST">
                                <table align="center" style="text-align:top">
                                    <tr>
                                        <font color='orange'>A maximum of <?php echo $config['dn_max_results']; ?> results are displayed</font>
                                    </tr>
                                    <tr>
                                        <td>
                                            Item Name:
                                            <input type="text" name="search_value" value="<?php echo $_POST["search_value"]; ?>" /><br/>
                                        </td>
                                        <td>
                                            <input type="submit" value="Find Items">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        <?php
                        if ($_POST["search_value"])
                        {
                            $result = findItems($_POST["search_value"], 'dn');
                            $items = getItems($result, 'dn');
                            $items_shown = sizeof($items);
                            echo "<br><font color=grey>Showing </font><font color=orange>$items_shown </font><font color=grey>items.</font><br>";
                            ShowItems($items, $items_shown, 'dn');
                        }
                    }
                ?>
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