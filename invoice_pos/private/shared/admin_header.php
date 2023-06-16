<?php if (!isset($page_title)) $page_title = 'User Area';
require_login(); ?>
<!Doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
  <meta name="author" content="ParkerThemes">
  <link rel="shortcut icon" href="<?php echo url_for('img/fav.png'); ?>" />

  <title>InvoicePOS | <?php echo $page_title; ?></title>
  <link rel="stylesheet" href="<?php echo url_for('css/bootstrap.min.css'); ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo url_for('fonts/style.css'); ?>">

  <link rel="stylesheet" href="<?php echo url_for('css/main.css'); ?>">
  <link rel="stylesheet" href="<?php echo url_for('css/feather.css'); ?>">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <link rel="stylesheet" href="https://fontawesome.com/releases/v5.15/css/all.css" />

  <link rel="stylesheet" href="<?php echo url_for('plugins/select2/css/select2.min.css'); ?>">

  <link rel="stylesheet" href="<?php echo url_for('css/bootstrap-datetimepicker.min.css'); ?>">

  <link rel="stylesheet" href="<?php echo url_for('css/ajax-loader.css'); ?>">

  <link rel="stylesheet" href="<?php echo url_for('vendor/daterange/daterange.css'); ?>" />

  <link rel="stylesheet" href="<?php echo url_for('vendor/datatables/dataTables.bs4.css'); ?>" />
  <link rel="stylesheet" href="<?php echo url_for('vendor/datatables/dataTables.bs4-custom.css'); ?>" />
  <script src="<?php echo url_for('js/jquery.min.js') ?>"></script>
</head>


