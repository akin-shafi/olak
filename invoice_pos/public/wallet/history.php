<?php
require_once('../../private/initialize.php');
require_login();

?>
<?php $page = 'Wallet'; $page_title = 'Proof of Payment'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>
<style type="text/css">
  .red{
    color: red; 
    font-weight: bold; 
    font-size: 20px; 
    text-decoration:underline;
  }
  .green{
    color: green; 
    font-weight: bold; 
    font-size: 20px; 
    /*text-decoration:underline;*/
  }
</style>
<!-- ************* Main container start ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9 ">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3 ">
        <div class="daterange-container">
          <?php if (!in_array($loggedInAdmin->admin_level, [2,3])) { ?>
           <a href="<?php echo url_for('wallet/add.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New wallet">
            <i class="feather-plus"></i>
          </a>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <?php echo display_session_message(); ?>


    <div class="table-responsive">
          <table id="rowSelection" class="table table-sm table-striped " >
          <thead>
            <tr role="row">
              <th>S/N</th>
              <th>Customer Name</th>
              <th>Wallet Balance</th>
              <th>Last Deposit</th>
              <th>Payment ID</th>
              
              <th>Created Date</th>
              <th>Created By</th>
              <!-- <th>Action</th> -->
            </tr>
          </thead>
          <tbody id="show_data">
            <?php $sn = 1;
              foreach (Wallet::find_by_undeleted() as $value) : 
                $customer_name = Client::find_by_customer_id($value->customer_id)->full_name();
                $balance = intval($value->balance);
                $deposit = intval($value->deposit);
              ?>
                <tr>
                  <td><?php echo $sn++ ?></td>
                  <td>
                    <a href="<?php echo url_for('wallet/show.php?id='. $value->id) ?>" class="d-flex align-items-center">
                      <h6 class="mb-0 fs-14"><?php echo ucwords($customer_name) ?></h6>
                    </a>
                  </td>
                  <td class="green"><?php echo number_format($balance, 2) ?> </td>
                  <td>
                    <?php echo number_format($deposit, 2) ?>
                  </td>
                  <td>
                     <a href="<?php echo url_for('wallet/pop.php?payment_id=' . $value->payment_id) ?>" class="text-primary "> <?php echo $value->payment_id ?></a> 
                  </td>

                  <td>
                    <?php echo date("Y-m-d H:i:s", strtotime($value->created_at)) ?>
                  </td>
                  <td>
                    <?php echo Admin::find_by_id($value->created_by)->full_name() ?>
                  </td>

                </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
    </div>
    
  </div>

</div>


<div class="modal fade" tabindex="-1" id="show_deposit" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Payment History</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="rowSelection" class="table table-sm table-striped ">
            <thead>
              <tr>
                <td>S/N</td>
                <td>Amount</td>
                <td>Payment Method</td>
                <td>Bank Name</td>
                <td>Account No.</td>
                <td>Date</td>
                <td>Registered By</td>
                <?php if($accessControl->can_approve == 1) : ?>
                <td>Action</td>
                <?php endif  ?>

              </tr>
            </thead>
            <tbody id="show_details">
              
            </tbody>
          </table>
      </div>
      </div>
      
    </div>
  </div>
</div>