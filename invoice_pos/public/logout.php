<?php
require_once('../private/initialize.php');

if ($session->admin_id) {
    //for logging actions in the log file
    log_action('Logout', "{$loggedInAdmin->full_name()} Logged out.", "login");
}

// Log out the admin
$session->logout();

redirect_to(url_for('/auth/login.php'));
