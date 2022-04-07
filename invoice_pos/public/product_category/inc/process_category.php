<?php require_once('../../../private/initialize.php'); ?>

<?php if (isset($_POST['fetch_table'])) { ?>
 <?php $sn = 1; foreach (RoomsCategory::find_by_undeleted() as $value) { ?>
	<tr>
        <td><?php echo $sn++  ?></td>
        <td><?php echo $value->category; ?></td>
        <td>
        	<?php echo $currency." ".number_format($value->price, 2); ?>
           
        </td>
        <td>
            <a href="javascript:void(0);" id="edit" data-id="<?php echo $value->id; ?>" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
            <a href="javascript:void(0);" id="delete" data-id="<?php echo $value->id; ?>" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
        </td>
        
                                                   
    </tr>
 <?php } ?>
<?php exit(); } ?>
<?php 

if (isset($_POST['category'])) {
  $id = $_POST['id'];
  $check = RoomsCategory::find_by_id($id);

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
$find = RoomsCategory::find_by_id($id);
?>
<div class="col-sm-6">
	<label>Category Name</label>
	
	<input type="text" name="editCat[capacity]" value="<?php echo $find->capacity; ?>" placeholder="Category Name" class="form-control">
</div>

<div class="col-sm-6">
	<label>Price</label>
	<input type="text" name="editCat[price]" value="<?php echo $find->price; ?>" placeholder="Enter value without comma" class="form-control">
</div>

<?php exit(); } ?>

<?php if (isset($_POST['showDelete'])) { 
$id = $_POST['id'];
$find = RoomsCategory::find_by_id($id);
?>
<h4 class="text-center w-100">Are you sure you want to delete the Category <br> <?php echo $find->category; ?></h4>
<input type="hidden" name="deleteCat[id]" value="<?php echo $find->id; ?>" class="form-control">
<?php exit(); } ?>
