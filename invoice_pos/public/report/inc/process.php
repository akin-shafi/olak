<?php require_once('../../../private/initialize.php');



if (is_get_request()) {

  if (isset($_GET['filter'])) :

    $branch = isset($_GET['branch']) && $_GET['branch'] != '' ? $_GET['branch'] : "";
    // $branch =  $_GET['branch'];

    $rangeText = $_GET['rangeText'];
    
    $explode = explode('- ', $rangeText);
    $dateFrom = $rangeText;
    $dateTo = $rangeText;
    // $dateConvertFrom = date('Y-m-d', strtotime($dateFrom));
    // $dateConvertTo = date('Y-m-d', strtotime($dateTo));

    // pre_r($dateConvertTo);

    $expenses = Expense::find_by_expenses($dateFrom, $dateTo, ['company' => $loggedInAdmin->company_id, 'branch' => $branch]);
    // pre_r($expenses);
    $totalExpenses = Expense::get_total_expenses($dateFrom, $dateTo, ['company' => $loggedInAdmin->company_id, 'branch' => $branch])->total_amount;

    // $filterDate = $dateFrom != date('Y-m-d') ? $rangeText : date('d-m-Y');
    $filterDate = $rangeText;
    $access = AccessControl::find_by_user_id($loggedInAdmin->id);



    $confirmed = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'from' => $dateFrom, 'to' => $dateTo, 'branch_id' => $branch, ]) ?? 0; 
    $unconfirmed = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'from' => $dateFrom, 'to' => $dateTo, 'branch_id' => $branch,]) ?? 0; 

    $unconfirmed_cash = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 2, 'from' => $dateFrom, 'to' => $dateTo, 'branch_id' => $branch,]) ?? 0;
    $unconfirmed_transfer = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 3, 'from' => $dateFrom, 'to' => $dateTo, 'branch_id' => $branch,]) ?? 0;
    $unconfirmed_pos = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 4, 'from' => $dateFrom, 'to' => $dateTo, 'branch_id' => $branch,]) ?? 0;

    $confirmed_cash = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 2, 'from' => $dateFrom, 'to' => $dateTo, 'branch_id' => $branch,]) ?? 0;
    $confirmed_transfer = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 3, 'from' => $dateFrom, 'to' => $dateTo, 'branch_id' => $branch,]) ?? 0;
    $confirmed_pos = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 4, 'from' => $dateFrom, 'to' => $dateTo, 'branch_id' => $branch,]) ?? 0; 

    $totalSales = Invoice::get_total_sales( ['company' => $loggedInAdmin->company_id, 'branch' => $branch,  'from' => $dateFrom, 'to' => $dateTo, ]);

    // $data



