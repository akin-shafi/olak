<?php
require_once('../../private/initialize.php');

$logoDir = '../../assets/uploads/company/';
$loanDir = '../../assets/uploads/loan/';
$response = [
  'errors' => null,
  'message' => '',
  'data' => '',
];

if (is_post_request()) {

  if (isset($_POST['company'])) {
    if (isset($_POST['companyId']) && $_POST['companyId'] != '') {
      $company = Company::find_by_id($_POST['companyId']);
      $args = $_POST['company'];
      $company->merge_attributes($args);
      $company->save();

      http_response_code(200);
      $response['message'] = 'Company updated successfully';
    } else {
      $args = $_POST['company'];

      if (!empty($_FILES['logo']['name'])) {

        $temp = explode('.', $_FILES['logo']['name']);
        $fileName = basename(round(microtime(true)) . '.' . end($temp));
        $targetFilePath = $logoDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = ['jpeg', 'jpg', 'png'];
        if (in_array($fileType, $allowTypes)) {
          if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetFilePath)) {
            $uploadedFile = $fileName;
            $args['logo'] = $uploadedFile;
          } else {
            $uploadStatus = 0;
            http_response_code(401);
            $response['errors'] = 'Sorry, there was an error uploading your file.';
          }
        } else {
          $uploadStatus = 0;
          http_response_code(404);
          $response['errors'] = 'Sorry, JPEG, JPG & PNG files are allowed to upload.';
        }
      }
      $company = new Company($args);
      $company->save();

      if ($company->errors) :
        http_response_code(401);
        $response['errors'] = $company->errors[0];
      else :
        http_response_code(201);
        $response['message'] = 'Company created successfully!';
      endif;
    }
  }

  if (isset($_POST['branch'])) {
    if (isset($_POST['branchId']) && $_POST['branchId'] != '') {
      $branch = Branch::find_by_id($_POST['branchId']);
      $args = $_POST['branch'];
      $branch->merge_attributes($args);
      $branch->save();

      http_response_code(200);
      $response['message'] = 'Branch updated successfully';
    } else {
      $args = $_POST['branch'];
      $branch = new Branch($args);
      $branch->save();

      if ($branch->errors) :
        http_response_code(401);
        $response['errors'] = $branch->errors[0];
      else :
        http_response_code(201);
        $response['message'] = 'Branch created successfully!';
      endif;
    }
  }

  if (isset($_POST['eType'])) {
    if (isset($_POST['eTypeId']) && $_POST['eTypeId'] != '') {
      $eType = EmployeeType::find_by_id($_POST['eTypeId']);
      $args = $_POST['eType'];
      $eType->merge_attributes($args);
      $eType->save();

      http_response_code(200);
      $response['message'] = 'Employee type updated successfully';
    } else {
      $args = $_POST['eType'];
      $eType = new EmployeeType($args);
      $eType->save();

      if ($eType->errors) :
        http_response_code(401);
        $response['errors'] = $eType->errors[0];
      else :
        http_response_code(201);
        $response['message'] = 'Employee type created successfully!';
      endif;
    }
  }



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
  if (isset($_GET['status_id'])) {
    $config = Configuration::find_by_id($_GET['status_id']);
    $status = ($_GET['status'] == 'activate') ? 1 : 0;
    $args = ['loan_config' => $status];

    $config->merge_attributes($args);
    $config->save();
    http_response_code(200);
    $response['message'] = 'Updated!';
  }

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
