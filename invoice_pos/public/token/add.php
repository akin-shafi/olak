<?php
require_once('../../private/initialize.php');
require_login();

$id = $_GET['id'] ?? '';
if ($id) {
  $customer = Client::find_by_customer_id($id);
  $c_id = $customer->id;
  $customer_name = $customer->full_name();
}

if (is_post_request()) {

  // Create record using post parameters
  $args = $_POST['token'];
  $token = new Token($args);
  $result = $token->save();

  if ($result == true) {
    $data_id = $token->id;
    $rand = rand(10, 100);
    $date = date('His');
    $token_id = $data_id.$rand.$date;

    $record = Token::find_by_id($data_id);
    $data = [
      'token_id' => $token_id,
      'status' => 1,
    ];

    $record->merge_attributes($data);
    $result_data = $record->save();
    if ($result_data == true) {
      $session->message('The token was created successfully.');
      redirect_to(url_for('/token/index.php'));
    }
    
  }else{
    // show errors
  }

  
} else {
  // display the form
  $token = new Token;
}



?>

<?php $page = 'token'; $page_title = 'Create token'; ?>
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

          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
            <i class="feather-file-text"></i>
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
    <form id="add_token_form" class="mb-0" method="post">
      <?php include('form_field.php') ?>
      <div class="modal-footer">
        <button class="btn btn-primary" id="add_token_btn">Submit</button>
      </div>
    </form>
    
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
