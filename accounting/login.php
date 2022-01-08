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
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <title>Login - HRMS admin template</title>
      <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.min.js"></script>
      <script src="assets/js/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="account-page">
      <div class="main-wrapper">
         <div class="account-content">
            <!-- <a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a> -->
            <div class="container">
               <div class="account-logo">
                  <a href="index.html"><img src="assets/img/logo-1.png" alt="HRMS"></a>

               </div>
               <div class="account-box">
                  <div class="account-wrapper">
                     <!-- <h3>HRMS</h3> -->
                     <h3 class="account-title">Financial Record System</h3>
                     <p class="account-subtitle">Login to your dashboard</p>
                     <form id="loginform" method="post">
                        <?php if ($errors) { ?>
                         
                           <?php echo display_errors($errors); ?> 
                           
                         
                       <?php } ?>
                        <div class="form-group">
                           <label>Email Address</label>
                           <input class="form-control" name="login[email]" type="text">
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col">
                                 <label>Password</label>
                              </div>
                              <div class="col-auto d-none">
                                 <a class="text-muted" href="forgot-password.html">
                                 Forgot password?
                                 </a>
                              </div>
                           </div>
                           <input class="form-control" name="login[password]" type="password">
                        </div>
                        <div class="form-group text-center">
                           <button class="btn btn-primary account-btn" id="submit" type="submit">Login</button>
                        </div>
                        <div class="text-center"><a href="../" class=" text-underline">Back</a></div>
                        <div class="account-footer d-none">
                           <p>Don't have an account yet? <a href="register.html">Register</a></p>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="./hr/assets/js/jquery-3.6.0.min.js"></script>
      <script src="./hr/assets/js/bootstrap.bundle.min.js"></script>
      <!-- <script src="./hr/assets/js/app.js"></script> -->
      <script type="text/javascript">
         // $(document).on("submit", "#loginform", function(e) {
         //    e.preventDefault();
         //    $("#submit").html('Processing...')
         //    $.ajax({
         //          url: 'index.php',
         //          method:"POST",
         //          data: $(this).serialize(),
         //          dataType: 'json',
         //          success: function (data) {
         //             if (data.success == true) {
         //                // successAlert(data.msg);
         //                location.href = 'dashboard/'
         //              }else{
         //                errorAlert(data.msg);
         //                $("#submit").html('Login')
         //             }
         //          }
         //      })
         // })
      </script>
   </body>
</html>
