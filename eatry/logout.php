<?php
require_once('private/initialize.php');
if ($session->email) {
    //for logging actions in the log file
    log_action('Logout', "{$loggedInAdmin->full_name()} Logged out.", "login");
}

	$today = date('Y-m-d');
    $log = LoggedIn::find_user_by_status(['user_id' => $loggedInAdmin->id, 'time_log_in' => $today]);
    if(!empty($log)){
        $args = [
            'status' => 0,
            'time_log_out' => date('Y-m-d H:i:s')
        ];
        $log->merge_attributes($args);
        $result = $log->save();
        if ($result == true) {
        	// Log out the admin
    		$session->logout(true);
    
    		redirect_to(url_for('login'));
        }
    }else{
        $session->logout(true);
        redirect_to(url_for('login'));
    }
