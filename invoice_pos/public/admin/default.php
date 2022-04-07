<?php

require_once('../../private/initialize.php');

require_login();

// Find all undeleted admins
$admins = Admin::find_all();
// $admins = Admin::find_by_undeleted();

?>
<?php $page_title = 'Admins'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">
          
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



  </div>
  <!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->

<?php include(SHARED_PATH . '/admin_footer.php');
?>