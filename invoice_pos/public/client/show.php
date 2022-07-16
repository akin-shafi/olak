<?php

require_once('../../private/initialize.php');

// require_login();

$id = $_GET['id'];
$clients = Client::find_by_id($id);
$wallet = Wallet::find_by_customer_id($clients->customer_id);

$walletBalance = intval($wallet->balance);
$walletDetails = WalletDetails::find_rec_by_customer_id($clients->customer_id);
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
                      <h3 class="user-name m-t-0"><?php echo $clients->full_name() ?></h3>
                      <h5 class="company-role m-t-0 mb-0">Customer</h5>
                      <div class="staff-id"><i>Registered By : <?php echo Admin::find_by_id($clients->created_by)->full_name(); ?></i></div>
                      <div class="staff-msg"><a href="chat.html" class="btn btn-custom">Send Message</a></div>
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


    <div class="table-responsive">
      <table class="table table-bordered" id="rowSelection">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Reference No.</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Post By</th>
            <th>Bank Name</th>
            <th>Account No.</th>
            <th>Created At</th>
            <!-- <th>Repair Record</th> -->
          </tr>
        </thead>
        <tbody>
          <?php $sn = 1;
          foreach ($walletDetails as $value) {
            $bankName = Bank::find_by_id($value->bank_name)->bank_name;
            $createdBy = Admin::find_by_id($value->created_by)->full_name();
          ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $value->refrence_no; ?></td>
              <td><?php echo $value->description; ?></td>
              <td><?php echo number_format(floatval($value->amount)); ?></td>
              <td><?php echo $createdBy; ?></td>
              <td><?php echo ucwords($bankName); ?></td>
              <td><?php echo $value->account_no; ?></td>
              <td><?php echo date('dS M, Y', strtotime($value->created_at)); ?></td>
              <!-- <td><a href="record.php"><i class="feather-settings bold"> History</i></a></td> -->
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php');
?>