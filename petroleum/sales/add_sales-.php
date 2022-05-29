<?php require_once('../private/initialize.php');
$hide = true;

$page = 'Sales';
$page_title = 'Add New Sales';

$products = Product::find_all_product($loggedInAdmin->branch_id);
$company = Company::find_by_id($loggedInAdmin->company_id);
$branches = Branch::find_all_branch(['company_id' => $company->id]);
$adminLevel = $loggedInAdmin->admin_level;

include(SHARED_PATH . '/admin_header.php');

?>
<style type="text/css">
	th {
		font-size: 12px;
		vertical-align: middle;
	}

	td {
		/* min-width: 90px; */
		padding: 0.2rem 0.3rem !important;
	}

	label {
		text-transform: uppercase;
	}

	input,
	select {
		display: block;
		border-radius: 0 !important;
		border: none;
	}

	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	input[type=number] {
		-moz-appearance: textfield;
		text-align: right;
	}

	input:focus {
		outline: 1px solid green;
	}
</style>

<div class="content-wrapper">
	<div class="d-flex justify-content-between align-items-center">
		<h4 class="text-uppercase">Daily transaction record for <?php echo Branch::find_by_id($loggedInAdmin->branch_id)->name; ?> </h4>
		<div class="mb-3">
			<!-- <input type="" name=""> -->
			<input type="hidden" name="branch_id" value="<?php echo $loggedInAdmin->branch_id ?>" form="data_sheet_form" readonly>
			<select class="form-control" disabled>
				<option value="">select branch</option>
				<?php foreach ($branches as $branch) : ?>
					<option value="<?php echo $branch->id ?>" <?php echo $loggedInAdmin->branch_id == $branch->id ? 'selected' : '' ?>>
						<?php echo ucwords($branch->name) ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="table-container border-0 shadow">
		<div class="table-responsive">
			<form id="data_sheet_form" method="post">
				<input type="hidden" name="data_sheet_form" readonly>
				<input type="hidden" name="company_id" value="<?php echo $company->id ?>" readonly>

				<table class="table table-bordered table-sm">
					<thead>
						<tr class="bg-primary text-white text-center">
							<th>TANK</th>
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

					<tbody id="pet-table">
						<?php foreach ($products as $product) :
							$data = DataSheet::find_by_product_id($product->id, ['date' => date('Y-m-d')]);
							$dat = !empty($data->total_stock) && $data->total_stock > 0 ? $data->total_stock : 0;
						?>
							<tr class="border-0">
								<td><?php echo $product->id; ?></td>
								<td>
									<input type="hidden" name="product_id[]" value="<?php echo $product->id; ?>" class="form-control form-control-sm product_id">

									<select class="form-control form-control-sm" disabled>
										<?php foreach ($products as $data) : ?>
											<option value="<?php echo $data->id; ?>" <?php echo ($data->id == $product->id) ? 'selected' : ''; ?>>
												<?php echo strtoupper($data->name) . ' (TANK ' . $data->tank . ')'; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</td>
								<td>
									<input type="text" class="form-control form-control-sm rate" value="<?php echo $product->rate; ?>" placeholder='0' readonly>
								</td>
								<?php if (in_array($adminLevel, [1, 2, 3])) : ?>
									<td>
										<input type="hidden" name="input_dipping" readonly>
										<input type="text" required="" name="open_stock[]" class="form-control form-control-sm opening open_new">
									</td>
									<td>
										<input type="text" required="" name="new_stock[]" class="form-control form-control-sm new_stock open_new">
									</td>
									<td>
										<input type="text" required="" name="total_stock[]" value="<?php echo $dat; ?>" class="form-control form-control-sm total_stock" readonly>
									</td>
								<?php endif; ?>



								<?php if (in_array($adminLevel, [1, 2, 4])) : ?>
									<td class="d-none">
										<input type="hidden" name="input_sales" readonly>
									</td>
									<td>
										<input type="text" required="" name="sales_in_ltr[]" class="form-control form-control-sm sales">
									</td>
									<td>
										<input type="text" required="" name="expected_stock[]" class="form-control form-control-sm expected_stock" readonly>
									</td>
									<td>
										<input type="text" required="" name="actual_stock[]" class="form-control form-control-sm actual_stock">
									</td>
									<td>
										<input type="text" required="" name="over_or_short[]" class="form-control form-control-sm over_short" readonly>
									</td>
									<td>
										<input type="text" required="" name="cash_submitted[]" class="form-control form-control-sm cash_submitted">
									</td>
								<?php endif; ?>

								<td class="d-none">
									<input type="text" required="" name="exp_sales_value[]" class="form-control form-control-sm font-weight-bold exp_sales_value" readonly>
								</td>

								<?php if ($hide == false) : ?>
									<td class="d-none">
										<input type="text" required="" name="total_sales[]" id="total_sales_1" class="form-control form-control-sm total_sales_1" readonly>
									</td>
									<td class="d-none">
										<input type="text" required="" name="total_value[]" id="total_value_1" class="form-control form-control-sm total_value_1" readonly>
									</td>
									<td class="d-none">
										<input type="text" required="" name="grand_total[]" id="grand_total_1" class="form-control form-control-sm grand_total_1" readonly>
									</td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>

					</tbody>
				</table>

				<div class="d-flex justify-content-end">
					<button type="submit" class="btn btn-primary mb-3" id="submit_sales">Submit</button>
				</div>
			</form>

			<input type="hidden" class="form-control" id="total_item" value="1" readonly>
		</div>
	</div>

