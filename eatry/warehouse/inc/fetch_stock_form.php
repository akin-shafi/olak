<?php require_once('../../private/initialize.php'); ?>

<?php 
if(isset($_POST['stockForm'])){ 
	$id = $_POST['id'];
	$ref = $_POST['ref'];
	$editStock = WarehouseItemDetails::find_by_item($id);
	$find = WarehouseItemDetails::find_by_ref_no($ref);
	// pre_r($find);
?>

	  <div class="form-group col-sm-6">
      <label>Item Name: <span class="text-danger fs-16">*</span></label>
       <input type="text"  readonly placeholder="e.g Rice" class="form-control" value="<?php echo WarehouseItem::find_by_id($editStock->item_id)->item_name ?>">
      	<input type="hidden" name="editStock[ref_no]" value="<?php echo $find->ref_no ?>">
      <!-- <input type="text" name="addItem[item]" placeholder="e.g Rice" class="form-control"> -->

     
    </div>

    <div class="form-group col-sm-6">
      <label>Supplier Name: <span class="text-danger fs-16">*</span></label>
      <input type="text" name="editStock[supplier]" value="<?php echo $find->supplier ?>" required="" placeholder="e.g ABC Limited" class="form-control"  value="">
    </div>

    <div class="form-group col-sm-6">
      <label>Quantity in (<span id="measurement"><?php echo WarehouseItem::find_by_id($id)->measurement ?></span>): <span class="text-danger fs-16">*</span></label>
      <input type="number" min="0" name="editStock[qty_supplied]" value="<?php echo $find->qty_supplied ?>" required="" placeholder="e.g 19" class="form-control" id="quantityy" value="0">
    </div>

    <div class="form-group col-sm-6">
      <label>Supplier Contact: <span class="text-danger fs-16"></span></label>
      <input type="text" min="0" name="editStock[supplier_contact]" value="<?php echo $find->supplier_contact ?>"  placeholder="e.g +234 801 111 2222" class="form-control">
    </div>

    <div class="form-group col-sm-6">
      <label>Unit Cost of Item: <span class="text-danger fs-16">*</span></label>
      <input type="text" min="0" name="editStock[unit_cost]" required="" value="<?php echo $find->unit_cost ?>" placeholder="e.g 19" class="form-control" id="unit_costy" value="0">
    </div>

    <div class="form-group col-sm-6">
      <label>Total Cost: <span class="text-danger fs-16"></span></label>
      <input type="text" readonly=""  name="editStock[total_cost]" value="<?php echo $find->total_cost ?>" placeholder="e.g 19" class="form-control" id="total_costy" value="0">
    </div>


    <div class="form-group col-sm-6">
      <label>Received by: <span class="text-danger fs-16">*</span></label>
      <input type="text" min="0" name="editStock[received_by]" value="<?php echo $find->received_by ?>" required="" placeholder="e.g John Doe" class="form-control">
    </div>

    <div class="form-group col-sm-6">
      <label>Date Received: <span class="text-danger fs-16">*</span></label>
      <input type="datetime-local" min="0" name="editStock[date_received]" value="<?php echo date('Y-m-d', strtotime($editStock->date_received))."T".date('h:i', strtotime($editStock->date_received)) ?>"  required="" class="form-control">
    </div>


<?php } exit();?>








    