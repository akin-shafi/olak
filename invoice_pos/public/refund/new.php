<?php
require_once('../../private/initialize.php');
require_login();

$id = $_GET['id'] ?? '';
if ($id) {
  $customer = Client::find_by_customer_id($id);
  $c_id = $customer->id;
  $customer_name = $customer->full_name();
}

if (is_post_request()) {

  $args = $_POST['refund'];
  $refund = new Refund($args);
  $result = $refund->save();
  if ($result == true) {
      $session->message('Refund Initiated successfully. Please Wait for Approval');
      redirect_to(url_for('/refund/index.php'));
    }
} else {
  // display the form
  $refund = new Refund;
}

?>

?>

<?php $page = 'refund';
$page_title = 'Refund Customer'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div class="main-container">


  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9 ">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3 ">
        <div class="daterange-container">

          <a href="<?php echo url_for('/refund/') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="refund List">
            <i class="feather-file-text"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="content-wrapper">
    <?php if (display_errors($refund->errors)) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo display_errors($refund->errors); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <form id="add_refund" class="mb-0" method="post">


      <?php include('refund_form.php') ?>




      <div class="modal-footer">
        <button class="btn btn-primary" id="add_refund_btn">Submit</button>
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>