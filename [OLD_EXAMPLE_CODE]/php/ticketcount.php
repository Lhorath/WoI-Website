<html>
   <br />
   <br />
   <center><b>
      Total Tickets Done
   </b></center>
   <br />
   <br />

   <?php

      mysql_connect("209.239.127.102","cruciuswoi12358","crupeter12358") or die(mysql_error());
      
      /***************
      Reference Section
      
      - Name - Blizz - Fun
      
      - Airbitter - 89046 - 30576
      - Bladric - 92148 - x
      - Bluepitt - 4148 - x
      - Casket - 83833 - 27319
      - Fallenshade - 89390 - 31112
      - Gasper - 92146 - 32548
      - Kahn - 92224 - 32645
      - Kamaleon - 89016 - 30578
      - Malaki - 88280 - 30020
      - Manice - 85475 - 28196
      - Menethil - 89038 - 30569
      - Odinn - 81225 - 24683
      - Orihime - 49065 - 18089
      - Sabrina - 86629 - 28803
      - Shadesofgrey - 85360 - 29649
      - Tatsuki - 85789 - 28183
      - Uniceol - 86840 - 14363
      - Vigilante - 92161 - 32556
      - Xaki - 89383 - 25486
      - Zatox - 91145 - 32012
	  - Razuvious - 94390
	  - Eidolon - 107524
	  - Sunny - 79919
      ***************/
      
      /******BLIZZ LOGS*****/
      
      mysql_select_db("b_char") or die(mysql_error());

      $airbitter_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=89046";
      $airbitter_b_tick = mysql_query($airbitter_b_tick_sql) or die(mysql_error());
      $airbitter_b_tick_count = mysql_num_rows($airbitter_b_tick);

      $bladric_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=92148";
      $bladric_b_tick = mysql_query($bladric_b_tick_sql) or die(mysql_error());
      $bladric_b_tick_count = mysql_num_rows($bladric_b_tick);

      $bluepitt_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=4148";
      $bluepitt_b_tick = mysql_query($bluepitt_b_tick_sql) or die(mysql_error());
      $bluepitt_b_tick_count = mysql_num_rows($bluepitt_b_tick);

      $casket_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=83833";
      $casket_b_tick = mysql_query($casket_b_tick_sql) or die(mysql_error());
      $casket_b_tick_count = mysql_num_rows($casket_b_tick);
      
      $fallenshade_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=89390";
      $fallenshade_b_tick = mysql_query($fallenshade_b_tick_sql) or die(mysql_error());
      $fallenshade_b_tick_count = mysql_num_rows($fallenshade_b_tick);

      $gasper_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=92146";
      $gasper_b_tick = mysql_query($gasper_b_tick_sql) or die(mysql_error());
      $gasper_b_tick_count = mysql_num_rows($gasper_b_tick);

      $kahn_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=92224";
      $kahn_b_tick = mysql_query($kahn_b_tick_sql) or die(mysql_error());
      $kahn_b_tick_count = mysql_num_rows($kahn_b_tick);

      $kamaleon_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=89016";
      $kamaleon_b_tick = mysql_query($kamaleon_b_tick_sql) or die(mysql_error());
      $kamaleon_b_tick_count = mysql_num_rows($kamaleon_b_tick);

      $malaki_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=88280";
      $malaki_b_tick = mysql_query($malaki_b_tick_sql) or die(mysql_error());
      $malaki_b_tick_count = mysql_num_rows($malaki_b_tick);
      
      $manice_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=85475";
      $manice_b_tick = mysql_query($manice_b_tick_sql) or die(mysql_error());
      $manice_b_tick_count = mysql_num_rows($manice_b_tick);

      $menethil_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=89038";
      $menethil_b_tick = mysql_query($menethil_b_tick_sql) or die(mysql_error());
      $menethil_b_tick_count = mysql_num_rows($menethil_b_tick);

      $odinn_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=81225";
      $odinn_b_tick = mysql_query($odinn_b_tick_sql) or die(mysql_error());
      $odinn_b_tick_count = mysql_num_rows($odinn_b_tick);

      $orihime_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=49065";
      $orihime_b_tick = mysql_query($orihime_b_tick_sql) or die(mysql_error());
      $orihime_b_tick_count = mysql_num_rows($orihime_b_tick);

      $sabrina_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=86629";
      $sabrina_b_tick = mysql_query($sabrina_b_tick_sql) or die(mysql_error());
      $sabrina_b_tick_count = mysql_num_rows($sabrina_b_tick);

      $shadesofgrey_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=85360";
      $shadesofgrey_b_tick = mysql_query($shadesofgrey_b_tick_sql) or die(mysql_error());
      $shadesofgrey_b_tick_count = mysql_num_rows($shadesofgrey_b_tick);
      
      $tatsuki_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=85789";
      $tatsuki_b_tick = mysql_query($tatsuki_b_tick_sql) or die(mysql_error());
      $tatsuki_b_tick_count = mysql_num_rows($tatsuki_b_tick);

      $uniceol_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=86840";
      $uniceol_b_tick = mysql_query($uniceol_b_tick_sql) or die(mysql_error());
      $uniceol_b_tick_count = mysql_num_rows($uniceol_b_tick);

      $vigilante_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=92161";
      $vigilante_b_tick = mysql_query($vigilante_b_tick_sql) or die(mysql_error());
      $vigilante_b_tick_count = mysql_num_rows($vigilante_b_tick);

      $xaki_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=89383";
      $xaki_b_tick = mysql_query($xaki_b_tick_sql) or die(mysql_error());
      $xaki_b_tick_count = mysql_num_rows($xaki_b_tick);

      $zatox_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=91145";
      $zatox_b_tick = mysql_query($zatox_b_tick_sql) or die(mysql_error());
      $zatox_b_tick_count = mysql_num_rows($zatox_b_tick);

	  
	  $conviction_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=93433";
      $conviction_b_tick = mysql_query($conviction_b_tick_sql) or die(mysql_error());
      $conviction_b_tick_count = mysql_num_rows($conviction_b_tick);
	  
	  $aggron_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=93759";
      $aggron_b_tick = mysql_query($aggron_b_tick_sql) or die(mysql_error());
      $aggron_b_tick_count = mysql_num_rows($aggron_b_tick);
	  
	  $khloe_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=94084";
      $khloe_b_tick = mysql_query($khloe_b_tick_sql) or die(mysql_error());
      $khloe_b_tick_count = mysql_num_rows($khloe_b_tick);
	  
	  $karuku_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=92653";
      $karuku_b_tick = mysql_query($karuku_b_tick_sql) or die(mysql_error());
      $karuku_b_tick_count = mysql_num_rows($karuku_b_tick);
	  
	  
	  	  $razuvious_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=94390";
      $razuvious_b_tick = mysql_query($razuvious_b_tick_sql) or die(mysql_error());
      $razuvious_b_tick_count = mysql_num_rows($razuvious_b_tick);
	  
	  	  $grimfate_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=94505";
      $grimfate_b_tick = mysql_query($grimfate_b_tick_sql) or die(mysql_error());
      $grimfate_b_tick_count = mysql_num_rows($grimfate_b_tick);	  
	  
	  
	        $eidolon_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=96467";
      $eidolon_b_tick = mysql_query($eidolon_b_tick_sql) or die(mysql_error());
      $eidolon_b_tick_count = mysql_num_rows($eidolon_b_tick);
	  
	  
	  
	        $sunny_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=79919";
      $sunny_b_tick = mysql_query($sunny_b_tick_sql) or die(mysql_error());
      $sunny_b_tick_count = mysql_num_rows($sunny_b_tick);
	  
	  
      /******ENVY LOGS*****/

      mysql_select_db("f_char") or die(mysql_error());

      $airbitter_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=30576";
      $airbitter_f_tick = mysql_query($airbitter_f_tick_sql) or die(mysql_error());
      $airbitter_f_tick_count = mysql_num_rows($airbitter_f_tick);

