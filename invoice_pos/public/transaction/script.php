<?php require_once('../../private/initialize.php'); ?>


<?php if (isset($_POST['unapproved'])) { 

$customer_id = $_POST['customer_id'];
$approval = $_POST['approval'];
$check = WalletFundingMethod::find_by_unapproved(['customer_id' => $customer_id, 'approval' => $approval]);
$sum = WalletFundingMethod::sum_of_unapproved(['customer_id' => $customer_id, 'approval' => $approval]);

// pre_r($check);
?>

<?php $sn=1; foreach($check as $value){ ?>
	<tr>
		<td><?php echo $sn++; ?></td>
		<td><?php echo $currency." ". number_format($value->amount, 2); ?></td>
		<td><?php echo Billing::PAYMENT_METHOD[$value->payment_method]; ?></td>
		<td><?php echo Bank::find_by_id($value->bank_name)->bank_name ?? "Not Set"; ?></td>
		<td><?php echo Bank::find_by_id($value->bank_name)->account_number ?? "Not Set"; ?></td>
		<td><?php echo $value->created_at; ?></td>
		<td><?php echo Admin::find_by_id($value->created_by)->full_name(); ?></td>
		<?php  if($accessControl->can_approve == 1) : ?>
		<td><button class="btn btn-danger btn-sm approve" data-type="<?php echo $value->payment_method ?>" data-cust="<?php echo $value->customer_id; ?>" id="<?php echo $value->id; ?>">Confirm </button></td>
		<?php elseif($value->payment_method != 3): ?>
			<td><button class="btn btn-primary btn-sm approve" data-type="<?php echo $value->payment_method ?>" data-cust="<?php echo $value->customer_id; ?>" id="<?php echo $value->id; ?>">Confirm </button></td>
		<?php endif ?>

	</tr>
	
<?php } ?>
<tr>
	<td colspan="1" align="center" style="font-size:18pxx; font-weight: bold;">Total:</td>
	<td colspan="2" align="center" style="font-size:18pxx; font-weight: bold;"><?php echo $currency." ". number_format($sum, 2)?></td>
</tr>

<?php } ?>


<?php if (isset($_POST['approve'])) { 
	$wallet = WalletFundingMethod::find_by_id($_POST['id']);

  if($wallet->approval == 1){
    exit(json_encode(['success' => false, 'msg' => 'Trasaction already approved']));
  }else{
    $data1 = [
      'approval' => 1
    ];
    $wallet->merge_attributes($data1);
    $result = $wallet->save();

    if($result == true){
			$client = Client::find_by_customer_id($wallet->customer_id);
			$balance = intval($client->balance) + intval($wallet->amount);
			$data2 = [
				'balance' => $balance
			];
			  $client->merge_attributes($data2);
		    $result2 = $client->save();

		    if($result2 == true){
		    	exit(json_encode(['success' => true, 'msg' => 'Approved']));
				}
    }
  }


   
	


}?>

