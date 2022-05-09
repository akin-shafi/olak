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


// print_r(Vehicle::find_client_id(1)->make)

?>
<?php $page = "Product";
$page_title = 'All Products'; ?>
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

          <a href="<?php echo url_for('products/new.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New Product">
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

            <!--************* Basic table start *************-->
            <div class="table-responsive">
              <!-- <table id="example2" class="table table-striped table-bordered table-hover" style="margin-bottom:5px;"> -->
              <table id="rowSelection" class="table table-sm table-striped ">
                <thead>
                  <tr class="active">
                    <th style="max-width:30px;">ID</th>
                    <th style="max-width:30px;">Image</th>
                    <th class="col-xs-1">Code</th>
                    <th>Name</th>
                    <th class="col-xs-1">Type</th>
                    <th class="col-xs-1">Category</th>
                    <th class="col-xs-1">Quantity</th>
                    <th class="col-xs-1">Tax</th>
                    <th class="col-xs-1">Method</th>
                    <th class="col-xs-1">P.Price</th>
                    <th class="col-xs-1">S.Price</th>
                    <th style="width:165px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sn = 1;
                  foreach (Product::find_by_undeleted() as $key => $value) { ?>
                    <tr>
                      <td><?php echo $sn++; ?> </td>
                      <td>
                        <div style="width:32px; margin: 0 auto;"><a href="<?php echo !empty($value->file) ? url_for('/uploads/thumbs/' . $value->file) :  url_for('/uploads/thumbs/image.jpg'); ?>" class="open-image">
                            <img width="32" src="<?php echo !empty($value->file) ? url_for('/uploads/thumbs/' . $value->file) :  url_for('/uploads/thumbs/bottles.jpg'); ?>" alt="images" class="img-responsive"></a></div>
                      </td>
                      <td><?php echo $value->code; ?></td>
                      <td><?php echo $value->pname; ?></td>
                      <td><?php echo $value->type; ?></td>
                      <td>
                        <?php
                        $e = $value->category;
                        $cat = ProductCategory::find_by_id($value->category)->category;
                        if ($e == 1) { ?>
                          <span class="label label-danger"><?php echo $cat ?></span>
                        <?php } else if ($e == 2) { ?>
                          <span class="label label-success"><?php echo $cat ?></span>
                        <?php } else if ($e == 3) { ?>
                          <span class="label label-danger"><?php echo $cat ?></span>
                        <?php } else if ($e == 4) { ?>
                          <span class="label bg-black text-white"><?php echo $cat ?></span>
                        <?php } else if ($e == 5) { ?>
                          <span class="label label-warning"><?php echo $cat ?></span>
                        <?php } else { ?>
                          <span class="label label-primary"><?php echo $cat ?></span>

                        <?php } ?>
                      </td>
                      <td><?php echo $value->quantity; ?></td>
                      <td><?php echo $value->product_tax; ?></td>
                      <td><?php $n = $value->tax_method;
                          echo ($n == 2) ? '<span class="label label-primary">Inclusive</span>' : '<span class="label label-warning">Exclusive</span>'; ?></td>
                      <td><?php echo $value->cost; ?></td>
                      <td><?php echo $value->price; ?></td>
                      <td>
                        <div class="text-center">
                          <div class="btn-group">

                            <a title="View" class="tip btn btn-primary btn-xs view" data-id="<?php echo $value->id; ?>"><i class="fa feather-file"></i></a>





                            <!-- <a href="#" title="Print Barcodes" class="tip btn btn-default btn-xs barcode"  data-id="<?php echo $value->id; ?>"><i class="feather-camera"></i></a>   -->

                            <a href="<?php echo url_for('/products/edit.php?id=') ?><?php echo $value->id; ?>" title="Edit Product" class="tip btn btn-warning btn-xs edit" data-id="<?php echo $value->id; ?>"><i class="feather-edit"></i></a>

                            <a title="Delete Product" class="tip btn btn-danger btn-xs delete" data-id="<?php echo $value->id; ?>"><i class="feather-trash"></i></a>
                          </div>
                      </td>


                    </tr>
                    <!-- <tr>
                         <td colspan="12" class="dataTables_empty">Leading data from server</td>
                      </tr> -->
                  <?php } ?>
                </tbody>
              </table>

            </div>
            <!--*************************
                    *************************
                    *************************
                    Basic table end
                  *************************
                  *************************
                  *************************-->

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
        <h5 class="modal-title" id="customModalLabel">Create New Client</h5>
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