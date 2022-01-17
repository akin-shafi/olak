<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Add Employee';
include(SHARED_PATH . '/header.php');

?>
<link rel="stylesheet" href="assets/plugins/rating/css/ratings.css">
<link rel="stylesheet" href="assets/plugins/rating/css/rating-themes.css">
<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Add Employee</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
         <div class="btn-list"> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>


<div class="row">
   <div class="col-xl-3 col-md-12 col-lg-12">
      <div class="card box-widget widget-user">
         <div class="card-body text-center">
            <div class="widget-user-image mx-auto text-center"> <img class="avatar avatar-xxl brround rounded-circle" alt="img" src="../assets/images/users/1.jpg"> </div>
            <div class="pro-user mt-3">
               <h5 class="pro-user-username text-dark mb-1 fs-16">Faith Harris</h5>
               <h6 class="pro-user-desc text-muted fs-12">Web Designer</h6>
            </div>
            <div class="star-ratings start-ratings-main mb-0 clearfix">
               <div class="stars stars-example-fontawesome star-sm">
                  <div class="br-wrapper br-theme-fontawesome-stars">
                     <select id="example-fontawesome" name="rating" style="display: none;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4" selected="">4</option>
                        <option value="5">5</option>
                     </select>
                    
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer p-0">
            <div class="row">
               <div class="col-4 text-center py-5 border-end">
                  <h5 class="fs-12 font-weight-semibold mb-3">January</h5>
                  <h5 class="mb-2"> <span class="fs-18 text-success">0</span> <span class="my-auto fs-9 font-weight-normal  ms-1 me-1">/</span> <span class="fs-18 font-weight-semibold text-dark">31</span> </h5>
                  <h5 class="fs-12 mb-0">Attendance</h5>
               </div>
               <div class="col-4  py-5 text-center border-end">
                  <h5 class="fs-12 font-weight-semibold mb-3">Year-2021</h5>
                  <h5 class="mb-2"> <span class="fs-18 text-orange">0</span> <span class="my-auto fs-9 font-weight-normal  ms-1 me-1">/</span> <span class="fs-18 font-weight-semibold text-dark">41</span> </h5>
                  <h5 class="fs-12 mb-0">Leaves</h5>
               </div>
               <div class="col-4 text-center py-5">
                  <h5 class="fs-12 font-weight-semibold mb-3">Year-2021</h5>
                  <h5 class="mb-2"> <span class="fs-18 text-primary">0</span> </h5>
                  <h5 class="fs-12 mb-0">Awards</h5>
               </div>
            </div>
         </div>
      </div>
      <div class="card">
         <div class="card-header  border-0">
            <div class="card-title">Statistics-2021</div>
         </div>
         <div class="card-body">
            <div class="row mb-7">
               <div class="col-4 text-center">
                  <div class="chart-circle chart-circle-sm" data-value="0.00" data-thickness="5" data-color="#3366ff">
                     <canvas width="115" height="115" style="height: 63.9931px; width: 63.9931px;"></canvas>
                     <div class="chart-circle-value text-primary">0</div>
                  </div>
                  <h6 class="fs-14 font-weight-semibold mt-3">Attendance</h6>
               </div>
               <div class="col-4 text-center">
                  <div class="chart-circle chart-circle-sm" data-value="0.00" data-thickness="5" data-color="#fe7f00">
                     <canvas width="115" height="115" style="height: 63.9931px; width: 63.9931px;"></canvas>
                     <div class="chart-circle-value text-secondary">0</div>
                  </div>
                  <h6 class="fs-14 font-weight-semibold mt-3">Projects</h6>
               </div>
               <div class="col-4 text-center">
                  <div class="chart-circle chart-circle-sm" data-value="0.00" data-thickness="5" data-color="#0dcd94">
                     <canvas width="115" height="115" style="height: 63.9931px; width: 63.9931px;"></canvas>
                     <div class="chart-circle-value text-success">0%</div>
                  </div>
                  <h6 class="fs-14 font-weight-semibold mt-3">Performance</h6>
               </div>
            </div>
            <div class="d-flex align-items-end justify-content-between mg-b-5">
               <h6 class="">This Week</h6>
               <h6 class="font-weight-bold mb-1">0</h6>
            </div>
            <div class="progress progress-sm mb-5">
               <div class="progress-bar bg-danger w-0"></div>
            </div>
            <div class="d-flex align-items-end justify-content-between mg-b-5">
               <h6 class="">This Month</h6>
               <h6 class="font-weight-bold mb-1">0</h6>
            </div>
            <div class="progress progress-sm mb-5">
               <div class="progress-bar bg-info w-0"></div>
            </div>
            <div class="d-flex align-items-end justify-content-between mg-b-5">
               <h6 class="">This Year</h6>
               <h6 class="font-weight-bold mb-1">0</h6>
            </div>
            <div class="progress progress-sm mb-5">
               <div class="progress-bar bg-warning w-0"></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-9 col-md-12 col-lg-12">
      <div class="tab-menu-heading hremp-tabs p-0 ">
         <div class="tabs-menu1">
            <!-- Tabs --> 
            <ul class="nav panel-tabs">
               <li class="ms-4"><a href="#tab5" class="active" data-bs-toggle="tab">Personal Details</a></li>
               <li><a href="#tab6" data-bs-toggle="tab">Company Details</a></li>
               <li><a href="#tab7" data-bs-toggle="tab">Bank Details</a></li>
               <li><a href="#tab8" data-bs-toggle="tab">Upload Documents</a></li>
            </ul>
         </div>
      </div>
      <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
         <div class="tab-content">
            <div class="tab-pane active" id="tab5">
               <div class="card-body">
                  <h4 class="mb-4 font-weight-bold">Basic</h4>
                  <div class="form-group ">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">User Name</label> </div>
                        <div class="col-md-9">
                           <div class="row">
                              <div class="col-md-6"> <input type="text" class="form-control mb-md-0 mb-5" placeholder="First Name"> <span class="text-muted"></span> </div>
                              <div class="col-md-6"> <input type="text" class="form-control" placeholder="Last Name"> </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group ">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Father Name</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Name"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Contact Number</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Phone Number"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Emergency Contact Number 01</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Contact Number01"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Emergency Contact Number 02</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Contact Number02"> </div>
                     </div>
                  </div>
                  <div class="form-group ">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Date Of Birth</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYY" id="dp1642289966077"> </div>
                     </div>
                  </div>
                  <div class="form-group ">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label">Gender</label> </div>
                        <div class="col-md-9">
                           <div class="custom-controls-stacked d-md-flex"> <label class="custom-control custom-radio me-4"> <input type="radio" class="custom-control-input" name="example-radios4" value="option1"> <span class="custom-control-label">Male</span> </label> <label class="custom-control custom-radio"> <input type="radio" class="custom-control-input" name="example-radios4" value="option2"> <span class="custom-control-label">Female</span> </label> </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Marital Status</label> </div>
                        <div class="col-md-9">
                           <select name="projects" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select" data-select2-id="select2-data-1-decl" tabindex="-1" aria-hidden="true">
                              <option label="Select" data-select2-id="select2-data-3-omqq"></option>
                              <option value="1">Single</option>
                              <option value="2">Married</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-2-uyzq" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-projects-s8-container"><span class="select2-selection__rendered" id="select2-projects-s8-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> 
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Blood Group</label> </div>
                        <div class="col-md-9">
                           <select name="projects" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Group" data-select2-id="select2-data-4-jt7m" tabindex="-1" aria-hidden="true">
                              <option label="Select Group" data-select2-id="select2-data-6-3hhn"></option>
                              <option value="1">A+</option>
                              <option value="2">B+</option>
                              <option value="3">O+</option>
                              <option value="4">AB+</option>
                              <option value="5">A-</option>
                              <option value="6">B-</option>
                              <option value="7">O-</option>
                              <option value="8">AB-</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-5-4930" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-projects-sl-container"><span class="select2-selection__rendered" id="select2-projects-sl-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select Group</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> 
                        </div>
                     </div>
                  </div>
                  <div class="form-group ">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Email</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="email"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Present Address</label> </div>
                        <div class="col-md-9"> <textarea rows="3" class="form-control" placeholder="Address1"></textarea> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Permanent Address</label> </div>
                        <div class="col-md-9"> <textarea rows="3" class="form-control" placeholder="Address2"></textarea> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-label mb-0 mt-2">Upload Photo</div>
                        </div>
                        <div class="col-md-9">
                           <div class="form-group"> <label for="form-label" class="form-label"></label> <input class="form-control" type="file"> </div>
                        </div>
                     </div>
                  </div>
                  <h4 class="mb-5 mt-7 font-weight-bold">Account Login</h4>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employee Email</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="employee email"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Password</label> </div>
                        <div class="col-md-9"> <input type="password" class="form-control" placeholder="password"> </div>
                     </div>
                  </div>
                  <div class="form-group mt-7">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label">Email Notification:</label> </div>
                        <div class="col-md-9"> <label class="custom-switch"> <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"> <span class="custom-switch-indicator"></span> <span class="custom-switch-description">On/Off</span> </label> </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane" id="tab6">
               <div class="card-body">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employee ID</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="#ID"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Department</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Department"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Designation</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Designation"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Date Of Joining</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYYY" id="dp1642289966078"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Resignation Date</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYYY" id="dp1642289966079"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Termination Date</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYYY" id="dp1642289966080"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Credit Leaves <span class="form-help" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Unused leaves for the Employee">?</span> </label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="0"> </div>
                     </div>
                  </div>
                  <h4 class="mb-5 mt-7 font-weight-bold">Salary</h4>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Type</label> </div>
                        <div class="col-md-9">
                           <select name="projects" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Type" data-select2-id="select2-data-7-uv0d" tabindex="-1" aria-hidden="true">
                              <option label="Select Type" data-select2-id="select2-data-9-49kl"></option>
                              <option value="0">Full-Time</option>
                              <option value="1">Part-Time</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-8-xlaj" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-projects-tt-container"><span class="select2-selection__rendered" id="select2-projects-tt-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select Type</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> 
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Salary</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="$Salary"> </div>
                     </div>
                  </div>
                  <div class="form-group mt-7">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label">Status:</label> </div>
                        <div class="col-md-9"> <label class="custom-switch"> <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"> <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Active/Inactive</span> </label> </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane" id="tab7">
               <div class="card-body">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Account Holder</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Name"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Account Number</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Number"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Bank Name</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Name"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Branch Location</label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Location"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Bank Code (IFSC) <span class="form-help" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Bank Identify Number in your Country">?</span> </label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="Code"> </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3"> <label class="form-label mb-0 mt-2">Tax Payer ID (PAN) <span class="form-help" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Taxpayer Identification Number Used in your Country">?</span> </label> </div>
                        <div class="col-md-9"> <input type="text" class="form-control" placeholder="ID No"> </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane" id="tab8">
               <div class="card-body">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-label mb-0 mt-2">Resume</div>
                        </div>
                        <div class="col-md-9">
                           <div class="form-group"> <label for="form-label" class="form-label"></label> <input class="form-control" type="file"> </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-label mb-0 mt-2">ID Proof</div>
                        </div>
                        <div class="col-md-9">
                           <div class="form-group"> <label for="form-label" class="form-label"></label> <input class="form-control" type="file"> </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-label mb-0 mt-2">Offer Letter</div>
                        </div>
                        <div class="col-md-9">
                           <div class="form-group"> <label for="form-label" class="form-label"></label> <input class="form-control" type="file"> </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-label mb-0 mt-2">Joining Letter</div>
                        </div>
                        <div class="col-md-9">
                           <div class="form-group"> <label for="form-label" class="form-label"></label> <input class="form-control" type="file"> </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-label mb-0 mt-2">Agreement Letter</div>
                        </div>
                        <div class="col-md-9">
                           <div class="form-group"> <label for="form-label" class="form-label"></label> <input class="form-control" type="file"> </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-label mb-0 mt-2">Experience Letter</div>
                        </div>
                        <div class="col-md-9">
                           <div class="form-group"> <label for="form-label" class="form-label"></label> <input class="form-control" type="file"> </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-footer text-end"> <a href="#" class="btn btn-primary">Save</a> <a href="#" class="btn btn-danger">Cancel</a> </div>
         </div>
      </div>
   </div>
</div>

<?php include (SHARED_PATH . '/footer.php') ?>

