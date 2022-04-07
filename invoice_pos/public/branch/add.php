<?php
require_once('../../private/initialize.php');
require_login();


if (is_post_request()) {

  // Create record using post parameters
  $args = $_POST['branch'];

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
        // exit(json_encode(['success' => false, 'msg' => $response['errors']]));
      }
    } else {
      $uploadStatus = 0;
      http_response_code(404);
      $response['errors'] = 'Sorry, JPEG, JPG & PNG files are allowed to upload.';
      // exit(json_encode(['success' => false, 'msg' => $response['errors']]));
    }
  }
  $branch = new Branch($args);
  $result = $branch->save();

  if ($result == true) {
    $session->message('The branch was created successfully.');
    redirect_to(url_for('/branch/index.php'));
  }else{
    // show errors
  }
} else {
  // display the form
  $branch = new Branch;
}



?>

<?php $page = 'Settings'; $page_title = 'Add New Branch'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- ************* Main container start ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9 ">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3 ">
        <div class="daterange-container">

          <a href="<?php echo url_for('branch/') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Show all Branches">
            <i class="feather-file-text"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->

  <!-- Content wrapper start -->
  <div class="content-wrapper">
      <?php if (display_errors($branch->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($branch->errors); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <form id="add_branch_form" class="mb-0" method="post">
      <?php include('form_field.php') ?>
      <div class="modal-footer">
        <button class="btn btn-primary" id="add_branch_btn">Submit</button>
      </div>
    </form>
    
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
