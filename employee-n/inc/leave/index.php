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

      $dateRange  = $_POST['daterange'];
      $ex         = explode('-', $dateRange);
      $from       = $ex[0];
      $to         = $ex[1];
      $duration   = time_diff_string($from, $to, true);

      $args['employee_id']  = $loggedInAdmin->id;
      $args['date_from']    = date('Y-m-d', strtotime($from));
      $args['date_to']      = date('Y-m-d', strtotime($to));
      $args['duration']     = $duration;

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
