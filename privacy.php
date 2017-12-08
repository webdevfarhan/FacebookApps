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
          <p>The text shows terms of service and privacy policy for the application used in
            <?=$url?>, This policy describes as application uses and protects the information given by users to the application.
              <?=$url?>
              is committed to ensuring that your privacy is protected. When we asked you to give us certain information when
                authenticating to the application, and certain permits are requested through dialogue Facebook, you can be
                sure that the information will only be used in compliance with this policy.

                <?=$url?> can change its policies at any given time through this section. This privacy policy was last updated on April
                  14, 2017. If we make changes to the site can also be changes to policies and it is our duty to review these
                  changes to ensure that it complies with all the terms of our policies.</p>

          <h1>What information do we collect?</h1>
          <p>We will collect the following information from your profile:</p>
          <li>We collect basic information from your profile, mainly the name, gender and Facebook ID to get the profile picture
            used in certain tests.</li>

          <h1>What will we do with the information collected?</h1>
          <p>We require this information to understand your needs and improve the user experience with the application and particularly
            for the reasons below:</p>
          <li>We collect the basic information to create entertaining photo later to be shared with your friends on Facebook.</li>

          <h1>How Do We protect your information?</h1>
          <p>We guarantee and ensure the best possible way your information is secure. The use of information is temporary pending
            the results of the tests are processed.</p>
          <li>We never store any sensitive or private user information such as name, gender, email or facebook id.</li>

          <h1>Do We Disclose information to third parties?</h1>
          <p>We do not sell, trade or transfer in any way your information to third parties.
            <?=$url?> is not responsible for any illegal activity on Facebook. We do not got any information to Facebook. By using
              this site you are assuming compliance with our policies.</li>
              <!--
<h1>Third Party Advertising and Cookies :</h1>
     <p>Advertising companies can use and collect anonymous information about your interests to personalize the content of the advertisements. Information such as location or interests can be linked to your device, but is not linked to your identity. These companies have their own privacy policies. Click on the links to view the policies of these sites:</p>
<li><a href="http://whos.amung.us/legal/privacy/">Whos Amung Us Privacy Policy</a></li>
</p>Through our privacy policy you are aware of the proper conditions of use on this site.
The use of these implies full and unreserved acceptance of each and every one of the provisions included in this Legal Notice, so if you disagree with any of the conditions set forth herein shall not use and / or access this site.We reserve the right to modify this Privacy Statement at any time. Your continued use of any portion of this site following notification or posting of such modifications will constitute your acceptance of such changes.</p>
-->
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