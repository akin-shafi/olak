<?php
require_once('private/initialize.php');
// pre_r($session);
if ($session->admin) {
    //for logging actions in the log file
    log_action('Logout', "{$loggedInAdmin->full_name()} Logged out.", "login");
}

// Log out the admin
$session->logout();

redirect_to(url_for('/login.php'));
