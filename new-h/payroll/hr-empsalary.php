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

// $totalSalaryByCompany = Employee::find_by_company_total_salary();
$totalSalaryByBranch = Employee::find_by_company_total_salary($isCompany, ['branch' => true]);

// pre_r($totalSalaryByBranch);
?>

<style>
   #analytic .card:hover {
      background-color: #063bb3;
      color: red;
   }

   #analytic .card:hover span {
      color: #FFF !important;
   }

   #analytic .card:hover h4 {
      color: #FFF !important;
   }

   .current {
      background-color: #063bb3;
   }

   .current span,
   .current h4 {
      color: #FFF !important;
   }
</style>
<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Employee Salary</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list mt-3 mt-lg-0">

            <button type="button" class="btn btn-primary me-3 d-none" id="addSalary">Add Salary</button>


            <button class="btn btn-light d-none" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button>

            <button class="btn btn-light d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
         </div>
      </div>
   </div>
</div>

<div class="row" id="analytic">
   <div class="col-xl-12 col-md-12 col-lg-12">
      <div class="row">
         <?php foreach (Company::find_all_company() as $key => $value) :
            $companyName = !empty($value->company_name) ? $value->company_name : 'not set';

            $totalSalaryByCompany = Employee::find_by_company_total_salary(strtolower($companyName));
            $companyQuery = $totalSalaryByCompany->company != '' ? $totalSalaryByCompany->company : 'not set'; ?>

            <div class="col-xl-3 col-lg-6 col-md-12">
               <div class="card <?php echo strtolower($isCompany) == strtolower($companyQuery) ? 'current' : '' ?>">
                  <div class="card-body">
                     <a href="<?php echo url_for('payroll/hr-empsalary.php?q=' . strtolower($companyQuery)) ?>" class="<?php echo strtolower($isCompany) == strtolower($companyQuery) ? 'active-card-link' : '' ?>">
                        <div class="row">
                           <div class="col-9">
                              <div class="mt-0 text-start">
                                 <span class="fs-16 font-weight-semibold">
                                    <?php echo $totalSalaryByCompany->company != '' ? ucwords($companyName) : 'Company not set' ?></span>

                                 <h4 class="mb-0 mt-1 mb-2"><?php echo number_format($totalSalaryByCompany->total_salary, 2) ?></h4>
                                 <span class="text-muted">
                                    <span class="<?php echo strtolower($isCompany) == strtolower($companyQuery) ? 'text-white' : Employee::TEXT_COLOR[$key] ?> fs-12 mt-2 me-1">
                                       <i class="feather feather-arrow-up-right me-1 <?php echo Employee::BG_COLOR[$key] . '-transparent' ?>  p-1 brround"></i>
                                       <?php echo $totalSalaryByCompany->counts ?> Employees</span>
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
               </a>
            </div>

         <?php endforeach ?>

      </div>
   </div>

</div>

<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header border-0 responsive-header">
            <h4 class="card-title"><?php echo !empty($companies[0]->company) ? $companies[0]->company : 'Company Not Set'; ?></h4>
         </div>

         <div class="card-body">
            <div class="row">
               <?php foreach ($totalSalaryByBranch as $key => $value) : ?>
                  <div class="col-xl-3 col-lg-3 col-md-12">
                     <div class="card shadow">
                        <div class="card-body p-3">
                           <!-- <a href="<?php //echo url_for('payroll/hr-empsalary.php?q=' . strtolower($companyQuery)) 
                                          ?>"> -->
                           <div class="row">
                              <div class="col-9">
                                 <div class="mt-0">
                                    <span class="fs-14 font-weight-bold">
                                       <?php echo $value->branch != '' ? ucwords($value->branch) : 'Branch not set' ?></span>

                                    <h6 class="mb-0 mt-1 mb-2"><?php echo number_format($value->total_salary, 2) ?></h6>
                                    <span class="<?php echo Employee::TEXT_COLOR[$key] ?> fs-12 mt-2 me-1">
                                       <i class="feather feather-arrow-up-right me-1 <?php echo Employee::BG_COLOR[$key] . '-transparent' ?>  p-1 brround"></i>
                                       <?php echo $value->counts ?> Employees</span>
                                 </div>
                              </div>
                              <div class="col-3">
                                 <div class="icon1 <?php echo Employee::BG_COLOR[$key] ?> my-auto  float-end"><?php echo $currency ?></div>
                              </div>
                           </div>
                           <!-- </a> -->
                        </div>
                     </div>
                     </a>
                  </div>
               <?php endforeach; ?>
            </div>

            <div class="table-responsive">
               <div id="hr-payroll_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-payroll" role="grid" aria-describedby="hr-payroll_xxinfo">
                           <thead>
                              <tr role="row">
                                 <th>SN</th>
                                 <th>Emp Name</th>
                                 <th>Department</th>
                                 <th>Job Title</th>
                                 <th>(₦) Salary</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $sn = 1;
                              foreach ($companies as $value) :

                              ?>
                                 <tr>
                                    <td>#<?php echo $sn++ ?></td>
                                    <td>
                                       <div class="d-flex">
                                          <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
                                          <div class="me-3 mt-0 mt-sm-1 d-block">
                                             <a href="<?php echo url_for('employees/hr-empview.php?id=' . $value->id) ?>">
                                                <h6 class="mb-1 fs-14"><?php echo $value->full_name() ?></h6>
                                                <p class="text-muted mb-0 fs-12"><?php echo strtolower($value->email) ?></p>
                                                <p class="text-muted mb-0 fs-12">Emp ID: <?php echo  str_pad($value->employee_id, 3, '0', STR_PAD_LEFT); ?></p>
                                             </a>
                                          </div>
                                       </div>
                                    </td>
                                    <td><?php echo !empty($value->department) ? $value->department : 'Not Set' ?></td>
                                    <td><?php echo !empty($value->job_title) ? $value->job_title : 'Not Set' ?> </td>
                                    <td class="font-weight-semibold"><?php echo number_format(intval($value->present_salary), 2) ?></td>

                                    <td class="text-center">
                                       <a href="#" class="btn btn-outline-primary action-btns viewSalary" title="View Salary" data-id="<?php echo $value->id ?>">
                                          <i class="feather feather-eye "></i> </a>
                                       <a href="<?php echo url_for('employees/hr-editemp.php?id=' . $value->id) ?>" class="btn btn-outline-primary action-btns editStaffDetails" title="Edit Staff Details">
                                          <i class="feather feather-edit "></i> </a>
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
         method: "GET",
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