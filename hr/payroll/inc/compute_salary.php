
<?php require_once('../../private/initialize.php');

if (isset($_POST['check_status'])) {
	$year = $_POST['year'];
	$month = $_POST['month'];
	$date = $_POST['year'] . "-" . $_POST['month'];
	$config = Configuration::find_by_date($date);
	if (!empty($config)) {
		exit(json_encode([
			'success' => true,
			'msg' => 'Salary already computed for this month',
			'sub' => 'Do you want to update ?'
		]));
	} else {
		exit(json_encode(['success' => false, 'msg' => 'No Salary found!']));
	}
}

if (isset($_POST['computeSalary'])) {
	$employees = Employee::find_by_undeleted();
	$year = $_POST['year'];
	$month = $_POST['month'];
	$date = $_POST['year'] . "-" . $_POST['month'];

	$data = [
		'loan_config' => 1,
		'visibility' => 0,
		'process_salary_date' => $date . date("-d"),
	];
	$config = new Configuration($data);
	$result = $config->save();

	if ($result == true) {
		$empId = [];

		foreach ($employees as $value) :
			$salary_advance = SalaryAdvance::find_by_employee_id($value->id, ['current' => date('Y-m')]);
			$empLoan = LongTermLoan::find_by_employee_id($payroll->employee_id);

			$salary = intval($value->present_salary);
			$commitment = isset($empLoan->commitment) ? $empLoan->commitment : '0.00';

			if ($commitment != '0.00') {
				array_push($empId, $payroll->employee_id);
			}

			$args = [
				'employee_id' => $value->id,
				'present_salary' => $salary,
				'loan' => $commitment,
				'salary_advance' => $salary_advance->total_requested,
				'month' => $date,
				'present_days' => $_POST['present_days'],
				'payment_status' => 1,
			];

			$payroll = new Payroll($args);
			$result = $payroll->save();
		endforeach;

		if ($result == true) :

			foreach ($empId as $key => $value) :
				$longLoan = LongTermLoan::find_by_employee_id($value);

				$amountRequested = intval($longLoan->amount_requested);
				$commitment = intval($longLoan->commitment);
				$amountPaid = intval($longLoan->amount_paid) + $commitment;

				$args = ['amount_paid' => $amountPaid];

				if ($amountRequested != $amountPaid) :
					$longLoan->merge_attributes($args);
					$longLoan->save();
				endif;
			endforeach;

			exit(json_encode(['success' => true, 'msg' => 'Salary Compute Successfully']));
		else :
			exit(json_encode(['success' => false, 'msg' => 'Error can not compute salary, Something went wrong']));
		endif;
	} else {
		http_response_code(404);
		// exit(json_encode(['error' => display_errors($payroll->errors)]));
	}
}

if (isset($_POST['updateSalary'])) {
	$year = $_POST['year'];
	$month = $_POST['month'];
	$date = $_POST['year'] . "-" . $_POST['month'];
	$config = Configuration::find_by_date($date);

	$data = [
		'process_salary' => 1,
		'process_salary_date' => $date,
	];
	$config->merge_attributes($data);
	$result = $config->save();

	if ($result == true) {
		$payroll = Payroll::find_by_month($month);
		foreach ($payroll as $value) {
			$find_by_id = Payroll::find_by_id($value->id);
			$args = [
				'employee_id' => $value->id,
				'present_salary' => $salary,
				'loan' => $commitment,
				'salary_advance' => $salary_advance->total_requested,
				'present_days' => $_POST['present_day'],
				'payment_status' => 1,
			];

			$find_by_id->merge_attributes($data);
			$result = $find_by_id->save();
		}
		exit(json_encode(['success' => true, 'msg' => 'Salary Updated Successfully']));
	} else {
		http_response_code(404);
		exit(json_encode(['error' => display_errors($payroll->errors)]));
	}
}

?>