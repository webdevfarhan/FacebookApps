<?php
  $id = '102817873641824';
  $name = 'Tom';
  $sex = 'm';
  $appname = 'without';
  $blank = @imagecreatetruecolor(800, 420);
 	$random = rand(1, 8);
	$src = @imagecreatefrompng("images/$appname/".$sex.$random.".png") or die('Cannot Initialize new GD image stream');
	$resurl = "https://graph.facebook.com/".$id."/picture?width=480&height=480";
	$dest1 = imagecreatefromstring(file_get_contents($resurl));
	$dest = @imagecreatetruecolor(420, 420);
header('Content-Type: image/gif');
echo imagejpeg($dest);
echo imagejpeg($dest1);
echo "<br />";
echo "dest = $dest <br> and dest1 = $dest1;"
/*
	imagecopyresized($dest, $dest1, 0, 0, 0, 0, 420, 420, 480, 480);
	imagealphablending($src, false);
	imagesavealpha($src, true);
	imagecopyresampled($blank, $dest, 0, 0, 0, 0, 420, 420, 420, 420);
	imagecopyresampled($blank, $src, 0, 0, 0, 0, 800, 420, 800, 420);
	$black = imagecolorallocate($blank, 0, 0, 0);
	$font = "fonts/Tahoma.ttf";
	imagettftext($blank, 38, 0, 430, 80, $black, $font, $name);
	$file_name = "/var/www/$url/dump/$appname/$id.jpg";
	imagejpeg($blank, $file_name, 90);
	imagedestroy($blank);
*/
?>