<?php
require_once('private/initialize.php');
$errors = [];
$email = '';
$password = '';
if (is_post_request()) {
   // $clients = $_POST['clients'] ?? '';
   $login = $_POST['login'] ?? '';

   $email = $login['email'] ?? '';
   $password = $login['password'] ?? '';

   // Validations
   if (is_blank($email)) {
      $errors[] = "Email cannot be blank.";
   }
   if (is_blank($password)) {
      $errors[] = "Password cannot be blank.";
   }


   // if there were no errors, try to login
   if (empty($errors)) {
      $admin = Admin::find_by_email($email);


      // test if admin found and password is correct
      if ($admin != false && $admin->verify_password($password)) {
         // Logged out Customer and riders before login in Admin
         $session->logout(true); //for admin logout
         $session->logout('', true); //for Riders logout

         // Mark admin as logged in
         $session->login($admin);

         //for logging actions in the log file
         log_action('Admin Login', "{$admin->full_name()} Logged in.", "login");
         redirect_to(url_for('/dashboard/hr-dashboard.php'));
      } else {
         // email not found or password does not match
         $errors[] = "Log in not successful.";
      }
      // end
   }
} else {
   $admin = new Admin;
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Welcome | IMS </title>
   <!-- <link rel="stylesheet" type="text/css" href="bootstrap.css"> -->
   <link rel="stylesheet" type="text/css" href="<?php echo url_for('../style.css') ?>">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="shortcut icon" type="image/x-icon" href="../favicon.png">

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;500&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;500&family=Poppins:wght@200;300;500&display=swap" rel="stylesheet">

</head>

<body>
   <style>
      .grid-container {
         height: auto;
      }
   </style>
   <div class="container shadow olak bg-white mt-5">
      <header class="welcome pt-3">
         <div class="welcome-box">
            <img src="../images/blue-top-right.png" title="Welcome" alt="Welcome">
         </div>
      </header>

      <main class="container grid-container">
         <div class="row">

            <aside class="col-md-6 grid aside-left">
               <div class="login-box mt-3">
                  <div class="login-header mb-5 text-center">
                     <h2 class="custom-blue">Login to Your Account</h1>
                        <h5 class="custom-blue">Your Own Digital HR Tool</h5>
                  </div>

                  <div class="login-body">
                     <form id="loginform" method="post">
                        <?php if ($errors) : ?>
                           <?php echo display_errors($errors); ?>
                        <?php endif; ?>

                        <div class="mb-3">
                           <label for="email" class="form-label custom-blue">Email Address</label>
                           <input type="email" class="form-control" name="login[email]" id="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-2">
                           <label for="password" class="form-label custom-blue">Password</label>
                           <input type="password" class="form-control" name="login[password]" id="password" placeholder="Enter your password">
                        </div>
                        <a href="#" class="custom-blue float-end text-decoration-none">Forgot password?</a>
                        <button type="submit" class="btn bg-custom-blue text-light my-4 w-100" id="submit">Login to your account</button>
                     </form>

                     <div class="text-center">
                        <a href="../" class="text-decoration-none">&leftarrow; Back</a>
                     </div>
                  </div>
               </div>


            </aside>

            <aside class="col-md-6 grid aside-right">
               <img src="../images/hr-splash.png" class="hidden-xs img-fluid" title="banner balance" alt="banner balance">
            </aside>
         </div>
      </main>
      <div class="d-flex justify-content-end align-items-center pb-4">
         <a href="#" class="custom-blue text-decoration-none">Developed by <strong>Sandsify Systems</strong></a>
      </div>
   </div>


   <script src="assets/js/jquery-3.6.0.min.js"></script>
   <script src="assets/js/bootstrap.bundle.min.js"></script>
   <!-- <script type="text/javascript" src="pwa.js"></script> -->
</body>

</html>