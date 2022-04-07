<?php

require_once('../../private/initialize.php');

require_login();

if (is_post_request()) {

  // Create record using post parameters
  $args = $_POST['admin'];
  // print_r($args);
  $admin = new Admin($args);
  // print_r($admin);
  $result = $admin->save();

  if ($result === true) {
    $new_id = $admin->id;

    $session->message('The admin was created successfully.');
    redirect_to(url_for('/admin/index.php'));
  } else {
    // show errors
  }
} else {
  // display the form
  $admin = new Admin;
}

?>
<?php //$page_title = 'Create Admin'; ?>
<?php $page = 'Users'; $page_title = 'Add New User'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>



<div class="main-container">

 <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">
          
          <a href="<?php echo url_for('admin/index.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="">
            <i class="feather-file-text"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->
  

  <!-- Content wrapper start -->
  <div class="content-wrapper">
       <?php if (display_errors($admin->errors)) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo display_errors($admin->errors); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
        <?php } ?>
        <form method="post">
          <input type="hidden" name="admin[created_by]" value="<?php echo $loggedInAdmin->id ?>">
          <?php include('form_fields.php'); ?>
          <div class="modal-footer">
            <button class="btn btn-primary" id="add_company_btn">Submit</button>
          </div>
        </form>

  </div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>