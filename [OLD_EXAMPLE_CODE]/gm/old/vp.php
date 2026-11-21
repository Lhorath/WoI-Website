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
                <font size='6' color='white'>VP Reward</font><br><br><br>
                <?php
                    if (!getuserid())
                        echo "<br><br><br><br><br>".send_login()."<br><br><br><br><br>";
                    else if (getgmlevel() < 3)
                        echo "<br><br><br><br><br>You must be a GM rank 4 or higher to use these features.<br><br><br><br><br>";
                    else
                    {
                ?>
                        <br><br><br>
                        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
                            Amount: <input type='text' name='amnt'><br>
                            <input type=submit>
                        </form>
                        <br><br><br>
                <?php
                        if ((isset($_POST['amnt'])) && intval($_POST['amnt']) != 0)
                        {
                            $amnt = intval($_POST['amnt']);
                            $rdb = new db($config['realm_db']);
                            if ($rdb->exec("UPDATE `voting_points` SET `points`=(`points` + '$amnt')"))
                                echo "Query successful";
                            else
                                echo "Query Failed, logged.";
                        }
                    }
                ?>
                <br><br><br>
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