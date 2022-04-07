<?php

require_once('../../../private/initialize.php');

require_login();

if ($loggedInAdmin->admin_level != 1) {
  redirect_to(url_for('/staff/admins/'));
}

if (!isset($_GET['id'])) {
  redirect_to(url_for('/staff/admins/index.php'));
}

$id = $_GET['id'];
$admin = FortressAdmin::find_by_id($id);
if ($admin == false) {
  redirect_to(url_for('/staff/admins/index.php'));
}

// echo "<pre>"; print_r($admin);echo "</pre>";

if (!DB::query("SELECT * FROM gwx_admin WHERE first_name = :first_name AND last_name = :last_name AND username = :username", array(':username' => $admin->username, ':first_name' => $admin->first_name, 'last_name' => $admin->last_name))) {

  $today = date('Y-m-d');

  DB::query("INSERT INTO `gwx_admin` (`first_name`, `last_name`, `email`, `username`, `hashed_password`, `address`, `city`, `lga`, `state`, `region`, `admin_level`, `creator`, `create_date`) VALUES(:first_name, :last_name, :email, :username, :hashed_password, :address, :city, :lga, :state, :region, :admin_level, :creator, :create_date)", array(':first_name' => $admin->first_name, ':last_name' => $admin->last_name, ':email' => $admin->email, ':username' => $admin->username, ':hashed_password' => $admin->hashed_password, ':address' => $admin->address, ':city' => $admin->city, ':lga' => $admin->lga, ':state' => $admin->state, ':region' => $admin->region, ':admin_level' => $admin->admin_level, ':creator' => $loggedInAdmin->id, ':create_date' => $today));

  // Logfile
  log_action('New Admin', "id: {$admin->id}, Created by {$loggedInAdmin->full_name()}", "admin");

  $session->message('The admin was added successfully.');
  redirect_to(url_for('/staff/admins/'));
} else {
  $session->message('The User Already Exist.');
  redirect_to(url_for('/staff/admins/admins.php'));
}
