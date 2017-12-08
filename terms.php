<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
<title>Terms of Service and Privacy Policy</title>
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
        <h1>Terms of Service and Privacy Policy</h1>
        <br />
      </center>
    </header>

    <div class="w3-card-12 w3-margin">
      <center>
        <div class="w3-container w3-center">
          <h1>
            <?=$url?>
          </h1>
          <p>1. Privacy on user data.
            <br />1.1. User data will only be provided when the automated tests are used, where a minimum of basic information
            is required to perform the test;
            <br />1.2. The information provided by the users in our application will only be used to generate statistics and other
            basic information necessary for the creation of the tests;
            <br />1.3. We are not authorized to disclose any information, except as necessary to carry out finished services where,
            in this case, we will make advance notice of;
            <br />1.4. We also reserve the right to disclose information collected about users whose disclosure is required by
            law, judicial process, rules imposed by any governmental body or when such disclosure is necessary to protect
            our rights or another user.</p>
          <p>2. Removing the application.
            <br />2.1. Removing the application must be done by the Facebook application panel itself;
            <br />2.2. Any guidelines, if necessary, about unlinking the application with your account, must be made by Facebook
            itself;
            <br />2.3. When doing the disassociation you will not be able to connect to the application using Facebook;
            <br />2.4. Publications made by the application will be removed from your Timeline if you unlink it with your account.</p>
          <p>3. Content made available by the application.
            <br />3.1 The application generates random and fictitious content that does not match reality;
            <br />3.2. When using our application, the user should be aware that it is pure fiction;
            <br />3.3. The results generated by the application tests contain a warning about the responses it will generate in
            its title.</p>
          <p>4. General Conditions.
            <br />4.1. By connecting Facebook to our application, you agree to our Terms of Use;
            <br />4.2. This application reserves the right to modify this Term, without prior notice, to adapt it to any legislative
            changes or information practices;
            <br />4.3. If you do not agree with any of the items presented in this Terms of Use and Privacy Policy, we advise you
            not to use our application;
            <br />4.4. In addition to the conditions set forth in this Terms of Use and Privacy Policy of the application, you
            agree to comply with and observe all applicable Facebook Terms and Conditions.
            <br />4.5. By accepting Facebook's Publish Actions permissions, you will authorize our application and website to publish
            creative content for you automatically on your behalf in your timeline. You will always be asked whether you
            want to give the permissions or not. We will never publish content on user's behalf without their consent.</p>
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