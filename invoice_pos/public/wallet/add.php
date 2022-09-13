<?php
require_once('../../private/initialize.php');
require_login();

$id = $_GET['id'] ?? '';
if ($id) {
  $customer = Client::find_by_customer_id($id);
  $c_id = $customer->id;
  $customer_name = $customer->full_name();
}


if (is_post_request()) {

  $args = $_POST['wallet'];
  $customer_id = $args['customer_id'];
  $full_name = Client::find_by_customer_id($customer_id)->full_name();


    $new_id = $walletDetails->id;
    $payment_id = "POP/". $loggedInAdmin->branch_id ."/".$new_id . rand(10, 100);

    // $updateWalletDetail = WalletDetails::find_by_id($new_id);

    // $dat = [
    //   'payment_id' => $payment_id,
    // ];
    // $updateWalletDetail->merge_attributes($dat);
    // $updateWalletDetail->save();

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
      ];

      $payment = new WalletFundingMethod($data);
      $savePayment = $payment->save();


      if($savePayment == true){
        $payment_record = WalletFundingMethod::find_by_id($payment->id);
        
        $newData = [
          'payment_id' => $payment_id,
          'approval' => 0,
          'created_by' => $loggedInAdmin->id,
        ];
        $payment_record->merge_attributes($newData);
        $savePayment_id = $payment_record->save();
      }
    }
    
    $session->message( $full_name . ' Wallet updated successfully.');
    redirect_to(url_for('/wallet/index.php'));

} else {
  $wallet = new WalletFundingMethod;
}

?>

<?php $page = 'Wallet';
$page_title = 'Load Wallet'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div class="main-container">


  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9 ">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3 ">
        <div class="daterange-container">

          <a href="<?php echo url_for('/wallet/') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="wallet List">
            <i class="feather-file-text"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="content-wrapper">
    <?php if (display_errors($wallet->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($wallet->errors); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <form id="add_wallet_form" class="mb-0" method="post">
      <?php include('form_field.php') ?>
      <div class="modal-footer">
        <button class="btn btn-primary" id="add_wallet_btn">Submit</button>
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>