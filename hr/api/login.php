<?php 
require_once('../private/initialize.php');
if (is_post_request()) { 
  // $clients = $_POST['clients'] ?? '';
  $login = $_POST['login'] ?? '';

    $email = $login['email'] ?? '';
    $password = $login['password'] ?? ''; 

    // Validations
    if (is_blank($email)) {
      $errors[] = true;
      exit(json_encode(['msg' => 'Email cannot be blank', 'success' => false]));
    }
    if (is_blank($password)) {
      $errors[] = true;
      // $errors[] = "Password cannot be blank.";
      exit(json_encode(['msg' => 'Password cannot be blank', 'success' => false]));
    }


    // if there were no errors, try to login
    if ($errors != true) {
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
        redirect_to(url_for('/redirect.php'));

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