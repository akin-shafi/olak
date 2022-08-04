<?php

require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
  redirect_to(url_for('/company/index.php'));
}
$id = $_GET['id'];
$company = Company::find_by_id($id);
if ($company == false) {
  redirect_to(url_for('/company/index.php'));
}

if (is_post_request()) {

  // logfile
  log_action('Delete company', "id: {$company->id}, Deleted by {$loggedInAdmin->full_name()}", "company");

  // Delete company
  $result = $company->deleted($id);
  $session->message('The Company was deleted successfully.');
  redirect_to(url_for('/company/index.php'));
} else {
  // Display form
}

?>

<?php $page_title = 'Delete Company'; ?>
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
         
          <a href="<?php echo url_for('/company/delete.php?id=' . h(u($id))); ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Delete">
            <i class="feather-trash"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->


  <!-- Content wrapper start -->
  <div class="content-wrapper">


    <div class="card text-center p-4">
    <!-- <h1>Delete company</h1> -->
    <p>Are you sure you want to delete this company?</p>
    <p class="item"><?php echo h($company->company_name); ?></p>

    <form action="<?php echo url_for('/company/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations" class="btn-group">
        <input type="submit" name="commit" class="btn btn-sm btn-danger border-0" value="Yes" />
        <a href="<?php echo url_for('/company/index.php'); ?>" class="btn btn-sm btn-dark">No</a>
      </div>
    </form>
  </div>


  </div>
  <!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->




<?php include(SHARED_PATH . '/admin_footer.php'); ?>