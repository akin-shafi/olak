<?php

require_once('../../private/initialize.php');

require_login();

if ($loggedInAdmin->admin_level == 1) {
  $admins = Admin::find_by_undeleted();
} else {
  $admins = Admin::find_by_branch_id($loggedInAdmin->branch_id);
}

?>


<?php $page = 'Users';
$page_title = 'All Users'; ?>
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

          <a href="<?php echo url_for('admin/new.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="">
            <i class="feather-plus"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->
  <?php echo display_session_message(); ?>

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <div class="table-responsive">
      <table id="rowSelection" class="table table-sm table-striped ">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Phone No</th>
            <th>Branch</th>
            <th>Admin Level</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $sn = 1;
          foreach ($admins  as $admin) {
            $branch = Branch::find_by_id($admin->branch_id)->branch_name;
            $adminLevel = h(Admin::ADMIN_LEVEL[$admin->admin_level]);
            if ($admin->id == 1) continue;
          ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $admin->full_name(); ?></td>
              <td><?php echo $admin->phone; ?></td>
              <td><?php echo ucwords($branch); ?></td>
              <td><span class="badge badge-primary"><?php echo $adminLevel; ?></span></td>
              <td><?php echo $admin->email; ?></td>
              <td><?php echo date("Y-m-d", strtotime($admin->created_at)); ?></td>
              <td>
                <?php if ($loggedInAdmin->admin_level <= $admin->admin_level) { ?>
                  <div class="dropdown ">
                    <div class="btn-group">
                      <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="feather-more-vertical" title="More Options" style="font-weight: bolder;"></i> More
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?php echo url_for('/admin/show.php?id=' . $admin->id); ?>"> <i class="feather-maximize-2 tet-info"></i> View Admin </a>
                        <a class="dropdown-item" href="<?php echo url_for('/admin/edit.php?id=' . $admin->id); ?>"> <i class="feather-edit text-warning"></i> Edit Admin</a>


                        <a class="dropdown-item" href="<?php echo url_for('/admin/delete.php?id=' . $admin->id); ?>"> <i class="feather-trash text-danger"></i> Delete</a>
                      </div>
                    </div>


                  </div>
                <?php } ?>
              </td>
            </tr>

          <?php } ?>


        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>