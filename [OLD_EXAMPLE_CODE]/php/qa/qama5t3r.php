<html>
   <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <table width="250" border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
         <td>
            Password:
         </td>
         <td>
            <input type="password" name="password">
         </td>
      </tr>
   </table>
   <br />
   <center>
      <input type="submit" name="Submit" value="Submit">
   </center>
   <br />
   </form>
   
<?php 
   if(isset($_POST['Submit'])) {
   
      mysql_connect("209.239.127.102","cruciuswoi12358","crupeter12358") or die(mysql_error());
      mysql_select_db("auth") or die(mysql_error());
      
      $password = $_POST['password'];
      $password = mysql_real_escape_string($password);
   
      if(!$password) {
         echo "<center>Please enter in the password.</center>";
      } else {
         if($password == 109901) {

         $sql2 = "SELECT * FROM `quality_assurance` ORDER BY `ID` DESC";
         $res2 = mysql_query($sql2) or die(mysql_error()); 

         if(mysql_num_rows($res2) > 50) {
            $row_max = 50;
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
                  <td align=center><b>
                     By
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
               $col22 = mysql_result($res2, $row, 22);
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
                  <td align=center>
                     $col22
                  </td>
               </tr>";
               }
            }
         }
      }
      echo "</table>";
   ?>
</html>