<?php require_once('../../private/initialize.php'); ?>
<?php if(isset($_GET)) { 
	$trans_no = $_GET['id'];
	$transaction = Transaction::find_transaction($trans_no);

	$args = [
    	'verification_status' => 1,
    	'verified_by' => $loggedInAdmin->id,
    	'verified_at' => date('Y-m-d H:i:s'),
    ];
	$transaction->merge_attributes($args);
	$result = $transaction->save();
	  
	  if($result == true){
	    exit(json_encode(['msg' => 'OK']));
	  }else {
	  	exit(json_encode(['msg' => 'FAIL']));
	  }
}
	


?>

