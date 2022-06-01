<?php require_once('../../private/initialize.php');
$page_title = 'Stock';
$page = 'Products';
require_login();


$id = $_GET['id'] ?? '';
$store_id = $_GET['store_id'] ?? '';
$product = Product::find_by_id($id);
// echo $store_id;
if ($store_id == 1) {
  redirect_to(url_for('/products/stock/items.php?id='.$id));
	if ($product->quantity > $product->alert_quantity ) {
		redirect_to(url_for('/pos/'));
	}
}elseif($store_id == 2){
	if ($product->left_shut > 0 ) {
		redirect_to(url_for('/pos/'));
	}
}
// pre_r($product);
if (is_post_request()) {

  // Save record using post parameters
  $args = $_POST['product'];
  $product->merge_attributes($args);

  // pre_r($args);
  // pre_r($product);
  $result = $product->save();

  if ($result === true) {

    // logfile
    log_action('Edit product', "id: {$product->id}, Editted by {$loggedInAdmin->full_name()}", "admin");

    $session->message('The product was updated successfully.');
    redirect_to(url_for('/pos/'));
  } else {
    // show errors
  }
} else {

  // display the form
}
include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title ." ". $page; ?></h1>
       
    </section>

    <div class="col-lg-12 alerts">
       <div id="custom-alerts" style="display:none;">
          <div class="alert alert-dismissable">
             <div class="custom-msg"></div>
          </div>
       </div>
    </div>
    <section class="content">
    	<div class="col-lg-12 alerts d-flex justify-content-center mn-4">
            <?php echo display_errors($product->errors); ?>
         </div>
       <div class="row">
          <div class="col-xs-12">
            <div class="box box-primary">
                
                <div class="box-body">
                   <form class="row" method="post">
                   		<div class="form-group col-md-6">
                   			<label for="p_name">Product Name</label>
                   			<input type="text" name="product[pname]" class="form-control" readonly id="p_name" value="<?php echo $product->pname; ?>">
                   		</div>
                   		<div class="form-group col-md-6">
                   			<div class="d-flex justify-content-between">
                   				<label for="p_qty"> 
                   				<?php echo $store_id == 1 ? "Quantity(Per bottle)" : "Quantity(Shuts' left in One Bottle)"?>
                   				</label>
                   			
                   			</div>
                   			<div class="form-inline">
                   				<input type="text" name="<?php echo $store_id == 1 ? "product[quantity]" : "product[left_shut]"?> " class="form-control" id="p_qty" value="<?php echo $store_id == 1 ? $product->quantity : $product->left_shut; ?>">

                   			<?php if ($store_id == 2) { ?>
                   			<button type="button" value="<?php echo $product->no_of_shut ?>" class="form-control btn btn-sm btn-warning mb-2" id="replace">Replace bottle </button>
                   			</div>
                   			<?php } ?>
                   		</div>
                   		<div class="form-group col-md-12 d-flex justify-content-center">
                   			<input type="submit" value="submit" class="btn btn-lg btn-primary">
                   		</div>
                   </form>
                </div>
            </div>
          </div>
       </div>
       
    </section>
 </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
 
<script type="text/javascript">
$(document).on('click', '#replace', function(){
	$('#p_qty').val($(this).val()); 
})
 

  

</script>

