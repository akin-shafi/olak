<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'Add Sales';
$products = Product::find_all_product($loggedInAdmin->branch_id);
$company = Company::find_by_id($loggedInAdmin->company_id);
$branches = Branch::find_all_branch(['company_id' => $company->id]);
$adminLevel = $loggedInAdmin->admin_level;
include(SHARED_PATH . '/admin_header.php'); ?>

<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			<div class="card">
				<div class="card-body">
					<div class="table-container border-0 shadow">
						<div class="table-responsive">
							<!-- <table id="copy-print-csv_wrapper" class="table custom-table table-sm "> -->
							<table id="dataSheet" class="table custom-table">
								<thead>
									<tr class="bg-primary text-white text-center">
										<th>PRODUCT NAME</th>
										<th>PRODUCT RATE</th>

										<?php if (in_array($adminLevel, [1, 2, 3])) : ?>
											<th>OPENING STOCK</th>
											<th>NEW STOCK (INFLOW)</th>
											<th>TOTAL STOCK</th>
										<?php endif; ?>

										<?php if (in_array($adminLevel, [1, 2, 4])) : ?>
											<th>SALES (LTRS)</th>
											<th>EXPECTED STOCK (LTRS)</th>
											<th>ACTUAL STOCK (LTRS)</th>
											<th>OVER/SHORT</th>
											<th>REMITTANCE (<?php echo $currency ?>)</th>
											<!-- <th>EXP. SALES VALUE #</th>
										 	<th>TOTAL SALES (LTRS)</th>
											<th>TOTAL VALUE #</th>
											<th>GRAND TOTAL VALUE #</th> -->
										<?php endif; ?>
										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php foreach ($products as $product) : ?>
										
									<tr class=" text-center">
										<td><?php echo strtoupper($product->name) . ' (TANK ' . $product->tank . ')'; ?></td>
										<td><?php echo $product->rate; ?></td>

										<?php if (in_array($adminLevel, [1, 2, 3])) : ?>
											<td>0</td>
											<td>0</td>
											<td>0</td>
										<?php endif; ?>

										<?php if (in_array($adminLevel, [1, 2, 4])) : ?>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
										<?php endif; ?>
										<th><div class="btn btn-sm btn-primary enterDeep" data-id="<?php echo $product->id; ?>">Enter Deep</div></th>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>


<div class="modal fade show" id="enterDeepModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-modal="true">
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
						<div class="form-group">
							<label>OPENING STOCK </label>
							<input type="" name="opening_stock" class="form-control">
						</div>	
						<div class="form-group">
							<label>NEW STOCK (INFLOW)</label>
							<input type="" name="new_stock" class="form-control" value="0">
						</div>
						
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
	$(document).on('click', '.enterDeep', function() {
		$("#enterDeepModal").modal('show')
	})
	
</script>