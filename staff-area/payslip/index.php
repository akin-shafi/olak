<?php
require_once('../private/initialize.php');

$page = 'Payslip';
$page_title = 'Payslip';
include(SHARED_PATH . '/header.php');
$datatable = '';

$employee = $loggedInAdmin;

$payrolls   = Payroll::find_by_employee_id($employee->id, ['summary' => true]); //? Obj Array

?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Payslip</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
         <div class="btn-list"> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-xl-12 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">My Payslip Summary</h4>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="emp-attendance_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="emp-attendance" role="grid" aria-describedby="emp-attendance_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 text-center sorting_disabled" rowspan="1" colspan="1" aria-label="SN" style="width: 157.312px;">SN</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Month: activate to sort column ascending" style="width: 202.792px;">Month</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Year: activate to sort column ascending" style="width: 119.688px;">Year</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="₦ Net Salary: activate to sort column ascending" style="width: 223.188px;">Net Salary (₦)</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Generated Date: activate to sort column ascending" style="width: 270.458px;">Generated Date</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 355.229px;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $sn = 1;
                              foreach ($payrolls as $summary) :
                                 $payroll = Payroll::find_by_id($summary->id);

                                 $tax = Payroll::tax_calculator(['netSalary' => $payroll->present_salary]);
                                 $calculate_tax = 0;

                                 $totalAllowance = $payroll->present_salary + $payroll->overtime_allowance + $payroll->leave_allowance + $payroll->other_allowance;

                                 if ($calculate_tax == 1) {
                                    $totalDeduction = $payroll->loan + $payroll->salary_advance + $payroll->other_deduction + $tax['monthly_tax'] + $tax['pension'];
                                 } else {
                                    $totalDeduction = intval($payroll->loan) + intval($payroll->salary_advance) + intval($payroll->other_deduction);
                                 }
                                 $netSalaryComputed = intval($totalAllowance) - intval($totalDeduction);

                              ?>
                                 <tr>
                                    <td class="text-center"><?php echo $sn++; ?></td>
                                    <td><?php echo date('F', strtotime($summary->created_at)); ?></td>
                                    <td><?php echo date('Y', strtotime($summary->created_at)); ?></td>
                                    <td class="font-weight-semibold"><?php echo number_format(intval($netSalaryComputed),) ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($summary->created_at)); ?></td>

                                    <td>
                                       <a class="btn btn-primary btn-icon btn-sm" id="view_summary" data-id="<?php echo $summary->id; ?>" data-bs-toggle="modal" data-bs-target="#summary_detail"><i class="feather feather-eye"></i></a>
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


<div class="modal fade" id="summary_detail">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Loan Details</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
         </div>
         <div class="modal-body" id="payroll_details">//? AJAX CALL</div>
         <div class="modal-footer">
            <div class="ms-auto"> <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a> </div>
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
         })
      };

      const PAYSLIP_URL = "../inc/payslip/";


      $('tbody').on('click', '#view_summary', async function() {
         let payrollId = this.dataset.id;
         let data = await fetch(PAYSLIP_URL + '?payrollId=' + payrollId + '&payroll_details')
         let res = await data.text();

         $('#payroll_details').html(res);
      })
   })
</script>