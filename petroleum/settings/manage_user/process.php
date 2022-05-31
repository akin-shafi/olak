<?php require_once('../../private/initialize.php');

if (is_post_request()) {
  $uploadDir = '../uploads/';

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
    $result = $user->save();

    if (!empty($user->errors)) :
      http_response_code(404);
      exit(json_encode(['msg' => $user->errors]));
    endif;

    if ($result == true) :
      $req = $_POST['permit'];

      $args = [
        'user_id'        => $user->id,
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
        'created_by'     => $loggedInAdmin->id,
      ];

      $access = new AccessControl($args);
      $access->save();

      exit(json_encode(['success' => true, 'msg' => 'User created successfully!']));
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
    $result = $user->save();

    if ($result === true) :
      $req = $_POST['permit'];
      $access = AccessControl::find_by_user_id($uId);

      $args = [
        'user_id'        => $user->id,
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
        'created_by'     => $loggedInAdmin->id,
      ];

      $access->merge_attributes($args);
      $access->save();

      exit(json_encode(['success' => true, 'msg' => 'User updated successfully!']));
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
}


if (is_get_request()) {
  if (isset($_GET['get_user'])) :
    $company = Company::find_by_id($loggedInAdmin->company_id);
    $companyId = isset($company->id) ? $company->id : '1';
    $branches = Branch::find_all_branch(['company_id' => $companyId]);

    $uId = $_GET['uId'];
    $user = Admin::find_by_id($uId);
    $permissions = AccessControl::PERMISSION;

?>

    <form id="user_form" enctype="multipart/form-data">
      <input type="hidden" name="user[created_by]" value="<?php echo $loggedInAdmin->id ?>" readonly>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <label for="fName" class="col-form-label">Full Name</label>
              <input type="text" class="form-control" name="user[full_name]" value="<?php echo isset($user->full_name) ? $user->full_name : '' ?>" id="fName" placeholder="Full name">
            </div>

            <?php if ($loggedInAdmin->admin_level == 1) : ?>
              <div class="col-md-6">
                <label for="aLevel" class="col-form-label">Admin Level</label>
                <select name="user[admin_level]" class="form-control" id="aLevel" required>
                  <option value="">select level</option>
                  <?php foreach (Admin::ADMIN_LEVEL as $key => $data) : ?>
                    <option value="<?php echo $key ?>" <?php echo ($key == $user->admin_level) ? 'selected' : '' ?>><?php echo $data ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            <?php endif; ?>

            <div class="col-md-12 mt-4 mb-3">
              <h5 class="mb-3 text-secondary">Modify Permission</h5>
              <div class="container">
                <div class="row shadow pt-3">
                  <?php foreach ($permissions as $permit) :
                    $exp = explode('_', $permit);
                    $imp = implode(' ', $exp);
                    $fullProp = ucwords($imp);
                    $access = AccessControl::find_by_user_id($uId);
                  ?>
                    <div class="col-md-3">
                      <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input permit" name="permit[<?php echo $permit; ?>]" id="<?php echo $permit; ?>" <?php echo $access->$permit == 1 ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="<?php echo $permit; ?>"><?php echo $fullProp; ?></label>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <label for="cName" class="col-form-label">Company Name</label>
              <input type="text" class="form-control" id="cName" value="<?php echo isset($company->name) ? $company->name : 'Not set' ?>" disabled>
            </div>
            <div class="col-md-4">
              <label for="regNo" class="col-form-label">Branch</label>
              <select name="user[branch_id]" class="form-control" id="bId" required>
                <option value="">select branch</option>
                <?php foreach ($branches as $data) : ?>
                  <option value="<?php echo $data->id ?>" <?php echo ($data->id == $user->branch_id) ? 'selected' : '' ?>><?php echo ucwords($data->name) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-4">
              <label for="email" class="col-form-label">Email</label>
              <input type="email" class="form-control" name="user[email]" value="<?php echo isset($user->email) ? $user->email : '' ?>" id="email" placeholder="Email" required>
            </div>
            <div class="col-md-4">
              <label for="phone" class="col-form-label">Phone</label>
              <input type="tel" class="form-control" name="user[phone]" value="<?php echo isset($user->phone) ? $user->phone : '' ?>" id="phone" placeholder="Phone number" required>
            </div>
            <div class="col-md-4">
              <label for="password" class="col-form-label">Password</label>
              <input type="password" class="form-control" name="user[password]" id="password" placeholder="********">
            </div>
            <div class="col-md-4">
              <label for="cPass" class="col-form-label">Confirm password</label>
              <input type="password" class="form-control" name="user[confirm_password]" id="cPass" placeholder="********">
            </div>
            <div class="col-md-12">
              <label for="address" class="col-form-label">Address</label>
              <textarea name="user[address]" id="address" class="form-control" placeholder="Contact address" rows="2"><?php echo isset($user->address) ? $user->address : '' ?></textarea>
            </div>
            <div class="col-md-6 m-auto">
              <label for="avatar" class="col-form-label">Profile Image</label>
              <input type="file" class="form-control" name="profile" id="avatar">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>


<?php

  endif;
}
