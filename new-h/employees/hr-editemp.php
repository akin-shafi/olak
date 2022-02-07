<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Employees View';
include(SHARED_PATH . '/header.php');
$all = Employee::find_by_undeleted(['order' => 'ASC']);
$my_id = array_values($all)[0]->id;
$id = $_GET['id'] ?? $my_id;

$employee = Employee::find_by_id($id);


if (!empty($employee->photo)) {
   $profile_picture = url_for('assets/uploads/profiles/' . $employee->photo);
} else {
   if ($employee->gender == 'male') {
      $profile_picture = url_for('assets/images/users/male.jpg');
   } else {
      $profile_picture = url_for('assets/images/users/female.jpg');
   }
}

$select2 = '';
?>

<link rel="stylesheet" href="<?php echo url_for('assets/plugins/rating/css/ratings.css') ?>">
<link rel="stylesheet" href="<?php echo url_for('assets/plugins/rating/css/rating-themes.css') ?>">
<input type="text" id="empId" value="<?php echo $id ?>">

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Edit Employee</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-center">
         <a href="<?php echo url_for('employees/hr-addemployee.php') ?>" class="btn btn-primary me-3">Add New Employee</a>

         <div class="d-none">
            <select name="query[employee_id]" class="select2" data-placeholder="Select Employee" id="query_employee">
               <option label="Select Employee"></option>
               <?php foreach (Employee::find_by_undeleted() as $value) : ?>
                  <option value="<?php echo $value->id ?>"><?php echo ucwords($value->full_name()) ?></option>
               <?php endforeach; ?>
            </select>
         </div>

         <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right ms-4 d-none">
            <div class="btn-list"> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
         </div>
      </div>
   </div>
</div>


