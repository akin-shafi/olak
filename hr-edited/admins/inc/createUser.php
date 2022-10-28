<?php 
	require_once('../../private/initialize.php');
	$args = $_POST;
	$admin = New Admin($args);
	$result_set = $admin->save();
	
	if ($result_set == true) {
		exit(json_encode([
			'msg' => 'Created Successful', 
			'success' => true, 
			'email' => $_POST['email'],
			'firstname' => $_POST['first_name'],
			'lastname' => $_POST['last_name'],
			'password' => $_POST['password']
		]));
	}else{
		exit(json_encode(['msg' => display_errors($admin->errors), 'success' => false ]));
	}
?>