<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payroll';
include(SHARED_PATH . '/header.php');
$datatable = '';
$select2 = '';

$lastMonth = $_GET['q'] ?? '';
$thisMonth = date('Y-m');

$queryByMonth = $lastMonth ? $lastMonth : $thisMonth;
$employees = Employee::find_by_undeleted();
$payrolls = Payroll::find_by_created_at($queryByMonth);

// pre_r($queryByMonth);
$calculate_tax = 0;

$config = Configuration::find_by_process_salary(['process_salary' => 1, 'process_salary_date' => $queryByMonth]);
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Employee Salary</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <?php
         $config = Configuration::find_by_process_salary(['process_salary' => 1, 'process_salary_date' => $queryByMonth]);
         if ($config == true) : ?>
            <!-- <button class="btn btn-dark me-3" id="PaySlipDisabled">Payslip Generated</button> -->
            <a class="btn btn-secondary me-3" href="<?php echo url_for('payroll/exportData.php') ?>"> <i class="las la-file-excel"></i> Download Monthly Excel Report </a>
         <?php else : ?>
            <div id="generating">
               <button class="btn btn-primary me-3" id="genPaySlip">Compute Salary</button>
            </div>
         <?php endif ?>



         <button class="btn btn-light d-none" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button>

         <button class="btn btn-light d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <div class="row">
               <!-- <div class="col-xl-3 col-md-4 col-sm-12">
                  <div class="form-group">
                     <label class="form-label">Filter By Month:</label>
                     <input type="month" class="form-control" value="<?php //echo $queryByMonth; 
                                                                     ?>" name="by_date" id="byDate">
                  </div>
               </div> -->

               <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                     <label class="form-label">Month:</label>
                     <select class="form-control select2" id="byDate" data-placeholder="Select Month">
                        <option label="Select Month" data-select2-id="select2-data-55-moyh"></option>
                        <?php foreach (Payroll::MONTH as $key => $value) : ?>
                           <option value="<?php echo $key; ?>" <?php echo $key == date('m', strtotime($queryByMonth)) ? 'selected' : '' ?>>
                              <?php echo $value; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="hr-payroll_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-payroll" role="grid">
                           <thead>
                              <tr role="row">
                                 <th class="bg-white">#Emp ID</th>
                                 <th class="bg-white">#Emp Name</th>
                                 <th>(₦) Gross Salary</th>
                                 <?php if ($calculate_tax == 1) { ?>
                                    <th>(₦) Monthly Tax</th>
                                    <th>(₦) Pension</th>
                                 <?php } ?>
                                 
                                 <th>(₦) Salary Advance</th>
                                 <th>(₦) Loan</th>
                                 <th>(₦) Take Home</th>
                                 <th>Status</th>
                                 <th class="bg-white">Action</th>
                              </tr>
                           </thead>
                           <tbody id="get_payroll">
                              <?php
                              $sn = 1;
                              foreach ($payrolls as $value) :

                                 $empLoan = LongTermLoan::find_by_employee_id($value->employee_id);
                                 $salary_advance = SalaryAdvance::find_by_employee_id($value->employee_id);
                                 $employee = Employee::find_by_id($value->employee_id);
                                 $salary = intval($value->present_salary);
                                 $commitment = isset($empLoan->commitment) ? $empLoan->commitment : '0.00';

                                 $tax = Payroll::tax_calculator(['netSalary' => intval($salary)]);
                                 $monthly_tax = intval($tax['monthly_tax']);
                                 $pension = intval($tax['pension']);

                                 

                                 if ($calculate_tax == 1) {
                                    $take_home = intval($salary) - (intval($commitment) + intval($salary_advance->total_requested) + intval($monthly_tax) + intval($pension));
                                 }else{
                                    $take_home = $salary;
                                 }

                                 // 
                                 

                              ?>
                                 <tr>
                                    <td class="bg-white"><?php echo $sn++; ?></td>
                                    <td class="bg-white">
                                       <div class="d-flex">
                                          <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
                                          <div class="me-3 mt-0 mt-sm-1 d-block">
                                             <h6 class="mb-1 fs-14"><?php echo isset($employee->first_name) ? $employee->full_name() : 'Not Set' ?></h6>
                                             <p class="text-muted mb-0 fs-12">Emp ID: <?php echo isset($employee->employee_id) ? str_pad($employee->employee_id, 3, '0', STR_PAD_LEFT) : 'Not Set'; ?></p>
                                          </div>
                                       </div>
                                    </td>
                                    <td><?php echo number_format($salary) ?></td>
                                    <?php if ($calculate_tax == 1) { ?>
                                    <td><?php echo  number_format($monthly_tax) ?></td>
                                    <td><?php echo  number_format($pension) ?></td>
                                    <?php } ?>
                                    <td>
                                       <?php echo !empty($salary_advance->total_requested) ? number_format(intval($salary_advance->total_requested)) : '0.00' ?>
                                    </td>
                                    <td><?php echo !empty($commitment) ? number_format(intval($commitment)) : '0.00' ?></td>
                                    <td class="font-weight-semibold"><?php echo number_format($take_home) ?></td>
                                    <td>
                                       <span class="badge <?php echo $value->payment_status != 0 ? 'badge-success' : 'badge-danger' ?>">
                                          <?php echo $value->payment_status != 0 ? 'Paid' : 'Unpaid' ?></span>
                                    </td>
                                    <td class="text-center">
                                       <a href="#" class="btn btn-outline-primary action-btns" id="get_salary" data-id="<?php echo $value->employee_id ?>" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a>
                                       <a href="#" class="btn btn-outline-warning action-btns" id="edit_salary" data-id="<?php echo $value->employee_id ?>" data-bs-toggle="modal" data-bs-target="#payroll_narration" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit"></i> </a>
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

