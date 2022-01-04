<?php
require_once('../../private/initialize.php');

$response = [
  'errors' => null,
  'message' => '',
  'data' => '',
];

if (is_post_request()) {
  if (isset($_POST['addSalary'])) {

    $argsSalary     = $_POST['salary'];
    $argsEarning    = $_POST['earning'];
    $argsDeduction  = $_POST['deduction'];

    $salary = new Salary($argsSalary);
    $salary->save();

    if ($salary->errors) :
      http_response_code(401);
      exit(json_encode(['errors' => display_errors($salary->errors)]));
    endif;

    if ($salary) {
      $netSalary = Salary::find_by_id($salary->id);

      $argsEarning['salary_id'] = $salary->id;
      $earning = new SalaryEarning($argsEarning);
      $earning->save();

      $argsDeduction['salary_id'] = $salary->id;
      $deduction = new SalaryDeduction($argsDeduction);
      $deduction->save();

      if ($deduction) {
        $totalEarning = SalaryEarning::find_by_earnings()->total_earnings;
        $totalDeduction = SalaryDeduction::find_by_deductions()->total_deductions;

        $net = intval($totalEarning) - intval($totalDeduction);
        $args = ['net_salary' => $net];

        $netSalary->merge_attributes($args);
        $netSalary->save();
      }

      http_response_code(201);
      $response['message'] = 'Salary created successfully!';
    }
  }

  if (isset($_POST['update'])) {

    if (isset($_POST['salaryId'])) {
      $salary = Salary::find_by_salaries($_POST['salaryId']);
      $earning = SalaryEarning::find_by_id($salary->e_id);
      $deduction = SalaryDeduction::find_by_id($salary->d_id);

      $argsSalary     = $_POST['salary'];
      $argsEarning    = $_POST['earning'];
      $argsDeduction  = $_POST['deduction'];

      $earning->merge_attributes($argsEarning);
      $earning->save();

      $deduction->merge_attributes($argsDeduction);
      $deduction->save();

      if ($deduction) {
        $netSalary = Salary::find_by_id($deduction->salary_id);

        $totalEarning = SalaryEarning::find_by_earnings()->total_earnings;
        $totalDeduction = SalaryDeduction::find_by_deductions()->total_deductions;

        $net = intval($totalEarning) - intval($totalDeduction);
        $args = ['net_salary' => $net];

        $netSalary->merge_attributes($args);
        $netSalary->save();
      }

      if ($salary) :
        http_response_code(200);
        $response['message'] = 'Salary updated successfully';
      endif;
    }
  }
}

if (is_get_request()) {
  if (isset($_GET['salaryId']) && !isset($_GET['deleted'])) {
    $salary = Salary::find_by_salaries($_GET['salaryId']);

    http_response_code(200);
    $response['data'] = $salary;
  }

  if (isset($_GET['deleted'])) {
    Salary::deleted($_GET['salaryId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }
}

exit(json_encode($response));
