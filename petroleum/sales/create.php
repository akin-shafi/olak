<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'Add Sales';

$errors = [];

if (is_post_request()) :
	if (isset($_POST['data_sheet_form'])) :
		$productId 		= $_POST['product_id'];
		$openStock 		= $_POST['open_stock'];
		$newStock 		= $_POST['new_stock'];
		$actualStock 	= $_POST['actual_stock'];

		$product = Product::find_by_id($productId);

		$prevDay 				= date('Y-m-d', strtotime('-1 days'));
		$prevData 			= DataSheet::find_by_previous_day($prevDay, $productId);
		$prevTotalStock = isset($prevData->total_stock) ? $prevData->total_stock : 0;
		$prevSalesInLtr = isset($prevData->sales_in_ltr) ? $prevData->sales_in_ltr : 0;

		if (!empty($prevData)) :
			$prevExpectedStock 	= floatval($prevTotalStock) - floatval($prevSalesInLtr);
			$overage 						= $actualStock - $prevExpectedStock;

			$args = [
				'actual_stock' 	=> $actualStock,
				'over_or_short'	=> $overage,
			];

			$prevData->merge_attributes($args);
			$prevData->save();
		endif;

		$totalStock = floatval($openStock) + floatval($newStock);

		$args = [
			'product_id'	=> $productId,
			'open_stock' 	=> $openStock,
			'new_stock' 	=> $newStock,
			'total_stock'	=> $totalStock,
			'company_id' 	=> $loggedInAdmin->company_id,
			'branch_id' 	=> $loggedInAdmin->branch_id,
			"created_by" 	=> $loggedInAdmin->id,
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

			$session->message('Record saved successfully!') ?? '';
			redirect_to('../sales/');

		else :
			$session->message($errors);
			redirect_to('../sales/');
		endif;


	endif;
else :
	$dataSheet = new DataSheet();
endif;
