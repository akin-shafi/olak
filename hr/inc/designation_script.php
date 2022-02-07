<?php
require_once('../../private/initialize.php');

$response = [
  'errors' => null,
  'message' => '',
  'data' => '',
];

if (is_post_request()) {
  if (isset($_POST['addDesignation'])) {
    $args = [
      'designation_name' => $_POST['designation_name'],
      'department_id' => $_POST['department_id'],
    ];

    $designation = new Designation($args);
    $designation->save();

    if ($designation->errors) :
      http_response_code(401);
      $response['errors'] = display_errors($designation->errors);
    else :
      http_response_code(201);
      $response['message'] = 'Designation created successfully!';
    endif;
  }

  if (isset($_POST['update'])) {

    if (isset($_POST['designationId'])) {
      $designation = Designation::find_by_id($_POST['designationId']);

      $args = [
        'designation_name' => $_POST['designation_name'],
        'department_id' => $_POST['department_id'],
      ];

      $designation->merge_attributes($args);
      $designation->save();

      if ($designation) :
        http_response_code(200);
        $response['message'] = 'Designation updated successfully';
      endif;
    }
  }
}

if (is_get_request()) {
  if (isset($_GET['designationId']) && !isset($_GET['deleted'])) {
    $designation = Designation::find_by_id($_GET['designationId']);

    http_response_code(200);
    $response['data'] = $designation;
  }

  if (isset($_GET['deleted'])) {
    Designation::deleted($_GET['designationId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }
}

exit(json_encode($response));
