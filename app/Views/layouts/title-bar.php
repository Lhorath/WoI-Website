<?php
$titleText = isset($title_text) ? $title_text : '';
$titleType = isset($title_type) ? $title_type : '';
if ($titleType === 'front_page') :
?>
<div class='header_text_bg'><div class='header_text'><h2>
<font size='5' color='white'>World of Immortality </font><font color='gray' size='5'>| </font><font size='4'>Setting a new standard for private server emulation.</font><br /><span></span>
</h2><div class='clr'></div></div><div class='cu3er_resize'><div id='cu3er-container'>
<a href='http://www.adobe.com/go/getflashplayer'> <img src='http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>
</div></div><div class='clr'></div></div>
<?php else : ?>
<div class='header_text_bg2'><div class='header_text2'><?php echo $titleText; ?><div class='clr'></div></div><div class='clr'></div></div>
<?php endif; ?>