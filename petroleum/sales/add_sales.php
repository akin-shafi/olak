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
		font-size: 9px;
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
								<th>CASH SUBMITTED #</th>
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
									<option>select product</option>
									<?php foreach ($products as $product) : ?>
										<option value="<?php echo $product->id; ?>">
											<?php echo strtoupper($product->name) . ' (TANK ' . $product->tank . ')'; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</td>
							<td>
								<input type="text" size="12" class="form-control form-control-sm rate" placeholder='0' readonly>
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
									<input type="text" required="" name="total_stock[]" class="form-control form-control-sm total_stock" readonly>
								</td>
							<?php endif; ?>



							<?php if (in_array($adminLevel, [1, 2, 4])) : ?>
								<td class="d-none">
									<input type="hidden" name="input_sales" readonly>
									<input type="hidden" class="form-control form-control-sm total_stock" readonly>
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

							<td>
								<button type="button" class="btn btn-primary d-block m-auto" id="add_row">&plus;</button>
							</td>
						</tr>
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


		$(document).on("change", '.product_id', function(e) {
			let pId = this.value

			let tRow = $(this).closest('#pet-table tr');
			let rate = tRow.find('.rate')
			let totalStock = tRow.find('.total_stock')

			$.ajax({
				url: PET_URL + '?pId=' + pId + '&get_product',
				method: "GET",
				dataType: 'json',
				success: function(r) {
					if (isNaN(rate)) {
						rate.val(r.data.product.rate)
						totalStock.val(r.data.sale.total_stock)
					}
				},
				error: function(e) {
					errorAlert(e.responseJSON.error)
				}
			})
		});

		window.onload = () => {
			addSales()
		}

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

		let count = 1;
		$(document).on('click', '#add_row', function() {
			count = count + 1;
			$('#total_item').val(count);

			let html_code = '';
			html_code += '<tr id="row_id_' + count + '">';
			html_code += '<td><select class="form-control form-control-sm product_id" required="" name="product_id[]"><option>Select</option><?php foreach ($products as $pro) { ?><option value="<?php echo $pro->id; ?>"><?php echo strtoupper($pro->name) . ' (TANK ' . $pro->tank . ')'; ?></option><?php } ?></select></td>';
			html_code += '<td><input type="text" size="12" class="form-control form-control-sm rate" placeholder="0" readonly></td>';

			<?php if (in_array($adminLevel, [1, 2, 3])) : ?>
				html_code += '<td><input type="text" required="" name="open_stock[]" class="form-control form-control-sm opening open_new"></td>'
				html_code += '<td><input type="text" required="" name="new_stock[]" class="form-control form-control-sm new_stock open_new"></td>'
				html_code += '<td><input type="text" required="" name="total_stock[]" class="form-control form-control-sm total_stock" readonly></td>'
			<?php endif; ?>

			<?php if (in_array($adminLevel, [1, 2, 4])) : ?>
				html_code += '<td class="d-none"><input type="hidden" class="form-control form-control-sm total_stock" readonly></td>'
				html_code += '<td><input type="text" required="" name="sales_in_ltr[]" class="form-control form-control-sm sales"></td>'
				html_code += '<td><input type="text" required="" name="expected_stock[]" class="form-control form-control-sm expected_stock" readonly></td>'
				html_code += '<td><input type="text" required="" name="actual_stock[]" class="form-control form-control-sm actual_stock"></td>'
				html_code += '<td><input type="text" required="" name="over_or_short[]" class="form-control form-control-sm over_short" readonly></td>'
				html_code += '<td><input type="text" required="" name="cash_submitted[]" class="form-control form-control-sm cash_submitted"></td>'
			<?php endif; ?>


			html_code += '<td class="d-none"><input type="text" required="" name="exp_sales_value[]" class="form-control form-control-sm exp_sales_value" readonly></td>'

			html_code += '<td><button type="button" id="' + count + '" class="btn btn-secondary d-block m-auto remove_row">X</button></td></tr>';

			$('#pet-table').append(html_code);

			addSales()
		});

		$(document).on('click', '.remove_row', function() {

			let row_id = $(this).attr("id");
			let total_item_amount = $('#amount' + row_id).val();
			let final_amount = $('#final_total_amt').text();
			let result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
			$('#final_total_amt').text(result_amount);
			$('#row_id_' + row_id).remove();
			count--;
			$('#total_item').val(count);

		});

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







		// ***** Close Of Business CronJob *****
		const COBCronJob = setInterval(() => {
			let date = new Date()
			let hr = date.getHours()
			if (hr >= 23 || hr <= 6) {
				$('#data_sheet_form :input').prop('disabled', true)
				$('.out-of-service').removeClass('d-none');
			}
		}, 250)

		setTimeout(() => clearInterval(COBCronJob), 250)
		// ***** Close Of Business CronJob *****

		// ***** Start Of Business CronJob *****
		const SOBCronJob = setInterval(() => {
			let date = new Date()
			let hr = date.getHours()
			if (hr >= 7) {
				$('#data_sheet_form :input').prop('disabled', false)
				// $('.out-of-service').removeClass('d-none'); //! Comment this out!
			}
		}, 250)

		setTimeout(() => clearInterval(SOBCronJob), 250)
		// ***** Start Of Business CronJob *****
	})
</script>