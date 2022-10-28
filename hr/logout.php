<?php
require_once('private/initialize.php');
if ($session->email) {
    log_action('Logout', "{$loggedInAdmin->full_name()} Logged out.", "login");
}

$session->logout(true);

redirect_to(url_for('login.php'));
