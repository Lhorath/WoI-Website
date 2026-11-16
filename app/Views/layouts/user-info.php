<?php
global $config;
$type = isset($info_type) ? $info_type : '';
?>
<div class='right'>
    <b><a href='<?php echo $config['root_dir']; ?>account/index.php'><font size='5'>User Info</font></a></b>
    <br />
    <br />
    <div class='clr'></div>
    <?php if (getuserid()) : ?>
        <p><a href='<?php echo $config['root_dir']; ?>account/index.php'><?php echo getaccount(); ?>'s</a> last login was <?php echo get_last_login(); ?>.</p>
        <p><strong>Vote Points</strong><br />
        <a href='<?php echo $config['root_dir']; ?>account/index.php'><?php echo getaccount(); ?></a> has <a href='<?php echo $config['root_dir']; ?>vote/rewards.php'><?php echo getVotePoints(); ?> Vote Points.</a></p>
        <p><strong>Immortal Coins</strong><br />
        <a href='<?php echo $config['root_dir']; ?>account/index.php'><?php echo getaccount(); ?></a> has <a href='<?php echo $config['root_dir']; ?>donate/history.php'><?php echo getImmortalCoins(); ?> Immortal Coins.</a></p>
    <?php else : ?>
        You must log in to see user data.
    <?php endif; ?>
    <div class='clr'></div>
    <p>&nbsp;</p>
    <h2>Quick Links</h2>
    <?php if ($type === 'donate_block') : ?>
        <li><a onclick='show_alert()' href='#'>Donate</a></li>
        <li><a onclick='show_alert()' href='#'>My Donation History</a></li>
        <li><a onclick='show_alert()' href='#'>Donation Packages</a></li>
    <?php else : ?>
        <li><a href='<?php echo $config['root_dir']; ?>account/index.php'>User Control Panel</a></li>
        <li><a href='<?php echo $config['root_dir']; ?>vote/index.php'>Vote For Us</a></li>
        <li><a href='<?php echo $config['root_dir']; ?>vote/rewards.php'>Vote Rewards</a></li>
        <li><a href='<?php echo $config['root_dir']; ?>donate/index.php'>Donate</a></li>
        <li><a href='<?php echo $config['root_dir']; ?>donate/packages.php'>Donation Packages</a></li>
    <?php endif; ?>
    <br />
    <h2>Important Reminders</h2>
    <p>
        <strong>Account Security</strong><br />
        Remember, you are responsible for anything that happens on your account. NEVER give anyone your password. <br /><br />World of Immortality staff will not ask for your password for any reason. <br /><br />
    </p>
    <p>
        <strong>Donation Reminder</strong><br />
        Remember, you can use the Character Wishlist in the Donation Panel to customize a donation package even if you haven't donated yet.<br /><br /><br />
    </p>
</div>