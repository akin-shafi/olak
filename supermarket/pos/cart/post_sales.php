<?php require_once('../../private/initialize.php'); ?>
<?php if (isset($_POST)) {

	  $open_time = $_POST['open_time'];
	  $from = date("Y-m-d");
	  $to = date("Y-m-d");
	  $register = Register::find_by_time(['open_time' => $open_time, 'created_by'=> $loggedInAdmin->id]);
	  $args = $_POST['remitter'];
	  $register->merge_attributes($args); // merge newly created trans_no and
	  $result = $register->save();
	  // pre_r($register);
	  // $result = true;
	  if ($result == true) {// Set session variables
		  exit(json_encode(['msg' => 'OK', 'created_by' => $loggedInAdmin->id, 'from' => $from, 'to'  => $to]));
	  }else{
		  exit(json_encode(['msg' => 'FAIL']));
	  }
}?>