<?php

require_once('../../private/initialize.php');

require_login();

// Find all undeleted admins
$admins = Admin::find_all();
// $admins = Admin::find_by_undeleted();

?>
<?php $page_title = 'Search Vehicle'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

 <!-- *************
        ************ Main container start *************
        ************* -->
      <div class="main-container">


        <!-- Page header start -->
        <div class="page-title">
          <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9">
              <h5 class="title">Find Vehicle</h5>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3">
              <div class="daterange-container">
                <!-- <div class="date-range">
                  <div id="reportrange">
                    <i class="feather-calendar cal"></i>
                    <span class="range-text">Jan 20, 2020 - Feb 18, 2020</span>
                    <i class="feather-chevron-down arrow"></i>
                  </div>
                </div> -->
                <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
                  <i class="feather-sunrise"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Page header end -->


        <!-- Content wrapper start -->
        <div class="content-wrapper">

          <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title alert alert-primary">Search for vehicle using any of the parameters below</div>
                </div>
                <div class="card-body">
                  
                  <form method="post" class="row ">
                    <div class="form-group col-md-3 col-12 mx-sm-3 mb-2">
                      <label for="inputLincence" class="sr-only">Lincence Plate No.</label>
<!--                        <div class="input-group">
                          <select name="" class="form-control select2" style="width: 100%;">
                            <option value="">-select-</option>
                          </select>
                        </div> -->
                      <select type="text" class="form-control select2" id="inputLincence"  style="">
                          <option>AAA-123-456</option>
                          <option>KJA-123-456</option>
                          <option>IKD-123-456</option>
                          <option>ADG-123-456</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3 col-12 mx-sm-3 mb-2">
                      <label for="vin" class="sr-only">Client Name</label>
                      <select type="text" class="form-control select2" id="clientName"  style="">
                          <option>Aboyeji Eyioluwa</option>
                          <option>Adelakun James</option>
                          <option>Openiyi Johnson</option>
                          <option>Tunde Balogun</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3 col-12 mx-sm-3 mb-2">
                      <label for="InvoiceNo" class="sr-only">Invoice No</label>
                     <select type="text" class="form-control select2" id="InvoiceNo" style="">
                          <option>INV-10901</option>
                          <option>INV-10902</option>
                          <option>INV-10903</option>
                          <option>INV-10904</option>
                      </select>
                    </div>
                    <button type="submit" class=" btn-primary col-md-1 col-12 form-control mb-2">Search</button>
                  </form>

                </div>
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