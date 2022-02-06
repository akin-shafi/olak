<?php
require_once('../private/initialize.php');
 
$page = 'Employees';
$page_title = 'Add Employee';
include(SHARED_PATH . '/header.php');

?>
<link rel="stylesheet" href="<?php echo url_for('assets/plugins/rating/css/ratings.css') ?>">
<link rel="stylesheet" href="<?php echo url_for('assets/plugins/rating/css/rating-themes.css') ?>">

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Add Employee</h4>
   </div>

   <div class="page-rightheader ms-md-auto d-none">
      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
         <div class="btn-list">
            <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> 

            <button class="btn btn-light d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button>

             <button class="btn btn-primary d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
         </div>
      </div>
   </div>
</div>


<div class="card d-none">
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
  

   <div class="col-xl-12 col-md-12 col-lg-12">
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
                  <input type="hidden" name="personal[password]" value="12345" readonly>
                  <input type="hidden" name="personal[confirm_password]" value="12345" readonly>

                  <div class="card-body">
                     <h4 class="mb-4 font-weight-bold">Basic</h4>
                     <div class="form-group ">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">User Name</label> </div>
                           <div class="col-md-9">
                              <div class="row">
                                 <div class="col-md-4"> <input type="text" name="personal[first_name]" class="form-control mb-md-0 mb-5" placeholder="First Name"> <span class="text-muted"></span> </div>
                                 <div class="col-md-4"> <input type="text" name="personal[last_name]" class="form-control" placeholder="Last Name"> </div>
                                 <div class="col-md-4"> <input type="text" name="personal[other_name]" class="form-control" placeholder="Middle Name"> </div>
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
                           <div class="col-md-9"> <input type="text" name="personal[kin_name]" class="form-control" placeholder="Next of Kin Name"> </div>
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
                              <select name="personal[marital_status]" class="form-control custom-select  ">
                                 <option value="">Select</option>
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
                              <select name="personal[blood_group]" class="form-control custom-select ">
                                 <option value="">Select Group</option>
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
               <form id="add_employee_company_form">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employee Name</label> </div>
                           <div class="col-md-9">
                              <select name="company[employee_id]" style="width:100%" class="form-control select2 select2-hidden-accessible" data-placeholder="Select Employee" required>
                                 <option label="Select Employee"></option>
                                 <?php foreach (Employee::find_by_undeleted() as $value) : ?>
                                    <option value="<?php echo $value->id ?>"><?php echo ucwords($value->full_name()) ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employee ID</label> </div>
                           <div class="col-md-9">
                              <div class="row">
                                 <div class="col-md-6">
                                    <select name="company[company_id]" style="width:100%" class="form-control select2 select2-hidden-accessible" data-placeholder="Company" required>
                                       <option label="Company"></option>
                                       <?php foreach (Company::find_by_undeleted() as $value) : ?>
                                          <option value="<?php echo $value->id ?>"><?php echo ucwords($value->company_name) ?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                                 <div class="col-md-6">
                                    <input type="text" name="company[employee_number]" class="form-control" placeholder="#ID">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Department</label> </div>
                           <div class="col-md-9">
                              <select name="company[department_id]" style="width:100%" class="form-control select2 select2-hidden-accessible" data-placeholder="Select Department" required>
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
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Branch</label> </div>
                           <div class="col-md-9"> <select name="company[branch_id]" style="width:100%" class="form-control select2 select2-hidden-accessible" data-placeholder="Select Branch" required>
                                 <option label="Select Branch"></option>
                                 <?php foreach (Branch::find_by_undeleted() as $value) : ?>
                                    <option value="<?php echo $value->id ?>"><?php echo ucwords($value->branch_name) ?></option>
                                 <?php endforeach; ?>
                              </select> </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Job Title</label> </div>
                           <div class="col-md-9">
                              <select name="company[job_title_id]" style="width:100%" class="form-control select2 select2-hidden-accessible" data-placeholder="Select Job Title" required>
                                 <option label="Select Employment Title"></option>
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
                     <h4 class="mb-5 mt-7 font-weight-bold">Salary</h4>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Employment Type</label> </div>
                           <div class="col-md-9">
                              <select name="company[employment_type]" style="width:100%" class="form-control select2 select2-hidden-accessible" data-placeholder="Employee Type" required>
                                 <option label="Employee Type"></option>
                                 <?php foreach (EmployeeType::find_by_undeleted() as $value) : ?>
                                    <option value="<?php echo $value->id ?>"><?php echo ucwords($value->name) ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3"> <label class="form-label mb-0 mt-2">Salary</label> </div>
                           <div class="col-md-9"> <input type="number" name="company[present_salary]" class="form-control" placeholder="e.g 150000"> </div>
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
                              <select name="bank[employee_id]" style="width:100%" class="form-control select2 select2-hidden-accessible" data-placeholder="Select Employee" required>
                                 <option label="Select Employee"></option>
                                 <?php foreach (Employee::find_by_undeleted() as $value) : ?>
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

      const personalForm = document.getElementById("add_personal_form");
      const employeeCompForm = document.getElementById("add_employee_company_form");
      const bankForm = document.getElementById("add_bank_form");
      const docForm = document.getElementById("add_doc_form");

      const uploadCSVForm = document.getElementById("upload_csv");

      uploadCSVForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(SETTING_URL + 'csv_uploads.php', uploadCSVForm);
      });

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
   });
</script>