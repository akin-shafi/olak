<?php 
    require_login();
    $product_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->product_mgt ?? 0;
    $user_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->user_mgt ?? 0;
    $warehouse_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->warehouse_mgt ?? 0;
    $purchase_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->purchase_mgt ?? 0;
    $stock_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->stock_mgt ?? 0;
    $shift_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->shift_mgt ?? 0;
    $ledger_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->ledger_mgt ?? 0;
    $report == AccessControl::find_by_user_id($loggedInAdmin->id)->view_report ?? 0;
    $settings = $loggedInAdmin->admin_level;

    $page == "Products" ? ($product_mgt != 1 ? redirect_to(url_for('redirect.php?action=1')) : "") : "";
    $page == "User" ? ($user_mgt != 1 ? redirect_to(url_for('redirect.php?action=1')) : "") : "";
    $page == "Warehouse" ? ($warehouse_mgt != 1 ? redirect_to(url_for('redirect.php?action=1')) : "") : "";
    $page == "Stock" ? ($stock_mgt != 1 ? redirect_to(url_for('redirect.php?action=1')) : "") : "";
    $page == "Shift" ? ($shift_mgt != 1 ? redirect_to(url_for('redirect.php?action=1')) : "") : "";
    $page == "Ledger" ? ($ledger_mgt != 1 ? redirect_to(url_for('redirect.php?action=1')) : "") : "";
    $page == "Access Control" ? ($settings != 1 ? redirect_to(url_for('redirect.php?action=1')) : "") : "";
     
 ?>
<!DOCTYPE html> 
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" href="assets/images/icon.png">
    <!-- <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> -->
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

    <!-- <script type="module">
            import { openDB, deleteDB } from 'https://unpkg.com/idb?module'
    </script> -->


<style>
.vfinder-info a,
.vfinder-info div  {
    color: #dedede;
}
.vfinder-info *,
.vfinder-code *
{
    margin: 0;
    padding: 0;
    border-width: 0;
    background: transparent;
}
.vfinder-info > div {
    padding: 4px 12px;
}
.vfinder-info > div:hover{
    background: rgba(140, 140, 140, 0.36);
}
.vfinder-info {
    position: fixed;
    border-radius: 4px;
    padding: 5px 0;
    background: rgba(64, 64, 64, 0.9);

/*    padding: 10px 18px;*/
    z-index: 9999999;
    border: 1px solid rgb(143, 143, 143);
    font-size: 13px;
}
.vfinder-info:after{
    position: absolute;
    content: " ";
    width: 10px;
    height: 10px;
    -webkit-transform: rotate(45deg);
    background: rgba(64, 64, 64, 0.9);
    left: -5px;
    top: 50%;
    margin-top: -5px;
}
.vfinder-info-name-template{
    color: #ff7474;
}
.vfinder-info-name-style{
    color: #17ceff;
}
.vfinder-info-name-script{
    color: #f281ff;
}
.vfinder-info-name-created{
    color: #40c22a;
}
.vfinder-info-name-template,
.vfinder-info-name-style,
.vfinder-info-name-script,
.vfinder-info-name-created{
    display: inline-block;
    width: 75px;
}
.vfinder-mask {
    position: fixed;
    z-index: 9999998;
    background-color: rgba(1, 165, 255, 0.2);
    pointer-events: none;
}
.vfinder-code{
    position: fixed;
/*    padding: 10px;*/
/*    background: rgba(254, 255, 221, 0.9);*/
    background: rgba(64, 64, 64, 0.9);
    max-width: 400px;
    font-size: 10px;
    z-index: 10000000;
    word-wrap: break-word;
    border-radius: 4px;
/*    color: #747474;*/
    color: #dedede;
    border: 1px solid rgba(222, 222, 222, 0.34);
}
.vfinder-path::-webkit-scrollbar,
.vfinder-code-content::-webkit-scrollbar {
    height: 8px;
    width: 8px;
}
.vfinder-path::-webkit-scrollbar-thumb,
.vfinder-code-content::-webkit-scrollbar-thumb {
  background: rgba(103, 103, 103, 0.9);
  border-radius: 4px;
}
.vfinder-path::-webkit-scrollbar-track,
.vfinder-code-content::-webkit-scrollbar-track {
  background: #ddd;
  border-radius: 4px;
}