</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script type="text/javascript">
	$(document).ready(function() {
		var BACK_URL = './'
		const PET_URL = 'inc/process.php';

		window.onload = () => {
			addSales()
		}

		const addSales = () => {


			let openNew = document.querySelectorAll('.open_new')
			openNew.forEach(params => {
				params.addEventListener('input', function() {
					let tRow = $(this).closest('#pet-table tr');

					let openingStock = parseFloat(tRow.find('.opening').val(), 10)
					let newStock = parseFloat(tRow.find('.new_stock').val(), 10)

					let total = openingStock + newStock
					let totalStock = parseFloat(tRow.find('.total_stock').val(total), 10)

					if (isNaN(total)) {
						parseFloat(tRow.find('.total_stock').val(openingStock), 10)
					} else {
						parseFloat(tRow.find('.total_stock').val(total), 10)
					}

				})
			});


			let sales = document.querySelectorAll('.sales')
			sales.forEach(sale => {
				sale.addEventListener('input', function() {
					let tRow = $(this).closest('#pet-table tr');

					let totalStock = parseFloat(tRow.find('.total_stock').val(), 10)
					let salesInLtr = parseFloat(tRow.find('.sales').val(), 10)
					let rate = parseFloat(tRow.find('.rate').val(), 10)

					let expectedTotal = totalStock - salesInLtr
					parseFloat(tRow.find('.expected_stock').val(expectedTotal), 10)

					let expSalesTotal = rate * salesInLtr
					parseFloat(tRow.find('.exp_sales_value').val(expSalesTotal), 10)
				})
			});


			let actual = document.querySelectorAll('.actual_stock')
			actual.forEach(stock => {
				stock.addEventListener('input', function() {
					let tRow = $(this).closest('#pet-table tr');

					let actualStock = parseFloat(tRow.find('.actual_stock').val(), 10)
					let expectedStock = parseFloat(tRow.find('.expected_stock').val(), 10)

					let overOrShortTotal = actualStock - expectedStock
					parseFloat(tRow.find('.over_short').val(overOrShortTotal), 10)
				})
			});
		}


		$('#data_sheet_form').on("submit", function(e) {
			e.preventDefault();
			$('#submit_sales').attr('disabled', true);

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
					$('#submit_sales').attr('disabled', false);
				},
				error: function(e) {
					errorAlert(e.responseJSON.error)
					$('#submit_sales').attr('disabled', false);
				}
			})
		});







		// // ***** Close Of Business CronJob *****
		// const COBCronJob = setInterval(() => {
		// 	let date = new Date()
		// 	let hr = date.getHours()
		// 	if (hr >= 23 || hr <= 6) {
		// 		$('#data_sheet_form :input').prop('disabled', true)
		// 		$('.out-of-service').removeClass('d-none');
		// 	}
		// }, 250)

		// setTimeout(() => clearInterval(COBCronJob), 250)
		// // ***** Close Of Business CronJob *****

		// // ***** Start Of Business CronJob *****
		// const SOBCronJob = setInterval(() => {
		// 	let date = new Date()
		// 	let hr = date.getHours()
		// 	if (hr >= 7) {
		// 		$('#data_sheet_form :input').prop('disabled', false)
		// 		// $('.out-of-service').removeClass('d-none'); //! Comment this out!
		// 	}
		// }, 250)

		// setTimeout(() => clearInterval(SOBCronJob), 250)
		// // ***** Start Of Business CronJob *****
	})
</script>