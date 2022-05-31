<?php require_once('../../private/initialize.php');
$uploadDir = '../uploads/';

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

  if (isset($_POST['cash_flow'])) {
    $args = $_POST['flow'];
    $args['company_id'] = $loggedInAdmin->company_id;
    $args['branch_id'] = $loggedInAdmin->branch_id;
    $args['created_by'] = $loggedInAdmin->id;

    $cashFlow = new CashFlow($args);
    $cashFlow->save();

    if ($cashFlow == true) :
      $newId = $cashFlow->id;

      $cFlow = CashFlow::find_by_id($newId);

      $fileTmpPath = $_FILES['voucher']['tmp_name'];
      $fileName = $_FILES['voucher']['name'];
      $fileNameExp = explode('.', $fileName);
      $fileExt = strtolower(end($fileNameExp));
      $newFileName = md5(time() . $fileName) . '.' . $fileExt;
      $allowedFileExt = ['jpg', 'png', 'gif', 'jpeg'];
      $dest_path = $uploadDir . 'voucher/' . $newFileName;

      if (isset($fileName) && !empty($fileName)) {
        if (in_array($fileExt, $allowedFileExt)) {
          if (!empty($cFlow->credit_voucher)) {
            unlink($uploadDir . 'voucher/' . $cFlow->credit_voucher);
          }
          if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $args['credit_voucher'] =  $newFileName;
          } else {
            exit(json_encode(['success' => false, 'msg' => 'Credit voucher not uploaded!']));
          }
        } else {
          exit(json_encode(['success' => false, 'msg' => 'Upload failed. Allowed file types: ' . implode(',', $allowedFileExt)]));
        }
      }

      $cFlow->merge_attributes($args);
      $result = $cFlow->save();

      exit(json_encode(['success' => true, 'msg' => 'Cash flow created successfully!']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($cashFlow->errors)]));
    endif;
  }


  if (isset($_POST['data_sheet_form'])) {
    $args = $_POST;

    $totalSales = 0;
    $totalValue = 0;
    $grandTotalValue = 0;


    if (isset($_POST['input_dipping'])) {

      for ($i = 0; $i < count($args['product_id']); $i++) :
        $product = DataSheet::find_by_product_id($args['product_id'][$i], ['date' => date('Y-m-d')]);

        if (
          isset($product->product_id)
          && ($product->product_id == $args['product_id'][$i])
          && ($product->branch_id == $loggedInAdmin->branch_id)
        ) :
          http_response_code(404);
          exit(json_encode(['error' => '!']));
        else :

          $data = [
            "product_id"         => $args['product_id'][$i],
            "open_stock"         => $args['open_stock'][$i],
            "new_stock"          => $args['new_stock'][$i],
            "total_stock"        => $args['total_stock'][$i],

            "company_id"         => $args['company_id'],
            "branch_id"          => $args['branch_id'],
            "created_by"         => $loggedInAdmin->id,
          ];

          $dataSheet = new DataSheet($data);
          $result = $dataSheet->save();
        endif;
      endfor;
    }

    if (isset($_POST['input_sales'])) {
      for ($i = 0; $i < count($args['product_id']); $i++) :

        $dataSheet = DataSheet::find_by_product_id($args['product_id'][$i], ['date' => date('Y-m-d')]);

        $data = [
          "sales_in_ltr"       => $args['sales_in_ltr'][$i],
          "expected_stock"     => $args['expected_stock'][$i],
          "actual_stock"       => $args['actual_stock'][$i],
          "over_or_short"      => $args['over_or_short'][$i],

          "exp_sales_value"    => $args['exp_sales_value'][$i],
          "cash_submitted"     => $args['cash_submitted'][$i],
          "branch_id"          => $args['branch_id'],

          "updated_by"         => $loggedInAdmin->id,
          "updated_at"         => date('Y-m-d H:i:s'),
        ];

        $mergeData = $dataSheet->merge_attributes($data);
        $result = $dataSheet->save();
      endfor;
    }

    if ($result == true) :
      exit(json_encode(['success' => true, 'msg' => 'Record saved successful']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($dataSheet->errors)]));
    endif;
  }

  if (isset($_POST['edit_sheet_form'])) {
    $args = $_POST;


    if (isset($_POST['input_dipping'])) {
      for ($i = 0; $i < count($args['product_id']); $i++) {

        $data = [
          "product_id"         => $args['product_id'][$i],
          "open_stock"         => $args['open_stock'][$i],
          "new_stock"          => $args['new_stock'][$i],
          "total_stock"        => $args['total_stock'][$i],

          "company_id"         => $args['company_id'],
          "branch_id"          => $args['branch_id'],
          "created_by"         => $loggedInAdmin->id,
        ];

        if (!empty(DataSheet::find_by_sheet_id($args['dataSheetId']))) :
          $editDataSheet = DataSheet::find_by_sheet_id($args['dataSheetId']);

          $editDataSheet->merge_attributes($data);
          $editDataSheet->save();
        endif;
      }
    }

    if (isset($_POST['input_sales'])) {
      for ($i = 0; $i < count($args['product_id']); $i++) {

        $data = [
          "sales_in_ltr"       => $args['sales_in_ltr'][$i],
          "expected_stock"     => $args['expected_stock'][$i],
          "actual_stock"       => $args['actual_stock'][$i],
          "over_or_short"      => $args['over_or_short'][$i],

          "exp_sales_value"    => $args['exp_sales_value'][$i],
          "cash_submitted"     => $args['cash_submitted'][$i],
          "branch_id"          => $args['branch_id'],

          "updated_by"         => $loggedInAdmin->id,
          "updated_at"         => date('Y-m-d H:i:s'),
        ];

        if (!empty(DataSheet::find_by_sheet_id($args['dataSheetId']))) :
          $editDataSheet = DataSheet::find_by_sheet_id($args['dataSheetId']);

          $editDataSheet->merge_attributes($data);
          $editDataSheet->save();
        endif;
      }
    }

    exit(json_encode(['success' => true, 'msg' => 'Record updated successfully!']));
  }


  if (isset($_POST['delete_tank'])) {
    $dataSheetId = $_POST['dataSheetId'];
    $tank = DataSheet::find_by_id($dataSheetId);
    $tank::deleted($dataSheetId);

    if ($tank == true) :
      exit(json_encode(['success' => true, 'msg' => 'Tank record deleted successfully!']));
    endif;
  }
}


