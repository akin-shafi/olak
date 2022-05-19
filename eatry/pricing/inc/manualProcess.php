 <?php require_once('../../private/initialize.php');  ?>
 <?php if(isset($_POST['manual'])) { 
	$encrypt = Activation::encrypt_decrypt($_POST['expire_date'], 'encrypt');
	$today = date("Y-m-d H:i:s");
	$user = Activation::find_by_product($_POST['product']);


	if (empty($user)) {
		$uniqid =  "ref" .uniqid();

		 $args = [
		 	 'company_id' => $company->id,
		     'plan' => "Manual Plan",
		     'plan_type' => "Manual Type",
		     'create_date' => $today,
		     'expire_date' => $_POST['expire_date']. date(" H:i:s"),
		     'amount' => 0,
		     'created_by' => $loggedInAdmin->id,
		     'product' => $_POST['product'],
		     'order_no' => $uniqid,
		     'activation_code' => $encrypt,
		 ];
		 
		 $sub = new Activation($args);
		 $result = $sub->save();
		 // pre_r($sub);
	}else{
		$uniqid =  "ref" .uniqid();
		 $args = [
		 	 'company_id' => $company->id,
		     'plan' => "Manual Plan",
		     'plan_type' => "Manual Type",
		     'create_date' => $today,
		     'expire_date' => $_POST['expire_date']. date(" H:i:s"),
		     'amount' => 0,
		     'created_by' => $loggedInAdmin->id,
		     'product' => $_POST['product'],
		     'order_no' => $uniqid,
		     'activation_code' => $encrypt,
		 ];
		 
		 $user->merge_attributes($args);

		 $result = $user->save();
	}

	
	 if ($result == true) {// Set session variables
	  	exit(json_encode(['msg' => 'OK', 'code' => $encrypt]));
	  }else{
	  	exit(json_encode(['msg' => 'FAIL']));
	  }

	

 } ?>