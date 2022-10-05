<?php 
require_once('../../private/initialize.php'); ?>
<?php if (isset($_POST['show'])) { ?>
<?php $sn = 1;
  foreach (Refund::find_by_undeleted() as $value) : 
    $customer_name = Client::find_by_customer_id($value->customer_id)->full_name();
    $balance =  Client::find_by_customer_id($value->customer_id)->balance;
    // $sum =  Refund::sum_of_unapproved(['customer_id' => $value->customer_id, 'approval' => 0]);
  ?>
    <tr>
      <td><?php echo $sn++ ?></td>
      <td>
        <h6 class="mb-0 fs-14"><?php echo ucwords($customer_name) ?></h6>
      </td>
     <!-- <td class="green"><?php //echo number_format($balance, 2) ?> </td> -->
      <td>
        
          <?php echo $currency." ". number_format($value->amount, 2) ?>
       
      </td>
      <td><?php echo Refund::STATUS[$value->status] ?? 'NULL' ?></td>
      <td>
        <?php if ($value->status == 0) { ?>
          <a class="btn btn-sm btn-primary approve " id="<?php echo  $value->id ?>"> <i class="feather-plus text-success"></i> Approve</a> 
        <?php } ?>
      </td>

    </tr>
  <?php endforeach; ?>

<?php } ?>


<?php if (isset($_POST['approve'])) { 
		$check = Refund::find_by_id($_POST['id']);
		$data1 = [
			'status' => 1
		];
		$check->merge_attributes($data1);
	    $result = $check->save();

    if($result == true){
			$client = Client::find_by_customer_id($check->customer_id);
			$balance = intval($client->balance) - intval($check->amount);
			$data2 = [
				'balance' => $balance
			];
		$client->merge_attributes($data2);
	    $result2 = $client->save();

	    if($result2 == true){
	    	exit(json_encode(['msg' => 'OK']));
	    }
    }

}?>


