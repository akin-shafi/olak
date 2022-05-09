<?php require_once('../private/initialize.php');
$hide = true;

$page = 'Sales';
$page_title = 'Edit Sales';

$sheetId = $_GET['sheet_id'] ?? '';

if (empty($sheetId)) redirect_to('../sales/');


$products = Product::find_all_product();
$company = Company::find_by_id($loggedInAdmin->company_id);
$branches = Branch::find_all_branch(['company_id' => $company->id]);

$data = DataSheet::find_by_sheet_id($sheetId);
if (empty($data)) redirect_to('../sales/');

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
				<input type="hidden" name="tankId" value="<?php echo $data->id ?>" readonly>

				<table class="table table-bordered table-sm">
					<thead>
						<tr class="bg-primary text-white text-center">
							<th>PRODUCT NAME</th>
							<th>PRODUCT RATE</th>
							<th>OPENING STOCK</th>
							<th>NEW STOCK (INFLOW)</th>
							<th>TOTAL STOCK</th>
							<th>SALES (LTRS)</th>
							<th>EXPECTED STOCK (LTRS)</th>
							<th>ACTUAL STOCK (LTRS)</th>
							<th>OVER/SHORT</th>
							<th>CASH SUBMITTED #</th>
							<!-- <th>EXP. SALES VALUE #</th>
							 <th>TOTAL SALES (LTRS)</th>
							<th>TOTAL VALUE #</th>
							<th>GRAND TOTAL VALUE #</th> -->
							<th>
								<button type="button" class="btn btn-light d-block m-auto" id="add_row">&plus;</button>
							</th>
						</tr>
					</thead>

					<tbody id="pet-table">
						<tr class="border-0">
							<td>
								<select name="product_id[]" class="form-control form-control-sm product_id" id="product_id">
									<option>select product</option>
									<?php foreach ($products as $product) : ?>
										<option value="<?php echo $product->id; ?>" <?php echo $product->id == $data->product_id ? 'selected' : ''; ?>>
											<?php echo strtoupper($product->name) . ' (TANK ' . $product->tank . ')'; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</td>
							<td>
								<input type="number" size="12" class="form-control form-control-sm rate_1" id="rate_1" placeholder='0' readonly>
							</td>
							<td>
								<input type="number" required="" name="open_stock[]" value="<?php echo $data->open_stock; ?>" id="open_stock_1" class="form-control form-control-sm number_only open_stock_1">
							</td>
							<td>
								<input type="number" required="" name="new_stock[]" value="<?php echo $data->new_stock; ?>" id="new_stock_1" class="form-control form-control-sm number_only new_stock_1">
							</td>
							<td>
								<input type="number" required="" name="total_stock[]" value="<?php echo $data->total_stock; ?>" id="total_stock_1" class="form-control form-control-sm number_only total_stock_1" readonly>
							</td>
							<td>
								<input type="number" required="" name="sales_in_ltr[]" value="<?php echo $data->sales_in_ltr; ?>" id="sales_in_ltr_1" class="form-control form-control-sm number_only sales_in_ltr_1">
							</td>
							<td>
								<input type="number" required="" name="expected_stock[]" value="<?php echo $data->expected_stock; ?>" id="expected_stock_1" class="form-control form-control-sm number_only expected_stock_1" readonly>
							</td>
							<td>
								<input type="number" required="" name="actual_stock[]" value="<?php echo $data->actual_stock; ?>" id="actual_stock_1" class="form-control form-control-sm number_only actual_stock_1">
							</td>
							<td>
								<input type="number" required="" name="over_or_short[]" value="<?php echo $data->over_or_short; ?>" id="over_or_short_1" class="form-control form-control-sm number_only over_or_short_1" readonly>
							</td>
							<td>
								<input type="number" required="" name="cash_submitted[]" value="<?php echo $data->cash_submitted; ?>" id="cash_submitted_1" class="form-control form-control-sm number_only cash_submitted_1">
							</td>
							<td class="d-none">
								<input type="number" required="" name="exp_sales_value[]" value="<?php echo $data->exp_sales_value; ?>" id="exp_sales_value_1" class="form-control form-control-sm font-weight-bold number_only exp_sales_value_1" readonly>
							</td>



							<?php if ($hide == false) : ?>
								<td class="d-none">
									<input type="number" required="" name="total_sales[]" id="total_sales_1" class="form-control form-control-sm number_only total_sales_1" readonly>
								</td>
								<td class="d-none">
									<input type="number" required="" name="total_value[]" id="total_value_1" class="form-control form-control-sm number_only total_value_1" readonly>
								</td>
								<td class="d-none">
									<input type="number" required="" name="grand_total[]" id="grand_total_1" class="form-control form-control-sm number_only grand_total_1" readonly>
								</td>
							<?php endif; ?>

							<td>
								<button type="button" class="btn btn-secondary d-block m-auto remove-btn" data-id="<?php echo $data->id ?>">&minus;</button>
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
			let pId = $('#product_id').val();
			let elem = document.getElementById('rate_1');
			getProductRate(pId, elem);

			addSales()
		}

		$(document).on("change", '.product_id', function(e) {
			let pId = this.value
			let elem = e.target.offsetParent.nextElementSibling.firstElementChild
			getProductRate(pId, elem)
		});

		const getProductRate = (productId, targetElement) => {
			$.ajax({
				url: PET_URL + '?pId=' + productId + '&get_product',
				method: "GET",
				dataType: 'json',
				success: function(r) {
					if (r.success == true) {
						if (r.data != false) {
							targetElement.value = r.data.rate
						} else {
							targetElement.value = ''
						}
					}
				}
			})
		}



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
			let tankId = this.dataset.id;
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
							tankId: tankId,
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








		let count = 1;
		$(document).on('click', '#add_row', function() {
			count = count + 1;
			$('#total_item').val(count);

			let html_code = '';
			html_code += '<tr id="row_id_' + count + '">';
			html_code += '<td><select class="form-control form-control-sm product_id" required="" name="product_id[]"><option>Select</option><?php foreach ($products as $pro) { ?><option value="<?php echo $pro->id; ?>"><?php echo strtoupper($pro->name) . ' (TANK ' . $pro->tank . ')'; ?></option><?php } ?></select></td>';
			html_code += '<td><input type="number" size="12" class="form-control form-control-sm rate_' + count + '" placeholder="0" readonly></td>';
			html_code += '<td><input type="number" required="" name="open_stock[]" class="form-control form-control-sm number_only open_stock_' + count + '"></td>'
			html_code += '<td><input type="number" required="" name="new_stock[]" class="form-control form-control-sm number_only new_stock_' + count + '"></td>'
			html_code += '<td><input type="number" required="" name="total_stock[]" class="form-control form-control-sm number_only total_stock_' + count + '" readonly></td>'
			html_code += '<td><input type="number" required="" name="sales_in_ltr[]" class="form-control form-control-sm number_only sales_in_ltr_' + count + '"></td>'
			html_code += '<td><input type="number" required="" name="expected_stock[]" class="form-control form-control-sm number_only expected_stock_' + count + '" readonly></td>'
			html_code += '<td><input type="number" required="" name="actual_stock[]" class="form-control form-control-sm number_only actual_stock_' + count + '"></td>'
			html_code += '<td><input type="number" required="" name="over_or_short[]" class="form-control form-control-sm number_only over_or_short_' + count + '" readonly></td>'
			html_code += '<td><input type="number" required="" name="cash_submitted[]" class="form-control form-control-sm number_only cash_submitted_' + count + '"></td>'

			html_code += '<td class="d-none"><input type="number" required="" name="exp_sales_value[]" class="form-control form-control-sm number_only exp_sales_value_' + count + '" readonly></td>'

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



		const addSales = () => {
			const totalItem = $('#total_item').val();

			for (let i = 1; i <= totalItem; i++) {
				let rate = $('.rate_' + i)
				let totalSales = $('.total_sales_' + i)
				let totalValue = $('.total_value_' + i)

				let cashSubmitted = $('.cash_submitted_' + i)
				let grandTotal = $('.grand_total_' + i)

				let openStock = $('.open_stock_' + i)
				let newStock = $('.new_stock_' + i)
				let totalStock = $('.total_stock_' + i)

				let salesInLtr = $('.sales_in_ltr_' + i)
				let expectedStock = $('.expected_stock_' + i)

				let actualStock = $('.actual_stock_' + i)
				let overOrShort = $('.over_or_short_' + i)

				let expSalesValue = $('.exp_sales_value_' + i)

				newStock.on('keyup', function() {
					let openSumTotal = Number(openStock.val()) + Number(newStock.val())
					totalStock.val(openSumTotal);
				})

				salesInLtr.on('keyup', function() {
					let expectedTotal = Number(totalStock.val()) - Number(salesInLtr.val())
					expectedStock.val(expectedTotal);

					let expSalesTotal = Number(rate.val()) * Number(salesInLtr.val())
					expSalesValue.val(expSalesTotal);
				})

				actualStock.on('keyup', function() {
					let overOrShortTotal = Number(actualStock.val()) - Number(expectedStock.val())
					overOrShort.val(overOrShortTotal);
				})


				// ! This will set the initial calculated result on page load. Thank you!
				let openSumTotal = Number(openStock.val()) + Number(newStock.val())
				let expectedTotal = Number(totalStock.val()) - Number(salesInLtr.val())
				let overOrShortTotal = Number(actualStock.val()) - Number(expectedStock.val())
				let expSalesTotal = Number(rate.val()) * Number(salesInLtr.val())

				totalStock.val(openSumTotal);
				expectedStock.val(expectedTotal);
				overOrShort.val(overOrShortTotal);
				expSalesValue.val(expSalesTotal);
			}
		}

		// ***** Close Of Business CronJob *****
		const COBCronJob = setInterval(() => {
			let date = new Date()
			let hr = date.getHours()
			if (hr >= 23 || hr <= 6) {
				$('#edit_sheet_form :input').prop('disabled', true)
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
				$('#edit_sheet_form :input').prop('disabled', false)
				// $('.out-of-service').removeClass('d-none'); //! Comment this out!
			}
		}, 250)

		setTimeout(() => clearInterval(SOBCronJob), 250)
		// ***** Start Of Business CronJob *****
	})
</script>