.vfinder-code-content{
    padding: 0 10px;
    overflow: auto;
    max-height: 260px;
}
.vfinder-code-content p {
    padding: 2px 6px 2px 0;
}
.vfinder-code-content > pre {
    float: left;
    clear: left;
    white-space: nowrap;
}
.vfinder-current-code-line{
    background: rgba(234, 102, 223, 0.25);
    border-radius: 2px;
}
.vfinder-path{
    padding: 10px;
    border-bottom: 1px solid rgba(222, 222, 222, 0.34);
    background: rgba(140, 140, 140, 0.36);
    white-space:nowrap;
    overflow-x: auto;
}
.vfinder-line-count{
    color: #dedede;
    min-width: 25px;
    display: inline-block;
}


</style>

<style>/*
  IR_Black style (c) Vasily Mikhailitchenko <vaskas@programica.ru>
*/

.hljs {
  display: block;
  overflow-x: auto;
  padding: 0.5em;
  background: #000;
  color: #f8f8f8;
}

.hljs-comment,
.hljs-quote,
.hljs-meta {
  color: #7c7c7c;
}

.hljs-keyword,
.hljs-selector-tag,
.hljs-tag,
.hljs-name {
  color: #96cbfe;
}

.hljs-attribute,
.hljs-selector-id {
  color: #ffffb6;
}

.hljs-string,
.hljs-selector-attr,
.hljs-selector-pseudo,
.hljs-addition {
  color: #a8ff60;
}

.hljs-subst {
  color: #daefa3;
}

.hljs-regexp,
.hljs-link {
  color: #e9c062;
}

.hljs-title,
.hljs-section,
.hljs-type,
.hljs-doctag {
  color: #ffffb6;
}

.hljs-symbol,
.hljs-bullet,
.hljs-variable,
.hljs-template-variable,
.hljs-literal {
  color: #c6c5fe;
}

.hljs-number,
.hljs-deletion {
  color:#ff73fd;
}

.hljs-emphasis {
  font-style: italic;
}

.hljs-strong {
  font-weight: bold;
}
.d-none{display: none !important;}
.status{font-size: 10px; font-weight: bold;}
</style>
</head>

