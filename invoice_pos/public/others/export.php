<?php

require_once('../../private/initialize.php');

require_login();

// Find all undeleted admins
$admins = Admin::find_all();
// $admins = Admin::find_by_undeleted();

?>
<?php $page_title = 'Export'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title">Export Data</h5>
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

    <div class="row">
      <div class="col-md-6">
        <div class="card p-4 text-center fs-30 bold">
          <img width="100" class="border mx-auto" src="<?php echo url_for('/img/csv.jpg'); ?>"> 
          Export as CSV
        </div>
      </div>

      <div class="col-md-6">
        <div class="card p-4 text-center fs-30 bold"> 
          <img width="100" class="border mx-auto" src="<?php echo url_for('/img/bmc.png'); ?>">
            Export to BookMyCash
        </div>
    </div>
     
    </div>

  </div>
  <!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->

<?php include(SHARED_PATH . '/admin_footer.php');
?>