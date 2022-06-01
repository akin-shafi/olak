<?php require_once('../../private/initialize.php'); ?>

<?php if(isset($_POST)) { 
    if(!empty($_SESSION["warehouse_cart"])) { 	
		$store_id = 1;
    	$data1 = [
    		'store_id' 			=> $store_id,
    		'receiver' 			=> $_POST['receiver'],
    		'total_item' 		=> $_POST['total_item'],
    		'quantity_in_item'  => $_POST['quantity_in_item'],
    		'total_cost' 		=> $_POST['total_cost'],
    		'note' 				=> $_POST['note'],
    		'created_by' 		=> $loggedInAdmin->id,
    	];

    	$checkOut = new WarehouseDraft($data1);
    	$result1 = $checkOut->save();
    	if ($result1 == true) {
    		$new_id = $checkOut->id;
	      	$rand = rand(10, 200);
	        $trans_no = "1" . str_pad($new_id, 2, "0", STR_PAD_LEFT) . $rand;
	        $data2 = [
		    	'trans_no' => $trans_no, 
		    ];
		    $checkOut->merge_attributes($data2); 
		    $result2 = $checkOut->save();
		    	if ($result2 == true) {
				  $args2 = $_POST['product_id'];
			      for ($i = 0; $i < count($args2); $i++) { 
			          $data3 = [
			          	'product_id' => $_POST['product_id'][$i],
			          	'trans_no' => $trans_no,
			          	'product_quantity' => $_POST['quantity'][$i],    
			          	'unit_price' => $_POST['product_price'][$i],    
			          	'subtotal' => $_POST['total_price'][$i],    
			            'created_by' => $loggedInAdmin->id
			          ];
			         
			          $checkOutDetails = new WarehouseDraftDetails($data3);
			          $result3 = $checkOutDetails->save(); 
			          
				  	}
					  if ($result3 == true) {

				      	exit(json_encode(['success' => true, 'msg' => 'OK', 'trans_no'  => $trans_no]));
				      }else{
				      	exit(json_encode(['location' => 'checkOutDetails', 'msg' => 'FAIL', 'error' => display_errors($checkOutDetails->errors),]));
				      }
				}else{
					exit(json_encode(['location' => 'checkOut Merge', 'msg' => 'FAIL', 'error' => display_errors($checkOut->errors)]));
				}
    	}else{
    		exit(json_encode([
    			'location' => 'checkOut', 
    			'msg' => 'FAIL', 
    			'error' => display_errors($checkOut->errors)
    		]));
    	}


	}else{ 
		exit(json_encode(['msg' => 'FAIL', 'error' => 'Your Cart is empty'])); 
	}

}exit();  ?>