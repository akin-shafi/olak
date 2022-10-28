<?php require_once('../../private/initialize.php'); ?>

<?php if (isset($_POST['fetch'])) {
	$staff_id = $_POST['staff_id'] ?? '';
	$employee = Employee::find_by_id($staff_id);
	$salary = $employee->present_salary ?? 0;

	if (!empty($employee)) :
?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Select Staff</label>
					<select class="form-control select2" id="staff_id">
						<option value="">--- Select ---</option>
						<?php foreach (Employee::find_by_undeleted() as $key => $value) { ?>
							<option <?php echo $value->id == $staff_id ? 'selected' : '' ?> value="<?php echo $value->id ?>" data-salary="<?php echo $value->present_salary ?>"><?php echo Employee::find_by_id($value->id)->full_name() ?></option>
						<?php } ?>

					</select>

				</div>
			</div>
			<div class="col-sm-6">
				<label>Net Salary</label>
				<input class="form-control" type="text" value="<?php echo $salary ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<h4 class="text-primary">Earnings</h4>
				<?php foreach (PayrollItem::find_by_category(1) as $key => $allItem) { ?>

					<div class="form-group">
						<label><?php echo $allItem->item ?>( <?php echo $allItem->amount ?>%)</label>
						<input class="form-control" type="text" value="<?php echo $salary / 100 * $allItem->amount   ?>">
					</div>
				<?php } ?>

			</div>
			<div class="col-sm-6">
				<h4 class="text-primary">Deductions</h4>
				<?php foreach (PayrollItem::find_by_category(3) as $key => $allItem) { ?>

					<div class="form-group">
						<label><?php echo $allItem->item ?>( <?php echo $allItem->amount ?>%)</label>
						<?php if ($allItem->item  == "Tax(PAYE)") {
							$netPay = $salary * 12;
						?>
							<input class="form-control" type="text" value="PayE">
						<?php } else {  ?>
							<input class="form-control" type="text" value="<?php echo $salary / 100 * $allItem->amount   ?>">
						<?php } ?>
					</div>
				<?php } ?>

			</div>
		</div>

<?php endif;
} ?>


<?php if (isset($_POST['tax_calculator'])) {
	$emp_id = $_POST['emp_id'] ?? 1;
	$employee = Employee::find_by_id($emp_id);
	$netSalary = !empty($employee) ? intval($employee->present_salary) : 0;

	$tax = Payroll::tax_calculator(['netSalary' => $netSalary]);
	if (!empty($employee)) :
?>

		<div class="row">
			<div class="col-xl-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-header border-0">
						<h4 class="mb-0"><?php echo $employee->full_name() ?> (<?php echo $employee->job_title ?>)</h4>
					</div>

					<div class="card-body">
						<div class="table-responsive">

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

<?php endif;
} ?>


<?php if (isset($_POST['tax_calculator'])) {
	$emp_id = $_POST['emp_id'] ?? 1;
	$employee =  Employee::find_by_id($emp_id);
	$netSalary = !empty($employee) ? intval($employee->present_salary) : 0;

	$tax = Payroll::tax_calculator(['netSalary' => $netSalary]);
?>



<?php } ?>