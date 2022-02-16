<?php require_once('../../private/initialize.php'); ?>
<?php

if (is_get_request()) {
	if (isset($_GET['confirm_receipt'])) {
		$month = $_GET['params'];

		foreach (Payroll::find_by_created_at($month) as $value) {
			$update = Payroll::find_by_id($value->id);
			$args = ['payment_status' => 3];

			$update->merge_attributes($args);
			$update->save();
		}

		http_response_code(200);
		exit(json_encode(['success' => true, 'msg' => 'Payroll Confirmed!']));
	}

	if (isset($_GET['confirmed_payment'])) {
		if (empty($_GET['params'])) :
			http_response_code(404);
			exit(json_encode(['msg' => 'No record found for this month']));
		endif;

		$payrollIds = $_GET['params'];

		foreach ($payrollIds as $key => $id) {
			$update = Payroll::find_by_id($id);
			$args = ['payment_status' => 4];

			$update->merge_attributes($args);
			$update->save();
		}

		http_response_code(200);
		exit(json_encode(['success' => true, 'msg' => 'Payment Confirmed!', 'paid' => true]));
	}
}
?>
