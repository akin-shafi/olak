<?php  //require_login(); ?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo url_for('uploads/thumbnail/clou_logo_thumb-100x72.png') ?>">

  <title><?php echo $page ." ". $page_title; ?></title>
  
  <!-- Bootstrap 4.0-->
  <?php //echo url_for('assets/css/icons.min.css') ?>
  <link rel="stylesheet" href="<?php echo url_for('assets/admin/css/bootstrap.min.css') ?>" >
  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="<?php echo url_for('assets/admin/css/bootstrap-extend.css') ?>" >
  <link rel="stylesheet" href="<?php echo url_for('assets/admin/css/font-awesome.min.css') ?>" >
  <link href="<?php echo url_for('assets/admin/css/toast.css') ?>" rel="stylesheet" />
  <link href="<?php echo url_for('assets/admin/css/bootstrap-tagsinput.css') ?>" rel="stylesheet" />
  <link href="<?php echo url_for('assets/admin/css/sweet-alert.css') ?>" rel="stylesheet" />
  <link href="<?php echo url_for('assets/admin/css/animate.min.css') ?>" rel="stylesheet" />
  <!-- DataTables -->
  <link href="<?php echo url_for('assets/admin/js/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo url_for('assets/admin/css/admin_style.css') ?>">
  <link rel="stylesheet" href="<?php echo url_for('assets/admin/css/skins/theme_2.css') ?>">   

    
  
  <link href="<?php echo url_for('assets/admin/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet">
  <link href="<?php echo url_for('assets/admin/css/icons.css') ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo url_for('assets/front/css/simple-line-icons.css') ?>">
  <link rel="stylesheet" href="<?php echo url_for('assets/front/font/flaticon.css') ?>">
  <link href="<?php echo url_for('assets/admin/css/bootstrap-switch.min.css') ?>" rel="stylesheet">
  <link href="<?php echo url_for('assets/admin/css/select2.min.css') ?>" rel="stylesheet" />
  <link href="<?php echo url_for('assets/admin/css/themify.min.css') ?>" rel="stylesheet" />
  <link href="<?php echo url_for('assets/admin/css/bootstrap4-toggle.min.css') ?>" rel="stylesheet" />
  <link href="<?php echo url_for('assets/admin/css/summernote.css') ?>" rel="stylesheet" />


  <style type="text/css">
    .radio input[type="radio"],
    .radio-inline input[type="radio"],
    .checkbox input[type="checkbox"],
    .checkbox-inline input[type="checkbox"] {
      margin-right: -20px !important;
    }

      </style>
  
  <!-- Color picker plugins css -->
  <link href="<?php echo url_for('assets/admin/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') ?>" rel="stylesheet">

  <script type="text/javascript">
   var csrf_token = '35d25f187e62cecfe6992206132448c3';
   var token_name = 'csrf_test_name'
 </script>


</head>

<body class="hold-transition skin-blue-light sidebar-mini">

  <!-- Preloader -->
    <!-- <div class="preloader">
      <div class="container text-center"><div class="spinner-llg"></div></div>
    </div> -->
  <!-- Preloader -->

  <!-- Site wrapper -->
  <div class="wrapper">

        <header class="main-header">
              
        <a href="#" class="switch_business logo text-centers">
          <span class="logo-lg">
            <img width="40px" src="<?php echo url_for('uploads/thumbnail/clou_logo_thumb-100x72.png') ?>" alt="Accufy"> 
            <span>Datasoft </span>
          </span> 
          <span class="buss-arrow pull-right"><i class="icon-arrow-right"></i></span>
        </a>

        <div class="business_switch_panel animate-ltr" style="display: none;">
          <div class="buss_switch_panel_header">
            <img width="30px" src="<?php echo url_for('uploads/thumbnail/clou_logo_thumb-100x72.png') ?>" alt="Accufy"> 
            <span class="acc">Your Accufy accounts</span>
            <span class="business_close pull-right">??</span>
          </div>

          <div class="buss_switch_panel_body">
            <ul class="switcher_business_menu pb-20">
                  <li class="business_menu_item ">
                    <a class="business_menu_item_link" href="<?php echo url_for('admin/profile/switch_business/37924') ?>">
                      <span class="business-menu_item_label">
                        Iconic                                              </span>
                    </a>
                  </li>
                  <li class="business_menu_item default">
                    <a class="business_menu_item_link" href="<?php echo url_for('admin/profile/switch_business/42308') ?>">
                      <span class="business-menu_item_label">
                        Datasoft
                        <span class="is_default pull-right">
                            <i class="flaticon-checked text-success"></i></span>
                        </span>
                    </a>
                  </li>
            </ul>

            <div class="seperater"></div>

              <a class="new_business_link" href="<?php echo url_for('admin/business"><i class="icon-briefcase') ?>"></i> <span>Manage business</span></a>

              <a class="new_business_link" href="<?php echo url_for('admin/role_management') ?>"><i class="icon-people"></i> <span>Manage Users</span></a>

              <a class="new_business_link" href="<?php echo url_for('admin/business/invoice_customize') ?>"><i class="fa fa-paint-brush"></i> <span>Invoice Customization</span></a>
            
            <a class="new_business_link" href="<?php echo url_for('admin/profile') ?>"><i class="flaticon-user-1"></i> <span>Manage profile</span></a>

            <a class="new_business_link" href="<?php echo url_for('logout.php') ?>"><i class="icon-logout"></i> <span>Sign out</span></a>
          </div>

          <div class="buss_switch_panel_footer">
            
          </div>
        </div>
      
      <nav class="navbar navbar-static-top hidden-md">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span> 
        </a>
      </nav>

    </header>

