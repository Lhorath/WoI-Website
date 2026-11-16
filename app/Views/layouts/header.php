<?php global $config; $extraInfo = isset($extra_info) ? $extra_info : ''; ?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<title>World of Immortality | The best in Private Server Emulation</title>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<link href='<?php echo $config['css_dir']; ?>style.css' rel='stylesheet' type='text/css' />
<script type='text/javascript' src='<?php echo $config['js_dir']; ?>swfobject.js'></script>
<script type='text/javascript' src='<?php echo $config['js_dir']; ?>woi.js'></script>
<?php echo $extraInfo; ?>
</head>
<body>
<div align='right'><?php echo send_login(); ?>&nbsp;&nbsp;&nbsp;</div>
<br />