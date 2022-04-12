<?php require_once('../../private/initialize.php');

if (is_post_request()) {
    if (isset($_POST['product_form'])) {
        $args = $_POST['product'];
        $product = new Product($args);
        $product->save();

        if ($product == true) :
            exit(json_encode(['success' => true, 'msg' => 'Product created successfully!']));
        else :
            exit(json_encode(['success' => false, 'msg' => display_errors($product->errors)]));
        endif;
    }

    if (isset($_POST['data_sheet_form'])) {
        $args = $_POST;

        // ! I am thinking of removing the below data from the database
        // ! **********
        // ! **********
        $totalSales = 0;        // ! ********** Suggesting we do the 
        $totalValue = 0;        // ! ********** calculations from the list view
        $grandTotalValue = 0;   // ! ********** Think about it
        // ! **********
        // ! **********
        // ! I am thinking of removing the above data from the database

        for ($i = 0; $i < count($args['product_id']); $i++) {
            $data = [
                "product_id"         => $args['product_id'][$i],
                "open_stock"         => $args['open_stock'][$i],
                "new_stock"          => $args['new_stock'][$i],
                "total_stock"        => $args['total_stock'][$i],
                "sales_in_ltr"       => $args['sales_in_ltr'][$i],
                "expected_stock"     => $args['expected_stock'][$i],
                "actual_stock"       => $args['actual_stock'][$i],
                "over_or_short"      => $args['over_or_short'][$i],
                "exp_sales_value"    => $args['exp_sales_value'][$i],
                "cash_submitted"     => $args['cash_submitted'][$i],

                "total_sales"        => $totalSales,
                "total_value"        => $totalValue,
                "grand_total_value"  => $grandTotalValue,

                "company_id"         => $loggedInAdmin->company_id,
                "branch_id"          => $loggedInAdmin->branch_id,
                "created_by"         => $loggedInAdmin->id,
            ];

            $dataSheet = new DataSheet($data);
            $result = $dataSheet->save();
        }

        if ($result == true) :
            exit(json_encode(['success' => true, 'msg' => 'Submit Successful']));
        else :
            exit(json_encode(['success' => false, 'msg' => display_errors($dataSheet->errors)]));
        endif;
    }
}


if (is_get_request()) {
    if (isset($_GET['get_product'])) :
        $pId = $_GET['pId'];
        $product = Product::find_by_id($pId);
        exit(json_encode(['success' => true, 'data' => $product]));
    endif;
}
