<html>

   <?php
   
         mysql_connect("209.239.127.102","cruciuswoi12358","crupeter12358") or die(mysql_error());
         mysql_select_db("f_char") or die(mysql_error());

         $sql = "SELECT * FROM `envy_raffle` ORDER BY `guid` ASC";
         $res = mysql_query($sql) or die(mysql_error());

   while ($resultset = mysql_fetch_array($res)) {
   
      $totals[$resultset['guid']] += $resultset['count'];

   }

   print_r($totals);


   ?>
   
</html>