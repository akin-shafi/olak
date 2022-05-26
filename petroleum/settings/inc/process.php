<?php require_once('../../private/initialize.php');

if (is_post_request()) {
  $uploadDir = '../uploads/';

  if (isset($_POST['new_company'])) {
    $args = $_POST['company'];

    $fileTmpPath = $_FILES['logo']['tmp_name'];
    $fileName = $_FILES['logo']['name'];
    $fileSize = $_FILES['logo']['size'];
    $fileType = $_FILES['logo']['type'];
    $fileNameExp = explode('.', $fileName);
    $fileExt = strtolower(end($fileNameExp));
    $newFileName = md5(time() . $fileName) . '.' . $fileExt;
    $allowedFileExt = ['jpg', 'png', 'gif', 'jpeg'];
    $dest_path = $uploadDir . $newFileName;

    if (isset($fileName) && !empty($fileName)) {
      if (in_array($fileExt, $allowedFileExt)) {
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
          $args['logo'] =  $newFileName;
        } else {
          exit(json_encode(['success' => false, 'msg' => 'Company logo not uploaded!']));
        }
      } else {
        exit(json_encode(['success' => false, 'msg' => 'Upload failed. Allowed file types: ' . implode(',', $allowedFileExt)]));
      }
    }

    $company = new Company($args);
    $company->save();

    if ($company == true) :
      $updateCompany = Company::find_by_id($company->id);
      $args = ['user_id' => $loggedInAdmin->id];
      $updateCompany->merge_attributes($args);
      $updateCompany->save();

      exit(json_encode(['success' => true, 'msg' => 'Company created successfully!']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($company->errors)]));
    endif;
  }

  if (isset($_POST['edit_company'])) {
    $cId = $_POST['cId'];
    $args = $_POST['company'];
    $company = Company::find_by_id($cId);

    $fileTmpPath = $_FILES['logo']['tmp_name'];
    $fileName = $_FILES['logo']['name'];
    $fileSize = $_FILES['logo']['size'];
    $fileType = $_FILES['logo']['type'];
    $fileNameExp = explode('.', $fileName);
    $fileExt = strtolower(end($fileNameExp));
    $newFileName = md5(time() . $fileName) . '.' . $fileExt;
    $allowedFileExt = ['jpg', 'png', 'gif', 'jpeg'];
    $dest_path = $uploadDir . $newFileName;

    if (isset($fileName) && !empty($fileName)) {
      if (in_array($fileExt, $allowedFileExt)) {
        unlink($uploadDir . $company->logo);
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
          $args['logo'] =  $newFileName;
        } else {
          exit(json_encode(['success' => false, 'msg' => 'Company logo not uploaded!']));
        }
      } else {
        exit(json_encode(['success' => false, 'msg' => 'Upload failed. Allowed file types: ' . implode(',', $allowedFileExt)]));
      }
    }

    $company->merge_attributes($args);
    $company->save();

    if ($company == true) :
      exit(json_encode(['success' => true, 'msg' => 'Company updated successfully!']));
    endif;
  }

  if (isset($_POST['delete_company'])) {
    $cId = $_POST['cId'];
    $company = Company::find_by_id($cId);
    $company::deleted($cId);

    if ($company == true) :
      $branches = Branch::find_all_branch(['company_id' => $cId]);

      foreach ($branches as $value) :
        $branch = Branch::find_by_id($value->id);
        $branch::deleted($value->id);
      endforeach;

      exit(json_encode(['success' => true, 'msg' => 'Company deleted successfully!']));
    endif;
  }




  // *************** BRANCH
  if (isset($_POST['new_branch'])) {
    $args = $_POST['branch'];

    $branch = new Branch($args);
    $branch->save();

    if ($branch == true) :
      exit(json_encode(['success' => true, 'msg' => 'Branch created successfully!']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($branch->errors)]));
    endif;
  }

  if (isset($_POST['edit_branch'])) {
    $bId = $_POST['bId'];
    $args = $_POST['branch'];
    $branch = Branch::find_by_id($bId);

    $branch->merge_attributes($args);
    $branch->save();

    if ($branch == true) :
      exit(json_encode(['success' => true, 'msg' => 'Branch updated successfully!']));
    endif;
  }

  if (isset($_POST['delete_branch'])) {
    $bId = $_POST['bId'];
    $branch = Branch::find_by_id($bId);
    $branch::deleted($bId);

    if ($branch == true) :
      exit(json_encode(['success' => true, 'msg' => 'Branch deleted successfully!']));
    endif;
  }


  // *************** PRODUCT
  if (isset($_POST['new_product'])) {
    $args = $_POST['product'];
    $args['branch_id'] = $loggedInAdmin->branch_id;

    $product = new Product($args);
    $product->save();

    if ($product == true) :
      exit(json_encode(['success' => true, 'msg' => 'Product created successfully!']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($product->errors)]));
    endif;
  }

  if (isset($_POST['edit_product'])) {
    $args = $_POST['product'];
    $products = Product::find_by_names($args['name']);

    foreach ($products as $value) :
      $product = Product::find_by_id($value->id);
      $product->merge_attributes($args);
      $product->save();
    endforeach;

    if ($product == true) :
      exit(json_encode(['success' => true, 'msg' => 'Product updated successfully!']));
    endif;
  }

  if (isset($_POST['delete_product'])) {
    $pId = $_POST['pId'];
    $product = Product::find_by_id($pId);
    $product::deleted($pId);

    if ($product == true) :
      exit(json_encode(['success' => true, 'msg' => 'Product deleted successfully!']));
    endif;
  }



  // ************* USERS
  if (isset($_POST['new_user'])) {
    $args = $_POST['user'];

    $fileTmpPath = $_FILES['profile']['tmp_name'];
    $fileName = $_FILES['profile']['name'];
    $fileSize = $_FILES['profile']['size'];
    $fileType = $_FILES['profile']['type'];
    $fileNameExp = explode('.', $fileName);
    $fileExt = strtolower(end($fileNameExp));
    $newFileName = md5(time() . $fileName) . '.' . $fileExt;
    $allowedFileExt = ['jpg', 'png', 'gif', 'jpeg'];
    $dest_path = $uploadDir . 'profile/' . $newFileName;

    if (isset($fileName) && !empty($fileName)) {
      if (in_array($fileExt, $allowedFileExt)) {
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
          $args['profile_img'] =  $newFileName;
        } else {
          exit(json_encode(['success' => false, 'msg' => 'user profile not uploaded!']));
        }
      } else {
        exit(json_encode(['success' => false, 'msg' => 'Upload failed. Allowed file types: ' . implode(',', $allowedFileExt)]));
      }
    }

    if ($loggedInAdmin->admin_level == 1) {
      $args['company_id'] = $loggedInAdmin->company_id;
    }

    $user = new Admin($args);
    $user->save();


    if (!empty($user->errors)) :
      http_response_code(404);
      exit(json_encode(['msg' => $user->errors]));
    endif;

    if ($user == true) :
      exit(json_encode(['success' => true, 'msg' => 'user created successfully!']));
    endif;
  }

  if (isset($_POST['edit_user'])) {
    $uId = $_POST['uId'];
    $args = $_POST['user'];
    $user = Admin::find_by_id($uId);

    $fileTmpPath = $_FILES['profile']['tmp_name'];
    $fileName = $_FILES['profile']['name'];
    $fileSize = $_FILES['profile']['size'];
    $fileType = $_FILES['profile']['type'];
    $fileNameExp = explode('.', $fileName);
    $fileExt = strtolower(end($fileNameExp));
    $newFileName = md5(time() . $fileName) . '.' . $fileExt;
    $allowedFileExt = ['jpg', 'png', 'gif', 'jpeg'];
    $dest_path = $uploadDir . 'profile/' . $newFileName;

    if (isset($fileName) && !empty($fileName)) {
      if (in_array($fileExt, $allowedFileExt)) {
        unlink($uploadDir . 'profile/' . $user->profile_img);
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
          $args['profile_img'] =  $newFileName;
        } else {
          exit(json_encode(['success' => false, 'msg' => 'user profile not uploaded!']));
        }
      } else {
        exit(json_encode(['success' => false, 'msg' => 'Upload failed. Allowed file types: ' . implode(',', $allowedFileExt)]));
      }
    }

    $user->merge_attributes($args);
    $user->save();

    if ($user == true) :
      exit(json_encode(['success' => true, 'msg' => 'user updated successfully!']));
    endif;
  }

  if (isset($_POST['delete_user'])) {
    $uId = $_POST['uId'];
    $user = Admin::find_by_id($uId);
    $user::deleted($uId);

    if ($user == true) :
      exit(json_encode(['success' => true, 'msg' => 'user deleted successfully!']));
    endif;
  }




  // *************** ACCESS CONTROL
  if (isset($_POST['new_access'])) {
    $args = $_POST['access'];

    $user = AccessControl::find_by_user_id($args['user_id']);

    if (empty($args['user_id'])) :
      http_response_code(404);
      exit(json_encode(['msg' => 'Staff name cannot be blank!']));
    elseif (!empty($user)) :
      http_response_code(404);
      exit(json_encode(['msg' => 'User already have access!']));

    else :

      $args = [
        'user_id'       => $args['user_id'],
        'dashboard'     => isset($args['dashboard']) ? '1' : '0',
        'users_mgt'     => isset($args['users_mgt']) ? '1' : '0',
        'product_mgt'   => isset($args['product_mgt']) ? '1' : '0',
        'sales_mgt'     => isset($args['sales_mgt']) ? '1' : '0',
        'expenses_mgt'  => isset($args['expenses_mgt']) ? '1' : '0',
        'report_mgt'    => isset($args['report_mgt']) ? '1' : '0',
        'settings'      => isset($args['settings']) ? '1' : '0',
        'filtering'     => isset($args['filtering']) ? '1' : '0',
      ];

      $access = new AccessControl($args);
      $access->save();

      exit(json_encode(['success' => true, 'msg' => 'Access control created successfully!']));
    endif;
  }

  if (isset($_POST['edit_access'])) {
    $aId = $_POST['aId'];
    $args = $_POST['access'];
    $access = AccessControl::find_by_id($aId);

    $args = [
      'dashboard'     => isset($args['dashboard']) ? '1' : '0',
      'users_mgt'     => isset($args['users_mgt']) ? '1' : '0',
      'product_mgt'   => isset($args['product_mgt']) ? '1' : '0',
      'sales_mgt'     => isset($args['sales_mgt']) ? '1' : '0',
      'expenses_mgt'  => isset($args['expenses_mgt']) ? '1' : '0',
      'report_mgt'    => isset($args['report_mgt']) ? '1' : '0',
      'settings'      => isset($args['settings']) ? '1' : '0',
      'filtering'     => isset($args['filtering']) ? '1' : '0',
    ];

    $access->merge_attributes($args);
    $access->save();

    if ($access == true) :
      exit(json_encode(['success' => true, 'msg' => 'Access control updated successfully!']));
    endif;
  }

  // if (isset($_POST['delete_access'])) {
  //     $aId = $_POST['aId'];
  //     $access = AccessControl::find_by_id($aId);
  //     $access::deleted($aId);

  //     if ($access == true) :
  //         exit(json_encode(['success' => true, 'msg' => 'Access control deleted successfully!']));
  //     endif;
  // }
}


if (is_get_request()) {
  if (isset($_GET['get_company'])) :
    $cId = $_GET['cId'];
    $company = Company::find_by_id($cId);
    exit(json_encode(['success' => true, 'data' => $company]));
  endif;

  if (isset($_GET['get_branch'])) :
    $bId = $_GET['bId'];
    $branch = Branch::find_by_id($bId);
    exit(json_encode(['success' => true, 'data' => $branch]));
  endif;

  if (isset($_GET['get_user'])) :
    $uId = $_GET['uId'];
    $user = Admin::find_by_id($uId);
    exit(json_encode(['success' => true, 'data' => $user]));
  endif;

  if (isset($_GET['get_product'])) :
    $pId = $_GET['pId'];
    $product = Product::find_by_id($pId);
    exit(json_encode(['success' => true, 'data' => $product]));
  endif;

  if (isset($_GET['get_access'])) :
    $aId = $_GET['aId'];
    $access = AccessControl::find_by_id($aId);
    exit(json_encode(['success' => true, 'data' => $access]));
  endif;
}
