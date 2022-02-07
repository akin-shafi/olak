<?php
require_once('../private/initialize.php');

$page = 'Leaves';
$page_title = 'Leaves';
include(SHARED_PATH . '/header.php');

?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Apply Leaves</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
         <div class="btn-list"> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xl-4 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Apply Leaves</h4>
         </div>
         <div class="card-body">
            <div class="leave-types">
               <div class="form-group">
                  <label class="form-label">Leaves Dates</label> 
                  <select name="projects" class="form-control custom-select select2 select2-hidden-accessible" id="daterange-categories" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-daterange-categories">
                     <option value="single" data-select2-id="select2-data-8-rwg4">Single Leaves</option>
                     <option value="multiple">Multiple Leaves</option>
                  </select>
                 
               </div>
               <div class="leave-content active" id="single">
                  <div class="form-group">
                     <label class="form-label">Date Range:</label> 
                     <div class="input-group">
                        <input type="text" name="singledaterange" class="form-control" placeholder="select dates"> 
                        <div class="input-group-append">
                           <div class="input-group-text"> <i class="bx bx-calendar"></i> </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="leave-content" id="multiple">
                  <div class="form-group">
                     <label class="form-label">Date Range:</label> 
                     <div class="input-group">
                        <input type="text" name="daterange" class="form-control" placeholder="select dates"> 
                        <div class="input-group-append">
                           <div class="input-group-text"> <i class="bx bx-calendar"></i> </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="form-label">Leaves Types</label> 
                  <select name="projects" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-18-b7je">
                     <option label="Select" data-select2-id="select2-data-20-7870"></option>
                     <option value="1">Half Day Leave</option>
                     <option value="2">Casual Leaves</option>
                     <option value="3">Sick Leaves</option>
                     <option value="4">Maternity Leaves</option>
                     <option value="5">Paternity Leaves</option>
                     <option value="6">Annual Leaves</option>
                     <option value="6">Unpaid Leaves</option>
                     <option value="8">Other Leaves</option>
                  </select>
                  
               </div>
               <div class="form-group"> <label class="form-label">Reason:</label> <textarea class="form-control" rows="2">Some text here...</textarea> </div>
            </div>
         </div>
         <div class="card-footer">
            <div class="d-flex">
               <div> <label class="mb-0 font-weight-semibold text-dark">Selected Days:</label> <span class="badge badge-danger badge-pill ms-2">2</span> </div>
               <div class="ms-auto"> <a href="#" class="btn btn-outline-primary">Close</a> <a href="#" class="btn btn-primary">Submit</a> </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-4 col-lg-12 col-md-12">
      <div class="card">
         <div class="p-0">
            <div class="card-header border-0">
               <h4 class="card-title">Calendar</h4>
            </div>
            <div class="leave-calendar mt-3">
               
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-4 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Leaves Overview</h4>
         </div>
         <div class="card-body">
            <div id="leavesoverview" class="mx-auto pt-2" style="min-height: 319.317px;">
               
            </div>
            <div class="row pt-4 mx-auto text-center">
               <div class="col-lg-9 col-md-12 mx-auto d-block">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label bg-primary me-2 my-auto"></span>Casual Leaves </div>
                     </div>
                     <div class="col-md-6 mt-3 mt-md-0">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label badge-danger me-2 my-auto"></span>Sick Leaves </div>
                     </div>
                     <div class="col-md-6 mt-3">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label bg-secondary me-2 my-auto"></span>Gifted Leaves </div>
                     </div>
                     <div class="col-md-6 mt-3">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label bg-success me-2 my-auto"></span>Remaining Leaves </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="resize-triggers">
               <div class="expand-trigger">
                  <div style="width: 470px; height: 468px;"></div>
               </div>
               <div class="contract-trigger"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include (SHARED_PATH . '/footer.php') ?>

<script src="<?php echo url_for('assets/js/employee/emp-leaves.js') ?>"></script>
<script src="<?php echo url_for('assets/plugins/pg-calendar-master/pignose.calendar.full.min.js') ?>"></script>