<!DOCTYPE html>
<html>
<title>
  <?=$siteNAME?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link rel="stylesheet" href="../../css/w3.css">
<link rel="stylesheet" href="../../css/1.css">
<link rel="stylesheet" href="../../css/2.css">
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

  .loader {
    border: 16px solid #F1F1F1;
    border-radius: 50%;
    border-top: 16px solid #3b5998;
    border-bottom: 16px solid #3b5998;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }

  @-webkit-keyframes spin {
    0% {
      -webkit-transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
</style>
<center>
  <?=$navbar?>
</center>

<body class="w3-light-grey w3-content" style="max-width:1600px;">
  <div class="w3-main">
    <center>
      <div class="w3-card-4">
        <?=$whusamung?>
          <header class="w3-container w3-teal">
            <h1 style="color:white;">Please Wait...</h1>
            <br />
          </header>
          <div class="w3-card-12 w3-margin" style="width:90%">
            <div class="w3-container w3-center loader">
            </div>
            <h3>Generating Your Result...</h3>
          </div>
      </div>
    </center>
  </div>
</body>

</html>
