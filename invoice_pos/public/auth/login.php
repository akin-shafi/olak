<?php require_once('../../private/initialize.php') ?>
<?php

$errors = [];
$email = '';
$password = '';

if (is_post_request()) {

  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  echo $email;
  // Validations
  if (is_blank($email)) {
    $errors[] = "Email field is required.";
  }

  if (is_blank($password)) {
    $errors[] = "Password field is required.";
  }

  // if there were no errors, try to login
  if (empty($errors)) {
    $admin = Admin::find_by_email($email);
    // test if admin found and password is correct
    if ($admin != false && $admin->verify_password($password)) {
      // ! Logged out Customer and others before login in Admin
      $session->logout(); //for admin logout

      // ? Mark admin as logged in
      $session->login($admin);

      // ? for logging actions in the log file
      log_action('Login', "{$admin->full_name()} Logged in.", "login");

      redirect_to(url_for('auth/redirect.php'));
    } else {
      // $email not found or password does not match
      $errors[] = "Log in was unsuccessful.";
    }
  }
}

?>

<?php include(SHARED_PATH . '/auth_header.php') ?>


<!-- Container start -->
<div class="container">

  <form method="post">
    <div class="row justify-content-md-center">
      <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
        <div class="login-screen">
          <div class="login-box">
            <a href="#" class="login-logo rainbowText">
              InvoicePOS
              <!-- <span class="text-danger">A</span><span class="text-warning">u</span><span class="text-success">t</span><span class="text-info">o</span><span class="text-royal-orange">C</span><span class="text-jungle-green">r</span><span class="text-danger">a</span><span class="text-success">f</span><span class="text-jungle-green">t</span> -->
            </a>
            <?php if (display_errors($errors)) { ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo display_errors($errors); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            <?php } ?>

            <h5>Welcome back,<br />Please Login to your Account.</h5>
            <div class="form-group">
              <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Email Address" />
            </div>
            <div class="form-group">
              <input type="password" name="password" value="" class="form-control" placeholder="Password" />
            </div>
            <div class="actions">
              <a href="<?php echo url_for('forgotPassword.php'); ?>">Recover password</a>
              <button type="submit" class="btn btn-info">Login</button>
            </div>
            <div class="m-0 d-none">
              <span class="additional-link">No account? <a href="<?php echo url_for('auth/signup.php'); ?>">Signup Now</a></span>
            </div>
            <a href="../../../">&leftarrow; Back</a>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>
<!-- Container end -->
<script type="text/javascript">
  window.addEventListener("load", function() {
    var elements = document.getElementsByClassName("rainbowText");
    for (let i = 0; i < elements.length; i++) {
      generateRainbowText(elements[i]);
    }
  });

  function generateRainbowText(element) {
    var text = element.innerText;
    element.innerHTML = "";
    for (let i = 0; i < text.length; i++) {
      let charElem = document.createElement("span");
      charElem.style.color = "hsl(" + (360 * i / text.length) + ",80%,50%)";
      charElem.innerHTML = text[i];
      element.appendChild(charElem);
    }
  }
</script>
<?php include(SHARED_PATH . '/auth_footer.php') ?>