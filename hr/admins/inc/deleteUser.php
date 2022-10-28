<?php require_once('../../private/initialize.php');

if (is_post_request()) {
  $id = $_POST['userId'];

  $admin = Admin::find_by_id($id);

  $admin::deleted($id);

  exit(json_encode(['success' => true, 'msg' => 'User deleted successful!']));
}
