<?php
require_once('../../private/initialize.php');

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
        $response['errors'] = $leave->errors[0];
      else :
        http_response_code(201);
        $response['message'] = 'Employee leave created successfully!';
      endif;
    endif;
  }
}

if (is_get_request()) {
  if (isset($_GET['leaveId']) && !isset($_GET['deleted'])) {
    $leave = EmployeeLeave::find_by_id($_GET['leaveId']);

    http_response_code(200);
    $response['data'] = $leave;
  }

  if (isset($_GET['deleted'])) {
    EmployeeLeave::deleted($_GET['leaveId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
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
