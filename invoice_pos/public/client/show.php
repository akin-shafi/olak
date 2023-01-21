<?php

require_once('../../private/initialize.php');

// require_login();

$id = $_GET['id'];
$clients = Client::find_by_id($id);
$walletBalance = intval($clients->balance);
$walletDetails = WalletFundingMethod::find_by_customer_id($clients->customer_id);
$transactions = Billing::find_by_client_id($id);
$totalDeposit = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'customer_id' => $clients->customer_id ]) ?? 0;
$totalDelivered = Billing::sum_of_sales(['client_id' => $id, 'status' => 2]);
$totalUndelivered = Billing::sum_of_sales(['client_id' => $id, 'status' => 1]);
// pre_r($clients);
?>
<?php $page_title = 'Admins'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div class="main-container">


  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title">Client Profile</h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">

          <a href="<?php echo url_for('client/index.php') ?>" data-toggle="tooltip" data-placement="top" title="view all Customers" class="download-reports" data-original-title="iew all Customers">
            <i class="feather-arrow-left"></i>
          </a>
        </div>
      </div>
    </div>
  </div>


  <div class="content-wrapper">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 border">
            <div class="profile-view">
              <div class="profile-img-wrap border">
                <div class="profile-img">
                  <a href="">
                    <img src="<?php echo url_for('/img/user1.png') ?>" alt="">
                  </a>
                </div>
              </div>
              <div class="profile-basic border">
                <div class="row">
                  <div class="col-md-5 col-sm-12 col-12">
                    <div class="profile-info-left">
                      <h3 class="user-name m-t-0"><?php echo $clients->full_name() ?? "Not Set" ?></h3>
                      <h5 class="company-role m-t-0 mb-0">Customer ID: <?php echo $clients->customer_id; ?></h5>
                      <div class="staff-id"><i>Registered By : <?php echo Admin::find_by_id($clients->created_by)->full_name(); ?></i></div>
                      <div class="staff-msg">
                          <a href="<?php echo url_for('wallet/add.php?id=' . $clients->customer_id) ?>" class="btn btn-sm btn-primary "> <i class="feather-plus text-success"></i> Load wallet</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7 col-sm-12 col-12">
                    <ul class="personal-info">
                      <li>
                        <span class="title">Phone:</span>
                        <span class="text"><a href=""><?php echo $clients->phone; ?></a></span>
                      </li>
                      <li>
                        <span class="title">Email:</span>
                        <span class="text"><a href=""><?php echo $clients->email; ?></a></span>
                      </li>
                      <li>
                        <span class="title">Wallet Balance:</span>
                        <span class="text"><a href=""><?php echo number_format($walletBalance, 2) ?></a></span>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <h3>Deposit History</h3>
    <div class="table-responsive">
      <div class="d-flex justify-content-end">
        <!-- <h3>Sum of Deposit </h3> -->
        <h3>Total Deposit: <span class="text-danger"><?php echo $currency . ' ' . number_format($totalDeposit) ?></span></h3>
      </div>
      <table class="table table-bordered" id="rowSelection">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Payment ID</th>
            <th>Payment Method</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Post By</th>
            <th>Branch </th>
            <th>Bank Name</th>
            <th>Account No.</th>
            <th>Created At</th>
            
          </tr>
        </thead>
        <tbody>
          <?php $sn = 1;
          foreach ($walletDetails as $value) {
            $bankName = Bank::find_by_id($value->bank_name)->bank_name ?? "Not Set";
            $account_no = Bank::find_by_id($value->bank_name)->account_number ?? "Not Set";
            $createdBy = Admin::find_by_id($value->created_by)->full_name();
            $branch_id = Admin::find_by_id($value->created_by)->branch_id;
            $branch = Branch::find_by_id($branch_id)->branch_name;
          ?>
           
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><a href="<?php echo url_for('wallet/pop.php?payment_id=' . h(u($value->payment_id))); ?>"><?php echo h(ucwords($value->payment_id)); ?></a></td>
              <td><?php echo Billing::PAYMENT_METHOD[$value->payment_method]; ?></td>
              <td><?php echo number_format(floatval($value->amount)); ?></td>
              <td>
                <?php  echo $value->approval == 0 ? "Unapproved" : "Approved"; ?>
                <?php  echo $value->deleted == 1 ? " and Deleted" : ""; ?>

              </td>
              <td><?php echo $createdBy; ?></td>
              <td><?php echo $branch; ?></td>
              <td><?php echo ucwords($bankName); ?></td>
              <td><?php echo $account_no; ?></td>
              <td><?php echo date('dS M, Y H:i:s', strtotime($value->created_at)); ?></td>
              <!-- <td><a href="record.php"><i class="feather-settings bold"> History</i></a></td> -->
            </tr>
          <?php } ?>
        </tbody>
      </table>
      
    </div>

    <h3>Transaction History</h3>
    <div class="table-responsive">
      <table class="table table-bordered" id="rowSelection">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Status</th>
            <th>Invoice No.</th>
            <th>Created By</th>
            <th>Branch</th>
            <th>Created Date</th>
            <th>Total Amount</th>
          </tr>
        </thead>
        <tbody>
          <?php $sn = 1;
          foreach ($transactions as $value) {
            $branch = Branch::find_by_id($value->branch_id);
            $createdBy = Admin::find_by_id($value->created_by)->full_name();
          ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <td>
                <?php echo h(Billing::STATUS[$value->status]); ?>
              </td>
              <td><a href="<?php echo url_for('invoice/invoice.php?invoice_no=' . h(u($value->invoiceNum))); ?>"><?php echo h(ucwords($value->invoiceNum)); ?></a></td>
              <td><?php echo $createdBy ?></td>
              <td><?php echo h(ucwords(substr($branch->branch_name, 0, 30))); ?></td>
              <td><?php echo h(date('D jS M, Y H:i:s', strtotime($value->created_date))); ?></td>
              <td><?php echo number_format($value->total_amount); ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-end">
      <table class="">
        <tr>
          <th>Total Delivered:</th>
          <td><?php echo $currency . ' ' . number_format($totalDelivered) ?></td>
        </tr>
        <tr>
          <th>Total Undelivered:</th>
          <td><?php echo $currency . ' ' . number_format($totalUndelivered) ?></td>
        </tr>
        <tr>
          <th>Total Transaction:</th>
          <td><?php echo $currency . ' ' . number_format($totalDelivered + $totalUndelivered) ?></td>
        </tr>
      </table>
     
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php');
?>