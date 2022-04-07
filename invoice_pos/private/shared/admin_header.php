<?php if (!isset($page_title)) {
  $page_title = 'User Area';
} ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Meta -->
  <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
  <meta name="author" content="ParkerThemes">
  <link rel="shortcut icon" href="<?php echo url_for('img/fav.png'); ?>" />

  <!-- Title -->
  <title>InvoicePOS | <?php echo $page_title; ?></title>



  <!-- *************
      ************ Common Css Files *************
      ************ -->
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="<?php echo url_for('css/bootstrap.min.css'); ?>">

  <!-- Icomoon Font Icons css -->
  <link rel="stylesheet" type="text/css" href="<?php echo url_for('fonts/style.css'); ?>">

  <!-- Main css -->
  <link rel="stylesheet" href="<?php echo url_for('css/main.css'); ?>">
  <link rel="stylesheet" href="<?php echo url_for('css/feather.css'); ?>">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo url_for('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css ') ?>">

  <link rel="stylesheet" href="<?php echo url_for('plugins/select2/css/select2.min.css');?>">

  <link rel="stylesheet" href="<?php echo url_for('css/bootstrap-datetimepicker.min.css'); ?>">


  <!-- *************
      ************ Vendor Css Files *************
      ************ -->
  <!-- Datepickers css -->
  <link rel="stylesheet" href="<?php echo url_for('vendor/daterange/daterange.css'); ?>" />

  <link rel="stylesheet" href="<?php echo url_for('vendor/datatables/dataTables.bs4.css'); ?>" />
  <link rel="stylesheet" href="<?php echo url_for('vendor/datatables/dataTables.bs4-custom.css'); ?>" />
  <script src="<?php echo url_for('js/jquery.min.js') ?>"></script>


</head>


