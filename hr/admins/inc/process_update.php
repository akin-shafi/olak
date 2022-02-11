<?php require_once('../../private/initialize.php'); 
	$args = $_POST;
	$id =  $args['id'];
	$admin = Admin::find_by_id($id);
	$admin->merge_attributes($args);
	$result = $admin->save();
	if ($result == true) {
		exit(json_encode(['success' => true, 'msg' => 'Update successful']));
	}else{
		exit(json_encode(['success' => false, 'msg' => display_errors($admin->errors)]));
	}
	// pre_r($notary);

?>