<?php

   mysql_connect("209.239.127.102","cruciuswoi12358","crupeter12358") or die(mysql_error());
   mysql_select_db("f_char") or die(mysql_error());
   
   $maxrow = 0;
   $row = 0;
   $guid = 0;
   $character = 0;
   
   $sql = "SELECT * FROM `envy_raffle` ORDER BY `guid` ASC";
   $res = mysql_query($sql) or die(mysql_error());
   
   $maxrow = mysql_num_rows($res) - 1;
   
   for($row=0; $row < $maxrow; $row++) {
   
      $guid = mysql_result($res, $row, 0);
      
      $sql2 = "SELECT `name` FROM `characters` WHERE `guid`=$guid";
      $res2 = mysql_query($sql2) or die(mysql_error());
      
      $character = mysql_result($res2, 0, 0);
      
      $sql3 = "UPDATE `rafflesort` SET `character`='$character' WHERE `guid`=$guid";
      $res3 = mysql_query($sql3) or die(mysql_error());
      
   }

?>