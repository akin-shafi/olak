<?php

require_once('../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
  redirect_to(url_for('/products/index.php'));
}
$id = $_GET['id'];
$products = Product::find_by_id($id);
if ($products == false) {
  redirect_to(url_for('/products/index.php'));
}

if (is_post_request()) {

  // logfile
  // log_action('Delete products', "id: {$products->id}, Deleted by {$loggedInAdmin->full_name()}", "products");s

  // Delete products
  $result = $products->deleted($id);
  $session->message('The products was deleted successfully.');
  redirect_to(url_for('/products/index.php'));
} else {
  // Display form
}

?>

<?php $page_title = 'Delete products'; ?>
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
         
          <a href="<?php echo url_for('/products/delete.php?id=' . h(u($id))); ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Delete">
            <i class="feather-trash"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->


  <!-- Content wrapper start -->
  <div class="content-wrapper">


    <div class="card text-center p-4">
    <!-- <h1>Delete products</h1> -->
    <p>Are you sure you want to delete this products?</p>
    <p class="item"><?php echo h($products->pname); ?></p>

    <form action="<?php echo url_for('/products/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations" class="btn-group">
        <input type="submit" name="commit" class="btn btn-sm btn-danger border-0" value="Yes" />
        <a href="<?php echo url_for('/products/index.php'); ?>" class="btn btn-sm btn-dark">No</a>
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