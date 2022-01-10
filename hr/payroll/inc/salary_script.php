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

  if (isset($_POST['adding']) && !isset($_POST['update'])) {
    $args = $_POST['addition'];

    $addition = new PayrollAddition($args);
    $addition->save();

    if (is_blank($addition->name)) {
      http_response_code(401);
      exit(json_encode(['errors' => "Name is required."]));
    }

    http_response_code(201);
    $response['message'] = 'Payroll addition created successfully!';
  }

  if (isset($_POST['reducing']) && !isset($_POST['update'])) {
    $args = $_POST['deduction'];

    $deduction = new PayrollDeduction($args);
    $deduction->save();

    if (is_blank($deduction->name)) {
      http_response_code(401);
      exit(json_encode(['errors' => "Name is required."]));
    }

    http_response_code(201);
    $response['message'] = 'Payroll deduction created successfully!';
  }

  if (isset($_POST['overtimes']) && !isset($_POST['update'])) {
    $args = $_POST['overtime'];

    $overtime = new PayrollOvertime($args);
    $overtime->save();

    if (is_blank($overtime->name)) {
      http_response_code(401);
      exit(json_encode(['errors' => "Name is required."]));
    }

    http_response_code(201);
    $response['message'] = 'Payroll overtime created successfully!';
  }

  if (isset($_POST['update'])) {

    if (isset($_POST['editAdding'])) {
      $addition = PayrollAddition::find_by_id($_POST['addId']);
      $args = $_POST['addition'];

      $addition->merge_attributes($args);
      $addition->save();

      if ($addition) :
        http_response_code(200);
        $response['message'] = 'Addition updated successfully';
      endif;
    }

    if (isset($_POST['editOvertime'])) {
      $overtime = PayrollOvertime::find_by_id($_POST['overId']);
      $args = $_POST['overtime'];

      $overtime->merge_attributes($args);
      $overtime->save();

      if ($overtime) :
        http_response_code(200);
        $response['message'] = 'Overtime updated successfully';
      endif;
    }

    if (isset($_POST['editDeduction'])) {
      $deduction = PayrollDeduction::find_by_id($_POST['deductId']);
      $args = $_POST['deduction'];

      $deduction->merge_attributes($args);
      $deduction->save();

      if ($deduction) :
        http_response_code(200);
        $response['message'] = 'Deduction updated successfully';
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

  if (isset($_GET['addId'])) {
    $addition = PayrollAddition::find_by_id($_GET['addId']);
    http_response_code(200);
    $response['data'] = $addition;
  }

  if (isset($_GET['overId'])) {
    $overtime = PayrollOvertime::find_by_id($_GET['overId']);
    http_response_code(200);
    $response['data'] = $overtime;
  }

  if (isset($_GET['deductId'])) {
    $deduction = PayrollDeduction::find_by_id($_GET['deductId']);
    http_response_code(200);
    $response['data'] = $deduction;
  }

  if (isset($_GET['deleted'])) {
    Salary::deleted($_GET['salaryId']);
    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }

  if (isset($_GET['deleteAddition'])) {
    PayrollAddition::deleted($_GET['delId']);
    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }

  if (isset($_GET['deleteDeduction'])) {
    PayrollDeduction::deleted($_GET['delId']);
    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }

  if (isset($_GET['deleteOvertime'])) {
    PayrollOvertime::deleted($_GET['delId']);
    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }
}

exit(json_encode($response));
