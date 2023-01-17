<?php require_once('../../../private/initialize.php');

if (is_post_request()) {
// pre_r($_POST);
  $args = $_POST['wallet'];
  $customer_id = $args['customer_id'];
  $full_name = Client::find_by_customer_id($customer_id)->full_name();

    $created_by = $loggedInAdmin->id;
    $new_id = uniqid();
    $payment_id = "POP/". $loggedInAdmin->branch_id ."/".$new_id . rand(10, 100);
    $deposit = $_POST['wallet']['deposit'];
    $created_at = $_POST['wallet']['created_at'];


    $duplicate = Wallet::find_duplicate(['customer_id' => $customer_id, 'deposit' => $deposit, 'created_by' => $created_by, 'created_at' => $created_at]);
		if(!empty($duplicate)){
			exit(json_encode(['success' => false, 'msg' => "Duplicate Transaction Please Check Receipt Number". $duplicate->payment_id]));
		}else{
      $argment = [
        'customer_id'     => $customer_id,
        'deposit'         => $deposit,
        'balance'         => $_POST['wallet']['balance'],
        'narration'         => $_POST['wallet']['narration'],
        'payment_id'      => $payment_id,
        'created_by'      => $created_by,
        'company_id'      => $loggedInAdmin->company_id,
        'branch_id'       => $loggedInAdmin->branch_id,
        'created_at'      => $created_at,
      ];
      $wallet = new Wallet($argment);
      $updateWallet = $wallet->save();
  
      $amount             = $_POST['amount'];
      $payment_method     = $_POST['payment_method'];
      $bank_name          = $_POST['bank_name'];
      $total_amt          = $_POST['wallet']['amount'];
      for ($i = 0; $i < count($amount); $i++) {
        $data = [
          'customer_id'    => $customer_id,
          'payment_method' => $payment_method[$i],
          'amount'         => $amount[$i],
          'bank_name'      => $bank_name[$i],
          'company_id'     => $loggedInAdmin->company_id,
          'branch_id'      => $loggedInAdmin->branch_id,
          'payment_id'     => $payment_id,
          'approval'       => 0,
          'created_by' => $loggedInAdmin->id,
        ];

        $payment = new WalletFundingMethod($data);
        $savePayment = $payment->save();

      }
      
      $session->message( $full_name . ' Wallet updated successfully.');
      exit(json_encode(['success' => true, 'msg' => 'Wallet updated successfully.', 'payment_id' =>  $payment_id]));
    }
} else {
    exit(json_encode(['success' => false, 'msg' => $payment->errors]));
}

?>