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
      
      /*Envy*/
      
      mysql_select_db("f_Char") or die(mysql_error());
      
      $sql = "SELECT `item` FROM `character_inventory` WHERE `item_template`=20559";
      $res = mysql_query($sql) or die(mysql_error());
      
      $max_row = mysql_num_rows($res);
      $envy_total_raffle = 0;
      $envy_item_guid = 0;
      $envy_owner = 0;
      
      for($row=0; $row < $max_row; $row++) {

         $envy_item_guid = mysql_result($res, $row, 0);
         
         $sql2 = "SELECT `owner_guid` FROM `item_instance` WHERE `guid`=$envy_item_guid";
         $res2 = mysql_query($sql2) or die(mysql_error());
         
         $envy_owner = mysql_result($res2, 0, 0);
         
         $sql3 = "SELECT * FROM `envy_raffle` WHERE `guid`=$envy_owner";
         $res3 = mysql_query($sql3) or die(mysql_error());

         $sql4 = "INSERT INTO `envy_raffle` VALUES ($envy_owner, 1)";
         $res4 = mysql_query($sql4) or die(mysql_error());
      
         $envy_total_raffle = $envy_total_raffle + 1;
      
         $sql5 = "DELETE FROM `item_instance` WHERE `guid`=$envy_item_guid";
         $res5 = mysql_query($sql5) or die(mysql_error());
      
      }
   
      echo "".$envy_total_raffle." new raffle tickets found on Envy.";

      $sql6 = "DELETE FROM `character_inventory` WHERE `item_template`=20559";
      $res6 = mysql_query($sql6) or die(mysql_error());
   
   }

?>
</html>