<?php
require_once('../../private/initialize.php');
require_login();

?>
<?php $page = 'Settings'; $page_title = 'All Branches'; ?>
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

         <!--  <a href="#" id="btn_add_branch"  data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New branch">
            <i class="feather-plus"></i>
          </a> -->
           <a href="<?php echo url_for('branch/add.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New branch">
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
        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="branch-table">
          <thead>
            <tr role="row">
              <th>#S/N</th>
              <th>Company Name</th>
              <th>Branch Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $sn = 1;
            foreach (Branch::find_by_undeleted() as $branch) :
              // pre_r($branch);
              $company = Company::find_by_id($branch->company_id);
            ?>
              <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo ucwords($company->company_name) ?></td>
                <td><?php echo ucwords($branch->branch_name) ?></td>
                
                <td>
                  <a class="btn btn-primary btn-icon btn-sm" href="<?php echo url_for('branch/edit.php?id='. $branch->id) ?>" data-id="<?php echo $branch->id ?>" id="edit_branch">
                    <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="Edit branch Info" title=""></i>
                  </a>
                  <a class="btn btn-danger btn-icon btn-sm" href="<?php echo url_for('branch/delete.php') ?>" data-id="<?php echo $branch->id ?>" id="delete_branch">
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

