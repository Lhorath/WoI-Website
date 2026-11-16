<?php
global $config;
$page = isset($active_page) ? $active_page : '';
$pageIndex = array('index'=>'','connect'=>'','register'=>'','vp'=>'','donate'=>'','ucp'=>'');
if (isset($pageIndex[$page])) { $pageIndex[$page] = "class='active'"; }
?>
<div class='main'>
<div class='blok_header'><div class='header'><div class='logo'>
<a href='index.php'><img src='<?php echo $config['img_dir']; ?>toplogo.png' width='169' height='99' border='0' alt='logo' /></a>
</div><div class='menu'><ul>
<li><a href='<?php echo $config['root_dir']; ?>index.php' <?php echo $pageIndex['index']; ?>><span>Home</span></a></li>
<li><a href='<?php echo $config['root_dir']; ?>connect.php' <?php echo $pageIndex['connect']; ?>><span>Connection Guide</span></a></li>
<li><a href='<?php echo $config['root_dir']; ?>register.php' <?php echo $pageIndex['register']; ?>><span>Create Account</span></a></li>
<li><a href='<?php echo $config['root_dir']; ?>forums/'><span>Community Forums</span></a></li>
<li><a href='<?php echo $config['root_dir']; ?>vote/index.php' <?php echo $pageIndex['vp']; ?>><span>Vote for Us</span></a></li>
<li><a href='<?php echo $config['root_dir']; ?>donate/index.php' <?php echo $pageIndex['donate']; ?>><span>Donation Panel</span></a></li>
<li><a href='<?php echo $config['root_dir']; ?>account/index.php' <?php echo $pageIndex['ucp']; ?>><span>Player Tools</span></a></li>
</ul><div class='clr'></div></div><div class='clr'></div></div><div class='clr'></div></div><div class='clr'></div>