<aside class="main-sidebar">
   <section class="sidebar mt-10">
      <ul class="sidebar-menu" data-widget="tree">
         <li class="<?php echo $page_title == 'User Dashboard' ? 'active' : '' ?>">
            <a href="<?php echo url_for('dashboard/business.php') ?>">
            <i class="flaticon-home-1"></i> <span>Dashboard</span>
            </a>
         </li>
         <li class="">
            <a href="<?php echo url_for('profile/') ?>">
            <i class="flaticon-settings-1"></i> <span>Settings</span>
            </a>
         </li>
         <li class="">
            <a href="<?php echo url_for('payment/user') ?>">
            <i class="flaticon-save-money"></i> <span> Payment Settings</span>
            </a>
         </li>
         <li class="treeview ">
            <a href="#"><i class="flaticon-business-cards"></i>
            <span>Sales</span>
            <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
               <li class="">
                  <a href="<?php echo url_for('customer') ?>">
                  <i class="flaticon-network"></i> <span>Customers</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('products/') ?>">
                  <i class="flaticon-box-1"></i> <span>Products & Services</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('estimate') ?>">
                  <i class="flaticon-contract"></i> <span>Estimates</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('invoices/') ?>">
                  <i class="flaticon-approve-invoice"></i> <span>Invoices</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('invoice/create/1') ?>">
                  <i class="flaticon-iterative"></i> <span>Recurring Invoice </span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview ">
            <a href="#"><i class="icon-basket"></i>
            <span>Purchases</span>
            <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
               <li class="">
                  <a href="<?php echo url_for('purchases/bills.php') ?>">
                  <i class="flaticon-credit-card"></i> <span>Bills</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('purchases/vendor.php') ?>">
                  <i class="flaticon-group"></i> <span>Vendors</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('purchases/expenses.php') ?>">
                  <i class="flaticon-bill"></i> <span>Expense</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('purchases/product.php') ?>">
                  <i class="flaticon-box-1"></i> <span>Products & Services</span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="">
            <a href="<?php echo url_for('category') ?>">
            <i class="flaticon-folder-1"></i> <span>Categories</span>
            </a>
         </li>
         <li class="">
            <a href="<?php echo url_for('tax') ?>">
            <i class="flaticon-tax"></i> <span>Tax</span>
            </a>
         </li>
         <li class="treeview <?php echo $page == 'Reports' ? 'active' : '' ?> ">
            <a href="#"><i class="icon-pie-chart"></i>
            <span>Reports</span>
            <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php echo $page_title == 'Profit & Loss' ? 'active' : '' ?>">
                  <a href="<?php echo url_for('reports/profit_loss?end=2021-12-08&start=2021-01-01&report_type=1') ?>">
                  <span>Profit & Loss</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('reports/sales_tax?end=2021-12-08&start=2021-01-01&report_type=1') ?>">
                  <span>Sales Tax Report</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('reports/customers?end=2021-12-08&start=2021-01-01&report_type=1') ?>">
                  <span>Income by Customer</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('reports/vendors?end=2021-12-08&start=2021-01-01&report_type=1') ?>">
                  <span>Purchases by Vendor</span>
                  </a>
               </li>
               <li class="">
                  <a href="<?php echo url_for('reports') ?>">
                  <span> General Reports</span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="">
            <a href="<?php echo url_for('subscription') ?>">
            <i class="flaticon-time-is-money"></i> <span>Subscription</span>
            </a>
         </li>
         <li class="">
            <a href="<?php echo url_for('country') ?>">
            <i class="flaticon-menu-3"></i> <span>Country</span>
            </a>
         </li>
         <li class="">
            <a href="<?php echo url_for('change_password') ?>">
            <i class="flaticon-lock-1"></i> <span>Change Password</span>
            </a>
         </li>
         <li class="">
            <a href="<?php echo url_for('logout.php') ?>">
            <i class="flaticon-exit"></i> <span>logout</span>
            </a>
         </li>
      </ul>
      <a href="<?php echo url_for('subscription') ?>" class="btn btn-info upgrade_btn">
      <i class="fa fa-rocket"></i> <span>Upgrade</span>
      </a>
   </section>
</aside>

