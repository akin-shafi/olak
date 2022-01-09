<?php
require_once('../private/initialize.php');

if (!isset($_GET['employee_id'])) {
   redirect_to('../employees/employees-list.php');
}

$id = $_GET['employee_id'];
$employee = Employee::find_by_id($id);
$employeeInfo = EmployeeDetail::find_by_id($id) ?? '';
$salary = Salary::find_by_employee_id($id);

$salaryDeduction = SalaryDeduction::find_by_deductions($salary->id)->total_deductions;
$salaryEarning = SalaryEarning::find_by_earnings($salary->id)->total_earnings;

$employeeSalaryEarning = SalaryEarning::find_by_earnings($id);
$department = Department::find_by_id($employee->department_id);
$designation = Designation::find_by_id($employee->designation_id);
$education = EmployeeEducation::find_by_employee_id($id);
$experience = EmployeeExperience::find_by_employee_id($id);

$page = 'Employees';
$page_title = 'Profile';
include(SHARED_PATH . '/admin_header.php');
?>

<style type="text/css">
   .table-wrap {
      height: 80%;
      overflow-y: auto;
   }
</style>
<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Profile</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Profile</li>
               </ul>
            </div>
         </div>
      </div>

      <div class="card mb-0">
         <div class="card-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="profile-view">
                     <div class="profile-img-wrap">
                        <div class="profile-img">
                           <a href="#"><img alt="" src="<?php echo url_for('/assets/uploads/' . $employee->photo); ?>"></a>
                        </div>
                     </div>
                     <div class="profile-basic">
                        <div class="row">
                           <div class="col-md-5">
                              <div class="profile-info-left">
                                 <h3 class="user-name m-t-0 mb-0"><?php echo ucwords($employee->full_name()); ?></h3>
                                 <h6 class="text-muted">
                                    Department: <?php echo ucwords($department->department_name); ?>
                                 </h6>
                                 <small class="text-muted">
                                    Designation: <?php echo ucwords($designation->designation_name); ?>
                                 </small>
                                 <div class="staff-id">
                                    Employee ID : <?php echo strtoupper($employee->employee_id); ?>
                                 </div>
                                 <div class="small doj text-muted">
                                    Date of Join : <?php echo date('M jS, Y', strtotime($employee->date_employed)); ?>
                                 </div>
                                 <div class="staff-msg"><a class="btn btn-custom" href="#">Send Message</a></div>
                              </div>
                           </div>
                           <div class="col-md-7">
                              <ul class="personal-info">
                                 <li>
                                    <div class="title">Phone:</div>
                                    <div class="text"><a href="#"><?php echo $employee->phone; ?></a></div>
                                 </li>
                                 <li>
                                    <div class="title">Email:</div>
                                    <div class="text"><a href="#"><?php echo $employee->email; ?></a></div>
                                 </li>
                                 <li>
                                    <div class="title">Birthday:</div>
                                    <div class="text"><?php echo date('M jS, Y', strtotime($employee->dob)); ?></div>
                                 </li>
                                 <li>
                                    <div class="title">Address:</div>
                                    <div class="text"><?php echo $employee->address != '' ? $employee->address : 'NOT SET'; ?></div>
                                 </li>
                                 <li>
                                    <div class="title">Gender:</div>
                                    <div class="text"><?php echo ucwords($employee->gender); ?></div>
                                 </li>
                                 <!-- <li>
                                    <div class="title">Reports to:</div>
                                    <div class="text">
                                       <div class="avatar-box">
                                          <div class="avatar avatar-xs">
                                             <img src="assets/img/profiles/avatar-16.jpg" alt="">
                                          </div>
                                       </div>
                                       <a href="#">
                                          Jeffery Lalor
                                       </a>
                                    </div>
                                 </li> -->
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="pro-edit"><a data-bs-target="#profile_info" data-bs-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="card tab-box">
         <div class="row user-tabs">
            <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
               <ul class="nav nav-tabs nav-tabs-bottom">
                  <li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Profile</a></li>
                  <li class="nav-item"><a href="#emp_loan" data-bs-toggle="tab" class="nav-link">Loan Management</a></li>
                  <li class="nav-item"><a href="#bank_statutory" data-bs-toggle="tab" class="nav-link">Bank & Statutory <small class="text-danger">(Admin Only)</small></a></li>
               </ul>
            </div>
         </div>
      </div>
      <div class="tab-content">
         <div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
               <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                     <div class="card-body">
                        <h3 class="card-title">Personal Information <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#personal_info_modal"><i class="fa fa-pencil"></i></a></h3>
                        <ul class="personal-info">
                           <li>
                              <div class="title">Nationality</div>
                              <div class="text"><?php echo $employee->country != '' ? ucwords($employee->country) : 'NOT SET'; ?></div>
                           </li>
                           <li>
                              <div class="title">State</div>
                              <div class="text"><?php echo $employee->state != '' ? ucwords($employee->state) : 'NOT SET'; ?></div>
                           </li>
                           <li>
                              <div class="title">Religion</div>
                              <div class="text">
                                 <?php echo $employee->religion != '' ? ucwords($employee->religion) : 'NOT SET'; ?>
                              </div>
                           </li>
                           <li>
                              <div class="title">Marital status</div>
                              <div class="text">
                                 <?php echo $employee->marital_status != '' ? ucwords($employee->marital_status) : 'NOT SET'; ?>
                              </div>
                           </li>
                           <li>
                              <div class="title">No. of children</div>
                              <div class="text"><?php echo $employee->children != '' ? ucwords($employee->children) : 'NOT SET'; ?></div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                     <div class="card-body">
                        <h3 class="card-title">Next of Kin Contact <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#kin_contact_modal"><i class="fa fa-pencil"></i></a></h3>
                        <ul class="personal-info">
                           <li>
                              <div class="title">Name</div>
                              <div class="text"><?php echo !empty($employeeInfo->kin_name) ? ucwords($employeeInfo->kin_name) : 'NOT SET' ?></div>
                           </li>
                           <li>
                              <div class="title">Relationship</div>
                              <div class="text"><?php echo !empty($employeeInfo->kin_relationship) ? ucwords($employeeInfo->kin_relationship) : 'NOT SET' ?></div>
                           </li>
                           <li>
                              <div class="title">Phone </div>
                              <div class="text"><?php echo !empty($employeeInfo->kin_phone_1) ? $employeeInfo->kin_phone_1 : 'NOT SET' ?>, <?php echo $employeeInfo->kin_phone_2 ?? 'NOT SET' ?></div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                     <div class="card-body">
                        <h3 class="card-title">Education Information <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#education_info"><i class="fa fa-pencil"></i></a></h3>
                        <div class="experience-box">
                           <ul class="experience-list">

                              <?php foreach ($education as $educate) : ?>
                                 <li>
                                    <div class="experience-user">
                                       <div class="before-circle"></div>
                                    </div>
                                    <div class="experience-content">
                                       <div class="timeline-content">
                                          <a href="#/" class="name">
                                             <?php echo ucwords($educate->institution); ?></a>
                                          <div>
                                             <?php echo ucwords($educate->degree); ?>
                                             <?php echo ucwords($educate->subject); ?>
                                          </div>
                                          <span class="time">
                                             <?php echo date('Y', strtotime($educate->start_date)); ?> -
                                             <?php echo date('Y', strtotime($educate->complete_date)); ?>
                                          </span>
                                       </div>
                                    </div>
                                 </li>
                              <?php endforeach; ?>

                           </ul>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                     <div class="card-body">
                        <h3 class="card-title">Experience <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#experience_info"><i class="fa fa-pencil"></i></a></h3>
                        <div class="experience-box">
                           <ul class="experience-list">
                              <?php foreach ($experience as $exp) : ?>
                                 <li>
                                    <div class="experience-user">
                                       <div class="before-circle"></div>
                                    </div>
                                    <div class="experience-content">
                                       <div class="timeline-content">
                                          <a href="#/" class="name">
                                             <?php echo ucwords($exp->job_position) ?> at
                                             <?php echo ucwords($exp->company_name) ?></a>
                                          <span class="time"><?php echo date('M, Y', strtotime($exp->period_from)) ?> -
                                             <?php echo date('M, Y', strtotime($exp->period_to)) ?>
                                             (<?php echo time_elapsed_string($exp->period_to) ?>)</span>
                                       </div>
                                    </div>
                                 </li>
                              <?php endforeach; ?>

                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                     <div class="card-body">
                        <h3 class="card-title">Bank Information <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#bank_modal"><i class="fa fa-pencil"></i></a></h3>
                        <ul class="personal-info">
                           <li>
                              <div class="title">Bank name</div>
                              <div class="text">
                                 <?php echo !empty($employeeInfo->bank_name) ? ucwords($employeeInfo->bank_name) : 'NOT SET' ?>
                              </div>
                           </li>
                           <li>
                              <div class="title">Account name</div>
                              <div class="text">
                                 <?php echo !empty($employeeInfo->account_name) ? ucwords($employeeInfo->account_name) : 'NOT SET' ?>
                              </div>
                           </li>
                           <li>
                              <div class="title">Bank account No.</div>
                              <div class="text">
                                 <?php echo !empty($employeeInfo->account_number) ? $employeeInfo->account_number : 'NOT SET' ?>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php
         $period = 'This month';
         $salary = intval($salaryEarning);
         $accessible_loan_percentage = 0.4;
         $accessible_loan_value = $salary * $accessible_loan_percentage;

         // Loan calculation
         $loan_received = 3000;
         $loan_balance = $accessible_loan_value - $loan_received;
         $take_home = $salary - $loan_received;

         // Percentage Difference 

         $loan_received_percentage = ($loan_received / $accessible_loan_value) * 100;
         $loan_balance_percentage = ($loan_balance / $accessible_loan_value) * 100;
         $take_home_percentage = ($take_home / $salary) * 100;
         ?>

         <div class="tab-pane fade" id="emp_loan">
            <div class="row">
               <div class="col-md-4">
                  <div class="card-group m-b-30">
                     <div class="card">
                        <div class="card-body">
                           <div>
                              <p><i class="fa fa-dot-circle-o text-purple me-2"></i>Current Salary <span class="float-end"><?php echo number_format($salary, 2) ?></span></p>
                              <p><i class="fa fa-dot-circle-o text-warning me-2"></i>Accessible loan(In %) <span class="float-end"><?php echo $accessible_loan_percentage * 100 ?>%</span></p>
                              <p><i class="fa fa-dot-circle-o text-success me-2"></i>Accessible loan(In ₦) <span class="float-end"><?php echo $currency . " " . number_format($accessible_loan_value, 2); ?></span></p>
                              <!-- <p><i class="fa fa-dot-circle-o text-danger me-2"></i>Pending Tasks <span class="float-end">47</span></p> -->
                              <!-- <p class="mb-0"><i class="fa fa-dot-circle-o text-info me-2"></i>Review Tasks <span class="float-end">5</span></p> -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-md-8">
                  <div class="card-group m-b-30">
                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex justify-content-between mb-3">
                              <div>
                                 <span class="d-block">Loan received</span>
                              </div>
                              <div>
                                 <span class="text-success"><?php echo $loan_received_percentage ?>%</span>
                              </div>
                           </div>
                           <h3 class="mb-3"><?php echo $currency . " " . number_format($loan_received, 2) ?></h3>
                           <div class="progress mb-2" style="height: 5px;">
                              <div class="progress-bar bg-secondary d-none" role="progressbar" style="width: 100%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <p class="mb-0 text-muted"><?php echo $period; ?></p>
                        </div>
                     </div>

                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex justify-content-between mb-3">
                              <div>
                                 <span class="d-block">Loan Balance</span>
                              </div>
                              <div>
                                 <span class="text-danger"><?php echo $loan_balance_percentage; ?>%</span>
                              </div>
                           </div>
                           <h3 class="mb-3"><?php echo $currency . " " . number_format($loan_balance, 2) ?></h3>
                           <div class="progress mb-2" style="height: 5px;">
                              <div class="progress-bar bg-secondary d-none" role="progressbar" style="width: 100%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <p class="mb-0 text-muted"><?php echo $period; ?></p>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex justify-content-between mb-3">
                              <div>
                                 <span class="d-block">Current take home</span>
                              </div>
                              <div>
                                 <span class="text-danger"><?php echo $take_home_percentage; ?>%</span>
                              </div>
                           </div>
                           <h3 class="mb-3"><?php echo $currency . " " . number_format($take_home, 2) ?></h3>
                           <div class="progress mb-2" style="height: 5px;">
                              <div class="progress-bar bg-secondary d-none" role="progressbar" style="width: 100%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <p class="mb-0 text-muted"><?php echo $period; ?></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">


               <div class="col-md-6 d-flex">
                  <div class="card card-table flex-fill">
                     <div class="card-header">
                        <h3 class="card-title mb-0">Loan Request</h3>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive table-wrap p-2">
                           <table class="table table-nowrap custom-table mb-0 ">
                              <thead>
                                 <tr>
                                    <th>Invoice ID</th>
                                    <th>Client</th>
                                    <th>Due Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><a href="invoice-view.html">#INV-0001</a></td>
                                    <td>
                                       <h2><a href="#">Global Technologies</a></h2>
                                    </td>
                                    <td>11 Mar 2019</td>
                                    <td>$380</td>
                                    <td>
                                       <span class="badge bg-inverse-warning">Partially Paid</span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><a href="invoice-view.html">#INV-0002</a></td>
                                    <td>
                                       <h2><a href="#">Delta Infotech</a></h2>
                                    </td>
                                    <td>8 Feb 2019</td>
                                    <td>$500</td>
                                    <td>
                                       <span class="badge bg-inverse-success">Paid</span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><a href="invoice-view.html">#INV-0003</a></td>
                                    <td>
                                       <h2><a href="#">Cream Inc</a></h2>
                                    </td>
                                    <td>23 Jan 2019</td>
                                    <td>$60</td>
                                    <td>
                                       <span class="badge bg-inverse-danger">Unpaid</span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><a href="invoice-view.html">#INV-0003</a></td>
                                    <td>
                                       <h2><a href="#">Cream Inc</a></h2>
                                    </td>
                                    <td>23 Jan 2019</td>
                                    <td>$60</td>
                                    <td>
                                       <span class="badge bg-inverse-danger">Unpaid</span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><a href="invoice-view.html">#INV-0003</a></td>
                                    <td>
                                       <h2><a href="#">Cream Inc</a></h2>
                                    </td>
                                    <td>23 Jan 2019</td>
                                    <td>$60</td>
                                    <td>
                                       <span class="badge bg-inverse-danger">Unpaid</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="card-footer">
                        <a href="invoices.html">View all invoices</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 d-flex">
                  <div class="card card-table flex-fill">
                     <div class="card-header">
                        <h3 class="card-title mb-0">loan received</h3>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive table-wrap p-2">
                           <table class="table table-nowrap custom-table mb-0">
                              <thead>
                                 <tr>
                                    <th>Ref ID</th>
                                    <th>Client</th>
                                    <th>Payment Type</th>
                                    <th>Paid Date</th>
                                    <th>Paid Amount</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><a href="invoice-view.html">#INV-0001</a></td>
                                    <td>
                                       <h2><a href="#">Global Technologies</a></h2>
                                    </td>
                                    <td>Paypal</td>
                                    <td>11 Mar 2019</td>
                                    <td>$380</td>
                                 </tr>
                                 <tr>
                                    <td><a href="invoice-view.html">#INV-0002</a></td>
                                    <td>
                                       <h2><a href="#">Delta Infotech</a></h2>
                                    </td>
                                    <td>Paypal</td>
                                    <td>8 Feb 2019</td>
                                    <td>$500</td>
                                 </tr>
                                 <tr>
                                    <td><a href="invoice-view.html">#INV-0003</a></td>
                                    <td>
                                       <h2><a href="#">Cream Inc</a></h2>
                                    </td>
                                    <td>Paypal</td>
                                    <td>23 Jan 2019</td>
                                    <td>$60</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="card-footer">
                        <a href="payments.html">View all payments</a>
                     </div>
                  </div>
               </div>
            </div>

         </div>
         <div class="tab-pane fade" id="bank_statutory">
            <div class="card">
               <div class="card-body">
                  <h3 class="card-title"> Basic Salary Information</h3>
                  <form>
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Salary basis <span class="text-danger">*</span></label>
                              <select class="select">
                                 <option>Select salary basis type</option>
                                 <option>Hourly</option>
                                 <option>Daily</option>
                                 <option>Weekly</option>
                                 <option>Monthly</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Salary amount <small class="text-muted">per month</small></label>
                              <div class="input-group">
                                 <span class="input-group-text">$</span>
                                 <input type="text" class="form-control" placeholder="Type your salary amount" value="0.00">
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Payment type</label>
                              <select class="select">
                                 <option>Select payment type</option>
                                 <option>Bank transfer</option>
                                 <option>Check</option>
                                 <option>Cash</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <hr>
                     <h3 class="card-title"> PF Information</h3>
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">PF contribution</label>
                              <select class="select">
                                 <option>Select PF contribution</option>
                                 <option>Yes</option>
                                 <option>No</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">PF No. <span class="text-danger">*</span></label>
                              <select class="select">
                                 <option>Select PF contribution</option>
                                 <option>Yes</option>
                                 <option>No</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Employee PF rate</label>
                              <select class="select">
                                 <option>Select PF contribution</option>
                                 <option>Yes</option>
                                 <option>No</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                              <select class="select">
                                 <option>Select additional rate</option>
                                 <option>0%</option>
                                 <option>1%</option>
                                 <option>2%</option>
                                 <option>3%</option>
                                 <option>4%</option>
                                 <option>5%</option>
                                 <option>6%</option>
                                 <option>7%</option>
                                 <option>8%</option>
                                 <option>9%</option>
                                 <option>10%</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Total rate</label>
                              <input type="text" class="form-control" placeholder="N/A" value="11%">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Employee PF rate</label>
                              <select class="select">
                                 <option>Select PF contribution</option>
                                 <option>Yes</option>
                                 <option>No</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                              <select class="select">
                                 <option>Select additional rate</option>
                                 <option>0%</option>
                                 <option>1%</option>
                                 <option>2%</option>
                                 <option>3%</option>
                                 <option>4%</option>
                                 <option>5%</option>
                                 <option>6%</option>
                                 <option>7%</option>
                                 <option>8%</option>
                                 <option>9%</option>
                                 <option>10%</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Total rate</label>
                              <input type="text" class="form-control" placeholder="N/A" value="11%">
                           </div>
                        </div>
                     </div>
                     <hr>
                     <h3 class="card-title"> ESI Information</h3>
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">ESI contribution</label>
                              <select class="select">
                                 <option>Select ESI contribution</option>
                                 <option>Yes</option>
                                 <option>No</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">ESI No. <span class="text-danger">*</span></label>
                              <select class="select">
                                 <option>Select ESI contribution</option>
                                 <option>Yes</option>
                                 <option>No</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Employee ESI rate</label>
                              <select class="select">
                                 <option>Select ESI contribution</option>
                                 <option>Yes</option>
                                 <option>No</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                              <select class="select">
                                 <option>Select additional rate</option>
                                 <option>0%</option>
                                 <option>1%</option>
                                 <option>2%</option>
                                 <option>3%</option>
                                 <option>4%</option>
                                 <option>5%</option>
                                 <option>6%</option>
                                 <option>7%</option>
                                 <option>8%</option>
                                 <option>9%</option>
                                 <option>10%</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-form-label">Total rate</label>
                              <input type="text" class="form-control" placeholder="N/A" value="11%">
                           </div>
                        </div>
                     </div>
                     <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Save</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>

