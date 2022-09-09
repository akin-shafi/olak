<?php

require_once('../../private/initialize.php');


if ($loggedInAdmin->admin_level == 1) {
  $agents = Agent::find_by_undeleted();
} else {
  $agents = Agent::find_by_branch_id($loggedInAdmin->branch_id);
}


if (isset($_POST['receive'])) {
  $args = $_POST['vehicle'];
  $vehicle = new Vehicle($args);
  $result = $vehicle->save();

  if ($result === true) {
    $new_id = $vehicle->id;
    $session->message('Vehicle added successfully.');
    // redirect_to(url_for('/agent/index'));
  }
} else {
  $vehicle = new Vehicle;
}



$page = 'Customer';

?>
<?php $page_title = 'All Customers'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div class="main-container">

  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">

          <a href="<?php echo url_for('agent/new.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New Customer">
            <i class="feather-plus"></i>
          </a>
        </div>
      </div>
    </div>
  </div>


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

  <div class="content-wrapper">
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
          <div class="card-body">

            <div class="table-responsive">
              <table id="rowSelection" class="table table-sm table-striped ">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Credit Facility</th>
                    <th>W.Balance</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sn = 1;
                  foreach ($agents  as $agent) {
                    $balance = intval(Wallet::find_by_customer_id($agent->customer_id)->balance);
                  ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo $agent->full_name(); ?></td>
                      <td><?php echo $agent->phone; ?></td>
                      <td><?php echo $agent->address; ?></td>
                      <td><?php echo $agent->email; ?></td>
                      <td>
                        <span class="badge badge-primary rounded">
                          <?php echo $agent->credit_facility == 1 ? 'Yes' : 'No'; ?>
                        </span>
                      </td>
                      <td><?php echo $currency . " " . number_format($balance, 2); ?></td>
                      <td>

                        <div class="dropdown ">
                          <div class="btn-group">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="feather-more-vertical" title="More Options" style="font-weight: bolder;"></i> More
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="<?php echo url_for('/agent/show.php?id=' . $agent->id); ?>"> <i class="feather-maximize-2 tet-info"></i> View Customer Info </a>
                              <a class="dropdown-item" href="<?php echo url_for('/agent/edit.php?id=' . $agent->id); ?>"> <i class="feather-edit text-warning"></i> Edit Customer</a>

                              <a class="dropdown-item" href="<?php echo url_for('/agent/edit.php?id=' . $agent->id); ?>"> <i class="feather-file-text text-orange"></i> Invoice</a>

                              <a class="dropdown-item" href="<?php echo url_for('/agent/edit.php?id=' . $agent->id); ?>"> <i class="feather-trash text-danger"></i> Delete</a>
                            </div>
                          </div>
                          <a href="<?php echo url_for('wallet/add.php?id=' . $agent->customer_id) ?>" class=" btn btn-sm btn-primary "> <i class="feather-plus text-success"></i> Load wallet</a>
                        </div>
                      </td>
                    </tr>

                  <?php } ?>


                </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>

    </div>
  </div>
</div>


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
        <input type="hidden" name="vehicle[agent_id]" id="vehicle">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">

              <div class="row gutters">

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