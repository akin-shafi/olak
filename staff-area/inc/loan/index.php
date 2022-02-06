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

      $loan = new SalaryAdvanceDetail($args);
      $loan->save();
      if ($loan->errors) {
        http_response_code(401);
        exit(json_encode(['errors' => $loan->errors]));
      }

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

      
      
    } else {
      $args['commitment_duration'] = $args['loan_duration'];
      $args['loan_repayment'] = $args['loan_deduction'];

      $longTerm = new LongTermLoanDetail($args);
      $longTerm->save();

      if ($longTerm) {
        $longDetails = LongTermLoanDetail::find_by_employee_id($longTerm->employee_id);
        $longLoan = LongTermLoan::find_by_employee_id($longTerm->employee_id);

        if (!empty($longLoan->employee_id)) {
          $longLoan->merge_attributes(['amount_paid' => $longDetails->total_loan_refunded]);
          $longLoan->save();
        } else {
          $params = [
            'employee_id' => $args['employee_id'],
            'amount_requested' => $args['amount'],
            'amount_paid' => $args['loan_deduction'],
            'commitment' => $args['loan_deduction'],
          ];
          $longTermLoan = new LongTermLoan($params);
          $longTermLoan->save();
        }
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

    http_response_code(201);
    $response['message'] = 'Employee loan created successfully!';
  }
}

exit(json_encode($response));
