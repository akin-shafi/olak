<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payroll Items';
include(SHARED_PATH . '/header.php');
$datatable = '';
$select2 = '';

$isCompany = isset($_GET['q']) ? $_GET['q'] : false;

if (isset($_GET['q']) && $_GET['q'] == '') {
   $companies = Employee::find_by_company_name('aroma', ['company' => 'not set']);
}

$companies = Employee::find_by_company_name('aroma', ['company' => $isCompany]);

$totalSalary = Employee::find_by_company_total_salary();
?>


<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Employee Salary</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list mt-3 mt-lg-0">

            <button type="button" class="btn btn-primary me-3" id="addSalary">Add Salary</button>


            <button class="btn btn-light d-none" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button>

            <button class="btn btn-light d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-xl-12 col-md-12 col-lg-12">
      <div class="row">
         <?php foreach ($totalSalary as $key => $salary) :
            $companyQuery = $salary->company != '' ? $salary->company : 'not set';
         ?>

            <div class="col-xl-3 col-lg-6 col-md-12">
               <div class="card">
                  <div class="card-body">
                     <a href="<?php echo url_for('payroll/hr-empsalary.php?q=' . strtolower($companyQuery)) ?>">
                        <div class="row">
                           <div class="col-9">
                              <div class="mt-0 text-start">
                                 <span class="fs-16 font-weight-semibold">
                                    <?php echo $salary->company != '' ? ucwords($salary->company) : 'Company not set' ?></span>

                                 <h3 class="mb-0 mt-1 mb-2"><?php echo number_format($salary->total_salary, 2) ?></h3>
                                 <span class="text-muted">
                                    <span class="<?php echo Employee::TEXT_COLOR[$key] ?> fs-12 mt-2 me-1">
                                       <i class="feather feather-arrow-up-right me-1 <?php echo Employee::BG_COLOR[$key] . '-transparent' ?>  p-1 brround"></i>
                                       <?php echo $salary->counts ?> Employees</span>
                                 </span>
                              </div>
                           </div>
                           <div class="col-3">
                              <div class="icon1 <?php echo Employee::BG_COLOR[$key] ?> my-auto  float-end"><?php echo $currency ?></div>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
            </div>

         <?php endforeach ?>

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

<div class="row">
   <div class="col-md-12">
      <div class="card">

         <div class="card-body">
            <div class="table-responsive">
               <div id="hr-payroll_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-payroll" role="grid" aria-describedby="hr-payroll_xxinfo">
                           <thead>
                              <tr role="row">
                                 <th>SN</th>
                                 <th>Emp Name</th>
                                 <th>Company</th>
                                 <th>Job Title</th>
                                 <th>(₦) Salary</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $sn = 1;
                              foreach ($companies as $value) : ?>
                                 <tr>
                                    <td>#<?php echo $sn++ ?></td>
                                    <td>
                                       <div class="d-flex">
                                          <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
                                          <div class="me-3 mt-0 mt-sm-1 d-block">
                                             <h6 class="mb-1 fs-14"><?php echo $value->full_name() ?></h6>
                                             <p class="text-muted mb-0 fs-12"><?php echo strtolower($value->email) ?></p>
                                             <p class="text-muted mb-0 fs-12">Emp ID: <?php echo  str_pad($value->employee_id, 3, '0', STR_PAD_LEFT); ?></p>
                                          </div>
                                       </div>
                                    </td>
                                    <td><?php echo !empty($value->company) ? $value->company : 'Not Set' ?></td>
                                    <td><?php echo !empty($value->job_title) ? $value->job_title : 'Not Set' ?> </td>
                                    <td class="font-weight-semibold"><?php echo number_format(intval($value->present_salary), 2) ?></td>

                                    <td class="text-start">
                                       <a href="#" class="btn action-btns viewSalary" data-id="<?php echo $value->id ?>">
                                          <i class="feather feather-eye text-primary"></i> </a>
                                       <a href="#" class="btn action-btns" onclick="javascript:window.print();" data-bs-original-title="Print Salary Details">
                                          <i class="feather feather-printer text-success"></i> </a>
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
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


<div class="modal fade show" id="viewsalarymodal" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div id="fetchSalaryData"></div>

      </div>
   </div>
</div>

<div class="modal fade show" id="AddSalaryModal" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add Staff Salary</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div id="salaryField"></div>

               <div class="submit-section">
                  <button class="btn btn-primary submit-btn">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>

<script type="text/javascript">
   function fetch_data(emp_id = '') {
      $.ajax({
         url: 'inc/script.php',
         method: "POST",
         data: {
            fetch: 1,
            staff_id: emp_id,
         },
         success: function(r) {
            $("#salaryField").html(r)
         }
      })
   }

   $(document).on('click', '#addSalary', function(e) {
      $('#AddSalaryModal').modal('show');
      fetch_data();

   })

   $(document).on('click', '.viewSalary', function(e) {
      $('#viewsalarymodal').modal('show');
      var empId = $(this).data('id');
      fetchSalarydata(empId);

   })

   function fetchSalarydata(empId = '') {
      $.ajax({
         url: 'inc/salaryItem.php',
         method: "POST",
         data: {
            fetch: 1,
            empId: empId,
         },
         success: function(r) {
            $("#fetchSalaryData").html(r)
         }
      })
   }

   $(document).on('change', '#staff_id', function() {
      var selected = $(this).find('option:selected');
      var staff_id = $(this).val();
      var staff_salary = selected.data('salary');
      var emp_id = staff_id;
      fetch_data(emp_id);
   })
</script>