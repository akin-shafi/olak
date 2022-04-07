<?php

require_once('../../../private/initialize.php');

require_login();

// Find all admins
$admins = Admin::find_all();

?>
<?php $page_title = 'Admins'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<style type="text/css">
  #wit {
    width: 180px !important
  }
</style>
<div>
  <div class="skew-2 text-white bold ">
    <div class="w-190 text-right p-3"><i class="fa fa-home"></i>
      <span class=""><?php echo $page_title; ?></span>
    </div>
  </div>
</div>
<div class="text-danger text-center d-flex justify-content-center"><?php echo display_session_message(); ?></div>
<div id="content" class="container-90">

  <!-- <h5 class="container-90 navy-blue alert">Staffs</h5> -->

  <div class="container-fluid border mt-3 rounded pb-2 pt-2 ">
    <div class="navy-blue rounded muna p-2 justify-content-center text-align-center" style="width: 100%;">
      <i class="bold pt-2">
        <span class="fas fa-dolly "></span>
        Staffs
      </i>

      <!-- <span class="float-right">
              <form class="form-inline">
                  <div class="form-group">
                    <input type="text" class="form-control" id="myInput" placeholder="search..." name="">
                  </div>

              </form>
            </span> -->
      <br class="clear">
    </div>
    <div class="table-responsive mt-2">

      <table class="table table-bordered table-sm table-striped table-hover fs-13" id="table_id">
        <thead>
          <tr>
            <th class="text-center">
            </th>
            <th>Staff name</th>
            <th>Username</th>
            <!-- <th>Department</th> -->
            <th>User Category</th>
            <!-- <th>Phone</th> -->
            <th>State</th>
            <!-- <th>View</th> -->
          </tr>
        </thead>

        <tbody>
          <?php foreach ($admins as $admin) { ?>
            <tr>
              <!-- <td></td> -->
              <td class="text-center" id="wit">
                <?php if ($loggedInAdmin->admin_level == 1) { ?>
                  <a class="action btn btn-navy btn-sm text-navy" href="<?php echo url_for('/staff/admins/update.php?id=' . h(u($admin->id))); ?>">Add to GWX</a>
                  <!--<a class="action btn btn-navy btn-sm text-navy" href="<?php //echo url_for('/staff/admins/delete.php?id=' . h(u($admin->id))); 
                                                                            ?>">Delete</a>-->
                <?php } ?>
                <a class="action btn btn-black btn-sm text-navy" href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin->id))); ?>">View</a>
              </td>
              <td><?php echo h(ucwords($admin->full_name())); ?></td>
              <td><?php echo h(ucwords($admin->username)); ?></td>
              <!-- <td><?php //echo h($admin->department); 
                        ?></td> -->
              <td><?php echo h(FortressAdmin::F_ADMIN_LEVEL[$admin->admin_level]); ?></td>
              <!-- <td><?php //echo h($admin->phone); 
                        ?></td> -->
              <td><?php echo h(State::find_by_id($admin->state)->name); ?></td>

              <!-- <td></td> -->
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>