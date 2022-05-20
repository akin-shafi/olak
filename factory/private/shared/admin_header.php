<?php
require_login();
$access = AccessControl::find_by_user_id($loggedInAdmin->id);

$isActive = 0;

$user = $loggedInAdmin;
$fullName = $user->full_name;

?>

<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <meta name="description" content="Sandsify Systems">
   <meta name="author" content="Sandsify">
   <link rel="shortcut icon" href="png/fav.png" />

   <title>Olak Pet. - <?php echo $page_title ?></title>

   <link rel="stylesheet" href="<?php echo url_for('css/bootstrap.min.css') ?>">
   <link rel="stylesheet" href="<?php echo url_for('css/style.css') ?>">
   <link rel="stylesheet" href="<?php echo url_for('css/main.css') ?>">
   <link rel="stylesheet" href="<?php echo url_for('css/daterange.css') ?>" />

   <link rel="stylesheet" href="<?php echo url_for('css/chartist.min.css') ?>" />
   <link rel="stylesheet" href="<?php echo url_for('css/chartist-custom.css') ?>" />
   <link rel="stylesheet" href="<?php echo url_for('css/datatables.bs4.css') ?>" />
   <link rel="stylesheet" href="<?php echo url_for('css/datatables.bs4-custom.css') ?>" />
   <link rel="stylesheet" href="<?php echo url_for('css/buttons.bs.css') ?>">

</head>

