<?php require_once('../../../private/initialize.php'); ?>

<?php 


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
            exit(json_encode(['success' => false, 'msg' => $response['errors']]));
          }
        } else {
          $uploadStatus = 0;
          http_response_code(404);
          $response['errors'] = 'Sorry, JPEG, JPG & PNG files are allowed to upload.';
          exit(json_encode(['success' => false, 'msg' => $response['errors']]));
        }
      }
      $company = new Company($args);
      $company->save();

      if ($company->errors) :
        http_response_code(401);
        $response['errors'] = $company->errors[0];
        exit(json_encode(['success' => false, 'msg' => $response['errors']]));
      else :
        http_response_code(201);
        $response['message'] = 'Company created successfully!';
        exit(json_encode(['success' => true, 'msg' => $response['message'] ]));
      endif;
    }
  }

  if (isset($_POST['branch'])) {
    if (isset($_POST['branchId']) && $_POST['branchId'] != '') {
      $branch = Branch::find_by_id($_POST['branchId']);
      $args = $_POST['branch'];
      $args['company_name'] = Company::find_by_id($args['company_id'])->company_name;
      $branch->merge_attributes($args);
      $branch->save();

      http_response_code(200);
      $response['message'] = 'Branch updated successfully';
    } else {
      $args = $_POST['branch'];
      $args['company_name'] = Company::find_by_id($args['company_id'])->company_name;
      $branch = new Branch($args);
      $branch->save();

      if ($branch->errors) :
        http_response_code(401);
        $response['errors'] = $branch->errors[0];
        exit(json_encode(['success' => false, 'msg' => $response['errors']]));
      else :
        http_response_code(201);
        $response['message'] = 'Branch created successfully!';
        exit(json_encode(['success' => true, 'msg' => $response['message']]));
      endif;
    }
  }

  

 ?>