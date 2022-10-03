<?php

require_once('../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
  redirect_to(url_for('/transaction/index.php'));
}
$id = $_GET['id'];
$transaction = WalletFundingMethod::find_by_id($id);
$account_number = Bank::find_by_id($transaction->bank_name)->account_number ?? "Not Set";
$account_name = $transaction->bank_name == 0 ? " " : Bank::find_by_id($transaction->bank_name)->account_name;

if ($transaction == false) {
  redirect_to(url_for('/transaction/index.php'));
}

if (is_post_request()) {

  // logfile
  // log_action('Delete transaction', "id: {$transaction->id}, Deleted by {$loggedInAdmin->full_name()}", "transaction");

  // Delete transaction
  $result = $transaction->deleted($id);
  if ($result == true) {
    $session->message('The transaction was deleted successfully.');
    redirect_to(url_for('/transaction/index.php'));
  }else{

  }
  
} else {
  // Display form
}

?>

<?php $page_title = 'Delete transaction'; ?>
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
         
          <a href="<?php echo url_for('/transaction/delete.php?id=' . h(u($id))); ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Delete">
            <i class="feather-trash"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->


  <!-- Content wrapper start -->
  <div class="content-wrapper">


    <div class="card p-4">

     <?php if (display_errors($transaction->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($transaction->errors); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <!-- <h1>Delete transaction</h1> -->
    <p>Are you sure you want to delete this transaction?</p>
      <table class="table">
        <tr>
          <td>Customer Name:</td> <td><?php echo Client::find_by_customer_id($transaction->customer_id)->full_name(); ?></td>
        </tr>
        <tr>
          <td>Amount:</td> 
          <td><?php echo $currency." ". number_format($transaction->amount, 2); ?></td>
        </tr>
        <tr>
          <td>Payment Method:</td> 
          <td><?php echo Billing::PAYMENT_METHOD[$transaction->payment_method]; ?></td>
        </tr>
        <tr>
          <td>Bank:</td> 
          <td><?php echo Bank::find_by_id($transaction->bank_name)->bank_name ?? "Not Set"; ?></td>
        </tr>
        <tr>
          <td>Account Number:</td> 
          <td><?php echo $account_number ."-". $account_name; ?></td>
        <tr>
        <tr>
          <td>Registered Date:</td> 
          <td><?php echo $transaction->created_at; ?></td>
        </tr>
        <tr>
          <td>Registered By:</td> 
          <td><?php echo Admin::find_by_id($transaction->created_by)->full_name(); ?></td>
        </tr>
      </table>

    <form action="<?php echo url_for('/transaction/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations" class="btn-group">
        <input type="submit" name="commit" class="btn btn-sm btn-danger border-0" value="Yes" />
        <a href="<?php echo url_for('/transaction/index.php'); ?>" class="btn btn-sm btn-dark">No</a>
      </div>
    </form>
  </div>


  </div>
  <!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->




<?php include(SHARED_PATH . '/admin_footer.php'); ?>