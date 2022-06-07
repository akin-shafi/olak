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

   <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
   <meta name="author" content="ParkerThemes">
   <link rel="shortcut icon" href="png/fav.png" />

   <title>Pet - Login</title>

   <link rel="stylesheet" href="css/bootstrap.min.css" />

   <link rel="stylesheet" href="css/main.css" />

</head>

<body class="authentication">

   <div class="container">

      <form method="post" action="">
         <div class="row justify-content-md-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
               <div class="login-screen">
                  <div class="login-box">
                     <a href="#" class="login-logo">
                        <!-- <img src="png/logo-dark.png" alt="Wafi Admin Dashboard" /> -->
                        Olak Pet.
                     </a>
                     <h5>Welcome back,<br />Please Login to your Account.</h5>

                     <p>
                        <?php echo display_session_message(); ?>
                     </p>
                     <p>
                        <?php if ($errors) : ?>
                           <?php echo display_errors($errors); ?>
                        <?php endif; ?>
                     </p>
                     <div class="form-group">
                        <input type="text" name="login[email]" class="form-control" placeholder="Email Address">
                     </div>
                     <div class="form-group">
                        <input type="password" name="login[password]" class="form-control" placeholder="Password" />
                     </div>
                     <div class="actions mb-4 ">
                        <div class="custom-control custom-checkbox d-none">
                           <input type="checkbox" class="custom-control-input" id="remember_pwd">
                           <label class="custom-control-label" for="remember_pwd">Remember me</label>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Login" />
                     </div>
                     <!-- <div class="forgot-pwd">
                        <a class="link" href="forgot-pwd.php">Forgot password?</a>
                     </div> -->
                     <hr>
                     <!-- <div class="actions align-left">
                        <span class="additional-link">Don't have an account?</span>
                        <a href="<?php echo url_for('signup.php') ?>" class="btn btn-dark">Create Account</a>
                     </div> -->
                     <a href="../">&leftarrow; Back</a>
                  </div>
               </div>
            </div>
         </div>
      </form>

   </div>

</body>

<!-- Mirrored from bootstrap.gallery/wafi-admin/dashboard-v2/topbar/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 09 Mar 2022 05:44:21 GMT -->

</html>