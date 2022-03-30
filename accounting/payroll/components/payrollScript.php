<?php require_once('../../private/initialize.php'); ?>

<?php  if (isset($_POST['fetch_page'])) {
	// $company_id = $_POST['company_id'];
	// $calculate_tax = 0;
	// $month = $_POST['month'];
	// $payrolls = Payroll::find_by_created_at($month);

	// $page = $_POST['fetch_page'];
	// $company_name = Company::find_by_id($company_id)->company_name;




	$company_id = $_POST['company_id'] ?? '';
	$calculate_tax = 0;

	$lastDate = date('Y-m', strtotime('last month'));
	$thisDate = date('Y-m');

	$month = $_POST['month'] ?? $lastDate;
	$payrolls = Payroll::find_by_created_at($month);

	$page = $_POST['fetch_page'];
	$company_name = Company::find_by_id($company_id)->company_name ?? "All";

	$payrollPayable    = Payroll::sum_of_tak_home(['month' => $month]);
	$salaryPayable     = Employee::find_by_total_salary();
	$tax_payable = Payroll::sum_of_tax_payable();
	$employee = Employee::find_by_undeleted();

 ?>
<div class="page-header d-xl-flex d-block">
      <div class="page-leftheader">
         <h4 class="page-title"><?php echo $company_name ?> | <span class="font-weight-normal text-muted ms-2"> <?php echo $page ?></span></h4>
      </div>
      <div class="page-rightheader ms-md-auto">
         <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            
         </div>
      </div>
   </div>

 <div class="row">
	<div class="col-xl-4 col-lg-12 col-md-12">
	   <div class="card">
	      <div class="card-body">
	         <div class="row">
	            <div class="col-9">
	               <div class="mt-0 text-start">
	                  <span class="fs-14 font-weight-semibold">Sum of Actual Salary</span> 
	                  <h3 class="mb-0 mt-1  mb-2"><?php echo number_format($salaryPayable->total_salary, 2) ?></h3>
	               </div>
	               <span class="text-muted"> <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>For <?php echo $salaryPayable->counts; ?>  </span> Employees </span> 
	            </div>
	            <div class="col-3">
	               <div class="icon1 bg-success brround my-auto  float-end"> <?php echo $currency ?> </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>

	<div class="col-xl-4 col-lg-12 col-md-12">
	   <div class="card">
	      <div class="card-body">
	         <div class="row">
	            <div class="col-9">
	               <div class="mt-0 text-start">
	                  <span class="fs-14 font-weight-semibold">Payroll Payable | <?php echo date('M Y', strtotime($month)) ?></span> 
	                  <h3 class="mb-0 mt-1  mb-2"><?php echo number_format($payrollPayable, 2) ?></h3>
	               </div>
	               <span class="text-muted"> <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>For <?php echo $salaryPayable->counts; ?> </span> Employees  </span> 
	            </div>
	            <div class="col-3">
	               <div class="icon1 bg-primary brround my-auto  float-end"> <?php echo $currency ?> </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>
	<?php if ($calculate_tax == 1) { ?>
	<div class="col-xl-4 col-lg-12 col-md-12">
	   <div class="card">
	      <div class="card-body">
	         <div class="row">
	            <div class="col-9">
	               <div class="mt-0 text-start ">
	                  <span class="fs-14 font-weight-semibold ">Sum of Tax Payable | <?php echo date('M Y', strtotime($month)) ?></span> 
	                  <h3 class="mb-0 mt-1  mb-2"><?php echo number_format($tax_payable, 2) ?? '0.00' ?></h3>
	               </div>
	               <span class="text-muted"> <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>For <?php echo count($employee) ?? 0 ?> </span> Staff </span> 
	            </div>
	            <div class="col-3">
	               <div class="icon1 bg-secondary brround my-auto  float-end"> <?php echo $currency ?> </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>
	<?php } ?>
</div>



<div class="box">
	<div class="box-header with-border d-flex justify-content-between">
		<h3 class="box-title"><?php echo !empty($company_name) ? $company_name : 'All' ?> Staff Salary | for <?php echo date('M Y', strtotime($month))   ?></h3>
		<button class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#excelmodal"> 
	 	  <i class="las la-file-excel"></i> Download Monthly Excel Report 
	    </button> 
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer">
				<thead>
					<tr>
						 <th class="bg-white">S/N</th>
                   <th class="bg-white">#Emp Name</th>
                   <th>Company</th>
                   <th>(₦) Gross Salary</th>
                   <?php if ($calculate_tax == 1) { ?>
                      <th>(₦) Monthly Tax</th>
                      <th>(₦) Pension</th>
                   <?php } ?>
                   
                   <th>(₦) Salary Advance</th>
                   <th>(₦) Loan</th>
                   <th>(₦) Take Home</th>
                   <th>Status</th>
                   <th class="bg-white">Action</th>
					</tr>
				</thead>
				<tbody> 
					<?php 
						$sn = 1; 
						foreach (Payroll::find_by_month(['month' => $month, 'payment_status' => 2]) as $key => $value) { 
							// pre_r($value);
						$salary = intval($value->present_salary);
						$employee = Employee::find_by_id($value->employee_id);

						$salary_advance = intval($value->salary_advance);
						$loan = intval($value->loan);
						$takehome = $salary - ( $salary_advance + $loan );
						
						if ($company_name != "All") {
							$condition = Company::find_by_company_name($employee->company)->id == $company_id;
						}else{
							$condition = 1;
						}

					?>
						<?php if ($condition) { ?>
							<tr>
										<td class="bg-white"><?php echo $sn++; ?></td>
		                         <td class="bg-white">
		                              <div class="d-flex">
		                                 <span class="avatar avatar-md brround me-3" style="background-image: url('')"></span>
		                                 <div class="me-3 mt-0 mt-sm-1 d-block">
		                                    <h6 class="mb-1 fs-14"><?php echo isset($employee->first_name) ? $employee->full_name() : 'Not Set' ?></h6>
		                                    <p class="text-muted mb-0 fs-12">Emp ID: <?php echo isset($employee->employee_id) ? str_pad($employee->employee_id, 3, '0', STR_PAD_LEFT) : 'Not Set'; ?></p>
		                                 </div>
		                              </div>
		                         </td>
		                         <td><?php echo $employee->company ?></td>
		                         <td><?php echo number_format($salary, 2) ?></td>
		                         <?php if ($calculate_tax == 1) { ?>
		                            <td>(₦) Montdly Tax</td>
		                            <td>(₦) Pension</td>
		                         <?php } ?>
		                         
		                         <td><?php echo number_format($salary_advance, 2) ?></td>
		                         <td><?php echo number_format($loan, 2) ?></td>
		                         <td><?php echo number_format($takehome, 2) ?></td>
		                         <td>
		                           <span class="badge badge-danger">Unpaid</span>
		                         </td>
		                         <td class="bg-white">Action</td>
							</tr>
					   <?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	
</div>
 <?php } ?>