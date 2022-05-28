<?php require_once('../../../private/initialize.php');


if (is_get_request()) {

	if (isset($_GET['comp_id'])) :
		$companyId = $_GET['comp_id'] ?? '';
		$branches = Branch::find_by_company_id($companyId);
?>
		<select class="form-control" id="branch">
			<option value="">Select branch</option>
			<?php foreach ($branches as $branch) : ?>
				<option value="<?php echo $branch->id ?>">
					<?php echo ucwords($branch->branch_name) ?>
				</option>
			<?php endforeach; ?>
		</select>
		<button class="btn btn-primary query">
			<i class="feather-filter"></i></button>
	<?php
	endif;

	if (isset($_GET['complete_filter'])) :
		$companyId = $_POST['companyId'] ?? '';
		$branchId = $_POST['branchId'] ?? '';



		if (empty($companyId) && empty($branchId)) :
			$filteredData = Billing::find_by_undeleted();
		else :
			$filteredData = Billing::find_by_filtering($companyId, $branchId);
		endif; ?>

		<?php pre_r($_POST); ?>

		<table id="rowSelection" class=" table table-striped table-hover responsive nowrap" style="width:100%">
			<thead>
				<tr class="border-bottom bg-primary">
					<th>S/N</th>
					<th>Action</th>
					<th>Status</th>
					<!-- <th>Show WayBill</th> -->
					<th>Invoice No.</th>
					<th>Branch</th>
					<th>Customer Name</th>
					<th>Payment Method</th>
					<th>Created Date</th>
					<th>Due Date</th>
					<th>Total Amount</th>
					

				</tr>
			</thead>

			<tbody>
				<?php
				$sn = 1;
				foreach ($filteredData as $value) :
					$customer = Client::find_by_id($value->client_id);
					$branch = Branch::find_by_id($value->branch_id);
					$today = date('Y-m-d');
					$due_date =  date('Y-m-d',strtotime('+'.$value->due_date.' days',strtotime($today)));
					$status = 'Delivered';
				?>
					<tr>
						<td><?php echo $sn++; ?></td>
						<td>

							<div class="dropdown ">
								<div class="btn-group">
									<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="feather-more-vertical" title="More Options" style="font-weight: bolder;"></i> More
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="<?php echo url_for('invoice/invoice.php?invoice_no=' . h(u($value->invoiceNum))); ?>">
											<i class="feather-file-text fs-18" title="view"></i> Invoice
										</a>
										<a class="dropdown-item" href="<?php echo url_for('invoice/waybill.php?invoice_no=' . h(u($value->invoiceNum))); ?>">
											<i class="feather-file-text fs-18" title="view"></i> Waybill
										</a>
										<a class="dropdown-item" href="<?php echo url_for('/invoice/edit.php?invoiceNum=' . $value->invoiceNum); ?>"> <i class="feather-maximize-2 tet-info"></i> Recall Invoice </a>

										<a href="#!" class="dropdown-item" id="delete_void" data-id="<?php echo $value->id; ?>"> <i class="feather-maximize-2 tet-info"></i> Void </a>

									</div>
								</div>
							</div>
						</td>
						<td>
							<?php echo $status ?>
						</td>
						
						<td><?php echo h(ucwords($value->invoiceNum)); ?></td>
						<td><?php echo h(ucwords(substr($branch->branch_name, 0, 30))); ?></td>
						<td><?php echo $customer->full_name(); ?></td>
						<td><?php echo h(Billing::PAYMENT_METHOD[$value->billingFormat]); ?></td>
						<td><?php echo h(date('D jS F, Y H:i:s', strtotime($value->created_date))); ?></td>
						<td><?php echo h(date('D jS F, Y', strtotime($due_date))); ?></td>
						<td><?php echo number_format($value->total_amount); ?></td>
						
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<script src="<?php echo url_for('vendor/datatables/custom/custom-datatables.js') ?>"></script>

<?php
	endif;
}
