<?php require_once('private/initialize.php'); 


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
      $errors[] = "Username cannot be blank.";
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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" href="assets/images/icon.png"/>
    <script type="text/javascript">if (parent.frames.length !== 0) { top.location = 'login.php'; }</script>
    <link href="assets/dist/css/main.css" rel="stylesheet" type="text/css" />
    <link href="assets/dist/css/styles.css" rel="stylesheet" type="text/css"> 
    <style>
      h1 { margin-top: 150px; text-align: center; color: #fff; }
      .lead { margin: 30px auto; text-align: center; color: #fff; }
      .alert, .show{display: none;}
    </style>
  </head>

   <style type="text/css">
    .form-control {
      padding: 0 20px;
      border-radius: 5px;
      width: 350px;
      margin: auto;
      border: 1px solid rgb(228, 220, 220);
      outline: none;
      font-size: 40px;
      color: #aaa;
      text-shadow: 0 0 0 rgb(71 71 71);
    }
  </style>

<body class="login-page login-page-<?php echo $company->color; ?> rtl rtl-inv">


<div class="jquery-script-clear"></div>
</div>
</div>
    <div id="pinpad" style="height: 100vh" class=" d-flex justify-content-center align-items-center ">

      <div class="d-flex justify-content-center">
        <div class="d-flex justify-content-center align-items-center p-4">
          
          <section>
            <div class="login-logo" style="color:#FFF; text-shadow: 2px 2px 2px black">
              <a href="index-2.html">alpha<b>POS</b></a>
            </div>
           <div class="btn-group d-flex justify-content-center mb-2">
            <a href="signin2.php" class="btn" style="color: #000; font-weight: bold; background: whitesmoke; ">Sales Login</a>
            <a class="btn" href="signin1.php"  style="color: #000; font-weight: bold; border:1px solid whitesmoke; ">Admin Login</a>
          </div>

            <div class="coy_title" >
              <div class="p-4 m-4 text-uppercase"  style="border: 8px dotted #aaa; font-size: 40px; font-weight: bold;text-shadow: "><?php echo $company->company_name ?> </div>
              <!-- <h3 class="text-center h1" >Login</h3> -->
            </div>
          </section>
        </div>
        <div >
          
          
            <form method="post" class="text-center mt-3">
              <?php if ($errors) { ?>
                <div class="p-2 alert-light mb-3 rounded">
                  <?php echo display_errors($errors); ?> 
                  
                </div>
              <?php } ?>
              <select class="form-input" name="login[email]">
                <option value="">Username</option>
                 <?php foreach (Admin::find_by_undeleted() as $admin) { ?>
                  <?php if (in_array($admin->admin_level, [4,6])) { ?>
                    <option value="<?php echo $admin->email; ?>"><?php echo $admin->first_name; ?></option>
                  <?php } ?>
                   
                 <?php } ?>
              </select>
              <input type="password" id="password"  placeholder="Password" name="login[password]"/></br></br>
              <input type="button" value="1" id="1" class="pinButton calc"/>
              <input type="button" value="2" id="2" class="pinButton calc"/>
              <input type="button" value="3" id="3" class="pinButton calc"/><br>
              <input type="button" value="4" id="4" class="pinButton calc"/>
              <input type="button" value="5" id="5" class="pinButton calc"/>
              <input type="button" value="6" id="6" class="pinButton calc"/><br>
              <input type="button" value="7" id="7" class="pinButton calc"/>
              <input type="button" value="8" id="8" class="pinButton calc"/>
              <input type="button" value="9" id="9" class="pinButton calc"/><br>
              <input type="button" value="clear" id="clear" class="pinButton clear"/>
              <input type="button" value="0" id="0 " class="pinButton calc"/>
              <input type="submit" value="enter" id="enter" class="pinButton enter"/>
            </form>
        </div>
      </div>
    </div>
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
   <script src="assets/dist/js/app.js"></script>

 <!--   <script type="text/javascript">
       $(document).on('click', '#enter', function(e){
            e.preventDefault()
            $.ajax({
                url: 'process_login.php',
                method: 'post',
                 data: $('#form').serialize(),
                  success: function(r) {
                      if(r == 'success') {
                          window.location.href = "redirect.php";
                      }else{
                          $('.show').css('display', 'flex');
                          $('#errors').html(r);
                      }
                  }
            });
        });
   </script> -->
  </body>
</html>
