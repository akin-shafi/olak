
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="uploads/thumbnail/clou_logo_thumb-100x72.png">
    
        <title>BookMyCash - Login</title>
  
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
    </script>
    
</head>

<body class="hold-transition login-page">

<div class="auth-box">

  <div class="login-box">

    <div class="login-logo" data-aos="fade-up" data-aos-duration="300">
              <a href="#" style="color: #1054B6">
                BookMyCash
                
              </a>
              <h3 class="text-center">Accounting</h3>
              
          </div>

    <div class="mb-4 mt-4">
        <div class="success text-success"></div><div class="error text-danger" style="display: none;"></div><div class="warning text-warning"></div>
    </div>
    
    <!-- /.login-logo -->
    <div id="login-area" class="login-box-body" data-aos="fade-up" data-aos-duration="400">

      <p class="login-box-msg">Sign in</p>
      <form id="login-form" method="post" action="">

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

</body>
</html>
