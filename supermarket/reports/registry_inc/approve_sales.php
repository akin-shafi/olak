<?php require_once('../../private/initialize.php'); ?>
<?php if (isset($_POST)) {
	  $id = $_POST['id'] ?? '';
	  $register = Register::find_by_id($id);
	  $args = $_POST['remitter'];

	  $register->merge_attributes($args); // merge newly created trans_no and
	  $result = $register->save();
	  // pre_r($register);

	  
	  if ($result == true) {// Set session variables
	  	  $session->close_register();
		  exit(json_encode(['msg' => 'OK']));
	  }else{
		  exit(json_encode(['msg' => 'FAIL']));
	  }
}?>