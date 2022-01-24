<?php
require_once('../../private/initialize.php');

$loanDir = '../../assets/uploads/loans/';

$response = [
  'errors' => null,
  'message' => '',
  'data' => '',
];


if (isset($_POST['loan'])) {
  if (isset($_POST['loanId'])) {
    $loan = EmployeeLoan::find_by_id($_POST['loanId']);
    $args = $_POST['loan'];
    $loan->merge_attributes($args);
    $loan->save();

    http_response_code(200);
    $response['message'] = 'Employee loan updated successfully';
  } else {

    $args = $_POST['loan'];
    $employeeId = $args['employee_id'];

    $args['ref_no'] = 'SAL-' . rand(100, 999) . '0' . $employeeId; //? SAL: Salary Advance Loan

    $employee = Employee::find_by_id($employeeId);

    $accessible_loan_value = intval($employee->present_salary) * 0.4;
    $salaryAdvance = SalaryAdvance::find_by_employee_id($employeeId);
    if (isset($salaryAdvance)) {
      $loan_balance = $accessible_loan_value - intval($salaryAdvance->total_requested);
    }

    if ($args['type'] == 1) {
      if (($args['amount'] > $accessible_loan_value || $args['amount'] > $loan_balance)) {
        http_response_code(404);
        exit(json_encode(['errors' => 'Monthly allowed limit exceeded!']));
      }
    }

    if (!empty($_FILES['filename']['name'])) {
      $temp = explode('.', $_FILES['filename']['name']);
      $fileName = basename(round(microtime(true)) . '.' . end($temp));
      $loanFilePath = $loanDir . $fileName;
      $fileType = pathinfo($loanFilePath, PATHINFO_EXTENSION);

      $allowTypes = ['jpeg', 'jpg', 'png', 'pdf'];
      if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['filename']['tmp_name'], $loanFilePath)) {
          $args['file_upload'] = $fileName;
        }
      } else {
        $uploadStatus = 0;
        http_response_code(404);
        $response['errors'] = 'Sorry, JPEG, JPG, PDF & PNG files are allowed to upload.';
      }
    }

    $loan = new SalaryAdvanceDetail($args);
    $loan->save();

    if ($loan) {
      $advanceDetails = SalaryAdvanceDetail::find_by_employee_id($loan->employee_id, ['requested' => date('Y-m-d')]);
      if (!empty($salaryAdvance->employee_id)) {
        $salaryAdvance->merge_attributes(['total_requested' => $advanceDetails->total_loan_received]);
        $salaryAdvance->save();
      } else {
        $params = [
          'employee_id' => $loan->employee_id,
          'total_requested' => $args['amount'],
        ];
        $advance = new SalaryAdvance($params);
        $advance->save();
      }
    }

    if ($loan->errors) :
      http_response_code(401);
      $response['errors'] = $loan->errors[0];
    else :
      http_response_code(201);
      $response['message'] = 'Employee loan created successfully!';
    endif;
  }
}

exit(json_encode($response));
