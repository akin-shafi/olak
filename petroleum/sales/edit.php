<?php require_once('../private/initialize.php');

require_login();

$page = 'Sales';
$page_title = 'Edit Sales';

$errors = [];

$sheetId = $_GET['data_sheet'] ?? '';

if (is_post_request()) :
	if (isset($_POST['edit_sheet_form'])) :
		$data = DataSheet::find_by_sheet_id($_POST['sheet_id']);
		$pro 	= Product::find_by_id($data->product_id);
		$rate = $pro->rate;

		$remittance			= $_POST['total_sales'] ?? '';
		$salesInLtr			= $_POST['sales_in_ltr'] ?? '';
		$expectedStock 	= floatval($data->total_stock) - floatval($salesInLtr);
		$expectedSale 	= intval($rate) * floatval($salesInLtr);

		$args = [
			'sales_in_ltr' 		=> $salesInLtr,
			'total_sales' 		=> $remittance,
			'expected_stock'	=> $expectedStock,
			'expected_sales'	=> $expectedSale,
			"updated_by"   		=> $loggedInAdmin->id,
			"updated_at"   		=> date('Y-m-d H:i:s'),
		];


		if (is_blank($remittance)) :
			$errors[] = "Total sales cannot be blank.";
		endif;

		if (empty($errors)) :
			$data->merge_attributes($args);
			$data->save();

			$session->message('Sales recorded successfully!') ?? '';
			redirect_to('../sales/');
		else :

			$session->message($errors);
			redirect_to('../sales/');
		endif;

	endif;



	if (isset($_POST['compliance_edit'])) :
		$data = DataSheet::find_by_sheet_id($_POST['sheet_id']);
		$pro 	= Product::find_by_id($data->product_id);
		$rate = $pro->rate;

		$totalStock = floatval($_POST['open_stock']) + floatval($_POST['new_stock']);
		$expectedStock 	= $totalStock - floatval($_POST['sales_in_ltr']);
		$expectedSale 	= intval($rate) * floatval($_POST['sales_in_ltr']);
		$actualStock 		= isset($_POST['actual_stock']) ? $_POST['actual_stock'] : 0;

		$overage 				= ($actualStock == 0) ? 0 : floatval($actualStock - $expectedStock);

		$args = [
			'open_stock' 			=> $_POST['open_stock'],
			'new_stock' 			=> $_POST['new_stock'],
			'total_stock'			=> $totalStock,
			'sales_in_ltr' 		=> $_POST['sales_in_ltr'],
			'total_sales' 		=> $_POST['total_sales'],
			'expected_stock'	=> $expectedStock,
			'actual_stock'		=> $actualStock,
			'expected_sales'	=> $expectedSale,
			'over_or_short'		=> $overage,
			'updated_by'      => $loggedInAdmin->id,
			'updated_at'      => date('Y-m-d H:i:s'),
		];

		if (is_blank($_POST['total_sales'])) :
			$errors[] = "Total sales cannot be blank.";
		endif;

		if (empty($errors)) :
			$data->merge_attributes($args);
			$data->save();
			$session->message('Sales recorded successfully!') ?? '';
			redirect_to('../sales/');
		else :
			$session->message($errors);
			redirect_to('../sales/');
		endif;

	endif;
else :
	$dataSheet = new DataSheet();
endif;
?>

<?php

if (is_get_request()) :

	if (empty($sheetId)) redirect_to(url_for('sales/'));

	if (isset($sheetId) && $sheetId != '') :

		$data = DataSheet::find_by_sheet_id($sheetId);
		$pro = Product::find_by_id($data->product_id);
		$rate = $pro->rate;

		$prevDay 	= date('Y-m-d', strtotime('-1 days'));
		$prevData	= DataSheet::find_by_previous_day($prevDay, $pro->id);

		include(SHARED_PATH . '/admin_header.php'); ?>

		<style>
			.error {
				width: 8rem;
				min-width: 400px;
			}
		</style>

		<div class="content-wrapper">
			<div class="row gutters">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

					<div class="card">
						<div class="card-body">
							<div class="shadow">
								<h3 class="ml-3 text-uppercase">Edit Data (<?php echo $pro->name . ' - T' . $pro->tank ?>)</h3>
								<div class="error m-auto"><?php echo display_errors($errors) ?></div>
								<div class="row">
									<div class="col-md-3 m-auto">
										<?php if ($access->add_dip == 1) : ?>
											<form method="post" action="<?php echo './edit.php' ?>">
												<input type="hidden" name="compliance_edit">
												<input type="hidden" name="sheet_id" value="<?php echo $sheetId; ?>" id="sheet_id">

												<div class="modal-body">
													<div class="form-group">
														<label for="a_stock">ACTUAL STOCK</label>
														<input type="text" name="actual_stock" value="<?php echo isset($data->actual_stock) ? $data->actual_stock : '' ?>" class="form-control" id="a_stock">
													</div>
													<div class="form-group">
														<label for="o_stock">OPENING STOCK </label>
														<input type="text" name="open_stock" value="<?php echo isset($data->open_stock) ? $data->open_stock : '' ?>" id="o_stock" class="form-control">
													</div>
													<div class="form-group">
														<label for="n_stock">NEW STOCK</label>
														<input type="text" name="new_stock" value="<?php echo isset($data->new_stock) ? $data->new_stock : '' ?>" id="n_stock" class="form-control">
													</div>

													<hr class="bg-secondary" />

													<div class="form-group">
														<label for="s_stock">SALES IN (LTR)</label>
														<input type="text" name="sales_in_ltr" value="<?php echo isset($data->sales_in_ltr) ? $data->sales_in_ltr : '' ?>" id="s_stock" class="form-control">
													</div>
													<div class="form-group">
														<label for="t_stock">TOTAL SALES <br><small>(CASH, TRANSFER, POS, CREDIT SALES, CHEQUE)</small></label>
														<input type="text" name="total_sales" value="<?php echo isset($data->total_sales) ? $data->total_sales : '' ?>" id="t_stock" class="form-control">
													</div>
												</div>

												<div class="modal-footer justify-content-center">
													<a href="<?php echo url_for('sales/') ?>" class="btn btn-secondary">Back</a>
													<button type="submit" class="btn btn-primary">Save</button>
												</div>
											</form>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>


		<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<?php endif;
endif; ?>