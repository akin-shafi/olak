<?php require_once('../../private/initialize.php');  ?>

<?php if(isset($_POST)) { 
	$encrypt = Activation::encrypt_decrypt($_POST['expire_date'], 'encrypt');
	// $today = date('Y-m-d');
	// $encrypt = Activation::encrypt_decrypt($today, 'encrypt');
	
	$user = Activation::find_by_product($_POST['product']);
	
	if (empty($user)) {
		$uniqid =  "ref" .uniqid();

		 $args = [
		 	 'company_id' => $company->id,
		     'plan' => $_POST['plan_name'],
		     'plan_type' => $_POST['plan_type'],
		     'create_date' => $_POST['create_at'],
		     'expire_date' => $_POST['expire_date'],
		     'amount' => $_POST['amount'],
		     'created_by' => $loggedInAdmin->id,
		     'product' => 'PMS',
		     'order_no' => $uniqid,
		     'activation_code' => $encrypt,
		 ];
		 
		 $sub = new Activation($args);
		 $result = $sub->save();
	}else{
		$uniqid =  "ref" .uniqid();
		 $args = [
		 	 'company_id' => $company->id,
		     'plan' => $_POST['plan_name'],
		     'plan_type' => $_POST['plan_type'],
		     'create_date' => $_POST['create_at'],
		     'expire_date' => $_POST['expire_date'],
		     'amount' => $_POST['amount'],
		     'created_by' => $loggedInAdmin->id,
		     'product' => 'PMS',
		     'order_no' => $uniqid,
		     'activation_code' => $encrypt,
		 ];
		 
		 $user->merge_attributes($args);
		 $result = $user->save();
	}

	
	 if ($result == true) {// Set session variables
	  	exit(json_encode(['msg' => 'OK']));
	  }else{
	  	exit(json_encode(['msg' => 'FAIL']));
	  }

 } ?>



