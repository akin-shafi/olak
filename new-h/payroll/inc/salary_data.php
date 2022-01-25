<?php require_once('../../private/initialize.php'); ?>

<?php if (is_get_request()) {
  if (isset($_GET['salary_data'])) {

    $empId = $_GET['empId'];

    $employee = Employee::find_by_id($empId);

    $earnings = PayrollItem::find_all_payroll(['category' => 1]);
    $deductions = PayrollItem::find_all_payroll(['category' => 3]);

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
                    <?php foreach ($earnings as $value) :
                      $amountCalculated = $employee->present_salary * (intval($value->amount) / 100);
                    ?>
                      <tr>
                        <td><?php echo ucwords($value->item) ?></td>
                        <td class="border-start"><?php echo number_format($amountCalculated) ?></td>
                      </tr>
                    <?php endforeach; ?>

                    <tr class="border-top">
                      <td class="font-weight-semibold">Total Earnings</td>
                      <td class="font-weight-semibold border-start"><?php echo number_format($employee->present_salary) ?></td>
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
                    <?php foreach ($deductions as $value) :
                      $amountCalculated = $employee->present_salary * (intval($value->amount) / 100);
                    ?>
                      <tr>
                        <td><?php echo ucwords($value->item) ?></td>
                        <td class="border-start"><?php echo number_format($amountCalculated) ?></td>
                      </tr>
                    <?php endforeach; ?>
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