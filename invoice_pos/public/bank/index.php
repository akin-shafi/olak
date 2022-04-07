<?php
require_once('../../private/initialize.php');
require_login();

?>
<?php $page = 'Settings'; $page_title = 'All Banks'; ?>
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

         <!--  <a href="#" id="btn_add_bank"  data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New bank">
            <i class="feather-plus"></i>
          </a> -->
           <a href="<?php echo url_for('bank/add.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New bank">
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
        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="bank-table">
          <thead>
            <tr role="row">
              <th>S/N</th>
              <th>Bank Name</th>
              <th>Account No</th>
              <th>Company</th>
              <th>Branch</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $sn = 1;
            foreach (Bank::find_by_undeleted() as $bank) : 
             
            ?>
              <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $bank->bank_name ?></td>
                <td><?php echo $bank->account_number ?></td>
                <td><?php echo Company::find_by_id($bank->company_id)->company_name ?? "Not Set"; ?> </td>
                <td><?php echo Branch::find_by_id($bank->branch_id)->branch_name ?? "Not Set"; ?> </td>
                
                <td>
                  <a href="<?php echo url_for('bank/edit.php?id='. $bank->id ) ?>" class=" btn btn-sm btn-primary " > <i class="feather-edit text-success"></i> Edit bank</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
    
  </div>

</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

