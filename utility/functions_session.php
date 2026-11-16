<?php

/**
 * @author megosh
 * @copyright 2010
 */
 
require_once ('header.php');
    
function setaccount($account)
{
    $_SESSION['account_name'] = serialize($account);
}

function setuserid($id)
{
    $_SESSION['account_id'] = serialize($id);
}

function setgmlevel($gmlevel)
{
    $_SESSION['gmlevel'] = serialize($gmlevel);
}

function setcharname($char)
{
    $_SESSION['char_name'] = serialize($char);
}

function setcharguid($guid)
{
    $_SESSION['char_guid'] = serialize($guid);
}

function setchardb($db)
{
    $_SESSION['chardb'] = serialize($db);
}

function getchardb()
{
    if (isset($_SESSION['chardb']))
    {
        return unserialize($_SESSION['chardb']);
    }
    return $config['blizz_char_db'];
}

function getcharguid()
{
    if (isset($_SESSION['char_guid']))
    {
        return unserialize($_SESSION['char_guid']);
    }
    return false;
}

function getcharname()
{
    if (isset($_SESSION['char_name']))
    {
        return ucwords(strtolower(unserialize($_SESSION['char_name'])));
    }
    return "None...";
}

function getgmlevel()
{
    if (isset($_SESSION['gmlevel']))
    {
        return unserialize($_SESSION['gmlevel']);
    }
    return false;
}

function getuserid()
{
    if (isset($_SESSION['account_id']))
    {
        return unserialize($_SESSION['account_id']);
    }
    return false;
}

function getaccount()
{
    if (isset($_SESSION['account_name']))
    {
        return ucwords(strtolower(unserialize($_SESSION['account_name'])));
    }
    return false;
}

function ischaronacct($guid)
{
    global $config;
    $guid = intval($guid);
    $qry = "SELECT `guid`, `name` FROM `characters` WHERE `guid`='".$guid."' AND `account` = '".getuserid()."'";
    $d = new db(getchardb());
    $data = $d->fetch($qry);
    if ($data)
    {
        foreach($data as $row)
        {
            setcharname($row['name']);
            setcharguid($row['guid']);
        }
        return true;
    }
    else
        return false;
}

function getVotePoints()
{
    global $config;
    $d = new db($config['realm_db']);
    $data = $d->fetch("SELECT `points` FROM `voting_points` WHERE `id` = '".getuserid()."'");
    if ($data)
        foreach($data as $row)
            $points = $row["points"];
    else
        $points = 0;
    return $points;
}

function getImmortalCoins()
{
    global $config;
    $d = new db($config['realm_db']);
    $data = $d->fetch("SELECT `coins` FROM `donation_coins` WHERE `id` = '".getuserid()."'");
    if ($data)
        foreach($data as $row)
            $coins = $row["coins"];
    else
        $coins = 0;
    return $coins;
}

function get_last_login()
{
    global $config;
    $d = new db($config['realm_db']);
    $data = $d->fetchCell("SELECT last_login FROM account WHERE id = ".getuserid());
    if ($data)
        return $data;
    else
        return "N/A";
}

function log_in($username, $password, $colour = 'white')
{
    global $config;
    
    $user_pass = strtoupper(sha_password($username, $password));
    $username = mysql_escape_string($username);
    
    $qry = "SELECT account.id,username,sha_pass_hash,account_access.gmlevel FROM account LEFT JOIN account_access ON account.id = account_access.id WHERE username = '$username' && sha_pass_hash = '$user_pass'";
    $d = new db($config['realm_db']);
    $data = $d->fetch($qry);
    if (!$data)
        return "<font face='verdana, arial' size='2' color='".$colour."'>Unable to authenticate. Check username and/or password<br></font>".back("<u><font color='".$colour."' size='4'>Try again</font></u>");
    else
    {
        foreach($data as $row)
        {
            setuserid($row['id']);
            setaccount($username);
            setgmlevel($row['gmlevel']);
            setchardb($config['blizz_char_db']);
            $_SESSION['logged_in'] = 1;
            mysql_close();
            if ($row['gmlevel'] > 0)
                $extra = " <a href='".GetRootDir().$config['main_dir']."gm/index.php'><font color='".$colour."'>GM Tools</font></a> | ";
            return "<font face='verdana, arial' size='2' color='".$colour."'>Authenticaiton successful.&nbsp;&nbsp;&nbsp;<br>Welcome back, ".getaccount()." | ".$extra."</font>".logout_text("<u><font color='".$colour."' >Logout</font></u>");
        }
    }
}
    
function send_login($colour = 'white')
{
    if (isset($_POST['login_submit']) || isset($_SESSION['logged_in']))
    {
        if (!isset($_SESSION['logged_in']))
            return log_in($_POST['username'], $_POST['password'], $colour);
        else
        {
            if (getgmlevel() > 0)
                $extra = " <a href='".GetRootDir().$config['main_dir']."gm/index.php'><font color='".$colour."' >GM Tools</font></a> | ";
            return "<font face='verdana, arial' size='2' color='".$colour."'>Welcome back, ".getaccount()." | ".$extra."</font>".logout_text("<font color='".$colour."' >Logout</font>");
        }
            
    }
    else
    {
        return '<form action="'.basename($_SERVER['PHP_SELF']).'" method="POST" enctype="multipart/form-data">
            <font face="verdana, arial" size="2" color="'.$colour.'">
            <table>
            <tr>
                <td>Username:
                <input type="text" name="username" onclick="this.value=\'\';" onfocus="this.select()" onblur="this.value=!this.value?\'Username\':this.value;" value="Username" size="12"/></td>
            
                <td>Password:
                <input type="password" name="password" onclick="this.value=\'\';" onfocus="this.select()" onblur="this.value=!this.value?\'Password\':this.value;" value="password" size="12" onclick="clear"/></td>

                <td>
                    <div align="right"><input type="submit" name="login_submit" value="Login"/></div>
                </td>
            </tr>
        </table>
        </font>
        </form>';
    }
}
//<font face='verdana, arial' size='2' color='white'>Welcome back, <u>Serophis</u>. | <u>My Account</u> | <u>Log Out</u>&nbsp;&nbsp;&nbsp; </font>

//<input type="text" name="field-name-here" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Username':this.value;" value="Enter Email To Get Updates" />
/*function show_logout()
{
    if (isset($_SESSION['logged_in']))
    {
        if (isset($_POST["logout"]))
        {
            if (isset($_POST["logout"]))
                session_destroy();
            echo "<meta http-equiv=refresh content='0;url=".basename($_SERVER['PHP_SELF'])."'>";
            die();
        }
        else
        {
            echo "<form align=RIGHT method='POST'>
                <input type='submit' name='logout' value='Logout'>
                </form>";
        }
    }
}*/
 
function logout_text($text = "Logout")
{
    if (isset($_SESSION['logged_in']))
    {
        return "<a href='".GetRootDir().$config['main_dir']."logout.php'><u>".$text."</u></a>";
    }
}
?>