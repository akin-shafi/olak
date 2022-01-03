<?php
require_once('../../private/initialize.php');

$uploadDir = '../../assets/uploads/';
$response = [
  'errors' => null,
  'message' => '',
  'data' => '',
];

if (is_post_request()) {
  if (isset($_POST['addEmployee'])) {
    $uploadStatus = 1;
    $uploadedFile = '';

    if (!empty($_FILES['profile_image']['name'])) {

      $fileName = basename($_FILES['profile_image']['name']);
      $targetFilePath = $uploadDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

      $allowTypes = ['jpeg', 'jpg', 'png'];
      if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFilePath)) {
          $uploadedFile = $fileName;
        } else {
          $uploadStatus = 0;
          http_response_code(401);
          $response['errors'] = 'Sorry, there was an error uploading your file.';
        }
      } else {
        $uploadStatus = 0;
        http_response_code(404);
        $response['errors'] = 'Sorry, DOC, DOCX, JPEG, JPG, PDF & PNG files are allowed to upload.';
      }
    }

    $args = [
      'first_name' => $_POST['first_name'],
      'last_name' => $_POST['last_name'],
      'email' => $_POST['email'],
      'password' => $_POST['password'],
      'confirm_password' => $_POST['confirm_password'],
      'employee_id' => $_POST['employee_id'],
      'date_employed' => $_POST['date_employed'],
      'photo' => $uploadedFile,
      'phone' => $_POST['phone'],
      'department_id' => $_POST['department_id'],
      'designation_id' => $_POST['designation_id'],
    ];

    $employee = new Employee($args);
    $employee->save();

    if ($employee->errors) :
      http_response_code(401);
      $response['errors'] = display_errors($employee->errors);
    else :
      http_response_code(201);
      $response['message'] = 'Employee created successfully!';
    endif;
  }

  if (isset($_POST['update'])) {

    if (isset($_POST['employeeId'])) {
      $employee = Employee::find_by_id($_POST['employeeId']);

      if (!empty($_FILES['profile_image']['name'])) {
        $dbUpload = $employee->photo;

        if (file_exists($uploadDir . $dbUpload)) {
          unlink($uploadDir . $dbUpload);
        }

        $temp = explode('.', $_FILES['profile_image']['name']);
        $fileName = basename(round(microtime(true)) . '.' . end($temp));
        $targetFilePath = $uploadDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = ['jpeg', 'jpg', 'png'];
        if (in_array($fileType, $allowTypes)) {
          if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFilePath)) {
            $uploadedFile = $fileName;
          } else {
            $uploadStatus = 0;
            http_response_code(401);
            $response['errors'] = 'Sorry, there was an error uploading your file.';
          }
        } else {
          $uploadStatus = 0;
          http_response_code(404);
          $response['errors'] = 'Sorry, DOC, DOCX, JPEG, JPG, PDF & PNG files are allowed to upload.';
        }
      }

      $args = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'confirm_password' => $_POST['confirm_password'],
        'employee_id' => $_POST['employee_id'],
        'date_employed' => $_POST['date_employed'],
        'photo' => $uploadedFile != '' ? $uploadedFile : $employee->photo,
        'phone' => $_POST['phone'],
        'department_id' => $_POST['department_id'],
        'designation_id' => $_POST['designation_id'],
      ];

      $employee->merge_attributes($args);
      $employee->save();

      if ($employee) :
        http_response_code(200);
        $response['message'] = 'Employee updated successfully';
      endif;
    }
  }
}

if (is_get_request()) {
  if (isset($_GET['employeeId']) && !isset($_GET['deleted'])) {
    $employee = Employee::find_by_id($_GET['employeeId']);

    http_response_code(200);
    $response['data'] = $employee;
  }

  if (isset($_GET['deleted'])) {
    Employee::deleted($_GET['employeeId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }
}

exit(json_encode($response));
