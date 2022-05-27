<?php require_once('../private/initialize.php');
$hide = true;

$page = 'Sales';
$page_title = 'Edit Sales';

$sheetId = $_GET['sheet_id'] ?? '';

if (empty($sheetId)) redirect_to('../sales/');


$products = Product::find_all_product($loggedInAdmin->branch_id);
$company = Company::find_by_id($loggedInAdmin->company_id);
$branches = Branch::find_all_branch(['company_id' => $company->id]);

$adminLevel = $loggedInAdmin->admin_level;

$data = DataSheet::find_by_sheet_id($sheetId);
$rate = Product::find_by_id($data->product_id)->rate;

$expectedStock = floatval($data->total_stock) - floatval($data->sales_in_ltr);
$overShot = floatval($data->actual_stock) - $expectedStock;

// pre_r($data);
if (empty($data)) redirect_to('../sales/');

include(SHARED_PATH . '/admin_header.php');


?>
<style type="text/css">
	th {
		font-size: 12px;
		vertical-align: middle;
	}

	td {
		min-width: 90px;
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
		<h4>DAILY TRANSACTION RECORD FOR <?php echo strtoupper($company->name) ?> </h4>
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

	<div class="table-container border-0 shadow">
		<div class="table-responsive">
			<form id="edit_sheet_form" method="post">
				<input type="hidden" name="edit_sheet_form" readonly>
				<input type="hidden" name="company_id" value="<?php echo $company->id ?>" readonly>
				<input type="hidden" name="dataSheetId" value="<?php echo $data->id ?>" readonly>

				<table class="table table-bordered table-sm">
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

					<tbody id="pet-table">
						<tr class="border-0">
							<td>
								<select name="product_id[]" class="form-control form-control-sm product_id">
									<option value="">select product</option>
									<?php foreach ($products as $product) : ?>
										<option value="<?php echo $product->id; ?>" <?php echo $product->id == $data->product_id ? 'selected' : ''; ?>>
											<?php echo strtoupper($product->name) . ' (TANK ' . $product->tank . ')'; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</td>
							<td>
								<input type="text" size="12" class="form-control form-control-sm rate" value="<?php echo $rate ?>" placeholder='0' readonly>
							</td>
							<?php if (in_array($adminLevel, [1, 2, 3])) : ?>
								<td>
									<input type="hidden" name="input_dipping" readonly>
									<input type="text" required="" name="open_stock[]" value="<?php echo $data->open_stock; ?>" class="form-control form-control-sm opening open_new">
								</td>
								<td>
									<input type="text" required="" name="new_stock[]" value="<?php echo $data->new_stock; ?>" class="form-control form-control-sm new_stock open_new">
								</td>
								<td>
									<input type="text" required="" name="total_stock[]" value="<?php echo $data->total_stock; ?>" class="form-control form-control-sm total_stock" readonly>
								</td>
							<?php endif; ?>



							<?php if (in_array($adminLevel, [1, 2, 4])) : ?>
								<td class="d-none">
									<input type="hidden" name="input_sales" readonly>
									<input type="hidden" class="total_stock" value="<?php echo $data->total_stock ?>" readonly>
								</td>
								<td>
									<input type=" text" required="" name="sales_in_ltr[]" value="<?php echo $data->sales_in_ltr; ?>" class="form-control form-control-sm sales">
								</td>
								<td>
									<input type="text" required="" name="expected_stock[]" value="<?php echo $expectedStock; ?>" class="form-control form-control-sm expected_stock" readonly>
								</td>
								<td>
									<input type="text" required="" name="actual_stock[]" value="<?php echo $data->actual_stock; ?>" class="form-control form-control-sm actual_stock">
								</td>
								<td>
									<input type="text" required="" name="over_or_short[]" value="<?php echo $overShot; ?>" class="form-control form-control-sm over_short" readonly>
								</td>
								<td>
									<input type="text" required="" name="cash_submitted[]" value="<?php echo $data->cash_submitted; ?>" class="form-control form-control-sm cash_submitted">
								</td>
							<?php endif; ?>

							<td class="d-none">
								<input type="text" required="" name="exp_sales_value[]" value="<?php echo $data->exp_sales_value; ?>" class="form-control form-control-sm font-weight-bold exp_sales_value" readonly>
							</td>



							<?php if ($hide == false) : ?>
								<td class="d-none">
									<input type="text" required="" name="total_sales[]" value="<?php echo $data->total_sales; ?>" id="total_sales_1" class="form-control form-control-sm total_sales_1" readonly>
								</td>
								<td class="d-none">
									<input type="text" required="" name="total_value[]" value="<?php echo $data->total_value; ?>" id="total_value_1" class="form-control form-control-sm total_value_1" readonly>
								</td>
								<td class="d-none">
									<input type="text" required="" name="grand_total[]" value="<?php echo $data->grand_total; ?>" id="grand_total_1" class="form-control form-control-sm grand_total_1" readonly>
								</td>
							<?php endif; ?>

							<td>
								<button type="button" class="btn btn-primary d-block m-auto" id="add_row">&plus;</button>
							</td>
						</tr>
					</tbody>
				</table>

				<div class="d-flex justify-content-end">
					<button type="submit" class="btn btn-primary mb-3" id="submit_sales">Update</button>
				</div>
			</form>

			<input type="hidden" class="form-control" id="total_item" value="1" readonly>
		</div>
	</div>

</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
	$(document).ready(function() {
		var BACK_URL = './'
		const PET_URL = 'inc/process.php';

		window.onload = () => {
			addSales()
		}

		$(document).on("change", '.product_id', function(e) {
			let pId = this.value

			let tRow = $(this).closest('#pet-table tr');
			let rate = tRow.find('.rate')

			$.ajax({
				url: PET_URL + '?pId=' + pId + '&get_product',
				method: "GET",
				dataType: 'json',
				success: function(r) {
					if (isNaN(rate)) {
						rate.val(r.data.product.rate)
					}
				},
				error: function(e) {
					errorAlert(e.responseJSON.error)
				}
			})
		});

		$('#edit_sheet_form').on("submit", function(e) {
			e.preventDefault();
			$('#submit_sales').attr('disabled', true);

			let formData = new FormData(this);

			$.ajax({
				url: PET_URL,
				method: "POST",
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				dataType: 'json',
				success: function(r) {
					if (r.success == true) {
						successAlert(r.msg);
						window.location.href = BACK_URL
					} else {
						errorAlert(r.msg);
					}
				}
			})
		});

		$(document).on('click', '.remove-btn', function() {
			let dataSheetId = this.dataset.id;
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: PET_URL,
						method: "POST",
						data: {
							dataSheetId: dataSheetId,
							delete_tank: 1
						},
						dataType: 'json',
						success: function(data) {
							Swal.fire(
								'Deleted!',
								data.msg,
								'success'
							)
							setTimeout(() => {
								window.location.reload()
							}, 1000);
						}
					});
				}
			})

		});

		const addSales = () => {

			let openNew = document.querySelectorAll('.open_new')
			openNew.forEach(sale => {
				sale.addEventListener('input', function() {
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

					if (isNaN(expectedTotal)) {
						parseFloat(tRow.find('.expected_stock').val(expSalesTotal), 10)
					}
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





		// // ***** Close Of Business CronJob *****
		// const COBCronJob = setInterval(() => {
		// 	let date = new Date()
		// 	let hr = date.getHours()
		// 	if (hr >= 23 || hr <= 6) {
		// 		$('#edit_sheet_form :input').prop('disabled', true)
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
		// 		$('#edit_sheet_form :input').prop('disabled', false)
		// 		// $('.out-of-service').removeClass('d-none'); //! Comment this out!
		// 	}
		// }, 250)

		// setTimeout(() => clearInterval(SOBCronJob), 250)
		// // ***** Start Of Business CronJob *****
	})
</script>