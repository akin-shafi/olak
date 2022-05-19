<?php require_once('../../private/initialize.php'); ?>
<?php if (isset($_POST)) {
      $args = $_POST['register'];
	  $register = new Register($args);

	  $result = $register->save();
	  if ($result == true) {// Set session variables
	  	$_SESSION["register"] = $args['cash_in_hand'];
	  	exit(json_encode(['msg' => 'OK']));
	  }else{
	  	exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($register->errors)]));
	  }
}?>