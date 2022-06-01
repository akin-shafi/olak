<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'Add Sales';

$errors = [];

$sheetId = $_GET['data_sheet'] ?? '';

if (empty($sheetId)) redirect_to('../sales/');

$data = DataSheet::find_by_sheet_id($sheetId);
$products = Product::find_all_product($loggedInAdmin->branch_id);
$pro = Product::find_by_id($data->product_id);
$rate = $pro->rate;

if (empty($data)) redirect_to('../sales/');

if (is_post_request()) :
	if (isset($_POST['data_sheet_form'])) :

		$expectedSale 		= $data->expected_sales;
		$totalSales 			= $_POST['total_sales'] ?? '';
		$availableBalance = floatval($expectedSale) - floatval($totalSales);
		$availableStock 	= floatval($availableBalance) / intval($rate);
		$actualSales 			= floatval($totalSales) / intval($rate);

		$args = [
			'total_sales' 			=> $totalSales,
			'available_balance' => $availableBalance,
			'available_stock' 	=> $availableStock,
			'actual_sales' 			=> $actualSales,
		];

		if (is_blank($totalSales)) :
			$errors[] = "Total sales cannot be blank.";
		endif;

		if (empty($errors)) {
			$data->merge_attributes($args);
			$data->save();

			$message =	display_message('Sales recorded successfully!') ?? '';
			redirect_to('../sales/');
		}

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
						<h3 class="ml-3 text-uppercase">Insert Data (<?php echo $pro->name . ' - T' . $pro->tank ?>)</h3>
						<div class="error m-auto"><?php echo display_errors($errors) ?></div>
						<?php include('form_fields.php'); ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>