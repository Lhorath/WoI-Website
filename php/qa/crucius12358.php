<html>
   <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <center>
         <b>
            Quality Assurance Scorecard
         </b>
         <br />
         <br />
      </center>
      <table width="900" border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
         <td>
            Staff Name:
         </td>
         <td>
            <input type="text" name="staff_name">
         </td>
      </tr>
      <tr>
         <td>
            Position:
         </td>
         <td>
            <input type="text" name="position">
         </td>
         <td>
            Rank:
         </td>
         <td>
            <input type="text" name="rank">
         </td>
      </tr>
      <tr>
         <td>
            Player Name:
         </td>
         <td>
            <input type="text" name="player_name">
         </td>
      </tr>
      <tr>
         <td>
            Ticket No.
         </td>
         <td>
            <input type="text" name="ticket_number">
         </td>
      </tr>
      <tr>
         <td>
            Proper Scripting (/15)
         </td>
         <td>
            <input type="text" name="proper_scripting">
         </td>
      </tr>
      <tr>
         <td>
            Probing Questions (/15)
         </td>
         <td>
            <input type="text" name="probing_questions">
         </td>
      </tr>
      <tr>
         <td>
            Troubleshooting (/30)
         </td>
         <td>
            <input type="text" name="troubleshooting">
         </td>
      </tr>
      <tr>
         <td>
            Further Asssistance (/15)
         </td>
         <td>
            <input type="text" name="further_assist">
         </td>
      </tr>
      <tr>
         <td>
            Proper Closing (/15)
         </td>
         <td>
            <input type="text" name="proper_closing">
         </td>
      </tr>
      <tr>
         <td>
            Issue Resolved (/10)
         </td>
         <td>
            <input type="text" name="issue_resolved">
         </td>
      </tr>
      <tr>
         <td>
            Dead Air (-10)
         </td>
         <td>
            <input type="radio" name="deadair" value="10">Yes
            <input type="radio" name="deadair" value="1">No
         </td>
         <td>
            Dead Air Additional Count (-5)
         </td>
         <td>
            <input type="text" name="deadair2">
         </td>
      </tr>
      <tr>
         <td>
            Dead Air Extended (-10)
         </td>
         <td> 
            <input type="radio" name="deadair_extend" value="10">Yes
            <input type="radio" name="deadair_extend" value="1">No
         </td>
         <td>
            Occurances
         </td>
         <td>
            <input type="text" name="deadair_extend2">
         </td>
      </tr>
      <tr>
         <td>
            Profanity (-100%)
         </td>
         <td>
            <input type="radio" name="profanity" value="1">Yes
            <input type="radio" name="profanity" value="1">No
         </td>
      </tr>
      <tr>
         <td>
            "I Don't Know" (-20)
         </td>
         <td>
            <input type="radio" name="dont_know" value="20">Yes
            <input type="radio" name="dont_know" value="1">No
         </td>
         <td>
            Occurances
         </td>
         <td>
            <input type="text" name="dont_know_count">
         </td>
      </tr>
      <tr>
         <td>
            Unauthorised Port (-30)
         </td>
         <td>
            <input type="radio" name="unauth_port" value="30">Yes
            <input type="radio" name="unauth_port" value="1">No
         </td>
      </tr>
      <tr>
         <td>
            Staff was Rude (-30)
         </td>
         <td>
            <input type="radio" name="rude" value="30">Yes
            <input type="radio" name="rude" value="1">No
         </td>
      </tr>
      <tr>
         <td>
            Staff lied (-30)
         </td>
         <td>
            <input type="radio" name="lied" value="30">Yes
            <input type="radio" name="lied" value="1">No
         </td>
      </tr>
      <tr>
         <td>
            Comments
         </td>
         <td>
            <input type="text" name="comments">
         </td>
      </tr>
      <tr>
         <td>
            Auth Code
         </td>
         <td>
            <input type="password" name="auth">
         </td>
      </tr>
      </table>
      <center>
         <br />
         <input type="submit" name="Submit" value="Add">
      </center>
      <br />
   </form>
   <table width="900" border="0" align="center" cellpadding="0" cellspacing="1">

   <?php 
      mysql_connect("209.239.127.102","cruciuswoi12358","crupeter12358") or die(mysql_error());
      mysql_select_db("auth") or die(mysql_error());
         
      if(isset($_POST['Submit'])) {

         $curnum = 0;
         $total = 0;
         $staffname = $_POST['staff_name'];
         $position = $_POST['position'];
         $rank = $_POST['rank'];
         $playername = $_POST['player_name'];
         $ticketnumber = $_POST['ticket_number'];
         $properscripting = $_POST['proper_scripting'];
         $probingquestions = $_POST['probing_questions'];
         $troubleshooting = $_POST['troubleshooting'];
         $furtherassist = $_POST['further_assist'];
         $properclosing = $_POST['proper_closing'];
         $issueresolved = $_POST['issue_resolved'];
         $deadair = $_POST['deadair'];
         $deadair2 = $_POST['deadair2'];
         $deadairextend = $_POST['deadair_extend'];
         $deadairextendcount = $_POST['deadair_extend2'];
         $profanity = $_POST['profanity'];
         $dontknow = $_POST['dont_know'];
         $dontknowcount = $_POST['dont_know_count'];
         $unauthport = $_POST['unauth_port'];
         $rude = $_POST['rude'];
         $lied = $_POST['lied'];
         $comments = $_POST['comments'];
         $auth = $_POST['auth'];

         /* Injection Protection*/
         $staffname = mysql_real_escape_string($staffname);
         $position = mysql_real_escape_string($position);
         $rank = mysql_real_escape_string($rank);
         $playername = mysql_real_escape_string($playername);
         $ticketnumber = mysql_real_escape_string($ticketnumber);
         $properscripting = mysql_real_escape_string($properscripting);
         $probingquestions = mysql_real_escape_string($probingquestions);
         $troubleshooting = mysql_real_escape_string($troubleshooting);
         $furtherassist = mysql_real_escape_string($furtherassist);
         $properclosing = mysql_real_escape_string($properclosing);
         $issueresolved = mysql_real_escape_string($issueresolved);
         $deadairextendedcount = mysql_real_escape_string($deadairextendedcount);
         $dontknowcount = mysql_real_escape_string($dontknowcount);
         $comments = mysql_real_escape_string($comments);
         $auth = mysql_real_escape_string($auth);
         
         /* Error Checking*/
         if(!$staffname) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please enter the name of the Staff member being assessed.</td></tr>";
         }
         if(!$position) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please enter the position of the Staff member being assessed.</td></tr>";
         }
         if(!$rank) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please enter the rank of the Staff member being assessed.</td></tr>";
         }      
         if(!$ticketnumber) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please enter the ticket number of the player.</td></tr>";
         }
         if(!$deadair) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please select if there was dead air time from the Staff member.</td></tr>";
         }
         if(!$deadairextend) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please select if there was an extended dead air time from the Staff member.</td></tr>";
         }
         if($deadairextend != 1) {
            if(!$deadairextendcount) {
               $curnum ++;
               echo "<tr><td>".$curnum.". Please enter the number of times there was extended dead air time from the Staff member.</td></tr>";
            }
         }
         if(!$profanity) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please select if there was profanity from the Staff member.</td></tr>";
         }
         if(!$dontknow) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please select if 'I do not know' was said by the Staff member.</td></tr>";
         }
         if($dontknow != 1) {
            if(!$dontknowcount) {
               $curnum ++;
               echo "<tr><td>".$curnum.". Please enter the number of times 'I do not know' was said by the Staff member.</td></tr>";
            }
         }
         if(!$unauthport) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please select if the player was ported without being asked by the Staff member.</td></tr>";
         }
         if(!$rude) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please select if the Staff member was rude.</td></tr>";
         }
         if(!$lied) {
            $curnum ++;
            echo "<tr><td>".$curnum.". Please select if the Staff member lied.</td></tr>";
         }
         if(!$auth) { 
            $curnum ++;
            echo "<tr><td>".$curnum.". Please enter in your authorization code.</td></tr>";
         }
         
         echo "</table>";

         if($curnum == 0) {
            if($auth == 1337) {
               
               /*Calculations*/
               if($deadair2 > 0) {
                  $deadair2 = 5*$deadair2;
               } else {
                  $deadair2 = 0;
               }
               if($deadairextend == 10) {
                  $deadairextend = 10*$deadairextendcount;
               } else {
                  $deadairextend = 0;
               }
               if($dontknow == 20) { 
                  $dontknow = $dontknowcount*$dontknow;
               } else { 
                  $dontknow = 0;
               }
               if($deadair == 1) {
                  $deadair = 0;
               }
               if($unauthport == 1) {
                  $unauthport = 0;
               }
               if($rude == 1) {
                  $rude = 0;
               } 
               if($lied == 1) {
                  $lied = 0;
               }
               if($profanity == 1) {
                  $profanity = 0;
               }
               
               $total = $properscripting + $probingquestions + $troubleshooting + $furtherassist + $properclosing + $issueresolved;
               $total = $total - $deadair - $deadair2 - $deadairextend - $unauthport - $rude - $lied - $dontknow;
               
               /* Set score to 0 if profanity was involved*/
               if($profanity == 2) {
                  $total = 0;
               }
               
               /*Insertion*/
               $sql3 = "SELECT * FROM `quality_assurance` WHERE `ticket_number`='$ticketnumber'";
               $res3 = mysql_query($sql3) or die(mysql_error());
               
               if(mysql_num_rows($res3) > 0) {
                  echo "<center>An entry for the same ticket ID already exists. Aborting.</center>";
               } else { 
               
                  $sql = "INSERT INTO `quality_assurance` (`staff_name`, `position`, `rank`, `player_name`, `ticket_number`, `proper_scripting`, `probing_questions`, `troubleshooting`, `further_assist`, `proper_closing`, `issue_resolved`, `deadair`, `deadair_extend`, `profanity`, `dont_know`, `unauth_port`, `rude`, `lied`, `total`, `comments`, `assessor`) VALUES ('$staffname', '$position', '$rank', '$playername', '$ticketnumber', '$properscripting', '$probingquestions', '$troubleshooting', '$furtherassist', '$properclosing', '$issueresolved', '$deadair', '$deadairextend', '$profanity',  '$dontknow', '$unauthport', '$rude', '$lied', '$total', '$comments', 'Crucius')";
                  $res = mysql_query($sql) or die(mysql_error());
                  
                  echo "
                  <center>
                     Record Added.
                  </center>";
                  
               }
            } else {
               echo "Your authorization code does not match.";
            }
         }
      }
   ?>
   <br />
   <br />
   <?php 
      $sql2 = "SELECT * FROM `quality_assurance` WHERE `assessor`='Crucius' ORDER BY `ID` DESC";
      $res2 = mysql_query($sql2) or die(mysql_error()); 
      
      if(mysql_num_rows($res2) > 20) {
         $row_max = 20;
      } else {
         $row_max = mysql_num_rows($res2);
      }

      echo "<center><b>Records</b></center><br />";
      echo "
      <b>
      <table width='1900' border='1' align='center' cellpadding='0' cellspacing='0' >
         <tr>
            <td align=center><b>
            </b></td>
            <td align=center><b>
            </b></td>
            <td align=center><b>
            </b></td>
            <td align=center><b>
            </b></td>
            <td align=center><b>
            </b></td>
            <td align=center><b>
               +
            </b></td>
            <td align=center><b>
               +
            </b></td>
            <td align=center><b>
               +
            </b></td>
            <td align=center><b>
               +
            </b></td>
            <td align=center><b>
               +
            </b></td>
            <td align=center><b>
               +
            </b></td>
            <td align=center><b>
               -
            </b></td>
            <td align=center><b>
               -
            </b></td>
            <td align=center><b>
               -
            </b></td>
            <td align=center><b>
               -
            </b></td>
            <td align=center><b>
               -
            </b></td>
            <td align=center><b>
               -
            </b></td>
            <td align=center><b>
               -
            </b></td>
            <td align=center><b>
            </b></td>
            <td align=center><b>
            </b></td>
         </tr>
         <tr>
            <td align=center><b>
               ID
            </b></td>
            <td align=center><b>
               Staff
            </b></td>
            <td align=center><b>
               Position
            </b></td>
            <td align=center><b>
               Char
            </b></td>
            <td align=center><b>
               Ticket
            </b></td>
            <td align=center><b>
               Scripting
            </b></td>
            <td align=center><b>
               Probing Q.
            </b></td>
            <td align=center><b>
               Troubleshoot
            </b></td>
            <td align=center><b>
               Further Ass.
            </b></td>
            <td align=center><b>
               Closing
            </b></td>
            <td align=center><b>
               Resolved
            </b></td>
            <td align=center><b>
               Dead Air
            </b></td>
            <td align=center><b>
               Dead Air Ext
            </b></td>
            <td align=center><b>
               Profanity
            </b></td>
            <td align=center><b>
               'IDK'
            </b></td>
            <td align=center><b>
               Unauth. Port
            </b></td>
            <td align=center><b>
               Rudeness
            </b></td>
            <td align=center><b>
               Lied
            </b></td>
            <td align=center><b>
               Total
            </b></td>
            <td align=center><b>
               Comments
            </b></td>
         </tr>";
   
      for($row=0; $row < $row_max; $row++) {
         $col0 = mysql_result($res2, $row, 0);
         $col1 = mysql_result($res2, $row, 1);
         $col2 = mysql_result($res2, $row, 2);
         $col3 = mysql_result($res2, $row, 3);
         $col5 = mysql_result($res2, $row, 5);
         $col6 = mysql_result($res2, $row, 6);
         $col7 = mysql_result($res2, $row, 7);
         $col8 = mysql_result($res2, $row, 8);
         $col9 = mysql_result($res2, $row, 9);
         $col10 = mysql_result($res2, $row, 10);
         $col11 = mysql_result($res2, $row, 11);
         $col12 = mysql_result($res2, $row, 12);
         $col13 = mysql_result($res2, $row, 13);
         $col14 = mysql_result($res2, $row, 14);
         $col15 = mysql_result($res2, $row, 15);
         $col16 = mysql_result($res2, $row, 16);
         $col17 = mysql_result($res2, $row, 17);
         $col18 = mysql_result($res2, $row, 18);
         $col19 = mysql_result($res2, $row, 19);
         $col20 = mysql_result($res2, $row, 20);
         $col21 = mysql_result($res2, $row, 21);
         echo "
         <tr>
            <td align=center>
               $col0
            </td>
            <td align=center>
               $col1
            </td>
            <td align=center>
               Level $col3 $col2
            </td>
            <td align=center>
               $col5
            </td>
            <td align=center>
               $col6
            </td>
            <td align=center>
               $col7
            </td>
            <td align=center>
               $col8
            </td>
            <td align=center>
               $col9
            </td>
            <td align=center>
               $col10
            </td>
            <td align=center>
               $col11
            </td>
            <td align=center>
               $col12
            </td>
            <td align=center>
               $col13
            </td>
            <td align=center>
               $col14
            </td>
            <td align=center>
               $col15
            </td>
            <td align=center>
               $col16
            </td>
            <td align=center>
               $col17
            </td>
            <td align=center>
               $col18
            </td>
            <td align=center>
               $col19
            </td>
            <td align=center>
               $col20
            </td>
            <td align=center>
               $col21
            </td>
         </tr>";
      }
      
      echo "</table>";
   ?>
</html>