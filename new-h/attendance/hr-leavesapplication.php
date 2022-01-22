<?php
require_once('../private/initialize.php');

$page = 'Blank';
$page_title = 'Blank';
include(SHARED_PATH . '/header.php');

?>


<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Leave Applications</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list"> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header border-bottom-0">
            <h4 class="card-title">Recent Earned Leave Applications</h4>
            <div class="card-options"> <a href="hr-recentleaves.html" class="btn btn-primary">View All</a> </div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="card border p-0 shadow-none">
                     <div class="card-header border-0">
                        <h3 class="card-title">Earned Leave Request</h3>
                        <div class="ms-auto"> <span class="badge badge-md badge-warning-light">3 days left</span> </div>
                     </div>
                     <div class="d-flex p-4">
                        <div>
                           <div class="avatar avatar-lg brround d-block cover-image" data-image-src="../../assets/images/users/1.jpg" style="background: url(&quot;../../assets/images/users/1.jpg&quot;) center center;"></div>
                        </div>
                        <div class="ps-3">
                           <h5 class="mb-0 mt-2 text-dark fs-18">Faith Harris</h5>
                           <p class="text-muted fs-12 mt-1 mb-0">Designing <span class="my-auto fs-9 font-weight-normal  ms-1 me-1 text-black-20">/</span> Web Designer</p>
                        </div>
                     </div>
                     <div class="card-body pt-2 bg-light">
                        <div class="mt-3 mb-3">
                           <div class="h5 mb-1"> <span class="feather feather-calendar"></span> : 16-01-2021 <span class="badge badge-md badge-primary-light ms-1">1 day</span> </div>
                           <small class="text-muted fs-11">Applied On: 05-01-2021 On<span class="font-weight-semibold"> 5 weeks ago</span></small> 
                        </div>
                        <div class="progress progress-sm mb-2">
                           <div class="progress-bar bg-success w-70"></div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mb-0">
                           <h6 class="fs-12 mb-0">Remaining Leaves</h6>
                           <h6 class="font-weight-bold fs-12 mb-0">15</h6>
                        </div>
                     </div>
                     <div class="p-4">
                        <label class="form-label">Reason:</label> 
                        <p class="text-muted leave-text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
                     </div>
                     <div class="card-footer p-0 border-top-0">
                        <div class="btn-group w-100 leaves-btns"> <a href="#" class="btn btn-lg btn-outline-light w-50 text-success">Accept</a> <a href="#" class="btn btn-lg btn-outline-light w-55 text-danger">Reject</a> </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="card border p-0 shadow-none">
                     <div class="card-header border-0">
                        <h3 class="card-title">Earned Leave Request</h3>
                        <div class="ms-auto"> <span class="badge badge-md badge-warning-light">5 days left</span> </div>
                     </div>
                     <div class="d-flex p-4">
                        <div>
                           <div class="avatar avatar-lg brround d-block cover-image" data-image-src="../../assets/images/users/9.jpg" style="background: url(&quot;../../assets/images/users/9.jpg&quot;) center center;"></div>
                        </div>
                        <div class="ps-3">
                           <h5 class="mb-0 mt-2 text-dark fs-18">Austin Bell</h5>
                           <p class="text-muted fs-12 mt-1 mb-0">Development <span class="my-auto fs-9 font-weight-normal  ms-1 me-1 text-black-20">/</span> Angular Developer</p>
                        </div>
                     </div>
                     <div class="card-body pt-2 bg-light">
                        <div class="mt-3 mb-3">
                           <div class="h5 mb-1"> <span class="feather feather-calendar"></span> : 14-01-2021<span class="text-muted leave-to">To</span>15-01-2021 <span class="badge badge-md badge-primary-light ms-1">2 days</span> </div>
                           <small class="text-muted fs-11">Applied On: 13-01-2021 On<span class="font-weight-semibold"> 3 weeks ago</span></small> 
                        </div>
                        <div class="progress progress-sm mb-2">
                           <div class="progress-bar bg-success w-60"></div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mb-0">
                           <h6 class="fs-12 mb-0">Remaining Leaves</h6>
                           <h6 class="font-weight-bold fs-12 mb-0">18</h6>
                        </div>
                     </div>
                     <div class="p-4">
                        <label class="form-label">Reason:</label> 
                        <p class="text-muted leave-text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
                     </div>
                     <div class="card-footer p-0 border-top-0">
                        <div class="btn-group w-100 leaves-btns"> <a href="#" class="btn btn-lg btn-outline-light w-50 text-success">Accept</a> <a href="#" class="btn  btn-lg btn-outline-light w-55 text-danger">Reject</a> </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="card border p-0 shadow-none">
                     <div class="card-header border-0">
                        <h3 class="card-title">Earned Leave Request</h3>
                        <div class="ms-auto"> <span class="badge badge-md badge-warning-light">5 days left</span> </div>
                     </div>
                     <div class="d-flex p-4">
                        <div>
                           <div class="avatar avatar-lg brround d-block cover-image" data-image-src="../../assets/images/users/2.jpg" style="background: url(&quot;../../assets/images/users/2.jpg&quot;) center center;"></div>
                        </div>
                        <div class="ps-3">
                           <h5 class="mb-0 mt-2 text-dark fs-18">Maria Bower</h5>
                           <p class="text-muted fs-12 mt-1 mb-0">Marketing <span class="my-auto fs-9 font-weight-normal  ms-1 me-1 text-black-20">/</span> Marketing analyst</p>
                        </div>
                     </div>
                     <div class="card-body pt-2 bg-light">
                        <div class="mt-3 mb-3">
                           <div class="h5 mb-1"> <span class="feather feather-calendar"></span> : 21-01-2021<span class="text-muted leave-to">To</span>27-01-2021 <span class="badge badge-md badge-primary-light ms-1">7 days</span> </div>
                           <small class="text-muted fs-11">Applied On: 11-01-2021 On<span class="font-weight-semibold"> 3 weeks ago</span></small> 
                        </div>
                        <div class="progress progress-sm mb-2">
                           <div class="progress-bar bg-success w-80"></div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mb-0">
                           <h6 class="fs-12 mb-0">Remaining Leaves</h6>
                           <h6 class="font-weight-bold fs-12 mb-0">10</h6>
                        </div>
                     </div>
                     <div class="p-4">
                        <label class="form-label">Reason:</label> 
                        <p class="text-muted leave-text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
                     </div>
                     <div class="card-footer p-0 border-top-0">
                        <div class="btn-group w-100 leaves-btns"> <a href="#" class="btn btn-lg btn-outline-light w-50 text-success">Accept</a> <a href="#" class="btn  btn-lg btn-outline-light w-55 text-danger">Reject</a> </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="card border p-0 shadow-none">
                     <div class="card-header border-0">
                        <h3 class="card-title">Earned Leave Request</h3>
                        <div class="ms-auto"> <span class="badge badge-md badge-warning-light">1 day left</span> </div>
                     </div>
                     <div class="d-flex p-4">
                        <div>
                           <div class="avatar avatar-lg brround d-block cover-image" data-image-src="../../assets/images/users/10.jpg" style="background: url(&quot;../../assets/images/users/10.jpg&quot;) center center;"></div>
                        </div>
                        <div class="ps-3">
                           <h5 class="mb-0 mt-2 text-dark fs-18">Peter Hill</h5>
                           <p class="text-muted fs-12 mt-1 mb-0">IT <span class="my-auto fs-9 font-weight-normal  ms-1 me-1 text-black-20">/</span> Testor</p>
                        </div>
                     </div>
                     <div class="card-body pt-2 bg-light">
                        <div class="mt-3 mb-3">
                           <div class="h5 mb-1"> <span class="feather feather-calendar"></span> : 05-01-2021 <span class="badge badge-md badge-primary-light ms-1">1 day</span> </div>
                           <small class="text-muted fs-11">Applied On: 12-12-2020 On<span class="font-weight-semibold"> 3 weeks ago</span></small> 
                        </div>
                        <div class="progress progress-sm mb-2">
                           <div class="progress-bar bg-success w-75"></div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mb-0">
                           <h6 class="fs-12 mb-0">Remaining Leaves</h6>
                           <h6 class="font-weight-bold fs-12 mb-0">12</h6>
                        </div>
                     </div>
                     <div class="p-4">
                        <label class="form-label">Reason:</label> 
                        <p class="text-muted leave-text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
                     </div>
                     <div class="card-footer p-0 border-top-0">
                        <div class="btn-group w-100 leaves-btns"> <a href="#" class="btn btn-lg btn-outline-light w-50 text-success">Accept</a> <a href="#" class="btn  btn-lg btn-outline-light w-55 text-danger">Reject</a> </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<?php include (SHARED_PATH . '/footer.php') ?>