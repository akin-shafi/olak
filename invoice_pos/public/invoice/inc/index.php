<?php require_once('../../../private/initialize.php');

if (is_post_request()) {

	if (isset($_POST['new_invoice'])) {
		$args  = $_POST['billing'] ?? [];
		$billing = new Billing($args);
		$result = $billing->save();

		$result = true;

		if ($result == true) {
			$rand = rand(10, 100);
			$new_id = $billing->id;
			$invoice_no = "1" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;
			$data = [
				'invoiceNum' => $invoice_no,
			];
			$billing->merge_attributes($data);
			$result_set = $billing->save();

			// $result_set = true;
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

			for ($i = 0; $i < count($amount); $i++) {
				$dataDesc = [
					"service_type"  => $service_type[$i],
					"quantity"      => $quantity[$i],
					"unit_cost"     => $unit_cost[$i],
					"amount"        => $amount[$i],
					"updated_at"    => date('Y-m-d H:i:s'),
				];
				if (!empty(Invoice::find_by_transid($invoice_no)[$i])) :
					$expRequest = Invoice::find_by_transid($invoice_no)[$i];

					$expRequest->merge_attributes($dataDesc);
					$expRequest->save();
				else :
					$dataDesc = [
						"transid" 			=> $invoice_no,
						"service_type"  => $service_type[$i],
						"quantity"      => $quantity[$i],
						"unit_cost"     => $unit_cost[$i],
						"amount"        => $amount[$i],
						"created_by"    => $loggedInAdmin->id,
					];

					$expRequest = new Invoice($dataDesc);
					$expRequest->save();
				endif;
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
}
