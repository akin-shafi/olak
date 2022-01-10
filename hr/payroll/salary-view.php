<?php
require_once('../private/initialize.php');

if (!isset($_GET['generate'])) {
   redirect_to('../employees/employees-list.php');
}

$salary_id = $_GET['generate'];
$salary = Salary::find_by_salaries($salary_id);
$employee = Employee::find_by_id($salary->employee_id);
$department = Department::find_by_id($employee->department_id);
$designation = Designation::find_by_id($employee->designation_id);

$totalDeduction = SalaryDeduction::find_by_deductions($salary_id)->total_deductions;
$totalEarning = SalaryEarning::find_by_earnings($salary_id)->total_earnings;

$page = 'Payroll';
$page_title = 'Payslip';
include(SHARED_PATH . '/admin_header.php');
?>
<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row align-items-center">
            <div class="col">
               <h3 class="page-title">Payslip</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Payslip</li>
               </ul>
            </div>
            <div class="col-auto float-end ms-auto">
               <div class="btn-group btn-group-sm">
                  <button class="btn btn-white">CSV</button>
                  <button class="btn btn-white">PDF</button>
                  <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="payslip-title">Payslip for the month of Feb 2019</h4>
                  <div class="row">
                     <div class="col-sm-6 m-b-20">
                        <!-- <img src="assets/img/logo2.png" class="inv-logo" alt=""> -->
                        <ul class="list-unstyled mb-0">
                           <li>Olak Integrated</li>
                           <li>Plot 5, Irewolede Industrial Estate, </li>
                           <li>New Yidi Road Ilorin,</li>
                           <li>Kwara State Nigeria.</li>
                        </ul>
                     </div>
                     <div class="col-sm-6 m-b-20">
                        <div class="invoice-details">
                           <h3 class="text-uppercase">Payslip #49029</h3>
                           <ul class="list-unstyled">
                              <li>Salary Month:
                                 <span><?php echo date('F, Y'); ?></span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12 m-b-20">
                        <ul class="list-unstyled">
                           <li>
                              <h5 class="mb-0"><strong><?php echo ucwords($employee->full_name()); ?></strong></h5>
                           </li>
                           <li><span><?php echo ucwords($department->department_name); ?></span></li>
                           <li>Employee ID: <?php echo strtoupper($employee->employee_id); ?></li>
                           <li>Joining Date: <?php echo date('M jS, Y', strtotime($employee->date_employed)); ?></li>
                        </ul>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div>
                           <h4 class="m-b-10"><strong>Earnings</strong></h4>
                           <table class="table table-bordered">

                              <tbody>
                                 <tr>
                                    <td>
                                       <strong>Basic Salary</strong>
                                       <span class="float-end">
                                          ₦ <?php echo number_format($salary->basic_salary, 2); ?></span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>House Rent Allowance (H.R.A.)</strong>
                                       <span class="float-end">
                                          ₦ <?php echo number_format($salary->housing, 2); ?></span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Dressing Allowance</strong>
                                       <span class="float-end">
                                          ₦ <?php echo number_format($salary->dressing, 2); ?></span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Conveyance (Transport Allowance)</strong>
                                       <span class="float-end">
                                          ₦ <?php echo number_format($salary->transport, 2); ?></span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Utility Allowance</strong>
                                       <span class="float-end">
                                          ₦ <?php echo number_format($salary->utility, 2); ?></span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Other Allowances</strong>
                                       <span class="float-end">
                                          ₦ <?php echo number_format($salary->other_earning, 2); ?></span>
                                    </td>
                                 </tr>

                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div>
                           <h4 class="m-b-10"><strong>Deductions</strong></h4>
                           <table class="table table-bordered">
                              <tbody>
                                 <tr>
                                    <td>
                                       <strong>Tax (PAYE)</strong>
                                       <span class="float-end">
                                          ₦ <?php echo number_format($salary->tax, 2); ?></span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Employee Pension </strong>
                                       <span class="float-end">
                                          ₦ <?php echo number_format($salary->pension, 2); ?></span>
                                    </td>
                                 </tr>

                                 <tr>
                                    <td>
                                       <strong>Total Deductions</strong>
                                       <span class="float-end">
                                          <strong>₦ <?php echo number_format($totalDeduction, 2); ?></strong></span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Monthly Gross Salary</strong>
                                       <span class="float-end">
                                          <strong>₦ <?php echo number_format($totalEarning, 2); ?></strong></span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Monthly Net Salary</strong>
                                       <span class="float-end">
                                          <strong>₦ <?php echo number_format($salary->net_salary, 2); ?></strong></span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <p>
                           <strong>
                              Net Salary: ₦ <?php echo number_format($salary->net_salary, 2); ?>
                           </strong>
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php');  ?>