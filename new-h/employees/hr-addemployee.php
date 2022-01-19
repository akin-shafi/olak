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
         <div class="btn-list">
            <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
         </div>
      </div>
   </div>
</div>


<div class="card">
   <div class="card-body">
      <div class="row ">
         <div class="col-lg-4 col-md-6 m-auto">
            <form id="upload_csv" enctype="multipart/form-data">
               <input type="hidden" name="csv" value="1">
               <div class="form-group"> <label for="form-label" class="form-label"></label>
                  <input class="form-control" name="employee_csv_data" type="file" accept=".csv" id="employee_data">
               </div>
               <button type="submit" class="btn btn-sm btn-outline-dark d-block m-auto">Upload Employee Data</button>
            </form>
         </div>
      </div>
   </div>
</div>


<div class="row">
   <div class="col-xl-3 col-md-12 col-lg-12">
      <div class="card box-widget widget-user">
         <div class="card-body text-center">
            <div class="widget-user-image mx-auto text-center">
               <img class="avatar avatar-xxl brround rounded-circle" alt="img" src="../assets/images/users/1.jpg">
            </div>
            <div class="pro-user mt-3">
               <h5 class="pro-user-username text-dark mb-1 fs-16">
                  <?php echo ucwords($user->full_name()) ?></h5>
               <h6 class="pro-user-desc text-muted fs-12">
                  <?php echo $user->admin_level ? $user->admin_level : 'Not Set' ?></h6>
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
                  <h5 class="fs-12 font-weight-semibold mb-3">Year-<?php echo date('Y') ?></h5>
                  <h5 class="mb-2"> <span class="fs-18 text-orange">0</span> <span class="my-auto fs-9 font-weight-normal  ms-1 me-1">/</span> <span class="fs-18 font-weight-semibold text-dark">28</span> </h5>
                  <h5 class="fs-12 mb-0">Leaves</h5>
               </div>
               <div class="col-4 text-center py-5">
                  <h5 class="fs-12 font-weight-semibold mb-3">Year-<?php echo date('Y') ?></h5>
                  <h5 class="mb-2"> <span class="fs-18 text-primary">0</span> </h5>
                  <h5 class="fs-12 mb-0">Awards</h5>
               </div>
            </div>
         </div>
      </div>
      <div class="card">
         <div class="card-header  border-0">
            <div class="card-title">Statistics-<?php echo date('Y') ?></div>
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
               <form id="add_personal_form" enctype="multipart/form-data">
                  <!-- <input type="hidden" name="employeeId" id="employeeIds" readonly> -->

                  <div class="card-body">
                     <h4 class="mb-4 font-weight-bold">Basic</h4>
                     <div class="form-group ">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">User Name</label> </div>
                           <div class="col-md-9">
                              <div class="row">
                                 <div class="col-md-4"> <input type="text" name="personal[firstname]" class="form-control mb-md-0 mb-5" placeholder="First Name"> <span class="text-muted"></span> </div>
                                 <div class="col-md-4"> <input type="text" name="personal[lastname]" class="form-control" placeholder="Last Name"> </div>
                                 <div class="col-md-4"> <input type="text" name="personal[othername]" class="form-control" placeholder="Middle Name"> </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Contact Number</label> </div>
                           <div class="col-md-9"> <input type="tel" name="personal[phone]" class="form-control" placeholder="Phone Number"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Next of Kin Name</label> </div>
                           <div class="col-md-9"> <input type="tel" name="personal[kin_name]" class="form-control" placeholder="Next of Kin Name"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Next of Kin Number</label> </div>
                           <div class="col-md-9"> <input type="tel" name="personal[kin_phone]" class="form-control" placeholder="Contact Number"> </div>
                        </div>
                     </div>
                     <div class="form-group ">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Date Of Birth</label> </div>
                           <div class="col-md-9"> <input type="date" name="personal[dob]" class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYY" id="dp1642289966077"> </div>
                        </div>
                     </div>
                     <div class="form-group ">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label">Gender</label> </div>
                           <div class="col-md-9">
                              <div class="custom-controls-stacked d-md-flex"> <label class="custom-control custom-radio me-4"> <input type="radio" class="custom-control-input" name="personal[gender]" value="male"> <span class="custom-control-label">Male</span> </label> <label class="custom-control custom-radio"> <input type="radio" class="custom-control-input" name="personal[gender]" value="female"> <span class="custom-control-label">Female</span> </label> </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Marital Status</label> </div>
                           <div class="col-md-9">
                              <select name="personal[marital_status]" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select" data-select2-id="select2-data-1-decl" tabindex="-1" aria-hidden="true">
                                 <option label="Select" data-select2-id="select2-data-3-omqq"></option>
                                 <option value="Single">Single</option>
                                 <option value="Married">Married</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Blood Group</label> </div>
                           <div class="col-md-9">
                              <select name="personal[blood_group]" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Group" data-select2-id="select2-data-4-jt7m" tabindex="-1" aria-hidden="true">
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
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Present Address</label> </div>
                           <div class="col-md-9"> <textarea name="personal[present_add]" rows="3" class="form-control" placeholder="Address1"></textarea> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Permanent Address</label> </div>
                           <div class="col-md-9"> <textarea name="personal[permanent_add]" rows="3" class="form-control" placeholder="Address2"></textarea> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3">
                              <div class="form-label mb-0 mt-2">Upload Photo</div>
                           </div>
                           <div class="col-md-9">
                              <div class="form-group"> <label for="form-label" class="form-label"></label>
                                 <input class="form-control" name="avatar" type="file">
                              </div>
                           </div>
                        </div>
                     </div>
                     <h4 class="mb-5 mt-7 font-weight-bold">Account Login</h4>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employee Email</label> </div>
                           <div class="col-md-9"> <input type="email" name="personal[email]" class="form-control" placeholder="employee email"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Password</label> </div>
                           <div class="col-md-9"> <input type="password" name="personal[password]" class="form-control" placeholder="password"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Password</label> </div>
                           <div class="col-md-9"> <input type="password" name="personal[confirm_password]" class="form-control" placeholder="confirm password"> </div>
                        </div>
                     </div>
                     <div class="form-group mt-7">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label">Email Notification:</label> </div>
                           <div class="col-md-9"> <label class="custom-switch"> <input type="checkbox" name="personal[notification]" class="custom-switch-input"> <span class="custom-switch-indicator"></span> <span class="custom-switch-description">On/Off</span> </label> </div>
                        </div>
                     </div>
                  </div>

                  <div class="card-footer text-end">
                     <button type="submit" href="#" class="btn btn-primary">Save</button>
                     <a href="#" class="btn btn-danger">Cancel</a>
                  </div>
               </form>
            </div>

            <div class="tab-pane" id="tab6">
               <form id="add_company_form">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employee Name</label> </div>
                           <div class="col-md-9">
                              <select name="company[employee_id]" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Employee" required>
                                 <option label="Select Employee"></option>
                                 <?php foreach (EmployeeData::find_by_undeleted() as $value) : ?>
                                    <option value="<?php echo $value->id ?>"><?php echo ucwords($value->full_name()) ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employee ID</label> </div>
                           <div class="col-md-9"> <input type="text" name="company[employee_number]" class="form-control" placeholder="#ID"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Department</label> </div>
                           <div class="col-md-9">
                              <select name="company[department_id]" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Department" required>
                                 <option label="Select Department"></option>
                                 <?php foreach (Department::find_by_undeleted() as $value) : ?>
                                    <option value="<?php echo $value->id ?>">
                                       <?php echo ucwords($value->department_name) ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Location</label> </div>
                           <div class="col-md-9"> <input type="text" name="company[location]" class="form-control" placeholder="Location"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Designation</label> </div>
                           <div class="col-md-9">
                              <select name="company[designation_id]" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Employee" required>
                                 <option label="Select Employee"></option>
                                 <?php foreach (Designation::find_by_undeleted() as $value) : ?>
                                    <option value="<?php echo $value->id ?>">
                                       <?php echo ucwords($value->designation_name) ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Date Of Joining</label> </div>
                           <div class="col-md-9"> <input type="date" name="company[date_employed]" class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYYY" id="dp1642289966078"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Resignation Date</label> </div>
                           <div class="col-md-9"> <input type="date" name="company[reg_date]" class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYYY" id="dp1642289966079"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Termination Date</label> </div>
                           <div class="col-md-9"> <input type="date" name="company[terminate_date]" class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYYY" id="dp1642289966080"> </div>
                        </div>
                     </div>
                     <h4 class="mb-5 mt-7 font-weight-bold">Salary</h4>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Type</label> </div>
                           <div class="col-md-9">
                              <select name="company[salary_type]" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Type" data-select2-id="select2-data-7-uv0d" tabindex="-1" aria-hidden="true">
                                 <option value="" label="Select Type" data-select2-id="select2-data-9-49kl"></option>
                                 <option value="1">Full-Time</option>
                                 <option value="2">Casual-Worker</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Salary</label> </div>
                           <div class="col-md-9"> <input type="number" name="company[salary]" class="form-control" placeholder="₦Salary"> </div>
                        </div>
                     </div>
                     <div class="form-group mt-7">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label">Status:</label> </div>
                           <div class="col-md-9">
                              <label class="custom-switch"> <input type="checkbox" name="company[status]" class="custom-switch-input"> <span class="custom-switch-indicator"></span>
                                 <span class="custom-switch-description">Active/Inactive</span> </label>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card-footer text-end">
                     <button type="submit" href="#" class="btn btn-primary">Save</button>
                     <a href="#" class="btn btn-danger">Cancel</a>
                  </div>
               </form>
            </div>

            <div class="tab-pane" id="tab7">
               <form id="add_bank_form">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employee Name</label> </div>
                           <div class="col-md-9">
                              <select name="bank[employee_id]" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Employee" data-select2-id="select2-data-7-uv0d" tabindex="-1" aria-hidden="true" required>
                                 <option label="Select Employee" data-select2-id="select2-data-9-49kl"></option>
                                 <?php foreach (EmployeeData::find_by_undeleted() as $value) : ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->full_name() ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Account Holder</label> </div>
                           <div class="col-md-9">
                              <input type="text" name="bank[account_holder]" class="form-control" placeholder="Name">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Account Number</label> </div>
                           <div class="col-md-9"> <input type="text" name="bank[account_number]" class="form-control" placeholder="Number"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Bank Name</label> </div>
                           <div class="col-md-9"> <input type="text" name="bank[bank_name]" class="form-control" placeholder="Name"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Branch Location</label> </div>
                           <div class="col-md-9"> <input type="text" name="bank[bank_location]" class="form-control" placeholder="Location"> </div>
                        </div>
                     </div>

                     <div class="card-footer text-end">
                        <button type="submit" href="#" class="btn btn-primary">Save</button>
                        <a href="#" class="btn btn-danger">Cancel</a>
                     </div>
                  </div>
               </form>
            </div>

            <div class="tab-pane" id="tab8">
               <form id="add_doc_form">
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

                     <div class="card-footer text-end">
                        <button type="submit" href="#" class="btn btn-primary">Save</button>
                        <a href="#" class="btn btn-danger">Cancel</a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include(SHARED_PATH . '/footer.php') ?>