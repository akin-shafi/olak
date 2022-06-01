<?php
require_once('../private/initialize.php');

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
         redirect_to(url_for('sales/'));
      } else {
         $errors[] = "Log in not successful.";
      }
   }
} else {
   $admin = new Admin;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login - Aroma</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap"
    rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
  <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="assets/mp4/bg.mp4" type="video/mp4" />
  </video>
  <div class="masthead">
    <div class="masthead-content text-white">
      <div class="container-fluid px-4 px-lg-0">
        <h1 class="fst-italic lh-1 mb-4">AROMA FOOD</h1>
        <?php if ($errors) : ?>
           <?php echo display_errors($errors); ?>
        <?php endif; ?>
        <form id="contactForm"  method="post">
          <div class="row input-group-newsletter">
            <div class="col-12 mb-2">
              <input class="form-control" name="login[email]" required type="email" placeholder="Enter email address..."
                aria-label="Enter email address..." />
            </div>
            <div class="col-12 mb-2">
              <input class="form-control" name="login[password]" type="password" placeholder="Enter password"
                aria-label="Password" required />
            </div>
            <div class="col-12 ">
              <button class="btn btn-danger w-100" type="submit">Login</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
  <!-- <div class="social-icons">
    <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
      <a class="btn btn-dark m-3" href="#!"><i class="fab fa-twitter"></i></a>
      <a class="btn btn-dark m-3" href="#!"><i class="fab fa-facebook-f"></i></a>
      <a class="btn btn-dark m-3" href="#!"><i class="fab fa-instagram"></i></a>
    </div>
  </div> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>