<div class="row">
   <div class="col-xl-3 col-md-12 col-lg-12">
      <div class="card box-widget widget-user">
         <div class="card-body text-center">
            <div class="widget-user-image mx-auto text-center">
               <img class="avatar avatar-xxl brround rounded-circle" alt="img" src="<?php echo $profile_picture; ?>">
            </div>
            <div class="pro-user mt-3">
               <h5 class="pro-user-username text-dark mb-1 fs-16"><?php echo  $employee->find_by_id($id)->full_name() ?? "Not Set" ?></h5>
               <h6 class="pro-user-desc text-muted fs-12"><?php echo $employee->branch ?? 'Not Set' ?></h6>
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
                  <div class="chart-circle chart-circle-sm" data-value="0.89" data-thickness="5" data-color="#3366ff">
                     <canvas width="115" height="115" style="height: 63.9931px; width: 63.9931px;"></canvas>
                     <div class="chart-circle-value text-primary">89</div>
                  </div>
                  <h6 class="fs-14 font-weight-semibold mt-3">Attendance</h6>
               </div>
               <div class="col-4 text-center">
                  <div class="chart-circle chart-circle-sm" data-value="0.23" data-thickness="5" data-color="#fe7f00">
                     <canvas width="115" height="115" style="height: 63.9931px; width: 63.9931px;"></canvas>
                     <div class="chart-circle-value text-secondary">23</div>
                  </div>
                  <h6 class="fs-14 font-weight-semibold mt-3">Projects</h6>
               </div>
               <div class="col-4 text-center">
                  <div class="chart-circle chart-circle-sm" data-value="0.67" data-thickness="5" data-color="#0dcd94">
                     <canvas width="115" height="115" style="height: 63.9931px; width: 63.9931px;"></canvas>
                     <div class="chart-circle-value text-success">67%</div>
                  </div>
                  <h6 class="fs-14 font-weight-semibold mt-3">Performance</h6>
               </div>
            </div>
            <div class="d-flex align-items-end justify-content-between mg-b-5">
               <h6 class="">This Week</h6>
               <h6 class="font-weight-bold mb-1">01</h6>
            </div>
            <div class="progress progress-sm mb-5">
               <div class="progress-bar bg-danger w-10"></div>
            </div>
            <div class="d-flex align-items-end justify-content-between mg-b-5">
               <h6 class="">This Month</h6>
               <h6 class="font-weight-bold mb-1">05</h6>
            </div>
            <div class="progress progress-sm mb-5">
               <div class="progress-bar bg-info w-30"></div>
            </div>
            <div class="d-flex align-items-end justify-content-between mg-b-5">
               <h6 class="">This Year</h6>
               <h6 class="font-weight-bold mb-1">22</h6>
            </div>
            <div class="progress progress-sm mb-5">
               <div class="progress-bar bg-warning w-50"></div>
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
                  <input type="hidden" name="personalId" value="<?php echo $employee->id ?>">

                  <div class="card-body">
                     <h4 class="mb-4 font-weight-bold">Basic</h4>
                     <div class="form-group ">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">User Name</label> </div>
                           <div class="col-md-9">
                              <div class="row">
                                 <div class="col-md-4"> <input type="text" name="personal[first_name]" id="first_name" value="<?php echo $employee->first_name; ?>" class="form-control mb-md-0 mb-5" placeholder="First Name"> <span class="text-muted"></span> </div>
                                 <div class="col-md-4"> <input type="text" name="personal[last_name]" id="last_name" value="<?php echo $employee->last_name; ?>" class="form-control" placeholder="Last Name"> </div>
                                 <div class="col-md-4"> <input type="text" name="personal[other_name]" id="other_name" value="<?php echo $employee->other_name; ?>" class="form-control" placeholder="Middle Name"> </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Contact Number</label> </div>
                           <div class="col-md-9"> <input type="text" name="personal[phone]" id="phone" value="<?php echo $employee->phone; ?>" class="form-control" placeholder="Phone Number"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Next of Kin Name</label> </div>
                           <div class="col-md-9"> <input type="text" name="personal[kin_name]" id="kin_name" value="<?php echo $employee->kin_name; ?>" class="form-control" placeholder="Next of Kin Name"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Next of Kin Number</label> </div>
                           <div class="col-md-9"> <input type="text" name="personal[kin_phone]" id="kin_phone" value="<?php echo $employee->kin_phone; ?>" class="form-control" placeholder="Contact Number"> </div>
                        </div>
                     </div>
                     <div class="form-group ">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Date Of Birth</label> </div>
                           <div class="col-md-9"> <input type="date" name="personal[dob]" id="dob" value="<?php echo $employee->dob; ?>" class="form-control" placeholder="DD-MM-YYY"> </div>
                        </div>
                     </div>
                     <div class="form-group ">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label">Gender</label> </div>
                           <div class="col-md-9">
                              <div class="custom-controls-stacked d-md-flex"> <label class="custom-control custom-radio me-4"> <input type="radio" class="custom-control-input" name="personal[gender]" id="gender" value="male" <?php echo $employee->gender == 'male' ? 'checked' : '' ?>> <span class="custom-control-label">Male</span> </label> <label class="custom-control custom-radio"> <input type="radio" class="custom-control-input" name="personal[gender]" id="gender" value="female" <?php echo $employee->gender == 'female' ? 'checked' : '' ?>> <span class="custom-control-label">Female</span> </label> </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Marital Status</label> </div>
                           <div class="col-md-9">
                              <select name="personal[marital_status]" id="marital_status" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Status" data-select2-id="select2-data-1-decl" tabindex="-1" aria-hidden="true">
                                 <option label="Select" data-select2-id="select2-data-3-omqq"></option>
                                 <option value="Single" <?php echo $employee->marital_status == 'Single' ? 'selected' : '' ?>>Single</option>
                                 <option value="Married" <?php echo $employee->marital_status == 'Married' ? 'selected' : '' ?>>Married</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Blood Group</label> </div>
                           <div class="col-md-9">
                              <select name="personal[blood_group]" id="blood_group" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Group" data-select2-id="select2-data-4-jt7m" tabindex="-1" aria-hidden="true">
                                 <option label="Select Group" data-select2-id="select2-data-6-3hhn"></option>
                                 <option value="1" <?php echo $employee->blood_group == 1 ? 'selected' : '' ?>>A+</option>
                                 <option value="2" <?php echo $employee->blood_group == 2 ? 'selected' : '' ?>>B+</option>
                                 <option value="3" <?php echo $employee->blood_group == 3 ? 'selected' : '' ?>>O+</option>
                                 <option value="4" <?php echo $employee->blood_group == 4 ? 'selected' : '' ?>>AB+</option>
                                 <option value="5" <?php echo $employee->blood_group == 5 ? 'selected' : '' ?>>A-</option>
                                 <option value="6" <?php echo $employee->blood_group == 6 ? 'selected' : '' ?>>B-</option>
                                 <option value="7" <?php echo $employee->blood_group == 7 ? 'selected' : '' ?>>O-</option>
                                 <option value="8" <?php echo $employee->blood_group == 8 ? 'selected' : '' ?>>AB-</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Present Address</label> </div>
                           <div class="col-md-9"> <textarea name="personal[present_add]" id="present_add" rows="3" class="form-control" placeholder="Address1"><?php echo $employee->present_add ?></textarea> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Permanent Address</label> </div>
                           <div class="col-md-9"> <textarea name="personal[permanent_add]" id="permanent_add" rows="3" class="form-control" placeholder="Address2"><?php echo $employee->permanent_add ?></textarea> </div>
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
                           <div class="col-md-9"> <input type="email" name="personal[email]" id="email" value="<?php echo $employee->email; ?>" class="form-control" placeholder="employee email"> </div>
                        </div>
                     </div>

                     <!-- <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Password</label> </div>
                           <div class="col-md-9"> <input type="password" name="personal[password]" id="password" class="form-control" placeholder="password"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Password</label> </div>
                           <div class="col-md-9"> <input type="password" name="personal[confirm_password]" id="confirm_password" class="form-control" placeholder="confirm password"> </div>
                        </div>
                     </div> -->

                     <div class="form-group mt-7">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label">Email Notification:</label> </div>
                           <div class="col-md-9"> <label class="custom-switch"> <input type="checkbox" name="personal[notification]" id="notification" class="custom-switch-input" <?php echo $employee->notification == 'on' ? 'checked' : '' ?>> <span class="custom-switch-indicator"></span> <span class="custom-switch-description">On/Off</span> </label> </div>
                        </div>
                     </div>
                  </div>

                  <div class="card-footer text-end">
                     <button type="submit" href="#" class="btn btn-primary">Update</button>
                     <a href="#" class="btn btn-danger">Cancel</a>
                  </div>
               </form>
            </div>

            <div class="tab-pane" id="tab6">
               <form id="add_employee_company_form">
                  <input type="hidden" name="companyId" value="<?php echo $employee->id ?>">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employee</label> </div>
                           <div class="col-md-9">
                              <div class="row">
                                 <div class="col-md-6">
                                    <select name="company[company_id]" value="<?php echo $employee->company_id ?>" id="company_id" style="width:100%" class="form-control select2" data-placeholder="Company Name" required>
                                       <option label="Company"></option>
                                       <?php foreach (Company::find_by_undeleted() as $value) : ?>
                                          <option value="<?php echo $value->company_name ?>" <?php echo $value->company_name == $employee->company ? 'selected' : '' ?>><?php echo ucwords($value->company_name) ?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                                 <div class="col-md-6">
                                    <input type="text" name="company[employee_number]" value="<?php echo $employee->employee_id ?>" id="employee_number" class="form-control" placeholder="#ID">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Department</label> </div>
                           <div class="col-md-9">
                              <select name="company[department_id]" value="<?php echo $employee->department ?>" id="department_id" style="width:100%" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Department" required>
                                 <option label="Select Department"></option>
                                 <?php foreach (Department::find_by_undeleted() as $value) : ?>
                                    <option value="<?php echo $value->id ?>" <?php echo $employee->department == $value->department_name ? 'selected' : '' ?>>
                                       <?php echo ucwords($value->department_name) ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Branch</label> </div>
                           <div class="col-md-9">
                              <div id="get_branch"></div>
                              <!-- //? AJAX CALL -->
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Job Title</label> </div>
                           <div class="col-md-9">
                              <select name="company[job_title_id]" value="<?php echo $employee->job_title_id ?>" id="job_title_id" style="width:100%" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Job Title" required>
                                 <option label="Select Employment Title"></option>
                                 <?php foreach (Designation::find_by_undeleted() as $value) : ?>
                                    <option value="<?php echo $value->id ?>" <?php echo $employee->job_title == $value->designation_name ? 'selected' : '' ?>>
                                       <?php echo ucwords($value->designation_name) ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Date Of Joining</label> </div>
                           <div class="col-md-9"> <input type="date" name="company[date_employed]" value="<?php echo $employee->date_employed ?>" id="date_employed" class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYYY" id="dp1642289966078"> </div>
                        </div>
                     </div>
                     <h4 class="mb-5 mt-7 font-weight-bold">Salary</h4>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employment Type</label> </div>
                           <div class="col-md-9">
                              <select name="company[employment_type]" value="<?php echo $employee->employment_type ?>" id="employment_type" style="width:100%" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Employee Type" required>
                                 <option label="Employee Type"></option>
                                 <?php foreach (EmployeeType::find_by_undeleted() as $value) : ?>
                                    <option value="<?php echo $value->id ?>" <?php echo $employee->employment_type == $value->id ? 'selected' : '' ?>><?php echo ucwords($value->name) ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Salary</label> </div>
                           <div class="col-md-9"> <input type="number" name="company[present_salary]" value="<?php echo $employee->present_salary ?>" id="present_salary" class="form-control" placeholder="e.g 15000"> </div>
                        </div>
                     </div>
                     <div class="form-group mt-7 d-none">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label">Status:</label> </div>
                           <div class="col-md-9">
                              <label class="custom-switch"> <input type="checkbox" name="company[status]" value="<?php echo $employee->status ?>" id="status" class="custom-switch-input"> <span class="custom-switch-indicator"></span>
                                 <span class="custom-switch-description">Active/Inactive</span> </label>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card-footer text-end">
                     <button type="submit" href="#" class="btn btn-primary">Update</button>
                     <a href="#" class="btn btn-danger">Cancel</a>
                  </div>
               </form>
            </div>

            <div class="tab-pane" id="tab7">
               <form id="add_bank_form">
                  <input type="hidden" name="bankId" value="<?php echo $employee->id ?>">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Account Number</label> </div>
                           <div class="col-md-9"> <input type="text" name="bank[account_number]" value="<?php echo $employee->account_number ?>" id="account_number" class="form-control" placeholder="Number"> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Bank Name</label> </div>
                           <div class="col-md-9"> <input type="text" name="bank[bank_name]" value="<?php echo $employee->bank_name ?>" id="bank_name" class="form-control" placeholder="Name"> </div>
                        </div>
                     </div>

                     <div class="card-footer text-end">
                        <button type="submit" href="#" class="btn btn-primary">Update</button>
                        <a href="#" class="btn btn-danger">Cancel</a>
                     </div>
                  </div>
               </form>
            </div>

            <div class="tab-pane" id="tab8">
               <form id="add_doc_form">
                  <input type="hidden" name="documentId" value="<?php echo $employee->id ?>">
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
                        <button type="submit" href="#" class="btn btn-primary">Update</button>
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


