<?php require_once('../../../private/initialize.php'); ?>

<?php 
if(isset($_POST['stockForm'])){ 
	$id = $_POST['id'];
	$editCategory = WarehouseItemCategory::find_by_id($id);
	// pre_r($find);
?>

	  <div class="form-group col-sm-12">
      <label>Category Name: <span class="text-danger fs-16">*</span></label>
       <input type="text"  placeholder="e.g Rice" class="form-control" name="editCategory[category]"  value="<?php echo $editCategory->category ?>">
       <input type="hidden"  placeholder="e.g Rice" class="form-control" name="editCategory[id]"  value="<?php echo $editCategory->id ?>">
     
    </div>


<?php } exit();?>








    