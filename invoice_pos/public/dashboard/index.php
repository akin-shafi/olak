<?php

require_once('../../private/initialize.php');

require_login();

$billing = Billing::find_by_metrics();

?>
<?php $page_title = 'Dashboard'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title">Welcome back, <?php echo $loggedInAdmin->full_name(); ?></h5>
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
          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
            <i class="feather-download"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->


  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <!-- Row start -->
    <div class="row gutters justify-content-center">
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">


        <div class="daily-sales">
          <h6>Revenue</h6>
          <h1><?php echo number_format($billing->total_amount) ?></h1>
          <p>Total Revenue</p>
          <div id="apexLineChartGradient2" class="orange-graph"></div>
        </div>

      </div>

      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

        <div class="daily-sales">
          <h6>Invoices</h6>
          <h1><?php echo number_format($billing->counts) ?></h1>
          <p>Generated Invoices</p>
          <div id="apexLineChartGradient3" class="pink-graph"></div>
        </div>

      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">

        <div class="daily-sales">
          <h6>Credit</h6>
          <h1><?php echo number_format($billing->part_payment) ?></h1>
          <p>Paid Invoices</p>
          <div id="apexLineChartGradient4" class="lavandar-graph"></div>
        </div>

      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="daily-sales">
          <h6>Balance</h6>
          <h1><?php echo number_format($billing->balance) ?></h1>
          <p>Expected Invoice Balance</p>
          <div id="apexLineChartGradient" class="blue-graph"></div>
        </div>


      </div>
    </div>
    <!-- Row end -->

    <!-- Row start -->
    <div class="row gutters justify-content-center d-none">
      <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12 col-12">

        <!-- Row start -->
        <div class="row no-gutters">
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">

            <div class="daily-sales">
              <h6>Customers</h6>
              <h1><?php echo count(Client::find_by_undeleted()) ?></h1>
              <p>Number of Customers</p>
              <div id="apexColumnBasic" class="orange-graph"></div>
            </div>

          </div>
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">

            <div class="daily-sales">
              <h6>Staffs</h6>
              <h1><?php echo count(Admin::find_by_undeleted()) - 1 ?></h1>
              <p>Number of Staffs</p>
              <div id="apexColumnBasic2" class="yellow-graph"></div>
            </div>

          </div>
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">

            <div class="daily-sales">
              <h6>Assets</h6>
              <h1>0</h1>
              <p>Total Assets</p>
              <div id="apexColumnBasic3" class="blue-graph"></div>
            </div>

          </div>
        </div>
        <!-- Row end -->

      </div>
    </div>
    <!-- Row end -->


    <!-- Row start -->
    <div class="row gutters d-none">
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Rvenue</div>
            <div class="card-sub-title">Overall Sales Revenue and Profits Performance Online and Offline for Q1 to Q4.</div>
          </div>
          <div class="card-body btm-bdr blue pb-0">
            <div class="revenue">
              <div class="revenue-header">
                <span class="revenue-number">2750</span>
                <i class="feather-trending_up text-success"></i>
                <small>15.25%</small>
              </div>
              <div id="apexOrders" class="blue-graph"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-none">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Traffic Source</div>
            <div class="card-sub-title">Overall Traffic Source and Referral Performance Online and Offline for Q1 to Q4.</div>
          </div>
          <div class="card-body btm-bdr green pb-0">
            <div class="traffic">
              <div class="traffic-header">
                <span class="traffic-number">5000</span>
                <i class="feather-trending_down text-danger"></i>
                <small>10.75%</small>
              </div>
              <div id="traffic" class="orange-graph"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-none">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Overall Product Rating</div>
            <div class="card-sub-title">250 out of 250(100%) reviewers would recommend this products rating for Q1 to Q4.</div>
          </div>
          <div class="card-body btm-bdr orange pb-0">
            <div class="overall-rating">
              <div class="rating-header">
                <span class="rating-number">5.0</span>
                <div class="rating-box">
                  <img src="img/star-selected.svg" class="star" alt="Rating" />
                  <img src="img/star-selected.svg" class="star" alt="Rating" />
                  <img src="img/star-selected.svg" class="star" alt="Rating" />
                  <img src="img/star-selected.svg" class="star" alt="Rating" />
                  <img src="img/star-selected.svg" class="star" alt="Rating" />
                </div>
              </div>
              <div id="overAllRating" class="sea-blue-graph"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-nones">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Deals</div>
            <div class="card-sub-title">Overall Deals Revenue and Profits Performance Online and Offline for Q1 to Q4.</div>
          </div>
          <div class="card-body btm-bdr pink pb-0">
            <div class="deals">
              <div class="deals-header">
                <span class="deals-number">3,500</span>
                <i class="feather-trending_up text-success"></i>
                <small>25.9%</small>
              </div>
              <div id="deals" class="pink-graph"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-nones">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Department Sales</div>
            <div class="card-sub-title">Overall Sales Revenue and Profits Performance Online and Offline for Q1 to Q4.</div>
          </div>
          <div class="card-body btm-bdr yellow pb-0">
            <div class="dpt-sales">
              <div class="dpt-sales-header">
                <span class="dpt-sales-number">6,000</span>
                <i class="feather-trending_up text-success"></i>
                <small>10.5%</small>
              </div>
              <div id="apexSales" class="blue-graph"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-nones">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Customers</div>
            <div class="card-sub-title">Overall Customers and Signups Performance Online and Offline Sales Q1 to Q4.</div>
          </div>
          <div class="card-body btm-bdr sea-blue pb-0">
            <div class="customers">
              <div class="customers-header">
                <span class="customers-number">7,500</span>
                <i class="feather-trending_up text-success"></i>
                <small>12.5%</small>
              </div>
              <div id="customers" class="pink-graph"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Row end -->


    <!-- Row start -->
    <div class="row gutters  d-none">
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
        <div class="notify info">
          <div class="notify-body">
            <span class="type">Info</span>
            <div class="notify-title">Give your valuable feedback.<img src="img/notification-info.svg" alt="" /></div>
            <div class="notify-text">How likely are you to recommend Retail Dashboard to your friends?</div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
        <div class="notify danger">
          <div class="notify-body">
            <span class="type">Danger</span>
            <div class="notify-title">Give your valuable feedback.<img src="img/notification-danger.svg" alt="" /></div>
            <div class="notify-text">How likely are you to recommend Retail Dashboard to your friends?</div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
        <div class="notify success">
          <div class="notify-body">
            <span class="type">Success</span>
            <div class="notify-title">Give your valuable feedback.<img src="img/notification-success.svg" alt="" /></div>
            <div class="notify-text">How likely are you to recommend Retail Dashboard to your friends?</div>
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

<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<!-- Apex Charts -->
<script src="<?php echo url_for('vendor/apex/apexcharts.min.js') ?>"></script>
<script src="<?php echo url_for('vendor/apex/custom/apexLineChartGradient.js') ?>"></script>
<script src="<?php echo url_for('vendor/apex/custom/apexColumnBasic.js') ?>"></script>
<script src="<?php echo url_for('vendor/apex/custom/apexAllCustomGraphs.js') ?>"></script>