<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'Add Sales';

$products = Product::find_all_product($loggedInAdmin->branch_id);
$company = Company::find_by_id($loggedInAdmin->company_id);
$branches = Branch::find_all_branch(['company_id' => $company->id]);
$adminLevel = $loggedInAdmin->admin_level;

$errors = [];

if (is_post_request()) :
	if (isset($_POST['data_sheet_form'])) :
		$productId = $_POST['product_id'];
		$product = Product::find_by_id($productId);

		$totalStock = floatval($_POST['open_stock']) + floatval($_POST['new_stock']);
		$expectedSale = intval($product->rate) * $totalStock;


		$args = [
			'product_id'			=> $productId,
			'open_stock' 			=> $_POST['open_stock'],
			'new_stock' 			=> $_POST['new_stock'],
			'total_stock'			=> $totalStock,
			'expected_sales'	=> $expectedSale,
			'company_id' 			=> $loggedInAdmin->company_id,
			'branch_id' 			=> $loggedInAdmin->branch_id,
		];

		if (is_blank($args['open_stock'])) :
			$errors[] = "Open Stock cannot be blank.";
		endif;
		if (is_blank($args['new_stock'])) :
			$errors[] = "New Stock cannot be blank.";
		endif;

		if (empty($errors)) :
			$dataSheet = new DataSheet($args);
			$dataSheet->save();

			$message =	display_message('Record saved successfully!') ?? '';
			redirect_to('../sales/');
		endif;


	endif;
else :
	$dataSheet = new DataSheet();
endif;

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
						<h3 class="ml-3 text-uppercase">Enter Dip</h3>
						<div class="error m-auto"><?php echo display_errors($errors) ?></div>
						<?php include('form_fields.php'); ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>
