<?php
require_once('../private/initialize.php');

$user = Employee::find_by_id($loggedInAdmin->id);
$designationName = Designation::find_by_id($user->designation_id)->designation_name;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Employee Dashboard</title>

  <link rel="stylesheet" href="../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="../vendors/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/calendar.css">
  <link rel="stylesheet" href="../css/theme.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/style.css"> -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/theme.css"> -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex align-items-center">
        <a class="navbar-brand brand-logo m-auto" href="../dashboard">
          <img src="../images/logo.png" alt="logo" class="logo-dark" />
        </a>
        <a class="navbar-brand brand-logo-mini text-light font-weight-bold text-center" href="../dashboard" style="font-size: 1rem;">OLAK</a>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex mr-3">Dashboard</h5>
        <form class="search-form d-none d-md-block" action="#">
          <i class="icon-magnifier"></i>
          <input type="search" class="form-control" placeholder="Search Here" title="Search here">
        </form>

        <ul class="navbar-nav navbar-nav-right ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="icon-bell"></i>
              <span class="count">7</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
              <a class="dropdown-item py-3">
                <p class="mb-0 font-weight-medium float-left">You have 7 unread message </p>
                <span class="badge badge-pill badge-primary float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
            </div>
          </li>

          <li class="nav-item d-none d-xl-inline-flex">
            <a class="nav-link" href="#">
              <img class="img-xs rounded-circle mr-2" src="../../hr/assets/uploads/<?php echo $user->photo; ?>" alt="Profile image">
              <div class="d-flex flex-column justify-content-between align-items-start">
                <h6 class="font-weight-bold mb-0"> <?php echo ucwords($user->full_name()); ?> </h6>
                <p class="mb-0">ID: <?php echo strtoupper($user->employee_id); ?></p>
              </div>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>



    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">
                <img class="img-xs rounded-circle" src="../../hr/assets/uploads/<?php echo $user->photo; ?>" alt="profile image">
                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
                <p class="profile-name"><?php echo ucwords($user->full_name()); ?></p>
                <p class="designation"><?php echo strtoupper($designationName); ?></p>
              </div>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../dashboard">
              <span class="menu-title">Dashboard</span>
              <i class="icon-screen-desktop menu-icon"></i>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-user mr-4"></i>
              <span class="menu-title">My Profile</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-credit-card mr-4"></i>
              <span class="menu-title">Loan Status</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-calendar mr-4"></i>
              <span class="menu-title">Attendance</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-home mr-4"></i>
              <span class="menu-title">Leave Status</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-settings mr-4"></i>
              <span class="menu-title">Settings</span>
            </a>
          </li>

          <div class="m-custom" style="margin-top: 12rem;"></div>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo url_for('logout.php') ?>">
              <i class="icon-logout mr-4"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>

        </ul>
      </nav>

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="status-wrap mb-4">
            <div class="card ml-auto shadow" style="width:250px; border-radius: 8px;">
              <div class="card-body p-2">
                <div class="d-flex align-items-center px-3">
                  <p class="mb-0 mr-3">Job Status:</p>
                  <strong>Fulltime</strong>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-5">
            <div class="col-md-8 pr-4">
              <div class="row">
                <div class="col-md-6 col-sm-12 mb-4">
                  <div class="card shadow" style="border-radius: 20px;">
                    <div class="card-body p-4">

                      <div class="d-flex justify-content-between align-items-center">
                        <div class="left">
                          <span class="text-muted">Work Days</span>
                          <h1>22</h1>
                        </div>
                        <div class="right">
                          <div class="d-flex justify-content-center align-items-center bg-secondary rounded-circle" style="width: 50px;height:50px; font-size:20px">
                            <i class="icon-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-4">
                  <div class="card shadow" style="border-radius: 20px;">
                    <div class="card-body p-4">

                      <div class="d-flex justify-content-between align-items-center">
                        <div class="left">
                          <span class="text-muted">Present Days</span>
                          <h1>10</h1>
                        </div>
                        <div class="right">
                          <div class="d-flex justify-content-center align-items-center bg-secondary rounded-circle" style="width: 50px;height:50px; font-size:20px">
                            <i class="icon-clock"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 mt-4">
                  <div class="card shadow" style="border-radius: 8px;">
                    <div class="card-body p-2">
                      <h6 class="font-weight-bold my-3 ml-3">Monthly Attendance Summary</h6>
                      <div id="attendance-chart"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="calendar-wrap mb-4 ">
                <h4 class="font-weight-bolder d-none">Calendar</h4>
                <div class="card shadow" style="border-radius: 16px;">
                  <div class="card-body">
                    <div class="calendar-wrapper" id="calendar-wrapper"></div>
                  </div>
                </div>
              </div>

              <div class="leave-wrap mb-1">
                <h4 class="font-weight-bolder d-none">Leave Status</h4>
                <div class="card shadow" style="border-radius: 16px;">
                  <div class="card-body">
                    <div class="mb-4">
                      <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Sick Leave </h6>
                        <p class="mb-0">50/120 days</p>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 45%;">45%</div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Annual Leave </h6>
                        <p class="mb-0">70/120 days</p>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;">75%</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Developed by <a href="#">Sandsify Systems</a> <?php echo date('Y'); ?></span>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../vendors/moment/moment.min.js"></script>
  <script src="../vendors/daterangepicker/daterangepicker.js"></script>
  <script src="../js/off-canvas.js"></script>
  <script src="../js/misc.js"></script>
  <script src="../js/dist/apexcharts.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
  <script src="../js/calendar.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/calendar.min.js"></script> -->
  <!-- <script src="../js/dashboard.js"></script> -->

  <script>
    $('.calendar-wrapper').calendar();

    $(document).ready(function() {

      var options = {
        series: [{
          data: [21, 22, 10, 28, 16, 21, 13, 30, 21, 4, 5, 12]
        }],
        chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        colors: ["#133d80"],
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: true
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
          labels: {
            style: {
              colors: ["#133d80"],
              fontSize: '12px'
            }
          }
        }
      };

      var attendance = new ApexCharts(document.querySelector("#attendance-chart"), options);
      attendance.render();
    })
  </script>
</body>

</html>