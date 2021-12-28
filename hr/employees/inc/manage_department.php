<?php
require_once('../../private/initialize.php');

$response = [
  'errors' => null,
  'message' => '',
  'data' => null,
];

if (is_post_request()) {
  if (isset($_POST['addDept'])) {
    $args = [
      'name' => $_POST['name'],
    ];

    $department = new Department($args);
    $department->save();

    if ($department->errors) :
      http_response_code(401);
      $response['errors'] = 'Kindly fill out the form as required!';
    else :
      http_response_code(201);
      $response['message'] = 'Department created successfully!';
    endif;
  }

  if (isset($_POST['update'])) {

    if (isset($_POST['departmentId'])) {
      $department = Department::find_by_id($_POST['departmentId']);

      $args = [
        'name' => $_POST['name'],
        'updated_at' => date('Y-m-d H:i:s'),
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
  if (isset($_GET['departmentId'])) {
    $department = Department::find_by_id($_GET['departmentId']);

    http_response_code(200);
    $response['data'] = $department;
  }

  if (isset($_GET['delete'])) {
    $depId = $_GET['departmentId'];

    $department = Department::deleted($depId);

    http_response_code(200);
    $response['message'] = 'Department deleted successfully';
  }
}

exit(json_encode($response));
