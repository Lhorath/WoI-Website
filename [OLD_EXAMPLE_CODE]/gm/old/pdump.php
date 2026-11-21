<?php
require_once( '../includes.php' );
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
                <br /><br /><font size='4' color='white'>Showing all deleted and retrievable characters...</font><br><br><br>
                <br /><a href="pdump.php?a=0"><font color="orange">Blizz Chars</font></a> | <a href="pdump.php?a=1"><font color="orange">Dev Chars</font></a>
                <br /><br /><br /><font color="red">Don't forget to replace acct_name with the account name!</font>
                <br /><br /><br />
                <?php
                    $realm = $_GET['a'] == 0 ? 'blizz' : 'dev';
                    if (!getuserid())
                        echo "<br><br><br><br><br>".send_login()."<br><br><br><br><br>";
                    else if (getgmlevel() < 4)
                        echo "<br><br><br><br><br>You must be a GM rank 4 or higher to use these features.<br><br><br><br><br>";
                    else
                    {
                        $content_array = array();
                    	$dirname = "c:/cores/".$realm."/logs/dumps/";
                    	$handle = opendir($dirname);
                    	$i = 0;
                    	echo "<table><tr><td>File Name</td><td>Command Line</td></tr>";
                    	while ($file = readdir($handle))
                    	{
                    		if ($file != "." && $file != "..")
                    		{
                    			   $content_array[$i][0] = $file;
                    			   $content_array[$i][1] = date ("Y, m, d | g:ia", filemtime($dirname."/".$file));
                    				$i++;
                    		}
                    	}
                    	closedir($handle);
                    	foreach($content_array as $res)
                    	   $sortAux[] = $res[1];
                    	foreach($content_array as $row)
                    		echo "<tr><td>".$row[0]."</td><td>.pdump load logs/dumps/".$row[0]." acct_name</td></tr>";
                    	echo "</table>";
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