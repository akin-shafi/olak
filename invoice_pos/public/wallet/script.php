<?php 
require_once('../../private/initialize.php'); ?>

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
		<td><?php echo $currency." ".$value->amount; ?></td>
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

<?php if (isset($_POST['show'])) { ?>
	<?php $sn = 1;
		if (in_array($loggedInAdmin->admin_level, [1,6])) {
			$customer = Client::find_by_undeleted();
		}else{
			$customer = Client::find_by_branch_id($loggedInAdmin->branch_id);
		}
    foreach ($customer as $client) : 
      $customer_name = $client->full_name();
      $balance = intval($client->balance);
      $sum =  WalletFundingMethod::sum_of_unapproved(['customer_id' => $client->customer_id, 'approval' => 0]);
    ?>

    
      <tr>
        <td><?php echo $sn++ ?></td>
        <td>
          <a href="<?php echo url_for('client/show.php?id='. $client->id) ?>" class="d-flex align-items-center">
            <h6 class="mb-0 fs-14"><?php echo ucwords($customer_name) ?></h6>
          </a>
        </td>
        <td><?php echo ucwords($client->customer_id) ?> </td>
        <td class="green"><?php echo number_format($balance, 2) ?> </td>
        <td>
          <?php if ($sum != 0) {?>
            <a href="#" data-id="<?php echo $client->customer_id ?>" class="red deposit"><?php echo number_format($sum, 2) ?></a>
          <?php }else{ ?>
            <?php echo number_format($sum, 2) ?>
          <?php } ?>
        </td>
        
        <td>
          <?php if (!in_array($loggedInAdmin->admin_level, [2,3])) { ?>
            <a href="<?php echo url_for('wallet/add.php?id=' . $client->customer_id) ?>" class="btn btn-sm btn-primary "> <i class="feather-plus text-success"></i> Load wallet</a> 
          <?php } ?>
        
	        <?php if (in_array($loggedInAdmin->admin_level, [1,2])){ ?>
	        			<a href="<?php echo url_for('token/add.php?id=' . $client->customer_id) ?>" class="btn btn-sm btn-danger d-none"> <i class="feather-plus text-dark"></i> Generate Token</a> 
	        <?php } ?>

	        <?php if (in_array($loggedInAdmin->admin_level, [1,6])){ ?>
	        			<a href="<?php echo url_for('refund/new.php?id=' . $client->customer_id) ?>" class="btn btn-sm btn-info "> <i class="feather-plus text-dark"></i> Refund Customer</a> 
	        <?php } ?>
        </td>
      </tr>
    <?php endforeach; ?>
<?php } ?>



<?php if (isset($_POST['submit'])) { 
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





<?php if (isset($_POST['gen_code'])) { 
$rand = rand(10, 100);
$unique = date('His');
// Create trans_no dynamically
$barcode = $unique . $rand;

// $barcode = "SPO" . $rand;

exit(json_encode(['msg' => 'OK', 'barcode' => $barcode]));

} ?>