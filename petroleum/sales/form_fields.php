<?php require_once('../private/initialize.php');
$isProductId = isset($_GET['product']) ? $_GET['product'] : '';

if (isset($_GET['edit'])) :
	$dataSheetId = $_GET['data_sheet'];
	$product = DataSheet::find_by_id($dataSheetId);
endif;
?>

<form method="post">
	<input type="hidden" name="data_sheet_form">
	<input type="hidden" name="product_id" value="<?php echo $isProductId ?>">
	<div class="modal-body">
		<div class="container">
			<div class="row">
				<div class="col-md-8 m-auto">
					<div class="row">
						<?php if ($access->add_dip == 1 && $isProductId != '') : ?>

							<div class="col-md-6">
								<div class="form-group">
									<label>OPENING STOCK </label>
									<input type="text" name="open_stock" value="<?php echo isset($product->open_stock) ? $product->open_stock : '' ?>" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>NEW STOCK</label>
									<input type="text" name="new_stock" value="<?php echo isset($product->new_stock) ? $product->new_stock : '' ?>" class="form-control">
								</div>
							</div>

						<?php endif; ?>

						<?php if ($access->add_sales == 1 && $isProductId == '') : ?>
							<div class="col-md-6 m-auto">
								<div class="form-group">
									<label>TOTAL SALES <small>(CASH, TRANSFER, POS, CREDIT SALES, CHEQUE)</small></label>
									<input type="text" name="total_sales" value="<?php echo isset($product->total_sales) ? $product->total_sales : '' ?>" class="form-control">
								</div>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a href="<?php echo url_for('sales/') ?>" class="btn btn-secondary">Back</a>
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
</form>