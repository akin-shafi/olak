<?php
require_once('../../private/initialize.php');

$avatarDir = '../../assets/uploads/profiles/';
$loanDir = '../../assets/uploads/loans/';
$documentDir = '../../assets/uploads/documents/';

$response = [
  'errors' => null,
  'message' => '',
  'data' => '',
];

if (is_post_request()) {

  if (isset($_POST['leave'])) {
    $args = $_POST['leave'];

    if (isset($_POST['leaveId'])) :
      $leave = EmployeeLeave::find_by_id($_POST['leaveId']);

      $leave->merge_attributes($args);
      $leave->save();

      http_response_code(200);
      $response['message'] = 'Employee leave updated successfully';
    else :

      if (isset($args['employee_id'])) :
        $employeeId = $args['employee_id'];
      else :
        $employeeId = $loggedInAdmin->id;
      endif;

      $dateRange  = $_POST['daterange'];
      $ex         = explode('-', $dateRange);
      $from       = $ex[0];
      $to         = $ex[1];
      $duration   = time_diff_string($from, $to, true);


      $date_from = new DateTime($from);
      $date_to = new DateTime($to);

      $dateDiff = $date_from->diff($date_to)->days;

      $employeeLeave = EmployeeLeave::find_by_employee_leave_type($employeeId, $args['leave_type']);
      $leaveType = EmployeeLeaveType::find_by_id($args['leave_type']);

      if (isset($employeeLeave->leave_type) && $dateDiff > $employeeLeave->days_left) :
        $numberOfDaysLeft = $employeeLeave->days_left != '' ? $employeeLeave->days_left : 0;
        exit(json_encode(['errors' => 'You have ' . $numberOfDaysLeft . ' day(s) left for ' . $leaveType->name]));
      endif;

      if ($dateDiff > $leaveType->duration) :
        exit(json_encode(['errors' => 'Maximum number of days set for ' . $leaveType->name . ' is ' . $leaveType->duration]));
      endif;

      $days_left = $leaveType->duration - $dateDiff;

      $args['employee_id']  = $employeeId;
      $args['date_from']    = date('Y-m-d', strtotime($from));
      $args['date_to']      = date('Y-m-d', strtotime($to));
      $args['duration']     = $duration;
      $args['days_left']    = $days_left;

      $leave = new EmployeeLeave($args);
      $leave->save();

      if ($leave->errors) :
        http_response_code(401);
        $response['errors'] = $leave->errors;
      else :
        http_response_code(201);
        $response['message'] = 'Employee leave created successfully!';
      endif;
    endif;
  }

  if (isset($_POST['personal'])) {
    if (isset($_POST['personalId'])) {
      $personal = Employee::find_by_id($_POST['personalId']);
      $args = $_POST['personal'];

      if (!empty($_FILES['avatar']['name'])) {
        $temp = explode('.', $_FILES['avatar']['name']);
        $fileName = basename(round(microtime(true)) . '.' . end($temp));
        $targetFilePath = $avatarDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = ['jpeg', 'jpg', 'png'];
        if (in_array($fileType, $allowTypes)) {
          if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFilePath)) {
            $args['photo'] = $fileName;
          }
        } else {
          http_response_code(404);
          $response['errors'] = 'Sorry, JPEG, JPG & PNG files are allowed to upload.';
        }
      }

      $personal->merge_attributes($args);
      $personal->save();
      if ($personal->errors) {
        http_response_code(401);
        exit(json_encode(['errors' => $personal->errors[0]]));
      } else {
        http_response_code(200);
        $response['message'] = 'Employee information updated successfully';
      }
    } else {
      $args = $_POST['personal'];

      if (!empty($_FILES['avatar']['name'])) {
        $temp = explode('.', $_FILES['avatar']['name']);
        $fileName = basename(round(microtime(true)) . '.' . end($temp));
        $targetFilePath = $avatarDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = ['jpeg', 'jpg', 'png'];
        if (in_array($fileType, $allowTypes)) {
          if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFilePath)) {
            $args['photo'] = $fileName;
          }
        } else {
          http_response_code(404);
          $response['errors'] = 'Sorry, JPEG, JPG & PNG files are allowed to upload.';
        }
      }

      $personal = new Employee($args);
      $personal->save();

      if ($personal->errors) {
        http_response_code(401);
        exit(json_encode(['errors' => $personal->errors]));
      } else {
        http_response_code(201);
        $response['message'] = 'Employee created successfully!';
      }
    }
  }

  if (isset($_POST['company'])) {

    $args = $_POST['company'];
    $employee = Employee::find_by_id($_POST['empId']);
    $company  = Company::find_by_id($args['company_id'])->company_name;
    $branch   = Branch::find_by_id($args['branch_id'])->branch_name;
    $dep_name = Department::find_by_id($args['department_id'])->department_name;
    $des_name = Designation::find_by_id($args['job_title_id'])->designation_name;

    $args['employee_id'] = $args['employee_number'];
    $args['department'] = $dep_name;
    $args['job_title'] = $des_name;
    $args['company'] = $company;
    $args['branch'] = $branch;

    $employee->merge_attributes($args);
    $employee->save();

    http_response_code(201);
    $response['message'] = 'Employee updated successfully!';
  }

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
      } else {
        $loan_balance = 0;
      }

      if ($args['type'] == 1) {
        if (($args['amount'] > $accessible_loan_value || ($loan_balance != 0 && $args['amount'] > $loan_balance))) {
          http_response_code(404);
          exit(json_encode(['errors' => 'Monthly allowed limit exceeded!']));
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

        if ($loan->errors) {
          http_response_code(401);
          exit(json_encode(['errors' => $loan->errors]));
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

  if (isset($_POST['bank'])) {
    if (isset($_POST['bankId'])) :
      $bank = Employee::find_by_id($_POST['bankId']);

      $args = $_POST['bank'];
      $bank->merge_attributes($args);
      $bank->save();

      http_response_code(200);
      $response['message'] = 'Employee bank updated successfully';
    endif;
  }

  if (isset($_POST['department'])) {
    if (isset($_POST['departmentId'])) {
      $department = Department::find_by_id($_POST['departmentId']);
      $args = $_POST['department'];
      $department->merge_attributes($args);
      $department->save();

      http_response_code(200);
      $response['message'] = 'Department updated successfully';
    } else {
      $args = $_POST['department'];
      $department = new Department($args);
      $department->save();

      if ($department->errors) :
        http_response_code(401);
        $response['errors'] = $department->errors;
      else :
        http_response_code(201);
        $response['message'] = 'Department created successfully!';
      endif;
    }
  }

  if (isset($_POST['attendance'])) {
    $employeeId = $_POST['employeeId'];
    $attendance = EmployeeAttendance::find_by_employee_id($employeeId, ['clock_in' => date('Y-m-d')]);
    $isClockedIn = isset($attendance->clock_in) && ($attendance->clock_in != '00:00:00') ? true : false;

    $args = $_POST['attendance'];
    $args['employee_id'] = $employeeId;

    if (!$isClockedIn) {
      $args['clock_in'] = date('h:i:s:a');
      $clockIn = new EmployeeAttendance($args);
      $clockIn->save();
    } else {
      $args['clock_out'] = date('h:i:s:a');
      $attendance->merge_attributes($args);
      $attendance->save();
    }

    http_response_code(200);
    $response['message'] = 'Attendance updated successfully';
  }
}

if (is_get_request()) {
  if (isset($_GET['employeeId']) && !isset($_GET['deleted'])) {
    $employee = Employee::find_by_id($_GET['employeeId']);

    $accessible_loan_value = intval($employee->present_salary) * 0.4;
    $salaryAdvance = SalaryAdvance::find_by_employee_id($employee->id);
    if (isset($salaryAdvance)) {
      $loan_balance = $accessible_loan_value - intval($salaryAdvance->total_requested);
    }

    http_response_code(200);
    $response['data'] = $employee;
    $response['balance'] = $loan_balance;
  }

  if (isset($_GET['departmentId']) && !isset($_GET['deleted'])) {
    $department = Department::find_by_id($_GET['departmentId']);

    http_response_code(200);
    $response['data'] = $department;
  }

  if (isset($_GET['deleteDept'])) {
    Department::deleted($_GET['departmentId']);

    http_response_code(200);
    $response['message'] = 'Department deleted successfully';
  }

  if (isset($_GET['leaveId'])) {
    $leave = EmployeeLeave::find_by_id($_GET['leaveId']);
    $leave_status = $_GET['leave_status'];

    switch ($leave_status):
      case 'pending':
        $status = 2;
        break;
      case 'accept':
        $status = 3;
        break;
      default:
        $status = 4;
        break;
    endswitch;

    $args = [
      'status' => $status,
      'approved_by' => $loggedInAdmin->id,
      'date_approved' => date('Y-m-d'),
    ];

    $leave->merge_attributes($args);
    $leave->save();

    http_response_code(200);
    $response['message'] = 'Status updated successfully!';
  }

  if (isset($_GET['emId'])) {
    $loan = EmployeeLoan::find_by_employee_id($_GET['emId']);
    $status = $_GET['status'];

    $args = [
      'status' => $status,
      'date_issued' => date('Y-m-d H:i:s'),
    ];

    $loan->merge_attributes($args);
    $loan->save();

    http_response_code(200);
    $response['message'] = 'Status updated successfully!';
    $response['data'] = $loan;
  }

  if (isset($_GET['deleted'])) {
    Employee::deleted($_GET['employeeId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }

  if (isset($_GET['deleteEducation'])) {
    EmployeeEducation::deleted($_GET['educationId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }

  if (isset($_GET['deleteExperience'])) {
    EmployeeExperience::deleted($_GET['experienceId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }

  if (isset($_GET['salary_advance_status'])) {
    $leave = SalaryAdvanceDetail::find_by_id($_GET['detailId']);
    $loan_status = $_GET['salary_advance_status'];

    if ($loan_status == 3) :
      $dateIssued = date('Y-m-d');
    endif;

    $args = [
      'status' => $loan_status,
      'date_issued' => $dateIssued ?? '',
    ];

    $leave->merge_attributes($args);
    $leave->save();

    http_response_code(200);
    $response['message'] = 'Status updated successfully!';
  }

  if (isset($_GET['long_term_status'])) {
    $leave = LongTermLoanDetail::find_by_id($_GET['detailId']);
    $loan_status = $_GET['long_term_status'];

    if ($loan_status == 2) :
      $dateApproved = date('Y-m-d');
    endif;

    $args = [
      'status' => $loan_status,
      'issued_by' => $loggedInAdmin->id,
      'date_approved' => $dateApproved ?? '',
    ];

    $leave->merge_attributes($args);
    $leave->save();

    http_response_code(200);
    $response['message'] = 'Status updated successfully!';
  }

  if (isset($_GET['clear_loan'])) {
    $clear = EmployeeLoan::clear_loan_requests(date('Y-m-d'));

    foreach ($clear as $value) {
      EmployeeLoan::deleted($value->id);
    }

    http_response_code(200);
    $response['message'] = 'Record cleared successfully';
  }
}

exit(json_encode($response));
