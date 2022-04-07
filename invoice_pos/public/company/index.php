<?php
require_once('../../private/initialize.php');
require_login();

?>
<?php $page = 'Settings'; $page_title = 'All Comapny'; ?>
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

         <!--  <a href="#" id="btn_add_company"  data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New Company">
            <i class="feather-plus"></i>
          </a> -->
           <a href="<?php echo url_for('company/add.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New Company">
            <i class="feather-plus"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <?php echo display_session_message(); ?>
    <div class="table-responsive">
        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="company-table">
          <thead>
            <tr role="row">
              <th>S/N</th>
              <th>Company Name</th>
              <th>Registration No</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $sn = 1;
            foreach (Company::find_by_undeleted() as $company) : ?>
              <tr>
                <td><?php echo $sn++ ?></td>
                <td>
                  <a href="#" class="d-flex align-items-center">
                    <span class="avatar avatar-md brround me-3" style="background-image: url( <?php echo url_for('assets/uploads/company/' . $company->logo) ?>)"></span>

                    <h6 class="mb-0 fs-14"><?php echo ucwords($company->company_name) ?></h6>
                  </a>
                </td>
                <td><?php echo ucwords($company->registration_no) ?>
                </td>
                
                <td>
                  <a class="btn btn-primary btn-icon btn-sm" href="<?php echo url_for('company/edit.php?id='. $company->id) ?>" data-id="<?php echo $company->id ?>" id="edit_company">
                    <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="Edit Company Info" title=""></i>
                  </a>
                  <a class="btn btn-danger btn-icon btn-sm" href="<?php echo url_for('company/delete.php?id='. $company->id) ?>" data-id="<?php echo $company->id ?>" id="delete_company">
                    <i class="feather feather-trash-2"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
    
  </div>

</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

