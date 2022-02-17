<?php require_once('../../private/initialize.php'); ?>

<?php

if (is_get_request()) {
	if (isset($_GET['fetch_page'])) {
		$calculate_tax = 0;
		$month = $_GET['month'] ?? date('Y-m');
		$page = $_GET['fetch_page'];

		$monthlyPayroll = Payroll::find_by_created_at($month);

		if (!empty($monthlyPayroll)) {
			$payment_status = $monthlyPayroll[0]->payment_status;
			if (!in_array($payment_status, [0, 1, 2])) {
				$status = true;
			}
		}

		$isCompany = $_GET['params']['company'] ?? false;
		$isBranch  = $_GET['params']['branch'] ?? false;

		if ($_GET['fetch_page'] == 'confirmed_payment') {
			if (empty($_GET['params']['confirmed']) || !isset($_GET['params']['confirmed'])) :
				http_response_code(404);
				exit(json_encode(['msg' => 'Kindly select at least one record!']));
			endif;

			$payrollIds = $_GET['params']['confirmed'] ?? [];

			foreach ($payrollIds as $key => $id) {
				$update = Payroll::find_by_id($id);
				$args = ['payment_status' => 4];

				$update->merge_attributes($args);
				$update->save();
			}
		}

		$companies = Employee::find_by_company_name('', ['company' => $isCompany]);
		$employeeCompanyBranch = Employee::find_by_company_and_branch(strtolower($isCompany), strtolower($isBranch));
		$totalSalaryByBranch = Employee::find_by_company_total_salary(strtolower($isCompany), ['branch' => true]);

		// $payrollPayable    = Payroll::sum_of_take_home(['month' => $month, 'company_id' => $company_id]);
		$payrollPayable    = Payroll::sum_of_take_home(['month' => $month, 'company' => $isCompany]);
		$salaryPayable     = Employee::find_by_total_salary(['company' => $isCompany]);
		$tax_payable       = Payroll::sum_of_tax_payable();

		// pre_r($payrollPayable);

?>
		<style>
			.analytic .card:hover {
				background-color: #063bb3;
				color: red;
			}

			.analytic .card:hover span {
				color: #FFF !important;
			}

			.analytic .card:hover h5 {
				color: #FFF !important;
			}

			.current {
				background-color: #063bb3;
			}

			.current span,
			.current h5 {
				color: #FFF !important;
			}
		</style>
		<div class="container">
			<div class="row analytic">
				<?php foreach (Company::find_all_company() as $key => $value) :
					$companyName = !empty($value->company_name) ? $value->company_name : 'not set';
					$totalSalaryByCompany = Employee::find_by_company_total_salary(strtolower($companyName));
					$companyQuery = $totalSalaryByCompany->company != '' ? $totalSalaryByCompany->company : 'not set'; ?>
					<div class="col-xl-3 col-lg-6 col-md-12">
						<div class="card shadow-lg <?php echo strtolower($isCompany) == strtolower($companyQuery) ? 'current' : '' ?>">
							<div class="card-body shadow-lg">
								<a href="#" class="query" data-company="<?php echo $companyQuery ?>">
									<div class="row">
										<div class="col-8">
											<div class="mt-0 text-start">
												<span class="fs-16 font-weight-semibold">
													<?php echo $totalSalaryByCompany->company != '' ? ucwords($companyName) : 'Not set' ?></span>
												<h5 class="mb-0 mt-1 mb-2"><?php echo number_format($totalSalaryByCompany->total_salary, 2) ?></h5>
												<span class="text-muted">
													<span class="<?php echo strtolower($isCompany) == strtolower($companyQuery) ? 'text-white' : Employee::TEXT_COLOR[$key] ?> fs-12 mt-2 me-1">
														<i class="feather feather-arrow-up-right me-1 <?php echo Employee::BG_COLOR[$key] . '-transparent' ?>  p-1 brround"></i>
														<?php echo $totalSalaryByCompany->counts ?> Employees</span>
												</span>
											</div>
										</div>
										<div class="col-4">
											<div class="icon1 <?php echo Employee::BG_COLOR[$key] ?> my-auto  float-end"><?php echo $currency ?></div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>

			<!-- //! This is not required for now -->
			<div class="row d-none">
				<div class="col-xl-4 col-lg-12 col-md-12">
					<div class="card shadow-lg">
						<div class="card-body shadow-lg">
							<div class="row">
								<div class="col-9">
									<div class="mt-0 text-start">
										<span class="fs-14 font-weight-semibold">Sum of Gross Salary</span>
										<h3 class="mb-0 mt-1  mb-2" id="actual_salary"><?php //echo number_format($salaryPayable->total_salary, 2) 
																																		?></h3>
									</div>
									<span class="text-muted"> <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>For <?php echo $salaryPayable->counts; ?> </span> Employees </span>
								</div>
								<div class="col-3">
									<div class="icon1 bg-success brround my-auto  float-end"> <?php echo $currency ?> </div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-4 col-lg-12 col-md-12">
					<div class="card shadow-lg">
						<div class="card-body shadow-lg">
							<div class="row">
								<div class="col-9">
									<div class="mt-0 text-start">
										<span class="fs-14 font-weight-semibold">Actual Payroll Payable | <?php echo date('M Y', strtotime($month)) ?></span>
										<h3 class="mb-0 mt-1  mb-2" id=""><?php echo number_format($payrollPayable, 2) ?></h3>
									</div>
									<span class="text-muted"> <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>For <?php echo $salaryPayable->counts; ?> </span> Employees </span>
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
							<div class="card-body container">
								<div class="row">
									<div class="col-9">
										<div class="mt-0 text-start ">
											<span class="fs-14 font-weight-semibold ">Sum of Tax Payable | <?php echo date('M Y', strtotime($month)) ?></span>
											<h3 class="mb-0 mt-1  mb-2"><?php echo number_format($tax_payable, 2) ?? '0.00' ?></h3>
										</div>
										<span class="text-muted"> <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>For <?php echo count(Employee::find_by_undeleted()) ?? 0 ?> </span> Staff </span>
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
			<!-- //! This is not required for now -->

			<div class="card">
				<div class="card-header border-0 responsive-header">
					<h4 class="card-title"><?php echo !empty($companies[0]->company) ? $companies[0]->company : 'Company Not Set'; ?></h4>
				</div>
				<div class="card-body">
					<div class="row">
						<?php foreach ($totalSalaryByBranch as $key => $value) : ?>
							<div class="col-xl-3 col-lg-6 analytic">
								<div class="card <?php echo strtolower($isBranch) == strtolower($value->branch) ? 'current' : '' ?>">
									<div class="card-body shadow-lg">
										<a href="#" class="branchQuery" data-company="<?php echo $isCompany ?>" data-branch="<?php echo $value->branch ?>">
											<div class="row">
												<div class="col-9">
													<div class="mt-0">
														<span class="fs-14 font-weight-bold">
															<?php echo $value->branch != '' ? ucwords($value->branch) : 'Branch not set' ?></span>
														<h5 class="mb-0 mt-1 mb-2"><?php echo number_format($value->total_salary, 2) ?></h5>
														<span class="<?php echo Employee::TEXT_COLOR[$key] ?> fs-12 mt-2 me-1">
															<i class="feather feather-arrow-up-right me-1 <?php echo Employee::BG_COLOR[$key] . '-transparent' ?>  p-1 brround"></i>
															<?php echo $value->counts ?> Employees</span>
													</div>
												</div>
												<div class="col-3">
													<div class="icon1 <?php echo Employee::BG_COLOR[$key] ?> my-auto  float-end"><?php echo $currency ?></div>
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<?php if ($isBranch) : ?>
						<div class="row" style="margin: 40px 0;">
							<div class="col-lg-6 col-12">
								<h6 class="box-title"><?php echo $isCompany . ' (' . $isBranch . ')' ?> Staff Salary | for <?php echo date('M Y', strtotime($month))   ?></h5>
							</div>

							<div class="col-lg-6 col-12">
								<div class="d-flex justify-content-end ">
									<div class="btn-group">
										<button type="button" data-company="<?php echo $isCompany ?>" data-branch="<?php echo $isBranch ?>" class="btn btn-info confirm mr-5">Confirm Payment</button>
										<button type="button" class="btn btn-primary received mr-5 <?php echo $status ? 'd-none' : '' ?>">Payroll Received</button>
									</div>

									<div class="downloadable <?php echo $status ? '' : 'd-none' ?>">
										<?php
										$company_id = '';
										if ($company_id == '2') { ?>

											<a target="_blank" href="#" class="btn-success btn"> Pay Salary</a>

											<a target="_blank" href="<?php echo url_for('payroll/exportData.php?bank=' . '1' . '&month=' . $month . '&coy=' . $isCompany . '&sort_code=' . '044140395' . '&branch=' . $isBranch) ?>" class="btn-warning btn" style="background:orange; color: #FFF;"> Download Excel Report for <?php echo $isCompany ?></a>

										<?php } else { ?>
											<a target="_blank" href="<?php echo url_for('payroll/exportData.php?bank=' . '2' . '&month=' . $month . '&coy=' . $isCompany . '&sort_code=' . '035141011' . '&branch=' . $isBranch) ?>" class=" btn" style="background:purple; color: #FFF;">Download Excel Report for <?php echo $isCompany ?></a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>

						<div class="table-responsive">
							<?php
							$sn = 1;
							$output = "";
							if (!empty($monthlyPayroll)) {
								$payment_status = $monthlyPayroll[0]->payment_status;
							}
							if (count($monthlyPayroll) > 0   && in_array($payment_status, [2, 3, 4])) {
								$output .= "
											<table class='table table-bordered border-bottom no-footer branch-table'>
												<thead>
														<tr>
															<th><input type='checkbox' id='selectAll'></th>
																<th>S/N</th>
															 <th>Emp Name</th>
															 <th>EMp ID</th>
															 <th>Branch</th>
															 <th>Gross Salary (₦)</th>
															 <th>Salary Advance (₦)</th>
															 <th>Loan (₦)</th>
															 <th>Take Home (₦) </th>
															 <th>Status</th>
														</tr>
												</thead>
											<tbody>";
								foreach ($employeeCompanyBranch as $value) :
									$salary 			= intval($value->present_salary);
									$fullName 		= isset($value->first_name) ? $value->full_name() : 'Not Set';
									$branch 			= isset($value->branch) ? $value->branch : 'Not Set';
									$employee_id 	= isset($value->employee_id) ? str_pad($value->employee_id, 3, '0', STR_PAD_LEFT) : 'Not Set';
									$payroll 	= Payroll::find_by_employee_id($value->id);
									$status 	= Payroll::STATUS[$payroll->payment_status];

									switch ($status) {
										case 'Computed':
											$status_color = 'badge-dark';
											break;
										case 'New':
											$status_color = 'badge-primary';
											break;
										case 'Processing':
											$status_color = 'badge-warning';
											break;
										case 'Paid':
											$status_color = 'badge-success';
											break;
										default:
											$status_color = 'badge-danger';
											break;
									}
									$salary_advance = intval($payroll->salary_advance);
									$loan = intval($payroll->loan);
									$takeHome = $salary - ($salary_advance + $loan);
									$output .= "
													<tr>
														 <td><input type='checkbox' name='payrollId[]' value='$payroll->id' id='pay-$payroll->id'></td>
														 <td>" . $sn++ . "</td>
														<td>
																<div class='d-flex'>
																		<span class='avatar avatar-md brround me-3' style='background-image: url('')'></span>
																		<div class='me-3 mt-0 mt-sm-1 d-block'>
																			<h6 class='mb-1 fs-14'>" . $fullName . "</h6>
																		</div>
																</div>
														</td>
														<td>" . $employee_id . "</td>
														<td>" . $branch . "</td>
														<td>" . number_format($salary, 2) . " <input type='hidden' class='gross_salary' value='" . $salary . "'></td>
														<td>" . number_format($salary_advance, 2) . "</td>
														<td>" . number_format($loan, 2) . "</td>
														<td>" . number_format($takeHome, 2) . "<input type='hidden' class='take_home' value='" . $takeHome . "'></td>
														<td>
															<span class='badge " . $status_color . "'>" . ucfirst($status) . "</span>
														</td>
													</tr>";
								endforeach;
								$output .= "</tbody>
												</table>";
								echo $output;
							} else {
								echo '<h3 class="text-center mt-5">No records found</h3>';
							}
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

<?php }
} ?>


<script>
	$(document).ready(function() {
		$('.branch-table').dataTable();
	})
</script>