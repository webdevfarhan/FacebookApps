<?php
session_start();
include("pleasewait.php");
include 'AppsData.php';
include("Facebook/dataconfig.php");
include("Facebook/imageclass.php");
$dataNew = $data;
date_default_timezone_set('Asia/Kolkata');
require_once __DIR__. '/Facebook/autoload.php';    
require_once __DIR__. '/Facebook/vendor/autoload.php';
use Facebook\FacebookRequest;

$white = imagecolorallocate($im, 255, 255, 255);

function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}
function generateRandomString($length = 3) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$appname = $_GET['app'];
if(isset($_GET['error']))
{
	if($_GET['error'] == "access_denied")
	redirect_page("http://$url/login.php?app=$appname&error=access_denied");
}
/*
include("Facebook/geoip.inc");
		$ip=$_SERVER['REMOTE_ADDR'];
		$gi = geoip_open("Facebook/GeoIP.dat",GEOIP_STANDARD);
		$ctry = geoip_country_code_by_addr($gi, "$ip");
		geoip_close($gi);
*/		

$fb = new Facebook\Facebook([
  'app_id' => $app,
  'app_secret' => $secret,
  'default_graph_version' => 'v2.8',
]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

function RandomLine($filename) { 
    $lines = file($filename) ; 
    return $lines[array_rand($lines)] ; 
} 

if (isset($accessToken))
{
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;
$token =$accessToken;
  $fb->setDefaultAccessToken($accessToken);
	  
  try
   {
	  $response = $fb->get('/me?fields=id,name,gender,first_name', "$token");
	  $userNode = $response->getGraphUser();
	  $id = $user_id = $userNode["id"];
	  $name = $FullName = $userNode["name"];
	  $FirstName = $userNode["first_name"];
	  $Gender = $gender = $userNode["gender"];
	  $sex = ($Gender == "male") ? "m" : "f";
    $response = $fb->get('/me/permissions', "$token");
	  $graphEdge = $response->getGraphEdge();
		
		foreach ($graphEdge as $graphNode) 
		{
			$results = json_decode($graphNode, true);  
		  if($results['permission'] == 'user_posts')
			{
				if($results['status'] == 'granted')
					$granted = 1;
			}
		}
   }
  catch(Facebook\Exceptions\FacebookResponseException $e)
   {
	error_log($e, 0);
	  exit;
   }
  catch(Facebook\Exceptions\FacebookSDKException $e)
   {
	error_log($e, 0);
	  exit;
   }

if($appname == "chatter")
{
		if($granted != 1)
		redirect_page("http://$url/login.php?app=$appname&error=access_denied");
		function copyImage($im, $var, $x1, $y1)
		{
	    $white = imagecolorallocate($im, 255, 255, 255);
	    $grey = imagecolorallocate($im, 147, 147, 147);
    	$black = imagecolorallocate($im, 10, 10, 10);
			$exp=imagecolorallocate($im, 34, 0, 255);
			$red= imagecolorallocate($im, 255, 0, 0);
    	$dp1 = imagecreatefromjpeg($var);
    	list($w1, $h1) = getimagesize($var);
    	$imx = imagecreatefrompng("images/shadow.png");
    	if($h1 > 200) $h1 = 200;
    	//imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
    	imagecopyresampled($im, $imx, ($x1) + 2, ($y1) + 2, 0, 0, $w1 + 6, $h1 + 6, 1, 1);
    	imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    	imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);
		} 
	
	$getPostsLikes = $fb->get('/me/posts?fields=likes.limit(1000){name,id}&limit=30', "$token");
	$getPostsLikes = $getPostsLikes->getGraphEdge()->asArray();
	foreach ($getPostsLikes as $key) 
{
	if (isset($key['likes'])) 
	{			
		foreach ($key['likes'] as $key) 
		{
			$idsarray[] = $key['id'];
			$namesarray[] = $key['name'];
		}
	}
}

	$Counter = array_count_values($idsarray);
	arsort($Counter);
	$namesarray = '';
	
	
	foreach($Counter as $ID=>$idcount)		
	{
		$ids[] = $ID;
		foreach ($getPostsLikes as $key) 
		{
		if (isset($key['likes'])) 
		{			
			foreach ($key['likes'] as $key) 
			{
				if($key['id'] == $ID)
				{
					$Final[$ID] = $key['name'];
				}
					
			}
		}
		}
	}
	
	foreach($Final as $ID=>$idcount)		
	{
		for($i=0; $i<count($ids); $i++)
		{
			if($ids[$i] == $ID)
				$finalnames[] = $Final[$ID];
		}
	}
	$ff = $finalnames;
	$finalnames = '';
	foreach($ff as $names)
	{
		$explode = explode(" ", $names);
		$finalnames[] = $explode[0];
	}
	$friendDP1 = "http://graph.facebook.com/$ids[0]/picture?type=normal&height=100&width=100";
	$friendDP2 = "http://graph.facebook.com/$ids[1]/picture?type=normal&height=100&width=100";
	$friendDP3 = "http://graph.facebook.com/$ids[2]/picture?type=normal&height=100&width=100";
	$friendDP4 = "http://graph.facebook.com/$ids[3]/picture?type=normal&height=100&width=100";
	$friendDP5 = "http://graph.facebook.com/$ids[4]/picture?type=normal&height=100&width=100";
	$friendDP6 = "http://graph.facebook.com/$ids[5]/picture?type=normal&height=100&width=100";
	$im = @imagecreatefromjpeg("images/chatter/chatterfinal.jpg") or die("cant create image");
 	$dp = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=140&width=140";
  copyImage($im, $friendDP1,20, 139);
	copyImage($im, $friendDP2,20, 274);
	copyImage($im, $friendDP3,20, 416);
	copyImage($im, $friendDP4,342, 139);
	copyImage($im, $friendDP5,342, 274);
	copyImage($im, $friendDP6,342, 416);
	$white = imagecolorallocate($im, 255, 255, 255);
	imagettftext( $im, 20, 0, 165, 98, $white, 'fonts/arial.ttf', "$FirstName, Your Top 6 Chatters are :");
	imagettftext( $im, 20, 0, 130, 164, $white, 'fonts/arial.ttf', $finalnames[0]); 
	imagettftext( $im, 20, 0, 130, 297, $white, 'fonts/arial.ttf', $finalnames[1]); 
	imagettftext( $im, 20, 0, 130, 441, $white, 'fonts/arial.ttf', $finalnames[2]); 
	imagettftext( $im, 20, 0, 457, 164, $white, 'fonts/arial.ttf', $finalnames[3]); 
	imagettftext( $im, 20, 0, 457, 297, $white, 'fonts/arial.ttf', $finalnames[4]); 
	imagettftext( $im, 20, 0, 457, 441, $white, 'fonts/arial.ttf', $finalnames[5]); 
	$RandomNumbers = UniqueRandomNumbersWithinRange(30000,95000,6);
	imagettftext( $im, 20, 0, 130, 195, $white, 'fonts/arial.ttf', $RandomNumbers[0]); 
	imagettftext( $im, 20, 0, 130, 328, $white, 'fonts/arial.ttf', $RandomNumbers[1]); 
	imagettftext( $im, 20, 0, 130, 472, $white, 'fonts/arial.ttf', $RandomNumbers[2]); 
	imagettftext( $im, 20, 0, 457, 195, $white, 'fonts/arial.ttf', $RandomNumbers[3]); 
	imagettftext( $im, 20, 0, 457, 328, $white, 'fonts/arial.ttf', $RandomNumbers[4]); 
	imagettftext( $im, 20, 0, 457, 472, $white, 'fonts/arial.ttf', $RandomNumbers[5]); 
	imagettftext( $im, 20, 0, 130, 226, $white, 'fonts/arial.ttf', "Messages");
	imagettftext( $im, 20, 0, 130, 359, $white, 'fonts/arial.ttf', "Messages");
	imagettftext( $im, 20, 0, 130, 503, $white, 'fonts/arial.ttf', "Messages");
	imagettftext( $im, 20, 0, 457, 226, $white, 'fonts/arial.ttf', "Messages");
	imagettftext( $im, 20, 0, 457, 359, $white, 'fonts/arial.ttf', "Messages");
	imagettftext( $im, 20, 0, 457, 503, $white, 'fonts/arial.ttf', "Messages");
	
	$file_name = "dump/chatter/$id.jpg";
	imagejpeg($im, $file_name, 90);
	imagedestroy($im);
	
}
	
	if($appname == "pakkadost1")
{
	if($granted != 1)
		redirect_page("http://$url/login.php?app=$appname&error=access_denied");
	function copyImage($im, $var, $x1, $y1)
{
    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
$exp=imagecolorallocate($im, 34, 0, 255);
$red= imagecolorallocate($im, 255, 0, 0);
    $dp1 = imagecreatefromjpeg($var);
    list($w1, $h1) = getimagesize($var);
    $imx = imagecreatefrompng("images/shadow.png");
    if($h1 > 200) $h1 = 200;
    //imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
    imagecopyresampled($im, $imx, ($x1) + 2, ($y1) + 2, 0, 0, $w1 + 6, $h1 + 6, 1, 1);
    imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);

}
	
    $response = $fb->get('me/feed?fields=from&with=', "$token");
	  $graphEdge = $response->getGraphEdge();
	 
		foreach ($graphEdge as $graphNode) 
		{
			$results = json_decode($graphNode);
			if($results->from->id != $id)
			{
				$idsarray[] = $results->from->id;
				$namesarray[] = $results->from->name;	
			}
			
		}
	
	$Counter = array_count_values($idsarray);
	$current = 0;
	
	for($i=0; $i<count($idsarray); $i++)
	{
		$temp = $idsarray[$i];
		$CounterIDS = $Counter[$temp];
		if($current < $CounterIDS)
		{
			$current = $CounterIDS;
			$bigID = $temp;
		}
		
	}
 
	$FriendID = $bigID;
		foreach ($graphEdge as $graphNode) 
		{
			$results = json_decode($graphNode);    
			if($results->from->id == $FriendID)
				 $FullName = $results->from->name;
		}
			
		   $FriendFName = explode(" ", $FullName); 
		   $FriendFName = $FriendFName[0]; 
		   $friendDP = "http://graph.facebook.com/$FriendID/picture?type=normal&height=140&width=140";
		 
		   $im = @imagecreatefromjpeg("images/pakkadost/friendsenbg.jpg") or die("cant create image");
 			 $dp = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=140&width=140";

   		 copyImage($im, $friendDP, 555, 130);
   		 copyImage($im, $dp, 100, 135);
			 $white = imagecolorallocate($im, 255, 255, 255);
		   imagettftext( $im, 25, 0, 110, 320, $white, 'fonts/JandaCurlygirlChunky.ttf', $FirstName);    
		   imagettftext( $im, 25, 0, 550, 320, $white, 'fonts/JandaCurlygirlChunky.ttf', $FriendFName);    
		  
			$file_name = "dump/pakkadost1/$id.jpg";
			imagejpeg($im, $file_name, 90);
			imagedestroy($im);

}	
	
