<?php
require_once('../../private/initialize.php');
require_login();

// $id = $_GET['id'] ?? '';

if (is_post_request()) {

  // Create record using post parameters
  $args = $_POST['bank'];
  $bank = new Bank($args);
  $result = $bank->save();

  if ($result == true) {
    $session->message('The bank was created successfully.');
    redirect_to(url_for('/bank/index.php'));
  }else{
    // show errors
  }

  
} else {
  // display the form
  $bank = new Bank;
}



?>

<?php $page = 'bank'; $page_title = 'Load bank'; ?>
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

          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
            <i class="feather-file-text"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->

  <!-- Content wrapper start -->
  <div class="content-wrapper">
      <?php if (display_errors($bank->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($bank->errors); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <form id="add_bank_form" class="mb-0" method="post">
      <?php include('form_field.php') ?>
      <div class="modal-footer">
        <button class="btn btn-primary" id="add_bank_btn">Submit</button>
      </div>
    </form>
    
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
