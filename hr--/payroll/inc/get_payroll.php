<?php
require_once('../../private/initialize.php');


if (isset($_GET['filter_date'])) {
   $queryMonth = date('Y-') . $_GET['filter_date'];

   $payrolls = Payroll::find_by_month(date('Y-m', strtotime($queryMonth)));

?>
   <?php
   $sn = 1;
   foreach ($payrolls as $value) :

      $empLoan = LongTermLoan::find_by_employee_id($value->employee_id);
      $salary_advance = SalaryAdvance::find_by_employee_id($value->employee_id, ['current' => $queryMonth]);
      $employee = Employee::find_by_id($value->employee_id);
      $salary = intval($value->present_salary);
      $commitment = isset($empLoan->commitment) ? $empLoan->commitment : '0.00';
      $take_home = intval($salary) - (intval($commitment) + intval($salary_advance->total_requested));

      $tax = Payroll::tax_calculator(['netSalary' => intval($salary)]);
      $monthly_tax = $tax['monthly_tax'] ?? 0;
      $pension = $tax['pension'];
      $calculate_tax = 0;
   ?>
      <tr>
         <td class="bg-white">
            <?php echo $sn++; ?>
         </td>
         <td class="bg-white">
            <div class="d-flex">
               <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
               <div class="me-3 mt-0 mt-sm-1 d-block">
                  <h6 class="mb-1 fs-14"><?php echo isset($employee->first_name) ? $employee->full_name() : 'Not Set' ?></h6>
                  <p class="text-muted mb-0 fs-12">Emp ID: <?php echo isset($employee->id) ? str_pad($employee->id, 3, '0', STR_PAD_LEFT) : 'Not Set'; ?></p>
               </div>
            </div>
         </td>
         <td><?php echo date('M Y', strtotime($value->month)) ?></td>
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
            <?php
            $status = $value->payment_status;
            if ($status == 1) {
               $color = 'badge-primary';
            } elseif ($status == 2) {
               $color = 'badge-warning';
            } else {
               $color = 'badge-success';
            }
            ?>
            <span class="badge <?php echo $color ?>">
               <?php echo Payroll::STATUS[$status]; ?>

            </span>
         </td>
         <td class="text-center">

            <a href="#" class="btn btn-outline-primary action-btns" id="get_salary" data-id="<?php echo $value->employee_id ?>" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a>
            <a href="#" class="btn btn-outline-warning action-btns" id="edit_salary" data-id="<?php echo $value->employee_id ?>" data-bs-toggle="modal" data-bs-target="#payroll_narration" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit"></i> </a>
         </td>
      </tr>
   <?php endforeach; ?>
<?php } ?>

<?php if (isset($_GET['load_filter'])) {

   $month = $_GET['month'];
   $date = $_GET['year'] . "-" . $_GET['month'];
   $queryByMonth = $month;
   // 
   $config = Configuration::find_by_process_salary(['process_salary' => 1, 'process_salary_date' => $queryByMonth]);
   // pre_r($config);
?>


   <div class="d-flex justify-content-end">

      <?php

      if ($config == true) : ?>
         <?php if ($config->visibility != 1) { ?>

            <div id="pushwrap">
               <button class="btn btn-dark me-3" id="push">Push to account</button>
            </div>
         <?php } ?>

         <a class="btn btn-secondary me-3" href="<?php echo url_for('payroll/exportData.php') ?>"> <i class="las la-file-excel"></i> Download Monthly Excel Report </a>
      <?php endif ?>




   </div>
<?php } ?>