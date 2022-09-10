<?php

require_once('../../private/initialize.php');

require_login();

$id = $_GET['id'];

$agent = Agent::find_by_id($id);
if (!$agent) {
  redirect_to(url_for('/agent/index.php'));
}

if (is_post_request()) {
  $args = $_POST['agent'];
  $agent->merge_attributes($args);
  $result = $agent->save();

  if ($result === true) {
    $new_id = $agent->id;
    $session->message("Agent record updated successfully.");
    redirect_to(url_for('/agents/index.php'));
  } else {
    $session->message("Error updating Agent record.");
  }
} else {
  // display the form
}


?>
<?php $page = 'Agents';
$page_title = 'Edit Agent'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>


<div class="main-container">

  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title; ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">
          <div class="date-range">
            <div id="reportrange">
              <i class="feather-calendar cal"></i>
              <!-- <span class="range-text">Jan 20, 2020 - Feb 18, 2020</span> -->
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
    <?php if (display_errors($agent->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($agent->errors); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <form method="post">
      <?php include("form_fields.php") ?>
    </form>
  </div>
</div>



<?php include(SHARED_PATH . '/admin_footer.php');
?>
?>