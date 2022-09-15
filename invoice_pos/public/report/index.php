<?php 

require_once('../../private/initialize.php');
$page = "Report";
$page_title = 'Report'; 

$from = date("Y-m-01");
$to = date("Y-m-d");

$confirmed = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'from' => $from, 'to' => $to, ]) ?? 0; 
$unconfirmed = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'from' => $from, 'to' => $to,]) ?? 0; 

$unconfirmed_cash = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 2, 'from' => $from, 'to' => $to,]) ?? 0;
$unconfirmed_transfer = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 3, 'from' => $from, 'to' => $to,]) ?? 0;
$unconfirmed_pos = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'payment_method' => 4, 'from' => $from, 'to' => $to,]) ?? 0;

$confirmed_cash = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 2, 'from' => $from, 'to' => $to,]) ?? 0;
$confirmed_transfer = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 3, 'from' => $from, 'to' => $to,]) ?? 0;
$confirmed_pos = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'payment_method' => 4, 'from' => $from, 'to' => $to,]) ?? 0; 
?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>


<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">

          
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->
<div class="content-wrapper">
    <div class="row  justify-content-center">
        <div class="col-6 border">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
            <div class="daily-sales" style="position: relative;">
              <h6>Unconfirmed</h6>
              <h1><?php echo $currency . " ". number_format($unconfirmed, 2) ?></h1>
              <div class="row">
                <div class="col-4 border">Cash: <?php echo number_format($unconfirmed_cash, 2) ?></div>
                <div class="col-4 border">Transfer: <?php echo number_format($unconfirmed_transfer, 2); ?></div>
                <div class="col-4 border">POS: <?php echo number_format($unconfirmed_pos, 2); ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 border">
        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
            <div class="daily-sales" style="position: relative;">
              <h6>Confirmed</h6>
              <h1><?php echo $currency . " ". number_format($confirmed, 2) ?></h1>
              <div class="row">
                <div class="col-4 border">Cash: <?php echo number_format($confirmed_cash, 2) ?></div>
                <div class="col-4 border">Transfer: <?php echo number_format($confirmed_transfer, 2); ?></div>
                <div class="col-4 border">POS: <?php echo number_format($confirmed_pos, 2); ?></div>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="h4">Sales Report from (<?php echo date('D d M, Y', strtotime($from)) ?>) to (<?php echo date('D d M, Y', strtotime($to)) ?>) </div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Product Name</th>
            <th>Quantity Sold</th>
            <th>Stock Value</th>
            <th>Total</th>
            
          </tr>
        </thead>

        <tbody>
            <?php 
              $product = Product::find_by_branch_id($loggedInAdmin->branch_id);
              $sn = 1; foreach ($product as $key => $value): 
              // pre_r($value);
              
              $sales = Invoice::find_all_by_service_type(['service_type' => $value->id,'from'=>  $from, 'to'=>  $to]);
              $stock = StockDetails::sum_of_Stock(['item_id' => $value->id, 'from' => $from]) ?? 0;
              $qty = intval($sales) ?? 0;
              $price = intval($value->price) ?? 0;
              $subtotal = ($qty *  $price);
              $left_over = intval($stock - $qty);
              // $grand_total = $sales->grand_total ?? 0;
              // pre_r ($sales);

            ?>
            <?php if ($qty != 0) { ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php  echo $value->pname;?></td>
              <td><?php  echo $qty;?></td>

              <td><?php echo $left_over;?></td>
              <td><?php echo $subtotal;?></td>
            </tr>
            <?php } ?>
            <?php endforeach; ?>
        </tbody>
      </table>
    </div>
</div>


</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>