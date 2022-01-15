<?php
require_once('../private/initialize.php');

$user = Employee::find_by_id($loggedInAdmin->id);
$designationName = Designation::find_by_id($user->designation_id)->designation_name;


$id = $loggedInAdmin->id;
$employee = Employee::find_by_id($id);


$employeeInfo = EmployeeDetail::find_by_employee_id($id) ?? '';
$shortTerm = EmployeeLoan::find_by_employee_id($id, ['type' => 1]) ?? '';
$salary = Salary::find_by_employee_id($id);
if (!empty($salary)) {
  $salaryDeduction = SalaryDeduction::find_by_deductions($salary->id)->total_deductions;
  $salaryEarning = SalaryEarning::find_by_earnings($salary->id)->total_earnings;
}

$employeeSalaryEarning = SalaryEarning::find_by_earnings($id);
$department = Department::find_by_id($employee->department_id);
$designation = Designation::find_by_id($employee->designation_id);
$education = EmployeeEducation::find_by_employee_id($id);
$experience = EmployeeExperience::find_by_employee_id($id);

$period = 'This month';
if (!empty($salary)) {
  $salary = intval($salary->net_salary);
  $accessible_loan_percentage = 0.4;
  $accessible_loan_value = $salary * $accessible_loan_percentage;

  // Loan calculation
  $loan_received = $shortTerm->total_loan_received ?? 0;
  $loan_balance = $accessible_loan_value - $loan_received;
  $take_home = $salary - $loan_received;

  // Percentage Difference 

  $loan_received_percentage = ($loan_received / $accessible_loan_value) * 100;
  $loan_balance_percentage = ($loan_balance / $accessible_loan_value) * 100;
  $take_home_percentage = ($take_home / $salary) * 100;
}

/* ----------------------------------- //? ATTENDANCE ---------------------------------- */
$attendance = EmployeeAttendance::find_by_employee_id($id, ['clock_in' => date('Y-m-d')]);
$isClockedIn =  isset($attendance->clock_in) && $attendance->clock_in != '00:00:00' ? true : false;

$page = 'Dashboard';
$page_title = 'Employee | Dashboard';

?>