if($appname == "words1")
{
	if($granted != 1)
		redirect_page("http://$url/login.php?app=$appname&error=access_denied");
	function copyImage1($im, $var, $x1, $y1){
    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
$exp=imagecolorallocate($im, 34, 0, 255);
$red= imagecolorallocate($im, 255, 0, 0);
    $dp1 = imagecreatefromjpeg($var);
    list($w1, $h1) = getimagesize($var);
    $imx = imagecreatefrompng("images/shadow.png");
    if($h1 > 200) $h1 = 200;
    //imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
    imagecopyresampled($im, $imx, ($x1) + 2, ($y1) + 2, 0, 0, $w1 + 6, $h1 + 6, 1, 1);
    imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);

}
	
	$response = $fb->get('/me/posts?limit=100', "$token");
	  $graphEdge = $response->getGraphEdge();
	  
	 
	foreach ($graphEdge as $graphNode) 
	{
			$results = json_decode($graphNode, true);    
			if($results['message'] != "")
			{
				$status = $results['message'];
				$words = explode(" ", $status);
				for($i=0; $i<count($words); $i++)
				{
					if($words[$i] != "a" || $words[$i] != "i" || $words[$i] != "you" || $words[$i] != "A" || $words[$i] != "I" || $words[$i] != "You" || $words[$i] != "the" || $words[$i] != "The" || $words[$i] != "there" || $words[$i] != "There" || $words[$i] != "their" || $words[$i] != "Their")
					$wordsarray[] = $words[$i];
				}
			}
	}
	$Counter = array_count_values($wordsarray);
	$Counter = array_values($Counter);
	$current = 0;
	
	
	for($i=0; $i<count($Counter); $i++)
	{
		if($current < $Counter[$i])
		{
			$current = $Counter[$i];
			$index = $i;
		}
		
	}
	$Word = $wordsarray[$index];
	$im = @imagecreatefromjpeg("images/words/wordsenbg.jpg") or die("cant create image");
	$white = imagecolorallocate($im, 255, 255, 255);
	
	
	if(strlen($Word) < 6)
	imagettftext( $im, 40, 0, 325, 275, $white, 'fonts/JandaCurlygirlChunky.ttf', $Word);      
	if(strlen($Word) > 6)
	imagettftext( $im, 40, 0, 260, 275, $white, 'fonts/JandaCurlygirlChunky.ttf', $Word);      
	$dp = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=150&width=150";
	copyImage1($im, $dp, 320, 45);
	$file_name = "dump/words1/$id.jpg";
	imagejpeg($im, $file_name, 90);
	imagedestroy($im);
}	

