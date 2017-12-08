<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
<title>
    <?=$url?>
</title>
<?=$commentlike?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
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

    <body class="w3-content" style="max-width:1600px; background-color:#e9ebee;">
        <center>
            <?=$navbar?>
        </center>
        <div class="w3-margin">
            <?=$ads1?>
        </div>
        <!-- !PAGE CONTENT! -->
        <div class="w3-main">
            <?php
include("allapps.php");
?>
        </div>
        <br />
        <?=$ads1?>
            </div>
            <?=$whusamung?>
    </body>

</html>
