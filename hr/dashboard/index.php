<?php
require_once('../private/initialize.php');

$id = $loggedInAdmin->id;
// $employee = Employee::find_by_id($id);

/* ----------------------------------- //? ATTENDANCE ---------------------------------- */
$attendance = EmployeeAttendance::find_by_employee_id($id, ['clock_in' => date('Y-m-d')]);
$isClockedIn =  isset($attendance->clock_in) && $attendance->clock_in != '00:00:00' ? true : false;

$lastDate = date('Y-m', strtotime('last month'));
$thisDate = date('Y-m');

$salaryAdvance = SalaryAdvance::find_by_total_salary_advance_amount(['current' => $thisDate]);
$advanceApproval = SalaryAdvanceDetail::find_by_loan_approved(['status' => 1, 'current' => $thisDate]);

$longTerm = LongTermLoan::find_by_total_long_term_amount(['current' => $thisDate]);
$loanApproval = LongTermLoanDetail::find_by_loan_approved(['status' => 1, 'current' => $thisDate]);

$totalLoanRequest = intval($longTerm->counts) + intval($salaryAdvance->counts);
$totalLoanValue = intval($longTerm->total_amount) + intval($salaryAdvance->total_amount);

if ($salaryAdvance->status == 1) {
   $totalLoanApproved = intval($loanApproval->counts) + intval($advanceApproval->counts);
}

$lastMonthSalary = Payroll::find_by_salary_payable(['month' => $lastDate, 'payment_status' => 1,]);
$thisMonthSalary = Payroll::find_by_salary_payable(['month' => $thisDate]);

$salaryPayable       = Employee::find_by_total_salary();
$lastMonthSalaryPaid = intval($lastMonthSalary->present_salary) - intval($lastMonthSalary->salary_advance);
$thisMonthSalaryPaid = intval($thisMonthSalary->present_salary) - intval($thisMonthSalary->salary_advance);

// pre_r($totalLoanValue);

$page = 'Dashboard';
$page_title = 'HR Dashboard';
include(SHARED_PATH . '/header.php');
$datatable = '';
$showTable = 0;

