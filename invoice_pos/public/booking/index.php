<?php

require_once('../../private/initialize.php');

require_login();

// Find all undeleted admins
// $admins = Admin::find_by_undeleted();
// $admins = Admin::find_by_undeleted();

?>
<?php $page_title = 'View Bookings'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9">
        <h5 class="title">All Bookings</h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3">
        <div class="daterange-container">
          <div class="date-range">
            <div id="reportrange">
              <i class="feather-calendar cal"></i>
              <span class="range-text">Jan 20, 2020 - Feb 18, 2020</span>
              <i class="feather-chevron-down arrow"></i>
            </div>
          </div>
          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
            <i class="feather-grid"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->


  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <div class="table-responsive">
      <table class="table table-bordered" id="rowSelection">

        <thead>

          <tr>
            <th>S/N</th>
            <th>Date</th>
            <th>Client</th>
            <th>Car</th>
            <th>Reg</th>
            <th>Details</th>
            <th>Service</th>
            <th>Job Completed ?</th>
            <th>Action</th>
          </tr>
          <tr class="bg-primary">
            <th colspan="9" style="color: #FFF; text-align: center;">
              Booking from Jan 21, 2020 - Feb 19, 2020</th>
          </tr>
        </thead>
        <!-- <tr class="bg-dark"> 
                  <th colspan="7" style="color: #FFF">19-2-2020</th> 
                  
                </tr>  -->
        <tbody>
          <?php $sn = 1; ?>
          <?php foreach (Booking::find_by_undeleted() as $book) { ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo date('dS M, Y', strtotime($book->date)); ?></td>
              <td><a href="<?php echo url_for('/client/show.php?id='. $book->client_id) ?>" class="text-primary bold fs-14"><?php echo Client::find_by_id($book->client_id)->full_name(); ?></a></td>
              <td><?php echo Vehicle::find_by_id($book->id)->make .' '. Vehicle::find_by_id($book->id)->model; ?></td>
              <td><?php echo Vehicle::find_by_id($book->id)->plate_no; ?></td>
              <td><?php echo $book->details; ?></td>
              <td>
                <?php if ($book->service == 1) { ?>
                  <i class="feather-target fs-20 text-success"></i>
                <?php } else { ?>
                  <i class="feather-target fs-20 text-danger"></i>
                <?php } ?>
              </td>
              <td>
                <a href="<?php echo url_for('/task/completion_form.php?id='. 1) ?>" class="btn btn-success ">
                   <i class="feather-thumbs-up fs-20 text-light"></i> Yes 
                </a>
              </td>
              <td>

                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" data-display="" aria-haspopup="true" aria-expanded="false">
                  <i class="feather-more-vertical fs-20 text-light"></i> More
                </button>
                <div class="dropdown-menu ">
                  <a href="<?php echo url_for('/booking/edit.php?id='. $book->id); ?>" class="dropdown-item"> <i class="feather-edit text-warning"></i> Edit</a>
                  <a href="<?php echo url_for('/invoice/invoice.php?id='. $book->id); ?>" class="dropdown-item"> <i class="feather-file-text text-primary"></i> Invoice</a>
                  <a href="<?php echo url_for('/booking/edit.php?id='. $book->id); ?>" class="dropdown-item"> <i class="feather-clock text-success"></i> Repair History</a>
                  <a href="<?php echo url_for('/booking/edit.php?id='. $book->id); ?>" class="dropdown-item"> <i class="feather-trash text-danger"></i> Delete</a>
                </div>


              </td>
              
            </tr>
          <?php } ?>
        </tbody>





      </table>
    </div>




  </div>
  <!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->

<?php include(SHARED_PATH . '/admin_footer.php');
?>