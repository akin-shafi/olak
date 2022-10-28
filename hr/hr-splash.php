<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome | IMS </title>
  <link rel="stylesheet" type="text/css" href="../bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../style.css">
  <link rel="shortcut icon" type="image/x-icon" href="../favicon.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;500&family=Poppins:wght@200;300;500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>
<style type="text/css">
  .welcome-box {
    left: 5px;
  }

  .grid-container {
    height: 72vh;
  }

  .aside-left h4 {
    font-size: 1rem;
  }

  @media (min-width:320px) {
    .w-50 {
      width: 100% !important;
    }
  }

  @media (min-width:640px) {

    .welcome h1 {
      font-size: 1.7rem;
      padding-top: 1rem;
    }

    .welcome-box {
      width: 100px;
      height: 100px;
    }

    .w-50 {
      width: 90% !important;
    }
  }

  @media (min-width:970px) {

    .w-50 {
      width: 50% !important;
    }

  }

  @media (min-width:1024px) {

    .welcome h1 {
      font-size: 2rem;
    }

    .w-50 {
      width: 50% !important;
    }
  }
  .bg-custom-blue{
    background-color: #133d80;
  }
</style>

<body>
  <div class="container shadow olak bg-white animate__animated animate__fadeIn">
    <header class="welcome pt-3">
      <h1 class="text-center animate__animated animate__fadeInDown animate__delay-0.5s">
        Welcome to Olak HR Admin Centre
      </h1>

      <div class="welcome-box animate__animated animate__fadeInLeft animate__delay-1s">
        <img src="../images/blue-top-left.png" title="Welcome" alt="Welcome">
      </div>
    </header>
    <main class="container grid-container">

      <div class="w-50 animate__animated animate__zoomInLeft animate__delay-1s">
        <img src="../images/hr-splash.png" class="hidden-xs img-fluid" title="banner balance" alt="banner balance">
      </div>

      <a href="./login.php" class="btn btn-lg bg-custom-blue text-light anchor animate__animated animate__rubberBand animate__delay-2s">
        Click <strong>HERE</strong> to Continue
      </a>
    </main>

    <div class="d-flex justify-content-between align-items-center pb-4">
      <a href="../" class="animate__animated animate__lightSpeedInLeft animate__delay-2s">&leftarrow; Back</a>
      <a href="#" class="custom-blue animate__animated animate__lightSpeedInRight animate__delay-2s">Developed by <strong>Sandsify Systems</strong></a>
    </div>
  </div>


  <!-- <script type="text/javascript" src="pwa.js"></script> -->
</body>

</html>