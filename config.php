<?php
 require_once 'Facebook/Mobile_Detect.php';

$url = "shielded-brook-99517.herokuapp.com";
$siteNAME = "AppsCute";
$app = '1819758168343875';
$secret = 'f48b3f1857859b5830a2b0a88caf9bef';
//$whusamung = '<div style="VISIBILITY: hidden;"><img src="http://whos.amung.us/widget/appscute.pnh" border="0" height="0" width="0"></div>';
$CustomAd = "";
$navbar = '<ul class="w3-navbar w3-teal">
<a href="http://shielded-brook-99517.herokuapp.com/"><button class="w3-btn w3-animate-bottom w3-round" style="margin:0 1px 0 1px;">Home</button></a>
</ul>';
/*$analytics = "<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : $app,
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = \"//connect.facebook.net/en_US/sdk.js\";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-100783199-1', 'auto');
  ga('send', 'pageview');

</script>";
$commentlike = "<div id=\"fb-root\"></div><script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \"//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9&appId=1819758168343875\";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>";
$pagelike = '<div class="fb-like" data-href="https://www.facebook.com/DailyFunAday/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>';
*/
// --------------------------------------------- //

$isAppDeleted = '0';
$RedirectUrl = '';

// --------------------------------------------- //

if(!function_exists("redirect_page"))
{
		function redirect_page($page){
			echo '<meta http-equiv="REFRESH" content="0;url='.$page.'">';
			exit;
		}
}
/*
$detect = new Mobile_Detect;
if ( $detect->isMobile() )
{

 	$ads1  = "<center><script type=\"text/javascript\">
	atOptions = {
		'key' : '7b47d4d6c9dbb085c16a24a3e3b90e51',
		'format' : 'iframe',
		'height' : 250,
		'width' : 300,
		'params' : {}
	};
	document.write('<scr' + 'ipt type=\"text/javascript\" src=\"http' + (location.protocol === 'https:' ? 's' : '') + '://www.bnserving.com/invoke.js\"></scr' + 'ipt>');
</script></center>";

$ads = "<center><script type=\"text/javascript\">
	atOptions = {
		'key' : '7b47d4d6c9dbb085c16a24a3e3b90e51',
		'format' : 'iframe',
		'height' : 250,
		'width' : 300,
		'params' : {}
	};
	document.write('<scr' + 'ipt type=\"text/javascript\" src=\"http' + (location.protocol === 'https:' ? 's' : '') + '://www.bnserving.com/invoke.js\"></scr' + 'ipt>');
</script></center>";


}

else
{

$ads1  = "<center><script type=\"text/javascript\">
	atOptions = {
		'key' : '2285e155f2963d2dddab8c644d6d0a32',
		'format' : 'iframe',
		'height' : 90,
		'width' : 728,
		'params' : {}
	};
	document.write('<scr' + 'ipt type=\"text/javascript\" src=\"http' + (location.protocol === 'https:' ? 's' : '') + '://www.bnserving.com/invoke.js\"></scr' + 'ipt>');
</script></center>";

$ads = "<center><script type=\"text/javascript\">
	atOptions = {
		'key' : '2285e155f2963d2dddab8c644d6d0a32',
		'format' : 'iframe',
		'height' : 90,
		'width' : 728,
		'params' : {}
	};
	document.write('<scr' + 'ipt type=\"text/javascript\" src=\"http' + (location.protocol === 'https:' ? 's' : '') + '://www.bnserving.com/invoke.js\"></scr' + 'ipt>');
</script></center>";


}
*/
?>
