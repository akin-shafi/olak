<?php
require_once('../../private/initialize.php');

if (is_get_request()) {
  if (isset($_GET['filter_date'])) {
    $queryMonth = $_GET['filter_date'];

    $payrolls = Payroll::find_by_created_at(date('Y-m', strtotime($queryMonth)));



?>
    <?php
    $sn = 1;
    foreach ($payrolls as $value) :

      $empLoan = LongTermLoan::find_by_employee_id($value->employee_id);
      $salary_advance = SalaryAdvance::find_by_employee_id($value->employee_id);
      $employee = Employee::find_by_id($value->employee_id);
      $salary = intval($value->present_salary);
      $commitment = isset($empLoan->commitment) ? $empLoan->commitment : '0.00';
      $take_home = intval($salary) - (intval($commitment) + intval($salary_advance->total_requested));

      $tax = Payroll::tax_calculator(['netSalary' => intval($salary)]);
      $monthly_tax = $tax['monthly_tax'];
      $pension = $tax['pension'];

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
        <td><span class="badge <?php echo $value->payment_status != 0 ? 'badge-success' : 'badge-danger' ?>">
            <?php echo $value->payment_status != 0 ? 'Paid' : 'Unpaid' ?></span></td>
        <td class="text-start bg-white">
          <a href="#" class="action-btns" id="get_salary" data-id="<?php echo $value->employee_id ?>" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a>
          <a href="#" class="action-btns" id="edit_salary" data-id="<?php echo $value->employee_id ?>" data-bs-toggle="modal" data-bs-target="#payroll_narration" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a>
          <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a>
        </td>
      </tr>
    <?php endforeach; ?>
<?php }
}