if($appname == "name")
{
	$myname = $FirstName;
	$namee = strtolower($myname);
	$arr = str_split($namee);
	$dp1_name = $fb->get('/me/picture?redirect=false&type=normal&height=150&width=150');
	// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";
	$v=array(		
	'a'=>array(1=>"Awesome",2=>"Adorable",3=>"Amazing",4=>"Awful"),
	'b'=>array(1=>"Brave",2=>"Brainy",3=>"Best",4=>"Busy"),
	'c'=>array(1=>"Cheerful",2=>"Clean",3=>"Charming",4=>"Crazy"),
	'd'=>array(1=>"Dangerous",2=>"Delightful",3=>"Determine",4=>"Distinct"),
	'e'=>array(1=>"Elite",2=>"Eligant",3=>"Evil",4=>"Excited"),
	'f'=>array(1=>"Faithful",2=>"Famous",3=>"Fancy",4=>"Friendly"),
	'g'=>array(1=>"Gentle",2=>"Gifted",3=>"Glorious",4=>"Gleaming"),
	'h'=>array(1=>"Hungry",2=>"Hilarious",3=>"Happy",4=>"Helping"),
	'i'=>array(1=>"Interesting",2=>"Innocent",3=>"Important",4=>"Intelligent"),
	'j'=>array(1=>"Joyous",2=>"Jolly",3=>"Jumbled",4=>"Juicy"),
	'k'=>array(1=>"Kind",2=>"Keen",3=>"Known",4=>"Kindheart"),
	'l'=>array(1=>"Lucky",2=>"Lovely",3=>"Lethal",4=>"Likeable"),
	'm'=>array(1=>"Mad",2=>"Magical",3=>"Majestic",4=>"Mature"),
	'n'=>array(1=>"Nerd",2=>"Nice",3=>"Nutty",4=>"Naughty"),
	'o'=>array(1=>"Odd",2=>"Open",3=>"Outrageous",4=>"Obedient"),
	'p'=>array(1=>"Pleasant",2=>"Peaceful",3=>"Perfect",4=>"Pricky"),
	'q'=>array(1=>"Quick",2=>"Quiet",3=>"Questionable",4=>"Quaint"),
	'r'=>array(1=>"Rare",2=>"Rebel",3=>"Rich",4=>"Romantic"),
	's'=>array(1=>"Shiny",2=>"Silly",3=>"Shy",4=>"Sleepy"),
	't'=>array(1=>"Typical",2=>"Trustful",3=>"Tricky",4=>"Terrific"),
	'u'=>array(1=>"Unusual",2=>"Unused",3=>"Ultimate",4=>"Unique"),
	'v'=>array(1=>"Vague",2=>"Vast",3=>"Vulgar",4=>"Volatile"),
	'w'=>array(1=>"Wacky",2=>"Wise",3=>"Wicked",4=>"Worthful"),
	'x'=>array(1=>"X-rated",2=>"Xerox",3=>"X-treme",4=>"X-treme"),
	'y'=>array(1=>"Young",2=>"Youthful",3=>"Yummy",4=>"Yielding"),
	'z'=>array(1=>"Zealous",2=>"Zany",3=>"Zippy",4=>"Zombie")
	);
	$canvas = imagecreatefromjpeg ("images/name/namebg.jpg");                                   
	$black = imagecolorallocate( $canvas, 0, 0, 0 );
	$cyan = imagecolorallocate( $canvas, 0, 255, 255 );                       
	$font = "fonts/arial.ttf";
	$fontt = "fonts/FOO.ttf"; 
	$rect = imagettfbbox(100, 0, $fontt, $myname);
	$mx = $rect[2] - $rect[0];
	$mxx = imagesx($canvas);
	$x = (1/2) * ($mxx - $mx - 20);
	$o = 0;
	foreach ($arr as $a) 
	{
		$o++;
	}
	if($o <= 7)
	{
		$fontsize1 = 50;
		$fontsize2 = 10;
		$x = $x+10;
		$space = 85;
	}
	else
	{
	
		$fontsize1 = 60;
		$fontsize2 = 10;
		$x = $x+35;
		$space = 65;
	}
	foreach ($arr as $a) 
	{
	$r = mt_rand(1,4);
	$n = strtoupper($a);
	$adj = $v[$a][$r];
	$wordarray[] = $adj;
	imagettftext( $canvas, $fontsize1, 0, $x, 120, $black, $fontt, $n ); 
	imagettftext( $canvas, $fontsize2, 0, $x, 140, $black, $font, $adj );
	$x = $x + $space;
	}
	
	$file_name = "dump/name/".$user_id.".jpg";
	imagejpeg( $canvas, "dump/name/".$user_id.".jpg", 100 );
	imagedestroy($canvas);

}

if($appname == "wiki")
{
	$myname = $FullName;
	function copyImage($im, $pngimg, $x1, $y1, $dp1_name){

    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
$exp=imagecolorallocate($im, 34, 0, 255);
$red= imagecolorallocate($im, 255, 0, 0);
    list($w1, $h1) = getimagesize($dp1_name);
    $imx = imagecreatefrompng("images/shadow.png");
    if($h1 > 200) $h1 = 200;
    imagecopy($im, $pngimg, $x1, $y1, 0, 0, $w1, $h1);
}

$mlist = array(1,2,3,4) ;
$flist = array(5,6,7,8,9);
if($sex == "m")
{
	$randomn = $mlist[mt_rand(0, count($mlist)-1)];
	$person = "Man :";	
}	
else
{
	$randomn = $flist[mt_rand(0, count($flist)-1)]; 
	$person = "Woman :";	
}	
	
if($randomn == 1)
$type = "Ambitious";
else if($randomn == 2)
$type = "Warrior";
else if($randomn == 3)
$type = "Wise";
else if($randomn == 4)
$type = "Fighter";
else if($randomn == 5)
$type = "Strong";
else if($randomn == 6)
$type = "Intelligent";
else if($randomn == 7)
$type = "Independent";
else if($randomn == 8)
$type = "Brave";
else if($randomn == 9)
$type = "Beautiful";

$im = imagecreatefrompng("images/wiki/$randomn.png");
$dp1_name = "http://graph.facebook.com/$user_id/picture?type=normal&height=130&width=150";
$stringimg = imagecreatefromstring(file_get_contents($dp1_name));
$dp1 = imagepng($stringimg, "dump/wiki/".$user_id."_pic.png");
$pngimg = imagecreatefrompng("dump/wiki/".$user_id."_pic.png");
copyImage($im, $pngimg, 11.5, 45, $dp1_name);
$namefont = "fonts/arial.ttf";    
imagettftext( $im, 25, 0, 200, 100, $asd, $namefont, $myname );            
imagettftext( $im, 12, 0, 25, 234, $asd, $namefont, "Gender :");            
imagettftext( $im, 12, 0, 90, 234, $asd, $namefont, ucfirst($Gender));
imagettftext( $im, 12, 0, 25, 270, $asd, $namefont, "Type of $person");
imagettftext( $im, 12, 0, 200, 130, $asd, $namefont, $desc);      
imagettftext( $im, 12, 0, 50, 295, $asd, $namefont, $type);
$file_name = "dump/wiki/".$user_id.".png";
imagepng( $im, "dump/wiki/".$user_id.".png", 5);
imagedestroy($im);
unlink("dump/wiki/".$user_id."_pic.png");


}

if($appname == "celebmarry")
{
	
	$myname = $FirstName;
	$sex = ($Gender == "male") ? "f" : "m";
$dp1_name = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=110&width=110";
$sidepic = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=40&width=40";
$im = imagecreatefromjpeg("images/celebmarry/bg.jpg");

function copyImage($im, $var, $x1, $y1){
    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
$exp=imagecolorallocate($im, 34, 0, 255);
$red= imagecolorallocate($im, 255, 0, 0);
    $dp1 = imagecreatefromjpeg($var);
    list($w1, $h1) = getimagesize($var);
    $imx = imagecreatefrompng("images/shadow.png");
    if($h1 > 200) $h1 = 200;
    //imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
    imagecopyresampled($im, $imx, ($x1) + 2, ($y1) + 2, 0, 0, $w1 + 6, $h1 + 6, 1, 1);
    imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);
   

}

function copyImage1($im, $var, $x1, $y1){
    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
$exp=imagecolorallocate($im, 34, 0, 255);
$red= imagecolorallocate($im, 255, 0, 0);
    $dp1 = imagecreatefromjpeg($var);
    list($w1, $h1) = getimagesize($var);
    $imx = imagecreatefrompng("images/shadow.png");
    if($h1 > 200) $h1 = 200;
    //imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
  //  imagecopyresampled($im, $imx, ($x1) + 2, ($y1) + 2, 0, 0, $w1 + 6, $h1 + 6, 1, 1);
  //  imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);
   

}


