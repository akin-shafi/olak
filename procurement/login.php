<?php
require_once('private/initialize.php');


$errors = [];
$email = '';
$password = '';

if (is_post_request()) {
   $login = $_POST['login'] ?? '';

   $email = $login['email'] ?? '';
   $password = $login['password'] ?? '';

   if (is_blank($email)) {
      $errors[] = "Email cannot be blank.";
   }
   if (is_blank($password)) {
      $errors[] = "Password cannot be blank.";
   }

   if (empty($errors)) {
      $admin = Admin::find_by_email($email);

      if ($admin != false && $admin->verify_password($password)) {
         $session->logout(true);
         $session->logout('', true);

         $session->login($admin);

         log_action('Admin Login', "{$admin->full_name} Logged in.", "login");
         redirect_to(url_for('/dashboard/'));
      } else {
         $errors[] = "Log in not successful.";
      }
   }
} else {
   $admin = new Admin;
}
?>

<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>POS Dash | Responsive Bootstrap 4 Admin Dashboard Template</title>

   <!-- Favicon -->
   <link rel="shortcut icon" href="ico/favicon.ico" />
   <link rel="stylesheet" href="css/backend-plugin.min.css">
   <link rel="stylesheet" href="css/backende209.css?v=1.0.0">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/line-awesome.min.css">
   <link rel="stylesheet" href="css/remixicon.css">
</head>

<body class=" ">

   <style>
      /* .login-content .auth-card .auth-content {
         min-height: 400px !important;
         height: 100% !important;
      } */
   </style>
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->

   <div class="wrapper">
      <section class="login-content">
         <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
               <div class="col-lg-8">

                  <div class="card auth-card">
                     <div class="card-body p-0">
                        <?php if ($errors) : ?>
                           <?php echo display_errors($errors); ?>
                        <?php endif; ?>
                        <div class="d-flex align-items-center auth-content">
                           <div class="col-lg-7 align-self-center">
                              <div class="p-3">
                                 <h2 class="mb-2">Sign In</h2>
                                 <p>Login to stay connected.</p>
                                 <form method="post">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input type="email" name="login[email]" class="floating-input form-control" autofocus placeholder="olak@mail.com">
                                             <label>Email</label>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input type="password" name="login[password]" class="floating-input form-control" placeholder="*******">
                                             <label>Password</label>
                                          </div>
                                       </div>
                                       <!-- <div class="col-lg-6">
                                          <div class="custom-control custom-checkbox mb-3">
                                             <input type="checkbox" class="custom-control-input" id="customCheck1">
                                             <label class="custom-control-label control-label-1" for="customCheck1">Remember Me</label>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <a href="auth-recoverpw.html" class="text-primary float-right">Forgot Password?</a>
                                       </div> -->
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                    <!-- <p class="mt-3">
                                       Create an Account <a href="auth-sign-up.html" class="text-primary">Sign Up</a>
                                    </p> -->
                                 </form>
                              </div>
                              <a href="<?php echo url_for('../') ?>">&leftarrow; Back</a>
                           </div>
                           <div class="col-lg-5 content-right">
                              <img src="png/01-2.png" class="img-fluid image-right" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>

   <!-- Backend Bundle JavaScript -->
   <script src="js/backend-bundle.min.js"></script>

   <!-- Table Treeview JavaScript -->
   <script src="js/table-treeview.js"></script>

   <!-- Chart Custom JavaScript -->
   <script src="js/customizer.js"></script>

   <!-- Chart Custom JavaScript -->
   <script async src="js/chart-custom.js"></script>

   <!-- app JavaScript -->
   <script src="js/app.js"></script>
</body>

<!-- Mirrored from templates.iqonic.design/posdash/html/backend/auth-sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 09 Mar 2022 06:08:53 GMT -->

</html>