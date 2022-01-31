<?php require_once('../../private/initialize.php'); ?>

<?php if (is_get_request()) {
  if (isset($_GET['salary_data'])) {

    $empId = $_GET['empId'];

    $employee = Employee::find_by_id($empId);

    $earnings = PayrollItem::find_all_payroll(['category' => 1]);
    $deductions = PayrollItem::find_all_payroll(['category' => 3]);
    $salaryAdvance = SalaryAdvance::find_by_employee_id($empId)->total_requested ?? 0;
    $longTerm = LongTermLoan::find_by_employee_id($empId);
    $commitment = $longTerm ? intval($longTerm->commitment) : 0;

    $salary = Payroll::find_by_employee_id($empId);
    $overtime = $salary->overtime_allowance ?? 0;
    $leave = $salary->leave_allowance ?? 0;
    $otherAllowance = $salary->other_allowance ?? 0;
    $otherDeduction = $salary->other_deduction ?? 0;

    $totalAllowance = intval($overtime) + intval($leave) + intval($otherAllowance) + intval($employee->present_salary);
    $totalDeduction = $commitment + $otherDeduction;

    $tax = Payroll::tax_calculator(['netSalary' => intval($employee->present_salary)]);

?>
    <div class="modal-body pt-1">
      <div class="table-responsive mt-3 mb-3">
        <table class="table mb-0 modal-paytable">
          <tbody>
            <tr>
              <td> <strong>Emp ID:</strong>
                <span><?php echo $employee->employee_id  != ''
                        ? ucwords($employee->employee_id) : 'Not Set' ?></span>
              </td>
              <td class="text-end"> <strong>Emp Name:</strong> <span><?php echo ucwords($employee->full_name()) ?></span> </td>
            </tr>
            <tr>
              <td> <strong>Location:</strong> <span><?php echo ucwords($employee->branch) ?></span> </td>
              <!-- <td class="text-end"> <strong>Pay Period:</strong> <span>January-2021</span> </td> -->
            </tr>
          </tbody>
        </table>
      </div>
     
      <div class="row">
        <div class="col-6">
          <table class="table text-nowrap border mb-0">
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
              <?php foreach ($earnings as $value) :
                $amountCalculated = intval($employee->present_salary) * (intval($value->amount) / 100);
              ?>
                <tr>
                  <td><?php echo ucwords($value->item) ?></td>
                  <td class="border-start"><?php echo number_format($amountCalculated) ?></td>
                </tr>
              <?php endforeach; ?>

              <tr>
                <td>Overtime Allowance</td>
                <td class="border-start"><?php echo number_format($overtime) ?></td>
              </tr>
              <tr>
                <td>Leave Allowance</td>
                <td class="border-start"><?php echo number_format($leave) ?></td>
              </tr>
              <tr>
                <td>Additional Days Allowance</td>
                <td class="border-start"><?php echo number_format($otherAllowance) ?></td>
              </tr>

              <tr class="border-top">
                <td class="font-weight-semibold">Total Earnings</td>
                <td class="font-weight-semibold border-start"><?php echo number_format(intval($totalAllowance)) ?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-6">
          <table class="table text-nowrap mb-0 border">
            <thead>
              <tr>
                <th class="fs-18" rowspan="1" colspan="2">Deductions</th>
              </tr>
              <tr>
                <th>Pay Type</th>
                <th class="border-start">Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($deductions as $value) :
                if ($value->item == 'Tax(PAYE)') {
                  $amountCalculated = $tax['monthly_tax'];
                }elseif ($value->item == 'Pension') {
                  $amountCalculated = $tax['pension'];
                }else{
                  $amountCalculated = $employee->present_salary * (intval($value->amount) / 100);
                }
                
              ?>
                <tr>
                  <td><?php echo ucwords($value->item) ?></td>
                  <td class="border-start"><?php echo number_format($amountCalculated) ?></td>
                </tr>

              <?php endforeach; ?>

              <!-- <tr>
                <td>Other Deductions</td>
                <td class="border-start"><?php //echo number_format($otherDeduction) ?></td>
              </tr> -->
              <tr>
                <td>Salary Advance </td>
                <td class="border-start"><?php echo number_format(intval($salaryAdvance)) ?></td>
              </tr>
              <tr>
                <td>Loans </td>
                <td class="border-start"><?php echo number_format($commitment) ?></td>
              </tr>
              <tr class="border-top">
                <td class="font-weight-semibold">Total Deductions</td>
                <td class="font-weight-semibold border-start"><?php echo number_format(intval($totalDeduction)) ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
          

      <div class="mt-4 mb-3">
        <table class="table mb-0 border">
          <tbody>
            <tr>
              <td class="font-weight-semibold w-20 fs-18 pb-0 pt-0">Net Salary</td>
              <td class="pb-0 pt-0">
                <h4 class="font-weight-semibold mb-0 fs-24"><?php echo $currency ?> <?php echo number_format($employee->present_salary) ?></h4>
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
        <a href="#" class="btn btn-danger" data-bs-dismiss="modal"><i class="feather feather-x"></i> Close</a>
      </div>
    </div>
<?php  }
} ?>