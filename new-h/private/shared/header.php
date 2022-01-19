<?php require_login();
$user = $loggedInAdmin;
?>
<!DOCTYPE php>
<php lang="en" dir="ltr">

   <head>
      <!-- Meta data -->
      <meta charset="UTF-8">
      <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
      <meta content="Sandsify Systems  - HR, Employee and Job Dashboard. This Solution is a multipurpose php solution and also deals with Task, Project, Client and Support System Dashboard." name="description">
      <meta content="HR solutions" name="author">
      <meta name="keywords" content="Hr Dashboard" />
      <!-- Title -->
      <title><?php echo $page_title; ?></title>
      <!--Favicon -->
      <link rel="icon" type="image/x-icon" href="<?php echo url_for('assets/images/brand/favicon.ico') ?>" sizes="16x16" />
      <!-- <link rel="icon" type="image/png" href="/favicon16x16.png" > -->
      <!-- Bootstrap css -->
      <link href="<?php echo url_for('assets/plugins/bootstrap/css/bootstrap.css') ?>" rel="stylesheet" id="style" />
      <!-- Style css -->
      <link href="<?php echo url_for('assets/css/style.css') ?>" rel="stylesheet" />
      <link href="<?php echo url_for('assets/css/boxed.css') ?>" rel="stylesheet" />
      <link href="<?php echo url_for('assets/css/dark.css') ?>" rel="stylesheet" />
      <link href="<?php echo url_for('assets/css/skin-modes.css') ?>" rel="stylesheet" />
      <!-- Animate css -->
      <link href="<?php echo url_for('assets/css/animated.css') ?>" rel="stylesheet" />
      <!-- P-scroll bar css-->
      <link href="<?php echo url_for('assets/plugins/p-scrollbar/p-scrollbar.css') ?>" rel="stylesheet" />
      <!---Icons css-->
      <link href="<?php echo url_for('assets/css/icons.css') ?>" rel="stylesheet" />
      <!---Sidebar css-->
      <link href="<?php echo url_for('assets/plugins/sidebar/sidebar.css') ?>" rel="stylesheet" />
      <!-- Select2 css -->
      <link href="<?php echo url_for('assets/plugins/select2/select2.min.css') ?>" rel="stylesheet" />
      <!--- INTERNAL jvectormap css-->
      <link href="<?php echo url_for('assets/plugins/jvectormap/jqvmap.css') ?>" rel="stylesheet" />
      <!-- INTERNAL Data table css -->
      <link href="<?php echo url_for('assets/plugins/datatable/css/dataTables.bootstrap5.css') ?>" rel="stylesheet" />
      <!-- INTERNAL Time picker css -->
      <link href="<?php echo url_for('assets/plugins/time-picker/jquery.timepicker.css') ?>" rel="stylesheet" />
      <!-- INTERNAL jQuery-countdowntimer css -->
      <link href="<?php echo url_for('assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.css') ?>" rel="stylesheet" />
      <!-- INTERNAL Switcher css -->
      <link href="<?php echo url_for('assets/switcher/css/switcher.css') ?>" rel="stylesheet" />
      <link href="<?php echo url_for('assets/switcher/demo.css') ?>" rel="stylesheet" />
      <script type="text/javascript"></script>

      <script src="<?php echo url_for('assets/plugins/jquery/jquery.min.js') ?>"></script>
   </head>

   <body class="app sidebar-mini">
      <div class="page">
         <div class="page-main is-expanded">
            <!--aside open-->
            <aside class="app-sidebar">
               <div class="app-sidebar__logo">
                  <a class="header-brand text-white" href="index.php">
                     <!-- <img src="assets/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="Dayonelogo"> 
               <img src="assets/images/brand/logo-white.png" class="header-brand-img dark-logo" alt="Dayonelogo"> 
               <img src="assets/images/brand/favicon.png" class="header-brand-img mobile-logo" alt="Dayonelogo"> 
               <img src="assets/images/brand/favicon1.png" class="header-brand-img darkmobile-logo" alt="Dayonelogo">  -->
                     Olak
                  </a>
               </div>
               <div class="app-sidebar3 ps ps--active-y is-expanded">
                  <div class="app-sidebar__user active">
                     <div class="dropdown user-pro-body text-center">
                        <div class="user-pic"> <img src="<?php echo url_for('assets/images/users/avatar.jpg') ?>" alt="user-img" class="avatar-xxl rounded-circle mb-1"> </div>
                        <div class="user-info">
                           <h5 class=" mb-2"><?php echo ucwords($user->full_name()) ?></h5>
                           <span class="text-muted app-sidebar__user-name text-sm">
                              <?php echo $user->admin_level ? $user->admin_level : 'Not Set' ?></span>
                        </div>
                     </div>
                  </div>
                  <ul class="side-menu open">
                     <li class="side-item side-item-category mt-4">Dashboards</li>
                     <li class="slide is-expanded">
                        <a class="side-menu__item  is-expanded" data-bs-toggle="slide" href="#"> <i class="feather feather-home sidemenu_icon"></i> <span class="side-menu__label">HR <span class="nav-list">Dashboard</span></span><i class="angle fa fa-angle-right"></i> </a>
                        <ul class="slide-menu open">
                           <li class="side-menu-label1"><a href="#">HR Dashboard</a></li>
                           <li class="is-expanded"><a href="<?php echo url_for('dashboard/index.php') ?>" class="slide-item ">Dashboard</a></li>
                           <li class="sub-slide">
                              <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Employees</span><i class="sub-angle fa fa-angle-right"></i></a>
                              <ul class="sub-slide-menu">
                                 <li><a class="sub-slide-item" href="<?php echo url_for('employees/hr-emplist.php') ?>">Employees List</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('employees/hr-empview.php') ?>">View Employee</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('employees/hr-addemployee.php') ?>">Add Employee</a></li>
                              </ul>
                           </li>
                           <li class="sub-slide">
                              <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Attendance</span><i class="sub-angle fa fa-angle-right"></i></a>
                              <ul class="sub-slide-menu">
                                 <li><a class="sub-slide-item" href="<?php echo url_for('attendance/hr-attlist.php') ?>">Attendance List</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('attendance/hr-attuser.php') ?>">Attendance By User</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('attendance/hr-attview.php') ?>">Attendance View</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('attendance/hr-overviewcldr.php') ?>">Overview Calender</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('attendance/hr-attmark.php') ?>">Attendance Mark </a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('leave/hr-leaves.php') ?>">Leave Settings</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('leave/hr-leavesapplication.php') ?>">Leave Applications</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('leave/hr-recentleaves.php') ?>">Recent Leaves </a></li>
                              </ul>
                           </li>

                           <li class="sub-slide">
                              <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Payroll</span><i class="sub-angle fa fa-angle-right"></i></a>
                              <ul class="sub-slide-menu">
                                 <li><a class="sub-slide-item" href="<?php echo url_for('payroll/hr-empsalary.php') ?>">Employee Salary</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('payroll/hr-addpayroll.php') ?>">Add Payroll</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('payroll/hr-editpayroll.php') ?>">Edit Payroll</a></li>
                              </ul>
                           </li>
                           <li><a href="<?php echo url_for('others/hr-notice.php') ?>" class="slide-item">Notice Board</a></li>
                           <li><a href="<?php echo url_for('others/hr-award.php') ?>" class="slide-item">Awards</a></li>
                           <li><a href="<?php echo url_for('others/hr-holiday.php') ?>" class="slide-item">Holidays</a></li>

                           <li><a href="<?php echo url_for('others/hr-expenses.php') ?>" class="slide-item">Expenses</a></li>
                           <li><a href="<?php echo url_for('events/') ?>" class="slide-item">Events</a></li>
                           <li class="sub-slide">
                              <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Settings</span><i class="sub-angle fa fa-angle-right"></i></a>
                              <ul class="sub-slide-menu">
                                 <li><a class="sub-slide-item" href="<?php echo url_for('settings/') ?>">Company</a></li>
                                 <li><a class="sub-slide-item" href="<?php echo url_for('employees/hr-department.php') ?>">Department</a></li>

                              </ul>
                           </li>
                        </ul>
                     </li>

                     <li class="slide d-none">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#"> <i class="feather feather-slack sidemenu_icon"></i> <span class="side-menu__label">Super Admin</span><i class="angle fa fa-angle-right"></i> </a>
                        <ul class="slide-menu">
                           <li class="side-menu-label1"><a href="#">Super Admin</a></li>
                           <li><a href="index7.php" class="slide-item">Dashboard</a></li>
                           <li><a href="superadmin-company.php" class="slide-item">Companies</a></li>
                           <li><a href="superadmin-subscription.php" class="slide-item">Subscription Plans</a></li>
                           <li><a href="superadmin-invoices.php" class="slide-item">Invoices</a></li>
                           <li><a href="superadmin-admins.php" class="slide-item">Super Admins</a></li>
                           <li><a href="superadmin-settings.php" class="slide-item">Settings</a></li>
                           <li><a href="superadmin-role.php" class="slide-item">Role Access</a></li>
                        </ul>
                     </li>


                  </ul>
                  <div class="Annoucement_card">
                     <div class="text-center">
                        <div>
                           <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12">Announcement</h5>
                           <div class="bg-layer py-4"> <img src="<?php echo url_for('assets/images/photos/announcement-1.png') ?>" class="py-3 text-center mx-auto" alt="img"> </div>
                           <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2">Make an Announcement to Our Employee</p>
                        </div>
                     </div>
                     <button class="btn btn-block btn-primary my-4 fs-12">Create Announcement</button> <button class="btn btn-block btn-outline fs-12">See history</button>
                  </div>
                  <div class="ps__rail-x" style="left: 0px; bottom: -74px;">
                     <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                  </div>
                  <div class="ps__rail-y" style="top: 74px; height: 483px; right: 0px;">
                     <div class="ps__thumb-y" tabindex="0" style="top: 13px; height: 88px;"></div>
                  </div>
               </div>
            </aside>
            <!--aside closed-->

            <div class="app-content main-content">
               <div class="side-app">
                  <!--app header-->
                  <div class="app-header header">
                     <div class="container-fluid">
                        <div class="d-flex">
                           <a class="header-brand" href="#"> <img src="<?php echo url_for('assets/images/brand/logo.png') ?>" class="header-brand-img desktop-lgo" alt="Dayonelogo"> <img src="<?php echo url_for('assets/images/brand/logo-white.png') ?>" class="header-brand-img dark-logo" alt="Dayonelogo"> <img src="<?php echo url_for('assets/images/brand/favicon.png') ?>" class="header-brand-img mobile-logo" alt="Dayonelogo"> <img src="<?php echo url_for('assets/images/brand/favicon1.png') ?>" class="header-brand-img darkmobile-logo" alt="Dayonelogo"> </a>
                           <div class="app-sidebar__toggle" data-bs-toggle="sidebar"> <a class="open-toggle" href="#"> <i class="feather feather-menu"></i> </a> <a class="close-toggle" href="#"> <i class="feather feather-x"></i> </a> </div>
                           <div class="mt-0">
                              <form class="form-inline">
                                 <div class="search-element"> <input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1"> <button class="btn btn-primary-color"> <i class="feather feather-search"></i> </button> </div>
                              </form>
                           </div>
                           <!-- SEARCH -->
                           <div class="d-flex order-lg-2 my-auto ms-auto">
                              <button class="navbar-toggler nav-link icon navresponsive-toggler vertical-icon ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation"> <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i> </button>
                              <div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
                                 <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    <div class="d-flex ms-auto">
                                       <a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch" href="#" data-bs-toggle="search"> <i class="feather feather-search search-icon header-icon"></i> </a>
                                       <div class="dropdown header-flags d-none">
                                          <a class="nav-link icon" data-bs-toggle="dropdown"> <img src="<?php echo url_for('assets/images/flags/flag-png/united-kingdom.png') ?>" class="h-24" alt="img"> </a>
                                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
                                             <a href="#" class="dropdown-item d-flex ">
                                                <span class="avatar  me-3 align-self-center bg-transparent"><img src="<?php echo url_for('assets/images/flags/flag-png/india.png') ?>" alt="img" class="h-24"></span>
                                                <div class="d-flex"> <span class="my-auto">India</span> </div>
                                             </a>
                                             <a href="#" class="dropdown-item d-flex">
                                                <span class="avatar  me-3 align-self-center bg-transparent"><img src="<?php echo url_for('assets/images/flags/flag-png/united-kingdom.png') ?>" alt="img" class="h-24"></span>
                                                <div class="d-flex"> <span class="my-auto">UK</span> </div>
                                             </a>
                                             <a href="#" class="dropdown-item d-flex">
                                                <span class="avatar me-3 align-self-center bg-transparent"><img src="<?php echo url_for('assets/images/flags/flag-png/italy.png') ?>" alt="img" class="h-24"></span>
                                                <div class="d-flex"> <span class="my-auto">Italy</span> </div>
                                             </a>
                                             <a href="#" class="dropdown-item d-flex">
                                                <span class="avatar me-3 align-self-center bg-transparent"><img src="<?php echo url_for('assets/images/flags/flag-png/united-states-of-america.png') ?>" class="h-24" alt="img"></span>
                                                <div class="d-flex"> <span class="my-auto">US</span> </div>
                                             </a>
                                             <a href="#" class="dropdown-item d-flex">
                                                <span class="avatar  me-3 align-self-center bg-transparent"><img src="<?php echo url_for('assets/images/flags/flag-png/spain.png') ?>" alt="img" class="h-24"></span>
                                                <div class="d-flex"> <span class="my-auto">Spain</span> </div>
                                             </a>
                                          </div>
                                       </div>
                                       <div class="dropdown header-fullscreen"> <a class="nav-link icon full-screen-link"> <i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i> <i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i> </a> </div>
                                       <div class="dropdown header-message">
                                          <a class="nav-link icon" data-bs-toggle="dropdown"> <i class="feather feather-mail header-icon"></i> <span class="badge badge-success side-badge">5</span> </a>
                                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow  animated">
                                             <div class="header-dropdown-list message-menu" id="message-menu">
                                                <a class="dropdown-item border-bottom" href="#">
                                                   <div class="d-flex align-items-center">
                                                      <div class=""> <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/1.jpg" style="background: url(&quot;assets/images/users/1.jpg&quot;) center center;"></span> </div>
                                                      <div class="d-flex">
                                                         <div class="ps-3">
                                                            <h6 class="mb-1">Jack Wright</h6>
                                                            <p class="fs-13 mb-1">All the best your template awesome</p>
                                                            <div class="small text-muted"> 3 hours ago </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </a>
                                                <a class="dropdown-item border-bottom" href="#">
                                                   <div class="d-flex align-items-center">
                                                      <div class=""> <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/2.jpg" style="background: url(&quot;assets/images/users/2.jpg&quot;) center center;"></span> </div>
                                                      <div class="d-flex">
                                                         <div class="ps-3">
                                                            <h6 class="mb-1">Lisa Rutherford</h6>
                                                            <p class="fs-13 mb-1">Hey! there I'm available</p>
                                                            <div class="small text-muted"> 5 hour ago </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </a>
                                                <a class="dropdown-item border-bottom" href="#">
                                                   <div class="d-flex align-items-center">
                                                      <div class=""> <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/3.jpg" style="background: url(&quot;assets/images/users/3.jpg&quot;) center center;"></span> </div>
                                                      <div class="d-flex">
                                                         <div class="ps-3">
                                                            <h6 class="mb-1">Blake Walker</h6>
                                                            <p class="fs-13 mb-1">Just created a new blog post</p>
                                                            <div class="small text-muted"> 45 mintues ago </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </a>
                                                <a class="dropdown-item border-bottom" href="#">
                                                   <div class="d-flex align-items-center">
                                                      <div class=""> <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/4.jpg" style="background: url(&quot;assets/images/users/4.jpg&quot;) center center;"></span> </div>
                                                      <div class="d-flex">
                                                         <div class="ps-3">
                                                            <h6 class="mb-1">Fiona Morrison</h6>
                                                            <p class="fs-13 mb-1">Added new comment on your photo</p>
                                                            <div class="small text-muted"> 2 days ago </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </a>
                                                <a class="dropdown-item border-bottom" href="#">
                                                   <div class="d-flex align-items-center">
                                                      <div class=""> <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/6.jpg" style="background: url(&quot;assets/images/users/6.jpg&quot;) center center;"></span> </div>
                                                      <div class="d-flex">
                                                         <div class="ps-3">
                                                            <h6 class="mb-1">Stewart Bond</h6>
                                                            <p class="fs-13 mb-1">Your payment invoice is generated</p>
                                                            <div class="small text-muted"> 3 days ago </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </a>
                                             </div>
                                             <div class=" text-center p-2"> <a href="#" class="">See All Messages</a> </div>
                                          </div>
                                       </div>
                                       <div class="dropdown header-notify"> <a class="nav-link icon" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right"> <i class="feather feather-bell header-icon"></i> <span class="bg-dot"></span> </a> </div>
                                       <div class="dropdown profile-dropdown">
                                          <a href="#" class="nav-link pe-1 ps-0 leading-none" data-bs-toggle="dropdown"> <span> <img src="<?php echo url_for('assets/images/users/avatar.jpg') ?>" alt="img" class="avatar avatar-md bradius"> </span> </a>
                                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
                                             <div class="p-3 text-center border-bottom">
                                                <a href="#" class="text-center user pb-0 font-weight-bold">
                                                   <?php echo ucwords($user->full_name()) ?></a>
                                                <p class="text-center user-semi-title"><?php echo $user->admin_level ? $user->admin_level : 'Not Set' ?></p>
                                             </div>
                                             <a class="dropdown-item d-flex" href="#">
                                                <i class="feather feather-user me-3 fs-16 my-auto"></i>
                                                <div class="mt-1">Profile</div>
                                             </a>
                                             <a class="dropdown-item d-flex" href="#">
                                                <i class="feather feather-settings me-3 fs-16 my-auto"></i>
                                                <div class="mt-1">Settings</div>
                                             </a>
                                             <a class="dropdown-item d-flex" href="#">
                                                <i class="feather feather-mail me-3 fs-16 my-auto"></i>
                                                <div class="mt-1">Messages</div>
                                             </a>
                                             <a class="dropdown-item d-flex" href="#" data-bs-toggle="modal" data-bs-target="#changepasswordnmodal">
                                                <i class="feather feather-edit-2 me-3 fs-16 my-auto"></i>
                                                <div class="mt-1">Change Password</div>
                                             </a>
                                             <a class="dropdown-item d-flex" href="<?php echo url_for('logout.php') ?>">
                                                <i class="feather feather-power me-3 fs-16 my-auto"></i>
                                                <div class="mt-1">Sign Out</div>
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex header-setting-icon"> <a class="nav-link icon demo-icon" href="#"> <i class="feather feather-settings  fe-spin"></i> </a> </div>
                           </div>
                        </div>
                     </div>
                  </div>