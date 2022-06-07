<?php
require_once('private/initialize.php'); ?>

<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <meta name="description" content="Sandsify System">
   <meta name="author" content="ParkerThemes">
   <link rel="shortcut icon" href="png/fav.png" />

   <title>Pet - Notification</title>

   <link rel="stylesheet" href="css/bootstrap.min.css" />

   <link rel="stylesheet" href="css/main.css" />

</head>

<body class="authentication">

   <div class="container">

      <form method="post" action="">>
         <div class="row justify-content-md-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
               <div class="login-screen">
                  <div class="login-box">
                     <h1 class="text-center text-danger">&#33;</h1>
                     <a href="#" class="login-logo justify-content-center">
                        Olak Pet.
                     </a>
                     <div class="mb-4 text-center">
                        Entry Closes for the Day.
                     </div>

                     <a href="<?php echo url_for('/') ?>">&leftarrow; Back</a>
                  </div>
               </div>
            </div>
         </div>
      </form>

   </div>

</body>

</html>