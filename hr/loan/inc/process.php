<?php require_once('../../private/initialize.php');

if (is_post_request()) {

  if (isset($_POST['updatedLongLoan'])) {
    $args = $_POST['loan'];
    $longTermDetailId = $_POST['updatedLongLoan'];

    $longTDet = LongTermLoanDetail::find_by_id($longTermDetailId);
    $data = [
      'commitment_duration' => $args['loan_duration'],
      'loan_repayment' => $args['loan_deduction'],
      'note' =>  $args['note'],
      'date_approved' =>  $longTDet->date_approved,
    ];

    $longTDet->merge_attributes($data);
    $longTDet->save();

    if ($longTDet) {
      $queryParam = ['requested' => date('Y-m-d H:i', strtotime($longTDet->created_at))];
      $longTerm = LongTermLoan::find_by_employee_id(['employee_id' => $longTDet->employee_id], $queryParam);

      $data = [
        'amount_requested' => $args['amount'],
        'commitment' => $args['loan_deduction'],
        'amount_paid' => 0,
        'deduction_date' => $args['deduction_date'],
        'loan_duration' => $args['loan_duration'],
      ];

      $longTerm->merge_attributes($data);
      $result_set = $longTerm->save();
      if ($result_set == true) {
        exit(json_encode(['message' => 'Loan updated successful!']));
      }
    }
  }

  if (isset($_POST['removeLL'])) {
    $longTermDetailId = $_POST['removeLL'];

    $longTDet = LongTermLoanDetail::find_by_id($longTermDetailId);
    $longTDet::deleted($longTermDetailId);

    if ($longTDet) {
      $queryParam = ['requested' => date('Y-m-d H:i', strtotime($longTDet->created_at))];
      $longTerm = LongTermLoan::find_by_employee_id(['employee_id' => $longTDet->employee_id], $queryParam);
      $longTerm::deleted($longTerm->id);
    }

    exit(json_encode(['message' => 'Long term deleted successful!']));
  }




  // ? SALARY ADVANCE
  if (isset($_POST['updatedSalaryAdvance'])) {
    $args = $_POST['loan'];
    $salaryAdvanceId = $_POST['updatedSalaryAdvance'];

    $salAdvanceDet = SalaryAdvanceDetail::find_by_id($salaryAdvanceId);

    $data = [
      'amount' => $args['amount'],
      'note' =>  $args['note'],
      'date_issued' =>  $salAdvanceDet->date_issued,
    ];

    $salAdvanceDet->merge_attributes($data);
    $salAdvanceDet->save();

    if ($salAdvanceDet) {
      $queryParam = ['current' => date('Y-m', strtotime($salAdvanceDet->date_requested))];
      $salaryAdvance = SalaryAdvance::find_by_employee_id($salAdvanceDet->employee_id, $queryParam);

      $data = ['total_requested' => $salAdvanceDet->total_loan_received];

      $salaryAdvance->merge_attributes($data);
      $salaryAdvance->save();
    }

    exit(json_encode(['message' => 'Loan updated successful!']));
  }

  if (isset($_POST['removeSA'])) {
    $salAdDetId = $_POST['removeSA'];

    $salAdDet = SalaryAdvanceDetail::find_by_id($salAdDetId);
    $salAdDet::deleted($salAdDetId);

    if ($salAdDet) {
      $queryParam = ['current' => date('Y-m', strtotime($salAdDet->date_requested))];
      $salAdvance = SalaryAdvance::find_by_employee_id($salAdDet->employee_id, $queryParam);
      $amountRequested = $salAdvance->total_requested;
      $amount = $salAdDet->amount;
      $balance = intval($amountRequested) - intval($amount);
      $salAdvance->merge_attributes(['total_requested' => $balance]);
      $salAdvance->save();

      if ($salAdvance->total_requested <= 0) {
        $salAdvance::deleted($salAdvance->id);
      }
    }

    exit(json_encode(['message' => 'Salary advance deleted successful!']));
  }




  // ? LONG TERM LOAN
  if (isset($_POST['special_loan'])) {
    $args = $_POST['loan'];
    $longTermDetailId = $_POST['special_loan'];

    $longTDet = LongTermLoanDetail::find_by_id($longTermDetailId);

    $ref = 'LTL-' . rand(100, 999) . '0' . $longTDet->employee_id;

    $data = [
      'employee_id' =>  $longTDet->employee_id,
      'ref_no' =>  $ref,
      'commitment_duration' => $args['loan_duration'],
      'loan_repayment' => $args['loan_deduction'],
      'type' =>  2,
      'status' =>  3,
      'note' =>  $args['note'],
      'issued_by' => $loggedInAdmin->id,
      'date_approved' => date('Y-m-d H:i:s'),
    ];

    $longTDet = new LongTermLoanDetail($data);
    $longTDet->save();

    if ($longTDet) {
      $longTerm = LongTermLoan::find_by_employee_id(['employee_id' => $longTDet->employee_id]);

      $data = [
        'amount_requested' => $args['amount'],
        'amount_paid' => $args['amount_paid'],
        'commitment' => $args['loan_deduction'],
        'deduction_date' => $args['deduction_date'],
      ];

      $longTerm->merge_attributes($data);
      $longTerm->save();
    }

    exit(json_encode(['message' => 'Loan reviewed successful!']));
  }
}


if (is_get_request()) {
  if (isset($_GET['longId'])) {
    $longTermDetail = LongTermLoanDetail::find_by_id($_GET['longId']);
    $requested = date('Y-m-d H:i', strtotime($longTermDetail->created_at));
    $employee_id = $longTermDetail->employee_id;
    $longTerm = LongTermLoan::find_by_employee_id(['employee_id' => $employee_id, 'requested' => $requested]);

    $data = [
      'employee_id' => $longTermDetail->employee_id,
      'amount_requested' => $longTerm->amount_requested,
      'commitment' => $longTerm->commitment,
      'amount_paid' => $longTerm->amount_paid,
      'deduction_date' => $longTerm->deduction_date,
      'type' => $longTermDetail->type,
      'duration' => $longTermDetail->commitment_duration,
      'loan_repayment' => $longTerm->commitment,
      'note' => $longTermDetail->note,
    ];

    http_response_code(200);
    exit(json_encode(['data' => $data]));
  }

  if (isset($_GET['salAdvId'])) {
    $salAdDet = SalaryAdvanceDetail::find_by_id($_GET['salAdvId']);
    $queryParam = ['requested' => date('Y-m-d H:i', strtotime($salAdDet->date_requested))];
    $salAdvance = SalaryAdvance::find_by_employee_id($salAdDet->employee_id, $queryParam);

    $data = [
      'employee_id' => $salAdDet->employee_id,
      'amount' => $salAdDet->amount,
      'note' => $salAdDet->note,
      'total_requested' => $salAdvance->total_requested,
    ];

    http_response_code(200);
    exit(json_encode(['data' => $data]));
  }
}
