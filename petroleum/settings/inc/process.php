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
    $products = Product::find_by_names($args['name'], $loggedInAdmin->branch_id);

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




  // *************** ACCESS CONTROL
  if (isset($_POST['edit_access'])) {
    $aId = $_POST['aId'];
    $req = $_POST['access'];
    $access = AccessControl::find_by_id($aId);

    $args = [
      'dashboard'      => isset($req['dashboard'])      ? 1 : 0,
      'sales_mgt'      => isset($req['sales_mgt'])      ? 1 : 0,
      'add_dip'        => isset($req['add_dip'])        ? 1 : 0,
      'add_sales'      => isset($req['add_sales'])      ? 1 : 0,
      'edit_sales'     => isset($req['edit_sales'])     ? 1 : 0,
      'manage_sales'   => isset($req['manage_sales'])   ? 1 : 0,
      'expenses_mgt'   => isset($req['expenses_mgt'])   ? 1 : 0,
      'add_exp'        => isset($req['add_exp'])        ? 1 : 0,
      'edit_exp'       => isset($req['edit_exp'])       ? 1 : 0,
      'delete_exp'     => isset($req['delete_exp'])     ? 1 : 0,
      'report_mgt'     => isset($req['report_mgt'])     ? 1 : 0,
      'access_control' => isset($req['access_control']) ? 1 : 0,
      'company_setup'  => isset($req['company_setup'])  ? 1 : 0,
      'user_mgt'       => isset($req['user_mgt'])       ? 1 : 0,
      'product_mgt'    => isset($req['product_mgt'])    ? 1 : 0,
      'filtering'      => isset($req['filtering'])      ? 1 : 0,
    ];

    $access->merge_attributes($args);
    $access->save();

    if ($access == true) :
      exit(json_encode(['success' => true, 'msg' => 'Access control updated successfully!']));
    endif;
  }
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

  if (isset($_GET['get_product'])) :
    $pId = $_GET['pId'];
    $product = Product::find_by_id($pId);
    exit(json_encode(['success' => true, 'data' => $product]));
  endif;

  if (isset($_GET['get_access'])) :
    $aId = $_GET['aId'];
    $permissions = AccessControl::PERMISSION;
    $admins = Admin::find_by_undeleted();
    $control = AccessControl::find_by_id($aId);
?>

    <div class="container">
      <div class="col-md-12">
        <div class="form-group">
          <div class="mb-3">
            <label for="staff" class="col-form-label">All Staff</label>
            <select class="form-control" name="access[user_id]" id="staff">
              <option value="">select staff</option>
              <?php foreach ($admins as $admin) : ?>
                <option value="<?php echo $admin->id ?>" <?php echo ($admin->id == $control->user_id) ? 'selected' : ''; ?>>
                  <?php echo ucwords($admin->full_name) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>


      <div class="col-md-12 mt-4 mb-3">
        <h5 class="mb-3 text-secondary">Edit Permission</h5>
        <div class="row shadow pt-3">
          <?php foreach ($permissions as $permit) :
            $exp = explode('_', $permit);
            $imp = implode(' ', $exp);
            $fullProp = ucwords($imp);
            $access = AccessControl::find_by_id($aId);
          ?>
            <div class="col-md-3">
              <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input permit" name="access[<?php echo $permit; ?>]" id="<?php echo $permit; ?>" <?php echo $access->$permit == 1 ? 'checked' : ''; ?>>
                <label class="custom-control-label" for="<?php echo $permit; ?>"><?php echo $fullProp; ?></label>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>

<?php
  endif;
}