$names = array("m" => array("Bryan Greenberg", "Channing Tatum", "Paul Walker", "Heath Ledger", "Bradley Cooper", "Leonardo DiCaprio", "Jake Gyllenhaal", "Ryan Reynolds", "Cam Gigandet", "Chris Brown", "Zac Efron", "Robert Pattinson", "Ashton Kutcher", "Chris Pine", "Ryan Gosling", "James Marsden", "Johnny Depp", "Andrew Garfield", "Austin Nichols", "Orlando Bloom", "James Franco", "Sam Worthington", "Taylor Lautner", "Brad Pitt", "Gerard Butler"),
               "f" => array("Mila Kunis", "Amanda Seyfried", "Rachel McAdams", "Shantel VanSanten", "Natalie Portman", "Sophia Bush", "Malin Akerman", "Scarlett Johansson", "Olivia Wilde", "Emma Stone", "Jessica Alba", "Ellen Page", "Diane Kruger", "Rachel Bilson", "Taylor Swift", "Anna Paquin", "Beyoncé Knowles", "Cobie Smulders", "Emily Blunt", "Ashley Benson", "Alexis Bledel", "Kate Hudson", "Emma Roberts", "Brittany Snow", "Rose Byrne"));
$random=rand(1, count($names[$sex]));
$dp2_name = "images/celebmarry/" . $sex . $random . ".jpg";
$font = "fonts/segoeui.ttf";
$celebname = $names[$sex][$random - 1];
$bigc = array('Bill Gates', 'Steve Jobs', 'Barack Obama');
$bigcomments = array("Congrats $myname! Did you tried the Windows 10 Copy?", "Congrats $myname! I hope you like your new iPhone7.", "Hey $myname, Congrats! Long time no see, meet me asap!");
 $tt = mt_rand(0,2);

if($tt == 0)
{
	$commentpic = imagecreatefromjpeg("images/celebmarry/bill.jpg");
	$distance = 193;
}
if($tt == 1)
{
	$commentpic = imagecreatefromjpeg("images/celebmarry/steve.jpg");
	$distance = 200;	
}
if($tt == 2)
{
	$commentpic = imagecreatefromjpeg("images/celebmarry/barack.jpg");
	$distance = 230;	
}
copyImage1($im, $sidepic, 83, 10);
copyImage($im, $dp1_name, 150, 60);
copyImage($im, $dp2_name, 400, 60);
imagecopy($im, $commentpic, 85, 296, 0, 0, 40, 40);
$fblue = imagecolorallocate($im, 54, 88, 178);
$date = mt_rand(1,27);
$month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$rr = mt_rand(0, count($month)-1);
$fmonth = $month[$rr];
$year = mt_rand(2019, 2025);
$likes = mt_rand (1, 51);
$shares = mt_rand(10034, 19367);
$commentlikes = mt_rand(600,958);
imagettftext($im, 12, 0, 130, 24, $fblue, $font, $myname." with $celebname");
$grey = imagecolorallocate($im, 144, 148, 156);
imagettftext($im, 10, 0, 130, 40, $grey, $font, "$date $fmonth, $year");
imagettftext($im, 10, 0, 142, 252, $fblue, $font, $likes."M");
imagettftext($im, 9, 0, 92, 287, $fblue, $font, number_format($shares));
imagettftext($im, 9, 0, 220, 334, $fblue, $font, $commentlikes);
imagettftext($im, 11, 0, 128, 311, $fblue, $font, $bigc[$tt]);
imagettftext($im, 10, 0, $distance, 311, $asd, $font, $bigcomments[$tt]);
$file_name = "dump/celebmarry/".$user_id.".jpg";
imagejpeg( $im, "dump/celebmarry/".$user_id.".jpg", 100);
imagedestroy($im);
imagedestroy($commentpic);	
	
}

if($appname == "celebrity")
{

	$myname = $FirstName;
$name = $myname;

$im = @imagecreatefromjpeg("images/celebrity/bg.jpg") or die('Cannot Initialize new GD image stream');

function copyImage($im, $dp1_name, $x1, $y1, $text){
    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
$exp=imagecolorallocate($im, 34, 0, 255);
$red= imagecolorallocate($im, 255, 0, 0);
    $dp1 = imagecreatefromjpeg($dp1_name);
    list($w1, $h1) = getimagesize($dp1_name);
    $imx = imagecreatefrompng("images/shadow.png");
    if($h1 > 200) $h1 = 200;
    //imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
    imagecopyresampled($im, $imx, ($x1) + 2, ($y1) + 2, 0, 0, $w1 + 6, $h1 + 6, 1, 1);
    imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);
    imagettftext($im, 18, 0, ($x1 +5 ), 325,$black, "fonts/JandaCurlygirlChunky.ttf", $text);

}
$dp1_name = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=150&width=150";

$names = array("m" => array("Bryan Greenberg", "Channing Tatum", "Paul Walker", "Heath Ledger", "Bradley Cooper", "Leonardo DiCaprio", "Jake Gyllenhaal", "Ryan Reynolds", "Cam Gigandet", "Chris Brown", "Zac Efron", "Robert Pattinson", "Ashton Kutcher", "Chris Pine", "Ryan Gosling", "James Marsden", "Johnny Depp", "Andrew Garfield", "Austin Nichols", "Orlando Bloom", "James Franco", "Sam Worthington", "Taylor Lautner", "Brad Pitt", "Gerard Butler"),
               "f" => array("Mila Kunis", "Amanda Seyfried", "Rachel McAdams", "Shantel VanSanten", "Natalie Portman", "Sophia Bush", "Malin Akerman", "Scarlett Johansson", "Olivia Wilde", "Emma Stone", "Jessica Alba", "Ellen Page", "Diane Kruger", "Rachel Bilson", "Taylor Swift", "Anna Paquin", "BeyoncÃ© Knowles", "Cobie Smulders", "Emily Blunt", "Ashley Benson", "Alexis Bledel", "Kate Hudson", "Emma Roberts", "Brittany Snow", "Rose Byrne"));

$random2=rand(1, count($names[$sex]));
$dp2_name = "images/celebrity/" . $sex . $random2 . ".jpg";


copyImage($im, $dp1_name, 80, 90, $name);
copyImage($im, $dp2_name, 360, 90, $names[$sex][$random2 - 1]);


$name = strtolower($name); 


$file_name = "dump/celebrity/".$user_id.".jpg";

imagejpeg($im, $file_name, 100);
imagedestroy($im);

}

if($appname == 'celebpers')
{

	$myname = $FirstName;
$dp1_name = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=150&width=150";
$im = imagecreatefromjpeg("images/celebpers/bg.jpg");

function copyImage($im, $var, $x1, $y1, $text){
    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
$exp=imagecolorallocate($im, 34, 0, 255);
$red= imagecolorallocate($im, 255, 0, 0);
    $dp1 = imagecreatefromjpeg($var);
    list($w1, $h1) = getimagesize($var);
    $imx = imagecreatefrompng("images/shadow.png");
    if($h1 > 200) $h1 = 200;
    //imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
    imagecopyresampled($im, $imx, ($x1) + 2, ($y1) + 2, 0, 0, $w1 + 6, $h1 + 6, 1, 1);
    imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);
   imagettftext($im, 16, 0, ($x1 +0 ), 325,$white, "fonts/JandaCurlygirlChunky.ttf", $text);

}
copyImage($im, $dp1_name, 135, 126, $myname);