<body>
  <style>
  body::-webkit-scrollbar {
    width: 0.8em;
  }

  body::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
  }

  body::-webkit-scrollbar-thumb {
    background-color: royalblue;
    outline: 1px solid royalblue;
    border-radius: 25px;
  }
  </style>
  <!-- Loading starts -->
  <!-- <div id="loading-wrapper">
    <div class="spinner-border text-apex-green" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div> -->

  <div class="ajax-wrap d-none">
    <div class="lds-circle">
      <div></div>
    </div>
  </div>

  <div class="container">

    <header class="header">
      <div class="row gutters">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6">
          <a href="<?php echo url_for('/dashboard') ?>" class="logo">InvoicePOS</a>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6 col-6">
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
                        <img src="<?php //echo url_for('img/user.png'); 
                                  ?>" alt="avatar" />
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
                        <img src="<?php echo url_for('img/user1.png'); ?>" alt="avatar" />
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
                        <img src="<?php echo url_for('img/user.png'); ?>" alt="avatar" />
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
        </div>
      </div>
    </header>

    <nav class="navbar navbar-expand-lg custom-navbar">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#retailAdminNavbar"
        aria-controls="retailAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
          <i></i>
          <i></i>
          <i></i>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="retailAdminNavbar">
        <ul class="navbar-nav m-auto">
          <?php if ($accessControl->dashboard == 1) : ?>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page_title == "Dashboard") ? 'active-page' : '' ?>"
              href="<?php echo url_for('dashboard/') ?>">
              <i class="feather-airplay nav-icon"></i>
              Dashboard
            </a>
          </li>
          <?php endif; ?>

          <?php if ($accessControl->user_mgt == 1) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Users") ? 'active-page' : '' ?>" href="#"
              id="adminDrop" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-user nav-icon"></i>
              Admins
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDrop">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add New User") ? 'active' : '' ?>"
                  href="<?php echo url_for('/admin/new.php') ?>">Add New Admin</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "All Users") ? 'active' : '' ?>"
                  href="<?php echo url_for('/admin/index.php') ?>">All Users</a>
              </li>
            </ul>
          </li>
          <?php endif; ?>

          <?php if ($accessControl->product_mgt == 1) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Product") ? 'active-page' : '' ?>" href="#"
              id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-package nav-icon"></i>
              Products
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="appsDropdown">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "All Products") ? 'active' : '' ?>"
                  href="<?php echo url_for('products/index.php') ?>">All Products</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add New Product") ? 'active' : '' ?>"
                  href="<?php echo url_for('products/new.php') ?>">Add Product</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Category") ? 'active' : '' ?>"
                  href="<?php echo url_for('product_category/index.php') ?>">Category</a>
              </li>

            </ul>
          </li>
          <?php endif; ?>

          <?php if ($accessControl->customer_mgt == 1) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Customer") ? 'active-page' : '' ?>" href="#"
              id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-users nav-icon"></i>
              Customers
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="appsDropdown">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add New Customer") ? 'active' : '' ?>"
                  href="<?php echo url_for('client/new.php') ?>">Add New Customer</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "All Customers") ? 'active' : '' ?>"
                  href="<?php echo url_for('client/index.php') ?>">All Customer</a>
              </li>
              <li>
                <a class="dropdown-item  d-none<?php echo ($page_title == "Search Vehicle") ? 'active' : '' ?>"
                  href="<?php echo url_for('client/vehicle.php') ?>">Search Vehicle</a>
              </li>
            </ul>
          </li>
          <?php endif; ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Agents") ? 'active-page' : '' ?>"
              href="<?php echo url_for('/agent_register/index.php') ?>" id="adminDrop" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-user-plus  nav-icon"></i>
              Agents
            </a>

            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDrop">
              <?php if (!in_array($loggedInAdmin->admin_level, [2, 3])) { ?>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add Agent") ? 'active' : '' ?>"
                  href="<?php echo url_for('/agents/new.php') ?>">Add Agent</a>
              </li>
              <?php } ?>

              <li class="">
                <a class="dropdown-item <?php echo ($page_title == "All Agents") ? 'active' : '' ?>"
                  href="<?php echo url_for('/agents/index.php') ?>">All Agent</a>
              </li>
            </ul>
          </li>

          <li class="nav-item dropdown d-none">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Fund") ? 'active-page' : '' ?>"
              href="<?php echo url_for('/fund_register/index.php') ?>" id="adminDrop" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-dollar-sign  nav-icon"></i>
              Fund Register
            </a>

            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDrop">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Load Fund") ? 'active' : '' ?>"
                  href="<?php echo url_for('/fund_register/index.php') ?>">Add fund</a>
              </li>
              <li class="">
                <a class="dropdown-item <?php echo ($page_title == "Fund History") ? 'active' : '' ?>"
                  href="<?php echo url_for('/fund_register/index.php') ?>">History</a>
              </li>


            </ul>
          </li>


          <?php if (in_array($loggedInAdmin->admin_level, [1, 2])) : ?>
          <li class="nav-item dropdown d-none">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Token") ? 'active-page' : '' ?>"
              href="<?php echo url_for('/token/index.php') ?>" id="adminDrop" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="feather-dollar-sign  nav-icon"></i>
              Token
            </a>

            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDrop">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Create Token") ? 'active' : '' ?>"
                  href="<?php echo url_for('/token/add.php') ?>">Create Token</a>
              </li>
              <li class="">
                <a class="dropdown-item <?php echo ($page_title == "All Token") ? 'active' : '' ?>"
                  href="<?php echo url_for('/token/index.php') ?>">All Token</a>
              </li>


            </ul>
          </li>
          <?php endif ?>
          <?php if ($accessControl->can_approve == 1) : ?>
          <li class="nav-item">
            <a class="nav-link  <?php echo ($page_title == "All Transactions") ? 'active-page' : '' ?>"
              href="<?php echo url_for('/transaction/') ?>" id="adminDrop">
              <i class="feather-dollar-sign  nav-icon"></i>
              Transactions
            </a>

          </li>
          <?php endif ?>

          <?php if ($accessControl->compliance == 1) : ?>
          <li class="nav-item">
            <a class="nav-link  <?php echo ($page_title == "Expenses") ? 'active-page' : '' ?>"
              href="<?php echo url_for('/expenses/') ?>" id="adminDrop">
              <i class="feather-shopping-bag  nav-icon"></i>
              Expenses
            </a>
          </li>
          <?php endif ?>







          <?php if ($accessControl->sales_mgt == 1) : ?>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == "Invoice") ? 'active-page' : '' ?>"
              href="<?php echo url_for('invoice/') ?>">
              <i class="feather-credit-card nav-icon"></i>
              Billing & Receipts
            </a>
          </li>
          <?php endif; ?>

          <?php if ($accessControl->wallet_mgt == 1) : ?>


          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle <?php echo ($page == "Wallet") ? 'active-page' : '' ?>"
              href="<?php echo url_for('/wallet/add.php') ?>" id="adminDrop" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="feather-gift  nav-icon"></i>
              <!-- <i class="far fa-wallet nav-icon"></i> -->
              <!-- <i class="fab fa-google nav-icon"></i> -->
              Wallet
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDrop">
              <?php if (!in_array($loggedInAdmin->admin_level, [2, 3])) { ?>
              <li class="d-none">
                <a class="dropdown-item <?php echo ($page_title == "Wallet") ? 'active' : '' ?>"
                  href="<?php echo url_for('/wallet/index.php') ?>"> Customer's Wallet</a>
              </li>
              <?php } ?>
              <li class="">
                <a class="dropdown-item <?php echo ($page_title == "Proof of Payments") ? 'active' : '' ?>"
                  href="<?php echo url_for('/wallet/history.php') ?>">Proof of Payments</a>
              </li>




            </ul>
          </li>

          <?php endif; ?>

          <?php if (in_array($loggedInAdmin->admin_level, [1, 2, 6])) : ?>

          <li class="nav-item">
            <a class="nav-link  <?php echo ($page_title == "All Refund") ? 'active-page' : '' ?>"
              href="<?php echo url_for('/refund/') ?>" id="adminDrop">
              <i class="feather-dollar-sign  nav-icon"></i>
              Refund
            </a>

          </li>

          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle
              <?php echo ($page_title == "Add New Booking" || $page_title == "View Bookings") ? 'active-page' : '' ?>
            " href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="feather-package nav-icon"></i>
              Report
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="formsDropdown">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add New Booking") ? 'active' : '' ?>"
                  href="<?php echo url_for('report/') ?>">Report</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "View Bookings") ? 'active' : '' ?>"
                  href="<?php echo url_for('report/advance.php') ?>">Advance</a>
              </li>

            </ul>
          </li>

          <?php endif ?>

          <?php if ($accessControl->stock_mgt == 1) : ?>

          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle
              <?php echo ($page == "Return" || $page == "Stock") ? 'active-page' : '' ?>
            " href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="feather-shopping-cart nav-icon"></i>
              Stock
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="formsDropdown">
              <li>

                  <a class="dropdown-item <?php echo ($page_title == "Stock") ? 'active' : '' ?>"
                    href="<?php echo url_for('/stock/') ?>" id="adminDrop">
                    <i class="feather-package  nav-icon"></i>
                    Stock
                  </a>
              </li>
              <li>
                  <a class="dropdown-item <?php echo ($page_title == "All Returned Goods") ? 'active' : '' ?>"
                    href="<?php echo url_for('/return/') ?>" id="adminDrop">
                    <i class="feather-shopping-cart  nav-icon"></i>
                    Return Inward
                  </a>
              </li>

            </ul>
          </li>

          
          <?php endif; ?>

          <?php if ($accessControl->report_mgt == 1) : ?>

          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle
              <?php echo ($page_title == "Add New Booking" || $page_title == "View Bookings") ? 'active-page' : '' ?>
            " href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="feather-package nav-icon"></i>
              Report
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="formsDropdown">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add New Booking") ? 'active' : '' ?>"
                  href="<?php echo url_for('report/') ?>">Report</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "View Bookings") ? 'active' : '' ?>"
                  href="<?php echo url_for('report/advance.php') ?>">Advance</a>
              </li>

            </ul>
          </li>


         
          <?php endif; ?>

          <li class="nav-item dropdown d-none">
            <a class="nav-link dropdown-toggle
              <?php echo ($page_title == "Add New Booking" || $page_title == "View Bookings") ? 'active-page' : '' ?>
            " href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="feather-package nav-icon"></i>
              Bookings
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="formsDropdown">
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Add New Booking") ? 'active' : '' ?>"
                  href="<?php echo url_for('booking/new.php') ?>">Add New Booking</a>
              </li>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "View Bookings") ? 'active' : '' ?>"
                  href="<?php echo url_for('booking/') ?>">View Bookings</a>
              </li>

            </ul>
          </li>


          <li class="nav-item d-none">
            <a class="nav-link <?php echo ($page_title == "Terms & Policy") ? 'active-page' : '' ?>"
              href="<?php echo url_for('/others/policy.php') ?>">
              <i class="feather-pie-chart nav-icon"></i>
              Policies
            </a>

          </li>
          <li class="nav-item d-none dropdown">
            <a class="nav-link <?php echo ($page_title == "Export") ? 'active-page' : '' ?>"
              href="<?php echo url_for('/others/export.php') ?>">
              <i class="feather-grid nav-icon"></i>
              Export
            </a>
          </li>

          <?php //if ($loggedInAdmin->id == 1) { 
          ?>

          <?php if ($accessControl->settings_mgt == 1) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle
              <?php echo ($page == "Settings") ? 'active-page' : '' ?>
            " href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="feather-settings nav-icon"></i>
              Settings
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="formsDropdown">
              <?php if ($accessControl->access_control == 1) : ?>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Access Control") ? 'active' : '' ?>"
                  href="<?php echo url_for('settings/access/index.php') ?>">Access Control</a>
              </li>
              <?php endif; ?>
              <?php if ($accessControl->company_setup == 1) : ?>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "App Setup") ? 'active' : '' ?>"
                  href="<?php echo url_for('settings/index.php') ?>">App Setup</a>
              </li>

              <li>
                <a class="dropdown-item <?php echo ($page_title == "Company") ? 'active' : '' ?>"
                  href="<?php echo url_for('company/') ?>">Company</a>
              </li>
              <?php endif; ?>

              <li>
                <a class="dropdown-item <?php echo ($page_title == "Branch") ? 'active' : '' ?>"
                  href="<?php echo url_for('branch/') ?>">Branch</a>
              </li>

              <?php if ($accessControl->access_control == 1) : ?>
              <li>
                <a class="dropdown-item <?php echo ($page_title == "Bank") ? 'active' : '' ?>"
                  href="<?php echo url_for('bank/') ?>">Bank</a>
              </li>
              <?php endif; ?>

            </ul>
          </li>
          <?php endif; ?>

          <li class="nav-item d-none">
            <a class="nav-link <?php echo ($page_title == "Help") ? 'active-page' : '' ?>"
              href="<?php echo url_for('/others/help.php') ?>">
              <i class="feather-info nav-icon"></i>
              Help
            </a>
          </li>

        </ul>
      </div>
    </nav>

    <div class="search-container ">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-12">

          <div class="search-box">
            <!-- <input type="text" class="search-query" placeholder="Search here ..."> -->

            <select required class="form-control client_id select2" id="search_client">
              <option value="">Search Customer</option>
              <?php foreach (Client::find_by_undeleted() as $fetch_cus) : ?>

              <option value="<?php echo $fetch_cus->id ?>"><?php echo $fetch_cus->customer_id ?>-
                (<?php echo $fetch_cus->full_name(); ?>)</option>

              <?php endforeach; ?>
            </select>

            <!-- <i class="feather-search"></i> -->
          </div>

        </div>
      </div>
    </div>


    <input type="hidden" value="<?php echo url_for('client/') ?>" id="Url_link">

    <script>
    var Url_link = $("#Url_link").val()
    $(document).on('change', '#search_client', function() {
      var customer_id = $(this).val();
      window.location.href = Url_link + 'show.php?id=' + customer_id;
    });
    </script>