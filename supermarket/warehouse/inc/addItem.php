<?php require_once('../../private/initialize.php'); ?>
<?php 
    if(isset($_POST['item_name'])){


    for ($i=0; $i < count($_POST['item_name']); $i++) { 
			$data = [
		    "item_name" => $_POST['item_name'][$i],
		    "measurement" => $_POST['measurement'][$i],
		    "category" => $_POST['category'][$i],
		    "created_by" => $loggedInAdmin->id,
		];
		$addItem = new WarehouseItem($data);
		// pre_r($addItem);
		$result = $addItem->save();
		
	}
	if ($result == true) {
		exit(json_encode(['msg' => 'OK']));
	}else{
		exit(json_encode(['error' => display_errors($addItem->errors)]));
	}
} 
?>
