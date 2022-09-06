<?php require_once('../../private/initialize.php');

if (is_post_request()) {

  if (isset($_POST['material_form'])) {
    $args = $_POST;

    for ($i = 0; $i < count($args['open_stock']); $i++) {
      $data = [
        'type'            => $args['type'],
        'raw_group_id'    => $args['raw_group_id'][$i],
        'raw_category_id' => $args['raw_category_id'][$i],
        'open_stock'      => $args['open_stock'][$i],
        'inflow'          => $args['inflow'][$i],
        'total_stock'     => $args['total_stock'][$i],
        'outflow'         => $args['outflow'][$i],
        'closing_stock'   => $args['closing_stock'][$i],
        'company_id'      => $args['company_id'],
        'branch_id'       => $args['branch_id'],
        'remarks'         => $args['remarks'],
        "created_by"      => $loggedInAdmin->id,
      ];

      $materialPhase = new MaterialPhaseOne($data);
      $result = $materialPhase->save();
    }
    exit();

    if ($result == true) :
      exit(json_encode(['success' => true, 'msg' => 'Raw material created successfully!']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($materialPhase->errors)]));
    endif;
  }

  if (isset($_POST['edit_material_form'])) {
    $mat = $_POST['mat'];

    $editStock = MaterialPhaseOne::find_by_id($mat['material_id']);

    $args = [
      'type'            => $mat['type'],
      'raw_group_id'    => $mat['raw_group_id'],
      'raw_category_id' => $mat['raw_category_id'],
      'open_stock'      => $mat['open_stock'],
      'inflow'          => $mat['inflow'],
      'total_stock'     => $mat['total_stock'],
      'outflow'         => $mat['outflow'],
      'closing_stock'   => $mat['closing_stock'],
      'company_id'      => $mat['company_id'],
      'branch_id'       => $mat['branch_id'],
      'remarks'         => $mat['remarks'],
      "created_by"      => $loggedInAdmin->id,
      'updated_at'      => date('Y-m-d H:i:s'),
    ];

    $editStock->merge_attributes($args);
    $editStock->save();

    exit(json_encode(['success' => true, 'msg' => 'Stock updated successfully!']));
  }

  if (isset($_POST['delete_stock'])) {
    $stockId = $_POST['stockId'];
    $stock = MaterialPhaseOne::find_by_id($stockId);
    $stock::deleted($stockId);

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

    $groupByCategory = MaterialPhaseOne::group_by_category($convertFrom, $convertTo, $branch);
    $fullGroup = MaterialPhaseOne::group_by_product($convertFrom, $convertTo, $branch);
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
            <h5 class="text-secondary">PHASE ONE</h5>
            <?php echo $dateFrom . ' - ' . $dateTo ?>
          </th>
          <?php foreach ($groupByCategory as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $color = str_merger($categoryName) ?? $categoryName;
          ?>
            <th colspan="6" style="border:1px solid <?php echo $color ?>; font-size:18px">
              <?php echo strtoupper($categoryName) ?><br>

              <div class="btn-group">
                <a href="<?php echo url_for('sales/edit_phase_one.php?category_id=' . $data->category_id) ?>" class="btn btn-sm btn-warning"><i class="icon-edit"></i></a>
                <button data-id="<?php echo $data->category_id ?>" class="btn btn-sm btn-secondary remove-btn"><i class="icon-delete"></i></button>
              </div>
            </th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Opening Stock</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $color = str_merger($categoryName) ?? $categoryName;
          ?>
            <td style="border:1px solid <?php echo $color ?>;">
              <?php echo number_format($data->open_stock, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">New Stock</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $color = str_merger($categoryName) ?? $categoryName;
          ?>
            <td style="border:1px solid <?php echo $color ?>;">
              <?php echo number_format($data->production, 2); ?></td>
          <?php endforeach; ?>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Return Inward</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $color = str_merger($categoryName) ?? $categoryName;
          ?>
            <td style="border:1px solid <?php echo $color ?>;">
              <?php echo number_format($data->return_inward, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Total Stock</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $color = str_merger($categoryName) ?? $categoryName;
          ?>
            <td style="border:1px solid <?php echo $color ?>;font-weight:bold">
              <?php echo number_format($data->total_production, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Sales</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $color = str_merger($categoryName) ?? $categoryName;
          ?>
            <td style="border:1px solid <?php echo $color ?>;">
              <?php echo number_format($data->sales, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Imported</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $color = str_merger($categoryName) ?? $categoryName;
          ?>
            <td style="border:1px solid <?php echo $color ?>;">
              <?php echo number_format($data->imported, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Local</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $color = str_merger($categoryName) ?? $categoryName;
          ?>
            <td style="border:1px solid <?php echo $color ?>;">
              <?php echo number_format($data->local, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Total Sales</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $color = str_merger($categoryName) ?? $categoryName;
          ?>
            <td style="border:1px solid <?php echo $color ?>;font-weight:bold">
              <?php echo number_format($data->total_sales, 2); ?></td>
          <?php endforeach; ?>
        </tr>
        <tr>
          <td class="font-weight-bold text-uppercase text-format">Closing Stock</td>
          <?php foreach ($fullGroup as $data) :
            $categoryName = strtolower(Category::find_by_id($data->category_id)->name);
            $color = str_merger($categoryName) ?? $categoryName;
          ?>
            <td style="border:1px solid <?php echo $color ?>;font-weight:bold">
              <?php echo number_format($data->closing_stock, 2); ?></td>
          <?php endforeach; ?>
        </tr>
      </tbody>
    </table>

<?php
  endif;
}
