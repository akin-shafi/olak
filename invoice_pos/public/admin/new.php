<?php

require_once('../../private/initialize.php');

require_login();

if (is_post_request()) {

  $args = $_POST['admin'];
  $admin = new Admin($args);
  $result = $admin->save();

  if ($result == true) :
    $req = $_POST['permit'];

    $args = [
      'user_id'        => $admin->id,
      'dashboard'      => isset($req['dashboard'])      ? 1 : 0,
      'product_mgt'    => isset($req['product_mgt'])    ? 1 : 0,
      'customer_mgt'   => isset($req['customer_mgt'])   ? 1 : 0,
      'wallet_mgt'     => isset($req['wallet_mgt'])     ? 1 : 0,
      'stock_mgt'      => isset($req['stock_mgt'])      ? 1 : 0,
      'settings_mgt'   => isset($req['settings_mgt'])   ? 1 : 0,
      'sales_mgt'      => isset($req['sales_mgt'])      ? 1 : 0,
      'special_sales'  => isset($req['special_sales'])  ? 1 : 0,
      'add_sales'      => isset($req['add_sales'])      ? 1 : 0,
      'edit_sales'     => isset($req['edit_sales'])     ? 1 : 0,
      'manage_sales'   => isset($req['manage_sales'])   ? 1 : 0,
      'expenses_mgt'   => isset($req['expenses_mgt'])   ? 1 : 0,
      'add_exp'        => isset($req['add_exp'])        ? 1 : 0,
      'edit_exp'       => isset($req['edit_exp'])       ? 1 : 0,
      'delete_exp'     => isset($req['delete_exp'])     ? 1 : 0,
      'report_mgt'     => isset($req['report_mgt'])     ? 1 : 0,
      'access_control' => isset($req['access_control']) ? 1 : 0,
      'company_setup'  => isset($req['company_setup'])  ? 1 : 0,
      'user_mgt'       => isset($req['user_mgt'])       ? 1 : 0,
      'compliance'     => isset($req['compliance'])     ? 1 : 0,
      'filtering'      => isset($req['filtering'])      ? 1 : 0,
      'process_waybill'      => isset($req['process_waybill'])      ? 1 : 0,
      'created_by'     => $loggedInAdmin->id,
    ];

    $access = new AccessControl($args);
    $access->save();

    if ($result === true) {

      $session->message('The admin was created successfully.');
      redirect_to(url_for('/admin/index.php'));
    }

    exit(json_encode(['success' => true, 'msg' => 'User created successfully!']));
  endif;
} else {
  // display the form
  $admin = new Admin;
}

?>
<?php //$page_title = 'Create Admin'; 
?>
<?php $page = 'Users';
$page_title = 'Add New User'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>



<div class="main-container">

  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">

          <a href="<?php echo url_for('admin/index.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="">
            <i class="feather-file-text"></i>
          </a>
        </div>
      </div>
    </div>
  </div>


  <div class="content-wrapper">
    <?php if (display_errors($admin->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($admin->errors); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <form method="post">
      <input type="hidden" name="admin[created_by]" value="<?php echo $loggedInAdmin->id ?>">
      <?php include('form_fields.php'); ?>
      <div class="container">
        <div class="modal-footer">
          <button class="btn btn-primary" id="add_company_btn">Submit</button>
        </div>
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>