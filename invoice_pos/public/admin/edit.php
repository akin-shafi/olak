<?php

require_once('../../private/initialize.php');

require_login();

// if(!isset($_GET['id'])) {
//   redirect_to(url_for('/staff/admins/index.php'));
// }

$id = $_GET['id'] ?? $loggedInAdmin->id;
$admin = Admin::find_by_id($id);
if ($admin == false) {
  redirect_to(url_for('admins/index.php'));
}

if (is_post_request()) {

  $args = $_POST['admin'];
  $admin->merge_attributes($args);
  $result = $admin->save();

  if ($result === true) :
    $req = $_POST['permit'];
    $access = AccessControl::find_by_user_id($id);


    $args = [
      'user_id'        => $admin->id,
      'dashboard'      => isset($req['dashboard'])      ? 1 : 0,
      'product_mgt'    => isset($req['product_mgt'])    ? 1 : 0,
      'customer_mgt'   => isset($req['customer_mgt'])   ? 1 : 0,
      'wallet_mgt'     => isset($req['wallet_mgt'])     ? 1 : 0,
      'stock_mgt'      => isset($req['stock_mgt'])      ? 1 : 0,
      'settings_mgt'   => isset($req['settings_mgt'])   ? 1 : 0,
      'sales_mgt'      => isset($req['sales_mgt'])      ? 1 : 0,
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
      'filtering'      => isset($req['filtering'])      ? 1 : 0,
      'created_by'     => $loggedInAdmin->id,
    ];


    if (isset($access->id)) :
      $access->merge_attributes($args);
      $access->save();
    else :
      $access = new AccessControl($args);
      $access->save();
    endif;


    log_action('Edit Admin', "id: {$admin->id}, Edited by {$loggedInAdmin->full_name()}", "admin");

    $session->message('The admin was updated successfully.');
    redirect_to(url_for('admin/show.php?id=' . $id));
  endif;
}
?>

<?php $page = 'Users';
$page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php') ?>

<div class="main-container">

  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
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
            <i class="feather-download"></i>
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
    <form action="" method="post">
      <?php include("form_fields.php") ?>
      <div class="card-footer clearfix">
        <input type="submit" class="btn btn-success float-right" value="Edit">
      </div>
  </div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php') ?>