<?php
require_once('private/initialize.php');


$errors = [];
$email = '';
$password = '';

if (is_post_request()) {
   $args = $_POST['reg'];
   $args['created_by'] = 1;
   $args['admin_level'] = 1;

   $admin = new Admin($args);
   $admin->save();
   if ($admin == true) {
      $session->message('Account created successfully!.');
   }
   redirect_to(url_for('login.php'));
} else {
   $admin = new Admin;
}
?>

<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <meta name="description" content="Sandsify System">
   <meta name="author" content="ParkerThemes">
   <link rel="shortcut icon" href="png/fav.png" />

   <title>Wafi Admin Template - Login</title>
   <link rel="stylesheet" href="css/bootstrap.min.css" />

   <link rel="stylesheet" href="css/main.css" />

</head>

<body class="authentication">

   <div class="container">

      <form method="post">
         <div class="row justify-content-md-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
               <div class="login-screen">
                  <div class="login-box">
                     <a href="#" class="login-logo">
                        <!-- <img src="png/logo-dark.png" alt="Wafi Admin Dashboard" /> -->
                        Olak Pet.
                     </a>
                     <h5>Kindly fill out the form as required!</h5>

                     <p>
                        <?php if ($errors) : ?>
                           <?php echo display_errors($errors); ?>
                        <?php endif; ?>
                     </p>
                     <div class="row">
                        <div class="col-md-12">
                           <label for="fName" class="col-form-label">Full Name</label>
                           <input type="text" class="form-control" name="reg[full_name]" id="fName" placeholder="Full name">
                        </div>
                        <div class="col-md-12">
                           <label for="email" class="col-form-label">Email</label>
                           <input type="text" class="form-control" name="reg[email]" id="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-12">
                           <label for="phone" class="col-form-label">Phone</label>
                           <input type="tel" class="form-control" name="reg[phone]" id="phone" placeholder="Phone number" required>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="password" class="col-form-label">Password</label>
                              <input type="password" class="form-control" name="reg[password]" id="password" value="12345" placeholder="12345" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="cPass" class="col-form-label">Confirm password</label>
                              <input type="password" class="form-control" name="reg[confirm_password]" id="cPass" value="12345" placeholder="12345" required>
                           </div>
                        </div>
                        <div class="m-auto">
                           <input type="submit" class="btn btn-primary" value="Register" />
                        </div>
                     </div>
                     <hr>
                     <div class="actions align-left">
                        <span class="additional-link">Already have an account?</span>
                        <a href="<?php echo url_for('login.php') ?>" class="btn btn-dark">Login here</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>

   </div>

</body>

<!-- Mirrored from bootstrap.gallery/wafi-admin/dashboard-v2/topbar/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 09 Mar 2022 05:44:21 GMT -->

</html>