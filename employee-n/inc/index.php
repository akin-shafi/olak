<?php
require_once('../../private/initialize.php');


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
