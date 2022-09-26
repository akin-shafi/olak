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
		$companyId = $_GET['companyId'] ?? 1;
		$branchId = $_GET['branchId'] ?? 1;
		$qbacklog = $_GET['qbacklog'] ?? 1;
		$status = $_GET['status'] ?? 1;


		if ($qbacklog == 0 && $status == 1) {
			$label = 'Not Yet Supplied:';
		}else if($qbacklog == 0 && $status == 2){
			$label = 'Supplied Goods:';
		}else{
			$label = 'Backlog Transactions:';
		}

		if (in_array($loggedInAdmin->admin_level, [1,2,3])) :
			$filteredData = Billing::find_by_filtering(['backlog' => $qbacklog, 'status' => $status]);
			$output = "All Branches ". $label;
		else :
			$filteredData = Billing::find_by_filtering(['company_id' => $loggedInAdmin->company_id, 'branch_id' => $loggedInAdmin->branch_id, 'backlog' => $qbacklog, 'status' => $status ]);
			$output = $label." ". Branch::find_by_id($loggedInAdmin->branch_id)->branch_name;
		endif;
		
		
		

		// $filteredData = Billing::find_by_filtering(['company_id' => $loggedInAdmin->company_id, 'branch_id' => $loggedInAdmin->branch_id, 'backlog' => $backlog, 'status' => $status ]);
		// $output = "All Receipts: " //. Branch::find_by_id($loggedInAdmin->branch_id)->branch_name; 
	?>

		<?php //pre_r($_POST); ?>
		<div class="h3"><?php echo $output ?? "" ?></div>
		<table id="rowSelection" class=" table table-striped table-hover responsive nowrap" style="width:100%">
			<thead>
				<tr class="border-bottom bg-primary">
					<th>S/N</th>
					<th>Action</th>
					<th>Status</th>
					<th>Invoice No.</th>
					<th>Branch</th>
					<th>Customer Name</th>
					<th>Created Date</th>
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
					$due_date =  date('Y-m-d', strtotime('+' . $value->due_date . ' days', strtotime($today)));
					$status = 'Booked';
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
											<i class="feather-file-text fs-18" title="Invoice"></i> Invoice
										</a>
										<?php if ($accessControl->process_waybill == 1): ?>
											<?php if ($value->status == 1):  ?>
											<a href="#" class="dropdown-item process_waybill" data-id="<?php echo $value->invoiceNum ?>" >
												<i class="feather-loader fs-18" title="Process Waybill"></i> Process Waybill
											</a>
											<?php endif ?>
											<?php if ($value->status == 2):  ?>
											<a class="dropdown-item waybill" data-id="<?php echo $value->invoiceNum ?>" href="<?php echo url_for('invoice/waybill.php?invoice_no=' . h(u($value->invoiceNum))); ?>">
												<i class="feather-file-text fs-18" title="Print Waybill"></i>Print Waybill
											</a>
											
											<a class="dropdown-item" href="<?php echo url_for('/invoice/edit.php?invoiceNum=' . $value->invoiceNum); ?>"> <i class="feather-maximize-2 tet-info"></i> Recall Invoice </a>

											<a href="#!" class="dropdown-item" id="delete_void" data-id="<?php echo $value->id; ?>"> <i class="feather-maximize-2 tet-info"></i> Void </a>
											<?php endif ?>
										<?php endif ?>

									</div>
								</div>
							</div>
						</td>
						<td>
							<?php //echo $status ?>
							<?php echo h(Billing::STATUS[$value->status]); ?>
						</td>

						<td><?php echo h(ucwords($value->invoiceNum)); ?></td>
						<td><?php echo h(ucwords(substr($branch->branch_name, 0, 30))); ?></td>
						<td><?php echo $customer->full_name(); ?></td>
						<td><?php echo h(date('D jS M, Y H:i:s', strtotime($value->created_date))); ?></td>
						<!-- <td><?php //echo h(date('D jS F, Y', strtotime($due_date))); ?></td> -->
						<td><?php echo number_format($value->total_amount); ?></td>

					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<script src="<?php echo url_for('vendor/datatables/custom/custom-datatables.js') ?>"></script>

<?php
	endif;
}
