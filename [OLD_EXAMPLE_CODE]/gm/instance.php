<html>
   <form method="POST" action="instance.php">
      <center>
         This will clear the `character_instance` table after verifying login details.
         <br />
         <br />
         Please allow the page to fully execute, do not refresh the page midway.
         <br />
         <br />
      </center>
      <table width="400" border="0" align="center" cellpadding="0" cellspacing="1">

         <tr>
            <td>
               Username:
            </td>
            <td>
               <input type="text" name="username">
            </td>
         </tr>
         <tr>
            <td>
               Password:
            </td>
            <td>
               <input type="password" name="password">
            </td>
         </tr>
         <tr>
            <td>
               Brief reason for purge:
            </td>
            <td>
               <input type="text" name="reason">
            </td>
         </tr>
         <tr>
            <td>
               Realm:
            </td>
            <td>
               <input type="radio" name="realm" value="blizz"> Blizzlike
               <input type="radio" name="realm" value="envy"> Envy
            </td>
         </tr>
      </table>
      <center>
         <br />
         <input type="submit" name="Submit" value="Purge">
      </center>
      <br />
   </form>
   
   <?php 
      if(isset($_POST['Submit'])) {
      
         mysql_connect("209.239.127.102","cruciuswoi12358","crupeter12358") or die(mysql_error());
         
         $curnum = 0;
         $username = $_POST['username'];
         $password = $_POST['password'];
         $reason = $_POST['reason'];
         $realm =$_POST['realm'];
         
         $username = strtolower($username);
         
         $username = mysql_real_escape_string($username);
         $code = mysql_real_escape_string($code);
         $reason = mysql_real_escape_string($reason);
      
         if(!$username) {
            $curnum ++;
            echo "".$curnum.". You have not entered your username.";
         }
         if(!$password) {
            $curnum ++;
            echo "".$curnum.". You have not entered your password.";
         }
         if(!$reason) {
            $curnum ++;
            echo "".$curnum.". Please specify the reason you are purging the instance locks.";
         }
         if(!$realm) {
            $curnum ++;
            echo "".$curnum.". Please specify the realm you are applying the purge to.";
         }
         if($curnum == 0) {
      
            mysql_select_db("auth") or die(mysql_error());

            $sql = "SELECT `password` FROM `instance_purge_login` WHERE `username`='$username'";
            $res = mysql_query($sql) or die(mysql_error());
            $password_chk = $res;
            
            if($password_chk != $res) {
               echo "Your password does not match.";
            } else {
            
               $time = time();
               $sql4 = "INSERT INTO instance_purge_logs (`username`, `reason`, `realm`) VALUES ('$username', '$reason', '$realm')";
               $res4 = mysql_query($sql4) or die(mysql_error());
            
               if($realm == 'blizz') {
                  mysql_select_db("b_char") or die(mysql_error());
               } else {
                  mysql_select_db("f_char") or die(mysql_error());
               }

               $sql2 = "SELECT `guid` FROM `character_instance`";
               $res2 = mysql_query($sql2) or die(mysql_error());

               $affected = 0;

               for($row=0; $row < mysql_num_rows($res2); $row++) {
                  $guid = mysql_result($res2, $row, 0);
                  $sql3 = "DELETE FROM `character_instance` WHERE `guid`=$guid";
                  $res3 = mysql_query($sql3) or die(mysql_error());
                  $affected ++;
               }

               echo "".$affected." unique instance locks purged. Log successfully saved.";

            }
         }
      }
   ?>
</html>