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
                                 <!-- <th>Emp ID</th> -->
                                 <th>Emp Name</th>
                                 <th>Job Title</th>
                                 <th>(₦) Salary</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $sn = 1; foreach (Employee::find_by_undeleted(['order' => 'ASC']) as $value) :
                                 // $empLoan = EmployeeLoan::find_by_employee_id($value->id);
                              ?>
                                 <tr>
                                    <td>#<?php echo $sn++ ?></td>
                                    <!-- <td></td> -->
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
                                     <td>
                                       <?php echo !empty($value->job_title) ? $value->job_title : 'Not Set' ?>
                                    </td>
                                    <td class="font-weight-semibold"><?php echo number_format(intval($value->present_salary), 2) ?></td>
                                   
                                    
                                    <td class="text-start"> 
                                       <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View Salary Details" aria-label="View"></i> </a> 

                                       

                                       <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print Salary Details"> <i class="feather feather-printer text-success"></i> </a>
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
         <div class="modal-header">
            <h5 class="modal-title">PaySlip</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
         </div>
         <div class="modal-header">
            <div> <img src="<?php echo url_for('assets/images/brand/logo.png') ?>" class="header-brand-img" alt="Dayonelogo"> </div>
            <div class="ms-auto">
               <!-- <div class="font-weight-bold text-md-right mt-3">Date: 01-02-2021</div> -->
            </div>
         </div>
         <div class="modal-body pt-1">
            <div class="table-responsive mt-3 mb-3">
               <table class="table mb-0 modal-paytable">
                  <tbody>
                     <tr>
                        <td> <strong>Emp ID:</strong> <span>2987</span> </td>
                        <td class="text-end"> <strong>Emp Name:</strong> <span>Faith Harris</span> </td>
                     </tr>
                     <tr>
                        <td> <strong>Location:</strong> <span>Ilorin</span> </td>
                        <!-- <td class="text-end"> <strong>Pay Period:</strong> <span>January-2021</span> </td> -->
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="table-responsive mt-4">
               <table class="table text-nowrap mb-0 border">
                  <tbody>
                     <tr>
                        <td class="p-0">
                           <table class="table text-nowrap mb-0">
                              <thead>
                                 <tr>
                                    <th class="fs-18" rowspan="1" colspan="2">Earnings</th>
                                 </tr>
                                 <tr>
                                    <th>Pay Type</th>
                                    <th class="border-start">Amount(<?php echo $currency ?>)</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>Basic</td>
                                    <td class="border-start">32,000</td>
                                 </tr>
                                 <tr>
                                    <td>HRA</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr>
                                    <td>Medical Allowance</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr>
                                    <td>Bonus Allowance</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr class="border-top">
                                    <td class="font-weight-semibold">Total Earnings</td>
                                    <td class="font-weight-semibold border-start">32,000</td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                        <td class="p-0">
                           <table class="table text-nowrap mb-0 border-start">
                              <thead>
                                 <tr>
                                    <th class="fs-18" rowspan="1" colspan="2">Deduction</th>
                                 </tr>
                                 <tr>
                                    <th>Pay Type</th>
                                    <th class="border-start">Amount</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>PF</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr>
                                    <td>Professional Tax</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr>
                                    <td>TDS</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr>
                                    <td>Loans &amp; Others</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr class="border-top">
                                    <td class="font-weight-semibold">Total Deduction</td>
                                    <td class="font-weight-semibold border-start">0.00</td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="mt-4 mb-3">
               <table class="table mb-0">
                  <tbody>
                     <tr>
                        <td class="font-weight-semibold w-20 fs-18 pb-0 pt-0">Net Salary</td>
                        <td class="pb-0 pt-0">
                           <h4 class="font-weight-semibold mb-0 fs-24"><?php echo $currency ?> 32,000</h4>
                        </td>
                     </tr>
                     <tr>
                        <td class="font-weight-semibold w-20 pb-0 pt-1 text-muted">InWords</td>
                        <td class="pb-0 pt-1">
                           <h5 class="mb-0  text-muted">Thirty-Two Thousand only</h5>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="p-5 border-top text-center">
            <div class="text-center">
               <h6 class="mb-2">Integrated Olak Group.</h6>
               <p class="mb-1 fs-12">Adress</p>
               <div> <small>Tel No: +234 66904 8599,</small> <small>Email: info@olakgroups.com</small> </div>
            </div>
         </div>
         <div class="modal-footer">
            <div class="ms-auto"> 
               <a href="#" class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> Print</a> 
               <!-- <a href="#" class="btn btn-success"><i class="feather feather-download"></i> Download</a>  -->
               <!-- <a href="#" class="btn btn-primary"><i class="si si-paper-plane"></i> Send</a>  -->
               <a href="#" class="btn btn-danger" data-bs-dismiss="modal"><i class="feather feather-x"></i> Close</a> </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade show" id="AddSalaryModal" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
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
   function fetch_data(emp_id='') {
      $.ajax({
         url: 'inc/script.php',
         method:"POST",
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
  
  $(document).on('change', '#staff_id', function(){
      var selected = $(this).find('option:selected');
      var staff_id = $(this).val();
      var staff_salary = selected.data('salary');
      var emp_id = staff_id;
      fetch_data(emp_id);

   })
   
</script>












