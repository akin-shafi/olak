<?php require_once('../private/initialize.php'); ?>

<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
	<input type="hidden" name="data_sheet_form">
	<input type="hidden" name="product_id" value="<?php echo $_GET['product'] ?? ''; ?>">
	<div class="modal-body">
		<div class="container">
			<div class="row">
				<div class="col-md-8 m-auto">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>OPENING STOCK </label>
								<input type="text" name="open_stock" value="<?php echo isset($product->opening_stock) ? $product->opening_stock : '' ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>NEW STOCK</label>
								<input type="text" name="new_stock" value="<?php echo isset($product->new_stock) ? $product->new_stock : '' ?>" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a href="<?php echo url_for('sales/add_sales.php') ?>" class="btn btn-secondary">Back</a>
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
</form>