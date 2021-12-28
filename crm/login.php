
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="uploads/thumbnail/clou_logo_thumb-100x72.png">
    
        <title>Accufy - Login</title>
  
    <link rel="stylesheet" href="assets/admin/css/bootstrap.min.css">
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="assets/admin/css/bootstrap-extend.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="assets/admin/css/admin_style.css?var=2.0&time=1639740574">

    <link rel="stylesheet" href="assets/front/css/simple-line-icons.css">
    <link href="assets/admin/css/sweet-alert.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Alata&display=swap', 'Quicksand:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/front/css/aos.css" />
    <style type="text/css">
      body{
        font-family: Alata, 'sans-serif';
      }
    </style>

    <script type="text/javascript">
       var csrf_token = 'cf4a7ac46501fd09e08e083345338791';
       var token_name = 'csrf_test_name'
    </script>
    
</head>

<body class="hold-transition login-page">

<div class="auth-box">

  <div class="login-box">

    <div class="login-logo" data-aos="fade-up" data-aos-duration="300">
              <a href="#" style="color: #1054B6">
                <img width="50%" class="circles" src="../logo-1.png" width="150" height="auto">
                
              </a>
              <h3 class="text-center">Consolidated Management Reports</h3>
              
          </div>

    <div class="mb-4 mt-4">
        <div class="success text-success"></div><div class="error text-danger" style="display: none;"></div><div class="warning text-warning"></div>
    </div>
    
    <!-- /.login-logo -->
    <div id="login-area" class="login-box-body" data-aos="fade-up" data-aos-duration="400">

      <p class="login-box-msg">Sign in</p>
      <form id="login-form" method="post" action="auth/log">

        <div class="form-group has-feedback">
          <input type="text" name="user_name" class="form-control log" placeholder="Username or email">
          <span class="ion ion-email form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control log" placeholder="Password">
          <span class="ion ion-locked form-control-feedback"></span>
          <!-- <a class="pull-right forgot_pass" href="#">Forgot password?</a> -->
        </div>

        <div class="row">
          <!-- csrf token -->
          <input type="hidden" name="csrf_test_name" value="cf4a7ac46501fd09e08e083345338791">
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-info btn-block signin_btn">Sign in</button> 
            <a class="create" href="../">Back</a>
          </div> 
        </div>
      </form>
      <!-- /.social-auth-links -->

      <div class="margin-top-30 text-center">
      </div>

    </div>
    <!-- /.login-box-body -->

      <div class="alert alert-info mt-4 d-none" role="alert" data-aos="fade-up" data-aos-duration="500">
        <div class="row">
          <div class="col-md-6">
            <h4 class="alert-heading">Admin Access</h4>
            <p class="mb-0">admin</p>
            <p class="mb-0">1234</p>
          </div>
          <div class="col-md-6">
            <h4 class="alert-heading">User Access</h4>
            <p class="mb-0">user</p>
            <p class="mb-0">1234</p>
          </div>
        </div>
      </div>
    
    <!-- forgot area -->
    <div id="forgot-area" class="login-box-body" style="display: none;">
      <p class="login-box-msg">Recover password</p>

      <form id="lost-form" method="post" action="auth/forgot_password">

        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control log" placeholder="Enter your email">
          <span class="ion ion-email form-control-feedback"></span>
          <a class="pull-right back_login" href="#"><i class="fa fa-angle-left"></i> Back</a>
        </div>

        <div class="row">
          <!-- csrf token -->
          <input type="hidden" name="csrf_test_name" value="cf4a7ac46501fd09e08e083345338791">
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-info btn-block margin-top-10 signin_btn">SUBMIT</button> 
          </div> 
        </div>
      </form>
      <!-- /.social-auth-links -->

      <div class="margin-top-30 text-center">
      </div>

    </div>
  </div>


</div>
<!-- /.login-box -->

  <input type="hidden" class="msg_opps" value="Oops">
<input type="hidden" class="msg_error" value="Error">
<input type="hidden" class="msg_success" value="Success!">
<input type="hidden" class="msg_sorry" value="Sorry!">
<input type="hidden" class="msg_yes" value="Yes">
<input type="hidden" class="msg_congratulations" value="Congratulation's">
<input type="hidden" class="msg_something_wrong" value="Something wrong">
<input type="hidden" class="msg_try_again" value="Try again">
<input type="hidden" class="msg_valid_user_msg" value="">
<input type="hidden" class="msg_password_reset_msg" value="">
<input type="hidden" class="msg_password_reset_success_msg" value="Your Password has been changed Successfully">
<input type="hidden" class="msg_confirm_pass_not_match_msg" value="Your Confirm Password doesn't Match">
<input type="hidden" class="msg_old_password_doesnt_match" value="Your Old Password doesn't Match">
<input type="hidden" class="msg_inserted" value="Inserted Successfully">
<input type="hidden" class="msg_made_changes_not_saved" value="You have made some changes and it's not saved?">
<input type="hidden" class="msg_no_data_founds" value="No data founds">
<input type="hidden" class="msg_del_success" value="Deleted successfully">
<input type="hidden" class="msg_account_suspend_msg" value="Your account has been suspended!">
<input type="hidden" class="msg_are_you_sure" value="Are you sure?">
<input type="hidden" class="msg_get_started" value="Get Started">
<input type="hidden" class="msg_not_recover_file" value="You will not be able to recover this file">
<input type="hidden" class="msg_deleted_successfully" value="Deleted successfully">
<input type="hidden" class="msg_data_limit_over" value="Data limit has been over">
<input type="hidden" class="msg_email_exist" value="This email already exist, try another one">
<input type="hidden" class="msg_recaptcha_is_required" value="Recaptcha is required">


