<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'All Sales';
include(SHARED_PATH . '/admin_header.php');

$array = ['Rate', 'open stock', 'new stock'];

$dataSheets = DataSheet::find_by_undeleted();
$products = Product::find_by_undeleted();

?>

<!-- Content wrapper start -->
<div class="content-wrapper">
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			<div class="card">
				<div class="card-body">
					<div class="table-container">
						<div class="table-responsive">
							<!-- <table id="copy-print-csv_wrapper" class="table custom-table table-sm "> -->
								<table id="" class="table custom-table">
								<thead>
									<tr class="bg-primary text-white ">
										<th class="font-weight-bold">Product</th>
										<?php foreach ($products as $product) : ?>
											<th class="font-weight-bold text-right">
												<?php echo strtoupper($product->name) . ' (TANK ' . $product->tank . ')'; ?>
											</th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<tr class="font-weight-bold">
										<td class="text-uppercase">Rate</td>
										<?php foreach ($products as $data) : ?>
											<td class="text-right"><?php echo number_format($data->rate, 2); ?></td>
										<?php endforeach; ?>
									</tr>
									<tr>
										<td class="text-uppercase">open stock</td>
										<?php foreach ($dataSheets as $data) : ?>
											<td class="text-right"><?php echo number_format($data->open_stock, 2); ?></td>
										<?php endforeach; ?>
									</tr>
									<tr>
										<td class="text-uppercase">New stock (Inflow)</td>
										<?php foreach ($dataSheets as $data) : ?>
											<td class="text-right"><?php echo $data->new_stock != '' ? number_format($data->new_stock, 2) : 0; ?></td>
										<?php endforeach; ?>
									</tr>
									<tr>
										<td class="text-uppercase">Total stock</td>
										<?php foreach ($dataSheets as $data) : ?>
											<td class="text-right"><?php echo number_format(intval($data->total_stock), 2); ?></td>
										<?php endforeach; ?>
									</tr>
									<tr>
										<td class="text-uppercase">Sales (Ltr)</td>
										<?php foreach ($dataSheets as $data) : ?>
											<td class="text-right"><?php echo number_format(intval($data->sales_in_ltr), 2); ?></td>
										<?php endforeach; ?>
									</tr>
									<tr>
										<td class="text-uppercase">Expected stock (Ltr)</td>
										<?php foreach ($dataSheets as $data) : ?>
											<td class="text-right"><?php echo number_format(intval($data->expected_stock), 2); ?></td>
										<?php endforeach; ?>
									</tr>
									<tr>
										<td class="text-uppercase">Actual stock (Ltr)</td>
										<?php foreach ($dataSheets as $data) : ?>
											<td class="text-right"><?php echo number_format(intval($data->actual_stock), 2); ?></td>
										<?php endforeach; ?>
									</tr>
									<tr>
										<td class="text-uppercase">Over/Short</td>
										<?php foreach ($dataSheets as $data) : ?>
											<td class="text-right <?php echo $data->over_or_short < 0 ? 'text-danger' : '' ?>">
												<?php echo number_format(intval($data->over_or_short), 2); ?></td>
										<?php endforeach; ?>
									</tr>
									<tr class="font-weight-bold">
										<td class="text-uppercase">Expected sales value</td>
										<?php foreach ($dataSheets as $data) : ?>
											<td class="text-right"><?php echo number_format(intval($data->exp_sales_value), 2); ?></td>
										<?php endforeach; ?>
									</tr>
									<tr class="font-weight-bold">
										<td class="text-uppercase">Cash submitted</td>
										<?php foreach ($dataSheets as $data) : ?>
											<td class="text-right"><?php echo number_format(intval($data->cash_submitted), 2); ?></td>
										<?php endforeach; ?>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- Row end -->

</div>
<!-- Content wrapper end -->



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
	$(document).on('click', ".applyBtn", function(e) {
		console.log(e);
		console.log($('.drp-selected').text());
	})
</script>