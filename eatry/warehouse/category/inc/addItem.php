<?php require_once('../../../private/initialize.php'); ?>
<?php 
    if(isset($_POST['category'])){


    for ($i=0; $i < count($_POST['category']); $i++) { 
			$data = [
		    "category" => $_POST['category'][$i],
		    "created_by" => $loggedInAdmin->id,
		];
		$addItem = new WarehouseItemCategory($data);
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
