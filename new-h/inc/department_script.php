<?php
require_once('../../private/initialize.php');

$response = [
  'errors' => null,
  'message' => '',
  'data' => '',
];

if (is_post_request()) {
  if (isset($_POST['addDepartment'])) {
    $args = [
      'department_name' => $_POST['department_name'],
    ];

    $department = new Department($args);
    $department->save();

    if ($department->errors) :
      http_response_code(401);
      $response['errors'] = display_errors($department->errors);
    else :
      http_response_code(201);
      $response['message'] = 'Department created successfully!';
    endif;
  }

  if (isset($_POST['update'])) {

    if (isset($_POST['departmentId'])) {
      $department = Department::find_by_id($_POST['departmentId']);

      $args = [
        'department_name' => $_POST['department_name'],
      ];

      $department->merge_attributes($args);
      $department->save();

      if ($department) :
        http_response_code(200);
        $response['message'] = 'Department updated successfully';
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

  if (isset($_GET['deleted'])) {
    Department::deleted($_GET['departmentId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }
}

exit(json_encode($response));