<body>
   <div id="loading-wrapper" class="d-none">
      <div class="spinner-border" role="status">
         <span class="sr-only">Loading...</span>
      </div>
   </div>

   <style>
      html {
         scroll-behavior: smooth;
      }

      .table-responsive::-webkit-scrollbar {
         width: 0.5em;
         height: 0.5em;
      }

      .table-responsive::-webkit-scrollbar-track {
         box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.3);
         border-radius: 10px;
      }

      .table-responsive::-webkit-scrollbar-thumb {
         background-color: #1a8e5f;
         outline: 1px solid #1a8e5f;
         border-radius: 25px;
      }

      .lds-hourglass,
      .out-of-service {
         display: grid;
         place-items: center;
         width: 100vw;
         height: 100vh;
         background-color: rgba(0, 0, 0, 0.8);
         transform: translateZ(1px);
         position: fixed;
         top: 0;
         left: 0;
         z-index: 999;
      }

      .lds-hourglass:after {
         content: " ";
         display: block;
         border-radius: 50%;
         width: 0;
         height: 0;
         margin: 8px;
         box-sizing: border-box;
         border: 32px solid green;
         border-color: green transparent green transparent;
         animation: lds-hourglass 1.2s infinite;
      }

      @keyframes lds-hourglass {
         0% {
            transform: rotate(0);
            animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
         }

         50% {
            transform: rotate(900deg);
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
         }

         100% {
            transform: rotate(1800deg);
         }
      }
   </style>

   <div class="lds-hourglass d-none"></div>
   <div class="out-of-service d-none">
      <h1 style="color:white;text-align:center">Kindly contact the manager for more information!.</h1>
   </div>

   <header class="header">
      <div class="logo-wrapper">
         <a href="<?php echo url_for('/dashboard') ?>" class="logo text-white">
            <!-- <img src="<?php echo url_for('png/logo.png') ?>" alt="Wafi Admin Dashboard" /> -->
            Olak Pet.
         </a>
         <a href="#" class="quick-links-btn" data-toggle="tooltip" data-placement="right" title="" data-original-title="Quick Links">
            <i class="icon-menu1"></i>
         </a>
      </div>
      <div class="header-items">
         <div class="custom-search">
            <input type="text" class="search-query" placeholder="Search here ...">
            <i class="icon-search1"></i>
         </div>

         <ul class="header-actions">
            <li class="dropdown">
               <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                  <i class="icon-box"></i>
               </a>
               <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                  <div class="dropdown-menu-header">
                     Tasks (05)
                  </div>
                  <ul class="header-tasks">
                     <li>
                        <p>#48 - Dashboard UI<span>90%</span></p>
                        <div class="progress">
                           <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                              <span class="sr-only">90% Complete (success)</span>
                           </div>
                        </div>
                     </li>
                     <li>
                        <p>#95 - Alignment Fix<span>60%</span></p>
                        <div class="progress">
                           <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                              <span class="sr-only">60% Complete (success)</span>
                           </div>
                        </div>
                     </li>
                     <li>
                        <p>#7 - Broken Button<span>40%</span></p>
                        <div class="progress">
                           <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                              <span class="sr-only">40% Complete (success)</span>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </li>
            <li class="dropdown">
               <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                  <i class="icon-bell"></i>
                  <span class="count-label">8</span>
               </a>
               <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                  <div class="dropdown-menu-header">
                     Notifications (40)
                  </div>
                  <ul class="header-notifications">
                     <li>
                        <a href="#">
                           <div class="user-img away">
                              <img src="<?php echo url_for('png/user21.png') ?>" alt="User" />
                           </div>
                           <div class="details">
                              <div class="user-title">Abbott</div>
                              <div class="noti-details">Membership has been ended.</div>
                              <div class="noti-date">Oct 20, 07:30 pm</div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="#">
                           <div class="user-img busy">
                              <img src="<?php echo url_for('png/user10.png') ?>" alt="User" />
                           </div>
                           <div class="details">
                              <div class="user-title">Braxten</div>
                              <div class="noti-details">Approved new design.</div>
                              <div class="noti-date">Oct 10, 12:00 am</div>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="#">
                           <div class="user-img online">
                              <img src="<?php echo url_for('png/user6.png') ?>" alt="User" />
                           </div>
                           <div class="details">
                              <div class="user-title">Larkyn</div>
                              <div class="noti-details">Check out every table in detail.</div>
                              <div class="noti-date">Oct 15, 04:00 pm</div>
                           </div>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
            <li class="dropdown">
               <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                  <span class="user-name"><?php echo $fullName; ?></span>
                  <span class="avatar"><?php echo substr($fullName, 0, 2); ?><span class="status busy"></span></span>
               </a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                  <div class="header-profile-actions">
                     <div class="header-user-profile">
                        <div class="header-user">
                           <img src="<?php echo url_for('png/user.png') ?>" alt="Admin Template" />
                        </div>
                        <h5><?php echo $fullName; ?></h5>
                        <p><?php echo  Admin::ADMIN_LEVEL[$loggedInAdmin->admin_level]; ?></p>
                     </div>
                     <a href="<?php echo '#!' //url_for('/user-profile.php') 
                              ?>" class=""><i class="icon-user1"></i> My Profile</a>
                     <a href="account-settings.php"><i class="icon-settings1"></i> Account Settings</a>
                     <a href="<?php echo url_for('/logout.php') ?>"><i class="icon-log-out1"></i> Sign Out</a>
                  </div>
               </div>
            </li>
            <li>
               <a href="#" class="quick-settings-btn" data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick Settings">
                  <i class="icon-list"></i>
               </a>
            </li>
         </ul>
      </div>
   </header>

   <div class="screen-overlay"></div>

   <div class="quick-links-box">
      <div class="quick-links-header">
         Quick Links
         <a href="#" class="quick-links-box-close">
            <i class="icon-circle-with-cross"></i>
         </a>
      </div>

      <div class="quick-links-wrapper">
         <div class="fullHeight">
            <div class="quick-links-body">
               <div class="container-fluid p-0">
                  <div class="row less-gutters">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <a href="documents.html" class="quick-tile blue">
                           <i class="icon-file-text"></i>
                           Documents
                        </a>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="crm-dashboard.html" class="quick-tile secondary">
                           <i class="icon-pie-chart1"></i>
                           CRM
                        </a>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="ecommerce-dashboard.html" class="quick-tile blue">
                           <i class="icon-shopping-cart1"></i>
                           Ecommerce
                        </a>
                     </div>
                  </div>
                  <div class="row less-gutters">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <a href="gallery2.html" class="quick-tile photos lg">
                           Photos
                        </a>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="tasks.html" class="quick-tile">
                           <i class="icon-check-circle"></i>
                           Tasks
                        </a>
                        <a href="calendar-external-draggable.html" class="quick-tile blue">
                           <i class="icon-calendar1"></i>
                           Events
                        </a>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="chat.html" class="quick-tile blue">
                           <i class="icon-message-circle"></i>
                           Chat
                        </a>
                        <a href="default-layout.html" class="quick-tile">
                           <i class="icon-grid"></i>
                           Layout
                        </a>
                     </div>
                  </div>
                  <div class="row less-gutters">
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="custom-alerts.html" class="quick-tile secondary">
                           <i class="icon-alert-triangle"></i>
                           Alerts
                        </a>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="google-maps.html" class="quick-tile blue">
                           <i class="icon-map-pin"></i>
                           Maps
                        </a>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="https://www.gmail.com/" target="_blank" class="quick-tile white">
                           <i class="icon-drafts"></i>
                           Gmail
                        </a>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="https://www.youtube.com/" target="_blank" class="quick-tile secondary">
                           <i class="icon-youtube"></i>
                           Youtube
                        </a>
                     </div>
                  </div>
                  <div class="row less-gutters">
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="user-profile.html" class="quick-tile">
                           <i class="icon-account_circle"></i>
                           Profile
                        </a>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="contacts.html" class="quick-tile">
                           <i class="icon-phone"></i>
                           Contacts
                        </a>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="account-settings.html" class="quick-tile">
                           <i class="icon-settings1"></i>
                           Settings
                        </a>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <a href="login.html" class="quick-tile">
                           <i class="icon-lock2"></i>
                           Logout
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="quick-settings-box">
      <div class="quick-settings-header">
         <div class="date-container">Today <span class="date" id="today-date"></span></div>
         <a href="#" class="quick-settings-box-close">
            <i class="icon-circle-with-cross"></i>
         </a>
      </div>
      <div class="quick-settings-body">
         <div class="fullHeight">
            <div class="quick-setting-list">
               <h6 class="title">Events</h6>
               <ul class="list-items">
                  <li>
                     <div class="list-title">Product Launch</div>
                     <div class="list-location">10:00 AM</div>
                  </li>
                  <li>
                     <div class="list-title">Team Meeting</div>
                     <div class="list-location">01:30 PM</div>
                  </li>
                  <li>
                     <div class="list-title">Q&A Session</div>
                     <div class="list-location">02:30 PM</div>
                  </li>
               </ul>
            </div>
            <div class="quick-setting-list">
               <h6 class="title">Notes</h6>
               <ul class="list-items">
                  <li>
                     <div class="list-title">Refreshing the list</div>
                     <div class="list-location">03:15 PM</div>
                  </li>
                  <li>
                     <div class="list-title">Not able to click on button</div>
                     <div class="list-location">03:18 PM</div>
                  </li>
               </ul>
            </div>
            <div class="quick-setting-list">
               <h6 class="title">Quick Settings</h6>
               <ul class="set-priority-list">
                  <li>
                     <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" checked id="systemUpdates">
                        <label class="custom-control-label" for="systemUpdates">System Updates</label>
                     </div>
                  </li>
                  <li>
                     <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="noti">
                        <label class="custom-control-label" for="noti">Notifications</label>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>

   <div class="container-fluid">

      <nav class="navbar navbar-expand-lg custom-navbar">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#WafiAdminNavbar" aria-controls="WafiAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
               <i></i><i></i><i></i>
            </span>
         </button>
         <div class="collapse navbar-collapse" id="WafiAdminNavbar">
            <ul class="navbar-nav">
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle <?php echo $page == 'Home' ? 'active-page' : '' ?>" href="#" id="dashboardsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-devices_other nav-icon"></i>
                     Dashboard
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dashboardsDropdown">
                     <li>
                        <a class="dropdown-item <?php echo $page_title == 'Sales Dashboard' ? 'active-page' : '' ?>" href="<?php echo url_for('dashboard/') ?>">Sales Dashboard</a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle <?php echo $page == 'Sales' ? 'active-page' : '' ?>" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-package nav-icon"></i>
                     Sales
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="appsDropdown">
                     <?php if ($access->sales_mgt == 1) : ?>
                        <li>
                           <a class="dropdown-item" <?php echo $page_title == 'All Sales' ? 'active-page' : '' ?> href="<?php echo url_for('sales/') ?>">List Sales</a>
                        </li>
                     <?php endif; ?>
                     <li>
                        <a class="dropdown-item" <?php echo $page_title == 'Add Sales' ? 'active-page' : '' ?> href="<?php echo url_for('sales/add_sales.php') ?>">Add Sales</a>
                     </li>
                  </ul>
               </li>

               <!--
               <?php //if ($access->expenses_mgt == 1) : 
               ?>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle <?php //echo $page == 'Expenses' ? 'active-page' : '' 
                                                         ?>" href="#" id="expensesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-attach_money nav-icon"></i>
                        Expenses
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="expensesDropdown">
                        <li>
                           <a class="dropdown-item <?php //echo $page_title == 'Expenses' ? 'active-page' : '' 
                                                   ?>" href="<?php //echo url_for('expenses/') 
                                                               ?>">Record Expenses</a>
                        </li>
                     </ul>
                  </li>
               <?php //endif; 
               ?>
               -->

               <?php if ($access->report_mgt == 1) : ?>
                  <li class="nav-item dropdown d-none">
                     <a class="nav-link dropdown-toggle <?php echo $page == 'Reports' ? 'active-page' : '' ?>" href="#" id="reportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-pie-chart1 nav-icon"></i>
                        Reports
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="reportDropdown">
                        <li>
                           <a class="dropdown-item <?php echo $page_title == 'Sales Report' ? 'active-page' : '' ?>" href="<?php echo url_for('report/') ?>">Sales Report</a>
                        </li>
                     </ul>
                  </li>
               <?php endif; ?>


               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle <?php echo $page == 'Settings' ? 'active-page' : '' ?>" href="#" id="settingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-settings1 nav-icon"></i>
                     Settings
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                     <?php if ($user->admin_level == 1) : ?>
                        <li>
                           <a class="dropdown-item" <?php echo $page_title == 'Access Control' ? 'active-page' : '' ?> href="<?php echo url_for('settings/access_control.php') ?>">Access Control</a>
                        </li>
                        <li>
                           <a class="dropdown-item" <?php echo $page_title == 'Company Setup' ? 'active-page' : '' ?> href="<?php echo url_for('settings/company_setup.php') ?>">Company Setup</a>
                        </li>
                     <?php endif; ?>
                     <?php if ($access->users_mgt == 1) : ?>
                        <li>
                           <a class="dropdown-item" <?php echo $page_title == 'Manage Users' ? 'active-page' : '' ?> href="<?php echo url_for('settings/manage_user.php') ?>">Manage Users</a>
                        </li>
                     <?php endif; ?>
                     <?php if ($access->product_mgt == 1) : ?>
                        <li>
                           <a class="dropdown-item" <?php echo $page_title == 'Manage Categories' ? 'active-page' : '' ?> href="<?php echo url_for('settings/manage_category.php') ?>">Manage Categories</a>
                        </li>
                        <li>
                           <a class="dropdown-item" <?php echo $page_title == 'Manage Products' ? 'active-page' : '' ?> href="<?php echo url_for('settings/manage_product.php') ?>">Manage Products</a>
                        </li>
                        <li>
                           <a class="dropdown-item" <?php echo $page_title == 'Manage Gauges' ? 'active-page' : '' ?> href="<?php echo url_for('settings/manage_gauge.php') ?>">Manage Gauges</a>
                        </li>
                     <?php endif; ?>
                  </ul>
               </li>







               <li class="nav-item dropdown d-none">
                  <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-book-open nav-icon"></i>
                     Pages
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                     <li>
                        <a class="dropdown-item" href="user-profile.html">User Profile</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="cards.html">Cards</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="pricing.html">Pricing Plans</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="faq.html">Faq</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="search-results.html">Search Results</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="blog.html">Blog</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="account-settings.html">Account Settings</a>
                     </li>
                     <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="customGallery" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Gallery
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="customGallery">
                           <li>
                              <a class="dropdown-item" href="gallery.html">Gallery Slider</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="gallery2.html">Gallery Thumbnail</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="gallery3.html">Gallery Hover</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a class="dropdown-item" href="icons.html">Icons</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="typography.html">Typography</a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item dropdown d-none">
                  <a class="nav-link dropdown-toggle" href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-edit1 nav-icon"></i>
                     Forms
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="formsDropdown">
                     <li>
                        <a class="dropdown-item" href="wizard.html">Wizards</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="bs-select.html">BS Select</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="input-tags.html">Input Tags</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="input-masks.html">Input Mask</a>
                     </li>
                     <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="customDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Custom Forms
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">
                           <li>
                              <a class="dropdown-item" href="contact.html">Contact Form</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="contact2.html">Contact Form #2</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="contact3.html">Contact Form #3</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="contact4.html">Contact Form #4</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a class="dropdown-item" href="form-inputs.html">Form Inputs</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="input-groups.html">Input Groups</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="check-radio.html">Check Boxes</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="range-sliders.html">Range Sliders</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="editor.html">Editor</a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item dropdown d-none">
                  <a class="nav-link dropdown-toggle" href="#" id="uiElementsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-image nav-icon"></i>
                     UI Elements
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="uiElementsDropdown">
                     <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="buttonsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Buttons
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="buttonsDropdown">
                           <li>
                              <a class="dropdown-item" href="buttons.html">Buttons</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="button-groups.html">Button Groups</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="dropdowns.html">Dropdowns</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="navsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Navbars
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navsDropdown">
                           <li>
                              <a class="dropdown-item" href="nav.html">Nav</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="tabs.html">Tabs</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="componentsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Components
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="componentsDropdown">
                           <li>
                              <a class="dropdown-item" href="jumbotron.html">Jumbotron</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="labels-badges.html">Labels &amp; Badges</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="list-items.html">List Items</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="pagination.html">Paginations</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="progress.html">Progress Bars</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="pills.html">Pills</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="spinners.html">Spinners</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="gridDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Grid
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="gridDropdown">
                           <li>
                              <a class="dropdown-item" href="grid.html">Grid</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="grid-doc.html">Grid Doc</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="imagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Images
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="imagesDropdown">
                           <li>
                              <a class="dropdown-item" href="avatars.html">Avatars</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="media-objects.html">Media Objects</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="images.html">Thumbnails</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="text-avatars.html">Text Avatars</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="accordionsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Accordions
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="accordionsDropdown">
                           <li>
                              <a class="dropdown-item" href="accordion.html">Accordion</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="accordion-icons.html">Accordion Icons</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="accordion-arrows.html">Accordion Arrows</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="accordion-lg.html">Accordion Large</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="alertDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Notifications
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="alertDropdown">
                           <li>
                              <a class="dropdown-item" href="bootstrap-alerts.html">Default Alerts</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="custom-alerts.html">Custom Alerts</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="toasts.html">Toasts</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a class="dropdown-item" href="carousel.html">Carousels</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="modals.html">Modals</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="popovers-tooltips.html">Tooltips</a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item dropdown d-none">
                  <a class="nav-link dropdown-toggle" href="#" id="tablesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-border_all nav-icon"></i>
                     Tables
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="tablesDropdown">
                     <li>
                        <a class="dropdown-item" href="custom-tables.html">Custom Tables</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="default-table.html">Default Table</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="table-bordered.html">Table Bordered</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="table-hover.html">Table Hover</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="table-striped.html">Table Striped</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="table-small.html">Table Small</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="table-colors.html">Table Colors</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="data-tables.html">Data Tables</a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item dropdown d-none">
                  <a class="nav-link dropdown-toggle" href="#" id="layoutsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-layers2 nav-icon"></i>
                     Sub menu
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="layoutsDropdown">
                     <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="submenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Opens Right
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="submenuDropdown">
                           <li>
                              <a class="dropdown-item" href="chat.html">Submenu 1</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="icons.html">Submenu 2</a>
                           </li>
                        </ul>
                     </li>
                     <li class="open-left">
                        <a class="dropdown-toggle sub-nav-link" href="#" id="submenuLeftDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Opens Left
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="submenuLeftDropdown">
                           <li>
                              <a class="dropdown-item" href="chat.html">Submenu 1</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="icons.html">Submenu 2</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <li class="nav-item dropdown d-none">
                  <a class="nav-link dropdown-toggle" href="#" id="graphsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-pie-chart1 nav-icon"></i>
                     Graphs
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="graphsDropdown">
                     <li class="open-left">
                        <a class="dropdown-toggle sub-nav-link" href="#" id="apexDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Apex Graphs
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="apexDropdown">
                           <li>
                              <a class="dropdown-item" href="area-graphs.html">Area Charts</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="bubble.html">Bubble Graphs</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="bar-graphs.html">Bar Charts</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="candlestick.html">Candlestick</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="column-graphs.html">Column Charts</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="donut-graphs.html">Donut Charts</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="line-graphs.html">Line Charts</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="mixed-graphs.html">Mixed Charts</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="pie-graphs.html">Pie Charts</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="radial-chart.html">Radial Graph</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a class="dropdown-item" href="morris-graphs.html">Morris Graphs</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="flot-graphs.html">Flot Graphs</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="c3-graphs.html">C3 Graphs</a>
                     </li>
                     <li class="open-left">
                        <a class="dropdown-toggle sub-nav-link" href="#" id="mapsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Vector Maps
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="mapsDropdown">
                           <li>
                              <a class="dropdown-item" href="vector-maps.html">Vector Maps</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="google-maps.html">Google Maps</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <li class="nav-item dropdown d-none">
                  <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-alert-triangle nav-icon"></i>
                     Login
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="loginDropdown">
                     <li>
                        <a class="dropdown-item" href="login.html">Login</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="signup.html">Signup</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="forgot-pwd.html">Forgot Password</a>
                     </li>
                     <li class="open-left">
                        <a class="dropdown-toggle sub-nav-link" href="#" id="subscribeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Subscribe
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="subscribeDropdown">
                           <li>
                              <a class="dropdown-item" href="subscribe.html">Subscribe</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="subscribe2.html">Subscribe 2</a>
                           </li>
                        </ul>
                     </li>
                     <li class="open-left">
                        <a class="dropdown-toggle sub-nav-link" href="#" id="errorDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Error Pages
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="errorDropdown">
                           <li>
                              <a class="dropdown-item" href="error.html">404</a>
                           </li>
                           <li>
                              <a class="dropdown-item" href="error2.html">505</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </li>
            </ul>
         </div>
      </nav>

      <div class="main-container">

         <div class="page-header">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><?php echo $page ?></li>
               <li class="breadcrumb-item active"><?php echo $page_title ?></li>
            </ol>

            <ul class="app-actions">
               <?php if ($access->sales_mgt == 1 && $page_title == 'All Sales') : ?>
                  <div class="d-flex justify-content-center align-items-center">
                     <li class="d-flex justify-content-center align-items-center">
                        <select name="filter_branch" class="form-control form-control-sm mx-2" id="fBranch">
                           <option value="">select branch</option>
                           <?php foreach (Branch::find_by_undeleted(['order' => 'ASC']) as $branch) : ?>
                              <option value="<?php echo $branch->id ?>" <?php echo $branch->id == $user->branch_id ? 'selected' : '' ?>>
                                 <?php echo ucwords($branch->name) ?></option>
                           <?php endforeach; ?>
                        </select>
                     </li>
                     <li>
                        <a href="#" id="reportrange">
                           <span class="range-text"></span>
                           <i class="icon-chevron-down"></i>
                        </a>
                     </li>
                     <li>
                        <button class="btn btn-primary shadow border-light" id="query"><i class="icon-filter_list"></i> Filter</button>
                     </li>
                  </div>
               <?php endif; ?>
               <?php if ($access->sales_mgt == 1 && ($page_title == 'Sales Report' || $page_title == 'Expenses')) : ?>
                  <div class="d-flex justify-content-center align-items-center">
                     <li>
                        <select name="filter_branch" class="form-control form-control-sm" id="fBranch">
                           <option value="">select branch</option>
                           <?php foreach (Branch::find_by_undeleted(['order' => 'ASC']) as $branch) : ?>
                              <option value="<?php echo $branch->id ?>" <?php echo $branch->id == $user->branch_id ? 'selected' : '' ?>>
                                 <?php echo ucwords($branch->name) ?></option>
                           <?php endforeach; ?>
                        </select>
                     </li>
                     <li class="mx-2">
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm" id="filter_date">
                     </li>
                     <li>
                        <button class="btn btn-primary shadow border-light" id="query"><i class="icon-filter_list"></i> Filter</button>
                     </li>
                  </div>
               <?php endif; ?>
               <li>
                  <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print">
                     <i class="icon-print"></i>
                  </a>
               </li>
               <li>
                  <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download CSV">
                     <i class="icon-cloud_download"></i>
                  </a>
               </li>
            </ul>
         </div>