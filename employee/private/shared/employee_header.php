<?php require_login(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Employee Dashboard</title>

   <link rel="stylesheet" href="<?php echo url_for('vendors/simple-line-icons/css/simple-line-icons.css'); ?>">
   <link rel="stylesheet" href="<?php echo url_for('vendors/flag-icon-css/css/flag-icon.min.css'); ?>">
   <link rel="stylesheet" href="<?php echo url_for('vendors/css/vendor.bundle.base.css'); ?>">

   <link rel="stylesheet" href="<?php echo url_for('vendors/daterangepicker/daterangepicker.css'); ?>">

   <link rel="stylesheet" href="<?php echo url_for('css/style.css'); ?>">
   <link rel="stylesheet" href="<?php echo url_for('css/calendar.css'); ?>">
   <link rel="stylesheet" href="<?php echo url_for('css/theme.css'); ?>">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="<?php echo url_for('vendors/select2/select2.min.css'); ?>">
   <link rel="stylesheet" href="<?php echo url_for('vendors/select2-bootstrap-theme/select2-bootstrap.min.css'); ?>">

   <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/style.css"> -->
   <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/theme.css"> -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

   <link rel="shortcut icon" href="<?php echo url_for('images/favicon.png" '); ?>" />
</head>

<body>
   <div class=" container-scroller">
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
         <div class="navbar-brand-wrapper d-flex align-items-center">
            <a class="navbar-brand brand-logo m-auto" href="<?php echo url_for('dashboard'); ?>">
               <img src="<?php echo url_for('/images/logo.png'); ?>" alt="logo" class="logo-dark" />
            </a>
            <a class="navbar-brand brand-logo-mini text-light font-weight-bold text-center" href="<?php echo url_for('dashboard'); ?>" style="font-size: 1rem;">OLAK</a>
         </div>

         <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
            <h3 class="mb-0 d-none d-lg-flex mr-3" style="color:#0A3069;font-weight:700">
               <?php echo ucwords($page); ?></h3>

            <form class="search-form d-none d-md-block" action="#">
               <i class="icon-magnifier"></i>
               <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>

            <ul class="navbar-nav navbar-nav-right ml-auto">
               <li class="nav-item dropdown">
                  <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                     <i class="icon-bell"></i>
                     <span class="count">7</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                     <a class="dropdown-item py-3">
                        <p class="mb-0 font-weight-medium float-left">You have 7 unread message </p>
                        <span class="badge badge-pill badge-primary float-right">View all</span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                           <img src="<?php echo url_for('/images/faces/face10.jpg'); ?>" alt="image" class="img-sm profile-pic">
                        </div>
                        <div class="preview-item-content flex-grow py-2">
                           <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                           <p class="font-weight-light small-text"> The meeting is cancelled </p>
                        </div>
                     </a>
                  </div>
               </li>

               <li class="nav-item d-none d-xl-inline-flex">
                  <a class="nav-link" href="#">
                     <img class="img-xs rounded-circle mr-2" src="<?php echo url_for('assets/uploads/' . $user->photo); ?>" alt="Profile image">
                     <div class="d-flex flex-column justify-content-between align-items-start">
                        <h6 class="font-weight-bold mb-0"> <?php echo ucwords($user->full_name()); ?> </h6>
                        <p class="mb-0">ID: <?php echo strtoupper($user->employee_id); ?></p>
                     </div>
                  </a>
               </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
               <span class="icon-menu"></span>
            </button>
         </div>
      </nav>
      <div class="container-fluid pr-0 pl-0 page-body-wrapper">