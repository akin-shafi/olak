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
  }

  @media (min-width:1024px) {

    .welcome h1 {
      font-size: 2rem;
    }

    .w-50 {
      width: 50% !important;
    }

  }
</style>

<body>
  <div class="container shadow olak bg-white">
    <header class="welcome pt-3">
      <h1 class="text-center">
        Welcome to Olak Accounting Admin Centre
      </h1>

      <div class="welcome-box">
        <img src="../images/blue-top-left.png" title="Welcome" alt="Welcome">
      </div>
    </header>
    <main class="container grid-container">

      <div class="w-50">
        <img src="../images/accounting-splash.png" class="hidden-xs img-fluid" title="banner balance" alt="banner balance">
      </div>

      <a href="./login.php" class="btn btn-lg bg-custom-blue text-light anchor">
        Click <strong>HERE</strong> to Continue
      </a>
    </main>

    <div class="d-flex justify-content-between align-items-center pb-4">
      <a href="../">&leftarrow; Back</a>
      <a href="#" class="custom-blue">Developed by <strong>Sandsify Systems</strong></a>
    </div>
  </div>


  <!-- <script type="text/javascript" src="pwa.js"></script> -->
</body>

</html>