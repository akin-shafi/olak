<?php require_once('../../private/initialize.php'); ?>
<?php 

	$payrolls = Payroll::find_by_created_at($month);

	foreach($payrolls as $value){
		$update = Payroll::find_by_id($value->id);
		$args = [
			'payment_status' => 3
		];

		$update->merge_attributes($args);
		$update->save();

	}

http_response_code(200);
exit(json_encode(['success' => true, 'msg' => 'Pushed Successfully!']));
 ?>