<?php

require_once('../../private/initialize.php');

// require_login();

// Find all undeleted admins
$clients = Client::find_by_undeleted();

if (isset($_POST['receive'])) {
  // Create record using post parameters
  $args = $_POST['vehicle'];
  $vehicle = new Vehicle($args);
  // echo '<pre>';
  // print_r($vehicle);
  // '</pre>';
  $result = $vehicle->save();

  if ($result === true) {
    $new_id = $vehicle->id;
    $session->message('Vehicle added successfully.');
    // redirect_to(url_for('/client/index'));
  }
} else {
  $vehicle = new Vehicle;
}
// echo '<pre>';print_r($clients);'</pre>';


// print_r(Vehicle::find_client_id(1)->make);

$page = 'Customer';

?>
<?php $page_title = 'All Customers'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">
          
          <a href="<?php echo url_for('client/new.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New Customer">
            <i class="feather-plus"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->


  <?php echo display_session_message(); ?>

  <?php if (display_errors($vehicle->errors)) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo display_errors($vehicle->errors);
      ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
  <?php } ?>
  <!-- Content wrapper start -->
  <div class="content-wrapper">


    <!-- Row start -->
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
          <div class="card-body">

            <!--*************************
                    *************************
                    *************************
                    Basic table start
                  *************************
                  *************************
                  *************************-->
            <div class="table-responsive">
              <table id="rowSelection" class="table table-sm table-striped ">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>W.Balance</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sn = 1;
                  foreach ($clients  as $client) {  
                    $balance = intval(Wallet::find_by_customer_id($client->customer_id)->balance);
                  ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo $client->full_name(); ?></td>
                      <td><?php echo $client->phone; ?></td>
                      <td><?php echo $client->address; ?></td>
                      <td><?php echo $client->email; ?></td>
                      <td><?php echo $currency ." ". number_format($balance, 2); ?></td>
                      <td>

                        <div class="dropdown ">
                          <div class="btn-group">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="feather-more-vertical" title="More Options" style="font-weight: bolder;"></i> More
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="<?php echo url_for('/client/show.php?id=' . $client->id); ?>"> <i class="feather-maximize-2 tet-info"></i> View Customer Info </a>
                              <a class="dropdown-item" href="<?php echo url_for('/client/edit.php?id=' . $client->id); ?>"> <i class="feather-edit text-warning"></i> Edit Customer</a>
                              
                              <a class="dropdown-item" href="<?php echo url_for('/client/edit.php?id=' . $client->id); ?>"> <i class="feather-file-text text-orange"></i> Invoice</a>

                              <a class="dropdown-item" href="<?php echo url_for('/client/edit.php?id=' . $client->id); ?>"> <i class="feather-trash text-danger"></i> Delete</a>
                            </div>
                          </div>
                          <a href="<?php echo url_for('wallet/add.php?id='. $client->customer_id ) ?>" class=" btn btn-sm btn-primary " > <i class="feather-plus text-success"></i> Load wallet</a>
                        </div>
                      </td>
                    </tr>

                  <?php } ?>


                </tbody>
              </table>
            </div>
            <!--************************* Basic table end*************************-->

          </div>
        </div>



      </div>

    </div>
    <!-- Row end -->


  </div>
  <!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->
<div class="modal fade " id="customModal2" tabindex="-1" role="dialog" aria-labelledby="customModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customModalLabel">Load wallet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="post">
        <input type="hidden" name="vehicle[client_id]" id="vehicle">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">

              <div class="row gutters">
                <!-- CLIENT DETAIL -->


                <!-- VEHICLE DETAILS -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="form-group">
                    <input type="text" name="vehicle[plate_no]" value="<?php echo $vehicle->plate_no; ?>" class="form-control" id="plate_noistration" placeholder="Plate Number">
                  </div>
                  <div class="form-group">
                    <input type="text" name="vehicle[make]" value="<?php echo $vehicle->make; ?>" class="form-control" id="make" placeholder="Make">
                  </div>
                  <div class="form-group">
                    <input type="text" name="vehicle[model]" value="<?php echo $vehicle->model; ?>" class="form-control" id="model" placeholder="Model">
                  </div>
                  <div class="form-group">
                    <input type="text" name="vehicle[year]" value="<?php echo $vehicle->year; ?>" class="form-control" id="year" placeholder="Year">
                  </div>
                  <div class="form-group">
                    <label for="last_service">Last Service</label>
                    <input type="date" name="vehicle[last_service]" value="<?php //echo date('Y-m-d', strtotime($vehicle->last_service));
                                                                            ?>" class="form-control" id="last_service" placeholder="Last Service">
                  </div>

                </div>

              </div>

            </div>
          </div>
          <div class="modal-footer custom">

            <div class="left-side">
              <button type="button" class="btn btn-link danger" data-dismiss="modal">Cancel</button>
            </div>
            <div class="divider"></div>
            <div class="right-side">
              <button type="submit" name="receive" class="btn btn-link success">Create Customer</button>
            </div>
      </form>
    </div>
  </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
  $(document).ready(function() {
    $('.vehicle').on('click', function() {
      let id = $(this).attr('id');
      $('#vehicle').val(id);
    })
  });
</script>