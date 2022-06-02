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

		$args = [
			'product_id'			=> $productId,
			'open_stock' 			=> $_POST['open_stock'],
			'new_stock' 			=> $_POST['new_stock'],
			'total_stock'			=> $totalStock,
			'company_id' 			=> $loggedInAdmin->company_id,
			'branch_id' 			=> $loggedInAdmin->branch_id,
			"created_by"      => $loggedInAdmin->id,
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

			if ($dataSheet) :

				$newId = $dataSheet->id;
				$todayData = DataSheet::find_by_id($newId);

				$prevDay = date('Y-m-d', strtotime('-1 days'));
				$previousData = DataSheet::find_by_previous_day($prevDay, $todayData->product_id);

				$totalStock = floatval($todayData->total_stock);
				$prevDayExpectedStock = !empty($previousData) ? floatval($previousData->expected_stock) : $totalStock;

				$overage = $totalStock - $prevDayExpectedStock;

				$args = [
					'over_or_short'	=> $overage,
				];

				$todayData->merge_attributes($args);
				$todayData->save();
			endif;

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
