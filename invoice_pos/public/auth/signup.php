<?php require_once('../../private/initialize.php') ?>

<?php
require_login();
if (is_post_request()) {

  // Create record using post parameters
  $args = $_POST['admin'];
  $admin = new Admin($args);
  $result = $admin->save();

  if ($result === true) {
    $new_id = $admin->id;
    // Logfile
    // log_action('New Admin', "id: {$admin->id}, Created by {$loggedInAdmin->full_name()}", "admin");

    $session->message('The admin was created successfully.');
    redirect_to(url_for('/admin/index.php'));
  } else {
    // show errors
  }
} else {
  // display the form
  $admin = new Admin;
}


?>

<?php include(SHARED_PATH . '/auth_header.php') ?>

<!-- Container start -->
<div class="container">


  <div class="row justify-content-md-center">
    <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
      <div class="login-screen">
        <div class="login-box">
          <a href="#" class="login-logo">
            InvoicePOS
            <!-- <span class="text-danger">A</span><span class="text-warning">u</span><span class="text-success">t</span><span class="text-info">o</span><span class="text-royal-orange">C</span><span class="text-jungle-green">r</span><span class="text-danger">a</span><span class="text-success">f</span><span class="text-jungle-green">t</span> -->
          </a>
          <?php if ($admin->errors) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?php echo display_errors($admin->errors); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          <?php } ?>

          <h5>Welcome,<br />Create new Admin Account.</h5>
          <form method="post">
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" name="admin[first_name]" value="<?php echo $admin->first_name; ?>" placeholder="First Name" />
                <input type="text" class="form-control" name="admin[last_name]" value="<?php echo $admin->last_name; ?>" placeholder="Last Name">
              </div>
              <!--  <small id="passwordHelpInline" class="text-muted">
                Password must be 8-20 characters long.
              </small> -->
            </div>

            <div class="form-group">
               <div class="input-group">
                  <input type="text" class="form-control" name="admin[email]" value="<?php echo $admin->email; ?>" placeholder="Email Address" />
            
                  <input type="text" class="form-control" name="admin[phone]" value="<?php echo $admin->phone; ?>" placeholder="Phone Number" />
                </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="password" class="form-control" name="admin[password]" placeholder="Password" />
                <input type="password" class="form-control" name="admin[confirm_password]" placeholder="Confirm Password">
              </div>
              <small id="passwordHelpInline" class="text-muted">
                Password must be 8-20 characters long.
              </small>
            </div>

            <div class="form-group">
              <select name="admin[admin_level]" id="admin_level" class="form-control">
                <option value="">Select Admin level</option>
                <?php foreach (Admin::ADMIN_LEVEL as $key => $level) { ?>
                  <option value="<?php echo $key; ?>"><?php echo $level; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
               <div class="input-group">
                  <select class="form-control">
                    <option>Select Company</option>
                  </select>
                
                  <select class="form-control">
                    <option>Select Branch</option>
                  </select>
                </div>
            </div>

            <div class="actions">
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
          <div class="or">
            <span>All-right Reserved</span>
          </div>



          <div class="m-0 ">
            <span class="additional-link"> <a href="<?php echo url_for('admin/index.php') ?>">Back to List</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- Container end -->

<?php include(SHARED_PATH . '/auth_footer.php'); ?>