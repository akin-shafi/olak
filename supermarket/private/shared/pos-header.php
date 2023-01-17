<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>POS | alphaPOS</title>
    
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="<?php echo url_for('/assets/dist/css/styles.css')?>" rel="stylesheet" type="text/css"> 
    <link href="<?php echo url_for('/assets/dist/css/select2.min.css')?>" rel="stylesheet" type="text/css"> 
    <link href="<?php echo url_for('/assets/dist/daterange/daterange.css')?>" rel="stylesheet" type="text/css"> 

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo url_for('/assets/dist/css/dataTables.bootstrap.min.css')?>">
   <!--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> -->

    
    <!-- <link rel="stylesheet" media="print" href="<?php //echo url_for('/assets/dist/css/printer-58mm.css') ?>"> -->
    <script src="<?php echo url_for('/assets/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
    <!-- <script src="<?php //echo url_for('/assets/dist/js/jquery/jquery-barcode.js'); ?>"></script> -->
     <script src="<?php echo url_for('/assets/dist/js/qrcode.min.js'); ?>"></script>

</head>
<style type="text/css">
    .status{font-size: 16px; font-weight: bold;}
    .form-control-sm {
      height: calc(1.8125rem + 2px);
      padding: 0.25rem 0.5rem;
      font-size: 1.1rem;
      line-height: 1.5;
      border-radius: 0.2rem;
    }
    .table td:first-child { padding: 1px; }
   .table td:nth-child(6), .table td:nth-child(7), .table td:nth-child(8) { text-align: center; }
   .table td:nth-child(9), .table td:nth-child(10) { text-align: right; }
   .action li{list-style: none !important;}