$names = array("m" => array("Bryan Greenberg", "Channing Tatum", "Paul Walker", "Heath Ledger", "Bradley Cooper", "Leonardo DiCaprio", "Jake Gyllenhaal", "Ryan Reynolds", "Cam Gigandet", "Chris Brown", "Zac Efron", "Robert Pattinson", "Ashton Kutcher", "Chris Pine", "Ryan Gosling", "James Marsden", "Johnny Depp", "Andrew Garfield", "Austin Nichols", "Orlando Bloom", "James Franco", "Sam Worthington", "Taylor Lautner", "Brad Pitt", "Gerard Butler"),
               "f" => array("Mila Kunis", "Amanda Seyfried", "Rachel McAdams", "Shantel VanSanten", "Natalie Portman", "Sophia Bush", "Malin Akerman", "Scarlett Johansson", "Olivia Wilde", "Emma Stone", "Jessica Alba", "Ellen Page", "Diane Kruger", "Rachel Bilson", "Taylor Swift", "Anna Paquin", "Beyoncé Knowles", "Cobie Smulders", "Emily Blunt", "Ashley Benson", "Alexis Bledel", "Kate Hudson", "Emma Roberts", "Brittany Snow", "Rose Byrne"));

$random=rand(1, count($names[$sex]));
$dp2_name = "images/celebpers/" . $sex . $random . ".jpg";
copyImage($im, $dp2_name, 460, 126, $names[$sex][$random - 1]);
$file_name = "dump/celebpers/".$user_id.".jpg";
imagejpeg( $im, "dump/celebpers/".$user_id.".jpg", 70);
imagedestroy($im);

}

if($appname == "status")
{

$myname = $FirstName;
$dp1_name = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=47&width=47";
$im = imagecreatefromjpeg("images/status/bg.jpg");
function copyImage($im, $var, $x1, $y1){
    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
$exp=imagecolorallocate($im, 34, 0, 255);
$red= imagecolorallocate($im, 255, 0, 0);
    $dp1 = imagecreatefromjpeg($var);
    list($w1, $h1) = getimagesize($var);
    $imx = imagecreatefrompng("images/shadow.png");
    if($h1 > 200) $h1 = 200;
    //imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);
}
copyImage($im, $dp1_name, 99, 24.5);
$fblue = imagecolorallocate($im, 54, 88, 178);
$font = 'fonts/segoebold.ttf';
$font1 = 'fonts/segoeui.ttf';
imagettftext($im, 12, 0, 155, 35, $fblue, $font, $FullName);
$date = mt_rand(1,27);
$month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$rr = mt_rand(0, count($month)-1);
$fmonth = $month[$rr];
$grey = imagecolorallocate($im, 144, 148, 156);
imagettftext($im, 8, 0, 155, 50, $grey, $font1, "$date $fmonth 2027");

$planet = array('Mercury', 'Venus', 'Mars', 'Jupiter', 'Saturn', 'Pluto');
$pp = mt_rand(0, count($planet)-1);
$fplanet= $planet[$pp];

$mstatus = array('Hmm... Ferrari or Lotus??? Can\'t Decide :/ ', "Just Came back from trip to $fplanet, It was Awesome! xD", "Dinner with Obama and Michell was awesome, They are Nice People :)", "I am Single again :P", "Finally! Made the time machine! Thanks Everyone for support...", 'Finally! Got my New iPhone 7! Yeah!');
$mss = mt_rand(0, count($mstatus)-1);
$fmstatus = $mstatus[$mss];

$fstatus = array('Just broke up With my Boyfriend ;( ', "Just Came back from trip to $fplanet, It was Awesome! xD", 'Hurray! Finally Saved Humanity from attack of Aliens!', 'Finally! Got my New iPhone 7 <3', 'Batman Saved my life today, i thought i was going to die ;( ', "Dinner with Obama and Michell was awesome, They are Nice People :)");
 $fss = mt_rand(0, count($fstatus)-1);

$ffstatus = $fstatus[$fss];


if($sex == 'm')
{
	$finalstatus = $fmstatus ;
	
	if($mss == 0)
	{
		$pic1 = 'spiderman';
		$pic2 = 'batman';
		$comment1 = "Well, Go for Batman's BatMobile!";
		$comment2 = "^Looks like spidey is out of web these days :P";
		$profile1 = 'Spiderman';
		$profile2 = 'Batman';
	}
	
	if($mss == 1)
	{
		$pic1 = 'barack';
		$pic2 = 'nasa';
		$comment1 = "Congrats! I Hope you enjoyed your journey without any problems.";
		$comment2 = "Barack Sir, He Enjoyed the journey because we faced all his problems ;(";
		$profile1 = 'Barack Obama';
		$profile2 = 'NASA';
	}
	
	if($mss == 2)
	{
		$pic1 = 'spiderman';
		$pic2 = 'barack';
		$comment1 = "Great, But why Obama Sir forgot to invite me ?";
		$comment2 = "Sorry Spidey but how will you eat with that mask ?";
		$profile1 = 'Spiderman';
		$profile2 = 'Barack Obama';
	}
	
	if($mss == 3)
	{
		$pic1 = 'miley';
		$pic2 = 'selena';
		$comment1 = "Don't worry $myname, I am always with you <3";
		$comment2 = "^No Way!, $myname is mine! Go find Someone else!";
		$profile1 = 'Miley Cyrus';
		$profile2 = 'Selena Gomez';
	}
	
	if($mss == 4)
	{
		$pic1 = 'student';
		$pic2 = 'albert';
		$comment1 = "Great, now go Back and kill Einstein and Newton!!!";
		$comment2 = "No need, already made time machine and now coming with new theories :)";
		$profile1 = 'Students Organisation';
		$profile2 = 'Albert Einstein';
	}
	
	if($mss == 5)
	{
		$pic1 = 'bill';
		$pic2 = 'steve';
		$comment1 = "You should consider Windows phone, much better than iPhone";
		$comment2 = "^ Bill, Internet Explorer Still not responding ?";
		$profile1 = 'Bill Gates';
		$profile2 = 'Steve Jobs';
	}
}	
else
{
	$finalstatus = $ffstatus ;
	if($fss == 0)
	{
		$pic1 = 'justin';
		$pic2 = 'ryan';
		$comment1 = "Don't worry Baby i am always with you";
		$comment2 = "Get Lost Kid! $myname is mine!";
		$profile1 = 'Justin Bieber';
		$profile2 = 'Ryan Gosling';
	}
	
	if($fss == 1)
	{
		$pic1 = 'barack';
		$pic2 = 'nasa';
		$comment1 = "Congrats! I Hope you enjoyed your journey without any problems.";
		$comment2 = "Barack Sir, She Enjoyed the journey because we faced all her problems ;(";
		$profile1 = 'Barack Obama';
		$profile2 = 'NASA';
	}
	
	if($fss == 2)
	{
		$pic1 = 'joker';
		$pic2 = 'batman';
		$comment1 = "You Humans are Fools!";
		$comment2 = "^ and you are JOKER!";
		$profile1 = 'Joker';
		$profile2 = 'Batman';
	}
	
	if($fss == 3)
	{
		$pic1 = 'bill';
		$pic2 = 'steve';
		$comment1 = "You should consider Windows phone, much better than iPhone";
		$comment2 = "^ Bill, Internet Explorer Still not responding ?";
		$profile1 = 'Bill Gates';
		$profile2 = 'Steve Jobs';
	}
	
	if($fss == 4)
	{
		$pic1 = 'joker';
		$pic2 = 'batman';
		$comment1 = "Why so Serious ?";
		$comment2 = "^Shut Up Joker! It was all because of you idiot! On my way to kick your a**!";
		$profile1 = 'Joker';
		$profile2 = 'Batman';
	}
	
	if($fss == 5)
	{
		$pic1 = 'spiderman';
		$pic2 = 'barack';
		$comment1 = "Great, But why Obama Sir forgot to invite me ?";
		$comment2 = "Sorry Spidey but how will you eat with that mask ?";
		$profile1 = 'Spiderman';
		$profile2 = 'Barack Obama';
	}
}	

imagettftext($im, 10, 0, 155, 67, $sdre, $font1, $finalstatus);

$comment1pic = imagecreatefromjpeg("images/status/$pic1.jpg");
$comment2pic = imagecreatefromjpeg("images/status/$pic2.jpg");

imagecopy($im, $comment1pic, 92, 160, 0, 0, 40, 40);
imagecopy($im, $comment2pic, 92, 227, 0, 0, 40, 40);

imagettftext($im, 9.5, 0, 140, 170, $fblue, $font, $profile1);
imagettftext($im, 9.5, 0, 140, 240, $fblue, $font, $profile2);

imagettftext($im, 9, 0, 140, 190, $asd, $font1, $comment1);
imagettftext($im, 9, 0, 140, 260, $asd, $font1, $comment2);

$likes = mt_rand (1, 51);
$commentlikes1 = mt_rand (503,940);
$commentlikes2 = number_format(mt_rand (1003,9342));

imagettftext($im, 9.5, 0, 133, 106, $fblue, $font1, $likes."M");

imagettftext($im, 9, 0, 230, 210, $fblue, $font1, $commentlikes1);
imagettftext($im, 9, 0, 230, 283, $fblue, $font1, $commentlikes2);

$file_name = "dump/status/".$user_id.".jpg";
imagejpeg( $im, "dump/status/".$user_id.".jpg", 100);
imagedestroy($im);

}

