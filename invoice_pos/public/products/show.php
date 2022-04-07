<?php

require_once('../../private/initialize.php');

// require_login();

// Find all undeleted admins
$id = $_GET['id'];
$clients = Client::find_by_id($id);
$vehicle = Vehicle::find_by_vehicle($id);
// $admins = Admin::find_by_undeleted();

?>
<?php $page_title = 'Admins'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title">Client Profile</h5>
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
          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Read More">
            <i class="feather-file-text"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->


  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 border">
            <div class="profile-view">
              <div class="profile-img-wrap border">
                <div class="profile-img">
                  <a href="">
                    <img src="<?php echo url_for('/img/user1.png') ?>" alt="">
                  </a>
                </div>
              </div>
              <div class="profile-basic border">
                <div class="row">
                  <div class="col-md-5 col-sm-12 col-12">
                    <div class="profile-info-left">
                      <h3 class="user-name m-t-0"><?php echo $clients->full_name() ?></h3>
                      <h5 class="company-role m-t-0 mb-0">Customer</h5>
                      <div class="staff-id"><i>Registered By : <?php echo Admin::find_by_id($clients->created_by)->full_name(); ?></i></div>
                      <div class="staff-msg"><a href="chat.html" class="btn btn-custom">Send Message</a></div>
                    </div>
                  </div>
                  <div class="col-md-7 col-sm-12 col-12">
                    <ul class="personal-info">
                      <li>
                        <span class="title">Phone:</span>
                        <span class="text"><a href=""><?php echo $clients->phone; ?></a></span>
                      </li>
                      <li>
                        <span class="title">Email:</span>
                        <span class="text"><a href=""><?php echo $clients->email; ?></a></span>
                      </li>
                      <li>
                        <span class="title">Birthday:</span>
                        <span class="text"><a href="">2nd June</a></span>
                      </li>
                      <li>
                        <span class="title">Address:</span>
                        <span class="text"><?php echo $clients->address; ?></span>
                      </li>
                      <li>
                        <span class="title">Member since:</span>
                        <span class="text"><?php echo date('dS M, Y', strtotime($clients->created_at)); ?></span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="table-responsive">
      <table class="table table-bordered" id="rowSelection">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Lincence Plate</th>
            <th>Maker</th>
            <th>Model</th>
            <th>Last Service</th>
            <th>Repair Record</th>
          </tr>
        </thead>
        <tbody>
          <?php $sn = 1;
          foreach ($vehicle as $value) { ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $value->plate_no; ?></td>
              <td><?php echo $value->make; ?></td>
              <td><?php echo $value->model; ?></td>
              <td><?php echo date('dS M, Y', strtotime($value->last_service)); ?></td>
              <td><a href="record.php"><i class="feather-settings bold"> History</i></a></td>
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