<?php require_once('../../../private/initialize.php');

if (is_post_request()) {
	if (isset($_POST['new_invoice'])) {
		$args  = $_POST['billing'] ?? [];
		
		$billing = new Billing($args);
		$result = $billing->save();

		if ($result == true) {
			// if ($_POST['billing']['billingFormat'] == 1) {
			// 	$post_id = $_POST['billing']['client_id'];
			// 	$total_amount = $_POST['billing']['total_amount'];
			// 	$client = Client::find_by_id($post_id);
			// 	$balance = ($client->balance - $total_amount);
			// 	$new_args = [
			// 		'balance' => $balance,
			// 	];
			// 	$client->merge_attributes($new_args);
			// 	$result_data = $client->save();
			// }

			$rand = rand(10, 100);
			$new_id = $billing->id;
			$invoice_no = "1" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;
			$data = [
				'invoiceNum' 	=> $invoice_no,
				"created_by"    => $loggedInAdmin->id,
				"backlog"    	=> 1,
				"created_date"    => $_POST['created_date'],
			];
			$billing->merge_attributes($data);
			$result_set = $billing->save();

			if ($result_set == true) {
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
						"company_id"    => $loggedInAdmin->company_id,
						"branch_id"     => $loggedInAdmin->branch_id,
					];

					$expRequest = new Invoice($dataDesc);
					$last_result = $expRequest->save();
				}

				if ($last_result == true) {
					exit(json_encode(['success' => true, 'msg' => 'Invoice Generated Successfully', 'invoice_no' => $invoice_no]));
				}
			} else {
				exit(json_encode(['success' => false, 'msg' => $billing->errors]));
			}
		}
	}
}