/*
      $bladric_b_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=92148";
      $bladric_b_tick = mysql_query($bladric_b_tick_sql) or die(mysql_error());
      $bladric_b_tick_count = mysql_num_rows($bladric_b_tick);
*/

/*
      $bluepitt_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=4148";
      $bluepitt_f_tick = mysql_query($bluepitt_f_tick_sql) or die(mysql_error());
      $bluepitt_f_tick_count = mysql_num_rows($bluepitt_f_tick);
*/

      $casket_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=27319";
      $casket_f_tick = mysql_query($casket_f_tick_sql) or die(mysql_error());
      $casket_f_tick_count = mysql_num_rows($casket_f_tick);
      
      $fallenshade_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=31112";
      $fallenshade_f_tick = mysql_query($fallenshade_f_tick_sql) or die(mysql_error());
      $fallenshade_f_tick_count = mysql_num_rows($fallenshade_f_tick);

      $gasper_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=32548";
      $gasper_f_tick = mysql_query($gasper_f_tick_sql) or die(mysql_error());
      $gasper_f_tick_count = mysql_num_rows($gasper_f_tick);

      $kahn_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=32645";
      $kahn_f_tick = mysql_query($kahn_f_tick_sql) or die(mysql_error());
      $kahn_f_tick_count = mysql_num_rows($kahn_f_tick);

      $kamaleon_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=30578";
      $kamaleon_f_tick = mysql_query($kamaleon_f_tick_sql) or die(mysql_error());
      $kamaleon_f_tick_count = mysql_num_rows($kamaleon_f_tick);
      
      $malaki_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=30020";
      $malaki_f_tick = mysql_query($malaki_f_tick_sql) or die(mysql_error());
      $malaki_f_tick_count = mysql_num_rows($malaki_f_tick);

      $manice_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=28196";
      $manice_f_tick = mysql_query($manice_f_tick_sql) or die(mysql_error());
      $manice_f_tick_count = mysql_num_rows($manice_f_tick);

      $menethil_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=30569";
      $menethil_f_tick = mysql_query($menethil_f_tick_sql) or die(mysql_error());
      $menethil_f_tick_count = mysql_num_rows($menethil_f_tick);

      $odinn_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=24683";
      $odinn_f_tick = mysql_query($odinn_f_tick_sql) or die(mysql_error());
      $odinn_f_tick_count = mysql_num_rows($odinn_f_tick);

      $orihime_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=18089";
      $orihime_f_tick = mysql_query($orihime_f_tick_sql) or die(mysql_error());
      $orihime_f_tick_count = mysql_num_rows($orihime_f_tick);

      $sabrina_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=28803";
      $sabrina_f_tick = mysql_query($sabrina_f_tick_sql) or die(mysql_error());
      $sabrina_f_tick_count = mysql_num_rows($sabrina_f_tick);

      $shadesofgrey_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=29649";
      $shadesofgrey_f_tick = mysql_query($shadesofgrey_f_tick_sql) or die(mysql_error());
      $shadesofgrey_f_tick_count = mysql_num_rows($shadesofgrey_f_tick);

      $tatsuki_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=28183";
      $tatsuki_f_tick = mysql_query($tatsuki_f_tick_sql) or die(mysql_error());
      $tatsuki_f_tick_count = mysql_num_rows($tatsuki_f_tick);

      $uniceol_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=14363";
      $uniceol_f_tick = mysql_query($uniceol_f_tick_sql) or die(mysql_error());
      $uniceol_f_tick_count = mysql_num_rows($uniceol_f_tick);

      $vigilante_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=32556";
      $vigilante_f_tick = mysql_query($vigilante_f_tick_sql) or die(mysql_error());
      $vigilante_f_tick_count = mysql_num_rows($vigilante_f_tick);

      $xaki_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=25486";
      $xaki_f_tick = mysql_query($xaki_f_tick_sql) or die(mysql_error());
      $xaki_f_tick_count = mysql_num_rows($xaki_f_tick);

      $zatox_f_tick_sql = "SELECT * FROM `gm_tickets` WHERE `assignedto`=32012";
      $zatox_f_tick = mysql_query($zatox_f_tick_sql) or die(mysql_error());
      $zatox_f_tick_count = mysql_num_rows($zatox_f_tick);

      echo "<table width='1000' border='1' align='center' cellpadding='0' cellspacing='0'>";
         echo "<tr>";
            echo "<td>";
               echo "Name";
            echo "</td>";
            echo "<td>";
               echo "Blizz Ticket Total";
            echo "</td>";
            echo "<td>";
               echo "Envy Ticket Total";
            echo "</td>";
         echo "</tr>";
 
         echo "<tr>";
            echo "<td>";
               echo "Gasper";
            echo "</td>";
            echo "<td>";
               echo "$gasper_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "$gasper_f_tick_count";
            echo "</td>";
         echo "</tr>";
         
         echo "<tr>";
            echo "<td>";
               echo "Malaki";
            echo "</td>";
            echo "<td>";
               echo "$malaki_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "$malaki_f_tick_count";
            echo "</td>";
         echo "</tr>";
         
        
         echo "<tr>";
            echo "<td>";
               echo "Odinn";
            echo "</td>";
            echo "<td>";
               echo "$odinn_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "$odinn_f_tick_count";
            echo "</td>";
         echo "</tr>";
         echo "<tr>";
            echo "<td>";
               echo "Orihime";
            echo "</td>";
            echo "<td>";
               echo "$orihime_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "$orihime_f_tick_count";
            echo "</td>";
         echo "</tr>";
         echo "<tr>";
            echo "<td>";
               echo "Sabrina";
            echo "</td>";
            echo "<td>";
               echo "$sabrina_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "$sabrina_f_tick_count";
            echo "</td>";
         echo "</tr>";
        
         echo "<tr>";
            echo "<td>";
               echo "Tatsuki";
            echo "</td>";
            echo "<td>";
               echo "$tatsuki_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "$tatsuki_f_tick_count";
            echo "</td>";
         echo "</tr>";
        
         echo "<tr>";
            echo "<td>";
               echo "Vigilante";
            echo "</td>";
            echo "<td>";
               echo "$vigilante_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "$vigilante_f_tick_count";
            echo "</td>";
         echo "</tr>";
         echo "<tr>";
            echo "<td>";
               echo "Xaki";
            echo "</td>";
            echo "<td>";
               echo "$xaki_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "$xaki_f_tick_count";
            echo "</td>";
         echo "</tr>";
         echo "</tr>";

		          echo "<tr>";
            echo "<td>";
               echo "Conviction";
            echo "</td>";
            echo "<td>";
               echo "$conviction_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "$conviction_f_tick_count";
            echo "</td>";
         echo "</tr>";


		 
		 		          echo "<tr>";
            echo "<td>";
               echo "Karuku";
            echo "</td>";
            echo "<td>";
               echo "$karuku_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "$karuku_f_tick_count";
            echo "</td>";
         echo "</tr>";
		 
		 
		 	          echo "<tr>";
            echo "<td>";
               echo "Razuvious";
            echo "</td>";
            echo "<td>";
               echo "$razuvious_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "No envy logs";
            echo "</td>";
         echo "</tr>";
		 
		 
		 	          echo "<tr>";
            echo "<td>";
               echo "Grimfate";
            echo "</td>";
            echo "<td>";
               echo "$grimfate_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "No envy logs";
            echo "</td>";
         echo "</tr>";
		


		 	          echo "<tr>";
            echo "<td>";
               echo "Eidolon";
            echo "</td>";
            echo "<td>";
               echo "$eidolon_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "No envy logs";
            echo "</td>";
         echo "</tr>";
		



		 	          echo "<tr>";
            echo "<td>";
               echo "Sunny";
            echo "</td>";
            echo "<td>";
               echo "$sunny_b_tick_count";
            echo "</td>";
            echo "<td>";
               echo "No envy logs";
            echo "</td>";
         echo "</tr>";
				
      echo "</table>";

	  
	  
   ?>

</html>