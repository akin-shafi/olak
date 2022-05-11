<?php require_once('../private/initialize.php');
require_login();

$page = 'Dashboard';
$page_title = 'Admin Dashboard';
include(SHARED_PATH . '/admin_header.php');

if (empty($access->dashboard) || $access->dashboard != 1) :
  redirect_to('../requests');
endif;

$requests = Request::find_by_undeleted();

?>


<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-5">
        <div class="card card-transparent card-block card-stretch card-height border-none">
          <div class="card-body p-0 mt-lg-2 mt-0">
            <h4 class="mb-3"> <span id="greetings"></span>, <?php echo $loggedInAdmin->full_name; ?></h4>
            <p class="mb-0 mr-4">Your dashboard gives you views of key performance or business process.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="row">
          <div class="col-lg-6 col-md-6 ml-auto">
            <div class="card card-block card-stretch card-height">
              <div class="card-body">
                <div class="d-flex align-items-center mb-4 card-total-sale">
                  <div class="icon iq-icon-box-2 bg-info-light">
                    <img src="<?php echo url_for('png/1-2.png') ?>" class=" img-fluid" alt="image">
                  </div>
                  <div>
                    <p class="mb-2">Total Request</p>
                    <h4><?php echo count($requests); ?></h4>
                  </div>
                </div>
                <div class="iq-progress-bar mt-2">
                  <span class="bg-info iq-progress progress-1" data-percent="85">
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 d-none">
            <div class="card card-block card-stretch card-height">
              <div class="card-body">
                <div class="d-flex align-items-center mb-4 card-total-sale">
                  <div class="icon iq-icon-box-2 bg-danger-light">
                    <img src="<?php echo url_for('png/2.png') ?>" class="img-fluid" alt="image">
                  </div>
                  <div>
                    <p class="mb-2">Total Cost</p>
                    <h4>$ 4598</h4>
                  </div>
                </div>
                <div class="iq-progress-bar mt-2">
                  <span class="bg-danger iq-progress progress-1" data-percent="70">
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 d-none">
            <div class="card card-block card-stretch card-height">
              <div class="card-body">
                <div class="d-flex align-items-center mb-4 card-total-sale">
                  <div class="icon iq-icon-box-2 bg-success-light">
                    <img src="<?php echo url_for('png/3.png') ?>" class="img-fluid" alt="image">
                  </div>
                  <div>
                    <p class="mb-2">Product Sold</p>
                    <h4>4589 M</h4>
                  </div>
                </div>
                <div class="iq-progress-bar mt-2">
                  <span class="bg-success iq-progress progress-1" data-percent="75">
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card card-block card-stretch card-height-helf">
          <div class="card-body">
            <div class="d-flex align-items-top justify-content-between">
              <div class="">
                <p class="mb-0">Income</p>
                <h5><?php echo $currency; ?> 98,7800 K</h5>
              </div>
              <div class="card-header-toolbar d-flex align-items-center">
                <div class="dropdown">
                  <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton003" data-toggle="dropdown">
                    This Month<i class="ri-arrow-down-s-line ml-1"></i>
                  </span>
                  <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton003">
                    <a class="dropdown-item" href="#">Year</a>
                    <a class="dropdown-item" href="#">Month</a>
                    <a class="dropdown-item" href="#">Week</a>
                  </div>
                </div>
              </div>
            </div>
            <div id="layout1-chart-3" class="layout-chart-1"></div>
          </div>
        </div>
        <div class="card card-block card-stretch card-height-helf">
          <div class="card-body">
            <div class="d-flex align-items-top justify-content-between">
              <div class="">
                <p class="mb-0">Expenses</p>
                <h5><?php echo $currency; ?> 45,8956 K</h5>
              </div>
              <div class="card-header-toolbar d-flex align-items-center">
                <div class="dropdown">
                  <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton004" data-toggle="dropdown">
                    This Month<i class="ri-arrow-down-s-line ml-1"></i>
                  </span>
                  <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton004">
                    <a class="dropdown-item" href="#">Year</a>
                    <a class="dropdown-item" href="#">Month</a>
                    <a class="dropdown-item" href="#">Week</a>
                  </div>
                </div>
              </div>
            </div>
            <div id="layout1-chart-4" class="layout-chart-2"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card card-block card-stretch">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Order Summary</h4>
            </div>
            <div class="card-header-toolbar d-flex align-items-center">
              <div class="dropdown">
                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton005" data-toggle="dropdown">
                  This Month<i class="ri-arrow-down-s-line ml-1"></i>
                </span>
                <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton005">
                  <a class="dropdown-item" href="#">Year</a>
                  <a class="dropdown-item" href="#">Month</a>
                  <a class="dropdown-item" href="#">Week</a>
                </div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div id="layout1-chart-5"></div>
          </div>
        </div>
      </div>


      <div class="col-lg-6 d-none">
        <div class="card card-block card-stretch card-height">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Overview</h4>
            </div>
            <div class="card-header-toolbar d-flex align-items-center">
              <div class="dropdown">
                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton001" data-toggle="dropdown">
                  This Month<i class="ri-arrow-down-s-line ml-1"></i>
                </span>
                <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton001">
                  <a class="dropdown-item" href="#">Year</a>
                  <a class="dropdown-item" href="#">Month</a>
                  <a class="dropdown-item" href="#">Week</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="layout1-chart1"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 d-none">
        <div class="card card-block card-stretch card-height">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Revenue Vs Cost</h4>
            </div>
            <div class="card-header-toolbar d-flex align-items-center">
              <div class="dropdown">
                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton002" data-toggle="dropdown">
                  This Month<i class="ri-arrow-down-s-line ml-1"></i>
                </span>
                <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton002">
                  <a class="dropdown-item" href="#">Yearly</a>
                  <a class="dropdown-item" href="#">Monthly</a>
                  <a class="dropdown-item" href="#">Weekly</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="layout1-chart-2" style="min-height: 360px;"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 d-none">
        <div class="card card-block card-stretch card-height">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Top Products</h4>
            </div>
            <div class="card-header-toolbar d-flex align-items-center">
              <div class="dropdown">
                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton006" data-toggle="dropdown">
                  This Month<i class="ri-arrow-down-s-line ml-1"></i>
                </span>
                <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton006">
                  <a class="dropdown-item" href="#">Year</a>
                  <a class="dropdown-item" href="#">Month</a>
                  <a class="dropdown-item" href="#">Week</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="list-unstyled row top-product mb-0">
              <li class="col-lg-3">
                <div class="card card-block card-stretch card-height mb-0">
                  <div class="card-body">
                    <div class="bg-warning-light rounded">
                      <img src="<?php echo url_for('png/01.png') ?>" class="style-img img-fluid m-auto p-3" alt="image">
                    </div>
                    <div class="style-text text-left mt-3">
                      <h5 class="mb-1">Organic Cream</h5>
                      <p class="mb-0">789 Item</p>
                    </div>
                  </div>
                </div>
              </li>
              <li class="col-lg-3">
                <div class="card card-block card-stretch card-height mb-0">
                  <div class="card-body">
                    <div class="bg-danger-light rounded">
                      <img src="<?php echo url_for('png/02.png') ?>" class="style-img img-fluid m-auto p-3" alt="image">
                    </div>
                    <div class="style-text text-left mt-3">
                      <h5 class="mb-1">Rain Umbrella</h5>
                      <p class="mb-0">657 Item</p>
                    </div>
                  </div>
                </div>
              </li>
              <li class="col-lg-3">
                <div class="card card-block card-stretch card-height mb-0">
                  <div class="card-body">
                    <div class="bg-info-light rounded">
                      <img src="<?php echo url_for('png/03.png') ?>" class="style-img img-fluid m-auto p-3" alt="image">
                    </div>
                    <div class="style-text text-left mt-3">
                      <h5 class="mb-1">Serum Bottle</h5>
                      <p class="mb-0">489 Item</p>
                    </div>
                  </div>
                </div>
              </li>
              <li class="col-lg-3">
                <div class="card card-block card-stretch card-height mb-0">
                  <div class="card-body">
                    <div class="bg-success-light rounded">
                      <img src="<?php echo url_for('png/02.png') ?>" class="style-img img-fluid m-auto p-3" alt="image">
                    </div>
                    <div class="style-text text-left mt-3">
                      <h5 class="mb-1">Organic Cream</h5>
                      <p class="mb-0">468 Item</p>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none">
        <div class="card-transparent card-block card-stretch mb-4">
          <div class="card-header d-flex align-items-center justify-content-between p-0">
            <div class="header-title">
              <h4 class="card-title mb-0">Best Item All Time</h4>
            </div>
            <div class="card-header-toolbar d-flex align-items-center">
              <div><a href="#" class="btn btn-primary view-btn font-size-14">View All</a></div>
            </div>
          </div>
        </div>
        <div class="card card-block card-stretch card-height-helf">
          <div class="card-body card-item-right">
            <div class="d-flex align-items-top">
              <div class="bg-warning-light rounded">
                <img src="<?php echo url_for('png/04.png') ?>" class="style-img img-fluid m-auto" alt="image">
              </div>
              <div class="style-text text-left">
                <h5 class="mb-2">Coffee Beans Packet</h5>
                <p class="mb-2">Total Sell : 45897</p>
                <p class="mb-0">Total Earned : $45,89 M</p>
              </div>
            </div>
          </div>
        </div>
        <div class="card card-block card-stretch card-height-helf">
          <div class="card-body card-item-right">
            <div class="d-flex align-items-top">
              <div class="bg-danger-light rounded">
                <img src="<?php echo url_for('png/05.png') ?>" class="style-img img-fluid m-auto" alt="image">
              </div>
              <div class="style-text text-left">
                <h5 class="mb-2">Bottle Cup Set</h5>
                <p class="mb-2">Total Sell : 44359</p>
                <p class="mb-0">Total Earned : $45,50 M</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
  const day = new Date();
  const hr = day.getHours();
  let greet = '';
  if (hr >= 0 && hr < 12) {
    greet = "Good Morning";
  } else if (hr == 12) {
    greet = "Good Noon";
  } else if (hr >= 12 && hr <= 17) {
    greet = "Good Afternoon";
  } else {
    greet = "Good Evening";
  }
  $('#greetings').html(greet)
</script>