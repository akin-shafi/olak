<?php require_once('../../../private/initialize.php');

if (is_post_request()) {
// pre_r($_POST);
  $args = $_POST['wallet'];
  $customer_id = $args['customer_id'];
  $full_name = Client::find_by_customer_id($customer_id)->full_name();


    $new_id = uniqid();
    $payment_id = "POP/". $loggedInAdmin->branch_id ."/".$new_id . rand(10, 100);

    $argment = [
      'customer_id'     => $customer_id,
      'deposit'         => $_POST['wallet']['deposit'],
      'balance'         => $_POST['wallet']['balance'],
      'narration'         => $_POST['wallet']['narration'],
      'payment_id'      => $payment_id,
      'created_by'      => $loggedInAdmin->id,
      'company_id'      => $loggedInAdmin->company_id,
      'branch_id'       => $loggedInAdmin->branch_id,
      'created_at'      => date("Y-m-d H:i:s"),
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

} else {
    exit(json_encode(['success' => false, 'msg' => $payment->errors]));
}

?>