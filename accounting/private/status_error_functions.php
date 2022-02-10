<?php

// function require_login()
// {
//     global $session;
//     if (!$session->is_logged_in()) {
//         redirect_to(url_for('login.php'));
//     }
//       $pc = gethostname();
//       $install = Installation::find_by_id(1);
//       if ($install->hostname != $pc) {
//         redirect_to(url_for('installation.php'));
//       }
// }
function require_login()
{
    global $session;
    if (!$session->is_logged_in()) {
        redirect_to(url_for('login.php'));
    }
}
function display_errors($errors=array())
{
   
    $output = '';
    if (!empty($errors)) {
        $output .= "<div style=\"background: #FFF;\" class=\"errors wow  alert alert-dismissible text-danger animated\">";
        $output .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"; 
        // $output .= "Please fix the following errors:"; 
        $output .= "<ul>";
        foreach ($errors as $error) {
            if (is_array($error)) {
                foreach ($error as $err) {
                    $output .= "<li>" . h($err) . "</li>";
                }
            } else {
                $output .= "<li>" . h($error) . "</li>";
            }
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

function display_session_message()
{
    global $session;
    $msg = $session->message();
    if (isset($msg) && $msg != '') {
        $session->clear_message();
        return '<div class="alert alert-success alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>' . h($msg) . '</strong></div>';
    }
}
