<?php require_once('../../../private/initialize.php');



if (is_get_request()) {
  



  if (isset($_GET['filter'])) :

    $branch = isset($_GET['branch']) && $_GET['branch'] != '' ? $_GET['branch'] : "";
    // $branch =  $_GET['branch'];

    $rangeText = $_GET['rangeText'];
    
    $explode = explode('- ', $rangeText);
    $dateFrom = $explode[0];
    $dateTo = $explode[1];
    $dateConvertFrom = date('Y-m-d', strtotime($dateFrom));
    $dateConvertTo = date('Y-m-d', strtotime($dateTo));

    // pre_r($dateConvertTo);

    $expenses = Expense::find_by_expenses($dateConvertFrom, $dateConvertTo, ['company' => $loggedInAdmin->company_id, 'branch' => $branch]);
    $totalExpenses = Expense::get_total_expenses($dateConvertFrom, $dateConvertTo, ['company' => $loggedInAdmin->company_id, 'branch' => $branch])->total_amount;

    $filterDate = $dateConvertFrom != date('Y-m-d') ? $rangeText : date('d-m-Y');
    $access = AccessControl::find_by_user_id($loggedInAdmin->id);



    $confirmed = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'from' => $dateConvertFrom, 'to' => $dateConvertTo, 'branch_id' => $branch, ]) ?? 0; 
    $unconfirmed = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'from' => $dateConvertFrom, 'to' => $dateConvertTo, 'branch_id' => $branch,]) ?? 0; 

    $unconfirmed_cash = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 2, 'from' => $dateConvertFrom, 'to' => $dateConvertTo, 'branch_id' => $branch,]) ?? 0;
    $unconfirmed_transfer = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 3, 'from' => $dateConvertFrom, 'to' => $dateConvertTo, 'branch_id' => $branch,]) ?? 0;
    $unconfirmed_pos = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 4, 'from' => $dateConvertFrom, 'to' => $dateConvertTo, 'branch_id' => $branch,]) ?? 0;

    $confirmed_cash = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 2, 'from' => $dateConvertFrom, 'to' => $dateConvertTo, 'branch_id' => $branch,]) ?? 0;
    $confirmed_transfer = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 3, 'from' => $dateConvertFrom, 'to' => $dateConvertTo, 'branch_id' => $branch,]) ?? 0;
    $confirmed_pos = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 4, 'from' => $dateConvertFrom, 'to' => $dateConvertTo, 'branch_id' => $branch,]) ?? 0; 

    $totalSales = Invoice::get_total_sales( ['company' => $loggedInAdmin->company_id, 'branch' => $branch,  'from' => $dateConvertFrom, 'to' => $dateConvertTo, ]);




?>
    
    
    <div class="card">
      <div class="card-body border-top">
          <div class="row  justify-content-center">
              <div class="col-xl-6 col-lg-6 col-md-6 col-12 border-right">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                  <div class="daily-sales" style="position: relative;">
                    <h3 class="text-primary">Unconfirmed</h3>
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
                    <h3 class="text-danger">Confirmed</h3>
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

                            $sales = Invoice::find_all_by_service_type(['service_type' => $value->id,'from'=>  $dateConvertFrom, 'to'=>  $dateConvertTo, 'branch_id' => $branch]);

                            // pre_r($sales);
                            $stock = StockDetails::sum_of_Stock(['item_id' => $value->id, 'from' => $dateConvertFrom]) ?? 0;

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
                      foreach ($expenses as $data) : ?>
                        <tr>
                          <td><?php echo $sn++; ?></td>
                          <td><?php echo ucwords($data->title); ?></td>
                          <td class="text-right"><?php echo $data->quantity; ?></td>
                          <td class="text-right"><?php echo number_format($data->amount); ?></td>
                          <td><?php echo ucfirst($data->narration); ?></td>
                          <td><?php echo date('D, j M, Y', strtotime($data->created_at)); ?></td>

                          

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