<script>
   $(document).ready(function() {
      const message = (req, res) => {
         swal(req + "!", res, {
            icon: req,
            timer: 2000,
            buttons: {
               confirm: {
                  className: req == "error" ? "btn btn-danger" : "btn btn-success",
               },
            },
         }).then(() => location.reload());
      };

      const deleted = async (url) => {
         swal({
            title: "Are you sure?",
            text: "You won't be able to reverse this!",
            icon: "warning",
            buttons: {
               confirm: {
                  text: "Yes, delete it!",
                  className: "btn btn-danger",
               },
               cancel: {
                  visible: true,
                  className: "btn btn-secondary",
               },
            },
         }).then((Delete) => {
            if (Delete) {
               fetch(url)
                  .then((res) => res.json())
                  .then((data) => {
                     swal({
                        title: "Deleted!",
                        text: data.message,
                        icon: "success",
                        buttons: {
                           confirm: {
                              className: "btn btn-success",
                           },
                        },
                     }).then(() => location.reload());
                  });
            } else {
               swal.close();
            }
         });
      };

      const submitForm = async (url, payload) => {
         const formData = new FormData(payload);

         const data = await fetch(url, {
            method: "POST",
            body: formData,
         });

         const res = await data.json();

         if (res.errors) {
            message("error", res.errors);
         }

         if (res.message) {
            message("success", res.message);
         }
      };

      const EMPLOYEE_URL = "../inc/employee/";
      const SETTING_URL = "../inc/setting/";
      const GET_BRANCH_URL = "./inc/get_empview.php";

      const personalForm = document.getElementById("add_personal_form");
      const employeeCompForm = document.getElementById("add_employee_company_form");
      const bankForm = document.getElementById("add_bank_form");
      const docForm = document.getElementById("add_doc_form");

      personalForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, personalForm);
      });

      employeeCompForm.addEventListener("submit", (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, employeeCompForm);
      });

      bankForm.addEventListener("submit", (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, bankForm);
      });

      docForm.addEventListener("submit", (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, docForm);
      });


      const getBranch = async () => {
         let emp_id = $('#empId').val();
         let company = $("#company_id").val()
         let data = await fetch(GET_BRANCH_URL + '?get_branch_via_company=' + company + '&emp_id=' + emp_id)
         let res = await data.text();

         $('#get_branch').html(res);
      }

      getBranch();
      $('#company_id').select2().on("change", getBranch);


   });
</script>