<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'All Sales';
include(SHARED_PATH . '/admin_header.php'); 
// $today = date('Y-m-d');
$today = date('Y-m-d', strtotime('2022-5-26'));

// $datasheet = DataSheet::data_sheet_report($today, ['company'=>$loggedInAdmin->company_id, 'branch'=>$loggedInAdmin->branch_id]);
$datasheet = DataSheet::data_sheet_report($today, ['company'=>$loggedInAdmin->company_id, 'branch'=>'2']);

$remit = [];

foreach($datasheet as $data):
	array_push($remit,$data->cash_submitted);
endforeach;

$remitted = array_sum($remit);
// pre_r($datasheet);
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
						<td> <?php echo number_format($remitted,2); ?>
						<input type="hidden" id="" value="5890400"></td>
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


<div class="modal fade show" id="expenseModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-modal="true" style="display: ;">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manage Sales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
      </div>
      <form id="expense_form">
        <div class="modal-body">
          <div class="container">
           <table class="table">
	           	 <tr>
	            	<td>Credit Sales</td>
	            	<td><input type="text" class="form-control" name=""></td>
	            </tr>
	            <tr>
	            	<td>Cash Sales</td>
	            	<td><input type="text" class="form-control" name=""></td>
	            </tr>
	            <tr>
	            	<td>POS </td>
	            	<td><input type="text" class="form-control" name=""></td>
	            </tr>
	            <tr>
	            	<td>Transfer </td>
	            	<td><input type="text"  class="form-control"name=""></td>
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
	$(document).on('click', '#manage', function() {
		$('#expenseModel').modal('show');
	})
</script>
