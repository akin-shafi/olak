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
  if (isset($_POST['addEmployee'])) {
    $uploadStatus = 1;
    $uploadedFile = '';

    $args = $_POST['employee'];

    if (!empty($_FILES['profile_image']['name'])) {

      $temp = explode('.', $_FILES['profile_image']['name']);
      $fileName = basename(round(microtime(true)) . '.' . end($temp));
      $targetFilePath = $uploadDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

      $allowTypes = ['jpeg', 'jpg', 'png'];
      if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFilePath)) {
          $uploadedFile = $fileName;
          $args['photo'] = $uploadedFile;
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
      $employeeId = $_POST['employeeId'];
      $employee = Employee::find_by_id($employeeId);

      if (isset($_POST['employee'])) {
        $uploadStatus = 1;
        $uploadedFile = '';
        $args = $_POST['employee'];

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
              $args['photo'] = $uploadedFile;
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
        } else {
          $args['photo'] = $employee->photo;
        }

        $employee->merge_attributes($args);
        $employee->save();
      }

      if (isset($_POST['personal'])) {
        $args = $_POST['personal'];

        $employee->merge_attributes($args);
        $employee->save();
      }

      if (isset($_POST['details'])) {
        $employeeDetail = EmployeeDetail::find_by_employee_id($employeeId);

        if (empty($employeeDetail->id)) {

          $args = $_POST['details'];
          $args['employee_id'] = $employeeId;

          $employeeDetail = new EmployeeDetail($args);
          $employeeDetail->save();

          if (is_blank($employeeDetail->kin_name)) {
            http_response_code(401);
            exit(json_encode(['errors' => "Next of kin name is required."]));
          }
          if (is_blank($employeeDetail->kin_phone_1)) {
            http_response_code(401);
            exit(json_encode(['errors' => "Phone number is required."]));
          }
          if (is_blank($employeeDetail->kin_relationship)) {
            http_response_code(401);
            exit(json_encode(['errors' => "Relationship is required."]));
          }
        } else {
          $args = $_POST['details'];
          $employeeDetail->merge_attributes($args);
          $employeeDetail->save();
          http_response_code(200);
          exit(json_encode(['message' => "Employee details updated successfully."]));
        }
      }

      if (isset($_POST['loan'])) {
        $employeeLoan = EmployeeLoan::find_by_employee_id($employeeId);

        if (empty($employeeLoan->id)) {

          $args = $_POST['loan'];
          $args['employee_id'] = $employeeId;
          $args['ref_no'] = 'EL-' . rand(100, 999) . '0' . $employeeId; //? EL: Employee Loan

          if (!empty($_FILES['filename']['name'])) {
            $temp = explode('.', $_FILES['filename']['name']);
            $fileName = basename(round(microtime(true)) . '.' . end($temp));
            $targetLoanFilePath = $loanDir . $fileName;
            $fileType = pathinfo($targetLoanFilePath, PATHINFO_EXTENSION);

            $allowTypes = ['jpeg', 'jpg', 'png', 'pdf'];
            if (in_array($fileType, $allowTypes)) {
              if (move_uploaded_file($_FILES['filename']['tmp_name'], $targetLoanFilePath)) {
                $loanFile = $fileName;
                $args['file_upload'] = $loanFile;
              } else {
                $uploadStatus = 0;
                http_response_code(401);
                $response['errors'] = 'Sorry, there was an error uploading your file.';
              }
            } else {
              $uploadStatus = 0;
              http_response_code(404);
              $response['errors'] = 'Sorry, JPEG, JPG, PDF & PNG files are allowed to upload.';
            }
          }

          $employeeLoan = new EmployeeLoan($args);
          $employeeLoan->save();
        } else {
          $args = $_POST['loan'];
          if (!empty($_FILES['filename']['name'])) {
            $dbUpload = $employeeLoan->file_upload ?? '';

            if (file_exists($loanDir . $dbUpload)) {
              unlink($loanDir . $dbUpload);
            }

            $temp = explode('.', $_FILES['filename']['name']);
            $fileName = basename(round(microtime(true)) . '.' . end($temp));
            $targetLoanFilePath = $loanDir . $fileName;
            $fileType = pathinfo($targetLoanFilePath, PATHINFO_EXTENSION);

            $allowTypes = ['jpeg', 'jpg', 'png', 'pdf'];
            if (in_array($fileType, $allowTypes)) {
              if (move_uploaded_file($_FILES['filename']['tmp_name'], $targetLoanFilePath)) {
                $loanFile = $fileName;
                $args['file_upload'] = $loanFile;
              } else {
                $uploadStatus = 0;
                http_response_code(401);
                $response['errors'] = 'Sorry, there was an error uploading your file.';
              }
            } else {
              $uploadStatus = 0;
              http_response_code(404);
              $response['errors'] = 'Sorry, JPEG, JPG, PDF & PNG files are allowed to upload.';
            }
          }
          $employeeLoan->merge_attributes($args);
          $employeeLoan->save();
          http_response_code(200);
          exit(json_encode(['message' => "Employee loan updated successfully."]));
        }
      }

      if (isset($_POST['education'])) {
        $employeeEdu = EmployeeEducation::find_by_employee_id($employeeId);

        if (empty($employeeEdu)) {
          $count = $_POST['institution'];

          for ($i = 0; $i < count($count); $i++) {
            $args = [
              'employee_id' => $employeeId,
              'institution' => $_POST['institution'][$i],
              'subject' => $_POST['subject'][$i],
              'start_date' => $_POST['start_date'][$i],
              'complete_date' => $_POST['complete_date'][$i],
              'degree' => $_POST['degree'][$i],
              'grade' => $_POST['grade'][$i],
            ];
            $education = new EmployeeEducation($args);
            $education->save();
          }

          if (is_blank($education->institution)) {
            http_response_code(401);
            exit(json_encode(['errors' => "Institution/School is required."]));
          }
        } else {

          for ($i = 0; $i < count($_POST['institution']); $i++) {

            if (isset($employeeEdu[$i]->id)) {
              $educate = EmployeeEducation::find_by_id($employeeEdu[$i]->id);

              $args = [
                'employee_id' => $employeeId,
                'institution' => $_POST['institution'][$i],
                'subject' => $_POST['subject'][$i],
                'start_date' => $_POST['start_date'][$i],
                'complete_date' => $_POST['complete_date'][$i],
                'degree' => $_POST['degree'][$i],
                'grade' => $_POST['grade'][$i],
              ];

              $educate->merge_attributes($args);
              $educate->save();
            } else {

              $args = [
                'employee_id' => $employeeId,
                'institution' => $_POST['institution'][$i],
                'subject' => $_POST['subject'][$i],
                'start_date' => $_POST['start_date'][$i],
                'complete_date' => $_POST['complete_date'][$i],
                'degree' => $_POST['degree'][$i],
                'grade' => $_POST['grade'][$i],
              ];
              $education = new EmployeeEducation($args);
              $education->save();
            }
          }

          http_response_code(200);
          exit(json_encode(['message' => "Education updated successfully."]));
        }
      }

      if (isset($_POST['experience'])) {
        $employeeExp = EmployeeExperience::find_by_employee_id($employeeId);

        if (empty($employeeExp)) {
          $count = $_POST['company_name'];

          for ($i = 0; $i < count($count); $i++) {
            $args = [
              'employee_id' => $employeeId,
              'company_name' => $_POST['company_name'][$i],
              'location' => $_POST['location'][$i],
              'job_position' => $_POST['job_position'][$i],
              'period_from' => $_POST['period_from'][$i],
              'period_to' => $_POST['period_to'][$i],
            ];
            $experience = new EmployeeExperience($args);
            $experience->save();
          }

          if (is_blank($experience->company_name)) {
            http_response_code(401);
            exit(json_encode(['errors' => "Company name is required."]));
          }
        } else {

          for ($i = 0; $i < count($_POST['company_name']); $i++) {

            if (isset($employeeExp[$i]->id)) {
              $educate = EmployeeExperience::find_by_id($employeeExp[$i]->id);

              $args = [
                'employee_id' => $employeeId,
                'company_name' => $_POST['company_name'][$i],
                'location' => $_POST['location'][$i],
                'job_position' => $_POST['job_position'][$i],
                'period_from' => $_POST['period_from'][$i],
                'period_to' => $_POST['period_to'][$i],
              ];

              $educate->merge_attributes($args);
              $educate->save();
            } else {

              $args = [
                'employee_id' => $employeeId,
                'company_name' => $_POST['company_name'][$i],
                'location' => $_POST['location'][$i],
                'job_position' => $_POST['job_position'][$i],
                'period_from' => $_POST['period_from'][$i],
                'period_to' => $_POST['period_to'][$i],
              ];
              $experience = new EmployeeExperience($args);
              $experience->save();
            }
          }

          http_response_code(200);
          exit(json_encode(['message' => "Experience updated successfully."]));
        }
      }


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

  if (isset($_GET['emId'])) {
    $loan = EmployeeLoan::find_by_employee_id($_GET['emId']);
    $status = $_GET['status'];

    $args = [
      'status' => $status,
      'date_issued' => date('Y-m-d H:i:s'),
    ];

    $loan->merge_attributes($args);
    $loan->save();

    http_response_code(200);
    $response['message'] = 'Status updated successfully!';
    $response['data'] = $loan;
  }

  if (isset($_GET['deleted'])) {
    Employee::deleted($_GET['employeeId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }

  if (isset($_GET['deleteEducation'])) {
    EmployeeEducation::deleted($_GET['educationId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }

  if (isset($_GET['deleteExperience'])) {
    EmployeeExperience::deleted($_GET['experienceId']);

    http_response_code(200);
    $response['message'] = 'Record deleted successfully';
  }
}

exit(json_encode($response));
