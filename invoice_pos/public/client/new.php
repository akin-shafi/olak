<?php

require_once('../../private/initialize.php');

require_login();

if (is_post_request()) {

  // Create record using post parameters
  $args = $_POST['client'];
  $client = new Client($args);
  $result = $client->save();

  // $result = true;
  if ($result == true) {
    $new_id = $client->id;
    // $new_id = 1;
    $rand = rand(10, 200);
    $date = date('ymd');
    // Create ref_no dynamically

    $customer_id = 'C' . str_pad($new_id, 2, '0', STR_PAD_LEFT) . $date;
    $customer = Client::find_by_id($new_id);
    $data1 = [
      'customer_id' => $customer_id,
    ];
    $customer->merge_attributes($data1); 
    $data_set = $customer->save();
    // $data_set = true;

    if ($data_set == true) {
        $data2 = [
          'balance' => 0,
          'customer_id' => $customer_id,
          'company_id' => $loggedInAdmin->company_id,
          'branch_id' => $loggedInAdmin->branch_id
        ];
        
        $wallet = new Wallet($data2);
        $result_set = $wallet->save();
        // pre_r($wallet);
    }

    if ($result_set == true) {
      $session->message('The customer was created successfully.');
      redirect_to(url_for('/client/index.php'));
    }
  } else {
    // show errors
  }
} else {
  // display the form
  $client = new Client;
}

?>
<?php $page = 'Customer'; $page_title = 'Add New Customer'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************Main container start ************* -->
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
    <?php if (display_errors($client->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($client->errors); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <form action="" method="post">
      <?php include("form_fields.php") ?>
      <div class="card-footer">
        <input type="submit" class="btn btn-success float-right" value="Create">
      </div>
  </div>
</div>



</div>
<!-- Row end -->
</form>
</div>
<!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->

<?php include(SHARED_PATH . '/admin_footer.php');
?>
?>