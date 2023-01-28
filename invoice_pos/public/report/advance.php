<?php 

require_once('../../private/initialize.php');
$page = "Report";
$page_title = 'Report'; 

$from = date("Y-m-01");
$to = date("Y-m-d");

$branch_id = $loggedInAdmin->branch_id;


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
<div class="table-responsive">
          <table id="rowSelection" class="table table-sm table-striped " >
          <thead>
            <tr role="row">
              <th>S/N</th>
              <th>Customer Name</th>
              <th>Wallet Balance</th>
              <th>Delivered</th>
              <th>Not yet Delivered</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="show_data">
            <?php $sn = 1;
              foreach (Client::find_by_undeleted(['limit' => 10]) as $value) : 
                $customer_name = $value->full_name();
                $balance = intval($value->balance);
                $sum =  WalletFundingMethod::sum_of_unapproved(['customer_id' => $value->customer_id, 'approval' => 0]);

                // $cId = Client::find_by_id($value->id);
                $walletDetails = WalletFundingMethod::find_by_customer_id($value->customer_id);
                $transactions = Billing::find_by_client_id($value->id);
                // $totalDeposit = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'customer_id' => $value->customer_id ]) ?? 0;
                $totalDelivered = Billing::sum_of_sales(['client_id' => $value->id, 'status' => 2]);
                $totalUndelivered = Billing::sum_of_sales(['client_id' => $value->id, 'status' => 1]);
              ?>
                <tr>
                  <td><?php echo $sn++ ?></td>
                  <td>
                    <a href="<?php echo url_for('client/show.php?id='. $value->id) ?>" class="d-flex align-items-center">
                      <h6 class="mb-0 fs-14"><?php echo ucwords($customer_name) ?></h6>
                    </a>
                  </td>
                 
                  <td class="green"><?php echo number_format($balance, 2) ?> </td>
                  
                  <td><?php echo number_format($totalDelivered, 2) ?> </td>
                  <td><?php echo number_format($totalUndelivered, 2) ?> </td>
                

                  <td>
                   
                  </td>

                </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
    </div>
</div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>