<?php if (isset($_POST['show'])) { 
              $check = WalletFundingMethod::find_by_unapproved([ 'approval' => 0]);
              $sum = WalletFundingMethod::sum_of_unapproved(['approval' => 0]);
              $sn=1; foreach($check as $value) { 
              $account_number = Bank::find_by_id($value->bank_name)->account_number ?? "Not Set";
              $account_name = $value->bank_name == 0 ? " " : Bank::find_by_id($value->bank_name)->account_name;
              ?>

              <tr>
                <td><?php echo $sn++; ?></td>
                <td class="text-uppercase"><?php echo Client::find_by_customer_id($value->customer_id)->full_name(); ?></td>
                <td><?php echo $currency." ". number_format($value->amount, 2); ?></td>
                <td><?php echo Billing::PAYMENT_METHOD[$value->payment_method]; ?></td>
                <td><?php echo Bank::find_by_id($value->bank_name)->bank_name ?? "Not Set"; ?></td>
                <td><?php echo $account_number ."-". $account_name; ?></td>
                <?php  if($accessControl->can_approve == 1) : ?>
                <td>

                	<button class="btn btn-success btn-sm approve" data-type="<?php echo $value->payment_method ?>" data-cust="<?php echo $value->customer_id; ?>" id="<?php echo $value->id; ?>">Confirm </button>
                	 <a class="btn btn-danger btn-sm" href="<?php echo url_for('/transaction/delete.php?id=' . $value->id); ?>"> <i class="feather feather-trash-2"></i></a>
                </td>
                <?php elseif($value->payment_method != 3): ?>
                  <td><button class="btn btn-primary btn-sm approve" data-type="<?php echo $value->payment_method ?>" data-cust="<?php echo $value->customer_id; ?>" id="<?php echo $value->id; ?>">Confirm </button></td>
                <?php endif ?>

                <td><?php echo $value->created_at; ?></td>
                <td><?php echo Admin::find_by_id($value->created_by)->full_name(); ?></td>
                

              </tr>

              
            <?php } ?>
<?php } ?>



<?php if (isset($_POST['customer_id'])) { 
	$find_ref = WalletFundingMethod::find_by_refrence_no($_POST['refrence_no']);

	if(!empty($find_ref)){
		exit(json_encode(['msg' => 'Invalid Refrence number']));
	}else{
		$record = WalletFundingMethod::find_by_id($_POST['id']);
		$data = [
			"refrence_no" => $_POST['refrence_no'],
			"description" => $_POST['description'],
		];
		$record->merge_attributes($data);
		$result = $record->save();

		if ($result == true) {
			exit(json_encode(['msg' => 'OK']));
		}
	}
	
	

} ?>



<?php if (isset($_POST['matrics'])) {  
        $from = $_POST['from'] ?? date("Y-m-d");
        $to = $_POST['to'] ?? date("Y-m-d");
        $confirmed = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'from' => $from, 'to' => $to, ]) ?? 0; 
        $unconfirmed = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'from' => $from, 'to' => $to,]) ?? 0; 

        $unconfirmed_cash = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 2, 'from' => $from, 'to' => $to,]) ?? 0;
        $unconfirmed_transfer = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 3, 'from' => $from, 'to' => $to,]) ?? 0;
        $unconfirmed_pos = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 4, 'from' => $from, 'to' => $to,]) ?? 0;

        $confirmed_cash = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 2, 'from' => $from, 'to' => $to,]) ?? 0;
        $confirmed_transfer = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 3, 'from' => $from, 'to' => $to,]) ?? 0;
        $confirmed_pos = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 4, 'from' => $from, 'to' => $to,]) ?? 0; 
      ?>
      <div class="col-6 border">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
            <div class="daily-sales" style="position: relative;">
              <h6>Unconfirmed</h6>
              <h1><?php echo $currency . " ". number_format($unconfirmed, 2) ?></h1>
              <div class="row">
                <div class="col-4 border">Cash: <?php echo number_format($unconfirmed_cash, 2) ?></div>
                <div class="col-4 border">Transfer: <?php echo number_format($unconfirmed_transfer, 2); ?></div>
                <div class="col-4 border">POS: <?php echo number_format($unconfirmed_pos, 2); ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 border">
        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
            <div class="daily-sales" style="position: relative;">
              <h6>Confirmed</h6>
              <h1><?php echo $currency . " ". number_format($confirmed, 2) ?></h1>
              <div class="row">
                <div class="col-4 border">Cash: <?php echo number_format($confirmed_cash, 2) ?></div>
                <div class="col-4 border">Transfer: <?php echo number_format($confirmed_transfer, 2); ?></div>
                <div class="col-4 border">POS: <?php echo number_format($confirmed_pos, 2); ?></div>
              </div>
            </div>
          </div>
      </div>
<?php } ?>