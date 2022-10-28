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
         redirect_to(url_for('/dashboard/'));
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

<html lang="en" dir="ltr">

<head>
   <!-- Meta data -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
   <meta content="">
   <meta content="" name="author">
   <meta name="keywords" content="">
   <!-- Title -->
   <title>OLAK HRM</title>
   <!--Favicon -->
   <link rel="icon" href="assets/images/brand/favicon.ico" type="image/x-icon">
   <!-- Bootstrap css -->
   <link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
   <!-- Style css -->
   <link href="assets/css/style.css" rel="stylesheet">
   <link href="assets/css/boxed.css" rel="stylesheet">
   <link href="assets/css/dark.css" rel="stylesheet">
   <link href="assets/css/skin-modes.css" rel="stylesheet">
   <!-- Animate css -->
   <link href="assets/css/animated.css" rel="stylesheet">
   <!---Icons css-->
   <link href="assets/css/icons.css" rel="stylesheet">
   <!-- Select2 css -->
   <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
   <!-- P-scroll bar css-->
   <link href="assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet">
   <!-- INTERNAL Switcher css -->
   <link href="assets/switcher/css/switcher.css" rel="stylesheet">
   <link href="assets/switcher/demo.css" rel="stylesheet">

<body class="" _c_t_common="1">


   <div class="page login-bg">
      <div class="page-single">
         <div class="container">
            <div class="row">
               <div class="col mx-auto">
                  <div class="row justify-content-center">
                     <div class="col-md-7 col-lg-5">
                        <div class="card">
                           <div class="p-4 pt-6 text-center">
                              <h1 class="mb-2">Login</h1>
                              <p class="text-muted">Sign In to your account</p>
                           </div>
                           <?php if ($errors) : ?>
                              <?php echo display_errors($errors); ?>
                           <?php endif; ?>
                           <div class="card-body pt-3">
                              <form id="login" method="POST">
                                 <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <div class="input-group mb-4">
                                       <div class="input-group"> 
                                           <input type="email" name="login[email]" class="form-control" placeholder="Email"> 
                                          <span class="input-group-text"> <i class="fe fe-mail" aria-hidden="true"></i> </span> 
                                         
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <div class="input-group mb-4">
                                       <div class="input-group" id="Password-toggle"> 
                                          <input name="login[password]" class="form-control" type="password" placeholder="Password"> 
                                          <a href="" class="input-group-text"> <i class="fe fe-eye-off" aria-hidden="true"></i> </a> 
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group d-none"> <label class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1"> <span class="custom-control-label">Remember me</span> </label> </div>
                                 <div class="submit">
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                 </div>
                                 <div class="text-center mt-3 d-none">
                                    <p class="mb-2"><a href="#">Forgot Password</a></p>
                                    <p class="text-dark mb-0">Don't have account?<a class="text-primary ms-1" href="#">Register</a></p>
                                 </div>
                              </form>
                           </div>
                           <div class="card-body border-top-0 pb-6 pt-2 ">
                              <div class="text-center d-none"> <span class="avatar brround me-3 bg-primary-transparent text-primary"><i class="ri-facebook-line"></i></span> <span class="avatar brround me-3 bg-primary-transparent text-primary"><i class="ri-instagram-line"></i></span> <span class="avatar brround me-3 bg-primary-transparent text-primary"><i class="ri-twitter-line"></i></span> </div>
                              <a href="../">&leftarrow; Back</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


</body>

</html>