<?php include(SHARED_PATH . '/employee_header.php');  ?>
<?php include(SHARED_PATH . '/side-nav.php');  ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="status-wrap d-flex align-items-center">
      <div class="ml-auto">
        <button type="button" class="btn btn-sm btn-info" data-target="#loan_request" data-toggle="modal" <?php echo empty($salary) ? 'disabled' : '' ?>>
          <i class="icon-credit-card"></i> <span>Request Loan</span></button>

        <?php if (!$isClockedIn) : ?>
          <button type="button" class="btn btn-sm btn-danger mr-3" data-target="#clock_in" data-toggle="modal">
            <i class="icon-clock"></i> <span>Clock In</span></button>
        <?php else : ?>
          <button type="button" class="btn btn-sm btn-dark mr-3" data-target="#clock_in" data-toggle="modal" <?php echo isset($attendance->clock_out) && $attendance->clock_out != '00:00:00' ? 'disabled' : '' ?>>
            <i class="icon-clock"></i> <span>Clock Out</span></button>
        <?php endif; ?>

      </div>
      <div class="card" style="border-radius: 8px;">
        <div class="card-body p-2">
          <div class="d-flex align-items-center px-3">
            <p class="mb-0 mr-3">Job Status:</p>
            <strong>Fulltime</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="row">

      <div class="col-md-12 my-5">
        <div class="card shadow" style="border-radius: 16px;">
          <div class="card-body">
            <?php if (!empty($salary)) : ?>
              <div class="row font-weight-bold">
                <div class="col-md-4">
                  <div class="card-group">
                    <div class="card">
                      <div class="card-body p-2">
                        <div>
                          <p><i class="fa fa-dot-circle-o text-purple me-2"></i>Current Salary <span class="float-right"><?php echo number_format($salary, 2) ?></span></p>
                          <p><i class="fa fa-dot-circle-o text-warning me-2"></i>Accessible loan (%) <span class="float-right"><?php echo $accessible_loan_percentage * 100 ?>%</span></p>
                          <p><i class="fa fa-dot-circle-o text-success me-2"></i>Accessible loan (₦) <span class="float-right"><?php echo $currency . " " . number_format($accessible_loan_value, 2); ?></span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="card-group">
                    <div class="card">
                      <div class="card-body p-2">
                        <div class="d-flex justify-content-between mb-3">
                          <div>
                            <span class="d-block">Loan requested</span>
                          </div>
                          <div>
                            <span class="text-success"><?php echo round($loan_received_percentage) ?>%</span>
                          </div>
                        </div>
                        <h3 class="mb-3"><?php echo $currency . " " . number_format($loan_received, 2) ?></h3>
                        <div class="progress mb-2" style="height: 5px;">
                          <div class="progress-bar bg-secondary d-none" role="progressbar" style="width: 100%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0 text-muted"><?php echo $period; ?></p>
                      </div>
                    </div>

                    <div class="card rounded-0 border-left border-right">
                      <div class="card-body p-2">
                        <div class="d-flex justify-content-between mb-3">
                          <div>
                            <span class="d-block">Loan Balance</span>
                          </div>
                          <div>
                            <span class="text-danger"><?php echo round($loan_balance_percentage); ?>%</span>
                          </div>
                        </div>
                        <h3 class="mb-3"><?php echo $currency . " " . number_format($loan_balance, 2) ?></h3>
                        <div class="progress mb-2" style="height: 5px;">
                          <div class="progress-bar bg-secondary d-none" role="progressbar" style="width: 100%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0 text-muted"><?php echo $period; ?></p>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body p-2">
                        <div class="d-flex justify-content-between mb-3">
                          <div>
                            <span class="d-block">Current take home</span>
                          </div>
                          <div>
                            <span class="text-danger"><?php echo round($take_home_percentage); ?>%</span>
                          </div>
                        </div>
                        <h3 class="mb-3"><?php echo $currency . " " . number_format($take_home, 2) ?></h3>
                        <div class="progress mb-2" style="height: 5px;">
                          <div class="progress-bar bg-secondary d-none" role="progressbar" style="width: 100%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mb-0 text-muted"><?php echo $period; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php else : ?>
              <h2 class="text-center">Salary is not set for
                <span class="text-primary">
                  <?php echo ucwords($employee->full_name()); ?>
                </span>
              </h2>
            <?php endif; ?>
          </div>
        </div>
      </div>





      <div class="col-md-8 pr-4">
        <div class="row">
          <div class="col-md-6 col-sm-12 mb-4">
            <div class="card shadow" style="border-radius: 20px;">
              <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center">
                  <div class="left">
                    <span class="text-muted">Work Days</span>
                    <h1>22</h1>
                  </div>
                  <div class="right">
                    <div class="d-flex justify-content-center align-items-center bg-secondary rounded-circle" style="width: 50px;height:50px; font-size:20px">
                      <i class="icon-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 mb-4">
            <div class="card shadow" style="border-radius: 20px;">
              <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center">
                  <div class="left">
                    <span class="text-muted">Present Days</span>
                    <h1>10</h1>
                  </div>
                  <div class="right">
                    <div class="d-flex justify-content-center align-items-center bg-secondary rounded-circle" style="width: 50px;height:50px; font-size:20px">
                      <i class="icon-clock"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 mt-4">
            <div class="card shadow" style="border-radius: 8px;">
              <div class="card-body p-2">
                <h6 class="font-weight-bold my-3 ml-3">Monthly Attendance Summary</h6>
                <div id="attendance-chart"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <!-- <div class="calendar-wrap mb-4 ">
              <h4 class="font-weight-bolder d-none">Calendar</h4>
              <div class="card shadow" style="border-radius: 16px;">
                <div class="card-body">
                  <div class="calendar-wrapper" id="calendar-wrapper"></div>
                </div>
              </div>
            </div> -->

        <div class="leave-wrap mb-4">
          <h4 class="font-weight-bolder d-none">Information</h4>
          <div class="card shadow" style="border-radius: 16px;">
            <div class="card-body">
              <div class="mb-4">
                <h4 class="font-weight-bolder">Information </h4>
                <p class="mb-0">Job announcement</p>
                <h4 class="font-weight-bolder text-uppercase">Digital Marketing Officer </h4>
                <p class="mb-0">Requirements</p>
                <ul>
                  <li class="ml-3">Bachelor’s degree at Marketing</li>
                  <li class="ml-3">Minimum of 3 years experience</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="leave-wrap mb-1">
          <h4 class="font-weight-bolder d-none">Leave Status</h4>
          <div class="card shadow" style="border-radius: 16px;">
            <div class="card-body">
              <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Sick Leave </h6>
                  <p class="mb-0">50/120 days</p>
                </div>
                <div class="progress">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 45%;">45%</div>
                </div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Annual Leave </h6>
                  <p class="mb-0">70/120 days</p>
                </div>
                <div class="progress">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;">75%</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Developed by <a href="#">Sandsify Systems</a> <?php echo date('Y'); ?></span>
    </div>
  </footer>
</div>

<?php include('../inc/modal/all.php');  ?>
<?php include(SHARED_PATH . '/employee_footer.php');  ?>