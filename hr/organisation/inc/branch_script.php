<?php
require_once('../../private/initialize.php');

$response = [
  'errors' => null,
  'message' => '',
  'data' => '',
];

if (is_post_request()) {
  if (isset($_POST) && !isset($_POST['update'])) {
    $args = $_POST;
    $branch = new Branch($args);
    $result = $branch->save();
    if ($result == true) {
      exit(json_encode(['message' => 'Created Successful', 'success' => true]));
    } else {
      http_response_code(401);
      $response['errors'] = display_errors($branch->errors);
    }
  }

  if (isset($_POST['update'])) {

    if (isset($_POST['branchId'])) {
      $branch = Branch::find_by_id($_POST['branchId']);

      $args = [
        'company_id' => $_POST['company_id'],
        'branch_name' => $_POST['branch_name'],
        'address' => $_POST['address'],
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'established_in' => $_POST['established_in'],
      ];

      $branch->merge_attributes($args);
      $branch->save();

      if ($branch) :
        http_response_code(200);
        $response['message'] = 'Branch updated successfully';
      endif;
    }
  }
}

if (is_get_request()) {
  if (isset($_GET['branchId']) && !isset($_GET['deleted'])) {
    $branch = Branch::find_by_id($_GET['branchId']);

    http_response_code(200);
    exit(json_encode(['data' => $branch]));
  }

  if (isset($_GET['deleted'])) {
    Branch::deleted($_GET['branchId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }
}

exit(json_encode($response));
