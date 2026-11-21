<?php

   mysql_connect("209.239.127.102","cruciuswoi12358","crupeter12358") or die(mysql_error());
   mysql_select_db("b_char") or die(mysql_error());
   
   $sql = "SELECT * FROM `rafflesort`";
   $res = mysql_query($sql) or die(mysql_error());
   
   $maxrow = mysql_num_rows($res) - 1;
   
   for($row=0; $row < $maxrow; $row++) {
      
      $character = mysql_result($res, $row, 1);
      $count = mysql_result($res, $row, 2);
      
      echo ".send item ".$character." \"Raffle Reward\" \"Here are your EoF from collecting raffle tickets from the last raffle.\" 49426:".$count."";
      echo "<br />";
      
   }
   
?>