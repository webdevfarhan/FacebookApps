<?php
include 'AppsData.php';

$appname = $_GET['app'];
$id = $_GET['id']; 
for($i=0; $i<count($data); $i++)
{
	$temp = $data[$i][2];
	if (preg_match("/app=$appname/",$temp))
	{
		$title = $data[$i][0];
		$image = $data[$i][1];
	}
}

if($appname == "wiki")
$last = "$id.png";
else
$last = "$id.jpg";

$image = "dump/$appname/$last";
list($width, $height) = getimagesize($image);
?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<!-- Twitter -->
		<meta name="twitter:card" content="photo">
		<meta name="twitter:title" content="<?=$title?>" />
		<meta name="twitter:description" content="Wow! It's Awesome!" />
		<meta name="twitter:image:src" content="http://<?=$url?>/dump/<?=$appname?>/<?=$last?>" />
		<meta name="twitter:image:width" content="<?=$width?>" />
		<meta name="twitter:image:height" content="<?=$height?>" />

	</head>

	<body>
		<script type='text/javascript'>
			top.location.href = "http://<?=$url?>/login.php?app=<?=$appname?>&rtn=1";
		</script>
	</body>