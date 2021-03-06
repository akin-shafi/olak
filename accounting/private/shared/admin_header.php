<?php  require_login(); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <meta name="description" content="Smarthr - Bootstrap Admin Template">
      <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
      <meta name="author" content="Dreamguys - Bootstrap Admin Template">
      <meta name="robots" content="noindex, nofollow">
      <title><?php echo $page .' - '. $page_title ?></title>
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo url_for('assets/img/favicon.png') ?>">
      <link rel="stylesheet" href="<?php echo url_for('assets/css/bootstrap.min.css') ?>">
      <link rel="stylesheet" href="<?php echo url_for('assets/css/font-awesome.min.css') ?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
      
      <link rel="stylesheet" href="<?php echo url_for('assets/css/select2.min.css') ?>">

      <link rel="stylesheet" href="<?php echo url_for('assets/css/bootstrap-datetimepicker.min.css') ?>">

      <link rel="stylesheet" href="<?php echo url_for('assets/css/line-awesome.min.css') ?>">
      <link rel="stylesheet" href="<?php echo url_for('assets/plugins/morris/morris.css') ?>">
      <link rel="stylesheet" href="<?php echo url_for('assets/css/style.css') ?>">
    
   </head>
   <body>
      <div class="main-wrapper">
         <div class="header">
            <div class="header-left">
               <a href="#" class="logo">
               <img src="<?php echo url_for('assets/img/logo-1.png') ?>" width="150" height="auto" alt="">
               </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);">
            <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
            </span>
            </a>
            <div class="page-title-box">
               <h3>Olak Accounting</h3>
            </div>
            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu">
               <li class="nav-item">
                  <div class="top-nav-search">
                     <a href="javascript:void(0);" class="responsive-search">
                     <i class="fa fa-search"></i>
                     </a>
                     <form action="search.html">
                        <input class="form-control" type="text" placeholder="Search here">
                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                     </form>
                  </div>
               </li>
               <li class="nav-item dropdown has-arrow flag-nav">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
                  <img src="<?php echo url_for('assets/img/flags/us.png') ?>" alt="" height="20"> <span>English</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                     <a href="javascript:void(0);" class="dropdown-item">
                     <img src="<?php echo url_for('assets/img/flags/us.png') ?>" alt="" height="16"> English
                     </a>
                     <a href="javascript:void(0);" class="dropdown-item">
                     <img src="<?php echo url_for('assets/img/flags/fr.png') ?>" alt="" height="16"> French
                     </a>
                     <a href="javascript:void(0);" class="dropdown-item">
                     <img src="<?php echo url_for('assets/img/flags/es.png') ?>" alt="" height="16"> Spanish
                     </a>
                     <a href="javascript:void(0);" class="dropdown-item">
                     <img src="<?php echo url_for('assets/img/flags/de.png') ?>" alt="" height="16"> German
                     </a>
                  </div>
               </li>
               <li class="nav-item dropdown">
                  <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                  <i class="fa fa-bell-o"></i> <span class="badge rounded-pill">3</span>
                  </a>
                  <div class="dropdown-menu notifications">
                     <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                     </div>
                     <div class="noti-content">
                        <ul class="notification-list">
                           <li class="notification-message">
                              <a href="activities.html">
                                 <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                    <img alt="" src="<?php echo url_for('assets/img/profiles/avatar-02.jpg') ?>">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                       <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                                       <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="notification-message">
                              <a href="activities.html">
                                 <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                    <img alt="" src="<?php echo url_for('assets/img/profiles/avatar-03.jpg') ?>">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                       <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
                                       <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="notification-message">
                              <a href="activities.html">
                                 <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                    <img alt="" src="<?php echo url_for('assets/img/profiles/avatar-06.jpg') ?>">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                       <p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
                                       <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="notification-message">
                              <a href="activities.html">
                                 <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                    <img alt="" src="<?php echo url_for('assets/img/profiles/avatar-17.jpg') ?>">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                       <p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
                                       <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="notification-message">
                              <a href="activities.html">
                                 <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                    <img alt="" src="<?php echo url_for('assets/img/profiles/avatar-13.jpg') ?>">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                       <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
                                       <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                    </div>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class="topnav-dropdown-footer">
                        <a href="activities.html">View all Notifications</a>
                     </div>
                  </div>
               </li>
               <li class="nav-item dropdown">
                  <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                  <i class="fa fa-comment-o"></i> <span class="badge rounded-pill">8</span>
                  </a>
                  <div class="dropdown-menu notifications">
                     <div class="topnav-dropdown-header">
                        <span class="notification-title">Messages</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                     </div>
                     <div class="noti-content">
                        <ul class="notification-list">
                           <li class="notification-message">
                              <a href="chat.html">
                                 <div class="list-item">
                                    <div class="list-left">
                                       <span class="avatar">
                                       <img alt="" src="<?php echo url_for('assets/img/profiles/avatar-09.jpg') ?>">
                                       </span>
                                    </div>
                                    <div class="list-body">
                                       <span class="message-author">Richard Miles </span>
                                       <span class="message-time">12:28 AM</span>
                                       <div class="clearfix"></div>
                                       <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="notification-message">
                              <a href="chat.html">
                                 <div class="list-item">
                                    <div class="list-left">
                                       <span class="avatar">
                                       <img alt="" src="<?php echo url_for('assets/img/profiles/avatar-02.jpg') ?>">
                                       </span>
                                    </div>
                                    <div class="list-body">
                                       <span class="message-author">John Doe</span>
                                       <span class="message-time">6 Mar</span>
                                       <div class="clearfix"></div>
                                       <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="notification-message">
                              <a href="chat.html">
                                 <div class="list-item">
                                    <div class="list-left">
                                       <span class="avatar">
                                       <img alt="" src="<?php echo url_for('assets/img/profiles/avatar-03.jpg') ?>">
                                       </span>
                                    </div>
                                    <div class="list-body">
                                       <span class="message-author"> Tarah Shropshire </span>
                                       <span class="message-time">5 Mar</span>
                                       <div class="clearfix"></div>
                                       <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="notification-message">
                              <a href="chat.html">
                                 <div class="list-item">
                                    <div class="list-left">
                                       <span class="avatar">
                                       <img alt="" src="<?php echo url_for('assets/img/profiles/avatar-05.jpg') ?>">
                                       </span>
                                    </div>
                                    <div class="list-body">
                                       <span class="message-author">Mike Litorus</span>
                                       <span class="message-time">3 Mar</span>
                                       <div class="clearfix"></div>
                                       <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="notification-message">
                              <a href="chat.html">
                                 <div class="list-item">
                                    <div class="list-left">
                                       <span class="avatar">
                                       <img alt="" src="<?php echo url_for('assets/img/profiles/avatar-08.jpg') ?>">
                                       </span>
                                    </div>
                                    <div class="list-body">
                                       <span class="message-author"> Catherine Manseau </span>
                                       <span class="message-time">27 Feb</span>
                                       <div class="clearfix"></div>
                                       <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class="topnav-dropdown-footer">
                        <a href="chat.html">View all Messages</a>
                     </div>
                  </div>
               </li>
               <li class="nav-item dropdown has-arrow main-drop">
                  <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                  <span class="user-img"><img src="<?php echo url_for('assets/img/profiles/avatar-21.jpg')?>" alt="">
                  <span class="status online"></span></span>
                  <span>Admin</span>
                  </a>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="profile.html">My Profile</a>
                     <a class="dropdown-item" href="settings.html">Settings</a>
                     <a class="dropdown-item" href="<?php echo url_for('logout.php') ?>">Logout</a>
                  </div>
               </li>
            </ul>
            <div class="dropdown mobile-user-menu">
               <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
               <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="profile.html">My Profile</a>
                  <a class="dropdown-item" href="settings.html">Settings</a>
                  <a class="dropdown-item" href="login.html">Logout</a>
               </div>
            </div>
         </div>
         <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
               <div id="sidebar-menu" class="sidebar-menu">
                  <ul>
                     <li class="menu-title">
                        <span>Main</span>
                     </li>
                     <li class="submenu">
                        <a href="#" class="<?php echo $page == 'Dashboard' ? 'active' : '' ?>"><i class="la la-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                           <li><a class="<?php echo $page_title == 'Home' ? 'active' : '' ?>" href="<?php echo url_for('dashboard/') ?>">Admin Dashboard</a></li>

                           
                        </ul>
                     </li>
                      <li class="submenu">
                        <a href="#" class=""><i class="la la-files-o"></i> <span> Sales </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                           <li><a href="<?php echo url_for('sales/estimate.php') ?>">Estimates</a></li>
                           <li><a href="invoices.html">Invoices</a></li>
                           <li><a href="payments.html">Payments</a></li>
                           <li><a href="expenses.html">Expenses</a></li>
                           <li><a href="provident-fund.html">Provident Fund</a></li>
                           <li><a href="taxes.html">Taxes</a></li>
                        </ul>
                     </li>
                     <li class="submenu">
                        <a href="#" class="subdrop"><i class="la la-files-o"></i> <span> Accounting </span> <span class="menu-arrow"></span></a>
                        <ul style="display: block;">
                           <li><a href="categories.html">Categories</a></li>
                           <li><a href="budgets.html">Budgets</a></li>
                            <li><a href="budget-expenses.html">Budget Expenses</a></li>
                           <li><a href="budget-revenues.html">Budget Revenues</a></li>
                        </ul>
                     </li>
                     
                     
                     <li class="submenu">
                        <a href="#" class="noti-dot <?php echo $page == "Reports" ? 'active' : '' ?> "><i class="la la-pie-chart"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                           <li><a href="expense-reports.html"> Expense Report </a></li>
                           <li><a href="invoice-reports.html"> Invoice Report </a></li>
                           <li><a href="payments-reports.html"> Payments Report </a></li>
                           <li><a href="project-reports.html"> Project Report </a></li>
                           <li><a href="task-reports.html"> Task Report </a></li>
                           <li><a href="user-reports.html"> User Report </a></li>
                           <li><a href="employee-reports.html"> Employee Report </a></li>
                           <li><a href="payslip-reports.html"> Payslip Report </a></li>
                           <li><a href="attendance-reports.html"> Attendance Report </a></li>
                           <li><a href="leave-reports.html"> Leave Report </a></li>
                           <li><a href="daily-reports.html"> Daily Report </a></li>
                        </ul>
                     </li>
                     <li class="submenu">
                        <a href="#" class="<?php echo $page == "Payroll" ? 'active' : '' ?> "><i class="la la-money"></i> <span> Payroll</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                           <?php $employee_array = ['Employee Salary'=> 'salary' , 'Payslip' => 'salary-view', 
                              'Payroll Items' => 'payroll-items']; ?>
                           <?php foreach($employee_array as $key => $val){ ?>
                           <li><a class="<?php echo $page_title == $key ? 'active' : '' ?>" 
                              href="<?php echo url_for('payroll/'. $val.'.php') ?>"><?php echo $key; ?></a></li>
                           <?php } ?>
                           
                        </ul>
                     </li>
                     <li>
                        <a href="assets.html"><i class="la la-object-ungroup"></i> <span>Assets</span></a>
                     </li>
                     
                    

                     <li>
                        <a href="users.html"><i class="la la-user-plus"></i> <span>Users</span></a>
                     </li>
                     <li>
                        <a href="settings.html"><i class="la la-cog"></i> <span>Settings</span></a>
                     </li>
                     <li class="menu-title">
                        <span>Pages</span>
                     </li>
                     <li class="submenu">
                        <a href="#"><i class="la la-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                           <li><a href="profile.html"> Employee Profile </a></li>
                           <li><a href="client-profile.html"> Client Profile </a></li>
                        </ul>
                     </li>
                     
                  </ul>
               </div>
            </div>
         </div>


                </div>     
                <!-- end page title --> 