</style>
<body class="skin-<?php echo $company->color; ?> sidebar-collapse sidebar-mini pos">
    <div class="wrapper rtl rtl-inv">

        <header class="main-header">
            <a href="<?php echo url_for('/'); ?>" class="logo">
                <span class="logo-mini">POS</span>
                <span class="logo-lg">alpha<b>POS</b></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <ul class="nav navbar-nav pull-left hidden-xs hidden-sm">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo url_for('assets/images/english.png') ?>" alt="english"></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url_for('/') ?>pos/language/arabic">
                                <img src="<?php echo url_for('assets/images/arabic.png') ?>" class="language-img"> &nbsp;&nbsp;Arabic
                            </a></li>
                            <li><a href="<?php echo url_for('/') ?>pos/language/english">
                                <img src="<?php echo url_for('assets/images/english.png') ?>" class="language-img"> &nbsp;&nbsp;English</a>
                            </li>
                            <li><a href="<?php echo url_for('/') ?>pos/language/french">
                                <img src="<?php echo url_for('assets/images/french.png') ?>" class="language-img"> &nbsp;&nbsp;French</a>
                            </li>
                            <li><a href="<?php echo url_for('/') ?>pos/language/indonesian">
                                <img src="<?php echo url_for('assets/images/indonesian.png') ?>" class="language-img"> &nbsp;&nbsp;Indonesian</a>
                            </li>
                            <li><a href="<?php echo url_for('/') ?>pos/language/portuguese-brazilian">
                                <img src="<?php echo url_for('assets/images/portuguese-brazilian.png') ?>" class="language-img"> &nbsp;&nbsp;Portuguese-brazilian</a></li>
                            <li><a href="<?php echo url_for('/') ?>pos/language/spanish">
                                <img src="<?php echo url_for('assets/images/spanish.png') ?>" class="language-img"> &nbsp;&nbsp;Spanish</a></li>
                        </ul>
                    </li>
                    
                </ul>

                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li><a href="#">
                            <select class=" form-control form-control-sm p-0 m-0" id="select_store">

                             <?php $store_id = $_SESSION['store_id'] ?? 1; foreach (Store::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                                  <option value="<?php echo $value->id; ?>" <?php echo $store_id == $value->id ? 'selected' : '';  ?>><?php echo $value->category; ?></option>
                              <?php } ?>
                            </select>
                            </a>
                        </li>

                        <li class="hidden-xs hidden-sm"><a href="#" class="clock"></a></li>
                        <li><a href="<?php echo url_for('/dashboard/')?>"><i class="fa fa-dashboard"></i></a></li>
                        <li class="hidden-xs hidden-sm"><a href="<?php echo url_for('/settings')?>"><i class="fa fa-cogs"></i></a></li>
                        <li class="hidden-xs hidden-sm"><a href="<?php echo url_for('/pos/view_bill')?>" target="_blank"><i class="fa fa-desktop"></i></a></li>
                        <?php if ($view_report == 1) { ?>
                        <li class="bg-primary">
                            <a  href="<?php echo url_for('/pos/draft.php') ?>"  class="bg-black">
                                 <!-- <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" fill="#ffff" viewBox="0 0 16 16">
                                     <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"></path>
                                   </svg> -->
                                 Draft 
                                 <!-- <sup class="badge badge-pill badge-danger">0</sup> -->
                            </a>
                        </li>
                        <li><a id="register_details" >Register Details</a></li>
                        
                        <li><a href="<?php echo url_for('/report/today_sale') ?>">Today's Sale</a></li>
                        <?php } ?>
                        <li><a  id="close_reg">Close Register</a></li>
                        
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo url_for('/uploads/avatars/thumbs/male.png')?>" class="user-image" alt="Avatar">
                                <span class="hidden-xs"><?php echo Admin::find_by_id($loggedInAdmin->id)->full_name(); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo url_for('/uploads/avatars/male.png')?>" class="img-circle" alt="Avatar">
                                    <p>
                                        <?php echo Admin::find_by_id($loggedInAdmin->id)->full_name(); ?><br> 
                                        <?php echo Admin::find_by_id($loggedInAdmin->id)->email; ?> 
                                        <small>Member since <?php echo date('D d M, Y h:i:a', strtotime(Admin::find_by_id($loggedInAdmin->id)->created_at)) ; ?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo url_for('/users/profile/1')?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo url_for('/logout')?>" class="btn btn-default btn-flat sign_out">Sign Out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" data-toggle="control-sidebar" class="sidebar-icon"><i class="fa fa-folder sidebar-icon"></i></a>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>

            <aside class="main-sidebar ">
                <section class="sidebar" style="height: auto;">
                    <ul class="sidebar-menu">

                        <li class="mm_welcome">
                        <?php if ($loggedInAdmin->admin_level == 1) { ?>
                            <a href="<?php echo url_for('/dashboard/')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        <?php }else{ ?>
                            <a href="<?php echo url_for('/dashboard/sales.php')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        <?php } ?>
                        </li>
                        <li class="mm_pos">
                            <a href="<?php echo url_for('/pos/')?>"><i class="fa fa-th"></i> <span>POS</span></a>
                        </li>

                        <?php if ($view_report == 1) { ?>
                        <li class="treeview mm_sales"> 
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Sales</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            
                            <ul class="treeview-menu">
                                <li class="divider"></li> 
                                <li id="sales_opened"><a href="<?php echo url_for('/reports/today_sale') ?>"><i class="fa fa-circle-o"></i> Today's Sales Report</a></li>
                                <?php if (in_array($loggedInAdmin->id, [1, 2, 3])) { ?>
                                    <li id="sales_index"><a href="<?php echo url_for('/sales/') ?>"><i class="fa fa-circle-o"></i>  All Sales Report</a></li>
                                <?php } ?>
                                <li id="reports_registers" class="<?php echo $page_title == 'Registers Report' ? 'active' : '' ?>"><a href="<?php echo url_for('/reports/registers') ?>"><i class="fa fa-circle-o"></i> Registers Report</a></li>
                                <li class="divider"></li> 
                            </ul>
                            
                        </li>
                        

                       
                        <li class="treeview mm_reports">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Reports</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <!--  <li id="reports_daily_sales"><a href="<?php //echo url_for('/reports/daily_sales')?>"><i class="fa fa-circle-o"></i> Daily Sales</a></li>
                                <li id="reports_monthly_sales"><a href="<?php //echo url_for('/reports/monthly_sales')?>"><i class="fa fa-circle-o"></i> Monthly Sales</a></li>
                                <li id="reports_index"><a href="<?php //echo url_for('/reports')?>"><i class="fa fa-circle-o"></i> Sales Report</a></li>
                                <li class="divider"></li>
                                <li id="reports_payments"><a href="<?php //echo url_for('/reports/payments')?>"><i class="fa fa-circle-o"></i> Payments Report</a></li>
                                <li class="divider"></li>
                                <li id="reports_registers"><a href="<?php //echo url_for('/reports/registers')?>"><i class="fa fa-circle-o"></i> Registers Report</a></li>
                                <li class="divider"></li>
                                <li id="reports_top_products"><a href="<?php //echo url_for('/reports/top_products')?>"><i class="fa fa-circle-o"></i> Top Products</a></li>
                                <li id="reports_products"><a href="<?php //echo url_for('/reports/products')?>"><i class="fa fa-circle-o"></i> Products Report</a></li> -->
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </section>
            </aside>