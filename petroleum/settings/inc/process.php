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
        $company = company::find_by_id($cId);
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
}
