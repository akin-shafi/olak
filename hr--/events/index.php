<?php
require_once('../private/initialize.php');

$page = 'Events';
$page_title = 'Events';
include(SHARED_PATH . '/header.php');
// $datatable = '';
?>
<link href="<?php echo url_for('assets/plugins/fullcalendar/fullcalendar.css') ?>" rel="stylesheet">
<link href="<?php echo url_for('assets/plugins/modal-datepicker/datepicker.css') ?>" rel="stylesheet">
<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Events</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list"> <a href="#" data-bs-toggle="modal" data-bs-target="#eventmodal" class="btn btn-primary me-3">Add New Events</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>


<div class="row">
   <div class="col-md-12 col-xl-4">
      <div class="card">
         <div class="card-header border-bottom-0">
            <h4 class="card-title">Upcoming Events</h4>
         </div>
         <div class="card-body mt-2">
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-success-transparent bradius me-3"><span class="date fs-20">22</span> <span class="month fs-13">FEB</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Anniversary</h6>
                     <span class="clearfix"></span> <small>Office 3rd Anniversary on 22nd Feb</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-purple-transparent bradius me-3"><span class="date fs-20">10</span> <span class="month fs-13">FEB</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Vanessa James</h6>
                     <span class="clearfix"></span> <small>Birthday on Feb 16</small> 
                  </div>
                  <p class="float-end mb-0  ms-auto  my-auto"> <a class="btn btn-outline-orange mt-1" href="#"><i class="fa fa-birthday-cake me-2"></i>Wish Now</a> </p>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-orange-transparent bradius me-3"><span class="date fs-20">18</span> <span class="month fs-13">FEB</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Trade Shows</h6>
                     <span class="clearfix"></span> <small>Smart Device Trade Show</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-warning-transparent bradius me-3"><span class="date fs-20">06</span> <span class="month fs-13">Mar</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Holiday Party</h6>
                     <span class="clearfix"></span> <small>SCreate a Cost-Effective Holiday Party Menu</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-pink-transparent bradius me-3"><span class="date fs-20">13</span> <span class="month fs-13">MAR</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Team-Building </h6>
                     <span class="clearfix"></span> <small>Team Communication &amp; Creative Innovation team members</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-success-transparent bradius me-3"><span class="date fs-20">24</span> <span class="month fs-13">MAR</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Anniversary</h6>
                     <span class="clearfix"></span> <small>Faith Harris 3rd work Anniversary</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-purple-transparent bradius me-3"><span class="date fs-20">10</span> <span class="month fs-13">APR</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Austin Bell</h6>
                     <span class="clearfix"></span> <small>Birthday on Apr 16</small> 
                  </div>
                  <p class="float-end mb-0  ms-auto  my-auto"> <a class="btn btn-outline-orange mt-1" href="#"><i class="fa fa-birthday-cake me-2"></i>Wish Now</a> </p>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-info-transparent bradius me-3"><span class="date fs-20">25</span> <span class="month fs-13">APR</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Board Meeting</h6>
                     <span class="clearfix"></span> <small>It will be held in meeting room</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-purple-transparent bradius me-3"><span class="date fs-20">01</span> <span class="month fs-13">MAY</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Maria Bower</h6>
                     <span class="clearfix"></span> <small>Birthday on May 01</small> 
                  </div>
                  <p class="float-end mb-0  ms-auto  my-auto"> <a class="btn btn-outline-orange mt-1" href="#"><i class="fa fa-birthday-cake me-2"></i>Wish Now</a> </p>
               </div>
            </div>
            <div class="mb-0">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-success-transparent bradius me-3"><span class="date fs-20">21</span> <span class="month fs-13">MAY</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Max Wilson Anniversary</h6>
                     <span class="clearfix"></span> <small>Max Wilson 1st work Anniversary</small> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12 col-xl-8">
      <div class="card">
         <div class="card-body">
            <div class="hrevent-calender">
               <div id="calendar1" class="fc fc-media-screen fc-direction-ltr fc-theme-standard"></div>
            </div>
         </div>
      </div>
   </div>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>

<script src="<?php echo url_for('assets/plugins/modal-datepicker/datepicker.js') ?>"></script>
<script src="<?php echo url_for('assets/plugins/fullcalendar/fullcalendar.min.js') ?>"></script>
<script src="<?php echo url_for('assets/js/hr/hr-events.js') ?>"></script>