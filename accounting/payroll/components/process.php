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
}
?>
