<?php require_once('private/initialize.php'); 
// ========== TO LOGIN ==========
$id = $_GET['id'] ?? '';
$errors = [];
$email = '';
$password = '';

if (is_post_request()) { 
  // $clients = $_POST['clients'] ?? '';
  $login = $_POST['login'] ?? '';
  if ($login) {

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
        // if ($admin->level !== 9) {
        redirect_to(url_for('redirect.php'));
        // }

      } else {
        // email not found or password does not match
        $errors[] = "Log in was unsuccessful.";
      }
      // end
      
    }
  }
} else {
  $admin = new Admin;
}
$page_title = 'Login | alphaPOS';
// ========== TO LOGIN END==========
$pc = gethostname();

$install = Installation::find_by_id(1);
// pre_r($install);
if ($install->hostname != $pc) {
redirect_to(url_for('installation.php'));
// echo header('Location: installation.php');
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" href="assets/images/icon.png"/>
        <script type="text/javascript">if (parent.frames.length !== 0) { top.location = 'login.html'; }</script>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
    <link href="assets/dist/css/styles.css" rel="stylesheet" type="text/css" />
    </head>
<body class="login-page login-page-<?php echo $company->color; ?> rtl rtl-inv">
    <div class="login-box">
        <div class="login-logo" style="color:#FFF; text-shadow: 2px 2px 2px black">
            <a href="index-2.html">alpha<b>POS</b></a>
            <h1 class="text-center" ><?php //echo Store::find_by_id(1)->category ?> <?php echo $company->company_name ?></h1>
        </div>
        <div class="btn-group d-flex justify-content-center mb-2">
          <a href="signin2.php" class="btn" style="color: #000; font-weight: bolder; border:1px solid whitesmoke ">Sales Login</a>
          <a class="btn" href="signin1.php"  style="color: #000; font-weight: bolder; background: whitesmoke">Admin Login</a>
        </div>
        <div class="login-box-body">
               <p class="login-box-msg">Please login to your account.</p>
            
                <form method="post">
                    <?php if ($errors) { ?>
                        <div class="p-2 alert-light mb-3 rounded">
                          <?php echo display_errors($errors); ?> 
                          
                        </div>
                      <?php } ?>
                    <div class="form-group has-feedback">
                        <label><strong>Email</strong></label>
                        <input type="email" class="form-control" placeholder="Email" name="login[email]">
                    </div>
                    <div class="form-group has-feedback">
                        <label><strong>Password</strong></label>
                        <input type="password" class="form-control" placeholder="Password" name="login[password]">
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn  btn-block">Sign me in</button>
                    </div>
                    <div class="new-account mt-3">
                        <p class="text-center"> <i class="fa fa-arrow-left"></i> <a class="text-primary" href="../index.php">Back</a></p>
                    </div>
                </form>
            
        </div>

        
    </div>

    <script src="pwa.js"></script>
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
        $(function () {
            if ($('#identity').val())
                $('#password').focus();
            else
                $('#identity').focus();
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
</body>


</html>
