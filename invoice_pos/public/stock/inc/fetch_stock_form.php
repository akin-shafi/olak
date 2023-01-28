<?php require_once('../../../private/initialize.php'); ?>

<?php 
if(isset($_POST['stockForm'])){ 
	$id = $_POST['id'];
	$ref = $_POST['ref'];
	$editStock = StockDetails::find_by_item($id);
	$find = StockDetails::find_by_ref($ref);
	// pre_r($find);
?>
	<!-- <input type="hidden" name="editStock[id]" value="<?php //echo $id ?>"> -->
   	  <div class="form-group col-sm-6">
	      <label>Item Name</label>
	      
	      <input type="text"  readonly placeholder="e.g Rice" class="form-control" value="<?php echo Product::find_by_id($editStock->item_id)->pname ?>">
	      <input type="hidden" name="editStock[ref_no]" value="<?php echo $find->ref_no ?>">
	  </div>

      <div class="form-group col-sm-6">
	    <label>Quantity Supplied</label>
	    <input type="number" required name="editStock[supply]" placeholder="e.g 19" class="form-control" id="edit_supply" value="<?php echo $find->supply ?>">
	  </div>
    
    <div class="form-group col-sm-6">
      <label>Cost Price</label>
      <input type="number" required min="0" name="editStock[cost_price]" placeholder="e.g 30000" class="form-control" id="cost_price">
    </div>

	<div class="form-group col-sm-6">
      <label>Sales Price</label>
      <input type="number" required min="0" name="editStock[sales_price]" placeholder="e.g 30000" class="form-control" id="sales_price">
    </div>


<?php } exit();?>