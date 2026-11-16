<html>
   <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <center>
         <b>
            Character Ban Check
         </b>
         <br />
         <br />
      </center>
      <table width="900" border="0" align="center" cellpadding="0" cellspacing="1">
         <tr>
            <td>
               Realm:
            </td>
            <td>
               <input type="radio" name="realm" value="Blizz">Immortality
               <input type="radio" name="realm" value="Envy">Envy
            </td>
         </tr>
         <tr>
            <td>
               Character GUID:
            </td>
            <td>
               <input type="text" name="guid">
            </td>
         </tr>
      </table>
      <center>
         <br />
         <input type="submit" name="Submit" value="Check">
      </center>
      <br />
   </form>
   <table width="900" border="0" align="center" cellpadding="0" cellspacing="1">
   
   <?php 
   
   mysql_connect("209.239.127.102","cruciuswoi12358","crupeter12358") or die(mysql_error());
   
   if(isset($_POST['Submit'])) {
      
      $curnum = 0;
      $realm = $_POST['realm'];
      $guid = $_POST['guid'];
      
      $guid = mysql_real_escape_string($guid);
      
      if(!$realm) {
         $curnum ++;
         echo "<tr><td>".$curnum.". Please specify the realm.</td></tr>";
      }
      if(!$guid) {
         $curnum ++;
         echo "<tr><td>".$curnum.". Please specify the GUID of the character.</td></tr>";
      }
      
      if($curnum == 0) {
         if($realm == 'Blizz') {
            mysql_select_db("b_char") or die(mysql_error());
         } else {
            mysql_select_db("f_char") or die(mysql_error());
         }
         
         $sql = "SELECT * FROM `character_banned` WHERE `guid`=$guid";
         $res = mysql_query($sql) or die(mysql_error());
         
         if(mysql_num_rows($res) < 1) {
            echo "<tr><td>The character is not banned.</td></tr>";
         } else {
            $timestampban = mysql_result($res, 0, 1);
            $timestampunban = mysql_result($res, 0, 2);
            $bannedby = mysql_result($res, 0, 3);
            $banreason = mysql_result($res, 0, 4);
            $active = mysql_result($res, 0, 5);
            $unbandate = date("d/m/Y H:i:s",$timestampunban);
            
            if($active == 0) {
               echo "<tr><td>The ban on the character has expired.</td></tr>";
            } else {
               if($timestampban == $timestampunban) {
                  echo "<tr><td>The character has been banned by $bannedby for reason : $banreason.</tr></td>";
                  echo "<tr><td>The ban is permanent.</tr></td>";
               } else {
                  echo "<tr><td>The character has been banned by $bannedby for reason : $banreason.</tr></td>";
                  echo "<tr><td>The ban is set to expires on $unbandate.</tr></td>";
               }
            }
         }
      }
   }
   ?>
   </table>
</html>