<?php

require_once('../../private/initialize.php');

require_login();

$id = $_GET['id'] ?? $loggedInAdmin->id;
$wallet = Wallet::find_by_id($id);
if ($wallet == false) {
  redirect_to(url_for('/wallet/index.php'));
}

if (is_post_request()) {

  // Save record using post parameters
  $args = $_POST['wallet'];
  $wallet->merge_attributes($args);
  $result = $wallet->save();

  if ($result === true) {

    $session->message('The wallet was updated successfully.');
    redirect_to(url_for('/wallet/index.php'));
  } else {
    // show errors
  }
} else {

  // display the form

}

?>

<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php') ?>

<!-- Container start -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">
          <div class="date-range">
            <div id="reportrange">
              <i class="feather-calendar cal"></i>
              <span class="range-text">Jan 20, 2020 - Feb 18, 2020</span>
              <i class="feather-chevron-down arrow"></i>
            </div>
          </div>
          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
            <i class="feather-download"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <?php if (display_errors($wallet->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($wallet->errors); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <form action="" method="post">
      <?php include("form_field.php") ?>
      <div class="card-footer clearfix">
        <input type="submit" class="btn btn-success float-right" value="Edit">
      </div>
  </div>
</div>
<!-- Container end -->

<?php include(SHARED_PATH . '/admin_footer.php') ?>