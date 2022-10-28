<?php
require_once('../../private/initialize.php');

if (is_post_request()) {
  $employees = Employee::find_by_undeleted();

  foreach ($employees as $employee) {
    $loan = EmployeeLoan::find_by_employee_id($employee->id) ?? 0;
    $salary_advance = SalaryAdvance::find_by_employee_id($employee->id) ?? 0;
    $staff_expenses = StaffExpenses::find_by_employee_id($employee->id) ?? 0;
    $attendance = EmployeeAttendance::find_by_employee_id($employee->id) ?? 0;
    $take_home = $employee->present_salary - $salary_advance - $loan + $staff_expenses;

    if (!empty($loan)) {
      $loan = EmployeeLoan::find_by_employee_id($employee->id) ?? 0;
    }

    $args = [
      'employee_id' => $employee->id,
      'salary' => $employee->present_salary,
      'salary_advance' => $salary_advance->total_requested,
      'loan' => $loan->commitment,
      'other_expenses' => $staff_expenses->amount,
      'present_days' => $employee->id,
      'take_home' => $take_home,
    ];
  }
}
