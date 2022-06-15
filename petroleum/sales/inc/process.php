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
  $access = AccessControl::find_by_user_id($loggedInAdmin->id);

  if (isset($_GET['filter'])) :
    $adminLevel = Admin::find_by_id($loggedInAdmin->id)->admin_level;
    $branch = isset($_GET['branch']) && $_GET['branch'] != '' ? $_GET['branch'] : $loggedInAdmin->branch_id;

    if (!empty($_GET['rangeText'])) :
      $rangeText = $_GET['rangeText'];
      $explode = explode('-', $rangeText);
      $dateFrom = $explode[0];
      $dateTo = $explode[1];
      $dateConvertFrom = date('Y-m-d', strtotime($dateFrom));
      $dateConvertTo = date('Y-m-d', strtotime($dateTo));
    else :
      $dateConvertFrom = date('Y-m-d');
      $dateConvertTo = date('Y-m-d');
    endif;
    $companyId = $loggedInAdmin->company_id;
    $products = Product::find_all_product($branch);
?>

    <table id="dataSheet" class="table custom-table">
      <thead>
        <tr class="bg-primary text-white text-center">
          <th>PRODUCT NAME</th>

          <?php if ($access->add_dip == 1) : ?>
            <th>OPENING STOCK (LTR)</th>
            <th>NEW STOCK (LTR)</th>
            <th>TOTAL STOCK (LTR)</th>
          <?php endif; ?>

          <?php if ($access->add_sales == 1) : ?>
            <th>SALES IN (LTR)</th>
            <th>REMITTANCE (<?php echo $currency ?>)</th>

            <?php if (in_array($adminLevel, [1, 2, 3, 4, 5, 8])) : ?>
              <th>EXPECTED SALE (<?php echo $currency ?>)</th>
              <th>EXPECTED STOCK (LTR)</th>
              <th>ACTUAL STOCK (LTR)</th>
              <th>OVER/SHORT (LTR)</th>
            <?php endif; ?>

          <?php endif; ?>
          <?php if ($access->edit_sales == 1) : ?>
            <th></th>
          <?php endif; ?>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($products as $product) :
          $data = DataSheet::find_by_product_id($product->id, $dateConvertFrom, $dateConvertTo,  ['company' => $companyId, 'branch' => $branch]);
          $dataId = isset($data->id) ? $data->id : '';

          // *** DIP BY MANAGER ***
          $openStock = isset($data->open_stock)   ? $data->open_stock : 0;
          $newStock = isset($data->new_stock)     ? $data->new_stock : 0;
          $totalStock = isset($data->open_stock)  ? $data->total_stock : 0;
          $rate = intval($product->rate);

          // *** SALES BY SUPERVISOR ***
          $salesInLtr = isset($data->sales_in_ltr) && $data->sales_in_ltr != 0        ? $data->sales_in_ltr : 0;
          $expectedSale = isset($data->expected_sales) && $data->expected_sales != 0  ? $data->expected_sales : 0;
          $remittance = isset($data->total_sales) && $data->total_sales != 0          ? $data->total_sales : 0;
          $expectedStock = $totalStock - $salesInLtr;
          $actualStock = isset($data->actual_stock) && $data->actual_stock != 0 ? floatval($data->actual_stock) : 0;

          $overage = ($actualStock == 0) ? 0 : floatval($actualStock - $expectedStock);

          $color = $overage < 0 ? 'text-danger' : '';
        ?>

          <tr class=" text-center">
            <td style="min-width: 230px;">
              <div class="btn-group">
                <?php if ($access->add_dip == 1) : ?>
                  <button class="btn btn-primary dip" data-id="<?php echo $product->id; ?>" <?php echo !empty($data->total_stock) ? 'disabled' : '' ?>>
                    <?php echo strtoupper($product->name) . ' (T' . $product->tank . ')'; ?></button>
                <?php endif; ?>

                <?php if ($access->add_sales == 1 && $dataId != '') : ?>
                  <button class="btn btn-warning dip" data-id="<?php echo $product->id; ?>" data-sheet-id="<?php echo $dataId; ?>" <?php echo !empty($data->total_sales) || ($data->total_sales == '0') ? 'disabled' : '' ?>>
                    <?php echo strtoupper($product->name) . ' (T' . $product->tank . ')'; ?> (<?php echo $currency ?>)</button>
                <?php endif; ?>

                <?php if ($dataId == '') : ?>
                  <button class="btn btn-outline-warning">No Dip</button>
                <?php endif; ?>
              </div>
            </td>

            <?php if ($access->add_dip == 1) : ?>
              <td><?php echo number_format($openStock, 2) ?></td>
              <td><?php echo number_format($newStock, 2) ?></td>
              <td class="bg-light" title="Open Stock + New Stock"><?php echo number_format($totalStock, 2) ?></td>
            <?php endif; ?>

            <?php if ($access->add_sales == 1) : ?>
              <td><?php echo number_format($salesInLtr, 2); ?></td>
              <td><?php echo number_format($remittance, 2) ?></td>
            <?php endif; ?>

            <?php if (in_array($adminLevel, [1, 2, 3, 4, 5, 8])) : ?>
              <td class="bg-light" title="Rate * Sales In Ltr"><?php echo number_format($expectedSale, 2); ?></td>
              <td class="bg-light" title="Total Stock - Sales In Ltr"><?php echo number_format($expectedStock, 2); ?></td>
              <td><?php echo number_format($actualStock, 2); ?></td>
              <td class="bg-light <?php echo $color; ?>" title="Actual Stock - Expected Stock"><?php echo number_format($overage, 2) ?></td>
            <?php endif; ?>

            <?php if ($access->edit_sales == 1) : ?>
              <td style="min-width: 100px;">
                <a href="<?php echo url_for('sales/edit.php?data_sheet=' . $dataId . '&edit') ?>" class="btn btn-warning enterSale <?php echo empty($dataId) ? 'disabled' : '' ?>"><span class="icon-edit1"></span> Edit</a>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
<?php endif;


  // *** GET FORM FIELDS ***
  if (isset($_GET['get_form_fields'])) : include('../form_fields.php');
  endif;
}
