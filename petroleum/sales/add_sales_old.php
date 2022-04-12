<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'Add New Sales';
include(SHARED_PATH . '/admin_header.php');

$array = ['PMS', 'PMS', 'PMS', 'PMS', 'PMS', 'AGO', 'DPK'];
$pms = '162';
$ago = '335';
$dpk = '345';
?>
<style type="text/css">
	label {
		text-transform: uppercase;
	}

	input {
		display: block;
		border-radius: 0;
		width: 90%;
		text-align: right;
		border: none;
		margin: 0 auto;
	}

	input:focus {
		outline: 1px solid green;
	}
</style>
<div class="content-wrapper">
	<h4>DAILY TRANSACTION RECORD FOR OLAK PETROLEUM, ILORIN </h4>

	<div class="table-container">
		<div class="table-responsive">
			<form id="data_sheet" method="post">
				<table class="table table-bordered table-sm">
					<thead>
						<tr class="bg-primary text-white ">
							<th class="font-weight-bold">Product</th>
							<?php $sn = 1;
							foreach ($array as $key => $value) { ?>
								<th class="font-weight-bold text-right"><?php echo $value . " (Tank" . $sn++ . ")"; ?></th>
							<?php } ?>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td class=" font-weight-bold">Rate</td>
							<?php $sr = 1;
							foreach ($array as $key => $value) {
								if ($value == 'PMS') {
									$rate = $pms;
								} elseif ($value == 'AGO') {
									$rate = $ago;
								} else {
									$rate = $dpk;
								}
							?>
								<td id="rat<?php echo $sr++ ?>" class="font-weight-bold text-right">
									<?php echo $rate; ?>
									<input type="hidden" size="12" class="rate_<?php echo $key  ?>" value="<?php echo $rate; ?>" placeholder='0'>

								</td>

							<?php } ?>
						</tr>
						<tr>
							<td>OPENING STOCK </td>
							<?php $os = 1;
							foreach ($array as $key => $value) { ?>
								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $os++ ?>[open_stock]" class="open_stock_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
						<tr>
							<td>NEW STOCK(INFLOW) </td>
							<?php $ns = 1;
							foreach ($array as $key => $value) { ?>
								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $ns++ ?>[new_stock]" class="new_stock_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
						<tr>
							<td>TOTAL STOCK </td>
							<?php $ts = 1;
							foreach ($array as $key => $value) { ?>
								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $ts++ ?>[total_stock]" class="total_stock_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
						<tr>
							<td>SALES(LTRS) </td>
							<?php $sa = 1;
							foreach ($array as $key => $value) { ?>
								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $sa++ ?>[sales_in_ltr]" class="sales_in_ltr_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
						<tr>
							<td>EXPECTED STOCK(LTRS) </td>
							<?php $es = 1;
							foreach ($array as $key => $value) { ?>

								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $es++ ?>[expected_stock]" class="expected_stock_<?php echo $key ?>" value="" placeholder='0'>
								</td>

							<?php } ?>
						</tr>
						<tr>
							<td>ACTUAL STOCK(LTRS) </td>
							<?php $as = 1;
							foreach ($array as $key => $value) { ?>
								<!-- <td contenteditable="true" id=""></td> -->
								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $as++ ?>[actual_stock]" class="actual_stock_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
						<tr>
							<td>OVER/SHORT </td>
							<?php $ov = 1;
							foreach ($array as $key => $value) { ?>
								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $ov++ ?>[over_or_short]" class="over_or_short_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
						<tr class="bg-light font-weight-bold">
							<td>EXP. SALES VALUE # </td>
							<?php $esp = 1;
							foreach ($array as $key => $value) { ?>
								<td class="text-right p-0">
									<input type="text" readonly size="12" style="width: 90%; text-align: right; border: none; " name="<?php echo "tank" . $esp++ ?>[exp_sales_value]" class="exp_sales_value_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
						<tr>
							<td>CASH SUBMITTED # </td>
							<?php $cs = 1;
							foreach ($array as $key => $value) { ?>
								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $cs++ ?>[cash_submitted]" class="cash_submitted_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
						<tr>
							<td>TOTAL SALES(LTRS)</td>
							<?php $total_s = 1;
							foreach ($array as $key => $value) { ?>
								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $total_s++ ?>[total_sales]" class="total_sales_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
						<tr>
							<td>TOTAL VALUE #</td>
							<?php $total_v = 1;
							foreach ($array as $key => $value) { ?>
								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $total_v++ ?>[total_value]" class="total_value_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
						<tr>
							<td>GRAND TOTAL VALUE # </td>
							<?php $gtotal_v = 1;
							foreach ($array as $key => $value) { ?>
								<td class="text-right p-0">
									<input type="text" size="12" name="<?php echo "tank" . $gtotal_v++ ?>[grand_total]" class="grand_total_<?php echo $key ?>" value="" placeholder='0'>
								</td>
							<?php } ?>
						</tr>
					</tbody>
				</table>
				<div class="d-flex justify-content-end">
					<button type="submit" class="btn btn-primary btn-md">Submit</button>
				</div>
			</form>
		</div>
	</div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script type="text/javascript">
	$(document).ready(function() {
		$('[contenteditable="true"]').keypress(function(e) {
			var x = event.charCode || event.keyCode;
			if (isNaN(String.fromCharCode(e.which)) && x != 46 || x === 32 || x === 13 || (x === 46 && event.currentTarget.innerText.includes('.'))) e.preventDefault();
		});

		$('#data_sheet').on("submit", function(e) {
			e.preventDefault();

			$.ajax({
				url: "inc/create.php",
				method: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				dataType: 'json',
				success: function(r) {
					if (r.success == true) {
						successAlert(r.msg);
					} else {
						errorAlert(r.msg);
					}
				}
			})
		});


		const arr = ['PMS', 'PMS', 'PMS', 'PMS', 'PMS', 'AGO', 'DPK'];

		window.onload = () => {
			sumCash = 0

			for (let i = 0; i < arr.length; i++) {
				let rate = $('.rate_' + i)
				let totalSales = $('.total_sales_' + i)
				let totalValue = $('.total_value_' + i)
				let cashSubmitted = $('.cash_submitted_' + i)
				let grandTotal = $('.grand_total_' + i)

				let openStock = $('.open_stock_' + i)
				let newStock = $('.new_stock_' + i)
				let totalStock = $('.total_stock_' + i)
				$('.total_stock_' + i).prop('readOnly', true)
				$('.total_stock_' + i).css('backgroundColor', '#ccc')

				let salesInLtr = $('.sales_in_ltr_' + i)
				let expectedStock = $('.expected_stock_' + i)
				$('.expected_stock_' + i).prop('readOnly', true)
				$('.expected_stock_' + i).css('backgroundColor', '#ccc')

				let actualStock = $('.actual_stock_' + i)
				let overOrShort = $('.over_or_short_' + i)
				$('.over_or_short_' + i).prop('readOnly', true)
				$('.over_or_short_' + i).css('backgroundColor', '#ccc')

				let expSalesValue = $('.exp_sales_value_' + i)
				$('.exp_sales_value_' + i).prop('readOnly', true)
				$('.exp_sales_value_' + i).css({
					'backgroundColor': 'darkgreen',
					'color': 'white'
				})


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
	})
</script>