<?php
require_once('private/initialize.php');
// print_r($session);
if ($session->email) {
    //for logging actions in the log file
    log_action('Logout', "{$loggedInAdmin->full_name()} Logged out.", "login");
}

// Log out the admin
$session->logout(true);

redirect_to(url_for('login.php'));
