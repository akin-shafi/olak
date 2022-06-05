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

   <title>Aroma Food. - <?php echo $page_title ?></title>

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
         border: 32px solid red;
         border-color: red transparent red transparent;
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

      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
         -webkit-appearance: none;
         margin: 0;
      }

      input[type=number] {
         -moz-appearance: textfield;
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
            Aroma Food.
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
                  <a class="nav-link dropdown-toggle <?php echo $page == 'Home' ? 'active-page' : '' ?>" href="#" id="salesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-devices_other nav-icon"></i>
                     Sales
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="salesDropdown">
                     <li>
                        <a class="dropdown-item <?php echo $page_title == 'List Sales' ? 'active-page' : '' ?>" href="<?php echo url_for('sales/') ?>">List Sales</a>
                     </li>
                     <li>
                        <a class="dropdown-item <?php echo $page_title == 'Add Sales' ? 'active-page' : '' ?>" href="<?php echo url_for('sales/new.php') ?>">Add Sales</a>
                     </li>
                  </ul>
               </li>

               <?php //if ($access->expenses_mgt == 1) : 
               ?>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle <?php echo $page == 'Expenses' ? 'active-page' : '' ?>" href="#" id="expensesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-attach_money nav-icon"></i>
                     Expenses
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="expensesDropdown">
                     <li>
                        <a class="dropdown-item <?php echo $page_title == 'Expenses' ? 'active-page' : '' ?>" href="<?php echo url_for('expenses/') ?>">Manage Expenses</a>
                     </li>
                  </ul>
               </li>
               <?php //endif; 
               ?>

               <?php //if ($access->report_mgt == 1) : 
               ?>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle <?php echo $page == 'Reports' ? 'active-page' : '' ?>" href="#" id="reportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-pie-chart1 nav-icon"></i>
                     Reports
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="reportDropdown">
                     <li>
                        <a class="dropdown-item <?php echo $page_title == 'Sales & Expenses' ? 'active-page' : '' ?>" href="<?php echo url_for('report/') ?>">Report</a>
                     </li>
                  </ul>
               </li>
               <?php //endif; 
               ?>


               <?php //if ($access->product_mgt == 1) : 
               ?>
               <!-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle <?php echo $page == 'Settings' ? 'active-page' : '' ?>" href="#" id="settingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="icon-settings1 nav-icon"></i>
                     Settings
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                     <?php //if ($access->access_control == 1) : 
                     ?>
                     <li>
                        <a class="dropdown-item" <?php echo $page_title == 'Access Control' ? 'active-page' : '' ?> href="<?php echo url_for('settings/access_control.php') ?>">Access Control</a>
                     </li>
                     <?php //endif; 
                     ?>
                     <?php //if ($access->company_setup == 1) : 
                     ?>
                     <li>
                        <a class="dropdown-item" <?php echo $page_title == 'Company Setup' ? 'active-page' : '' ?> href="<?php echo url_for('settings/company_setup.php') ?>">Company Setup</a>
                     </li>
                     <?php //endif; 
                     ?>
                     <?php //if ($access->user_mgt == 1) : 
                     ?>
                     <li>
                        <a class="dropdown-item" <?php echo $page_title == 'Manage Users' ? 'active-page' : '' ?> href="<?php echo url_for('settings/manage_user') ?>">Manage Users</a>
                     </li>
                     <?php //endif; 
                     ?>
                     <?php //if ($access->product_mgt == 1) : 
                     ?>
                     <li>
                        <a class="dropdown-item" <?php echo $page_title == 'Manage Products' ? 'active-page' : '' ?> href="<?php echo url_for('settings/manage_product.php') ?>">Manage Products</a>
                     </li>
                     <?php //endif; 
                     ?>
                  </ul>
               </li> -->
               <?php //endif; 
               ?>

            </ul>
         </div>

         <div class="modal fade" id="salesPhase" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Select Sales Phase</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                  </div>
                  <form id="expense_form">
                     <div class="modal-body">
                        <div class="container">
                           <div class="btn-group" role="group">
                              <a href="<?php echo url_for('/sales/phase_one.php') ?>" class="btn btn-outline-info">
                                 Phase One</a>
                              <a class="btn btn-dark text-white">
                                 &LeftArrowRightArrow;</a=>
                                 <a href="<?php echo url_for('/sales/phase_two.php') ?>" class="btn btn-outline-info">
                                    Phase Two</a>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer text-center">
                        Note: The above button will link you to the type of sales you wish to register.
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </nav>

      <div class="main-container">

         <div class="page-header">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><?php echo $page ?></li>
               <li class="breadcrumb-item active"><?php echo $page_title ?></li>
            </ol>

            <ul class="app-actions">
               <?php ////if ($access->sales_mgt == 1 && $page_title == 'All Sales') : 
               ?>
               <div class="d-flex justify-content-center align-items-center">
                  <li class="d-flex justify-content-center align-items-center">
                     <select name="branch" class="form-control form-control-sm mx-2" id="filter-branch">
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
               <?php //endif; 
               ?>

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