<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payroll Items';
include(SHARED_PATH . '/header.php');
$datatable = '';
$select2 = '';
?>



<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Salary</h4>
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
                              foreach (Employee::find_by_undeleted(['order' => 'ASC']) as $value) :
                                 // $empLoan = EmployeeLoan::find_by_employee_id($value->id);
                              ?>
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