<div class="modal fade" id="viewsalarymodal" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

         <div id="salary_data">
            <!-- //? AJAX CALL -->
         </div>

      </div>
   </div>
</div>

<div id="payroll_narration" class="modal custom-modal fade" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="loan-title">Other Payroll Narrations</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="add_payroll_narration_form" class="mb-0">
            <input type="hidden" name="salary[employee_id]" id="employee_id" readonly>
            <div class="modal-body">
               <div class="form-group">
                  <label>Employees</label>
                  <input type="text" id="employee_name" class="form-control" readonly>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Overtime Allowance <span class="text-danger">*</span></label>
                        <input class="form-control" name="salary[overtime_allowance]" type="number" placeholder="Overtime Allowance">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Leave Allowance <span class="text-danger">*</span></label>
                        <input class="form-control" name="salary[leave_allowance]" type="number" placeholder="Leave Allowance">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Other Allowance <span class="text-danger">*</span></label>
                        <input class="form-control" name="salary[other_allowance]" type="number" placeholder="Other Allowance">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Other Deduction <span class="text-danger">*</span></label>
                        <input class="form-control" name="salary[other_deduction]" type="number" placeholder="Other Deduction">
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label>Note</label>
                  <textarea name="salary[note]" class="form-control" cols="3" placeholder="Notes"></textarea>
               </div>
            </div>

            <div class="modal-footer">
               <button class="btn btn-primary">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

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
         })
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

      const PAYROLL_URL = "inc/payroll/payroll_script.php";
      const SETTING_URL = "inc/setting/generate_payslip.php";
      const SALARY_URL = "inc/payrolItem.php";
      const GET_PAYROLL_URL = "inc/get_payroll.php";

      const payrollForm = document.getElementById("add_payroll_narration_form");
      const getSalary = document.getElementById("get_salary");
      const editSalary = document.getElementById("edit_salary");


      $('tbody').on('click', '#get_salary', async function() {
         let empId = this.dataset.id;
         let data = await fetch(SALARY_URL + '?empId=' + empId + '&salary_data')
         let res = await data.text();

         $('#salary_data').html(res);
      })

      $('tbody').on('click', '#edit_salary', async function() {
         let empId = this.dataset.id;
         let data = await fetch(PAYROLL_URL + '?empId=' + empId + '&salary_data')
         let res = await data.json();
         $('#employee_id').val(res.data.id);
         $('#employee_name').val(res.data.first_name + ' ' + res.data.last_name);
      })

      payrollForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(PAYROLL_URL, payrollForm);
         setTimeout(() => {
            window.location.reload();
         }, 1500);
      });

      $(document).on('click', '#PaySlipDisabled', function() {
         message('error', 'Payslip already generated for this month. Thank You!');
      })

      $(document).on('click', '#genPaySlip', function() {
         let processing = '<button class="btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...</button>';

         $('#generating').html(processing)
         $(this).attr("disabled", true);
         $.ajax({
            url: 'inc/payroll_script.php',
            method: "POST",
            data: {
               genPaySlip: 1,
               present_day: 31,
            },
            dataType: 'json',
            success: function(data) {
               if (data.success == true) {
                  message('success', data.msg);
                  window.location.reload();
               } else {
                  message('error', data.msg);
               }
            }
         })
      })

      $('#byDate').on("change", async () => {
         let filterDate = $("#byDate").val()
         let data = await fetch(GET_PAYROLL_URL + '?filter_date=' + filterDate)
         let res = await data.text();

         $('tbody#get_payroll').html(res);
      });
   })
</script>