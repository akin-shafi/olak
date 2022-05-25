<?php require_once('../private/initialize.php');
$hide = true;

$page = 'Sales';
$page_title = 'Edit Sales';

$catId = $_GET['category_id'] ?? '';

if (empty($catId)) redirect_to('../sales/');

$stockTwo = StockPhaseTwo::find_by_category_id($catId);
if (empty($stockTwo)) redirect_to('../sales/');

$categories = Category::find_all_categories();
$products = Product::find_by_undeleted();
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

	.remarks {
		width: 30%;
		min-width: 120px;
	}
</style>

<div class="content-wrapper">
	<div class="d-flex justify-content-between align-items-center">
		<h4>DAILY TRANSACTION RECORD FOR <?php echo strtoupper($company->name) ?> </h4>
		<div class="mb-3">
			<select class="form-control" name="branch_id" id="sBranch" form="edit_factory_form" required>
				<option value="">select branch</option>
				<?php foreach ($branches as $branch) :
					$stock = StockPhaseTwo::find_by_branch_id($branch->id);
					$stockBranchId = isset($stock->branch_id) ? $stock->branch_id : '' ?>
					<option value="<?php echo $branch->id ?>" <?php echo $branch->id == $stockBranchId ? 'selected' : ''; ?>>
						<?php echo ucwords($branch->name) ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="table-container border-0 shadow">
		<div class="table-responsive">
			<form id="edit_factory_form" method="post">
				<input type="hidden" name="edit_factory_form" readonly>
				<input type="hidden" name="company_id" value="<?php echo $company->id ?>" readonly>
				<input type="hidden" name="catId" value="<?php echo $catId ?>" readonly>

				<table class="table table-bordered table-sm">
					<thead>
						<tr class="bg-primary text-white text-center">
							<th>CATEGORY</th>
							<th>PRODUCT NAME</th>
							<th>GAUGE</th>
							<th>OPENING STOCK</th>
							<th>NEW STOCK</th>
							<th>TRANSFER</th>
							<th>TOTAL STOCK</th>
							<th>SALES</th>
							<th>CLOSING STOCK</th>
							<th style="font-size:14px"><sup>&plus;</sup>/<sub>&minus;</sub></th>
						</tr>
					</thead>

					<tbody id="phase-table">
						<?php foreach ($stockTwo as $stock) : ?>
							<tr class="border-0">
								<td>
									<select name="category_id[]" class="form-control form-control-sm category_id" required>
										<option value="">select category</option>
										<?php foreach ($categories as $category) : ?>
											<option value="<?php echo $category->id; ?>" <?php echo $category->id == $stock->category_id ? 'selected' : ''; ?>>
												<?php echo ucwords($category->name); ?>
											</option>
										<?php endforeach; ?>
									</select>
								</td>
								<td>
									<select name="product_id[]" class="form-control form-control-sm product_id" required>
										<option value="">select product</option>
										<?php foreach ($products as $product) : ?>
											<option value="<?php echo $product->id; ?>" <?php echo $product->id == $stock->product_id ? 'selected' : ''; ?>>
												<?php echo ucwords($product->name); ?>
											</option>
										<?php endforeach; ?>
									</select>
								</td>
								<td>
									<select name="gauge_id[]" class="form-control form-control-sm gauge_id" required>
										<option value="">select gauge</option>
										<?php foreach ($gauges as $gauge) : ?>
											<option value="<?php echo $gauge->id; ?>" <?php echo $gauge->id == $stock->gauge_id ? 'selected' : ''; ?>>
												<?php echo number_format($gauge->value, 2); ?>
											</option>
										<?php endforeach; ?>
									</select>
								</td>
								<td>
									<input type="text" required name="open_stock[]" value="<?php echo $stock->open_stock; ?>" class="form-control form-control-sm open_stock actions">
								</td>
								<td>
									<input type="text" required name="production[]" value="<?php echo $stock->production; ?>" class="form-control form-control-sm production actions">
								</td>
								<td>
									<input type="text" required name="transfer[]" value="<?php echo $stock->transfer; ?>" class="form-control form-control-sm transfer actions">
								</td>
								<td>
									<input type="text" required name="total_stock[]" value="<?php echo $stock->total_production; ?>" class="form-control form-control-sm total_stock" readonly>
								</td>
								<td>
									<input type="text" required name="sales[]" value="<?php echo $stock->sales; ?>" class="form-control form-control-sm sales actions">
								</td>
								<td>
									<input type="text" required name="closing_stock[]" value="<?php echo $stock->closing_stock; ?>" class="form-control form-control-sm font-weight-bold closing_stock" readonly>
								</td>

								<td>
									<button type="button" class="btn btn-danger d-block m-auto remove-btn" data-id="<?php echo $stock->id; ?>">&minus;</button>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

				<div class="d-flex justify-content-between align-items-center font-weight-bold mb-3">
					<textarea name="remarks" class="form-control remarks" id="remarks" placeholder="Remarks"><?php echo $stockTwo[0]->remarks; ?></textarea>
					<div class="font-weight-bold">
						<div class="d-flex justify-content-end mb-2">
							<p class="mr-3">Total Stock:</p>
							<div>
								<p class="mr-3" id="grandStock"></p>
								<input type="hidden" class="form-control form-control-sm" id="grand_stock" name="grand_stock" readonly>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<p class="mr-3">Total Sales:</p>
							<p class="mr-3" id="grandSale"></p>
							<input type="hidden" class="form-control form-control-sm" id="grand_sales" name="grand_sales" readonly>
						</div>
					</div>
				</div>

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
		var BACK_URL = './?phase=2'
		const FACTORY_URL = 'inc/process_two.php';

		$('#edit_factory_form').on("submit", function(e) {
			e.preventDefault();
			// $('#submit_sales').attr('disabled', true);

			let formData = new FormData(this);

			$.ajax({
				url: FACTORY_URL,
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
			let stockId = this.dataset.id;
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
						url: FACTORY_URL,
						method: "POST",
						data: {
							stockId: stockId,
							delete_stock: 1
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
					let transfer = parseFloat(tRow.find('.transfer').val())

					let resultStock = openStock + newStock - transfer

					parseFloat(tRow.find('.total_stock').val(resultStock))
					// ********** STOCK END


					// ********** SALES
					let sales = parseFloat(tRow.find('.sales').val())

					let resultSales = sales

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