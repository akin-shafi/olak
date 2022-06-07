<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'Manage Sales';
include(SHARED_PATH . '/admin_header.php');
$today = date('Y-m-d');

$admComp = $loggedInAdmin->company_id;
$branch = $loggedInAdmin->company_id;

$remit = DataSheet::find_by_remittance($today, ['company' => $admComp, 'branch' => $loggedInAdmin->branch_id]);

$cashFlow = CashFlow::find_by_cash_flow($today, ['company' => $admComp, 'branch' => $branch]);

?>

<!-- Content wrapper start -->
<div class="content-wrapper">
	<div class="card">
		<div class="card-body">
			<div class="shadow">
				<div class="d-flex justify-content-between align-items-center m-3">
					<h3 class="text-uppercase">Sales Remittance (<?php echo date('d-m-Y', strtotime($today)) ?>) </h3>
				</div>

				<div class="row">
					<div class="col-md-6 mx-auto">
						<div class="table-responsive">
							<table class="table custom-table text-center">
								<thead>
									<tr class="bg-primary text-white">
										<th>Date</th>
										<th>Total Remittance</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo date('M d, Y') ?></td>
										<td> <?php echo number_format($remit->remittance, 2); ?>
										</td>
										<td>
											<button class="btn btn-primary" id="manage" <?php echo isset($cashFlow->id) && $cashFlow->id != '' ? 'disabled' : '' ?>>Manage</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


<div class="modal fade show" id="expenseModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-modal="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Manage Sales</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			</div>
			<form id="cash_flow_form" enctype="multipart/form-data">
				<input type="hidden" name="cash_flow">
				<div class="modal-body">
					<div class="container">
						<table class="table table-sm">
							<tr>
								<td class="text-right">Cash Sales</td>
								<td><input type="text" name="flow[cash_sales]" class="form-control"></td>
							</tr>
							<tr>
								<td class="text-right">Transfer</td>
								<td><input type="text" name="flow[transfer]" class="form-control"></td>
							</tr>
							<tr>
								<td class="text-right">POS</td>
								<td><input type="text" name="flow[pos]" class="form-control"></td>
							</tr>
							<tr>
								<td class="text-right">Cheque</td>
								<td><input type="text" name="flow[cheque]" class="form-control"></td>
							</tr>
							<tr>
								<td class="text-right">Credit Sales</td>
								<td><input type="text" name="flow[credit_sales]" class="form-control"></td>
							</tr>
							<tr>
								<td class="text-right">Narration</td>
								<td>
									<textarea name="flow[narration]" class="form-control"></textarea>
								</td>
							</tr>
							<tr>
								<td class="text-right"><sup class="text-secondary">(Optional)</sup>Upload</td>
								<td>
									<div class="custom-file">
										<label class="custom-file-label">Upload</label>
										<input type="file" name="voucher" class="custom-file-input">
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="save_expenses">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		const BACK_URL = '<?php echo url_for('report/') ?>'
		const PET_URL = 'inc/process.php';

		$(document).on('click', '#manage', function() {
			$('#expenseModel').modal('show');
		})

		$('#cash_flow_form').on("submit", function(e) {
			e.preventDefault();

			$.ajax({
				url: PET_URL,
				method: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				dataType: 'json',
				success: function(r) {
					successAlert(r.msg);
					window.location.href = BACK_URL
				},
				error: function(e) {
					errorAlert(e.responseJSON.error)
				}
			})
		});


		$(document).on('click', "#query", function() {
			let branch = $('#fBranch').val()
			if (branch == '') {
				alert('Kindly select a branch')
				window.location.reload();
			} else {
				let filterDate = $('#filter_date').val()
				getDataSheet(branch, filterDate)
			}
		})

		const getDataSheet = (branch, fltDate) => {
			$.ajax({
				url: PET_URL,
				method: "GET",
				data: {
					branch: branch,
					filterDate: fltDate,
					filter: 1
				},
				cache: false,
				beforeSend: function() {
					$('.lds-hourglass').removeClass('d-none');
				},
				success: function(r) {
					$('#expenseReport').html(r)
					setTimeout(() => {
						$('.lds-hourglass').addClass('d-none');
					}, 250);
				}
			})
		}


		let branch = $('#fBranch').val()
		let filterDate = $('#filter_date').val()
		getDataSheet(branch, filterDate)
	})
</script>