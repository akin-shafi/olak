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
		$companyId = $_GET['companyId'] ?? '';
		$branchId = $_GET['branchId'] ?? '';

		if (empty($companyId) && empty($branchId)) :
			$filteredData = Billing::find_by_undeleted();
		else :
			$filteredData = Billing::find_by_filtering($companyId, $branchId);
		endif; ?>

		<table id="rowSelection" class=" table table-striped table-hover responsive nowrap" style="width:100%">
			<thead>
				<tr class="border-bottom bg-primary">
					<th>S/N</th>
					<th>Action</th>
					<th>Invoice No.</th>
					<th>Branch</th>
					<th>Client Name</th>
					<th>Billing Format</th>
					<th>Start Date</th>
					<th>Due Date</th>
					<th>Total Amount</th>
					<th>Action</th>

				</tr>
			</thead>

			<tbody>
				<?php
				$sn = 1;
				foreach ($filteredData as $client) :
					$customer = Client::find_by_id($client->client_id);
					$branch = Branch::find_by_id($client->branch_id);
				?>
					<tr>
						<td><?php echo $sn++; ?></td>
						<td>
							<a href="<?php echo url_for('invoice/invoice.php?invoice_no=' . h(u($client->invoiceNum))); ?>">
								<i class="feather-file-text fs-18" title="view"></i> Invoice
							</a>
						</td>
						<td><?php echo h(ucwords($client->invoiceNum)); ?></td>
						<td><?php echo h(ucwords(substr($branch->branch_name, 0, 30))); ?></td>
						<td><?php echo $customer->full_name(); ?></td>
						<td><?php echo h(ucwords($client->billingFormat)); ?></td>
						<td><?php echo h($client->start_date); ?></td>
						<td><?php echo h($client->due_date); ?></td>
						<td><?php echo number_format($client->total_amount); ?></td>
						<td>

							<div class="dropdown ">
								<div class="btn-group">
									<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="feather-more-vertical" title="More Options" style="font-weight: bolder;"></i> More
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="<?php echo url_for('/invoice/edit.php?invoiceNum=' . $client->invoiceNum); ?>"> <i class="feather-maximize-2 tet-info"></i> Recall Invoice </a>

										<a href="#!" class="dropdown-item" id="delete_void" data-id="<?php echo $client->id; ?>"> <i class="feather-maximize-2 tet-info"></i> Void </a>

									</div>
								</div>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<script src="<?php echo url_for('vendor/datatables/custom/custom-datatables.js') ?>"></script>

<?php
	endif;
}
