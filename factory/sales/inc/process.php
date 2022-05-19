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

    if (isset($_POST['factory_form'])) {
        $args = $_POST;

        for ($i = 0; $i < count($args['product_id']); $i++) {
            $data = [
                'product_id'        => $args['product_id'][$i],
                'category_id'       => $args['category_id'][$i],
                'gauge_id'          => $args['gauge_id'][$i],
                'open_stock'        => $args['open_stock'][$i],
                'production'        => $args['production'][$i],
                'return_inward'     => $args['return_inward'][$i],
                'total_production'  => $args['total_stock'][$i],
                'sales'             => $args['sales'][$i],
                'imported'          => $args['imported'][$i],
                'local'             => $args['local'][$i],
                'total_sales'       => $args['total_sales'][$i],
                'closing_stock'     => $args['closing_stock'][$i],
                'company_id'        => $args['company_id'],
                'branch_id'         => $args['branch_id'],
                "created_by"        => $loggedInAdmin->id,
            ];

            $stockPhase = new StockPhaseOne($data);
            $result = $stockPhase->save();
        }

        if ($result == true) :
            exit(json_encode(['success' => true, 'msg' => 'Submitted Successfully!']));
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
                'product_id'        => $args['product_id'][$i],
                'category_id'       => $args['category_id'][$i],
                'gauge_id'          => $args['gauge_id'][$i],
                'open_stock'        => $args['open_stock'][$i],
                'production'        => $args['production'][$i],
                'return_inward'     => $args['return_inward'][$i],
                'total_production'  => $args['total_stock'][$i],
                'sales'             => $args['sales'][$i],
                'imported'          => $args['imported'][$i],
                'local'             => $args['local'][$i],
                'total_sales'       => $args['total_sales'][$i],
                'closing_stock'     => $args['closing_stock'][$i],
                'company_id'        => $args['company_id'][$i],
                'branch_id'         => $args['branch_id'][$i],
                "created_by"        => $loggedInAdmin->id,
            ];

            if (!empty(StockPhaseOne::find_by_id($args['tankId']))) :
                $editTank = StockPhaseOne::find_by_id($args['tankId']);

                $editTank->merge_attributes($data);
                $editTank->save();
            endif;
        }
        exit(json_encode(['success' => true, 'msg' => 'Tank updated successfully!']));
    }


    if (isset($_POST['delete_tank'])) {
        $tankId = $_POST['tankId'];
        $tank = StockPhaseOne::find_by_id($tankId);
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

        $groupByCategory = StockPhaseOne::group_by_category();
        $fullGroup = StockPhaseOne::group_by_product();

        if ($loggedInAdmin->admin_level == 1) {
            $filterDataSheet = StockPhaseOne::filter_by_date($dateConvertFrom, $dateConvertTo, ['branch' => $branch]);
        } else {
            $filterDataSheet = StockPhaseOne::filter_by_date($dateConvertFrom, $dateConvertTo, ['company' => $loggedInAdmin->company_id, 'branch' => $loggedInAdmin->branch_id]);
        }

?>
        <style>
            /* th {
                text-transform: capitalize !important;
                text-align: center;
            } */

            td {
                min-width: 100px !important;
                padding: 0.3rem 0.4rem !important;
            }
        </style>

        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="text-center border uppercase">
                    <th rowspan="2"></th>
                    <?php foreach ($groupByCategory as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name; ?>
                        <th colspan="6" style="font-size:20px;color:<?php echo strtolower($categoryName) ?> ;"><?php echo strtoupper($categoryName) ?></th>
                    <?php endforeach; ?>
                </tr>
                <tr class="text-center border capitalize">
                    <?php foreach ($fullGroup as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name;
                        $productName = Product::find_by_id($data->product_id)->name; ?>
                        <th style="color:<?php echo strtolower($categoryName) ?> ;"><?php echo strtoupper($productName) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-weight-bold text-uppercase">Opening Stock</td>
                    <?php foreach ($fullGroup as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name;
                    ?>
                        <td style="color:<?php echo $categoryName ?>"><?php echo number_format($data->open_stock, 2); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td class="font-weight-bold text-uppercase">New Stock</td>
                    <?php foreach ($fullGroup as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name;
                    ?>
                        <td style="color:<?php echo $categoryName ?>"><?php echo number_format($data->production, 2); ?></td>
                    <?php endforeach; ?>
                <tr>
                    <td class="font-weight-bold text-uppercase">Return Inward</td>
                    <?php foreach ($fullGroup as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name;
                    ?>
                        <td style="color:<?php echo $categoryName ?>"><?php echo number_format($data->return_inward, 2); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td class="font-weight-bold text-uppercase">Total</td>
                    <?php foreach ($fullGroup as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name;
                    ?>
                        <td style="color:<?php echo $categoryName ?>"><?php echo number_format($data->total_production, 2); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td class="font-weight-bold text-uppercase">Sales</td>
                    <?php foreach ($fullGroup as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name;
                    ?>
                        <td style="color:<?php echo $categoryName ?>"><?php echo number_format($data->sales, 2); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td class="font-weight-bold text-uppercase">Imported</td>
                    <?php foreach ($fullGroup as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name;
                    ?>
                        <td style="color:<?php echo $categoryName ?>"><?php echo number_format($data->imported, 2); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td class="font-weight-bold text-uppercase">Local</td>
                    <?php foreach ($fullGroup as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name;
                    ?>
                        <td style="color:<?php echo $categoryName ?>"><?php echo number_format($data->local, 2); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td class="font-weight-bold text-uppercase">Total Sales</td>
                    <?php foreach ($fullGroup as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name;
                    ?>
                        <td style="color:<?php echo $categoryName ?>"><?php echo number_format($data->total_sales, 2); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td class="font-weight-bold text-uppercase">Closing Stock</td>
                    <?php foreach ($fullGroup as $data) :
                        $categoryName = Category::find_by_id($data->category_id)->name;
                    ?>
                        <td style="color:<?php echo $categoryName ?>"><?php echo number_format($data->closing_stock, 2); ?></td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>

<?php
    endif;
}
