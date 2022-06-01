<?php require_once('../../private/initialize.php'); ?>

<?php 
if(isset($_POST['addItem'])){

	$args = $_POST['addItem'];
	$addItem = new WarehouseItem($args);
  $result = $addItem->save();
       if ($result == true ) {
           exit(json_encode(['success' => true, 'msg' => 'OK']));
       }else{
        exit(json_encode(['success' => false, 'msg' => 'FAIL', 'errors' => display_errors($addItem->errors)]));
       }
} 


?>



<?php if(isset($_POST['editCategory'])){

   $editCat = WarehouseItem::find_by_id($_POST['editCategory']['id']);
   $editCat->merge_attributes($_POST['editCategory']);
    $result = $editCat->save();
       

    if ($result == true) {
          exit(json_encode(['msg' => 'OK']));
    }else{
      exit(json_encode(['msg' => display_errors($editCat->errors)]));
    }
       
    

} ?>

<?php if(isset($_POST['delete'])){

   $deleteCat = WarehouseItem::find_by_id($_POST['id']);
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
       
    

}?>

<?php if(isset($_POST['deleteAll'])){
  

  
   $warehouseItemDetails = WarehouseItemDetails::find_all();
   foreach ($warehouseItemDetails as $key => $v) {
      $e = WarehouseItemDetails::find_by_id($v->id);
      $result1 = $e->delete($e->id);
          if ($result1 == true) {
              $warehouseItem = WarehouseItem::find_all();
              foreach ($warehouseItem as $key => $value) {
                $each = WarehouseItem::find_by_id($value->id);
                $result2 = $each->clearQty($each->id);
                // pre_r($result2);
              }

              if ($result2 == true) {
                exit(json_encode(['msg' => 'OK']));
              }else{
                exit(json_encode(['msg' => 'Nothing']));
              }
              
        }else{
          exit(json_encode(['msg' => 'Nothing2']));
        }
    }
    

       
    

} exit();?>