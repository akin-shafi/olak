<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'Add New Sales';

$categories = Category::find_all_categories();
$products = Product::find_all_products();
$gauges = Gauge::find_all_gauges();
$company = Company::find_by_id($loggedInAdmin->company_id);
$branches = Branch::find_all_branch(['company_id' => $company->id]);

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
			<select class="form-control" name="branch_id" id="sBranch" form="factory_form" required>
				<option value="">select branch</option>
				<?php foreach ($branches as $branch) : ?>
					<option value="<?php echo $branch->id ?>">
						<?php echo ucwords($branch->name) ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="table-container border-0 shadow">
		<div class="table-responsive">
			<form id="factory_form" method="post">
				<input type="hidden" name="factory_form" readonly>
				<input type="hidden" name="company_id" value="<?php echo $company->id ?>" readonly>

				<table class="table table-bordered table-sm">
					<thead>
						<tr class="bg-primary text-white text-center">
							<th>CATEGORY</th>
							<th>PRODUCT NAME</th>
							<th>GAUGE</th>
							<th>OPENING STOCK</th>
							<th>NEW STOCK</th>
							<th>RETURN INWARD</th>
							<th>TOTAL STOCK</th>
							<th>SALES</th>
							<th>IMPORTED</th>
							<th>LOCAL</th>
							<th>TOTAL SALES</th>
							<th>CLOSING STOCK</th>
							<th style="font-size:14px"><sup>&plus;</sup>/<sub>&minus;</sub></th>
						</tr>
					</thead>

					<tbody id="factory-table">
						<tr class="border-0">
							<td>
								<select name="category_id[]" class="form-control form-control-sm category_id" required>
									<option>select category</option>
									<?php foreach ($categories as $category) : ?>
										<option value="<?php echo $category->id; ?>">
											<?php echo ucwords($category->name); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</td>
							<td>
								<select name="product_id[]" class="form-control form-control-sm product_id" required>
									<option>select product</option>
									<?php foreach ($products as $product) : ?>
										<option value="<?php echo $product->id; ?>">
											<?php echo ucwords($product->name); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</td>
							<td>
								<select name="gauge_id[]" class="form-control form-control-sm gauge_id" required>
									<option>select gauge</option>
									<?php foreach ($gauges as $gauge) : ?>
										<option value="<?php echo $gauge->id; ?>">
											<?php echo number_format($gauge->value, 2); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</td>
							<td>
								<input type="text" required name="open_stock[]" class="form-control form-control-sm open_stock actions">
							</td>
							<td>
								<input type="text" required name="production[]" class="form-control form-control-sm production actions">
							</td>
							<td>
								<input type="text" required name="return_inward[]" class="form-control form-control-sm return_inward actions">
							</td>
							<td>
								<input type="text" required name="total_stock[]" class="form-control form-control-sm total_stock" readonly>
							</td>
							<td>
								<input type="text" required name="sales[]" class="form-control form-control-sm sales actions">
							</td>
							<td>
								<input type="text" required name="imported[]" class="form-control form-control-sm imported actions">
							</td>
							<td>
								<input type="text" required name="local[]" class="form-control form-control-sm local actions">
							</td>
							<td>
								<input type="text" required name="total_sales[]" class="form-control form-control-sm total_sales" readonly>
							</td>
							<td>
								<input type="text" required name="closing_stock[]" class="form-control form-control-sm font-weight-bold closing_stock" readonly>
							</td>

							<td>
								<button type="button" class="btn btn-primary d-block m-auto" id="add_row">&plus;</button>
							</td>
						</tr>
					</tbody>
				</table>

				<div class="d-flex justify-content-end align-items-center font-weight-bold mb-2">
					<p class="mr-3">Total Stock:</p>
					<div>
						<p class="mr-3" id="grandStock"></p>
						<input type="hidden" class="form-control form-control-sm" id="grand_stock" name="grand_stock" readonly>
					</div>
				</div>
				<div class="d-flex justify-content-end align-items-center font-weight-bold mb-3">
					<p class="mr-3">Total Sales:</p>
					<div>
						<p class="mr-3" id="grandSale"></p>
						<input type="hidden" class="form-control form-control-sm" id="grand_sales" name="grand_sales" readonly>
					</div>
				</div>

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
		const FACTORY_URL = 'inc/process.php';

		let count = 1;
		$(document).on('click', '#add_row', function() {
			count = count + 1;
			$('#total_item').val(count);

			let html_code = '';
			html_code += '<tr id="row_id_' + count + '">';
			html_code += '<td><select class="form-control form-control-sm category_id" name="category_id[]" required><option>Select</option><?php foreach ($categories as $cat) { ?><option value="<?php echo $cat->id; ?>"><?php echo ucwords($cat->name); ?></option><?php } ?></select></td>';

			html_code += '<td><select class="form-control form-control-sm product_id" name="product_id[]" required><option>Select</option><?php foreach ($products as $pro) { ?><option value="<?php echo $pro->id; ?>"><?php echo ucwords($pro->name); ?></option><?php } ?></select></td>';

			html_code += '<td><select class="form-control form-control-sm gauge_id" name="gauge_id[]" required><option>Select</option><?php foreach ($gauges as $gauge) { ?><option value="<?php echo $gauge->id; ?>"><?php echo number_format($gauge->value, 2); ?></option><?php } ?></select></td>';

			html_code += '<td><input type="text" required name="open_stock[]" class="form-control form-control-sm open_stock actions"></td>'

			html_code += '<td><input type="text" required name="production[]" class="form-control form-control-sm production actions"></td>'
			html_code += '<td><input type="text" required name="return_inward[]" class="form-control form-control-sm return_inward actions"></td>'
			html_code += '<td><input type="text" required name="total_stock[]" class="form-control form-control-sm total_stock" readonly></td>'
			html_code += '<td><input type="text" required name="sales[]" class="form-control form-control-sm sales actions"></td>'
			html_code += '<td><input type="text" required name="imported[]" class="form-control form-control-sm imported actions"></td>'
			html_code += '<td><input type="text" required name="local[]" class="form-control form-control-sm local actions"></td>'

			html_code += '<td><input type="text" required name="total_sales[]" class="form-control form-control-sm total_sales" readonly></td>'

			html_code += '<td><input type="text" required name="closing_stock[]" class="form-control form-control-sm closing_stock" readonly></td>'

			html_code += '<td><button type="button" id="' + count + '" class="btn btn-secondary d-block m-auto remove_row">X</button></td></tr>';

			$('#factory-table').append(html_code);

			addStock()
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

		$('#factory_form').on("submit", function(e) {
			e.preventDefault();
			// $('#submit_sales').attr('disabled', true);

			$.ajax({
				url: FACTORY_URL,
				method: "POST",
				data: new FormData(this),
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

		window.onload = () => {
			addStock()
		}

		const addStock = () => {
			let actions = document.querySelectorAll('.actions')

			actions.forEach(elem => {
				elem.addEventListener('input', function() {
					let tRow = $(this).closest('#factory-table tr');

					// ********** STOCK
					let openStock = parseFloat(tRow.find('.open_stock').val())
					let newStock = parseFloat(tRow.find('.production').val())
					let returnInward = parseFloat(tRow.find('.return_inward').val())

					let resultStock = openStock + newStock - returnInward

					parseFloat(tRow.find('.total_stock').val(resultStock))
					// ********** STOCK END


					// ********** SALES
					let sales = parseFloat(tRow.find('.sales').val())
					let imported = parseFloat(tRow.find('.imported').val())
					let local = parseFloat(tRow.find('.local').val())

					let resultSales = sales + imported + local

					parseFloat(tRow.find('.total_sales').val(resultSales))
					// ********** SALES END

					// ********** CLOSING STOCK
					let closingStock = resultStock - resultSales
					parseFloat(tRow.find('.closing_stock').val(closingStock))
					// ********** CLOSING STOCK

					calTotal();
				})
			});
		}

		const calTotal = () => {
			// ********** STOCK
			const grandStockTotal = $('#grand_stock')
			const grandStock = $('#grandStock')
			let totalStock = 0;
			let stockAmount = $('.total_stock')

			stockAmount.each((i, el) => {
				if (el.value == '') return;
				totalStock += parseFloat(el.value);
			})
			$('#grandStock').text(numberWithCommas(totalStock));
			grandStockTotal.val(totalStock);
			// ********** STOCK END


			// ********** SALES
			const grandSalesTotal = $('#grand_sales')
			const grandSale = $('#grandSale')
			let totalSales = 0;
			let salesAmount = $('.total_sales')

			salesAmount.each((i, el) => {
				if (el.value == '') return;
				totalSales += parseFloat(el.value);
			})
			$('#grandSale').text(numberWithCommas(totalSales));
			grandSalesTotal.val(totalSales);
			// ********** STOCK

		}
















		// ***** Close Of Business CronJob *****
		const COBCronJob = setInterval(() => {
			let date = new Date()
			let hr = date.getHours()
			if (hr >= 23 || hr <= 6) {
				$('#factory_form :input').prop('disabled', true)
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
				$('#factory_form :input').prop('disabled', false)
				// $('.out-of-service').removeClass('d-none'); //! Comment this out!
			}
		}, 250)

		setTimeout(() => clearInterval(SOBCronJob), 250)
		// ***** Start Of Business CronJob *****
	})
</script>