if($appname == "cartoon")
{

$myname = $FirstName;
$name = $myname;


$im = @imagecreatefromjpeg("images/cartoon/cartoon2.jpg") or die('Cannot Initialize new GD image stream');

function copyImage($im, $dp1_name, $x1, $y1, $text){
    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
$exp=imagecolorallocate($im, 34, 0, 255);
$red= imagecolorallocate($im, 255, 0, 0);
    $dp1 = imagecreatefromjpeg($dp1_name);
    list($w1, $h1) = getimagesize($dp1_name);
    $imx = imagecreatefrompng("images/shadow.png");
    if($h1 > 200) $h1 = 200;
    //imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
    imagecopyresampled($im, $imx, ($x1) + 2, ($y1) + 2, 0, 0, $w1 + 6, $h1 + 6, 1, 1);
    imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);
    imagettftext($im, 18, 0, ($x1 +5 ), 325,$black, "fonts/JandaCurlygirlChunky.ttf", $text);
}

$dp1_name = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=150&width=150";

$names = array("m" => array("Popoye","Scooby-Doo","Donald Duck","Eric Cartman","Bugs Bunny","Homer Simpson","Bugs Bunny","Tom","Jerry","Fred Flintstone","Dr. Doofenshmirtz","Mickey Mouse","Bart Simpson","Stewie Griffin","Phineas Flynn","SpongeBob"),
               "f" => array("Ariel","Daphne Blake","Lisa Simpson","Minnie Mouse ","Snow white","Cinderella"));
$random2=rand(1, count($names[$sex]));
$dp2_name = "images/cartoon/".$sex.$random2.".jpg";


copyImage($im, $dp1_name, 70, 105, $myname);
copyImage($im, $dp2_name, 360, 105, $names[$sex][$random2 - 1]);

$name = strtolower($name); 


$file_name = "dump/cartoon/".$user_id.".jpg";
imagejpeg($im, $file_name, 100);
imagedestroy($im);

}

if($appname == "die")
{

$myname = $FirstName;
$name = $myname;
$myimg = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=150&width=150";
$myname = $name;

function copyImage3($im, $dp1_name, $x1, $y1 ){ 

    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
    $dp1 = imagecreatefromjpeg($dp1_name);
    list($w1, $h1) = getimagesize($dp1_name);   
    
    //imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
    
    imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);
    

}

	
$reason = RandomLine("images/die/reason.txt");   

$canvas = imagecreatefromjpeg ("images/die/bg.jpg");                                   // background image file
$black = imagecolorallocate( $canvas, 0, 0, 0 );                         // The second colour - to be used for the text
$font = "fonts/arial.ttf";                                                         // Path to the font you are going to use
$fontsize = 20;                                                             // font size

$birthday = "R.I.P on";

$death = "- ".date('d/m/Y', strtotime( '+'.rand(0, 10000).' days'))."";

$dp1_name = "http://graph.facebook.com/" . $id . "/picture?type=normal&height=150&width=150";


imagettftext( $canvas, 22, 0, 330, 270, $black, $font, $myname );            // name
imagettftext( $canvas, 22, 0, 330, 330, $black, $font, $birthday );        // birthday
imagettftext( $canvas, 22, 0, 450, 330, $black, $font, $death );           // death
imagettftext( $canvas, 20, 0, 330, 380, $black, $font, $reason );           // reason
copyimage3($canvas, $dp1_name, 520, 25);
	

$file_name = "dump/die/".$user_id.".jpg";
imagejpeg( $canvas, "dump/die/".$user_id.".jpg", 60 );
	imagedestroy($canvas);

}

if($appname == "animal")
{

$myname = $FirstName;
$name = $myname;
$data = array_rand($AngryData);
$data = $AngryData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/animal/angry.jpg');
    $img->text("Your Result: $top", 'fonts/Verdana.ttf', 20, '#ffffff', 'center', 0, -124);
    $img->text($name, 'fonts/Verdana.ttf', 23, '#ffffff', 'center', 0,-180);
    $img->paragraph($second, 60, 'fonts/Verdana.ttf', 18, '#ffffff', 'left', '25', '163');
	$file_name = "dump/animal/".$user_id.".jpg";
	$img->save($file_name);

}

if($appname == "marriage")
{
$myname = $FirstName;


function copyImage($im, $dp1_name, $x1, $y1 ){ 

    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
    $dp1 = imagecreatefromjpeg($dp1_name);
    list($w1, $h1) = getimagesize($dp1_name);
   
    if($h1 > 200) $h1 = 200;
    imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);   

}

$canvas = imagecreatefromjpeg ("images/marriage/bg.jpg");                                   // background image file
$red = imagecolorallocate( $canvas, 255, 255, 255);                         // The second colour - to be used for the text
$font = "fonts/arial.ttf";                                                         // Path to the font you are going to use
$fontsize = 20;                                                             // font size

$dp1_name = "http://graph.facebook.com/" .$id. "/picture?type=normal&height=150&width=150";

$cities = "McDonalds
Washington,US
The Moon
Mars
Father's Basement
Las Vegas
The Zoo
A Roller Coaster
Disneyland
A Weird Jungle
An Ambulance
A School Bus
White House";

$matches=explode("\n",$cities);

$loc = $matches[array_rand($matches)];

//$birthday = $user->birthday;
$mar = 'Marriage Date -';
$mar1 = 'Love or Arrange -';
$mar2 = 'Place of Marriage -';
 $sex1 = $sex ;
$randomm = rand(1, 2);

$names = array("m" => array("Arrange Marriage", "Love Marriage"),
               "f" => array("Arrange Marriage", "Love Marriage"));

$m = rand(1,12);
$day = rand(01,28);
$year = rand(2016,2020);


$criteria = date("Y-m-d H:i:s" , strtotime("+ 2 days", strtotime(date("Y-m-d H:i:s"))));