?>
    
    
    <div class="card">
      <div class="card-body border-top">
          <div class="row  justify-content-center">
              <div class="col-xl-6 col-lg-6 col-md-6 col-12 border-right">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                  <div class="daily-sales" style="position: relative;">
                    <h3 class="text-danger">Unconfirmed</h3>
                    <h1><?php echo $currency . " ". number_format($unconfirmed, 2) ?></h1>
                    <div class="row">
                      <div class="col-md-4 col-12 border">Cash: <?php echo number_format($unconfirmed_cash, 2) ?></div>
                      <div class="col-md-4 col-12 border">Transfer: <?php echo number_format($unconfirmed_transfer, 2); ?></div>
                      <div class="col-md-4 col-12 border">POS: <?php echo number_format($unconfirmed_pos, 2); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
              <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                  <div class="daily-sales" style="position: relative;">
                    <h3 class="text-primary">Confirmed</h3>
                    <h1><?php echo $currency . " ". number_format($confirmed, 2) ?></h1>
                    <div class="row">
                      <div class="col-md-4 col-12 border">Cash: <?php echo number_format($confirmed_cash, 2) ?></div>
                      <div class="col-md-4 col-12 border">Transfer: <?php echo number_format($confirmed_transfer, 2); ?></div>
                      <div class="col-md-4 col-12 border">POS: <?php echo number_format($confirmed_pos, 2); ?></div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          
      </div>
    </div>

    <div class="card">
      <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h3>Summary Report (<?php echo $filterDate ?>)</h3>
        <!-- <h3>Total: <span class="text-danger">₦ 5,848,750</span></h3> -->
      </div>
        <table class="table">
          <thead>
              <tr class="bg-primary text-white ">
                  <th>S/N</th>
                  <th>Branch</th>
                  <th>Cash (Manual)</th>
                  <th>Cash (System)</th>
                  <th>Sum of Backlog</th>
                  <th>Transfer</th>
                  <th>POS</th>
                  <th>Confirmed Trans</th>
                  <th>Unconfirmed Trans</th>
                  <th>Expenses</th>
                  <th>Refund</th>
                  <th>Action</th>
              </tr>
          </thead>

          <tbody>
              <?php 
              $sn = 1; 
              foreach (Branch::find_by_undeleted(['order' => 'ASC']) as $row) {
                  $summary_report = SummaryReport::find_by_date(['report_date' => $dateTo, 'branch_id' => $row->id]);
                  $manualCash = !empty($summary_report) ? number_format($summary_report->cash_sales, 2) : "No Record";
                  $expensesReport = !empty($summary_report) ? number_format($summary_report->expenses, 2) : "No Record";
                  $refund = !empty($summary_report) ? number_format($summary_report->sum_of_refund, 2) : "No Record";
                  $sum_of_backlog = !empty($summary_report) ? number_format($summary_report->sum_of_backlog, 2) : "No Record";
                  
                  $systemCash = WalletFundingMethod::find_transaction([
                      'branch_id' => $row->id, 'payment_method' => 2, 'from' => $dateTo
                  ]) ?? 0;
                  $transfer = WalletFundingMethod::find_transaction([
                      'branch_id' => $row->id, 'payment_method' => 3, 'from' => $dateTo
                  ]) ?? 0;
                  $pos = WalletFundingMethod::find_transaction([
                      'branch_id' => $row->id, 'payment_method' => 4, 'from' => $dateTo
                  ]) ?? 0;

                  $confirmed = WalletFundingMethod::sum_of_approved(['approval' => 1, 'from' => $dateTo, 'to' => $dateTo, 'branch_id' => $row->id, ]) ?? 0; 
                  $unconfirmed = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'from' => $dateTo, 'to' => $dateTo, 'branch_id' => $row->id,]) ?? 0; 
                  
                  $formattedCashSales = number_format($systemCash, 2);
                  $checker = '';
                  if ($manualCash != "No Record") {
                      if ($manualCash != $formattedCashSales) {
                          $checker = "bg-danger font-weight-bold";
                      } else {
                          $checker = 'bg-success font-weight-bold';
                      }
                  }

                  $alert = $sum_of_backlog != 0 ? $alert = "bg-warning font-weight-bold" : '';
                        
                  $id = !empty($summary_report) ? $summary_report->id : '0';
              ?>
              <tr>
                  <td><?php echo $sn++; ?></td>
                  <td><?php echo $row->branch_name; ?></td>
                  <td class="<?php echo $checker; ?>"><?php echo $manualCash; ?></td>
                  <td class="<?php echo $checker; ?>"><?php echo $formattedCashSales; ?></td>
                  <td class="<?php echo $alert; ?>"><?php echo $sum_of_backlog; ?></td>
                  <td><?php echo number_format($transfer, 2); ?></td>
                  <td><?php echo number_format($pos, 2); ?></td>
                  <td><?php echo number_format($confirmed, 2); ?></td>
                  <td><?php echo number_format($unconfirmed, 2); ?></td>
                  <td><?php echo $expensesReport; ?></td>
                  <td><?php echo $refund; ?></td>
                  <td>
                      <?php 
                      if (!empty($summary_report)) {
                          echo "<button class='bnt btn-sm btn-primary oneItem' data-id='". $id ."'>Edit</button>";
                      } 
                      ?>
                  </td>
              </tr>
              <tr>
                  <?php 
                  if (!empty($summary_report)) {
                      echo '<td colspan="11" class="text-center"> <strong>Complains: </strong> ' . $summary_report->complains . '</td>';
                  } else {
                      echo '<td></td>';
                  }
                  ?>
              </tr>
              <?php } ?>
          </tbody>
      </table>
      </div>
    </div>
    <div class="row mt-3" >
      <div class="col-md-12 col-12">
          <div class="card">
              <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <h3>Sales Report (<?php echo $filterDate ?>)</h3>
                    <h3>Total: <span class="text-danger"><?php echo $currency . ' ' . number_format($totalSales) ?></span></h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="bg-primary text-white ">
                          <th>S/N</th>
                          <th>Product Name</th>
                          <th>Quantity Sold</th>
                          <th>Stock Value</th>
                          <th>Total</th>
                          
                        </tr>
                      </thead>

                      <tbody>
                          <?php 


                            if (in_array($loggedInAdmin->admin_level, [1,2])) {
                              $product = Product::find_by_undeleted();
                            }else{
                              $product = Product::find_by_branch_id(['branch_id' => $branch]);
                            }
                            
                            

                            $sn = 1; 

                            foreach ($product as $key => $value): 

                            $sales = Invoice::find_all_by_service_type(['service_type' => $value->id,'from'=>  $dateFrom, 'to'=>  $dateTo, 'branch_id' => $branch]);

                            // pre_r($sales);
                            $stock = StockDetails::sum_of_Stock(['item_id' => $value->id, 'from' => $dateFrom]) ?? 0;

                            $qty = isset($sales->sum_of_quantity) ? intval($sales->sum_of_quantity) :  0; 
                            $grand_total = isset($sales->grand_total) ? intval($sales->grand_total) :  0; 

                            $price = intval($value->price) ?? 0;
                            // $subtotal = ($qty *  $price);
                            $left_over = intval($stock - $qty);

                          ?>
                          <?php 
                          
                          if ($qty != 0) { ?>
                          <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php  echo $value->pname;?></td>
                            <td><?php  echo $qty;?></td>

                            <td><?php echo $left_over;?></td>
                            <td><?php echo number_format($grand_total, 2);?></td>
                          </tr>
                          <?php } ?>
                          <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h3>Incurred Expenses (<?php echo $filterDate ?>)</h3>
                <h3>Total: <span class="text-danger"><?php echo $currency . ' ' . number_format($totalExpenses) ?></span></h3>
              </div>
                <div class="table-responsive">
                  <table class="table custom-table table-sm dataTable">
                    <thead>
                      <tr class="bg-primary text-white ">
                        <th>SN</th>
                        <th>Title</th>
                        <th>Quantity</th>
                        <th>Amount (<?php echo $currency ?>)</th>
                        <th>Narration</th>
                        <th>Created At</th>
                        
                      </tr>
                    </thead>

                    <tbody>
                      <?php $sn = 1;
                      foreach ($expenses as $item) : ?>
                        <tr>
                          <td><?php echo $sn++; ?></td>
                          <td><?php echo ucwords($item->title); ?></td>
                          <td class="text-right"><?php echo $item->quantity; ?></td>
                          <td class="text-right"><?php echo number_format($item->amount); ?></td>
                          <td><?php echo ucfirst($item->narration); ?></td>
                          <td><?php echo date('D, j M, Y', strtotime($item->created_at)); ?></td>

                          

                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
      </div>
    </div>

<?php
  endif;
}
