<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$id = $_GET['id'] ?? '1';

$token = Token::find_by_id($id);

?>

<?php $page_title = 'Show Token'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div class="main-container">


  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">

          <a href="<?php echo url_for('token/') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="back">
            <i class="feather-arrow-left"></i>
          </a>
        </div>
      </div>
    </div>
  </div>


  <div class="content-wrapper">
    <section class="w-50 border mx-auto">

      <div class="alert-light">

        <div class="list-group mb-0">

          <div class="list-item fs-18 bold border-bottom p-2">Token ID: <?php echo h($token_id); ?></div>
          <div class="list-item fs-18 bold border-bottom p-2">Customer: <?php echo Client::find_by_id($token->customer_id)->full_name(); ?></div>
          <div class="list-item fs-18 bold border-bottom p-2">Token Type: <?php echo Token::TOKEN_TYPE[$token->token_type]; ?></div>
          <div class="list-item fs-18 bold p-2">Status: <?php echo Token::STATUS[$token->status]; ?>
          <div class="list-item fs-18 bold p-2">Created at: <?php echo date('Y-m-d', $token->created_at); ?>

          </div>
        </div>
      </div>
    </section>


  </div>


</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>