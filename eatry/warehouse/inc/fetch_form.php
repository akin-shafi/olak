<?php require_once('../../private/initialize.php'); ?>

<?php 
if(isset($_POST['stockForm'])){ 
	$id = $_POST['id'];
	$editCategory = WarehouseItem::find_by_id($id);
	// pre_r($find);
?>

	<div class="form-group col-sm-12">
      <label>Item Name: <span class="text-danger fs-16">*</span></label>
       <input type="text" required  placeholder="e.g Rice" class="form-control" name="editCategory[item_name]"  value="<?php echo $editCategory->item_name ?>">
       <input type="hidden"  placeholder="e.g 1" class="form-control" name="editCategory[id]"  value="<?php echo $editCategory->id ?>">
     
    </div>

   

	<div class="form-group col-sm-12">
      <label>Category Name: <span class="text-danger fs-16">*</span></label>
       <!-- <input type="text"  placeholder="e.g Rice" class="form-control" name="editCategory[category]"  value="<?php //echo $editCategory->category ?>"> -->

        <select class="form-control category" name="editCategory[category]" required>
          <option value="">Select Category</option>
          <?php foreach (WarehouseItemCategory::find_by_undeleted() as $key => $value) { ?>
            <option value="<?php echo $value->id;  ?>" <?php echo $editCategory->category == $value->id ? 'selected' : '' ?>><?php echo $value->category; ?></option>
          <?php } ?>
          
        </select>
    </div>


<?php } exit();?>








    