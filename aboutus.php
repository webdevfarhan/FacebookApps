<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
<title>About Us</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
    font-family: "Raleway", sans-serif;
    color: white;
  }

  .w3-sidenav a,
  .w3-sidenav h4 {
    font-weight: bold
  }

  .bgimg-1,
  .bgimg-2,
  .bgimg-3 {
    position: relative;
    opacity: 0.95;
    background-attachment: fixed;
    background-position: center;
    background-repeat: repeat;
  }

  .bgimg-1 {
    background-image: url("images/bg.gif");
  }
</style>

<body class="bgimg-1" style="width:100%">

  <div class="w3-card-4 bgimg-1">

    <header class="w3-container w3-teal">
      <center>
        <h1>About Us</h1>
        <br />
      </center>
    </header>

    <div class="w3-card-12 w3-margin">
      <center>
        <div class="w3-container w3-center">
          <h1>
            <?=$url?>
          </h1>
          <p>We are the creators of these Funny Apps which is created to provide fun and Entertaintment taking care of the users
            <a href="privacy.php">privacy</a>. Please
            <a href="contactus.php">Contact Us</a> if you have any suggestions/idea/request.</p>


        </div>
      </center>
    </div>
    <ul class="w3-navbar w3-teal">
      <center>
        <a href="http://<?=$url?>">
          <button class="w3-btn w3-animate-bottom w3-round" style="margin:0 1px 0 1px;">Home</button>
        </a>
        <a href="http://<?=$url?>/terms.php">
          <button class="w3-btn w3-animate-right w3-round" style="margin-left:1px;">Terms</button>
        </a>
        <a href="http://<?=$url?>/privacy.php">
          <button class="w3-btn w3-animate-right w3-round" style="margin-left:1px;">Privacy</button>
        </a>
        <a href="http://<?=$url?>/contactus.php">
          <button class="w3-btn w3-animate-right w3-round" style="margin-left:1px;">Contact</button>
        </a>
      </center>
    </ul>
</body>

</html>