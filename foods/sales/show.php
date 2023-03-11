<?php require_once('../private/initialize.php');
require_login();

$id = $_GET['id'] ?? '1';
$today = date('Y-m-d');

$cash = CashFlow::find_by_id($id);
$uploads = Uploads::find_by_date($today);
$total_with_bread = $cash->bread + $cash->transfer + $cash->pos + $cash->credit_sales + $cash->cash_sales;
$total_without_bread = $cash->transfer + $cash->pos + $cash->credit_sales + $cash->cash_sales;
$page = 'Sales';
$page_title = 'Show Cashflow';
include(SHARED_PATH . '/admin_header.php');

?>


<div class="main-container">

  <div class="content-wrapper">
    <div class="row justify-content-center">
      <div class="btn-group mb-3">
        <a href="<?php echo url_for('sales/') ?>" class="btn btn-primary">&LeftArrow; Back</a>
        <button type="button" class="btn btn-outline-primary">Back to Sales</button>
      </div>
    </div>

    <section class="w-50 shadow bg-light mx-auto">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Cash Sales
          <span class="badge bg-primary rounded-pill text-white"><?php echo number_format($cash->cash_sales); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Credit Sales
          <span class="badge bg-primary rounded-pill text-white"><?php echo number_format($cash->credit_sales); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          POS
          <span class="badge bg-primary rounded-pill text-white"><?php echo number_format($cash->pos); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Transfer
          <span class="badge bg-primary rounded-pill text-white"><?php echo number_format($cash->transfer); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Bread
          <span class="badge bg-primary rounded-pill text-white"><?php echo number_format($cash->bread); ?></span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-center">
          Total with bread
          <span class="badge bg-primary rounded-pill text-white"><?php echo number_format($total_with_bread); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Total without bread
          <span class="badge bg-primary rounded-pill text-white"><?php echo number_format($total_without_bread); ?></span>
        </li>
      </ul>

      <div class="row mx-2 pb-3">
        <div class="col-md-6" style="border-right: 1px solid #888;">
          <h3>Narration</h3>
          <p><?php echo isset($cash->narration) ? ucfirst($cash->narration) : '<i>Not set</i>'; ?></p>
        </div>

        <div class="col-md-6">
          <h3>Uploads</h3>
          <?php foreach ($uploads as $upload) :
            $file = isset($upload->file_name) ? $upload->file_name : 'olak.png';
          ?>
            <img loading="lazy" src="<?php echo url_for('sales/uploads/' . $file) ?>" class="avatar">
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  </div>


</div>
<!-- Content wrapper end -->


</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>