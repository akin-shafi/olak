<?php require_once('../../../private/initialize.php'); ?>

<?php 
if(isset($_POST['addItem'])){

	$args = $_POST['addItem'];
	$addItem = new WarehouseItemCategory($args);
  $result = $addItem->save();
       if ($result == true ) {
           exit(json_encode(['success' => true, 'msg' => 'OK']));
       }else{
        exit(json_encode(['success' => false, 'msg' => 'FAIL', 'errors' => display_errors($addItem->errors)]));
       }
} 


?>



<?php if(isset($_POST['editCategory'])){

   $editCat = WarehouseItemCategory::find_by_id($_POST['editCategory']['id']);
   $editCat->merge_attributes($_POST['editCategory']);
    $result = $editCat->save();
       

    if ($result == true) {
          exit(json_encode(['msg' => 'OK']));
    }else{
      exit(json_encode(['msg' => display_errors($editCat->errors)]));
    }
       
    

} ?>

<?php if(isset($_POST['delete'])){

   $deleteCat = WarehouseItemCategory::find_by_id($_POST['id']);
   $args = [
    'deleted' => 1
   ];
   $deleteCat->merge_attributes($args);
    $result = $deleteCat->save();
       

    if ($result == true) {
          exit(json_encode(['msg' => 'OK']));
    }else{
      exit(json_encode(['msg' => display_errors($deleteCat->errors)]));
    }
       
    

} exit();?>