<input type="hidden" class="msg_not_active" value="Your account is not active">
<input type="hidden" class="msg_signin" value="Sign in">
<input type="hidden" class="msg_signing_in" value="Signing in ...">

<input type="hidden" class="msg_wrong_access" value="Sorry your username or password is not correct!">
<input type="hidden" class="msg_email_not_verified" value="Your email is not verified, Please verify your email">
<input type="hidden" class="msg_pass_sent_email" value="We've sent a password to your email address. Please check your inbox">
<input type="hidden" class="msg_pass_reset_succ" value="Password Reset Successfully !">
<input type="hidden" class="msg_not_valid_user" value="You are not a valid user">
  <input type="hidden" id="base_url" value="">
  <!-- jQuery 3 -->
  <script src="assets/admin/js/jquery.min.js"></script> 
  <!-- popper -->
  <script src="assets/admin/js/popper.min.js"></script>
  <!-- Bootstrap 4.0-->
  <script src="assets/admin/js/bootstrap.min.js"></script>
  <script src="assets/admin/js/admin.js"></script>
  <script src="assets/admin/js/sweet-alert.min.js"></script>

  <script src="assets/front/js/aos.js"></script>
  <script>
    AOS.init();
  </script>
  
  <script type="text/javascript">
    $(document).ready(function(){

      var loader_btn = '<div class="spinners"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
      
      var msg_error = $('.msg_error').val();
      var msg_sorry = $('.msg_sorry').val();
      var msg_success = $('.msg_success').val();
      var msg_signin = $('.msg_signin').val();
      var msg_signing_in = $('.msg_signing_in').val();
      var msg_try = $('.msg_try').val();

      var msg_not_active = $('.msg_not_active').val();
      var msg_account_suspend = $('.msg_account_suspend_msg').val();
      var msg_wrong_access = $('.msg_wrong_access').val();
      var msg_email_not_verified = $('.msg_email_not_verified').val();
      var msg_pass_sent_email = $('.msg_pass_sent_email').val();
      var msg_pass_reset_succ = $('.msg_pass_reset_succ').val();
      var msg_not_valid_user = $('.msg_not_valid_user').val();

      
      $(document).on('submit', "#login-form", function() {

        $(".signin_btn").html('<span class="spinner-btn-sm"></span> '+msg_signing_in);
        $(".signin_btn").prop('disabled', true);

        $.post($('#login-form').attr('action'), $('#login-form').serialize(), function(json){
            if (json.st == 1) {
                window.location = json.url;
            }else if (json.st == 0) {
                $(".signin_btn").prop('disabled', false);
                $(".signin_btn").html(msg_signin);
                $(".error").show().html('<i class="icon-exclamation"></i> '+msg_wrong_access);
                $('#login_pass').val('');
            }else if (json.st == 2) {
                $(".signin_btn").prop('disabled', false);
                $(".signin_btn").html(msg_signin);
                $(".error").show().html('<i class="icon-exclamation"></i> '+msg_not_active);
            }else if (json.st == 3) {
                $(".signin_btn").prop('disabled', false);
                $(".signin_btn").html(msg_signin);
                $(".error").show().html('<i class="icon-exclamation"></i> '+msg_account_suspend);
            }else if (json.st == 4) {
                $(".signin_btn").prop('disabled', false);
                $(".signin_btn").html(msg_signin);
                $(".error").show().html('<i class="icon-exclamation"></i> '+msg_email_not_verified);
            }

        },'json');
        return false;
      });

      //recover password form
      $(document).on('submit', "#lost-form", function() {
          $.post($('#lost-form').attr('action'), $('#lost-form').serialize(), function(json){
              
              if ( json.st == 1 ){
                  swal({
                    title: msg_pass_reset_succ,
                    text: msg_pass_sent_email,
                    type: "success",
                    showConfirmButton: true
                  }, function(){
                    window.location = json.url;
                  });
              } else {
                swal({
                  title: msg_sorry,
                  text: msg_not_valid_user,
                  type: "error",
                  confirmButtonText: msg_try
                });
              }
          },'json');
          return false;
      });


      $(document).on('click', ".forgot_pass", function() {
          $('#login-area').slideUp();
          $('#forgot-area').slideDown();
      });

      $(document).on('click', ".back_login", function() {
          $('#login-area').slideDown();
          $('#forgot-area').slideUp();
      });


    });
  </script>
</body>
</html>
