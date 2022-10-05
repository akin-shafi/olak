<?php

require_once('../../private/initialize.php');

require_login();

$id = $_GET['id'] ?? '';
if ($id) {
  $customer = Client::find_by_customer_id($id);
  $c_id = $customer->id;
  $customer_name = $customer->full_name();
}


$token = Token::find_by_customer_id($id);

if ($token == false) {
  redirect_to(url_for('/token/index.php'));
}

if (is_post_request()) {

  // Save record using post parameters
  $args = $_POST['token'];
  $token->merge_attributes($args);
  $result = $token->save();

  if ($result === true) {

    $session->message('The token was updated successfully.');
    redirect_to(url_for('/token/index.php'));
  } else {
    // show errors
  }
} else {

  // display the form

}

?>

<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php') ?>

<!-- Container start -->
<div class="main-container">


  <!-- Page header start -->
    <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">

          <a href="<?php echo url_for('token/') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="back">
            <i class="feather-arrow-left"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Page header end -->

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <?php if (display_errors($token->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($token->errors); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <form action="" method="post">
      <?php include("form_field.php") ?>
      <div class="card-footer clearfix">
        <input type="submit" class="btn btn-success float-right" value="Edit">
      </div>
  </div>
</div>
<!-- Container end -->

<?php include(SHARED_PATH . '/admin_footer.php') ?>