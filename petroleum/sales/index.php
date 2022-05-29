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
						<?php if (isset($message)) : ?>
							<div class="alert alert-success justify-content-center">
								<?php echo $message ?? ''; ?>
							</div>
						<?php endif; ?>
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
											<th>
												<a href="<?php echo url_for('sales/create.php?product=' . $product->id) ?>" class="btn btn-sm btn-primary enterDip">Enter Dip (LTRS)</a>
											</th>
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


<?php include(SHARED_PATH . '/admin_footer.php'); ?>