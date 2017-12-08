<?php
include 'AppsData.php';

$appname = $_GET['app'];
$user_id = $_GET['id'];
$randomn = $_GET['r'];
$gender = $_GET['g'];
for($i=0; $i<count($data); $i++)
{
	$temp = $data[$i][2];
	if (preg_match("/app=$appname/",$temp))
	{
		$title = $data[$i][0];
		$imagecomment = $data[$i][1];
	}
}

if($appname == "wiki")
$image = "dump/$appname/".$user_id.".png";
else
$image = "dump/$appname/".$user_id.".jpg";

list($width, $height) = getimagesize($image);

if($isAppDeleted == 1)
redirect_page("http://$RedirectUrl/apps/$folder");
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="UTF-8">
		<title>
			<?=$title?>
		</title>
	</head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="canonical" href="http://<?=$url?>/result.php" />
	<meta property="og:image" content="http://<?=$url?>/<?=$image?>" />
	<meta property="fb:app_id" content="<?=$app?>" />
	<meta property="og:title" content="<?=$title?>" />
	<meta property="og:description" content="It's Awesome! Click Here to Find Out" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="<?=$width?>" />
	<meta property="og:image:height" content="<?=$height?>" />
	<meta property="og:type" content="website" />
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/1.css">
	<link rel="stylesheet" href="css/2.css">
	<style>
		html,
		body,
		h1,
		h2,
		h3,
		h4,
		h5 {
			font-family: "Raleway", sans-serif
		}

		.w3-sidenav a,
		.w3-sidenav h4 {
			font-weight: bold
		}
	</style>
	<?=$analytics?>
		<?=$commentlike?>
			<center>
				<?=$navbar?>
			</center>
			<br />

			<body class="w3-content" style="max-width:1600px;background-color:#e9ebee;">
				<!-- !PAGE CONTENT! -->
				<div class="w3-main">
					<div class="w3-card-4 w3-center">
						<header class="w3-container w3-teal w3-round">
							<h1 style="color:white;">
								<?=$title?>
							</h1>
							<br />
						</header>
						<br />
						<center>
							<img class="w3-round w3-border" src="<?=$image?>" id="mahimage" style="width:100%; max-height: <?=$height?>px; max-width: 800px;">
						</center>
						<br />
						<?=$pagelike?>
							<br />
							<br />
							<?=$ads1?>
								<div class="w3-container w3-center">
									<?php
if($randomn == 1 || $randomn == 4 || $randomn == 3)
echo '<h1>अगर आप ऐसे किसी दोस्त को जानते है तो उसे टैग ज़रूर करे।</h1>';
?>
										<h1>Share :</h1>
										<button class="w3-gplus w3-large w3-padding w3-round w3-text-shadow" onclick="gplus('http://plus.google.com/share?url=http://<?=$url?>/res.php?id=<?=$user_id?>%26app=<?=$appname?>', 'myPop1',450,450);"
										    href="javascript:void(0);">Google+</button>
										<button class="w3-fb w3-large w3-padding w3-round w3-text-shadow" onclick="facebuk('http://www.facebook.com/sharer/sharer.php?u=http://<?=$url?>/res.php?id=<?=$user_id?>%26app=<?=$appname?>', 'myPop1',450,450);"
										    href="javascript:void(0);">Facebook</button>
										<button class="w3-twitter w3-large w3-padding w3-round w3-text-shadow" onclick="twitter('http://www.twitter.com/intent/tweet?hashtags=funny,cool,lol,lmao&url=http://<?=$url?>/twitter.php?id=<?=$user_id?>%26app=<?=$appname?>', 'myPop1',450,450);"
										    href="javascript:void(0);">Twitter</button>
										<br />
										<br />
								</div>

								<br />
								<?=$CustomAd?>
									<h1>Check New Result :</h1>
									<a class="w3-btn w3-green w3-round-xlarge w3-padding-xlarge" href="http://<?=$url?>/login.php?app=<?=$appname?>">Next ->></a>
									<br />
									<h1>Comment :</h1>
									<div class="fb-comments w3-round" style="background-color:#e9ebee;" data-href="" data-numposts="5"></div>
					</div>

					<?php

echo '<div class="w3-margin"><header class="w3-container style="background-color:#e9ebee;">
   <center><h1><b>More Apps :</b></h1><p></p></center>
  </header>';
include("allapps.php");
echo '</div>';
?>

						<center>
							<?=$ads1?>
						</center>
				</div>


				<script>
					function gplus(url, title, w, h) {
						//ga('send', 'event', '<?=$appname?>', 'GooglePlus', '<?=$gender?>');
						var left = (screen.width / 2) - (w / 2);
						var top = (screen.height / 2) - (h / 2);
						return window.open(url, title,
							'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
							w + ', height=' + h + ', top=' + top + ', left=' + left);
					}

					function facebuk(url, title, w, h) {
						//ga('send', 'event', '<?=$appname?>', 'Facebook', '<?=$gender?>');
						var left = (screen.width / 2) - (w / 2);
						var top = (screen.height / 2) - (h / 2);
						return window.open(url, title,
							'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
							w + ', height=' + h + ', top=' + top + ', left=' + left);
					}

					function twitter(url, title, w, h) {
						//ga('send', 'event', '<?=$appname?>', 'Twitter', '<?=$gender?>');
						var left = (screen.width / 2) - (w / 2);
						var top = (screen.height / 2) - (h / 2);
						return window.open(url, title,
							'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
							w + ', height=' + h + ', top=' + top + ', left=' + left);
					}
				</script>


				<?=$whusamung?>
			</body>

	</html>
