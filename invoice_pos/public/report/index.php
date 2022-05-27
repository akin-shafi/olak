<?php 

require_once('../../private/initialize.php');
$page = "Report";
$page_title = 'Report'; ?>
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

          
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->
<div class="content-wrapper">
    <div class="row gutters justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12 col-12">
              
              <!-- Row start -->
              <div class="row no-gutters">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                  <div class="daily-sales" style="position: relative;">
                    <h6>Cash </h6>
                    <h1>5,000</h1>
                    <!-- <p>Number of Customers</p> -->
                    
                  <div class="resize-triggers"><div class="expand-trigger"><div style="width: 276px; height: 332px;"></div></div><div class="contract-trigger"></div></div></div>
                </div>


                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                  <div class="daily-sales" style="position: relative;">
                    <h6>POS </h6>
                    <h1>3,000</h1>
                    <!-- <p>Number of Customers</p> -->
                    
                  <div class="resize-triggers"><div class="expand-trigger"><div style="width: 276px; height: 332px;"></div></div><div class="contract-trigger"></div></div></div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                  <div class="daily-sales" style="position: relative;">
                    <h6>Transfer </h6>
                    <h1>2,000</h1>
                    <!-- <p>Number of Customers</p> -->
                    
                  <div class="resize-triggers"><div class="expand-trigger"><div style="width: 276px; height: 332px;"></div></div><div class="contract-trigger"></div></div></div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                  <div class="daily-sales" style="position: relative;">
                    <h6>POS </h6>
                    <h1>3,000</h1>
                    <!-- <p>Number of Customers</p> -->
                    
                  <div class="resize-triggers"><div class="expand-trigger"><div style="width: 276px; height: 332px;"></div></div><div class="contract-trigger"></div></div></div>
                </div>


                
              </div>
              <!-- Row end -->

            </div>
          </div>
</div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>