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
		$month = date('Y-').$_POST['month'].date('-d');

		$config = Configuration::find_by_date($month);
		// $find_date = Configuration::find_by_date($month);
		$status = '';
		if (empty($config)) {
			$status = 'New';
			$data = [
				'loan_config' => 1,
				'process_salary' => 1,
				'visibility' => 1,
				'process_salary_date' => $month,
			];
			$config = new Configuration($data);
			$result = $config->save();

		}else{
			$status = 'Edit';
			$data = [
				'process_salary' => 1,
				'process_salary_date' => $month,
			];
			$config->merge_attributes($data);
			$result = $config->save();
		}
		
		if ($result == true) {
			if ($status == 'New') {
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
			}else{
				$payroll = Payroll::find_by_created_at($month);
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
			}
			
			
		} else {
			http_response_code(404);
			exit(json_encode(['error' => display_errors($staff_salary->errors)]));
		}
	}
	if ($_POST['push']) {
			// $month = $_POST['month'] ?? date('Y-m');
			$month = date('Y-').$_POST['month'];
			$config = Configuration::find_by_date($month);
			$data = [
				'visibility' => 1,
			];
			$config->merge_attributes($data);
			$config->save();
			// $config = true;
			
			if ($config == true) {
					$payrolls = Payroll::find_by_month($month);
					foreach($payrolls as $value){
						$update = Payroll::find_by_id($value->id);
						$args = [
							'payment_status' => 2
						];

						$update->merge_attributes($args);
						$update->save();

					}

				http_response_code(200);
				exit(json_encode(['success' => true, 'msg' => 'Pushed Successfully!']));

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
