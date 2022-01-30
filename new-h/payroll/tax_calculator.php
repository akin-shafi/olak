<?php
require_once('../private/initialize.php');
$page = 'Tax';
$page_title = 'Tax Calculator';
include(SHARED_PATH . '/header.php');

$netSalary = 55000; // Net Salary
$tax = Payroll::tax_calculator(['netSalary' => $netSalary]);

 ?>




<div class="page-header d-xl-flex d-block">
  <div class="page-leftheader">
    <h4 class="page-title"><?php echo $page_title ?></h4>
  </div>
  
</div>

<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12">
    


    <div class="row">
      

      <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header border-0">
            <!-- <h4 class="card-title">Long Term Loan Summary</h4> -->
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div id="emp-attendance_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                <div class="row">
                  <div class="col-sm-12">
						 <table class="table table-vcenter text-nowrap table-bordered border-bottom no-footer">
						 	<tr>
						 		<td>Monthly Salary</td>
						 		<td><?php echo number_format($netSalary, 2) ?></td>
						 	</tr>
						 	<tr>
						 		<td>Annual Salary</td>
						 		<td><?php echo number_format($tax['grossSalary'], 2) ?></td>
						 	</tr>

						 	<tr>
						 		<td>Relief</td>
						 		<td><?php echo number_format($tax['relief'], 2) ?></td>
						 	</tr>

						 	<tr>
						 		<td>Tax Free Pay</td>
						 		<td><?php echo number_format($tax['taxfree'], 2) ?></td>
						 	</tr>
						 	<tr>
						 		<td>Taxable Income</td>
						 		<td><?php echo number_format($tax['taxable_income'], 2) ?></td>
						 	</tr>
						 	<tr>
						 		<td>Annual Tax</td>
						 		<td><?php echo number_format($tax['annunal_tax'], 2) ?></td>
						 	</tr>
						 	<tr>
						 		<td>Monthly Tax</td>
						 		<td><?php echo number_format($tax['monthly_tax'], 2) ?></td>
						 	</tr>
						 </table>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>



<?php include(SHARED_PATH . '/footer.php'); ?>