if (is_get_request()) {

  if (isset($_GET['filter'])) :
    $branch = isset($_GET['branch']) && $_GET['branch'] != '' ? $_GET['branch'] : $loggedInAdmin->branch_id;

    $dateFrom = $_GET['filterDate'] ?? date('Y-m-d');
    $date = date('Y-m-d', strtotime($dateFrom));
    $companyId = $loggedInAdmin->company_id;
    $products = Product::find_all_product($branch);
    $access = AccessControl::find_by_user_id($loggedInAdmin->id);
?>
    <table id="dataSheet" class="table custom-table">
      <thead>
        <tr class="bg-primary text-white text-center">
          <th>Action</th>
          <th>PRODUCT NAME</th>

          <?php if ($access->add_dip == 1) : ?>
            <th>OPENING STOCK (LTRS)</th>
            <th>NEW STOCK (LTRS)</th>
            <th>STOCK FOR SALE (LTRS)</th>
            <th>PRICE PER LTR (<?php echo $currency ?>)</th>
            <th>EXPECTED SALE (<?php echo $currency ?>)</th>
          <?php endif; ?>

          <?php if ($access->add_sales == 1) : ?>
            <th>TOTAL SALES (<?php echo $currency ?>)</th>
            <th>PRICE PER LTR (<?php echo $currency ?>)</th>
            <th>AVAILABLE BALANCE (<?php echo $currency ?>)</th>
            <th>AVAILABLE STOCK (LTRS)</th>
            <th>ACTUAL SALES (LTRS)</th>
          <?php endif; ?>
          <?php if ($access->edit_sales == 1) : ?>
            <th></th>
          <?php endif; ?>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($products as $product) :
          $data = DataSheet::find_by_product_id($product->id, ['date' => $date, 'company' => $companyId, 'branch' => $branch]);
          $dataId = isset($data->id) ? $data->id : '';

          // *** DIP BY MANAGER ***
          $openStock = isset($data->open_stock) ? $data->open_stock : '0.00';
          $newStock = isset($data->new_stock) ? $data->new_stock : '0.00';
          $totalStock = $openStock != 0 ? (floatval($openStock) + floatval($newStock)) : '0.00';
          $rate = intval($product->rate);
          $expectedSale = isset($data->expected_sales) && $data->expected_sales != 0
            ? $data->expected_sales : '0.00';

          // *** SALES BY SUPERVISOR ***
          $totalSales = isset($data->total_sales) && $data->total_sales != 0
            ? $data->total_sales : '0.00';
          $availableBalance = isset($data->available_balance) && $data->available_balance != 0
            ? $data->available_balance : '0.00';
          $availableStock = isset($data->available_stock) && $data->available_stock != 0
            ? $data->available_stock : '0.00';
          $actualSale = isset($data->actual_sales) && $data->actual_sales != 0
            ? $data->actual_sales : '0.00';
        ?>

          <tr class=" text-center">
            <th>
              <div class="btn-group">
                <?php if ($access->add_dip == 1) : ?>
                  <a href="<?php echo url_for('sales/create.php?product=' . $product->id) ?>" class="btn btn-sm btn-primary enterDip <?php echo $data->total_stock != '' ? 'disabled' : '' ?>">Dip (LTRS)</a>
                <?php endif; ?>

                <?php if ($access->add_sales == 1 && $dataId != '') : ?>
                  <a href="<?php echo url_for('sales/edit.php?data_sheet=' . $dataId) ?>" class="btn btn-sm btn-warning enterSale <?php echo $data->total_sales != '' ? 'disabled' : '' ?>">Sales (<?php echo $currency ?>)</a>
                <?php endif; ?>
                <?php if ($dataId == '') : ?>
                  <span class="btn btn-sm btn-outline-warning">No Dip Value</span>
                <?php endif; ?>
              </div>
            </th>
            <td class="bg-light font-weight-bold"><?php echo strtoupper($product->name) . ' (T' . $product->tank . ')'; ?></td>

            <?php if ($access->add_dip == 1) : ?>
              <td><?php echo number_format($openStock, 2) ?></td>
              <td><?php echo number_format($newStock, 2) ?></td>
              <td class="bg-light" title="Open Stock + New Stock"><?php echo number_format($totalStock, 2) ?></td>
              <td><?php echo number_format($rate, 2); ?></td>
              <td class="bg-light" title="Rate * Total Stock"><?php echo number_format($expectedSale, 2); ?></td>
            <?php endif; ?>

            <?php if ($access->add_sales == 1) : ?>
              <td><?php echo number_format($totalSales, 2) ?></td>
              <td><?php echo number_format($rate, 2); ?></td>
              <td class="bg-light" title="Expected Sales - Total Sales"><?php echo number_format($availableBalance, 2) ?></td>
              <td class="bg-light" title="Available Balance / Rate"><?php echo number_format($availableStock, 2) ?></td>
              <td class="bg-light" title="Total Sales / Rate"><?php echo number_format($actualSale, 2) ?></td>
            <?php endif; ?>

            <?php if ($access->edit_sales == 1) : ?>
              <td>
                <a href="<?php echo url_for('sales/edit.php?data_sheet=' . $dataId . '&edit') ?>" class="btn btn-sm btn-warning enterSale"><span class="icon-edit1"></span> Edit</a>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
<?php
  endif;
}