$tax_payable = Payroll::sum_of_tax_payable();
$pension_payable = Payroll::sum_of_pension_payable();
$employee = Employee::find_by_undeleted();
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">HR<span class="font-weight-normal text-muted ms-2">Dashboard</span></h4>
   </div>
   <div class="page-rightheader ms-md-auto d-none">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="d-flex">
            <div class="header-datepicker me-3">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <div class="input-group-text"> <i class="feather feather-calendar"></i> </div>
                  </div>
                  <input class="form-control fc-datepicker hasDatepicker" placeholder="19 Feb 2020" type="text" id="dp1642257195663">
               </div>
            </div>
            <div class="header-datepicker me-3">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <div class="input-group-text"> <i class="feather feather-clock"></i> </div>
                  </div>
                  <input id="tpBasic" type="text" placeholder="09:30am" class="form-control input-small ui-timepicker-input" autocomplete="off">
               </div>
            </div>
         </div>
         <div class="d-lg-flex d-block">
            <div class="btn-list">
               <?php if (!$isClockedIn) : ?>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#clock_in_modal">
                     Clock In</button>
               <?php else : ?>
                  <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#clock_in_modal" <?php echo isset($attendance->clock_out) && $attendance->clock_out != '00:00:00' ? 'disabled' : '' ?>>
                     Clock Out</button>
               <?php endif; ?>
               <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button>
               <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button>
               <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-xl-12 col-md-12 col-lg-12">
      <div class="row">
         <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card">
               <div class="card-body">
                  <a href="<?php echo url_for('payroll/hr-empsalary.php?q=not set') ?>">
                     <div class="row">
                        <div class="col-9">
                           <div class="mt-0 text-start">
                              <span class="fs-14 font-weight-semibold">Total Salary Payable</span>
                              <h4 class="mb-0 mt-1 mb-2"><?php echo number_format($salaryPayable->total_salary, 2) ?></h4>
                              <span class="text-muted">
                                 <span class="text-purple fs-12 mt-2 me-1">
                                    <i class="feather feather-arrow-up-right me-1 bg-purple-transparent p-1 brround"></i>
                                    <?php echo $salaryPayable->counts; ?> Employees</span> <br> General
                              </span>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="icon1 bg-purple my-auto  float-end"><?php echo $currency ?></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card">
               <div class="card-body">
                  <a href="<?php echo url_for('payroll/payroll.php?q=' . date('Y-m', strtotime($lastDate))) ?>">
                     <div class="row">
                        <div class="col-9">
                           <div class="mt-0 text-start">
                              <span class="fs-14 font-weight-semibold">Total Salary Paid</span>
                              <h4 class="mb-0 mt-1 mb-2"><?php echo number_format($lastMonthSalaryPaid, 2) ?></h4>
                              <span class="text-muted">
                                 <span class="text-success fs-12 mt-2 me-1">
                                    <i class="feather feather-arrow-up-right me-1 bg-success-transparent p-1 brround"></i>
                                    <?php echo $lastMonthSalary->counts ?> Employees</span> <br> last month
                              </span>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="icon1 bg-success my-auto  float-end"><?php echo $currency ?></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-9">
                        <div class="mt-0 text-start">
                           <span class="fs-14 font-weight-semibold">Total Loan Request</span>
                           <h4 class="mb-0 mt-1 mb-2"><?php echo $totalLoanValue ? number_format($totalLoanValue) : '0.00'; ?></h4>
                           <span class="text-muted">
                              <span class="text-danger fs-12 mt-2 me-1">
                                 <i class="feather feather-arrow-down-left me-1 bg-danger-transparent p-1 brround"></i>
                                 <?php echo $totalLoanRequest; ?> Employees</span> <br> this month </span>
                        </div>
                     </div>
                     <div class="col-3">
                        <div class="icon1 bg-danger my-auto  float-end"> <?php echo $currency ?> </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-xl-3 col-lg-12 col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-9">
                        <div class="mt-0 text-start">
                           <span class="fs-14 font-weight-semibold">Total Loan Approved</span>
                           <h4 class="mb-0 mt-1  mb-2"><?php echo $totalLoanApproved ?? '0.00' ?></h4>
                        </div>
                        <span class="text-muted">
                           <span class="text-secondary fs-12 mt-2 me-1">
                              <i class="feather feather-arrow-up-right me-1 bg-secondary-transparent p-1 brround"></i>
                              <?php echo $totalLoanApproved ?? 0 ?> Employees
                           </span> <br> this month </span>
                     </div>
                     <div class="col-3">
                        <div class="icon1 bg-secondary brround my-auto  float-end"><?php echo $currency ?></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-xl-6 col-lg-12 col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-9">
                        <div class="mt-0 text-start">
                           <span class="fs-14 font-weight-semibold">Sum of Tax Payable</span>
                           <h4 class="mb-0 mt-1  mb-2"><?php echo number_format($tax_payable, 2) ?? '0.00' ?></h4>
                        </div>
                        <span class="text-muted">
                           <span class="text-dark fs-12 mt-2 me-1">
                              <i class="feather feather-arrow-up-right me-1 bg-dark-transparent p-1 brround"></i>
                              <?php echo count($employee) ?? 0 ?> Employees
                           </span>
                        </span>
                     </div>
                     <div class="col-3">
                        <div class="icon1 bg-dark brround my-auto  float-end"><?php echo $currency ?></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-xl-6 col-lg-12 col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-9">
                        <div class="mt-0 text-start">
                           <span class="fs-14 font-weight-semibold">Sum of Employee Pension Contribution</span>
                           <h4 class="mb-0 mt-1  mb-2"><?php echo number_format($pension_payable, 2) ?? '0.00' ?></h4>
                        </div>
                        <span class="text-muted">
                           <span class="text-primary fs-12 mt-2 me-1">
                              <i class="feather feather-arrow-up-right me-1 bg-primary-transparent p-1 brround"></i>
                              <?php echo count($employee) ?? 0 ?> Employees
                           </span>
                        </span>
                     </div>
                     <div class="col-3">
                        <div class="icon1 bg-primary brround my-auto  float-end"><?php echo $currency ?></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>




         <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">

               <div class="card-body">
                  <div class="table-responsive company-table">
                     <div id="company-list_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                        <div class="row">
                           <div class="col-sm-12">
                              <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="company-list" role="grid" aria-describedby="company-list_info">
                                 <thead>
                                    <tr role="row">
                                       <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="SN" style="width: 27.8958px;">SN</th>
                                       <th class="border-bottom-0 sorting" tabindex="0" aria-controls="company-list" rowspan="1" colspan="1" aria-label="Company Name: activate to sort column ascending" style="width: 270.083px;">Company Name</th>
                                       <th class="border-bottom-0 sorting" tabindex="0" aria-controls="company-list" rowspan="1" colspan="1" aria-label="Units: activate to sort column ascending" style="width: 203.542px;">Units</th>
                                       <th class="border-bottom-0 sorting" tabindex="0" aria-controls="company-list" rowspan="1" colspan="4" aria-label="Branch Name: activate to sort column ascending" style="width: 287.625px;">Branch Name</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $companies = Company::find_by_undeleted(['order' => 'ASC']);
                                    $sn = 1;
                                    foreach ($companies as $key => $value) {
                                       $branch = Branch::find_by_company_name($value->company_name);
                                       $employee = Employee::find_by_company_name($value->company_name);
                                       $class = $key % 2 == 0 ? 'even' : 'odd';
                                    ?>
                                       <tr>
                                          <td><?php echo $sn++ ?></td>
                                          <td>
                                             <a href="#" class="d-flex sidebarmodal-collpase">
                                                <span class="avatar avatar-lg bg-transparent brround me-3" style="background-image: url(../../assets/images/files/company/avatar.png)"></span>
                                                <div class="mt-0 mt-sm-4 d-block">
                                                   <h6 class="mb-0 fs-16"><?php echo $value->company_name ?></h6>
                                                </div>
                                             </a>
                                          </td>
                                          <td><?php echo count($branch) ?></td>
                                          <?php foreach ($branch as $b) { ?>
                                             <td> <span class=""><?php echo $b->branch_name ?></span> </td>
                                          <?php } ?>

                                       </tr>
                                    <?php } ?>
                                 </tbody>


                              </table>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>

   <div class="col-xl-3 col-md-12 col-lg-12 d-none">
      <div class="card overflow-hidden">
         <div class="card-header border-0">
            <h4 class="card-title">Notice Board</h4>
         </div>
         <div class="pt-2">
            <div class="list-group">
               <div class="list-group-item d-flex pt-3 pb-3 align-items-center border-0">
                  <div class="me-3 me-xs-0">
                     <div class="calendar-icon icons">
                        <div class="date_time bg-pink-transparent"> <span class="date">18</span> <span class="month">FEB</span> </div>
                     </div>
                  </div>
                  <div class="ms-1">
                     <div class="h5 fs-14 mb-1">Board meeting Completed</div>
                     <small class="text-muted">attend the company mangers...</small>
                  </div>
               </div>
               <div class="list-group-item d-flex pt-3 pb-3 align-items-center border-0">
                  <div class="me-3 me-xs-0">
                     <div class="calendar-icon icons">
                        <div class="date_time bg-success-transparent "> <span class="date">16</span> <span class="month">FEB</span> </div>
                     </div>
                  </div>
                  <div class="ms-1">
                     <div class="h5 fs-14 mb-1"><span class="font-weight-normal">Updated the Company</span> Policy</div>
                     <small class="text-muted">some changes &amp; add the terms &amp; conditions </small>
                  </div>
               </div>
               <div class="list-group-item d-flex pt-3 pb-3 align-items-center border-0">
                  <div class="me-3 me-xs-0">
                     <div class="calendar-icon icons">
                        <div class="date_time bg-orange-transparent "> <span class="date">17</span> <span class="month">FEB</span> </div>
                     </div>
                  </div>
                  <div class="ms-1">
                     <div class="h5 fs-14 mb-1">Office Timings Changed</div>
                     <small class="text-muted"> this effect after March 01st 9:00 Am To 5:00 Pm</small>
                  </div>
               </div>
               <div class="list-group-item d-flex pt-3 pb-5 align-items-center border-0">
                  <div class="me-3 me-xs-0">
                     <div class="calendar-icon icons">
                        <div class="date_time bg-info-transparent "> <span class="date">26</span> <span class="month">JAN</span> </div>
                     </div>
                  </div>
                  <div class="ms-1">
                     <div class="h5 fs-15 mb-1"> Republic Day Celebrated </div>
                     <small class="text-muted">participate the all employees </small>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="mb-4">
         <div class="card-header border-bottom-0 pt-2 ps-0">
            <h4 class="card-title">Upcomming Events</h4>
         </div>
         <ul class="vertical-scroll pt-4 " style="overflow-y: hidden; height: 344px;">
            <li class="item">
               <div class="card p-4 ">
                  <div class="d-flex">
                     <img src="../assets/images/users/16.jpg" alt="img" class="avatar avatar-md bradius me-3">
                     <div class="me-3 mt-0 mt-sm-1 d-block">
                        <h6 class="mb-1">Vanessa James</h6>
                        <span class="clearfix"></span> <small>Birthday on Feb 16</small>
                     </div>
                     <span class="avatar bg-primary ms-auto bradius mt-1"> <i class="feather feather-mail text-white"></i> </span>
                  </div>
               </div>
            </li>
            <li class="item">
               <div class="card p-4 ">
                  <div class="d-flex comming_events calendar-icon icons">
                     <span class="date_time bg-success-transparent bradius me-3"><span class="date fs-18">21</span> <span class="month fs-10">Feb</span> </span>
                     <div class="me-3 mt-0 mt-sm-1 d-block">
                        <h6 class="mb-1">Anniversary</h6>
                        <span class="clearfix"></span> <small>3rd Anniversary on 21st Feb</small>
                     </div>
                  </div>
               </div>
            </li>
            <li class="item">
               <div class="card p-4 ">
                  <div class="d-flex">
                     <img src="../assets/images/users/4.jpg" alt="img" class="avatar avatar-md bradius me-3">
                     <div class="me-3 mt-0 mt-sm-1 d-block">
                        <h6 class="mb-1">Faith Harris</h6>
                        <span class="clearfix"></span> <small>Smart Device Trade Show</small>
                     </div>
                  </div>
               </div>
            </li>
            <li class="item">
               <div class="card p-4 ">
                  <div class="d-flex comming_events calendar-icon icons">
                     <span class="date_time bg-pink-transparent bradius me-3"><span class="date fs-18">25</span> <span class="month fs-10">Mar</span> </span>
                     <div class="me-3 mt-0 mt-sm-1 d-block">
                        <h6 class="mb-1">Meeting</h6>
                        <span class="clearfix"></span> <small>It will be held in meeting room</small>
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </div>
   </div>


   <div class="col-xl-4 col-md-12 col-lg-12 d-none">
      <div class="card chart-donut1">
         <div class="card-header  border-0">
            <h4 class="card-title">Gender by Employees</h4>
         </div>
         <div class="card-body">
            <div id="employees" class="mx-auto apex-dount" style="min-height: 270.537px;"></div>
            <div class="sales-chart pt-5 pb-3 d-flex mx-auto text-center justify-content-center ">
               <div class="d-flex me-5"><span class="dot-label bg-primary me-2 my-auto"></span>Male</div>
               <div class="d-flex"><span class="dot-label bg-secondary  me-2 my-auto"></span>Female</div>
            </div>
            <div class="resize-triggers">
               <div class="expand-trigger">
                  <div style="width: 410px; height: 377px;"></div>
               </div>
               <div class="contract-trigger"></div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row d-none">
   <div class="col-xl-6 col-lg-12 col-md-12">
      <div class="card">
         <div class="card-header border-bottom-0">
            <h3 class="card-title">Recent Job Application</h3>
            <div class="card-options">
               <div class="dropdown">
                  <a href="#" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> See All <i class="feather feather-chevron-down"></i> </a>
                  <ul class="dropdown-menu dropdown-menu-end" role="menu">
                     <li><a href="#">Monthly</a></li>
                     <li><a href="#">Yearly</a></li>
                     <li><a href="#">Weekly</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="tab-menu-heading table_tabs mt-2 p-0 ">
            <div class="tabs-menu1">
               <!-- Tabs -->
               <ul class="nav panel-tabs">
                  <li class="ms-4"><a href="#tab5" data-bs-toggle="tab">Job Applications</a></li>
                  <li><a href="#tab6" class="active" data-bs-toggle="tab">Job Opening</a></li>
                  <li><a href="#tab7" data-bs-toggle="tab">Hired Candidates</a></li>
               </ul>
            </div>
         </div>
         <div class="panel-body tabs-menu-body table_tabs1 p-0 border-0">
            <div class="tab-content">
               <div class="tab-pane" id="tab5">
                  <div class="table-responsive recent_jobs pt-2 pb-2 ps-2 pe-2 card-body">
                     <table class="table mb-0 text-nowrap">
                        <tbody>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <img src="../assets/images/users/16.jpg" alt="img" class="avatar avatar-md brround me-3">
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                       <h6 class="mb-0">Faith Harris</h6>
                                       <div class="clearfix"></div>
                                       <small class="text-muted">UI designer</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">5 years</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mail" aria-label="Mail"><i class="feather feather-mail  text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </td>
                           </tr>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <img src="../assets/images/users/1.jpg" alt="img" class="avatar avatar-md brround me-3">
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                       <h6 class="mb-0">James Paige</h6>
                                       <div class="clearfix"></div>
                                       <small class="text-muted">UI designer</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">2 years</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>India</td>
                              <td class="text-end"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mail" aria-label="Mail"><i class="feather feather-mail  text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </td>
                           </tr>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <img src="../assets/images/users/4.jpg" alt="img" class="avatar avatar-md brround me-3">
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                       <h6 class="mb-0">Liam Miller</h6>
                                       <div class="clearfix"></div>
                                       <small>WireFrameing</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">1 years</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>Germany</td>
                              <td class="text-end"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mail" aria-label="Mail"><i class="feather feather-mail  text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </td>
                           </tr>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <img src="../assets/images/users/8.jpg" alt="img" class="avatar avatar-md brround me-3">
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                       <h6 class="mb-0">Kimberly Berry</h6>
                                       <div class="clearfix"></div>
                                       <small>Senior Prototyper</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">3 years</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mail" aria-label="Mail"><i class="feather feather-mail  text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </td>
                           </tr>
                           <tr>
                              <td>
                                 <div class="d-flex">
                                    <img src="../assets/images/users/9.jpg" alt="img" class="avatar avatar-md brround me-3">
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                       <h6 class="mb-0">Kimberly Berry</h6>
                                       <div class="clearfix"></div>
                                       <small>Senior Prototyper</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">3 years</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mail" aria-label="Mail"><i class="feather feather-mail  text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane active" id="tab6">
                  <div class="table-responsive recent_jobs pt-2 pb-2 ps-2 pe-2 card-body">
                     <table class="table mb-0 text-nowrap">
                        <tbody>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <div class="table_img brround bg-light me-3"> <span class="bg-light brround fs-12">UI/UX</span> </div>
                                    <div class="me-3 mt-3 d-block">
                                       <h6 class="mb-0 fs-13 font-weight-semibold">UI UX Designers</h6>
                                       <div class="clearfix"></div>
                                       <small class="text-muted">12 Dec 2020</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">4 vacancies</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns"><i class="feather feather-check text-primary"></i></a> <a href="#" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a> <a href="#" class="action-btns"><i class="feather feather-x text-danger"></i></a> </td>
                           </tr>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <div class="table_img brround bg-light me-3"> <img src="../assets/images/photos/html.png" alt="img" class=" bg-light brround"> </div>
                                    <div class="me-3 mt-3 d-block">
                                       <h6 class="mb-0 fs-13 font-weight-semibold">Experienced Html Developer</h6>
                                       <div class="clearfix"></div>
                                       <small class="text-muted">28 Nov 2020</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">2 vacancies</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns"><i class="feather feather-check text-primary"></i></a> <a href="#" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a> <a href="#" class="action-btns"><i class="feather feather-x text-danger"></i></a> </td>
                           </tr>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <div class="table_img brround bg-light me-3"> <img src="../assets/images/photos/jquery.png" alt="img" class=" bg-light brround"> </div>
                                    <div class="me-3 mt-3 d-block">
                                       <h6 class="mb-0 fs-13 font-weight-semibold">Experienced Jquery Developer</h6>
                                       <div class="clearfix"></div>
                                       <small>12 Nov 2020</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">1 vacancies</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns"><i class="feather feather-check text-primary"></i></a> <a href="#" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a> <a href="#" class="action-btns"><i class="feather feather-x text-danger"></i></a> </td>
                           </tr>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <div class="table_img brround bg-light me-3"> <img src="../assets/images/photos/vue.png" alt="img" class=" bg-light brround"> </div>
                                    <div class="me-3 mt-3 d-block">
                                       <h6 class="mb-0 fs-13 font-weight-semibold">Vue js Developer</h6>
                                       <div class="clearfix"></div>
                                       <small>24 Oct 2020</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">6 vacancies</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns"><i class="feather feather-check text-primary"></i></a> <a href="#" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a> <a href="#" class="action-btns"><i class="feather feather-x text-danger"></i></a> </td>
                           </tr>
                           <tr>
                              <td>
                                 <div class="d-flex">
                                    <div class="table_img brround bg-light me-3"> <img src="../assets/images/photos/html.png" alt="img" class=" bg-light brround"> </div>
                                    <div class="me-3 mt-3 d-block">
                                       <h6 class="mb-0 fs-13 font-weight-semibold">Kimberly Berry</h6>
                                       <div class="clearfix"></div>
                                       <small>14 Oct 2020</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">4 vacancies</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns"><i class="feather feather-check text-primary"></i></a> <a href="#" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a> <a href="#" class="action-btns"><i class="feather feather-x text-danger"></i></a> </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane " id="tab7">
                  <div class="table-responsive recent_jobs pt-2 pb-2 ps-2 pe-2 card-body">
                     <table class="table mb-0 text-nowrap">
                        <tbody>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <img src="../assets/images/users/16.jpg" alt="img" class="avatar avatar-md brround me-3">
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                       <h6 class="mb-0">Faith Harris</h6>
                                       <div class="clearfix"></div>
                                       <small class="text-muted">UI designer</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">5 years</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mail" aria-label="Mail"><i class="feather feather-mail  text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </td>
                           </tr>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <img src="../assets/images/users/1.jpg" alt="img" class="avatar avatar-md brround me-3">
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                       <h6 class="mb-0">James Paige</h6>
                                       <div class="clearfix"></div>
                                       <small class="text-muted">UI designer</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">2 years</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>India</td>
                              <td class="text-end"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mail" aria-label="Mail"><i class="feather feather-mail  text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </td>
                           </tr>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <img src="../assets/images/users/4.jpg" alt="img" class="avatar avatar-md brround me-3">
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                       <h6 class="mb-0">Liam Miller</h6>
                                       <div class="clearfix"></div>
                                       <small>WireFrameing</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">1 years</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>Germany</td>
                              <td class="text-end"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mail" aria-label="Mail"><i class="feather feather-mail  text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </td>
                           </tr>
                           <tr class="border-bottom">
                              <td>
                                 <div class="d-flex">
                                    <img src="../assets/images/users/8.jpg" alt="img" class="avatar avatar-md brround me-3">
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                       <h6 class="mb-0">Kimberly Berry</h6>
                                       <div class="clearfix"></div>
                                       <small>Senior Prototyper</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">3 years</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mail" aria-label="Mail"><i class="feather feather-mail  text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </td>
                           </tr>
                           <tr>
                              <td>
                                 <div class="d-flex">
                                    <img src="../assets/images/users/9.jpg" alt="img" class="avatar avatar-md brround me-3">
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                       <h6 class="mb-0">Kimberly Berry</h6>
                                       <div class="clearfix"></div>
                                       <small>Senior Prototyper</small>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-start fs-13">3 years</td>
                              <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                              <td class="text-end"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mail" aria-label="Mail"><i class="feather feather-mail  text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-xl-6 col-lg-12 col-md-12">
      <div class="card">
         <div class="card-header border-0">
            <h3 class="card-title">Attendance</h3>
            <div class="card-options ">
               <a href="#" class="btn btn-outline-light me-3">View All</a>
               <div class="dropdown">
                  <a href="#" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Date <i class="feather feather-chevron-down"></i> </a>
                  <ul class="dropdown-menu dropdown-menu-end" role="menu">
                     <li><a href="#">Monthly</a></li>
                     <li><a href="#">Yearly</a></li>
                     <li><a href="#">Weekly</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="table-responsive attendance_table mt-4 border-top">
            <table class="table mb-0 text-nowrap">
               <thead>
                  <tr>
                     <th class="text-center">S.No</th>
                     <th class="text-start">Employee</th>
                     <th class="text-center">Status</th>
                     <th class="text-center">CheckIn</th>
                     <th class="text-center">CheckOut</th>
                     <th class="text-center">Actions</th>
                  </tr>
               </thead>
               <tbody>
                  <tr class="border-bottom">
                     <td class="text-center"><span class="avatar avatar-sm brround">1</span></td>
                     <td class="font-weight-semibold fs-14">Diane Nolan</td>
                     <td class="text-center"><span class="badge bg-success-transparent">Present</span></td>
                     <td class="text-center">09:30 Am</td>
                     <td class="text-center">06:30 Pm</td>
                     <td class="text-center"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chat" aria-label="Chat"><i class="feather-message-circle  text-success"></i></a> </td>
                  </tr>
                  <tr class="border-bottom">
                     <td class="text-center"><span class="avatar avatar-sm brround">2</span></td>
                     <td class="font-weight-semibold fs-14">Deirdre Russell</td>
                     <td class="text-center"><span class="badge bg-success-transparent">Present</span></td>
                     <td class="text-center">09:45 Am</td>
                     <td class="text-center">06:30 Pm</td>
                     <td class="text-center"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chat" aria-label="Chat"><i class="feather-message-circle  text-success"></i></a> </td>
                  </tr>
                  <tr class="border-bottom">
                     <td class="text-center"><span class="avatar avatar-sm brround">3</span></td>
                     <td class="font-weight-semibold fs-14">Joanne Hills</td>
                     <td class="text-center"><span class="badge bg-danger-transparent">Absent</span></td>
                     <td class="text-center">00:00:00</td>
                     <td class="text-center">00:00:00</td>
                     <td class="text-center"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chat" aria-label="Chat"><i class="feather-message-circle  text-success"></i></a> </td>
                  </tr>
                  <tr class="border-bottom">
                     <td class="text-center"><span class="avatar avatar-sm brround">4</span></td>
                     <td class="font-weight-semibold fs-14">Luke Ince</td>
                     <td class="text-center"><span class="badge bg-success-transparent">Present</span></td>
                     <td class="text-center">09:30 Am</td>
                     <td class="text-center">05:15 Pm</td>
                     <td class="text-center"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chat" aria-label="Chat"><i class="feather-message-circle  text-success"></i></a> </td>
                  </tr>
                  <tr class="border-bottom">
                     <td class="text-center"><span class="avatar avatar-sm brround">5</span></td>
                     <td class="font-weight-semibold fs-14">Grace Mackay</td>
                     <td class="text-center"><span class="badge bg-danger-transparent">Absent</span></td>
                     <td class="text-center">00:00:00</td>
                     <td class="text-center">00:00:00</td>
                     <td class="text-center"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chat" aria-label="Chat"><i class="feather-message-circle  text-success"></i></a> </td>
                  </tr>
                  <tr class="border-bottom">
                     <td class="text-center"><span class="avatar avatar-sm brround">6</span></td>
                     <td class="font-weight-semibold fs-14">Wanda Quinn</td>
                     <td class="text-center"><span class="badge bg-success-transparent">Present</span></td>
                     <td class="text-center">09:30 Am</td>
                     <td class="text-center">06:30 Pm</td>
                     <td class="text-center"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chat" aria-label="Chat"><i class="feather-message-circle  text-success"></i></a> </td>
                  </tr>
                  <tr>
                     <td class="text-center"><span class="avatar avatar-sm brround">7</span></td>
                     <td class="font-weight-semibold fs-14">Liam</td>
                     <td class="text-center"><span class="badge bg-success-transparent">Present</span></td>
                     <td class="text-center">09:30 Am</td>
                     <td class="text-center">06:30 Pm</td>
                     <td class="text-center"> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Contact" aria-label="Contact"><i class="feather feather-phone-call text-primary"></i></a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chat" aria-label="Chat"><i class="feather-message-circle  text-success"></i></a> </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<?php if ($showTable == 1) { ?>
   <div class="table-responsive">
      <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-payroll" role="grid">

         <tbody id="get_payroll">
            <?php
            $sn = 1;
            $employee = Employee::find_all();
            foreach ($employee as $value) :

               $salary = intval($value->present_salary);
               $tax = Payroll::tax_calculator(['netSalary' => intval($salary)]);
               $monthly_tax = $tax['monthly_tax'];
               $pension = $tax['pension'];

            ?>
               <tr>
                  <td class="salary"><?php echo number_format($salary) ?></td>
                  <td class="monthly_tax"><?php echo  number_format($monthly_tax) ?></td>
                  <td class="pension"><?php echo  number_format($pension) ?></td>

               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
<?php } ?>
<?php include(SHARED_PATH . '/footer.php') ?>

<script type="text/javascript">
   $(function(e) {

      //________ Datepicker
      $(".fc-datepicker").datepicker({
         dateFormat: "dd MM yy",
         monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Maj", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec"]
      });

      //Input file-browser
      $(document).on('change', '.file-browserinput', function() {
         var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
         input.trigger('fileselect', [numFiles, label]);
      }); // We can watch for our custom `fileselect` event like this
      $(document).ready(function() {
         $('.file-browserinput').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
               log = numFiles > 1 ? numFiles + ' files selected' : label;
            if (input.length) {
               input.val(log);
            } else {
               if (log) alert(log);
            }
         });
      });


   });
</script>

<script src="<?php echo url_for('assets/js/index1.js') ?>"></script>