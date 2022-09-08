<?php
require_once('../../private/initialize.php');



$page = 'Transactions'; 
// $page_title = 'Wallet History';
$page_title = "All Transactions";
require_login();

?>

<?php include(SHARED_PATH . '/admin_header.php'); ?>
<div class="main-container">
	<!-- Content wrapper start -->

  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9 ">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3 ">
        <div class="daterange-container">

        
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->
  <div class="content-wrapper">
    <?php echo display_session_message(); ?>
    <div class="table-responsive">
        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="wallet-table">
          <thead>
            <tr role="row">
              <th>S/N</th>
              <th>Customer Name</th>
              <!-- <th>Customer No</th> -->
              <th>Deposit</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $sn = 1;
            foreach (Wallet::find_by_undeleted() as $wallet) : 
              $customer = Client::find_by_customer_id($wallet->customer_id);
              $c_id = $customer->id;
              $customer_name = $customer->full_name();
              $balance = intval($wallet->balance);
            ?>

	            <?php if ($wallet->deposit != 0) { ?>
	            	
	              <tr>
	                <td><?php echo $sn++ ?></td>
	                <td>
	                  <a href="<?php echo url_for('client/show.php?id='. $c_id) ?>" class="d-flex align-items-center">
	                    <h6 class="mb-0 fs-14"><?php echo ucwords($customer_name) ?></h6>
	                  </a>
	                </td>
	                <td><?php echo number_format($wallet->deposit, 2) ?> </td>
	                
	                <td>
	                  <!-- <a href="<?php // echo url_for('wallet/add.php?id='. $customer->customer_id ) ?>" class=" btn btn-sm btn-primary " > <i class="feather-plus text-success"></i> Load wallet</a> -->
	                </td>
	              </tr>
              <?php } ?>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
    
  </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>