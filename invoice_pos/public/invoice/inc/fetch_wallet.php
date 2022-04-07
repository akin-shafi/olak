<?php require_once('../../../private/initialize.php'); 
	

if (!empty($_POST['customer_id'])) {
	$cus_id = Client::find_by_id($_POST['customer_id']);
	$wallet = Wallet::find_by_customer_id($cus_id->customer_id);
	// pre_r($wallet);
	exit(json_encode(['success' => true, 'wallet_balance' => $wallet->balance]));
}else{
	exit(json_encode(['success' => true, 'wallet_balance' => 0]));
}


?>

