<?php require_once('../../private/initialize.php');

if (is_post_request()) {
    $uploadDir = '../uploads/';

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

        if ($user == true) :
            exit(json_encode(['success' => true, 'msg' => 'user created successfully!']));
        else :
            exit(json_encode(['success' => false, 'msg' => display_errors($user->errors)]));
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

        $args = [
            'user_id' => $args['user_id'],
            'dashboard' => isset($args['dashboard']) ? '1' : '0',
            'users_mgt' => isset($args['users_mgt']) ? '1' : '0',
            'product_mgt' => isset($args['product_mgt']) ? '1' : '0',
            'sales_mgt' => isset($args['sales_mgt']) ? '1' : '0',
            'expenses_mgt' => isset($args['expenses_mgt']) ? '1' : '0',
            'report_mgt' => isset($args['report_mgt']) ? '1' : '0',
        ];

        $access = new AccessControl($args);
        $access->save();

        if ($access == true) :
            exit(json_encode(['success' => true, 'msg' => 'Access control created successfully!']));
        else :
            exit(json_encode(['success' => false, 'msg' => display_errors($access->errors)]));
        endif;
    }

    if (isset($_POST['edit_access'])) {
        $aId = $_POST['aId'];
        $args = $_POST['access'];
        $access = AccessControl::find_by_id($aId);

        $args = [
            'dashboard' => isset($args['dashboard']) ? '1' : '0',
            'users_mgt' => isset($args['users_mgt']) ? '1' : '0',
            'product_mgt' => isset($args['product_mgt']) ? '1' : '0',
            'sales_mgt' => isset($args['sales_mgt']) ? '1' : '0',
            'expenses_mgt' => isset($args['expenses_mgt']) ? '1' : '0',
            'report_mgt' => isset($args['report_mgt']) ? '1' : '0',
        ];

        $access->merge_attributes($args);
        $access->save();

        if ($access == true) :
            exit(json_encode(['success' => true, 'msg' => 'Access control updated successfully!']));
        endif;
    }

    if (isset($_POST['delete_access'])) {
        $aId = $_POST['aId'];
        $access = AccessControl::find_by_id($aId);
        $access::deleted($aId);

        if ($access == true) :
            exit(json_encode(['success' => true, 'msg' => 'Access control deleted successfully!']));
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

    if (isset($_GET['get_user'])) :
        $uId = $_GET['uId'];
        $user = Admin::find_by_id($uId);
        exit(json_encode(['success' => true, 'data' => $user]));
    endif;

    if (isset($_GET['get_access'])) :
        $aId = $_GET['aId'];
        $access = AccessControl::find_by_id($aId);
        exit(json_encode(['success' => true, 'data' => $access]));
    endif;

    if (isset($_GET['company_id'])) :
        $branches = Request::get_all_branches($_GET['company_id']);
?>
        <label class="label-control">Branch<sup class="text-danger">*</sup></label>
        <select class="form-control" name="user[branch_id]">
            <?php foreach ($branches as $value) : ?>
                <option value="<?php echo $value->id ?>"><?php echo $value->branch_name ?></option>
            <?php endforeach; ?>
        </select>
<?php endif;
}
