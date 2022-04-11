<?php require_once('../../private/initialize.php');

if (is_post_request()) {
    $open_stock = $_POST;
    for ($i = 1; $i <= count($open_stock); $i++) {
        $data = [
            "tank"                  => 'tank' . $i,
            "open_stock"         => $_POST['tank' . $i]['open_stock'],
            "new_stock"          => $_POST['tank' . $i]['new_stock'],
            "total_stock"        => $_POST['tank' . $i]['total_stock'],
            "sales_in_ltr"       => $_POST['tank' . $i]['sales_in_ltr'],
            "expected_stock"     => $_POST['tank' . $i]['expected_stock'],
            "actual_stock"       => $_POST['tank' . $i]['actual_stock'],
            "over_or_short"      => $_POST['tank' . $i]['over_or_short'],
            "exp_sales_value"    => $_POST['tank' . $i]['exp_sales_value'],
            "cash_submitted"     => $_POST['tank' . $i]['cash_submitted'],
            "total_sales"        => $_POST['tank' . $i]['total_sales'],
            "total_value"        => $_POST['tank' . $i]['total_value'],
            "grand_total"        => $_POST['tank' . $i]['grand_total'],
            "company_id"         => $loggedInAdmin->company_id,
            "branch_id"          => $loggedInAdmin->branch_id,
            "created_by"         => $loggedInAdmin->id,
        ];

        $dataSheet = new DataSheet($data);
        $last_result = $dataSheet->save();
        if ($last_result == true) {
            exit(json_encode(['success' => true, 'msg' => 'Submit Successful']));
        } else {
            exit(json_encode(['success' => false, 'msg' => display_errors($dataSheet->errors)]));
        }
    }
}
