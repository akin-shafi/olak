<?php
require_once('../../private/initialize.php');
$employee = $loggedInAdmin;

if (is_get_request()) :
  if (isset($_GET['payroll_details'])) :

    $payroll = Payroll::find_by_id($_GET['payrollId']);
    $earnings = PayrollItem::find_all_payroll(['category' => 1]);
    $deductions = PayrollItem::find_all_payroll(['category' => 3]);

    $presentSalary = $payroll->present_salary;

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


    <div class=" pt-1">
      <div class="table-responsive mt-3 mb-3">
        <table class="table mb-0 modal-paytable">
          <tbody>
            <tr>
              <td> <strong>Emp Name:</strong> <span><?php echo $employee->full_name() ?></span> </td>
              <td class="text-end"> <strong>Company:</strong> <span><?php echo $employee->company ?></span> </td>
            </tr>
            <tr>
              <td> <strong>Emp ID:</strong> <span><?php echo $employee->employee_id ?></span> </td>
              <td class="text-end"> <strong>Branch:</strong> <span><?php echo $employee->branch ?></span> </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row">

        <div class="col-6 table-responsive">
          <table class="table border text-nowrap mb-0">
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
                $amountCalculated = $presentSalary * (intval($value->amount) / 100);
              ?>
                <?php if ($value->addon == 0) : ?>
                  <tr>
                    <td><?php echo ucwords($value->item) ?></td>
                    <td class="border-start"><?php echo number_format($amountCalculated) ?>
                      <input value="<?php echo $amountCalculated ?>" class="returnValue" type="hidden">
                    </td>
                  </tr>
                <?php endif ?>
              <?php endforeach ?>
              <tr class="border-top">
                <td class="font-weight-semibold">Total Earnings</td>
                <td class="font-weight-semibold border-start">
                  <?php echo number_format($presentSalary, 2); ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-6 table-responsive">
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
              <?php if ($calculate_tax == 1) : ?>
                <?php
                foreach ($deductions as $value) :
                  if ($value->item == 'Tax(PAYE)') {
                    $amountCalculated = $tax['monthly_tax'];
                  } elseif ($value->item == 'Pension') {
                    $amountCalculated = $tax['pension'];
                  } else {
                    $amountCalculated = $presentSalary * (intval($value->amount) / 100);
                  }
                ?>
                  <tr>
                    <td><?php echo ucwords($value->item) ?></td>
                    <td class="border-start"><?php echo number_format($amountCalculated) ?></td>
                  </tr>
                <?php endforeach;
                ?>
              <?php else : ?>
                <?php
                foreach ($deductions as $value) :
                  if ($value->item == 'Tax(PAYE)') {
                    $amountCalculated = 0;
                  } elseif ($value->item == 'Pension') {
                    $amountCalculated = 0;
                  } else {
                    $amountCalculated = 0;
                  }
                ?>
                  <tr>
                    <td><?php echo ucwords($value->item)
                        ?></td>
                    <td class="border-start"><?php echo number_format($amountCalculated) ?></td>
                  </tr>
                <?php endforeach;
                ?>
              <?php endif ?>
              <tr>
                <td>Salary Advance</td>
                <td class="border-start">
                  <?php 
                  $payroll = !empty($payroll->salary_advance)  ? $payroll->salary_advance : 0;
                echo number_format($payroll) ?></td>
              </tr>

              <tr>
                <td>Commitment for (Long Term Loan)</td>
                <td class="border-start"><?php 
                  $loan = !empty($payroll->loan)  ? $payroll->loan : 0;
                  echo number_format($loan) ?></td>
              </tr>

              <tr class="border-top">
                <td class="font-weight-semibold">Total Deduction</td>
                <td class="font-weight-semibold border-start"><?php echo number_format(intval($totalDeduction)) ?></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
      <div class="mt-4 mb-3 table-responsive">
        <table class="table mb-0">
          <tbody>
            <tr>
              <td class="font-weight-semibold w-20 fs-18 pb-0 pt-0">Net Salary</td>
              <td class="pb-0 pt-0">
                <h4 class="font-weight-semibold mb-0 fs-24"><?php echo $currency . ' ' . number_format($netSalaryComputed, 2) ?> </h4>
              </td>
            </tr>
            <tr>
              <td class="font-weight-semibold w-20 pb-0 pt-1 text-muted">In Words</td>
              <td class="pb-0 pt-1">
                <h5 class="mb-0  text-muted"><?php echo convert_number_to_words($netSalaryComputed) . ' Naira Only.' ?></h5>
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


<?php endif;
endif;
