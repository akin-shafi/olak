<?php require_once('../../../private/initialize.php');

if (is_post_request()) {

	if (isset($_POST['new_invoice'])) {
		$args  = $_POST['billing'] ?? [];
		
		$billing = new Billing($args);
		$result = $billing->save();

		if ($result == true) {
			if ($_POST['billing']['billingFormat'] == 1) {
				$post_id = $_POST['billing']['client_id'];
				$total_amount = $_POST['billing']['total_amount'];
				$client = Client::find_by_id($post_id);
				$balance = ($client->balance - $total_amount);
				$new_args = [
					'balance' => $balance,
				];
				$client->merge_attributes($new_args);
				$result_data = $client->save();
			}

			$rand = rand(10, 100);
			$new_id = $billing->id;
			$invoice_no = "1" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;
			$data = [
				'invoiceNum' 	=> $invoice_no,
				"created_by"    => $loggedInAdmin->id,
			];
			$billing->merge_attributes($data);
			$result_set = $billing->save();

			if ($result_set == true) {
				$service_type  = $_POST['service_type'];
				$quantity     = $_POST['quantity'];
				$unit_cost    = $_POST['unit_cost'];
				$amount       = $_POST['amount'];

				if ($args['agent_id'] != '') {
					for ($i = 0; $i < count($amount); $i++) {
						$item_cost = Product::find_by_id($_POST['service_type'][$i])->price;
						$rebate_value = ($unit_cost[$i] - $item_cost);

						$dataDesc = [
							"transid" 			  => $invoice_no,
							"service_type"  	  => $service_type[$i],
							"quantity"      	  => $quantity[$i],
							"unit_cost"     	  => $unit_cost[$i],
							"amount"        	  => $amount[$i],
							"rebate_value"        => $rebate_value,
							"created_by"    	  => $loggedInAdmin->id,
						];

						$expRequest = new Invoice($dataDesc);
						$last_result = $expRequest->save();
					}

					$total_rebate = Invoice::sum_of_rebate_value(['transid' => $invoice_no]);
					$agentWallet = AgentWallet::find_by_agent_id($args['agent_id']);

					$agentRecord = [
						'balance' => ($agentWallet->balance + $total_rebate),
					];
					$agentWallet->merge_attributes($agentRecord);
					$agentWallet->save();

				}else{
					for ($i = 0; $i < count($amount); $i++) {
						$dataDesc = [
							"transid" 		=> $invoice_no,
							"service_type"  => $service_type[$i],
							"quantity"      => $quantity[$i],
							"unit_cost"     => $unit_cost[$i],
							"amount"        => $amount[$i],
							"created_by"    => $loggedInAdmin->id,
							"company_id"    => $loggedInAdmin->company_id,
							"branch_id"    => $loggedInAdmin->branch_id,
						];

						$expRequest = new Invoice($dataDesc);
						$last_result = $expRequest->save();
					}
				}

				if ($last_result == true) {
					exit(json_encode(['success' => true, 'msg' => 'Invoice Generated Successfully', 'invoice_no' => $invoice_no]));
				}
			} else {
				exit(json_encode(['success' => false, 'msg' => $billing->errors]));
			}
		}
	}

	if (isset($_POST['edit_invoice'])) {
		$args				= $_POST['billing'];
		$invoice_no = $_POST['invoice_num'];

		$billing = Billing::find_by_invoice_no($invoice_no);

		($billing->balance == $args['balance']) ? $billing->balance : $args['balance'];

		$args['invoiceNum'] = $invoice_no;
		$args['grand_total'] = $args['grand_total'] == '' ? $billing->grand_total : $args['grand_total'] + $args['balance'];

		$billing->merge_attributes($args);
		$result = $billing->save();

		if ($result == true) {
			$service_type = $_POST['service_type'];
			$quantity     = $_POST['quantity'];
			$unit_cost    = $_POST['unit_cost'];
			$amount       = $_POST['amount'];

			if ($args['agent_id'] != '') {
				for ($i = 0; $i < count($amount); $i++) {
					$item_cost = Product::find_by_id($_POST['service_type'][$i])->price;
					$rebate_value = ($unit_cost[$i] - $item_cost);

					$dataDesc = [
						"transid" 			  => $invoice_no,
						"service_type"  	  => $service_type[$i],
						"quantity"      	  => $quantity[$i],
						"unit_cost"     	  => $unit_cost[$i],
						"amount"        	  => $amount[$i],
						"rebate_value"        => $rebate_value,
						"created_by"    	  => $loggedInAdmin->id,
					];

					$expRequest = new Invoice($dataDesc);
					$last_result = $expRequest->save();
				}

				$total_rebate = Invoice::sum_of_rebate_value($invoice_no);
				if ($last_result == true) {
					$agentWallet = AgentWallet::find_by_agent_id($args['agent_id']);
					$agentRecord = [
						'balance' => ($total_rebate + $agentWallet->balance),
					];
					$agentWallet->merge_attributes($agentRecord);
					$agentWallet->save();
				}

			}

			exit(json_encode(['success' => true, 'msg' => 'Invoice Updated Successfully', 'invoice_no' => $invoice_no]));
		}
	}

	if (isset($_POST['delete_invoice'])) {
		$invoiceId = $_POST['id'];
		$invoice = Invoice::find_by_id($invoiceId);
		$billing = Billing::find_by_invoice_no($invoice->transid);

		$amount  = intval($invoice->amount);
		$grand_total  = intval($billing->grand_total);

		$grand = $grand_total - $amount;

		$args = [
			'grand_total' => $grand,
			'total_amount' => $grand,
			'part_payment' => 0,
			'balance' => 0,
			'updated_date' => date('Y-m-d H:i:s'),
		];

		$billing->merge_attributes($args);
		$result = $billing->save();

		if ($result == true) {
			$invoice::deleted($invoiceId);
		}

		exit(json_encode(['msg' => 'Invoice record deleted successfully']));
	}

	if (isset($_POST['delete_void'])) {
		$invoiceId = $_POST['id'];
		$billing = Billing::find_by_id($invoiceId);

		$invoices = Invoice::find_by_transid($billing->invoiceNum);
		foreach ($invoices as $value) {
			Invoice::deleted($value->id);
		}

		$billing::deleted($invoiceId);

		exit(json_encode(['msg' => 'Invoice record deleted successfully']));
	}

	if (isset($_POST['process_waybill'])) {
		$invoice_no = $_POST['invoice_num'];
		$billing = Billing::find_by_invoice_no($invoice_no);
		$rand = rand(0, 100);
		$unique = uniqid();
		if(empty($billing->waybill_no)) {
		   $args = [
		      "status" => 2,
		      "waybill_no" => $rand."-".$unique,
		   ];
		   $billing->merge_attributes($args);
		   $result = $billing->save();
		   if ($result == true) {
		   $all_invoice = Invoice::find_by_invoiceNum($invoice_no);
		  
		   	foreach ($all_invoice as $value) {
		   		$inv = Invoice::find_by_id($value->id);
		   		$data = [
		   			'status' => 1,
		   		];
		   		$inv->merge_attributes($data);
				$result_data = $inv->save();
		    }

		   	exit(json_encode(['success' => true, 'msg' => 'Waybill processed successfully']));
		   }
		}
	}
}










