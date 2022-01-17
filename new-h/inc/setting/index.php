<?php
require_once('../../private/initialize.php');

$uploadDir = '../../assets/uploads/';
$loanDir = '../../assets/uploads/loan/';
$response = [
  'errors' => null,
  'message' => '',
  'data' => '',
];

if (is_post_request()) {
  if (isset($_POST['department'])) {
    if (isset($_POST['departmentId']) && $_POST['departmentId'] != '') {
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
        $response['errors'] = $department->errors[0];
      else :
        http_response_code(201);
        $response['message'] = 'Department created successfully!';
      endif;
    }
  }

  if (isset($_POST['designation'])) {
    if (isset($_POST['designationId']) && $_POST['designationId'] != '') {
      $designation = Designation::find_by_id($_POST['designationId']);
      $args = $_POST['designation'];
      $designation->merge_attributes($args);
      $designation->save();

      http_response_code(200);
      $response['message'] = 'Designation updated successfully';
    } else {
      $args = $_POST['designation'];
      $designation = new Designation($args);
      $designation->save();

      if ($designation->errors) :
        http_response_code(401);
        $response['errors'] = $designation->errors[0];
      else :
        http_response_code(201);
        $response['message'] = 'Designation created successfully!';
      endif;
    }
  }
}

if (is_get_request()) {
  if (isset($_GET['departmentId']) && !isset($_GET['deleted'])) {
    $department = Department::find_by_id($_GET['departmentId']);

    http_response_code(200);
    $response['data'] = $department;
  }

  if (isset($_GET['designationId']) && !isset($_GET['deleted'])) {
    $designation = Designation::find_by_id($_GET['designationId']);

    http_response_code(200);
    $response['data'] = $designation;
  }

  if (isset($_GET['deleteDept'])) {
    Department::deleted($_GET['departmentId']);

    http_response_code(200);
    $response['message'] = 'Department deleted successfully';
  }

  if (isset($_GET['deleteDes'])) {
    Designation::deleted($_GET['designationId']);

    http_response_code(200);
    $response['message'] = 'Designation deleted successfully';
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
