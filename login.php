<?php
session_start();
require_once 'Facebook/autoload.php';
require_once 'AppsData.php';

$appname = $_GET['app'];
if($isAppDeleted == 1)
redirect_page("http://$RedirectUrl/login.php?app=$appname");

if(isset($_GET['error']))
echo '<script>alert("Sorry our app cannot generate results if you dont allow our app for necessary permissions. To solve this problem goto facebook.com/settings then goto apps and remove our app from the app list and come at this page again and relogin or you can try other apps :)")</script>';

$fb = new Facebook\Facebook([
  'app_id' => $app,
  'app_secret' => $secret,
  'default_graph_version' => 'v2.8',
]);
$helper = $fb->getRedirectLoginHelper();

$permissions = array('user_posts');
	$tempUrl = "http://$url/login-callback.php?app=$appname";
	$loginUrl = $helper->getLoginUrl($tempUrl, $permissions);

for($i=0; $i<count($data); $i++)
{
	$temp = $data[$i][2];
	if (preg_match("/app=$appname/",$temp))
	{
		$title = $data[$i][0];
		$image = $data[$i][1];
	}
}


?>

	<!DOCTYPE html>
	<html>
	<title>
		<?=$siteNAME?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/1.css">
	<link rel="stylesheet" href="css/2.css">
	<link rel="canonical" href="http://<?=$url?>/login.php" />
	<style>
		html,
		body,
		h1,
		h2,
		h3,
		h4,
		h5 {
			font-family: "Raleway", sans-serif;
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

			<body class="w3-content" style="max-width:1600px;background-color:#e9ebee;">
				<div class="w3-main">
					<center>
						<div class="w3-card-4">
							<?=$ads?>
								<header class="w3-container w3-teal">
									<h1 style="color:white;">
										<?=$title?>
									</h1>
									<br />
								</header>
								<br />
								<a href="<?=$loginUrl?>">
									<img class="w3-round w3-border" src="<?=$image?>" style="width:100%; min-height:250px; max-height: 250px; max-width: 400px;">
								</a>
								<br />
								<br />
								<a href="<?=$loginUrl?>" class="w3-fb w3-large w3-padding w3-round w3-text-shadow w3-padding w3-margin " style="text-decoration:none;">Login With Facebook</a>
								<br />
								<br />

								<?=$pagelike?>

									<br />

									<header class="w3-container">
										<center>
											<h1>
												<b>More Apps :</b>
											</h1>
											<p></p>
											<?php
include("allapps.php");
?>
											<div class="w3-margin-bottom"></div>
						</div>
						</center>
						</header>

				</div>
				</div>
				<br />
				<?=$ads1?>

					<?=$whusamung?>
			</body>

	</html>
