<html>
   <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <center>
      <br />
      <input type="submit" name="Submit" value="Grab">
      <br />
      </centre>
   </form>

<?php 

   mysql_connect("209.239.127.102","cruciuswoi12358","crupeter12358") or die(mysql_error());
   
   if(isset($_POST['Submit'])) {
      
      /*Blizz*/
      
      mysql_select_db("b_char") or die(mysql_error());
      
      $sql10 = "SELECT `guid`, `owner_guid` FROM `item_instance` WHERE `itemEntry`=20559 AND `count`>0";
      $res10 = mysql_query($sql10) or die(mysql_error());
      
      $max_row2 = mysql_num_rows($res10);
      $blizz_total_raffle = 0;
      $blizz_item_guid = 0;
      $blizz_owner = 0;
      
      for($row=0; $row < $max_row2; $row++) {
      
         $blizz_item_guid = mysql_result($res10, $row, 0);
         $blizz_owner = mysql_result($res10, $row, 1);
      
         $sql12 = "INSERT INTO `blizz_raffle` VALUES ($blizz_owner, 1)";
         $res12 = mysql_query($sql12) or die(mysql_error());
      
         $sql13 = "DELETE FROM `character_inventory` WHERE `item`=$blizz_item_guid";
         $res13 = mysql_query($sql13) or die(mysql_error());
      
         $blizz_total_raffle = $blizz_total_raffle + 1;
         
         $sql15 = "UPDATE `item_instance` SET `count`=0 WHERE `guid`=$blizz_item_guid";
         $res15 = mysql_query($sql15) or die(mysql_error());
      
      }
   
      echo "<br /><br />".$blizz_total_raffle." new raffle tickets found on Blizz.";
   
      $sql14 = "DELETE FROM `item_instance` WHERE `itemEntry`=20559";
      $res14 = mysql_query($sql14) or die(mysql_error());
      
   }

?>
</html>