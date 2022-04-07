<?php

require_once('../../private/initialize.php');

require_login();
$errors = '';
// $theme = Theme::find_all();
  $company = CompanyDetails::find_by_id("1") ?? '';
  // $pics = CompanyLogo::find_by_id(1);
  // $bank_1 = BankDetails::find_by_id(1);


if(isset($_POST['company_details'])){
  $company_arg = $_POST['company'];
  $company = CompanyDetails::find_by_id(1);
  $company->merge_attributes($company_arg);
  $company->save();
}

?>
<?php $page = 'Settings'; $page_title = 'App Setup'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

 <!-- *************
        ************ Main container start *************
        ************* -->
      <div class="main-container">


        <!-- Page header start -->
        <div class="page-title">
          <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              <h5 class="title">Company Settings</h5>
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
                  <i class="feather-settings"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Page header end -->


        <?php if($errors){ ?>
          <div class=" alert-danger text-center  alert mx-auto container-50" >
           <?php echo display_errors($errors); ?>
          </div>
        <?php } ?>


        <!-- Content wrapper start -->
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-8 offset-md-2">
            
              <!-- Page Header -->
              <!-- <div class="page-header">
                <div class="row">
                  <div class="col-sm-12">
                    <h3 class="page-title">Company Settings</h3>
                  </div>
                </div>
              </div> -->
              <!-- /Page Header -->
              
              <form method="post">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Company Name <span class="text-danger">*</span></label>
                      <input class="form-control" type="text" name="company[name]" value="<?php echo $company->company_name; ?>">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Contact Person</label>
                      <input class="form-control " name="company[contact_person]" value="<?php echo $company->contact_person; ?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Address</label>
                      <input class="form-control " name="company[address]" value="<?php echo $company->address; ?>" type="text">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="form-group">
                      <label>Country</label>
                      <input class="form-control " name="company[country]" value="<?php echo $company->country; ?>" type="text">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="form-group">
                      <label>City</label>
                      <input class="form-control" name="company[city]" value="<?php echo $company->city; ?>" type="text">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="form-group">
                      <label>State/Province</label>
                     <input class="form-control " name="company[state]" value="<?php echo $company->state; ?>" type="text">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="form-group">
                      <label>Postal Code</label>
                      <input class="form-control" name="company[zip_code]" value="<?php echo $company->zip_code; ?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input class="form-control" name="company[email]" value="<?php echo $company->email; ?>" type="email">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input class="form-control" name="company[phone_no]" value="<?php echo $company->phone_no; ?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Mobile Number</label>
                      <input class="form-control" name="company[mobile_no]" value="<?php echo $company->mobile_no; ?>" type="text">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Website Url</label>
                      <input class="form-control" name="company[web_address]" value="<?php echo $company->web_address; ?>" type="text">
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                  

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>App Url</label>
                      <input class="form-control" name="company[app_address]" value="<?php echo $company->app_address; ?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="submit-section d-flex justify-content-end">
                  <input class="btn btn-primary submit-btn" type="submit" name="company_details" value="Save">
                </div>
              </form>
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