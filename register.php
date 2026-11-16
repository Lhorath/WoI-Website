<?php
include_once("includes.php");

$structure = new Structure;

$structure->Header();

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu('register');

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Account Creation</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left">
                        <?php
                        if ($_POST['username'] || isset($_POST['username']))
                        {
                            $privatekey = "6LdeUQoAAAAAAMkOOv_A554ayz6kcxIRvtDAHFQq";
                            $resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
                            if (!$resp->is_valid)
                                echo "Captcha wasn't entered correctly. Go back and try it again.";
                            else
                            {
                                $email = htmlspecialchars(trim($_POST['email']));
                                $conf_email = htmlspecialchars(trim($_POST['confemail']));
                                register($_POST['username'], $_POST['password'], $_POST['confpassword'], $email, $conf_email);
                            }
                        }
                        else
                        {
                        ?>
                        <br />
                        <br />
                        <br />
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <table width="50%" align="center" border="0">
                                <tr>
                                    <td>
                                        Username: 
                                    </td>
                                    <td>
                                        <input type="text" name="username" />
                                </tr>
                                <tr>
                                    <td>
                                        Password: 
                                    </td>
                                    <td>
                                        <input type="password" name="password" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Confirm Password: 
                                    </td>
                                    <td>
                                        <input type="password" name="confpassword" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email: 
                                    </td>
                                    <td>
                                        <input type="text" name="email" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Confirm Email: 
                                    </td>
                                    <td>
                                        <input type="text" name="confemail" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <?php
                                            $publickey = "6LdeUQoAAAAAACKHlTSR_-RUV44y9dBrDaiKVQxw"; 
                                            echo recaptcha_get_html($publickey);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <input class='button'  
                                         style="WIDTH: 168px; HEIGHT: 39px" tabIndex=5 type=image 
                                         alt="submit" src="<?php echo $config['img_dir']; ?>create_en.gif" 
                                         value="registration" name="registration" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <?php
                        }
                        ?>
                        <br />
                        <br />
                        <center><p>By registring you agree to our <a href="tos.php">terms of service</a>.</p></center>
                    </div>
                    <div class="right">
                         <p><span><font size="2"><b>Reminder:</b></font> </span>We currently run on World of Warcraft version 3.3.5a.  If you do not have this version, you will be unable to access our server.</p>
						<br /><br />
						<p><span><font size="2" color="#ff0000"><b>Warning:</b></font> </span>For security reasons, we ask that you do NOT use the same username/password on this server as you do for your retail account, or for other servers.</p><br /><br /><br /><br />
                    
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>