<body>

  <!-- Loading starts -->
  <!-- <div id="loading-wrapper">
    <div class="spinner-border text-apex-green" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div> -->
  <!-- Loading ends -->

  <div class="container">


    <!-- *************
        ************ Header section start *************
        ************* -->


    <!-- Header start -->
    <header class="header">
      <!-- Row start -->
      <div class="row gutters">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6">
          <a href="index.html" class="logo">InvoicePOS</a>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6 col-6">
          <!-- Header actions start -->
          <ul class="header-actions">
            <li class="dropdown d-none d-sm-block">
              <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                <img src="<?php echo url_for('img/notification.svg'); ?>" alt="notifications" class="list-icon" />
              </a>
              <div class="dropdown-menu lrg" aria-labelledby="notifications">
                <div class="dropdown-menu-header">
                  <h5>Notifications</h5>
                  <p class="m-0 sub-title">You have 5 unread notifications</p>
                </div>
                <ul class="header-notifications">
                  <li>
                    <a href="#" class="clearfix">
                      <div class="avatar">
                        <img src="<?php echo url_for('img/user.png'); ?>" alt="avatar" />
                        <span class="notify-iocn feather-drafts text-danger"></span>
                      </div>
                      <div class="details">
                        <h6>Corey Haggard</h6>
                        <p>This is so good, I can't stop watching.</p>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="clearfix">
                      <div class="avatar">
                        <img src="<?php echo url_for('img/user2.png'); ?>" alt="avatar" />
                        <span class="notify-iocn feather-layers text-info"></span>
                      </div>
                      <div class="details">
                        <h6>Eric R. Mortensen</h6>
                        <p>Eric sent you a file. Download now</p>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="clearfix">
                      <div class="avatar">
                        <img src="<?php echo url_for('img/user3.png'); ?>" alt="avatar" />
                        <span class="notify-iocn feather-person_add text-success"></span>
                      </div>
                      <div class="details">
                        <h6>Gleb Kuznetsov</h6>
                        <p>Stella, Added you as a Friend. Accept.</p>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="dropdown">
              <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                <span class="user-name"><?php echo $loggedInAdmin->full_name(); ?></span>
                <span class="avatar">AD<span class="status busy"></span></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                <div class="header-profile-actions">
                  <div class="header-user-profile">
                    <div class="header-user">
                      <img src="<?php echo url_for('img/user.png'); ?>" alt="Reatil Admin" />
                    </div>
                    <h5><?php echo $loggedInAdmin->full_name(); ?></h5>
                    <p><?php echo Admin::ADMIN_LEVEL[$loggedInAdmin->admin_level]; ?></p>
                  </div>
                  <a href="user-profile.html"><i class="feather-user"></i> My Profile</a>
                  <a href="pricing.html"><i class="feather-settings"></i> Account Settings</a>
                  <a href="tasks.html"><i class="feather-activity"></i> Activity Logs</a>
                  <a href="<?php echo url_for('logout.php') ?>"><i class="feather-log-out"></i> Sign Out</a>
                </div>
              </div>
            </li>
          </ul>
          <!-- Header actions end -->
        </div>
      </div>
      <!-- Row end -->
    </header>
    <!-- Header end -->



    <!-- Navigation start -->
    <nav class="navbar navbar-expand-lg custom-navbar">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#retailAdminNavbar" aria-controls="retailAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
          <i></i>
          <i></i>
          <i></i>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="retailAdminNavbar">
        <ul class="navbar-nav m-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo ($page_title == "Dashboard" ) ? 'active-page' : '' ?>" href="<?php echo url_for('dashboard.php') ?>">
              <i class="feather-airplay nav-icon"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Users" ) ? 'active-page' : '' ?>" href="#" id="adminDrop" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-user nav-icon"></i>
              Admins
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDrop">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add New User" ) ? 'active' : '' ?>" href="<?php echo url_for('/admin/new.php') ?>">Add New Admin</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "All Users" ) ? 'active' : '' ?>" href="<?php echo url_for('/admin/index.php') ?>">All Users</a>
              </li>
               
              
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Product") ? 'active-page' : '' ?>" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-package nav-icon"></i>
              All Products
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="appsDropdown">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add New Product" ) ? 'active' : '' ?>" href="<?php echo url_for('products/new.php') ?>">Add New Product</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "All Products" ) ? 'active' : '' ?>" href="<?php echo url_for('products/index.php') ?>">All Products</a>
              </li>

              <li>
                <a class="dropdown-item <?php echo ($page_title == "Category" ) ? 'active' : '' ?>" href="<?php echo url_for('product_category/index.php') ?>">Category</a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Customer") ? 'active-page' : '' ?>" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-users nav-icon"></i>
              Customers
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="appsDropdown">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add New Customer" ) ? 'active' : '' ?>" href="<?php echo url_for('client/new.php') ?>">Add New Customer</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "All Customers" ) ? 'active' : '' ?>" href="<?php echo url_for('client/index.php') ?>">All Customer</a>
              </li>
              <li>
                <a class="dropdown-item  d-none<?php echo ($page_title == "Search Vehicle" ) ? 'active' : '' ?>" href="<?php echo url_for('client/vehicle.php') ?>">Search Vehicle</a>
              </li>
            </ul>
          </li>

          <li class="nav-item dropdown d-none">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Wallet" ) ? 'active-page' : '' ?>" href="<?php echo url_for('/wallet/add.php') ?>" id="adminDrop" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i  class="feather-gift  nav-icon"></i> 
              Wallet
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDrop">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Load Wallet" ) ? 'active' : '' ?>" href="<?php echo url_for('/wallet/add.php') ?>">Load Customer's Wallet</a>
              </li>
              <li class="d-none">
                <a class="dropdown-item <?php echo ($page_title == "Wallet History" ) ? 'active' : '' ?>" href="<?php echo url_for('/wallet/index.php') ?>">Wallet History</a>
              </li>
               
              
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == "Wallet" ) ? 'active-page' : '' ?>" href="<?php echo url_for('wallet/add.php') ?>">
              <i class="feather-gift nav-icon"></i>
              Wallet
            </a>
          </li>

          
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == "Invoice" ) ? 'active-page' : '' ?>" href="<?php echo url_for('invoice/') ?>">
              <i class="feather-camera nav-icon"></i>
              Billing & Invoices
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page_title == "Stock" ) ? 'active-page' : '' ?>" href="<?php echo url_for('stock/') ?>">
              <i class="feather-shopping-cart nav-icon"></i>
              Stock
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle
              <?php echo ($page_title == "Add New Booking" || $page_title == "View Bookings" ) ? 'active-page' : '' ?>
            " href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-package nav-icon"></i>
              Bookings
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="formsDropdown">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add New Booking" ) ? 'active' : '' ?>" href="<?php echo url_for('booking/new.php') ?>">Add New Booking</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "View Bookings" ) ? 'active' : '' ?>" href="<?php echo url_for('booking/') ?>">View Bookings</a>
              </li>
              
            </ul>
          </li>
         
          
          <li class="nav-item">
            <a class="nav-link <?php echo ($page_title == "Terms & Policy" ) ? 'active-page' : '' ?>" href="<?php echo url_for('/others/policy.php') ?>" >
              <i class="feather-pie-chart nav-icon"></i>
              Policies
            </a>
           
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link <?php echo ($page_title == "Export" ) ? 'active-page' : '' ?>" href="<?php echo url_for('/others/export.php') ?>">
              <i class="feather-grid nav-icon"></i>
              Export
            </a>
          </li>
          
          <?php //if ($loggedInAdmin->id == 1) { ?>


           <li class="nav-item dropdown">
           

            <a class="nav-link dropdown-toggle
              <?php echo ($page == "Settings") ? 'active-page' : '' ?>
            " href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-settings nav-icon"></i>
              Settings
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="formsDropdown">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "App Setup" ) ? 'active' : '' ?>" href="<?php echo url_for('settings/index.php') ?>">App Setup</a>
              </li>

              <li>
                <a class="dropdown-item <?php echo ($page_title == "Company" ) ? 'active' : '' ?>" href="<?php echo url_for('company/') ?>">Company</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Branch" ) ? 'active' : '' ?>" href="<?php echo url_for('branch/') ?>">Branch</a>
              </li>

              <li>
                <a class="dropdown-item <?php echo ($page_title == "Bank" ) ? 'active' : '' ?>" href="<?php echo url_for('bank/') ?>">Bank</a>
              </li>
              
            </ul>
          </li>
        <?php //} ?>
         

          <li class="nav-item ">
            <a class="nav-link <?php echo ($page_title == "Help" ) ? 'active-page' : '' ?>" href="<?php echo url_for('/others/help.php') ?>">
              <i class="feather-info nav-icon"></i>
              Help
            </a>
          </li>

          

         

        </ul>
      </div>
    </nav>
    <!-- Navigation end -->



    <!-- Search bar start -->
    <div class="search-container ">
      <!-- Row start -->
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-12">

          <div class="search-box">
            <input type="text" class="search-query" placeholder="Search here ...">
            <i class="feather-search"></i>
          </div>

        </div>
      </div>
      <!-- Row end -->
    </div>
    <!-- Search bar end -->


    <!-- *************
        ************ Header section end *************
        ************* -->