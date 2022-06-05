<?php
require_once('private/initialize.php');
if ($session->admin) {
    log_action('Logout', "{$loggedInAdmin->full_name} Logged out.", "login");
}

$session->logout();

redirect_to(url_for('auth/'));
