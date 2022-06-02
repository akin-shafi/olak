<?php require_once('../private/initialize.php');
// $isProductId = isset($_GET['product']) ? $_GET['product'] : '';

if (isset($_GET['edit'])) :
	$dataSheetId = $_GET['data_sheet'];
	$product = DataSheet::find_by_id($dataSheetId);
endif;

?>

<?php if ($access->add_dip == 1) : ?>
	<form method="post" action="<?php echo './create.php' ?>">
		<input type="hidden" name="data_sheet_form">
		<input type="hidden" name="product_id" id="product_id">
		<div class="modal-body">

			<div class="form-group">
				<label>OPENING STOCK </label>
				<input type="text" name="open_stock" value="<?php echo isset($product->open_stock) ? $product->open_stock : '' ?>" class="form-control">
			</div>
			<div class="form-group">
				<label>NEW STOCK</label>
				<input type="text" name="new_stock" value="<?php echo isset($product->new_stock) ? $product->new_stock : '' ?>" class="form-control">
			</div>

		</div>
		<div class="modal-footer">
			<a href="<?php echo url_for('sales/') ?>" class="btn btn-secondary">Back</a>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>
<?php endif; ?>

<?php if ($access->add_sales == 1) : ?>
	<form method="post" action="<?php echo './edit.php' ?>">
		<input type="hidden" name="edit_sheet_form">
		<input type="hidden" name="sheet_id" id="sheet_id">
		<div class="modal-body">
			<div class="form-group">
				<label>SALES IN (LTR)</label>
				<input type="text" name="sales_in_ltr" value="<?php echo isset($product->sales_in_ltr) ? $product->sales_in_ltr : '' ?>" class="form-control">
			</div>
			<div class="form-group">
				<label>TOTAL SALES <br><small>(CASH, TRANSFER, POS, CREDIT SALES, CHEQUE)</small></label>
				<input type="text" name="total_sales" value="<?php echo isset($product->total_sales) ? $product->total_sales : '' ?>" class="form-control">
			</div>
		</div>
		<div class="modal-footer">
			<a href="<?php echo url_for('sales/') ?>" class="btn btn-secondary">Back</a>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>
<?php endif; ?>