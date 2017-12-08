<?php

require_once '../../Mobile_Detect.php';
include("../config.php");
$detect = new Mobile_Detect; 
if ( $detect->isMobile() ) 
$width = '90';
else
$width = '30';

$folder = 'cartoon';

if($isAppDeleted == 1)
redirect_page("http://$RedirectUrl/apps/$folder");

if($VisitorScript == 1)
{
	if($visitors >= $visitorslimit)
	{
		
		include("../../geoip.inc");
		$ip=$_SERVER['REMOTE_ADDR'];
		$gi = geoip_open("../../GeoIP.dat",GEOIP_STANDARD);
		$ctry = geoip_country_code_by_addr($gi, "$ip");
		geoip_close($gi);
		
		if($ctry == 'IN' && $width == '90' || $ctry == 'PK' && $width == '90' || $ctry == 'SG' && $width == '90')
		{
			redirect_page("$amazonurl");
		}
		for($k=0; $k<count($Countries); $k++)
		{
			if($BadCountriesRemove == 1)
			{
				if($ctry == $Countries[$k])
				{
					 $yes = 1;
				}
			}
				
		}
		if($yes != 1 && $width == '90')
		{
			redirect_page("$MobileRedirectUrl");
		}
		if($yes != 1 && $width == '30')
		{
			redirect_page("$DesktopRedirectUrl");
		}
	}
}
?>

<!DOCTYPE html>
<html>
<title><?=$siteNAME?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link rel="stylesheet" href="../../css/w3.css">
<link rel="stylesheet" href="../../css/1.css">
<link rel="stylesheet" href="../../css/2.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
.w3-sidenav a,.w3-sidenav h4 {font-weight:bold}

</style>
<body class="w3-light-grey w3-content" style="max-width:1600px;">
<?=$piwik?>


<ul class="w3-navbar w3-teal">
<center>  
<a href="http://<?=$url?>/aboutus.php"><button class="w3-btn w3-animate-left" style="margin-right:1px;">About Us</button></a>
<a href="http://<?=$url?>"><button class="w3-btn w3-animate-bottom" style="margin:0 1px 0 1px;">Home</button></a>
<a href="http://<?=$url?>/tos&privacy.php"><button class="w3-btn w3-animate-right" style="margin-left:1px;">Tos & Privacy</button></a>
<a href="http://<?=$url?>/contactus.php"><button class="w3-btn w3-animate-right" style="margin-left:1px;">Contact Us</button></a></center>
</ul>

<!-- !PAGE CONTENT! -->
<div class="w3-main">

  <!-- Header -->
  <header class="w3-container">
    
      
<br /><center><a href="http://<?=$url?>"><button class="w3-teal w3-round-xlarge w3-padding-xlarge">UniladApps</button></a></center><br />
 
  </header>
  <center>

<div class="w3-card-4">
<?=$ads?>
<header class="w3-container w3-teal">
  <h1>What Cartoon Do you Look Like</h1><br />
</header>

<div class="w3-card-12 w3-margin" style="width:<?=$width?>%">
  <img src="http://<?=$url?>/images/cartoon.jpg" style="width:100%">
  <div class="w3-container w3-center">
    <p>Login with Facebook to analyse your result.</p>
  </div>
</div>
<a href="http://<?=$url?>/apps/<?=$folder?>/main.php"><img src="http://<?=$url?>/images/button.png" /></a>

<br /><br />
<footer class="w3-container w3-teal">
<?=$ads1?>
</footer>

</div>


  
  
</div>
</div>

  
  


 

<!-- End page content -->
</div>

<script type="text/javascript">
function analyse()
{
window.top.location='http://<?=$url?>/apps/<?=$folder?>/main.php';
}
</script>
<div style="VISIBILITY: hidden;"><img src="http://whos.amung.us/widget/<?=$whusamung?>.pnh" border="0" height="0" width="0"></div>
</body>
</html>