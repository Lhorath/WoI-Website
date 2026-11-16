<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <title>World of Immortality - Tournaments</title>
   <link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
   <div class="nav_left"></div>
   <div class="nav_holder">
         <ul id="navigation">
         <li><a href="../../">MAIN SITE</a></li>
         <li><a href="../index.php">TOURNAMENT HOME</a></li>
         <li><a href="http://worldofimmortality.servegame.org/forums/">FORUMS</a></li>
         <li><a href="index.php">TOURNAMENT INFO</a></li>
         <li><a href="#">REGISTER</a></li>
         <li><a href="../ladder/">LADDER</a></li>
         <li><a href="../statistics/">STATISTICS</a></li>
         <li><a href="../media/">MEDIA</a></li>
         <!-- Links -->
      </ul>
   </div>
   <div class="nav_right"></div>
   <h1 id="banner">IntoStarCraft</h1>
   <!-- Page Title -->
   <div id="content">
      <div id="left">
         <!-- Start of side box -->
         <div class="side_header">QUICK LINKS</div>
            <div class="side_content_menu">
               <ul class="list_side">
               <li><a href="#" target="_blank">Tournament Info</a></li>
               <li><a href="#">Tournament Rules</a></li>
               <li><a href="#">Register</a></li>
               <!-- Links -->
            </ul>
         </div>
         <div class="side_header">SCHEDULE</div>
         <div class="side_content_menu">
            <ul class="list_side">
               <li><a href="#" target="_blank">Text</a></li>
               <li><a href="#" target="_blank">Filler</a></li>
               <!-- Links -->
            </ul>
         </div>
         <div class="side_header">CURRENT LADDER</div>
         <div class="side_content_menu">
            <ul class="list_side">
               <li><a href="#" target="_blank">Text</a></li>
               <li><a href="#" target="_blank">Filler</a></li>
               <!-- Links -->
            </ul>
         </div>
         <!-- End box -->
      </div>
      <div id="center">
         <!-- Start of content post -->
         <div class="center_header">HOW TO REGISTER</div>
         <div class="center_content">
            <div class="center_post_img">
               <img src="../imgs/content_post_img.gif" alt="" />
            </div>
            <div class="news_post">
               <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius elementum nisl, id eleifend turpis sollicitudin quis. Etiam feugiat, arcu molestie hendrerit posuere, est neque vehicula sapien, id convallis libero urna eu nunc. Vivamus vel nulla lacus, a accumsan libero. Mauris luctus sapien interdum ipsum blandit ac luctus felis varius. Maecenas sed lectus et est mollis porta non sit amet ipsum. Cras varius nisi non justo dictum in ornare turpis varius.
                  <br />
                  <br />
                  Cras id diam pharetra quam mollis eleifend in at nibh. Maecenas quis semper quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam eget tortor eget eros imperdiet consectetur. Sed faucibus, nisi id ultrices cursus, dolor massa fermentum mauris, in gravida tellus risus quis nunc. Cras eget elit sapien. Cras adipiscing molestie blandit. Nulla vel justo quam, id vulputate tortor. Nunc ut est massa. Proin auctor, sem a condimentum euismod, nibh augue ultrices nunc, vitae egestas elit ipsum vitae sem.
               </p>
            </div>
         </div>
         <div class="heightfix"></div>
         <!-- End a content post -->
         <div class="center_header">TOURNAMENT APPLICATION FORM</div>
         <div class="center_content">
            <div class="center_post_img">
               <img src="../imgs/content_post_img.gif" alt="" />
            </div>
            <div class="news_post">
               <p>
               <b><center>This form is to be used to apply to join the tournament and be assigned a tournament-only account.</center></b>
               
                  <?php
                     include "../functions.php"
                  ?>
                  
                  <center>
                     <b>To Note</b>
                     <br />
                     1. Account name is case in-sensitive.
                     <br />
                     2. All information entered is kept private.
                     <br />
                     3. Your email address <b>must</b> be valid. It will be used for confirmation and verification.
                     <br />
                     <br />
                  </center>

                  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                     <table width="520" border="0" align="center" cellpadding="0" cellspacing="1">
                        <tr>
                           <td>
                              Main Character Name:
                           </td>
                           <td>
                              <input type="text" name="character">
                           </td>
                        </tr>
                        <tr>
                           <td>
                              Main Account Name:
                           </td>
                           <td>
                              <input type="text" name="account">
                           </td>
                        </tr>
                        <tr>
                           <td>
                              Contact Email:
                           </td>
                           <td>
                              <input type="text" name="email">
                           </td>
                        </tr>
                        <tr>
                           <td>
                              Realm:
                           </td>
                           <td>
                              <input type="radio" name="realm" value="Immortality" />Immortality (Blizzlike)<br />
                              <input type="radio" name="realm" value="Envy" />Envy (Funserver)
                           </td>
                        </tr>
                     </table>
                     <center>
                     <br />
                        <input type="submit" name="submit" value="Apply">
                     </center>
                     <br />
                  </form>

                  <?php if(isset($_POST['submit'])) { ?>

                     <table width="520" border="0" align="center" cellpadding="0" cellspacing="1">
                     
                     <?php
                        
                        $curnum = 0;
                        $t_acc_assign = 0;
                        $t_pass_assign = 0;
                        $character = $_POST['character'];
                        $account = $_POST['account'];
                        $email = $_POST['email'];
                        $realm = $_POST['realm'];
                        
                        $character = strtolower($character);
                        $account = strtoupper($account);
                        $email = strtolower($email);
                        
                        $character = mysql_real_escape_string($character);
                        $account = mysql_real_escape_string($account);
                        $email = mysql_real_escape_string($email);
                        
                        if(!$character) {
                           $curnum ++;
                           echo "<tr><td>".$curnum.". You have not entered the name of your main character.</td></tr>";
                        }
                        if(!$account) {
                           $curnum ++;
                           echo "<tr><td>".$curnum.". You have not entered your account name.</td></tr>";
                        }
                        if(!$email) {
                           $curnum ++;
                           echo "<tr><td>".$curnum.". You have not entered your email address.</td></tr>";
                        }
                        if(!$realm) {
                           $curnum ++;
                           echo "<tr><td>".$curnum.". You have not select your main realm.</td></tr>";
                        }
                        
                        if($character && $account && $realm) {
                        
                           mysql_select_db("auth") or die(mysql_error());
                           
                           $sql = "SELECT * FROM `account` WHERE `username`='$account'";
                           $res = mysql_query($sql) or die(mysql_error());
                           
                           if(mysql_num_rows($res) > 0) {
                              $accountguid = mysql_result($res, 0, 0);
                           } else {
                              $accountguid = 0;
                           }
                        
                           if($realm == 'Immortality') {
                              
                              mysql_select_db("b_char") or die(mysql_error());
                              
                              $sql2 = "SELECT * FROM `characters` WHERE `name`='$character'";
                              $res2 = mysql_query($sql2) or die(mysql_error());
                              
                              if(mysql_num_rows($res2) > 0) {
                                 $listedaccguid = mysql_result($res2, 0, 1);
                              } else {
                                 $listedaccguid = 0;
                              }
                              
                              if($listedaccguid != $accountguid) {
                                 $curnum ++;
                                 echo "<tr><td>".$curnum.". The character you listed does not exist on the account listed, for the realm specified.</td></tr>";
                              }
                           
                           } else {
                           
                              mysql_select_db("f_char") or die(mysql_error());
                              
                              $sql2 = "SELECT * FROM `characters` WHERE `name`='$character'";
                              $res2 = mysql_query($sql2) or die(mysql_error());
                              
                              if(mysql_num_rows($res2) > 0) {
                                 $listedaccguid = mysql_result($res2, 0, 1);
                              } else {
                                 $listedaccguid = 0;
                              }
                              
                              if($listedaccguid != $accountguid) {
                                 $curnum ++;
                                 echo "<tr><td>".$curnum.". The character you listed does not exist on the account listed, for the realm specified.</td></tr>";
                              }
                           
                           }
                           
                        }
                        
                        if($curnum == 0) {
                           
                           mysql_select_db("tournament") or die(mysql_error());
                           
                           $sql3 = "SELECT * FROM `base_registration` WHERE `account`='$account'";
                           $res3 = mysql_query($sql3) or die(mysql_error());
                           
                           if(mysql_num_rows($res3) > 0) {
                           
                              echo "<center>The account listed has already applied to join the tournament. We only allow players to register once for the tournament.</center>";
                              
                           }  else {
                           
                              $sql4 = "SELECT * FROM `account_pool` WHERE `inuse`='No'";
                              $res4 = mysql_query($sql4) or die(mysql_error());
                              
                              $t_acc_assign = mysql_result($res4, 0, 0);
                              $t_pass_assign = mysql_result($res4, 0, 1);
                              
                              $sql5 = "UPDATE `account_pool` SET `inuse`='Yes' WHERE `account`='$t_acc_assign'";
                              $res5 = mysql_query($sql5) or die(mysql_error());
                           
                              $sql6 = "INSERT INTO `base_registration` (`character`, `account`, `realm`, `email`) VALUES ('$character', '$account', '$realm', '$email')";
                              $res6 = mysql_query($sql6) or die(mysql_error());
                              
                              $sql7 = "INSERT INTO `char_registration` (`t_account`, `m_character`, `m_account`, `m_email`) VALUES ('$t_acc_assign', '$character', '$account', '$email')";
                              $res7 = mysql_query($sql7) or die(mysql_error());
                              
                              echo "<center>";
                              echo "Your application to join the tournament has been registered. Your tournament account info is as followed;<br /><br />";
                              echo "<b>Account name</b>: ".$t_acc_assign."<br />";
                              echo "<b>Password</b>: ".$t_pass_assign."";
                              echo "</center>";
                              
                           }
                        }
                     ?>
                     
                  <?php } ?>
               </p>
            </div>
         </div>
         <!-- End a content post -->
         <div class="center_header">CHARACTER REGISTRATION FORM</div>
         <div class="center_content">
            <div class="center_post_img">
               <img src="../imgs/content_post_img.gif" alt="" />
            </div>
            <div class="news_post">
               <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius elementum nisl, id eleifend turpis sollicitudin quis. Etiam feugiat, arcu molestie hendrerit posuere, est neque vehicula sapien, id convallis libero urna eu nunc. Vivamus vel nulla lacus, a accumsan libero. Mauris luctus sapien interdum ipsum blandit ac luctus felis varius. Maecenas sed lectus et est mollis porta non sit amet ipsum. Cras varius nisi non justo dictum in ornare turpis varius.
                  <br />
                  <br />
                  Cras id diam pharetra quam mollis eleifend in at nibh. Maecenas quis semper quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam eget tortor eget eros imperdiet consectetur. Sed faucibus, nisi id ultrices cursus, dolor massa fermentum mauris, in gravida tellus risus quis nunc. Cras eget elit sapien. Cras adipiscing molestie blandit. Nulla vel justo quam, id vulputate tortor. Nunc ut est massa. Proin auctor, sem a condimentum euismod, nibh augue ultrices nunc, vitae egestas elit ipsum vitae sem.
               </p>
            </div>
         </div>
      </div>
      <div id="right">
         <!-- Start of side box -->
         <!-- End of side box -->
         <div class="side_header">OVERALL SEED</div>
         <div class="side_content_menu">
         <br />
            <center>
               Filler Text
            </center>
         <br />
         </div>
      </div>
   </div>
   <div id="site_footer">
      Current time is:
      <?php
         echo date('d-m-Y H:i');
      ?>
   </div>
   <div id="site_footer">
      Designed by Crucius | Created by Crucius | Copyright 2010</div>
   </div>
</body>
</html>