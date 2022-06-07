<?php require_once('../../private/initialize.php');

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

    $dataSheet = DataSheet::filter_by_date($dateConvertFrom, $dateConvertTo, ['company' => $companyId, 'branch' => $branch]);

    // $totalExpenses = Expense::get_total_expenses($dateConvertFrom, $dateConvertTo, ['company' => $loggedInAdmin->company_id, 'branch' => $branch])->total_amount;
    $filterDate = $dateConvertFrom != date('Y-m-d') ? $rangeText : date('d-m-Y');
?>
    <div class="d-flex justify-content-between align-items-center">
      <h3>Date: (<?php echo $filterDate ?>)</h3>
      <!-- <h3>Total: <span class="text-danger"><?php echo $currency . ' ' . number_format($totalSales) ?></span></h3> -->
    </div>

    <table id="dataSheet" class="table custom-table dataTable" id="basicExample">
      <thead>
        <tr class="bg-primary text-white text-center">
          <th>PRODUCT NAME</th>
          <th>CREATED AT</th>

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
        </tr>
      </thead>

      <tbody>
        <?php foreach ($dataSheet as $data) :
          $dataId = isset($data->id) ? $data->id : '';

          // *** DIP BY MANAGER ***
          $openStock = isset($data->open_stock)   ? $data->open_stock : 0;
          $newStock = isset($data->new_stock)     ? $data->new_stock : 0;
          $totalStock = isset($data->open_stock)  ? $data->total_stock : 0;

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
            <td style="min-width: 220px;">
              <?php echo strtoupper($data->name) . ' (T' . $data->tank . ')'; ?>
            </td>
            <td><?php echo isset($data->created_at) ? date('Y-m-d', strtotime($data->created_at)) : date('Y-m-d'); ?></td>

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

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <script>
      $('.dataTable').DataTable({
        'iDisplayLength': 10,
        dom: 'Bfrtip',
        buttons: [
          // 'copyHtml5',
          'excelHtml5',
          'csvHtml5',
          // 'pdfHtml5',
          'print'
        ],
        "language": {
          "lengthMenu": "Display _MENU_ Records Per Page",
          "info": "Showing Page _PAGE_ of _PAGES_",
        }
      });
    </script>
<?php endif;
}
