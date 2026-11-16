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
                <?php
                if (!getuserid())
                        echo "<br><br><br><br><br>".send_login()."<br><br><br><br><br>";
                    else if (getgmlevel() < 3)
                        echo "<br><br><br><br><br>You must be a GM rank 4 or higher to use these features.<br><br><br><br><br>";
                    else
                    {
                ?>
                    <br><br><br><br><br>
                    <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
                        Account ID: <input type='text' name='chatacct'><br>
                        <input type=submit>
                <?php
                        if ((isset($_POST['chatacct'])) && intval($_POST['chatacct']) != 0)
                        {
                            $chatacct = intval($_POST['chatacct']);
                            $cdb = new db(getchardb());
                            $cdb->exec("DELETE FROM `account_data` WHERE `type` = '0' AND `account` = '$chatacct'");
                            echo "Query sent";
                        }
                    }
                ?>
                <br><br><br>
                <font color=grey>Enter a bugged character's account ID. This tool will clear their interface option settings, hopefully preventing them from getting invis wall stuck.</font>
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