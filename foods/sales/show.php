<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$cash = CashFlow::find_by_id($id);

?>

<?php $page_title = 'Show cash'; ?>
<?php include(SHARED_PATH . '/cash_header.php'); ?>

<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">
          
          <a href="<?php echo url_for('sales/') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="back">
            <i class="feather-arrow-left"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->


  <!-- Content wrapper start -->
  <div class="content-wrapper">
      <section class="w-50 border mx-auto">

        <div id="" class="alert-light">

          <div class="list-group">

            <div class="list-item fs-28 bold border-bottom p-2">Cash: <?php echo h($cash->cash()); ?></div>
            <div class="list-item fs-28 bold border-bottom p-2">Credit: <?php echo h($cash->credit); ?></div>
            <div class="list-item fs-28 bold border-bottom p-2">POS: <?php echo h($cash->pos); ?></div>
            <div class="list-item fs-28 bold border-bottom p-2">Transfer: <?php echo h($cash->transfer); ?></div>

             
              
            </div>

          </div>

        </div>
      </section>


  </div>
  <!-- Content wrapper end -->


</div>



<?php include(SHARED_PATH . '/cash_footer.php'); ?>