<?php

require_once('../../private/initialize.php');

require_login();

$id = $_GET['id'];

$client = Client::find_by_id($id);
$vehicle = Vehicle::find_by_id($id);

pre_r($vehicle);

if (!$client) {
  redirect_to(url_for('/client/index.php'));
}

if (is_post_request()) {


  $args = $_POST['client'];
  $client->merge_attributes($args);
  $result = $client->save();

  $argsV = $_POST['vehicle'];
  $vehicle->merge_attributes($argsV);
  $result = $vehicle->save();

  if ($result === true) {
    $new_id = $client->id;

    $session->message("The {$client->clientcat} client was updated successfully.");

    redirect_to(url_for('/client/index.php'));
  } else {
    $session->message("The {$client->clientcat} client was not updated successfully.");
  }
} else {
  // display the form
}


?>
<?php $page = 'Customer';
$page_title = 'Edit Customer'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>


<div class="main-container">

  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title">Create New Client | Vehicle</h5>
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
    <?php if (display_errors($client->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($client->errors); ?>
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