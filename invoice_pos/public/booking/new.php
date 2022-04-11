<?php

require_once('../../private/initialize.php');

require_login();


// if (is_post_request()) {

if (isset($_POST['clients'])) {
  // Create record using post parameters
  $args = $_POST['client'];
  $client = new Client($args);
  $result = $client->save();

  if ($result === true) {
    $new_id = $client->id;

    $argsv = $_POST['vehicle'];
    $argsv['client_id'] = $new_id;
    $vehicle = new Vehicle($argsv);
    $result = $vehicle->save();

    $session->message('The client was created successfully.');
    // redirect_to(url_for('/client/index'));
  }
} else {
  $client = new Client;
  $vehicle = new Vehicle;
}

if (isset($_POST['bookings'])) {
  // Create record using post parameters
  $args = $_POST['book'];
  $book = new Booking($args);

  // echo '<pre>';print_r($args);'</pre><br><br><br>';
  // echo '<pre>';print_r($book);'</pre>';

  $result = $book->save();

  if ($result === true) {
    $new_id = $book->id;
    $session->message('The booking was created successfully.');
    // redirect_to(url_for('/client/index'));
  }
} else {
  $book = new Booking;
}


// } else {
//   // display the form
//   $client = new Client;
//   $vehicle = new Vehicle;
// }


?>
<?php $page_title = 'Add New Booking'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9">
        <h5 class="title"><?php echo $page_title; ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3">
        <div class="daterange-container">

          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
            <i class="feather-file-text"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->
  <?php echo display_session_message(); ?>
  <?php if (display_errors($client->errors)) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo display_errors($client->errors);
      ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
  <?php } ?>

  <?php if (display_errors($book->errors)) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo display_errors($book->errors); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
  <?php } ?>

  <!-- Content wrapper start -->
  <div class="content-wrapper d-flex justify-content-center">
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title d-none">Horizontal Form</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form accept="<?php echo url_for('/booking/process.php'); ?>" method="post" class="form form-horizontal">
              <input type="hidden" name="book[client_id]" id="inputClient">
              <input type="hidden" name="book[plate_no]" id="inputPlate">
              <input type="hidden" name="book[created_by]" value="<?php echo $loggedInAdmin->id; ?>">
              <div class="form-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <span>Vehicle:</span>
                      </div>
                      <div class="col-md-8 ">
                        <span class="bold fs-16 text-uppercase" id="plate_no"></span>

                        <div class="btn-group float-right">
                          <div id="select" class="btn btn-primary mr-2 cursor" data-toggle="modal" data-target="#customModal" >Select</div>
                          <div  id=" new" class="btn btn-outline-primary cursor" data-toggle="modal" data-target="#customModal2">New</div>

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <span>Client:</span>
                      </div>
                      <div class="col-md-8">
                        <span id="client_name" class="bold fs-16 text-uppercase"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <span>Date:</span>
                      </div>
                      <div class="col-md-8">
                        <input type="date" id="date" class="form-control" name="book[date]" placeholder="Date">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <span>Details:</span>
                      </div>
                      <div class="col-md-8">

                        <textarea class="form-control" name="book[details]" placeholder="Complaint"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-8 offset-md-4">
                    <fieldset class="checkbox">
                      <div class="vs-checkbox-con vs-checkbox-primary">
                        <input type="checkbox" id="service" name="book[service]" value="1" <?php if ($book->service == 1) {
                                                                                              echo 'checked';
                                                                                            } ?> />

                        <label for="service">Service</label>
                      </div>
                    </fieldset>
                  </div>
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" name="bookings" class="btn btn-primary mr-1 mb-1">Add</button>
                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
  <!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->


<div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="customModalLabel">Select Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table" id="rowSelection">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Action</th>
                <th>Client</th>
                <th>Client phone</th>
                
              </tr>
            </thead>
            <tbody>
              <?php $sn = 1;
              foreach (Client::find_by_undeleted() as $cli) {
                $veh = Vehicle::find_client_id($cli->id);
              ?>
                <tr>
                  <td><?php echo $sn++; ?></td>
                  <td><span data-dismiss="modal" class="btn btn-sm btn-primary selectClient" id="<?php echo $cli->id; ?>">Select</span></td>
                  <td><?php echo $cli->full_name(); ?></td>
                  <td><?php echo $cli->phone; ?></td>
                  
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer custom">

        <div class="left-side">

        </div>
        <div class="divider"></div>
        <div class="right-side">
          <!-- <button type="button" class="btn btn-link success">Save</button> -->
          <button type="button" class="btn btn-link danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade " id="customModal2" tabindex="-1" role="dialog" aria-labelledby="customModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customModalLabel">Create New Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">

              <div class="row gutters">
                <!-- CLIENT DETAIL -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <input type="hidden" name="client[created_by]" required value="<?php echo $loggedInAdmin->id; ?>" class="form-control">
                    <input type="text" name="client[first_name]" required value="<?php echo $client->first_name; ?>" class="form-control" id="first_name" placeholder="First Name">
                  </div>
                  <div class="form-group">
                    <input type="text" name="client[last_name]" required value="<?php echo $client->last_name; ?>" class="form-control" id="last_name" placeholder="Last Name">
                  </div>
                  <div class="form-group">
                    <textarea name="client[address]" required class="form-control" id="address" placeholder="Address"><?php echo $client->address; ?></textarea>
                  </div>
                  <div class="form-group">
                    <input type="text" name="client[phone]" required value="<?php echo $client->phone; ?>" class="form-control" id="phone" placeholder="Phone Number">
                  </div>
                  <div class="form-group">
                    <input type="text" name="client[email]" required value="<?php echo $client->email; ?>" class="form-control" id="email" placeholder="Email">
                  </div>
                </div>

                <!-- VEHICLE DETAILS -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
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
              <button type="submit" name="clients" class="btn btn-link success">Create Customer</button>
            </div>
      </form>
    </div>
  </div>
</div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
  $(document).ready(function() {
    $('.selectClient').on('click', function() {
      let id = $(this).attr('id');
      console.log(id);
      $.ajax({
        url: 'process.php',
        method: 'post',
        data: {
          selectClient: 1,
          id: id
        },
        dataType: 'json',
        success: function(r) {
          console.log(r);
          $('#plate_no').html(r.plate_no);
          $('#client_name').html(r.client);
          $('#inputPlate').val(r.plate_no);
          $('#inputClient').val(r.client_id);
        }
      });
    })
  });
</script>