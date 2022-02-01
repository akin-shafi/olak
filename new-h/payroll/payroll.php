<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payroll';
include(SHARED_PATH . '/header.php');
$datatable = '';
$select2 = '';

$thisMonth = date('Y-m');
$employees = Employee::find_by_undeleted();
$payrolls = Payroll::find_by_created_at($thisMonth);

$config = Configuration::find_by_process_salary(['process_salary' => 1, 'process_salary_date' => $thisMonth]);
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Employee Salary</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <?php
         $config = Configuration::find_by_process_salary(['process_salary' => 1, 'process_salary_date' => $thisMonth]);
         if ($config == true) : ?>
            <button class="btn btn-dark me-3" id="PaySlipDisabled">Payslip Generated</button>
            <button class="btn btn-secondary me-3" data-bs-toggle="modal" data-bs-target="#excelmodal"> <i class="las la-file-excel"></i> Download Monthly Excel Report </button>
         <?php else : ?>
            <div id="generating">
               <button class="btn btn-primary me-3" id="genPaySlip">Generate Payslip</button>
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
               <div class="col-xl-2 col-md-4 col-sm-12">
                  <div class="form-group">
                     <label class="form-label">Filter By Date:</label>
                     <input type="date" class="form-control" name="by_date" id="byDate">
                  </div>
               </div>
               <!-- <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                     <label class="form-label">Month:</label>
                     <select class="form-control select2" id="isMonth" data-placeholder="Select Month">
                        <option label="Select Month" data-select2-id="select2-data-55-moyh"></option>
                        <option value="1" <?php echo date('m') == '1' ? 'selected' : '' ?>>January</option>
                        <option value="2" <?php echo date('m') == '2' ? 'selected' : '' ?>>February</option>
                        <option value="3" <?php echo date('m') == '3' ? 'selected' : '' ?>>March</option>
                        <option value="4" <?php echo date('m') == '4' ? 'selected' : '' ?>>April</option>
                        <option value="5" <?php echo date('m') == '5' ? 'selected' : '' ?>>May</option>
                        <option value="6" <?php echo date('m') == '6' ? 'selected' : '' ?>>June</option>
                        <option value="7" <?php echo date('m') == '7' ? 'selected' : '' ?>>July</option>
                        <option value="8" <?php echo date('m') == '8' ? 'selected' : '' ?>>August</option>
                        <option value="9" <?php echo date('m') == '9' ? 'selected' : '' ?>>September</option>
                        <option value="10" <?php echo date('m') == '10' ? 'selected' : '' ?>>October</option>
                        <option value="11" <?php echo date('m') == '11' ? 'selected' : '' ?>>November</option>
                        <option value="12" <?php echo date('m') == '12' ? 'selected' : '' ?>>December</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                     <label class="form-label">Year:</label>
                     <select class="form-control select2" id="isYear" data-placeholder="Select Year">
                        <option label="Select Year" data-select2-id="select2-data-75-ehux"></option>
                        <option value="2024" <?php echo date('Y') == '2024' ? 'selected' : '' ?>>2024</option>
                        <option value="2023" <?php echo date('Y') == '2023' ? 'selected' : '' ?>>2023</option>
                        <option value="2022" <?php echo date('Y') == '2022' ? 'selected' : '' ?>>2022</option>
                        <option value="2021" <?php echo date('Y') == '2021' ? 'selected' : '' ?>>2021</option>
                        <option value="2020" <?php echo date('Y') == '2020' ? 'selected' : '' ?>>2020</option>
                        <option value="2019" <?php echo date('Y') == '2019' ? 'selected' : '' ?>>2019</option>
                        <option value="2018" <?php echo date('Y') == '2018' ? 'selected' : '' ?>>2018</option>
                        <option value="2017" <?php echo date('Y') == '2017' ? 'selected' : '' ?>>2017</option>
                        <option value="2016" <?php echo date('Y') == '2016' ? 'selected' : '' ?>>2016</option>
                        <option value="2015" <?php echo date('Y') == '2015' ? 'selected' : '' ?>>2015</option>
                        <option value="2014" <?php echo date('Y') == '2014' ? 'selected' : '' ?>>2014</option>
                        <option value="2013" <?php echo date('Y') == '2013' ? 'selected' : '' ?>>2013</option>
                        <option value="2012" <?php echo date('Y') == '2012' ? 'selected' : '' ?>>2012</option>
                        <option value="2011" <?php echo date('Y') == '2011' ? 'selected' : '' ?>>2011</option>
                        <option value="2019" <?php echo date('Y') == '2019' ? 'selected' : '' ?>>2019</option>
                        <option value="2010" <?php echo date('Y') == '2010' ? 'selected' : '' ?>>2010</option>
                     </select>

                  </div>
               </div> -->
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
                                 <th>(₦) Monthly Tax</th>
                                 <th>(₦) Pension</th>
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
                                 $monthly_tax = $tax['monthly_tax'];
                                 $pension = $tax['pension'];

                                 $take_home = intval($salary) - (intval($commitment) + intval($salary_advance->total_requested) + intval($monthly_tax) + intval($pension));

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
                                    <td><?php echo  number_format($monthly_tax) ?></td>
                                    <td><?php echo  number_format($pension) ?></td>

                                    <td>
                                       <?php echo !empty($salary_advance->total_requested) ? number_format($salary_advance->total_requested) : '0.00' ?>
                                    </td>
                                    <td><?php echo number_format($commitment) ?></td>
                                    <td class="font-weight-semibold"><?php echo number_format($take_home) ?></td>
                                    <td>
                                       <span class="badge <?php echo $value->payment_status != 0 ? 'badge-success' : 'badge-danger' ?>">
                                          <?php echo $value->payment_status != 0 ? 'Paid' : 'Unpaid' ?></span>
                                    </td>
                                    <td class="text-start bg-white">
                                       <a href="#" class="action-btns" id="get_salary" data-id="<?php echo $value->employee_id ?>" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a>
                                       <a href="#" class="action-btns" id="edit_salary" data-id="<?php echo $value->employee_id ?>" data-bs-toggle="modal" data-bs-target="#payroll_narration" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a>
                                       <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a>
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

      const PAYROLL_URL = "../inc/payroll/payroll_script.php";
      const SETTING_URL = "../inc/setting/generate_payslip.php";
      const SALARY_URL = "./inc/salary_data.php";
      const GET_PAYROLL_URL = "./inc/get_payroll.php";

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