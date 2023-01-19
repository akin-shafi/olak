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
		$formData = Refund::find_by_id($_POST['id']);
    $client = Client::find_by_customer_id($formData->customer_id);
    $created_by = $loggedInAdmin->id;
    $created_at = $_POST['created_at'];

    $find_duplicate = Refund::find_duplicate(['customer_id' => $formData->customer_id, 
    'balance' => $formData->amount, 'created_by' => $created_by, 
    'created_at' => $created_at]);
    if(!empty($find_duplicate)){
      exit(json_encode(['success' => false, 'msg' => "Duplicate Transaction Please Check Record"]));
    }else{
        $balance = intval($client->balance) - intval($formData->amount);
        $data2 = [
          'balance' => $balance
        ];
        $client->merge_attributes($data2);
        $result = $client->save();

        if($result == true){
          $changeStatus = [
            'status' => 1
          ];
          $formData->merge_attributes($changeStatus);
          $result2 = $formData->save();
          if($result2 == true){
            exit(json_encode(['msg' => 'OK']));
          }
          
        }

        
    }
    

		

    

}?>