$grey = imagecolorallocate($canvas, 127,127,127);
imagettftext( $canvas, 35, 0, 270, 95, $black, $font, $name);
imagettftext( $canvas, 20, 0, 525, 225, $black, $font, $day. "-" . $m. "-" . $year);
  
imagettftext( $canvas, 20, 0, 540, 425, $black, $font, $loc);
imagettftext( $canvas, 20, 0, 300, 225, $black, $font, $mar);
imagettftext( $canvas, 20, 0, 305, 325, $black, $font, $mar1);
imagettftext( $canvas, 20, 0, 300, 425, $black, $font, $mar2);
imagettftext( $canvas, 20, 0, 535, 325, $black, $font, $names[$sex1][$randomm - 1]);
copyImage( $canvas, $dp1_name, 40, 70);

$file_name = "dump/marriage/".$user_id.".jpg";
imagejpeg( $canvas, "dump/marriage/".$user_id.".jpg", 60 );
imagedestroy($canvas);
}

if($appname == "pastlife")
{
$myname = $FirstName;
$name = $myname;

function copyImagep($im, $dp1_name, $x1, $y1 ){ 

    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
    $dp1 = imagecreatefromjpeg($dp1_name);
    list($w1, $h1) = getimagesize($dp1_name);
    imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);
   

}
$myname = $name;
$fbid = $id; 


$reason = RandomLine("images/pastlife/reason.txt");   

$canvas = imagecreatefromjpeg ("images/pastlife/bg.jpg");                                   // background image file
$white = imagecolorallocate( $canvas, 0xFF, 0xFF, 0xFF);                         // The second colour - to be used for the text
$font = "fonts/arial.ttf";                                                         // Path to the font you are going to use
$fontsize = 20;                                                             // font size

$dp1_name = "http://graph.facebook.com/" .$id. "/picture?type=normal&height=150&width=150";





imagettftext( $canvas, 30, 0, 230, 120, $white, $font, $name);            // name
imagettftext( $canvas, 40, 0, 270, 270, $white, $font, $reason );           // reason
copyImagep($canvas, $dp1_name, 40, 30);
$file_name = "dump/pastlife/".$user_id.".jpg";
imagejpeg($canvas, $file_name, 100);
ImageDestroy( $canvas );
}

if($appname == "beauty")
{
if($sex == 'f')
{
$myname = $FirstName;
$name = $myname;

$data = array_rand($BeautyData);
$data = $BeautyData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/beauty/beauty.jpg');
    //$iamge->save('result.gif');
    $img->text("$top", 'fonts/Bold.ttf', 23, '#ffffff', 'center', 0, -104);
    $img->text($name, 'fonts/Bold.ttf', 23, '#ffffff', 'center', 0,-180);
    $img->paragraph($second, 45, 'fonts/Bold.ttf', 24, '#ffffff', 'left', '45', '203');
    $file_name = "dump/beauty/".$user_id.".jpg";
    $img->save($file_name);
}
else
{
	echo "This application is only for girls :) Sorry :)";
	exit;
	die();
}
    

}

