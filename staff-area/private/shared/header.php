<?php
require_login();
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
      <link rel="stylesheet" href="<?php echo url_for('assets/plugins/daterangepicker/daterangepicker.css') ?>">
      <link href="<?php echo url_for('assets/plugins/pg-calendar-master/pignose.calendar.css') ?>" rel="stylesheet">
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
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                     IOGC STAFF MGT
                  </a>
                  <br>
                  <small class="text-white">Staff Portal</small>
               </div>
               <div class="app-sidebar3 ps ps--active-y is-expanded">
                  <div class="app-sidebar__user active">
                     <div class="dropdown user-pro-body text-center">
                        <div class="user-pic">
                           <?php if ($user->photo != '') : ?>
                              <img src="<?php echo url_for('assets/uploads/profiles/' . $user->photo) ?>" alt="user-img" class="avatar-xxl rounded-circle mb-1">
                           <?php else : ?>
                              <img src="<?php echo url_for('assets/images/users/avatar.jpg') ?>" alt="user-img" class="avatar-xxl rounded-circle mb-1">
                           <?php endif; ?>
                        </div>
                        <div class="user-info">
                           <h5 class=" mb-2"><?php echo ucwords($user->full_name()) ?></h5>
                           <div class="text-muted app-sidebar__user-name text-sm">Company: <?php echo ucwords($user->company) ?></div>
                           <div class="text-muted app-sidebar__user-name text-sm">Department: <?php echo ucwords($user->department) ?></div>
                           <span class="text-muted app-sidebar__user-name text-sm">Job Title: <?php echo ucwords($user->job_title) ?></span>
                        </div>
                     </div>
                  </div>
                  <ul class="side-menu open">
                     <li class="side-item side-item-category mt-4">Dashboards</li>

                     <li class="slide is-expanded">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#"> <i class="feather  feather-users sidemenu_icon"></i> <span class="side-menu__label">Employee <span class="nav-list">Dashboard</span></span><i class="angle fa fa-angle-right"></i> </a>
                        <ul class="slide-menu open">
                           <li class="side-menu-label1"><a href="#">Employee Dashboard</a></li>
                           <li><a href="<?php echo url_for('dashboard/') ?>" class="slide-item">Dashboard</a></li>
                           <li><a href="<?php echo url_for('payslip/salary.php') ?>" class="slide-item">Salary</a></li>
                           <li><a href="<?php echo url_for('payslip/') ?>" class="slide-item">Payslip</a></li>
                           <li class="d-none"><a href="<?php echo url_for('attendance/') ?>" class="slide-item">Attendance</a></li>
                           <li><a href="<?php echo url_for('leaves/') ?>" class="slide-item">Leaves </a></li>
                           <li><a href="<?php echo url_for('loans/') ?>" class="slide-item">Loans </a></li>
                           <li class="d-none"><a href="<?php echo url_for('employee-expenses.php') ?>" class="slide-item">Expenses</a></li>
                        </ul>
                     </li>




                  </ul>

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
                           <a class="header-brand" href="index.html"> <img src="<?php echo url_for('assets/images/brand/logo.png') ?>" class="header-brand-img desktop-lgo" alt="Dayonelogo"> <img src="<?php echo url_for('assets/images/brand/logo-white.png') ?>" class="header-brand-img dark-logo" alt="Dayonelogo"> <img src="<?php echo url_for('assets/images/brand/favicon.png') ?>" class="header-brand-img mobile-logo" alt="Dayonelogo"> <img src="<?php echo url_for('assets/images/brand/favicon1.png') ?>" class="header-brand-img darkmobile-logo" alt="Dayonelogo"> </a>
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
                                       <!-- <div class="dropdown header-flags d-none">
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
                                       </div> -->
                                       <div class="dropdown header-fullscreen"> <a class="nav-link icon full-screen-link"> <i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i> <i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i> </a> </div>
                                       <div class="dropdown header-message">
                                          <a class="nav-link icon" data-bs-toggle="dropdown"> <i class="feather feather-mail header-icon"></i> <span class="badge badge-success side-badge">5</span> </a>
                                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow  animated">
                                             <div class="header-dropdown-list message-menu" id="message-menu">
                                                <a class="dropdown-item border-bottom" href="chat.html">
                                                   <div class="d-flex align-items-center">
                                                      <div class=""> <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/1.jpg" style="background: url(<?php echo url_for('assets/images/users/avatar.jpg') ?>) center center;"></span> </div>
                                                      <div class="d-flex">
                                                         <div class="ps-3">
                                                            <h6 class="mb-1">Jack Wright</h6>
                                                            <p class="fs-13 mb-1">All the best your template awesome</p>
                                                            <div class="small text-muted"> 3 hours ago </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </a>
                                                <a class="dropdown-item border-bottom" href="chat.html">
                                                   <div class="d-flex align-items-center">
                                                      <div class=""> <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/2.jpg" style="background: url(<?php echo url_for('assets/images/users/avatar.jpg') ?>) center center;"></span> </div>
                                                      <div class="d-flex">
                                                         <div class="ps-3">
                                                            <h6 class="mb-1">Lisa Rutherford</h6>
                                                            <p class="fs-13 mb-1">Hey! there I'm available</p>
                                                            <div class="small text-muted"> 5 hour ago </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </a>
                                                <a class="dropdown-item border-bottom" href="chat.html">
                                                   <div class="d-flex align-items-center">
                                                      <div class=""> <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/3.jpg" style="background: url(<?php echo url_for('assets/images/users/avatar.jpg') ?>) center center;"></span> </div>
                                                      <div class="d-flex">
                                                         <div class="ps-3">
                                                            <h6 class="mb-1">Blake Walker</h6>
                                                            <p class="fs-13 mb-1">Just created a new blog post</p>
                                                            <div class="small text-muted"> 45 mintues ago </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </a>
                                                <a class="dropdown-item border-bottom" href="chat.html">
                                                   <div class="d-flex align-items-center">
                                                      <div class=""> <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/4.jpg" style="background: url(<?php echo url_for('assets/images/users/avatar.jpg') ?>) center center;"></span> </div>
                                                      <div class="d-flex">
                                                         <div class="ps-3">
                                                            <h6 class="mb-1">Fiona Morrison</h6>
                                                            <p class="fs-13 mb-1">Added new comment on your photo</p>
                                                            <div class="small text-muted"> 2 days ago </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </a>
                                                <a class="dropdown-item border-bottom" href="chat.html">
                                                   <div class="d-flex align-items-center">
                                                      <div class=""> <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/6.jpg" style="background: url(<?php echo url_for('assets/images/users/avatar.jpg') ?>) center center;"></span> </div>
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
                                             <div class=" text-center p-2"> <a href="chat.html" class="">See All Messages</a> </div>
                                          </div>
                                       </div>
                                       <div class="dropdown header-notify"> <a class="nav-link icon" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right"> <i class="feather feather-bell header-icon"></i> <span class="bg-dot"></span> </a> </div>
                                       <div class="dropdown profile-dropdown">
                                          <a href="#" class="nav-link pe-1 ps-0 leading-none" data-bs-toggle="dropdown"> <span> <img src="<?php echo url_for('assets/images/users/avatar.jpg') ?>" alt="img" class="avatar avatar-md bradius"> </span> </a>
                                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
                                             <div class="p-3 text-center border-bottom">
                                                <a href="profile-1.html" class="text-center user pb-0 font-weight-bold">John Thomson</a>
                                                <p class="text-center user-semi-title">App Developer</p>
                                             </div>
                                             <a class="dropdown-item d-flex" href="profile-1.html">
                                                <i class="feather feather-user me-3 fs-16 my-auto"></i>
                                                <div class="mt-1">Profile</div>
                                             </a>
                                             <a class="dropdown-item d-flex" href="editprofile.html">
                                                <i class="feather feather-settings me-3 fs-16 my-auto"></i>
                                                <div class="mt-1">Settings</div>
                                             </a>
                                             <a class="dropdown-item d-flex" href="chat.html">
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