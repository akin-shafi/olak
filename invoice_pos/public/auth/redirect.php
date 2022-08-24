<?php require_once('../../private/initialize.php');


if(in_array($loggedInAdmin->admin_level, [1])) { // Admin
	redirect_to(url_for('/dashboard/'));
}elseif(in_array($loggedInAdmin->admin_level, [4])){ // Sales Rep
	redirect_to(url_for('/invoice'));
}elseif(in_array($loggedInAdmin->admin_level, [5])){ // Account
	redirect_to(url_for('/wallet'));
}else{
	redirect_to(url_for('/report/'));
}



?>