if($appname == "change")
{
$myname = $FirstName;
$name = $myname;

$data = array_rand($LifeData);
$data = $LifeData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/change/truepersonality.jpg');
    //$iamge->save('result.gif');
    $img->text("$top", 'fonts/Bold.ttf', 18, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#000000', 'center', 0,-170);
    $img->paragraph($second, 56, 'fonts/Sansation_Bold.ttf', 20, '#ffffff', 'left', '45', '183');
$file_name = "dump/change/".$user_id.".jpg";
$img->save($file_name);
}

if($appname == "color")
{
$myname = $FirstName;
$name = $myname;
$data = array_rand($InnerData);
$data = $InnerData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/color/inner.jpg');
    //$iamge->save('result.gif');
    $img->text("Your Inner Colour is : $top", 'fonts/Bold.ttf', 18, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#000000', 'center', 0,-170);
    $img->paragraph($second, 56, 'fonts/Verdana.ttf', 18, '#1b4c6e', 'center', '45', '183');
$file_name = "dump/color/".$user_id.".jpg";
$img->save($file_name);
}

if($appname == "firstchild")
{
$myname = $FirstName;
$name = $myname;
$data = array_rand($FirstChildData);
$data = $FirstChildData[$data];
$top = $data[0];
$second = $data[1];

    if($top == "Boy"){
    $img = new abeautifulsite\SimpleImage('images/firstchild/boychild.jpg');
    }else{
      $img = new abeautifulsite\SimpleImage('images/firstchild/girlchild.jpg');
    }
    //$iamge->save('result.gif');
    $img->text("Your first child will be a $top", 'fonts/Verdana.ttf', 23, '#000000', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 27, '#d43d35', 'center', 0,-180);
    $img->paragraph($second, 40, 'fonts/Verdana.ttf', 20, '#ffffff', 'left', '45', '283');
$file_name = "dump/firstchild/".$user_id.".jpg";
 $img->save($file_name);
}

if($appname == "life")
{
$myname = $FirstName;
$name = $myname;
$data = array_rand($LifeData);
$data = $LifeData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/life/truepersonality.jpg');
    //$iamge->save('result.gif');
    $img->text("$top", 'fonts/Bold.ttf', 18, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#000000', 'center', 0,-170);
    $img->paragraph($second, 56, 'fonts/Sansation_Bold.ttf', 20, '#ffffff', 'left', '45', '183');
$file_name = "dump/life/".$user_id.".jpg";
$img->save($file_name);
}

if($appname == "lovepercent")
{
$myname = $FirstName;
$name = $myname;


function copyImagel($im, $dp1_name, $x1, $y1 ){ 

    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 147, 147, 147);
    $black = imagecolorallocate($im, 10, 10, 10);
    $dp1 = imagecreatefromjpeg($dp1_name);
    list($w1, $h1) = getimagesize($dp1_name);
   
   
    //imagefilledrectangle($im, ($x1 - 3) + 3, ($y1 - 3) + 3, ($x1 + $w1 + 3) + 3, ($y1 + $h1 + 3) + 3, $grey);
   
    imagefilledrectangle($im, ($x1 - 3), ($y1 - 3), ($x1 + $w1 + 3), ($y1 + $h1 + 3), $white);
    imagecopy($im, $dp1, $x1, $y1, 0, 0, $w1, $h1);
   

}

$fbid = $id;

$canvas = imagecreatefromjpeg ("images/lovepercent/bg.jpg");                                   // background image file
$red = imagecolorallocate( $canvas, 233, 23, 32);                         // The second colour - to be used for the text
$font = "fonts/arial.ttf";                                                         // Path to the font you are going to use
$fontsize = 20;                                                             // font size

$dp1_name = "http://graph.facebook.com/" .$id. "/picture?type=large";

$numb = rand(65,100);

$random2 = rand(1, 1);

$names = array("m" => array("Your Girlfriend loves you"),
               "f" => array("Your Boyfriend loves you"));

$symb="%";

imagettftext( $canvas, 40, 0, 260, 160, $red, $font, $name);
imagettftext( $canvas, 18, 0, 250, 225, $red, $font, $names[$sex][$random2 - 1]);
imagettftext( $canvas, 60, 0, 280, 320, $red, $font, $numb. "" . $symb );
copyImagel($canvas, $dp1_name, 50, 115);

$file_name = "dump/lovepercent/".$user_id.".jpg";
imagejpeg( $canvas, "dump/lovepercent/".$user_id.".jpg", 60 );

imagedestroy($canvas);
}

if($appname == "thrones")
{
if($sex == 'f')
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";


$data = array_rand($ThronesData);
$data = $ThronesData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/thrones/thrones.jpg');
    //$iamge->save('result.gif');
    $img->text("$top", 'fonts/Bold.ttf', 23, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#ffffff', 'center', 0,-180);
    $img->paragraph($second, 47, 'fonts/Verdana.ttf', 22, '#ffffff', 'left', '45', '173');
$file_name = "dump/thrones/".$user_id.".jpg";
$img->save($file_name);
}
else
{
	echo "This application is only for girls :) Sorry :)";
	exit;
	die();
}

}

if($appname == "truepersonality")
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

$data = array_rand($TruepersonalityData);
$data = $TruepersonalityData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/truepersonality/truepersonality.jpg');
    //$iamge->save('result.gif');
    $img->text("$top", 'fonts/Bold.ttf', 23, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#000000', 'center', 0,-170);
    $img->paragraph($second, 54, 'fonts/Verdana', 19, '#ffffff', 'left', '45', '203');
$file_name = "dump/truepersonality/".$user_id.".jpg";
$img->save($file_name);
}


if($appname =="element")
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

$data = array_rand($ElementData);
$data = $ElementData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/element/element.jpg');
    //$iamge->save('result.gif');
    $img->text("Your Element is : $top", 'fonts/Bold.ttf', 18, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#000000', 'center', 0,-170);
    $img->paragraph($second, 57, 'fonts/Verdana.ttf', 18, '#ffffff', 'center', '55', '163');
$file_name = "dump/element/".$user_id.".jpg";
$img->save($file_name);
}

if($appname == "secret")
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

$data = array_rand($SecretData);
$data = $SecretData[$data];
$second = $data[0];

    $img = new abeautifulsite\SimpleImage('images/secret/secret.jpg');
    //$iamge->save('result.gif');
    
    $img->text($name, 'fonts/Bold.ttf', 23, '#ffffff', 'center', 0,-180);
    $img->paragraph($second, 55, 'fonts/Verdana.ttf', 20, '#ffffff', 'center', '35', '163');
$file_name = "dump/secret/".$user_id.".jpg";
$img->save($file_name);
}

if($appname == "shouldbe")
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

$data = array_rand($shouldbeData);
$data = $shouldbeData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/element/element.jpg');
    //$iamge->save('result.gif');
    $img->text("Your name should be : $top", 'fonts/Bold.ttf', 18, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#000000', 'center', 0,-170);
    $img->paragraph($second, 57, 'fonts/Verdana.ttf', 18, '#ffffff', 'center', '55', '163');
$file_name = "dump/shouldbe/".$user_id.".jpg";
$img->save($file_name);
}

if($appname == "storm")
{

$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

$data = array_rand($StormData);
$data = $StormData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/storm/storm.jpg');
    //$iamge->save('result.gif');
    $img->text("Your are a..  $top", 'fonts/Bold.ttf', 18, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#000000', 'center', 0,-170);
    $img->paragraph($second, 57, 'fonts/Verdana.ttf', 18, '#ffffff', 'center', '55', '163');
$file_name = "dump/storm/".$user_id.".jpg";
$img->save($file_name);

}

if($appname == "spirit")
{
$myname = $FirstName;
$name = $myname;

$data = array_rand($SpiritData);
$data = $SpiritData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/spirit/spirit.jpg');
    //$iamge->save('result.gif');
    $img->text("Your spirit animal is..  $top", 'fonts/Bold.ttf', 18, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#000000', 'center', 0,-170);
    $img->paragraph($second, 50, 'fonts/Verdana.ttf', 22, '#ffffff', 'center', '25', '163');
$file_name = "dump/spirit/".$user_id.".jpg";
$img->save($file_name);
}

if($appname == "nickname")
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

$data = array_rand($nickNameData);
$data = $nickNameData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/nickname/lifechange.jpg');
    //$iamge->save('result.gif');
    $img->text("Your nick name is $top", 'fonts/Bold.ttf', 20, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#ffffff', 'center', 0,-170);
    $img->paragraph($second, 50, 'fonts/Verdana.ttf', 22, '#ffffff', 'center', '25', '163');

$file_name = "dump/nickname/".$user_id.".jpg";
$img->save($file_name);
}

if($appname == "hidden")
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

$data = array_rand($HiddenData);
$data = $HiddenData[$data];
$second = $data[0];

    $img = new abeautifulsite\SimpleImage('images/hidden/nameanalysis.jpg');
    //$iamge->save('result.gif');
    
    $img->text($name, 'fonts/Bold.ttf', 23, '#ffffff', 'center', 0,-180);
    $img->paragraph($second, 50, 'fonts/Verdana.ttf', 22, '#ffffff', 'center', '35', '163');
$file_name = "dump/hidden/".$user_id.".jpg";
$img->save($file_name);
}

if($appname == "dwarf")
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

$data = array_rand($DwarfData[0]);
    $second = $DwarfData[0][$data];
   
    $img = new abeautifulsite\SimpleImage("images/dwarf/$second.jpg");
     $img->text(strtoupper($name), 'fonts/Bold.ttf', 30, '#000000', 'left', 120,-120);
$file_name = "dump/dwarf/".$user_id.".jpg";
$img->save($file_name);
}

if($appname == "mood")
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

         
$data = array_rand($MoodData);
$data = $MoodData[$data];
$second = $data[0];

    $img = new abeautifulsite\SimpleImage('images/mood/mood.jpg');
    //$iamge->save('result.gif');
    
    $img->text($name, 'fonts/Bold.ttf', 23, '#ffffff', 'center', 0,-180);
    $img->paragraph($second, 44, 'fonts/Verdana.ttf', 26, '#ffffff', 'center', '35', '163');
$file_name = "dump/mood/".$user_id.".jpg";
$img->save($file_name);
}

if($appname =="siri")
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

$data = array_rand($SiriData);
$data = $SiriData[$data];
$second = $data[0];

    $img = new abeautifulsite\SimpleImage('images/siri/siri.jpg');
    //$iamge->save('result.gif');
    
    $img->text($name, 'fonts/Bold.ttf', 28, '#ffffff', 'center', 0,-150);
    $img->paragraph($second, 55, 'fonts/Verdana.ttf', 20, '#ffffff', 'center', '35', '193');
$file_name = "dump/siri/".$user_id.".jpg";
$img->save($file_name);
}

if($appname =="success")
{
$myname = $FirstName;
$name = $myname;
// $dp1_name = "http://graph.facebook.com/" . $me["id"] . "/picture?type=normal&height=150&width=150";

$data = array_rand($SuccessData);
$data = $SuccessData[$data];
$top = $data[0];
$second = $data[1];

    $img = new abeautifulsite\SimpleImage('images/success.jpg');
    //$iamge->save('result.gif');
    $img->text("$top", 'fonts/Bold.ttf', 20, '#ffffff', 'center', 0, -114);
    $img->text($name, 'fonts/Bold.ttf', 23, '#ffffff', 'center', 0,-180);
    $img->paragraph($second, 54, 'fonts/Verdana.ttf', 20, '#ffffff', 'center', '25', '163');
$file_name = "dump/success/".$user_id.".jpg";
$img->save($file_name);
}	

	if(isset($appname))
	{
		$request = $fb->request('POST', "?scrape=true&id=http://$url/res.php?id%3D$user_id%26app%3D$appname");
		$response = $fb->getClient()->sendRequest($request);
	}
	
	if($appname == "celebmarry")
	{
		if($sex == 'm')
			$sex = 'f';
		else
			$sex = 'm';
	}
	
	 redirect_page("http://$url/result.php?id=$id&app=$appname&g=$sex");
	

}

?>