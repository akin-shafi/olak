<?php require_once('../../private/initialize.php'); ?>

<?php if (isset($_POST['fetch_table'])) { ?>
<?php $sn = 1; 
$company_id = $loggedInAdmin->company_id;
$branch_id = $loggedInAdmin->branch_id;
$productCat = ProductCategory::find_by_company(['company_id'=> $company_id, 'branch_id' => $branch_id]);

// pre_r($branch_id);

foreach ($productCat as $value) { ?>
<tr>
    <td><?php echo $sn++  ?></td>
    <td><?php echo $value->category; ?></td>
    <td><?php echo $value->exception == 1 ? "True" : "False"; ?></td>

    <td>
        <a href="javascript:void(0);" id="edit" data-id="<?php echo $value->id; ?>" class="btn btn-sm btn-primary"><i
                class="la la-pencil"></i> Edit</a>
        <a href="javascript:void(0);" id="delete" data-id="<?php echo $value->id; ?>" class="btn btn-sm btn-danger"><i
                class="la la-trash-o"></i> Delete</a>
        <a href="javascript:void(0);" data-id="<?php echo $value->id; ?>" class="btn btn-sm bg-teal exception">Exception
            Status</a>
    </td>


</tr>
<?php } ?>
<?php exit(); } ?>
<?php 

if (isset($_POST['category'])) {
  $id = $_POST['id'];
  $check = ProductCategory::find_by_id($id);

	$args = [
      'category' => $_POST['fullname'],
      'price' => $_POST['price']
    ];
    $check->merge_attributes($args);
    $result = $check->save();

      if($result){
	  	exit(json_encode(['msg' => 'OK']));
	  }else{
	  	exit(json_encode(['msg' => 'FAIL']));
	  }

  
  

}

 ?>

<?php if (isset($_POST['showEdit'])) { 
$id = $_POST['id'];
$find = ProductCategory::find_by_id($id);
?>
<div class="col-sm-6">
    <label>Category Name</label>

    <input type="text" name="editCat[category]" value="<?php echo $find->category; ?>" placeholder="Category Name"
        class="form-control">
</div>

<input type="hidden" name="editCat[id]" value="<?php echo $_POST['id']; ?>">
<?php exit(); } ?>

<?php if (isset($_POST['showDelete'])) { 
$id = $_POST['id'];
$find = ProductCategory::find_by_id($id);
?>
<h4 class="text-center w-100">Are you sure you want to delete the Category <br> <?php echo $find->category; ?></h4>
<input type="hidden" name="deleteCat[id]" value="<?php echo $find->id; ?>" class="form-control">
<?php exit(); } ?>


<?php if (isset($_POST['exceptionEdit'])) { 
$id = $_POST['id'];
$find = ProductCategory::find_by_id($id);
?>
<div class="col-sm-6">
    <label>Status</label>
    <input type="hidden" name="editExcept[id]" value="<?php echo $_POST['id']; ?>">
    <select class="form-control" name="editExcept[exception]">
        <!-- <option value="">Select</option> -->
        <?php foreach (ProductCategory::VALUE as $key => $value) { ?>
        <option value="<?php echo $key ?>" <?php echo $find->exception == $key ? 'selected' : '' ?>><?php echo $value ?>
        </option>
        <?php } ?>

    </select>
    <!-- 
  <input type="text" name="editExcept[exception]" value="<?php //echo $find->exception; ?>"  class="form-control"> -->

</div>
<?php exit(); } ?>