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

      log_action('Admin Login', "{$admin->full_name()} Logged in.", "login");
      redirect_to(url_for('/dashboard/business.php'));
    } else {
      $errors[] = "Log in not successful.";
    }
  }
} else {
  $admin = new Admin;
}


$page_title = 'BookMyCash - Login';
include(SHARED_PATH . '/auth_header.php');
?>

<div class="auth-box">

  <div class="login-box">

    <div class="login-logo" data-aos="fade-up" data-aos-duration="300">
      <a href="#" style="color: #1054B6">
        BookMyCash

      </a>
      <h3 class="text-center">Accounting</h3>

    </div>

    <div class="mb-4 mt-4">
      <div class="success text-success"></div>
      <div class="error text-danger" style="display: none;"></div>
      <div class="warning text-warning"></div>
    </div>

    <div id="login-area" class="login-box-body" data-aos="fade-up" data-aos-duration="400">

      <p class="login-box-msg">Sign in</p>

      <?php if ($errors) : ?>
        <?php echo display_errors($errors); ?>
      <?php endif; ?>

      <form id="login-form" method="post" action="">

        <div class="form-group has-feedback">
          <input type="text" name="login[email]" class="form-control log" placeholder="Enter your email">
          <span class="ion ion-email form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" name="login[password]" class="form-control log" placeholder="Password">
          <span class="ion ion-locked form-control-feedback"></span>
          <!-- <a class="pull-right forgot_pass" href="#">Forgot password?</a> -->
        </div>

        <div class="row">

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-info btn-block signin_btn">Sign in</button>
            <a class="create" href="../">Back</a>
          </div>
        </div>
      </form>

      <div class="margin-top-30 text-center">
      </div>

    </div>



    <div id="forgot-area" class="login-box-body" style="display: none;">
      <p class="login-box-msg">Recover password</p>

      <form id="lost-form" method="post" action="auth/forgot_password">

        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control log" placeholder="Enter your email">
          <span class="ion ion-email form-control-feedback"></span>
          <a class="pull-right back_login" href="#"><i class="fa fa-angle-left"></i> Back</a>
        </div>

        <div class="row">
          <input type="hidden" name="csrf_test_name" value="cf4a7ac46501fd09e08e083345338791">
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-info btn-block margin-top-10 signin_btn">SUBMIT</button>
          </div>
        </div>
      </form>

      <div class="margin-top-30 text-center">
      </div>

    </div>
  </div>


</div>

<?php include(SHARED_PATH . '/auth_footer.php') ?>