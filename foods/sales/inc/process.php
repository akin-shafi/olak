<?php require_once('../../private/initialize.php');

if (is_get_request()) {
  if (isset($_GET['filter'])) :

    $branch = isset($_GET['branch']) && $_GET['branch'] != '' ? $_GET['branch'] : $loggedInAdmin->branch_id;

    $rangeText = $_GET['rangeText'];
    $explode = explode('-', $rangeText);
    $dateFrom = $explode[0];
    $dateTo = $explode[1];
    $dateConvertFrom = date('Y-m-d', strtotime($dateFrom));
    $dateConvertTo = date('Y-m-d', strtotime($dateTo));
    $admComp = $loggedInAdmin->company_id;

    $cashFlows = CashFlow::find_by_cash_flow($dateConvertFrom, $dateConvertTo, ['company' => $admComp, 'branch' => $branch]);
?>

    <div class="table-responsive">
      <div class="d-flex justify-content-end mb-2">
        <a href="<?php echo url_for('/sales/new.php') ?>" class="btn float-end btn-primary <?php //echo !empty($cashFlows) ? 'disabled' : '' ?>" style="cursor: pointer">
          Add Sales
        </a>
      </div>
      <table id="dataSheet" class="table custom-table">
        <thead>
          <tr class="bg-primary text-white text-center">
            <th>SN</th>
            <th>Cash</th>
            <th>Credit</th>
            <th>POS</th>
            <th>Transfer</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php $sn = 1;
          foreach ($cashFlows as $key => $value) : ?>
            <tr class=" text-center">
              <td><?php echo $sn++; ?></td>
              <td><?php echo $value->cash_sales ?></td>
              <td><?php echo $value->credit_sales ?></td>
              <td><?php echo $value->pos ?></td>
              <td><?php echo $value->transfer ?></td>
              <td>
                <div class="btn-group">
                  <a href="<?php echo url_for('sales/show.php?id=' . $value->id) ?>" class="btn btn-info">View</a>
                  <a href="<?php echo url_for('sales/edit.php?id=' . $value->id) ?>" class="btn btn-primary">Edit</a>
                </div>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>

<?php endif;
}