<?php include('./inc/modal/all.php');  ?>

<?php include(SHARED_PATH . '/admin_footer.php');  ?>


<script type="text/javascript">
   $(document).ready(function() {

      const EMPLOYEE_URL = "inc/employee_script.php";
      const MORE_URL = "inc/form_fields.php";

      const employeeForm = document.getElementById("add_employee_form");
      const bankForm = document.getElementById("add_bank_form");
      const personalInfoForm = document.getElementById("add_personal_form");
      const kinForm = document.getElementById("add_kin_form");
      const educationForm = document.getElementById("add_education_form");
      const experienceForm = document.getElementById("add_experience_form");

      const message = (req, res) => {
         swal(req + "!", res, {
            icon: req,
            buttons: {
               confirm: {
                  className: (req == 'error') ? 'btn btn-danger' : 'btn btn-success'
               }
            }
         }).then(() => location.reload())
      }

      const deleted = async (url) => {
         swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to reverse this!',
            icon: 'warning',
            buttons: {
               confirm: {
                  text: 'Yes, delete it!',
                  className: 'btn btn-danger'
               },
               cancel: {
                  visible: true,
                  className: 'btn btn-secondary'
               }
            }
         }).then(Delete => {
            if (Delete) {
               fetch(url)
                  .then(response => response.json()).then(data => {
                     swal({
                        title: 'Deleted!',
                        text: data.message,
                        icon: 'success',
                        buttons: {
                           confirm: {
                              className: 'btn btn-success'
                           }
                        }
                     }).then(() => location.reload());
                  })
            } else {
               swal.close();
            }
         })
      };

      const submitForm = async (url, payload) => {
         const formData = new FormData(payload);
         formData.append("update", 1);

         const data = await fetch(url, {
            method: "POST",
            body: formData,
         });

         const response = await data.json();

         if (response.errors) {
            message('error', response.errors)
         }

         if (response.message) {
            message('success', response.message)
         }
      };


      employeeForm.addEventListener("submit", (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, employeeForm);
      });

      bankForm.addEventListener("submit", (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, bankForm);
      });

      personalInfoForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, personalInfoForm);
      });

      kinForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, kinForm);
      });

      educationForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, educationForm);
      });


      // ? EXPERIENCE

      experienceForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, experienceForm);
      });


      $('#add_education_form').on('click', '#add_edu', addMoreFields);
      $('#add_experience_form').on('click', '#add_exp', addMoreExpFields);

      async function addMoreFields() {
         let data = await fetch(MORE_URL + "?get_more_education");
         let response = await data.text();
         $('#more_education').append(response);
      }
      async function addMoreExpFields() {
         let data = await fetch(MORE_URL + "?get_more_experience");
         let response = await data.text();
         $('#more_experience').append(response);
      }

      $(document).on('click', '#removeEdu', function() {
         $(this).closest('#inputEdu').remove();
      });
      $(document).on('click', '#removeExp', function() {
         $(this).closest('#inputExp').remove();
      });

      $(document).on('click', '.delEdu', function() {
         let educationId = this.dataset.id;
         deleted(EMPLOYEE_URL + '?educationId=' + educationId + '&deleteEducation=1');
      });
      $(document).on('click', '.delExp', function() {
         let experienceId = this.dataset.id;
         deleted(EMPLOYEE_URL + '?experienceId=' + experienceId + '&deleteExperience=1');
      });

   });
</script>