<?php require_once('../../private/initialize.php');

if (is_post_request()) {

  if (isset($_POST['factory_form'])) {
    $args = $_POST;

    for ($i = 0; $i < count($args['product_id']); $i++) {
      $data = [
        'product_id'        => $args['product_id'][$i],
        'category_id'       => $args['category_id'][$i],
        'gauge_id'          => $args['gauge_id'][$i],
        'open_stock'        => $args['open_stock'][$i],
        'production'        => $args['production'][$i],
        'transfer'          => $args['transfer'][$i],
        'total_production'  => $args['total_stock'][$i],
        'sales'             => $args['sales'][$i],
        'closing_stock'     => $args['closing_stock'][$i],
        'company_id'        => $args['company_id'],
        'branch_id'         => $args['branch_id'],
        'remarks'           => $args['remarks'],
        "created_by"        => $loggedInAdmin->id,
      ];

      $stockPhase = new StockPhaseTwo($data);
      $result = $stockPhase->save();
    }

    if ($result == true) :
      exit(json_encode(['success' => true, 'msg' => 'Phase two records successfully saved!']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($dataSheet->errors)]));
    endif;
  }

  if (isset($_POST['edit_factory_form'])) {
    $args = $_POST;

    $stockPhase = StockPhaseTwo::find_by_category_id($args['catId']);

    for ($i = 0; $i < count($stockPhase); $i++) {
      $editStock = StockPhaseTwo::find_by_id($stockPhase[$i]->id);

      $data = [
        'product_id'        => $args['product_id'][$i],
        'category_id'       => $args['category_id'][$i],
        'gauge_id'          => $args['gauge_id'][$i],
        'open_stock'        => $args['open_stock'][$i],
        'production'        => $args['production'][$i],
        'transfer'          => $args['transfer'][$i],
        'total_production'  => $args['total_stock'][$i],
        'sales'             => $args['sales'][$i],
        'closing_stock'     => $args['closing_stock'][$i],
        'company_id'        => $args['company_id'],
        'branch_id'         => $args['branch_id'],
        'remarks'           => $args['remarks'],
        "created_by"        => $loggedInAdmin->id,
        'updated_at'        => date('Y-m-d H:i:s'),
      ];

      $editStock->merge_attributes($data);
      $editStock->save();
    }
    exit(json_encode(['success' => true, 'msg' => 'Stock updated successfully!']));
  }

  if (isset($_POST['delete_stock'])) {
    $stockId = $_POST['stockId'];
    $stocks = StockPhaseTwo::find_by_category_id($stockId);

    foreach ($stocks as  $value) {
      $stock = StockPhaseTwo::find_by_id($value->id);
      $stock::deleted($value->id);
    }

    if ($stock == true) :
      exit(json_encode(['success' => true, 'msg' => 'Stock record deleted successfully!']));
    endif;
  }
}


if (is_get_request()) {

  if (isset($_GET['filter'])) :

    $branch = isset($_GET['branch']) && $_GET['branch'] != '' ? $_GET['branch'] : '1';

    $rangeText = $_GET['rangeText'];
    $explode = explode('-', $rangeText);
    $dateFrom = $explode[0];
    $dateTo = $explode[1] ?? '';
    $convertFrom = date('Y-m-d', strtotime($dateFrom));
    $convertTo = date('Y-m-d', strtotime($dateTo));

    $groupByCategory = StockPhaseTwo::group_by_category($convertFrom, $convertTo, $branch);
    $fullGroup = StockPhaseTwo::group_by_product($convertFrom, $convertTo, $branch);

?>
    <style>
      tr {
        text-align: end;
      }

      th {
        vertical-align: middle !important;
      }

      .text-format {
        min-width: 140px !important;
        text-align: start;
        font-size: 12px;
      }
    </style>

    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr class="text-center">
          <th rowspan="2">
            <h5 class="text-secondary">PHASE TWO</h5>
            <?php echo $dateFrom . ' - ' . $dateTo ?>
          </th>
          <?php foreach ($groupByCategory as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
          ?>
            <th colspan="6" style="font-size:18px">
              <?php echo strtoupper($categoryName) ?><br>

              <div class="btn-group">
                <a href="<?php echo url_for('sales/edit_phase_two.php?category_id=' . $data->category_id) ?>" class="btn btn-sm btn-warning"><i class="icon-edit"></i></a>
                <button data-id="<?php echo $data->category_id ?>" class="btn btn-sm btn-secondary remove-btn"><i class="icon-delete"></i></button>
              </div>
            </th>
          <?php endforeach; ?>
        </tr>
        <tr class="text-center border">
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $productName = Product::find_by_id($data->product_id)->name;
          ?>
            <th style="font-size: 12px;font-weight:bold">
              <?php echo strtoupper($productName) ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Opening Stock</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
          ?>
            <td>
              <?php echo number_format($data->open_stock, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">New Stock</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
          ?>
            <td>
              <?php echo number_format($data->production, 2); ?></td>
          <?php endforeach; ?>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Transfer</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
          ?>
            <td>
              <?php echo number_format($data->transfer, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Total Stock</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
          ?>
            <td style="font-weight:bold">
              <?php echo number_format($data->total_production, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Sales</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
          ?>
            <td>
              <?php echo number_format($data->sales, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Closing Stock</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
          ?>
            <td style="font-weight:bold">
              <?php echo number_format($data->closing_stock, 2); ?></td>
          <?php endforeach; ?>
        </tr>
      </tbody>
    </table>

<?php
  endif;
}
