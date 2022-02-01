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

	if (isset($_POST['genPaySlip'])) {
		$employees = Employee::find_by_undeleted();

		foreach ($employees as $value) {
			$salary_advance = SalaryAdvance::find_by_employee_id($value->id);
			$salary = intval($value->present_salary);
			$commitment = isset($empLoan->commitment) ? $empLoan->commitment : '0.00';

			$args = [
				'employee_id' => $value->id,
				'present_salary' => $salary,
				'loan' => $commitment,
				'salary_advance' => $salary_advance->total_requested,
				'present_days' => $_POST['present_day'],
				'payment_status' => 1,
			];

			$staff_salary = new Payroll($args);
			$result = $staff_salary->save();
		}

		if ($result == true) {
			$config = Configuration::find_by_id(1);
			$data = [
				'process_salary' => 1,
				'process_salary_date' => date('Y-m-d'),
			];

			$config->merge_attributes($data);
			$config->save();
			exit(json_encode(['success' => true, 'msg' => 'Sent successful']));
		} else {
			http_response_code(404);
			exit(json_encode(['error' => display_errors($staff_salary->errors)]));
		}
	}

	if (isset($_POST['salary'])) {
		$args = $_POST['salary'];
		if (isset($args['employee_id'])) {
			$salary = Payroll::find_by_employee_id($args['employee_id']);
			$salary->merge_attributes($args);
			$salary->save();

			if ($salary) {
				http_response_code(200);
				$response['message'] = 'Payroll narration updated successfully';
			}
		}
	}
}

if (is_get_request()) {
	if (isset($_GET['salary_data'])) {
		$employee = Employee::find_by_id($_GET['empId']);

		http_response_code(200);
		exit(json_encode(['data' => $employee]));
	}
}

exit(json_encode($response));
