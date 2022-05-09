<?php
require_once('../../../private/initialize.php');

if (is_post_request()) {
  if (isset($_POST['new_stock'])) {
    $args = $_POST['stock'];


    $stock = new Stock($args);
    $stock->save();

    if (!empty($stock->errors)) :
      http_response_code(401);
      exit(json_encode(['errors' => display_errors($stock->errors)]));
    else :
      http_response_code(201);
      exit(json_encode(['message' => 'Stock added successfully!']));
    endif;
  }

  if (isset($_POST['edit_stock'])) {

    if (isset($_POST['stockId'])) {
      $stock = Stock::find_by_id($_POST['stockId']);

      $args = $_POST['stock'];

      $stock->merge_attributes($args);
      $stock->save();

      if ($stock) :
        http_response_code(200);
        exit(json_encode(['message' => 'Stock updated successfully!']));
      endif;
    }
  }

  if (isset($_POST['delete_stock'])) {
    Stock::deleted($_POST['stockId']);

    http_response_code(200);
    exit(json_encode(['message' => 'Stock deleted successfully!']));
  }
}

if (is_get_request()) {
  if (isset($_GET['get_stock'])) {
    $stock = Stock::find_by_id($_GET['stockId']);

    exit(json_encode(['data' => $stock]));
  }
}
