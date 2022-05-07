<?php // require_login();

if (empty($loggedInAdmin->email)) {
   redirect_to('../logout.php');
}

$access = AccessControl::find_by_user_id($loggedInAdmin->id);
?>

<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>OLAK | Procurement</title>

   <link rel="shortcut icon" href="<?php echo url_for('ico/favicon.ico'); ?>" />
   <link rel="stylesheet" href="<?php echo url_for('css/backend-plugin.min.css'); ?>">
   <link rel="stylesheet" href="<?php echo url_for('css/backende209.css?v=1.0.0'); ?>">
   <link rel="stylesheet" href="<?php echo url_for('css/all.min.css'); ?>">
   <link rel="stylesheet" href="<?php echo url_for('css/line-awesome.min.css'); ?>">
   <link rel="stylesheet" href="<?php echo url_for('css/remixicon.css'); ?>">

   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>

<body class=" ">
   <!-- <div id="loading">
      <div id="loading-center">
      </div>
   </div> -->

   <div class="wrapper">

      <div class="iq-sidebar  sidebar-default ">
         <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
            <a href="index.html" class="header-logo">
               <img src="<?php echo url_for('png/logo.png') ?>" class="img-fluid rounded-normal light-logo" alt="logo">
               <h5 class="logo-title light-logo ml-3">OLAK</h5>
            </a>
            <div class="iq-menu-bt-sidebar ml-0">
               <i class="fas la-bars wrapper-menu"></i>
            </div>
         </div>

         <div class="data-scrollbar" data-scroll="1">
            <nav class="iq-sidebar-menu">
               <ul id="iq-sidebar-toggle" class="iq-menu">
                  <li class="<?php echo $page == 'Dashboard' ? 'active' : '' ?>">
                     <a href="<?php echo url_for('/dashboard') ?>" class="svg-icon">
                        <svg class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                           <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                           <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="ml-4">Dashboards</span>
                     </a>
                  </li>
                  <li class="<?php echo $page == 'Request' ? 'active' : '' ?>">
                     <a href="#request" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <circle cx="9" cy="21" r="1"></circle>
                           <circle cx="20" cy="21" r="1"></circle>
                           <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <span class="ml-4">Requests</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <polyline points="10 15 15 20 20 15"></polyline>
                           <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                     </a>
                     <ul id="request" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="<?php echo $page_title == 'List Requests' ? 'active' : '' ?>">
                           <a href="<?php echo url_for('requests'); ?>">
                              <i class="fas la-minus"></i><span>List Request</span>
                           </a>
                        </li>
                        <li class="<?php echo $page_title == 'Add Requests' ? 'active' : '' ?>">
                           <a href="<?php echo url_for('requests/add-request.php'); ?>">
                              <i class="fas la-minus"></i><span>Add Request</span>
                           </a>
                        </li>
                     </ul>
                  </li>

                  <li class="<?php echo $page == 'Settings' ? 'active' : '' ?>">
                     <a href="#settings" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash19" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                        </svg>
                        <span class="ml-4">Settings</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <polyline points="10 15 15 20 20 15"></polyline>
                           <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                     </a>
                     <ul id="settings" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <?php if ($access->users_mgt == 1) : ?>
                           <li class="<?php echo $page_title == 'Manage Users' ? 'active' : '' ?>">
                              <a href="<?php echo url_for('settings/manage_user.php'); ?>">
                                 <i class="fas la-minus"></i><span>Manage Users</span>
                              </a>
                           </li>
                        <?php endif; ?>
                        <?php if ($loggedInAdmin->admin_level == 1) : ?>
                           <li class="<?php echo $page_title == 'Access Control' ? 'active' : '' ?>">
                              <a href="<?php echo url_for('settings/access_control.php'); ?>">
                                 <i class="fas la-minus"></i><span>Access Control</span>
                              </a>
                           </li>
                        <?php endif; ?>
                     </ul>
                  </li>

                  <li class="d-none <?php echo $page == 'Invoice' ? 'active' : '' ?>">
                     <a href="<?php echo url_for('requests'); ?>" class="svg-icon">
                        <svg class="svg-icon" id="p-dash07" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                           <polyline points="14 2 14 8 20 8"></polyline>
                           <line x1="16" y1="13" x2="8" y2="13"></line>
                           <line x1="16" y1="17" x2="8" y2="17"></line>
                           <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span class="ml-4">Invoice</span>
                     </a>
                  </li>
               </ul>
            </nav>

            <div class="p-3"></div>
         </div>
      </div>

      <div class="iq-top-navbar">
         <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
               <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                  <i class="ri-menu-line wrapper-menu"></i>
                  <a href="index.html" class="header-logo">
                     <img src="<?php echo url_for('/png/logo.png') ?>" class="img-fluid rounded-normal" alt="logo">
                     <h5 class="logo-title ml-3">OLAK</h5>

                  </a>
               </div>
               <div class="iq-search-bar device-search">
                  <form action="#" class="searchbox">
                     <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                     <input type="text" class="text search-input" placeholder="Search here...">
                  </form>
               </div>
               <div class="d-flex align-items-center">
                  <!--<div class="change-mode">
                          <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                              <div class="custom-switch-inner">
                                  <p class="mb-0"> </p>
                                  <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                                  <label class="custom-control-label" for="dark-mode" data-mode="toggle">
                                      <span class="switch-icon-left"><i class="a-left ri-moon-clear-line"></i></span>
                                      <span class="switch-icon-right"><i class="a-right ri-sun-line"></i></span>
                                  </label>
                              </div>
                          </div>
                      </div>-->
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                     <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto navbar-list align-items-center">
                        <!-- <li>
                           <a href="#" class="btn border add-btn shadow-none mx-2 d-none d-md-block" data-toggle="modal" data-target="#new-order"><i class="fas la-plus mr-2"></i>New Order</a>
                        </li> -->
                        <li class="nav-item nav-icon search-content">
                           <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="ri-search-line"></i>
                           </a>
                           <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                              <form action="#" class="searchbox p-2">
                                 <div class="form-group mb-0 position-relative">
                                    <input type="text" class="text search-input font-size-12" placeholder="type here to search...">
                                    <a href="#" class="search-link"><i class="fas la-search"></i></a>
                                 </div>
                              </form>
                           </div>
                        </li>
                        <!-- <li class="nav-item nav-icon dropdown">
                           <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                 <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                 <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                              </svg>
                              <span class="bg-primary "></span>
                           </a>
                           <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <div class="card shadow-none m-0">
                                 <div class="card-body p-0 ">
                                    <div class="cust-title p-3">
                                       <div class="d-flex align-items-center justify-content-between">
                                          <h5 class="mb-0">Notifications</h5>
                                          <a class="badge badge-primary badge-card" href="#">3</a>
                                       </div>
                                    </div>

                                    <div class="px-3 pt-0 pb-0 sub-card">
                                       <a href="#" class="iq-sub-card">
                                          <div class="media align-items-center cust-card py-3 border-bottom">
                                             <div class="">
                                                <img class="avatar-50 rounded-small" src="<?php echo url_for('jpg/01.jpg') ?>" alt="01">
                                             </div>
                                             <div class="media-body ml-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                   <h6 class="mb-0">Emma Watson</h6>
                                                   <small class="text-dark"><b>12 : 47 pm</b></small>
                                                </div>
                                                <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                             </div>
                                          </div>
                                       </a>
                                       <a href="#" class="iq-sub-card">
                                          <div class="media align-items-center cust-card py-3 border-bottom">
                                             <div class="">
                                                <img class="avatar-50 rounded-small" src="<?php echo url_for('jpg/02.jpg') ?>" alt="02">
                                             </div>
                                             <div class="media-body ml-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                   <h6 class="mb-0">Ashlynn Franci</h6>
                                                   <small class="text-dark"><b>11 : 30 pm</b></small>
                                                </div>
                                                <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                             </div>
                                          </div>
                                       </a>
                                       <a href="#" class="iq-sub-card">
                                          <div class="media align-items-center cust-card py-3">
                                             <div class="">
                                                <img class="avatar-50 rounded-small" src="<?php echo url_for('jpg/03.jpg') ?>" alt="03">
                                             </div>
                                             <div class="media-body ml-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                   <h6 class="mb-0">Kianna Carder</h6>
                                                   <small class="text-dark"><b>11 : 21 pm</b></small>
                                                </div>
                                                <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                             </div>
                                          </div>
                                       </a>
                                    </div>
                                    <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#" role="button">
                                       View All
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </li> -->
                        <li class="nav-item nav-icon dropdown caption-content">
                           <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <img src="<?php echo url_for('settings/uploads/profile/' . $loggedInAdmin->profile_img); ?>" class="img-fluid rounded" alt="user">
                           </a>
                           <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <div class="card shadow-none m-0">
                                 <div class="card-body p-0 text-center">
                                    <div class="media-body profile-detail text-center">
                                       <img src="<?php echo url_for('jpg/profile-bg.jpg') ?>" alt="profile-bg" class="rounded-top img-fluid mb-4">
                                       <img src="<?php echo url_for('settings/uploads/profile/' . $loggedInAdmin->profile_img); ?>" alt="profile-img" class="rounded profile-img img-fluid avatar-70">
                                    </div>
                                    <div class="p-3">
                                       <h5 class="mb-1"><?php echo $loggedInAdmin->email; ?></h5>
                                       <!-- <p class="mb-0">Since 10 march, 2020</p> -->
                                       <div class="d-flex align-items-center justify-content-center mt-3">
                                          <!-- <a href="https://templates.iqonic.design/posdash/html/app/user-profile.html" class="btn border mr-2">Profile</a> -->
                                          <a href="<?php echo url_for('logout.php') ?>" class="btn border">Sign Out</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
         </div>
      </div>

      <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-body">
                  <div class="popup text-left">
                     <h4 class="mb-3">New Order</h4>
                     <div class="content create-workform bg-body">
                        <div class="pb-3">
                           <label class="mb-2">Email</label>
                           <input type="text" class="form-control" placeholder="Enter Name or Email">
                        </div>
                        <div class="col-lg-12 mt-4">
                           <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                              <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                              <div class="btn btn-outline-primary" data-dismiss="modal">Create</div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>