<?php 
$source_file = $_GET['img'];

$im = ImageCreateFromJpeg($source_file); 

$imgw = imagesx($im);
$imgh = imagesy($im);

for ($i=0; $i<$imgw; $i++)
{
    for ($j=0; $j<$imgh; $j++)
    {
        $rgb = ImageColorAt($im, $i, $j); 
        $rr = ($rgb >> 16) & 0xFF;
        $gg = ($rgb >> 8) & 0xFF;
        $bb = $rgb & 0xFF;
        $g = round(($rr + $gg + $bb) / 3);
        $val = imagecolorallocate($im, $g, $g, $g);
        imagesetpixel ($im, $i, $j, $val);
    }
}

header('Content-type: image/jpeg');
imagejpeg($im);
?>