<body class="skin-<?php echo $company->color; ?>  static sidebar-mini"> 
<div class="wrapper rtl rtl-inv">

    <header class="main-header">
        <?php if (in_array($loggedInAdmin->admin_level, [1])) { ?>
            <a href="<?php echo url_for('/dashboard/') ?>" class="logo">
                <span class="logo-mini">POS</span>
                <span class="logo-lg">alpha<b>POS</b></span>
            </a>
        <?php }else{ ?>
            <a href="<?php echo url_for('/dashboard/sales.php') ?>" class="logo">
                <span class="logo-mini">POS</span>
                <span class="logo-lg">alpha<b>POS</b></span>
            </a>
        <?php } ?>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <ul class="nav navbar-nav pull-left">

                <li class="dropdown hidden-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    	<img src="<?php echo url_for('assets/images/english.png') ?>" alt="english">
                    </a>
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
                        	<img src="<?php echo url_for('assets/images/spanish.png') ?>" class="language-img"> &nbsp;&nbsp;Spanish</a>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="<?php //echo url_for('/') ?>stores/deselect_store" data-toggle="tooltip" data-placement="right" title="Unselect Store"><i class="fa fa-square"></i></a>
                </li> -->
              </ul>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="hidden-xs hidden-sm"><a href="#" class="clock"></a></li>
                    <li class="hidden-xs hidden-sm">
                        <?php if (in_array($loggedInAdmin->admin_level, [1,2,3])) { ?> 
                            <a href="<?php echo url_for('/dashboard/') ?>" data-toggle="tooltip" data-placement="bottom" title="Dashboard"><i class="fa fa-dashboard"></i></a>
                        <?php }else{ ?>
                            <a href="<?php echo url_for('/dashboard/sales.php') ?>" data-toggle="tooltip" data-placement="bottom" title="Dashboard"><i class="fa fa-dashboard"></i></a>
                        <?php }?>
                    </li>
                    
                    <li class="hidden-xs"><a href="<?php echo url_for('/settings') ?>" data-toggle="tooltip" data-placement="bottom" title="Settings"><i class="fa fa-cogs"></i></a></li>
                    <li><a href="<?php echo url_for('/pos/view_bill.php')?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Customer Display"><i class="fa fa-desktop"></i></a></li>
                    <li><a href="<?php echo url_for('/pos/')?>" data-toggle="tooltip" data-placement="bottom" title="POS"><i class="fa fa-th"></i></a></li>
                    <li class="dropdown user user-menu" style="padding-right:5px;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo url_for('/uploads/avatars/thumbs/male.png')?>" class="user-image" alt="Avatar">
                            <span class="hidden-xs"><?php echo isset($loggedInAdmin->id) ? Admin::find_by_id($loggedInAdmin->id)->full_name() : redirect_to(url_for('logout.php')); ?></span>
                        </a>
                        <ul class="dropdown-menu" style="padding-right:3px;">
                            <li class="user-header">
                                <img src="<?php echo url_for('/uploads/avatars/thumbs/male.png')?>" class="img-circle" alt="Avatar">
                                <p>
                                    <?php echo Admin::find_by_id($loggedInAdmin->id)->email; ?>
                                    <small>Member since <?php echo date('D d M Y H:i:a', strtotime(Admin::find_by_id($loggedInAdmin->id)->created_at)); ?> </small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo url_for('/users/profile/') ?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo url_for('/logout') ?>" class="btn btn-default btn-flat sign_out">Sign Out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    
    <aside class="main-sidebar">
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 342px;">
            <section class="sidebar" style="height: 342px; overflow: hidden; width: auto;">
            <ul class="sidebar-menu">
                <li class="mm_welcome">
                    <a href="<?php echo url_for('/redirect.php')?>"><i class="fa fa-home"></i> <span>Home</span></a>
                </li>
            <?php if (!in_array($loggedInAdmin->admin_level, [5])) { ?>
                <?php //if ($loggedInAdmin->admin_level == 1) { ?>
                <li class="mm_welcome">
                    <?php if (in_array($loggedInAdmin->admin_level, [1])) { ?> 
                        <a href="<?php echo url_for('/dashboard/')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    <?php }else{ ?>
                        <?php if ($sales_mgt == 1){ ?>
                            <a href="<?php echo url_for('/dashboard/sales.php')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        <?php } ?>
                    <?php }?>
                </li>
                <?php //} ?>
                <?php if ($sales_mgt == 1){ ?>
                    <li class="mm_pos">
                        <a href="<?php echo url_for('/pos/')?>"><i class="fa fa-th"></i> <span>POS</span></a>
                    </li>
                    <li class="hidden-xs hidden-sm">
                        <a href="<?php echo url_for('/return/') ?>" data-toggle="tooltip" data-placement="bottom" title="Dashboard"><i class="fa fa-circle-o"></i> Return</a>
                    </li>
                     <li class="treeview mm_gift_cards">
                        <a href="#">
                            <i class="fa fa-credit-card"></i>
                            <span>Gift Card</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li id="gift_cards_index"><a href="<?php echo url_for('/gift_cards')?>"><i class="fa fa-circle-o"></i> List Gift Cards</a></li>
                            <li id="gift_cards_add"><a href="<?php echo url_for('/gift_cards/add')?>"><i class="fa fa-circle-o"></i> Add Gift Card</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ($product_mgt == 1){ ?>
                <li class="treeview mm_products <?php echo $page == 'Products' ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-barcode"></i>
                        <span>Products</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo $page_title == 'List' ? 'active' : '' ?>">
                            <a target="_top" href="<?php echo url_for('/products')?>"><i class="fa fa-circle-o"></i> List Products</a>
                        </li>
                        <li class="<?php echo $page_title == 'Add' ? 'active' : '' ?>">
                            <a href="<?php echo url_for('/products/add')?>"><i class="fa fa-circle-o"></i> Add Products</a>
                        </li>
                        
                        
                        <li class="divider">
                        </li>
                        
                        
                    </ul>
                </li>
                
               
                <li class="treeview mm_categories <?php echo $page == 'Categories' ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-folder"></i>
                        <span>Categories</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li id="categories_index" class=" <?php echo $page_title == 'Category List' ? 'active' : '' ?>">
                            <a href="<?php echo url_for('/categories/')?>"><i class="fa fa-circle-o"></i> List Categories</a>
                        </li>
                        
                    </ul>
                </li>
                <?php } ?>
                <?php if ($stock_mgt == 1){ ?>
                    <li class="treeview mm_products <?php echo $page == 'Stock' ? 'active' : '' ?>">
                         <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Stock</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo $page_title == 'List' ? 'active' : '' ?>">
                                <a href="<?php echo url_for('/stock/list')?>"><i class="fa fa-circle-o"></i> Stock List</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ($warehouse_mgt == 1){ ?>
                <li class="treeview mm_categories <?php echo $page == 'Warehouse' ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-folder"></i>
                        <span>Warehouse</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li id="categories_index" class=" <?php echo $page_title == 'Add Items' ? 'active' : '' ?>">
                            <a href="<?php echo url_for('/warehouse/pod')?>"><i class="fa fa-circle-o"></i> POD</a>
                        </li>

                        <li id="categories_index" class=" <?php echo $page_title == 'All Items' ? 'active' : '' ?>">
                            <a href="<?php echo url_for('/warehouse/')?>"><i class="fa fa-circle-o"></i> All Items</a>
                        </li>

                        
                        
                    </ul>
                </li>
                 <?php } ?>
                
                
                <?php if ($purchase_mgt == 1){ ?>
                <li class="treeview mm_purchases <?php echo $page == 'Purchases'  ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-plus"></i>
                        <span>Purchases</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (in_array($loggedInAdmin->admin_level, [1])) {?>
                            <li id="purchases_index " class="<?php echo $page_title == 'List' ? 'active' : '' ?>">
                                <a href="<?php echo url_for('/purchases/')?>"><i class="fa fa-circle-o"></i> List Purchases</a></li>
                            <li id="purchases_add " class="<?php echo $page_title == 'Add' ? 'active' : '' ?>">
                                <a href="<?php echo url_for('/purchases/add')?>"><i class="fa fa-circle-o"></i> Add Purchase</a>
                            </li>
                            <li class="divider"></li>
                        <?php } ?>
                        <li id="purchases_expenses " class="<?php echo $page_title == 'List of' ? 'active' : '' ?>">
                            <a href="<?php echo url_for('/expenses/')?>"><i class="fa fa-circle-o"></i> List Expenses</a>
                        </li>
                        <li id="purchases_add_expense " class="<?php echo $page_title == 'Add-' ? 'active' : '' ?>">
                            <a href="<?php echo url_for('/expenses/add')?>"><i class="fa fa-circle-o"></i> Add Expense</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
               
                <?php if ($user_mgt == 1){ ?>
                <li class="treeview mm_auth mm_customers mm_suppliers <?php echo  $page == 'Users' ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>People</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php //if ($loggedInAdmin->admin_level == 1) { ?>
                        <li id="auth_users" class="<?php echo $page_title == 'List' ? 'active' : '' ?>"><a href="<?php echo url_for('/users')?>"><i class="fa fa-circle-o"></i> List Users</a></li>
                        <li id="auth_add" class="<?php echo $page_title == 'Add' ? 'active' : '' ?>"><a href="<?php echo url_for('/users/add')?>"><i class="fa fa-circle-o"></i> Add User</a></li>
                        <?php //} ?>
                        <li class="divider"></li>
                        <li id="customers_index" class="<?php echo $page_title == 'List-' ? 'active' : '' ?>">
                            <a href="<?php echo url_for('/customers')?>"><i class="fa fa-circle-o"></i> List Customers</a></li>
                        <li id="customers_add" class="<?php echo $page_title == 'Add-' ? 'active' : '' ?>">
                            <a href="<?php echo url_for('/customers/add')?>"><i class="fa fa-circle-o"></i> Add Customer</a></li>
                        <li class="divider"></li>
                        <li id="suppliers_index" class="<?php echo $page_title == 'List of' ? 'active' : '' ?>">
                            <a href="<?php echo url_for('/suppliers')?>"><i class="fa fa-circle-o"></i> List Suppliers</a></li>
                        <li id="suppliers_add" class="<?php echo $page_title == 'Add New' ? 'active' : '' ?>">
                            <a href="<?php echo url_for('/suppliers/add')?>"><i class="fa fa-circle-o"></i> Add Supplier</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($shift_mgt  == 1) { ?>
                <li class="treeview mm_settings <?php echo  $page == 'Shift' ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-cogs"></i>
                        <span>Shift</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li id="settings_index"><a href="<?php echo url_for('/shift/status.php')?>"><i class="fa fa-circle-o"></i> Shift Status</a></li>
                        <li class="divider"></li>
                        <li id="settings_backups"><a href="<?php echo url_for('shift/index.php')?>"><i class="fa fa-circle-o"></i> Shift Type</a></li>
                        <li id="settings_backups"><a href="<?php echo url_for('shift/schedule.php')?>"><i class="fa fa-circle-o"></i> Schedule</a></li>
                        
                    </ul>
                </li>
                <?php } ?>
                <?php if ($loggedInAdmin->admin_level == 1) { ?>
                <li class="treeview mm_settings <?php echo  $page == 'Settings' ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-cogs"></i>
                        <span>Settings</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li id="settings_index"><a href="<?php echo url_for('/settings/')?>"><i class="fa fa-circle-o"></i>System Setup</a></li>
                        <li class="divider"></li>
                        <li id="settings_stores" class="<?php echo $page_title == 'Stores' ? 'active' : '' ?>"><a href="<?php echo url_for('/settings/stores')?>"><i class="fa fa-circle-o"></i> Business</a></li>
                        <li id="settings_add_store"><a href="<?php echo url_for('/settings/add_store')?>"><i class="fa fa-circle-o"></i> Add Business</a></li>
                        <li class="divider"></li>
                        <!-- <li id="settings_printers"><a href="<?php //echo url_for('/settings/printers')?>"><i class="fa fa-circle-o"></i> Printers</a></li>
                        <li id="settings_add_printer"><a href="<?php //echo url_for('/settings/add_printer')?>"><i class="fa fa-circle-o"></i> Add Printer</a></li>
                        <li class="divider"></li> -->
                        <li id="accessControl"><a href="<?php echo url_for('/settings/access') ?>"><i class="fa fa-circle-o"></i> Access Control</a></li>
                        <li id="settings_backups"><a href="<?php echo url_for('/backup.php')?>"><i class="fa fa-circle-o"></i> Backups</a></li>
                        
                    </ul>
                </li>
                <?php } ?>
                <?php if ($report == 1)) { ?>
                <li class="treeview mm_reports <?php echo  $page == 'Reports' ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-bar-chart-o"></i>
                        <span>Reports</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="divider"></li>
                        
                        <li id="sales_opened"><a href="<?php echo url_for('/reports/today_sale')?>"><i class="fa fa-circle-o"></i> Today's Sales Report</a></li>
                        <?php if (in_array($loggedInAdmin->admin_level, [1,2,3])) { ?>
                            <li id="sales_index"><a href="<?php echo url_for('/sales/')?>"><i class="fa fa-circle-o"></i>  All Sales Report</a></li>
                        <?php } ?>
                        <li class="divider"></li> 
                        <li id="reports_registers" class="<?php echo $page_title == 'Sales Order' ? 'active' : '' ?>"><a href="<?php echo url_for('/reports/sales_order.php')?>"><i class="fa fa-circle-o"></i> Sales Order Report</a></li>
                        <li id="reports_registers" class="<?php echo $page_title == 'Registers Report' ? 'active' : '' ?>"><a href="<?php echo url_for('/reports/registers')?>"><i class="fa fa-circle-o"></i> Registers Report</a></li>
                        
                        
                        <li id="" class="<?php echo $page_title == 'Send Report' ? 'active' : '' ?>"><a href="<?php echo url_for('/reports/sendmail.php')?>"><i class="fa fa-circle-o"></i> Send Report</a></li>
                        <li id="reports_registers" class="<?php echo $page_title == 'Sales ledger' ? 'active' : '' ?>"><a href="<?php echo url_for('/reports/ledger')?>"><i class="fa fa-circle-o"></i> Sales Ledger</a></li>
                    </ul>
                </li>
                <?php } ?>
            <?php } ?>
            <?php if (in_array($loggedInAdmin->admin_level, [1,5])) { ?>
                <li class="treeview mm_inspection <?php echo $page == 'Sales'  ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-barcode"></i>
                        <span>Inspection</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu ">
                        <li class="<?php echo $page_title == 'Scan' ? 'active' : '' ?>"><a href="<?php echo url_for('/inspection/')?>"><i class="fa fa-circle-o"></i> Scan</a></li>
                        <li id="" class="<?php echo $page_title == 'List' ? 'active' : '' ?>"><a href="<?php echo url_for('/sales/')?>"><i class="fa fa-circle-o"></i> List Sales</a></li>
                        <li class="<?php echo $page_title == 'All Scanned' ? 'active' : '' ?>"><a href="<?php echo url_for('/inspection/all_scanned')?>"><i class="fa fa-circle-o"></i> Verified</a></li>
                    </ul>
                </li>
            <?php } ?>
            <li class="treeview mm_inspection <?php echo $page == 'Profile'  ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Profile</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu ">
                    <li class="<?php echo $page_title == 'Edit' ? 'active' : '' ?>"><a href="<?php echo url_for('/user/profile/')?>"><i class="fa fa-circle-o"></i> Edit</a></li>
                   
                </ul>
            </li>

            </ul>
        </section>
        <div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.2); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 259.92px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
    </aside>
   