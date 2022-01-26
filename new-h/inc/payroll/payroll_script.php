<?php
require_once('../../private/initialize.php');

if (is_post_request()) {
	if (isset($_POST['addPayrollItem'])) {
		$args = $_POST;
		$AddPayrollItem = new PayrollItem($args);
		$result = $AddPayrollItem->save();
		if ($result == true) {
			exit(json_encode(['success' => true, 'msg' => 'Sent successful']));
		} else {
			exit(json_encode(['success' => false, 'msg' => display_errors($AddPayrollItem->errors)]));
		}
	}
}
