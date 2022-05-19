<?php require_once('../../private/initialize.php'); ?>

<?php 
if(isset($_POST['addItem'])){

	$args = $_POST['addItem'];
	$addItem = new WarehouseItemDetails($args);
  $warehouseItem = WarehouseItem::find_by_id($_POST['addItem']['item_id']);
  // pre_r($addItem);
       if (!empty($warehouseItem)) {
            $initial_stock = $warehouseItem->quantity ?? 0;
            $supply = $_POST['addItem']['qty_supplied'];
            $unit_cost = $_POST['addItem']['unit_cost'];
            // pre_r($unit_cost);
            $rand = rand(10, 100);
          	$result = $addItem->save();
             if ($result == true) {
                  $new_id = $addItem->id;
                  // Generate Unique refrence number
                  $ref_no = "04" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;
                    $data = [
                      'initial_stock' => $initial_stock,
                      'ref_no' => $ref_no,
                      'qty_left' => $initial_stock + $supply,
                      'updated_at' => date('Y-m-d H:i:s'),
                      // 'total_amt' => ($initial_stock + $supply) * $unit_price 
                    ];
                    $addItem->merge_attributes($data);
                    $result2 = $addItem->save();
                  if ($result2 == true) {
                    // pre_r($addItem);
                         $new_quantity = $initial_stock + $supply;
                          $data2 = [
                            'ref_no' => $ref_no,
                            'price' => $_POST['addItem']['unit_cost'],
                            'quantity' => $new_quantity,
                            'updated_at' => date('Y-m-d H:i:s'),
                            
                          ];
                          $warehouseItem->merge_attributes($data2);
                          $result3 = $warehouseItem->save();
                           // $result3 = true;
                  }

                  if ($result3 == true) {  
                        exit(json_encode(['success' => true, 'msg' => 'OK']));
                  } else {
                      exit(json_encode(['success' => false, 'WarehouseItem' => 'Fail to insert' ,'msg' => display_errors($warehouseItem->errors)]));
                  }
             }else{
                exit(json_encode(['success' => false, 'WareHouseItemDetails' => 'Fail to insert' , 'msg' => display_errors($addItem->errors)]));
             }
       }else{
        exit(json_encode(['success' => false, 'msg' => 'Item Is not yet attached to any product in the menu']));
       }
} 


?>



<?php if(isset($_POST['editStock'])){
   $ref_no = $_POST['editStock']['ref_no'];
   $editCat = WarehouseItemDetails::find_by_ref_no($ref_no);
   $initial = $editCat->initial_stock;
   $supply = $_POST['editStock']['qty_supplied'];
   $editStock = $_POST['editStock'];
   $args = [

      'unit_cost' => $editStock['unit_cost'],
      'total_cost' => $editStock['total_cost'],
      'supplier' => $editStock['supplier'],
      'supplier_contact' => $editStock['supplier_contact'],
      'date_received' => $editStock['date_received'],
      'received_by' => $editStock['received_by'],
      'qty_supplied' => $editStock['qty_supplied'],
      'initial_stock' => $initial,
      'qty_left' => $initial + $supply,
   ];
       
    $editCat->merge_attributes($args);
    // pre_r($editCat);
    $result = $editCat->save();
    if ($result == true) {
          $product = WarehouseItem::find_by_ref_no($ref_no); 
          $data2 = [
            'quantity' => $supply,
            'price' => $editStock['unit_cost'],
          ];
          $product->merge_attributes($data2);
          $result1 = $product->save();
          if ($result1 == true) {  
              exit(json_encode(['msg' => 'OK']));
          } else {
              exit(json_encode(['msg' => display_errors($product->errors)]));
          }
    }else{
      exit(json_encode(['msg' => display_errors($editCat->errors)]));
    }
       
    

} exit();?>