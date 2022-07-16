<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$id = $_GET['id'] ?? '1';

$admin = Admin::find_by_id($id);

?>

<?php $page_title = 'Show Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div class="main-container">


  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">

          <a href="<?php echo url_for('admin/') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="back">
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

          <div class="list-item fs-18 bold border-bottom p-2">Name: <?php echo h($admin->full_name()); ?></div>
          <div class="list-item fs-18 bold border-bottom p-2">Phone: <?php echo h($admin->phone); ?></div>
          <div class="list-item fs-18 bold border-bottom p-2">Email: <?php echo h($admin->email); ?></div>
          <div class="list-item fs-18 bold p-2">Admin level: <?php echo h(Admin::ADMIN_LEVEL[$admin->admin_level]); ?>

          </div>
        </div>
      </div>
    </section>


  </div>


</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>