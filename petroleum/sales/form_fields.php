<?php
$productId = $_GET['dipPID'] ?? '';
$sheetId = $_GET['sheetId'] ?? '';

if (!empty($productId)) :
	$prevDay 	= date('Y-m-d', strtotime('-1 days'));
	$prevData	= DataSheet::find_by_previous_day($prevDay, $productId);
	$rate = Product::find_by_id($productId)->rate;
endif;

// *** COMPLIANCE EDIT ALL (DIP & SALES) ***
if (isset($_GET['edit'])) :
	$dataSheetId = $_GET['data_sheet'];
	$product = DataSheet::find_by_id($dataSheetId);
endif;

?>

<?php if ($access->add_dip == 1) : ?>
	<form method="post" action="<?php echo url_for('sales/create.php'); ?>">
		<input type="hidden" name="data_sheet_form" readonly>
		<input type="hidden" name="product_id" value="<?php echo $productId ?>" readonly>
		<input type="hidden" name="rate" value="<?php echo $rate ?>" readonly>

		<div class="modal-body">
			<?php if (!empty($prevData)) : ?>
				<div class="form-group">
					<label for="a_stock">ACTUAL STOCK</label>
					<input type="text" name="actual_stock" value="<?php echo isset($product->actual_stock) ? $product->actual_stock : '' ?>" class="form-control" id="a_stock" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
				</div>
			<?php endif; ?>

			<div class="form-group">
				<label for="o_stock">OPENING STOCK </label>
				<input type="text" name="open_stock" value="<?php echo isset($product->open_stock) ? $product->open_stock : '' ?>" class="form-control" id="o_stock" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
			</div>
			<div class="form-group">
				<label for="n_stock">NEW STOCK</label>
				<input type="text" name="new_stock" value="<?php echo isset($product->new_stock) ? $product->new_stock : '' ?>" class="form-control" id="n_stock" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
			</div>
		</div>

		<div class="modal-footer">
			<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>
<?php endif; ?>

<?php if ($access->add_sales == 1) : ?>
	<form method="post" action="<?php echo url_for('sales/edit.php'); ?>">
		<input type="hidden" name="edit_sheet_form">
		<input type="hidden" name="sheet_id" value="<?php echo $sheetId ?>">

		<div class="modal-body">
			<div class="form-group">
				<label for="s_ltr">SALES IN (LTR)</label>
				<input type="text" name="sales_in_ltr" value="<?php echo isset($product->sales_in_ltr) ? $product->sales_in_ltr : '' ?>" class="form-control" id="s_ltr" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
			</div>
			<div class="form-group">
				<label for="t_sales">TOTAL SALES <br><small>(CASH, TRANSFER, POS, CREDIT SALES, CHEQUE)</small></label>
				<input type="text" name="total_sales" value="<?php echo isset($product->total_sales) ? $product->total_sales : '' ?>" class="form-control" id="t_sales" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');">
			</div>
		</div>

		<div class="modal-footer">
			<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>
<?php endif; ?>