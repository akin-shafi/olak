<?php

require_once('../../private/initialize.php');

if (isset($_POST['selectClient'])) {
  $id = $_POST['id'];
  $client = Client::find_by_id($id);
  // $vehicle = Vehicle::find_client_id($id);

  exit(json_encode(
    [
      'client' => $client->full_name(),
      'client_id' => $client->id,
      // 'plate_no' => $vehicle->plate_no
    ]
  ));
}

