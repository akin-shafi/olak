<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'All Sales';
include(SHARED_PATH . '/admin_header.php');
// $today = date('Y-m-d');
$today = '2022-5-21';

$datasheet = DataSheet::data_sheet_report($today);

pre_r($datasheet);
?>

<!-- Content wrapper start -->
<div class="content-wrapper">
	<div class="d-flex justify-content-between align-items-center">
		<h4>MANAGE SALES (<?php echo date('d-m-Y', strtotime($today)) ?>) </h4>
		<div class="mb-3">
			<select class="form-control" name="branch_id" id="sBranch" form="edit_sheet_form" required>
				<option value="">select branch</option>
				<?php foreach ($branches as $branch) : ?>
					<option value="<?php echo $branch->id ?>" <?php echo $branch->id == $data->branch_id ? 'selected' : ''; ?>>
						<?php echo ucwords($branch->name) ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>Date</th>
						<th>Total Remittance</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>12 May 2022</td>
						<td>5,89040,0 <input type="hidden" id="" value="5890400"></td>
						<td>
							<button class="btn btn-primary btn-sm" id="manage">Manage</button>

						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

</div>

<!-- 
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->


<div class="modal fade show" id="expenseModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-modal="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Manage Sales</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			</div>
			<form id="cash_flow_form">
				<input type="hidden" name="cash_flow">
				<div class="modal-body">
					<div class="container">
						<table class="table">
							<tr>
								<td>Credit Sales</td>
								<td><input type="text" name="flow[credit_sales]" class="form-control"></td>
							</tr>
							<tr>
								<td>Cash Sales</td>
								<td><input type="text" name="flow[cash_sales]" class="form-control"></td>
							</tr>
							<tr>
								<td>POS </td>
								<td><input type="text" name="flow[pos]" class="form-control"></td>
							</tr>
							<tr>
								<td>Transfer </td>
								<td><input type="text" name="flow[transfer]" class="form-control"></td>
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
		const BACK_URL = './'
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
	})
</script>