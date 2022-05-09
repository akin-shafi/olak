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

        $totalSales = 0;
        $totalValue = 0;
        $grandTotalValue = 0;

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

                "company_id"         => $args['company_id'],
                "branch_id"          => $args['branch_id'],
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

    if (isset($_POST['edit_sheet_form'])) {
        $args = $_POST;
        $totalSales = 0;
        $totalValue = 0;
        $grandTotalValue = 0;


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

                "company_id"         => $args['company_id'],
                "branch_id"          => $args['branch_id'],
                "created_by"         => $loggedInAdmin->id,
            ];

            if (!empty(DataSheet::find_by_sheet_id($args['tankId']))) :
                $editTank = DataSheet::find_by_sheet_id($args['tankId']);

                $editTank->merge_attributes($data);
                $editTank->save();
            endif;
        }
        exit(json_encode(['success' => true, 'msg' => 'Tank updated successfully!']));
    }


    if (isset($_POST['delete_tank'])) {
        $tankId = $_POST['tankId'];
        $tank = DataSheet::find_by_id($tankId);
        $tank::deleted($tankId);

        if ($tank == true) :
            exit(json_encode(['success' => true, 'msg' => 'Tank record deleted successfully!']));
        endif;
    }
}


if (is_get_request()) {
    if (isset($_GET['get_product'])) :
        $pId = $_GET['pId'];
        $product = Product::find_by_id($pId);
        exit(json_encode(['success' => true, 'data' => $product]));
    endif;

    if (isset($_GET['filter'])) :

        $branch = isset($_GET['branch']) && $_GET['branch'] != '' ? $_GET['branch'] : '1';

        $rangeText = $_GET['rangeText'];
        $explode = explode('-', $rangeText);
        $dateFrom = $explode[0];
        $dateTo = $explode[1] ?? '';
        $dateConvertFrom = date('Y-m-d', strtotime($dateFrom));
        $dateConvertTo = date('Y-m-d', strtotime($dateTo));

        if ($loggedInAdmin->admin_level == 1) {
            $filterDataSheet = DataSheet::filter_by_date($dateConvertFrom, $dateConvertTo, ['branch' => $branch]);
        } else {
            $filterDataSheet = DataSheet::filter_by_date($dateConvertFrom, $dateConvertTo, ['company' => $loggedInAdmin->company_id, 'branch' => $loggedInAdmin->branch_id]);
        }
?>
        <thead>
            <tr class="bg-primary text-white ">
                <th class="font-weight-bold">Product</th>
                <?php foreach ($filterDataSheet as $product) : ?>
                    <th class="font-weight-bold text-right">
                        <p><?php echo strtoupper($product->name) . ' (TANK ' . $product->tank . ')'; ?></p>
                        <div class="btn-group">
                            <a href="<?php echo url_for('sales/edit_sales.php?sheet_id=' . $product->id) ?>" class="btn btn-sm btn-warning"><i class="icon-edit"></i></a>
                            <button data-id="<?php echo $product->id ?>" class="btn btn-sm btn-secondary remove-btn"><i class="icon-delete"></i></button>
                        </div>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <tr class="font-weight-bold">
                <td class="text-uppercase">Branch</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo Branch::find_by_id($data->branch_id)->name; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr class="font-weight-bold">
                <td class="text-uppercase">Created At</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo date('M d, Y', strtotime($data->created_at)); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr class="font-weight-bold">
                <td class="text-uppercase">Rate</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo number_format($data->rate, 2); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="text-uppercase">open stock</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo number_format($data->open_stock, 2); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="text-uppercase">New stock (Inflow)</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo $data->new_stock != '' ? number_format($data->new_stock, 2) : 0; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="text-uppercase">Total stock</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo number_format(intval($data->total_stock), 2); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="text-uppercase">Sales (Ltr)</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo number_format(intval($data->sales_in_ltr), 2); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="text-uppercase">Expected stock (Ltr)</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo number_format(intval($data->expected_stock), 2); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="text-uppercase">Actual stock (Ltr)</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo number_format(intval($data->actual_stock), 2); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td class="text-uppercase">Over/Short</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right <?php echo $data->over_or_short < 0 ? 'text-danger' : '' ?>">
                        <?php echo number_format(intval($data->over_or_short), 2); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr class="font-weight-bold">
                <td class="text-uppercase">Expected sales value</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo number_format(intval($data->exp_sales_value), 2); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr class="font-weight-bold">
                <td class="text-uppercase">Cash submitted</td>
                <?php foreach ($filterDataSheet as $data) : ?>
                    <td class="text-right"><?php echo number_format(intval($data->cash_submitted), 2); ?></td>
                <?php endforeach; ?>
            </tr>
        </tbody>
<?php
    endif;
}
