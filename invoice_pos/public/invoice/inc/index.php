<?php require_once('../../../private/initialize.php'); 
	

if (is_post_request()) {
	 
	  // Create record using post parameters
	    $args  = $_POST['billing'] ?? [];
	    $billing = new Billing($args);
	    $result = $billing->save();
	    // pre_r($_POST);

	    $result = true;
	    if ($result == true) {
		      $rand = rand(10, 100);
		      // $new_id = $billing->id;
		      $new_id = 1;
		      $invoice_no = "1" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;
		      $data = [
		      	'invoiceNum' => $invoice_no,
		      ];
		      $billing->merge_attributes($data);
		      $result_set = $billing->save();
		      // $result_set = true;
		      if ($result_set == true) {
		        // $_POST['transid'] = $new_id; 
		        $service_type  = $_POST['service_type'];
		        $quantity     = $_POST['quantity'];
		        $unit_cost    = $_POST['unit_cost'];
		        $amount       = $_POST['amount'];

		        for ($i = 0; $i < count($amount); $i++) {
		          $dataDesc = [
		            "transid" 		=> $invoice_no,
		            "service_type"  => $service_type[$i],
		            "quantity"      => $quantity[$i],
		            "unit_cost"     => $unit_cost[$i],
		            "amount"        => $amount[$i],
		            "created_by"    => $loggedInAdmin->id,
		          ];

		          $expRequest = new Invoice($dataDesc);
		          $last_result = $expRequest->save();

		        }

		        if ($last_result == true) {
		          	exit(json_encode(['success' => true, 'msg' => 'Invoice Generated Successfully', 'invoice_no' => $invoice_no]));
		        }
		      }
		      // redirect_to(url_for('invoice/all_invoices.php'));
	    } 
	
}


?>