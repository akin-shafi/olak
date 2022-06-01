<?php require_once('../../private/initialize.php'); ?>

<?php if(isset($_POST)) { 
	  $args = $_POST['trans'];
	  $store_id = $_POST['trans']['store_id'];
	  $created_by = $_POST['trans']['created_by'] ?? $loggedInAdmin->id;
	  $transaction = new Transaction($args);
	  $result1 = $transaction->save(); // Save into transaction table
	  // $result1 = true;
      	// pre_r($transaction);
      	if ($result1 === true) {
      		$new_trans_id = $transaction->id;
	      	$rand = rand(10, 100);
	      	// Create trans_no dynamically
	        $trans_no = "1" . str_pad($new_trans_id, 3, "0", STR_PAD_LEFT) . $rand;

		    $data2 = [
		    	'trans_no' => $trans_no,
		    	'created_by' => $created_by,
		    ];
			$transaction->merge_attributes($data2); // merge newly created trans_no and
			$result2 = $transaction->save(); // Save tran_no into transaction table 
			if ($result2 == true) {
			  	$trans_details = new TransactionDetail($args);
			  	$new_ref_id = $transaction->id;
		      	$dym = rand(10, 200);
		      	// Create ref_no dynamically
		        $ref_no = 'Ref'. "1" . str_pad($new_ref_id, 2, "0", STR_PAD_LEFT) . $dym;
			    $data3 = [
			    	'trans_no' => $trans_no, 
			    	'ref_no' => $ref_no,
			    	'outstanding' => $args['balance'],
			    	'created_by' => $created_by,
			    	'paid_at' => date('Y-m-d H:i:s'),
			    ];
			    $trans_details->merge_attributes($data3); 
			    $result3 = $trans_details->save(); // Save into transaction_details table
				if ($result3 == true) {
					  $args2 = $_POST['product_id'];
				      for ($i = 0; $i < count($args2); $i++) { 
				          $data = [
				          	'product_id' => $_POST['product_id'][$i],
				          	'trans_no' => $transaction->trans_no,
				          	'product_quantity' => $_POST['product_quantity'][$i],    
				          	'unit_price' => $_POST['unit_price'][$i],    
				          	'subtotal' => $_POST['subtotal'][$i],    
				            'created_by' => $created_by
				          ];
				         
				         $sales = new Sales($data);
				          $result4 = $sales->save(); // Save other info into sales table  
					      // $result4 = true;      	
					  }
					  if ($result4 == true) {
					  	
					  	$arr = $_POST['product_id'];
					  	if ($store_id == 1) {
					  		$items = 'quantity';
					  		$sold = 'sold_bottle';
					  	}else{
					  		$items = 'left_shut';
					  		$sold = 'sold_shut';
					  	}
					  	for ($i = 0; $i < count($arr); $i++) {
						    $product = Product::find_by_id($_POST['product_id'][$i]);
						    // $stockUnit = $product->quantity - $_POST['product_quantity'][$i];
						    $itemsold = $_POST['product_quantity'][$i] + $product->$sold;

						    $args = [
						    	// $items => $stockUnit,
						    	$sold => $itemsold,
						    ];
						    $product->merge_attributes($args);
						    
						    $result5 = $product->save(); // Edit Unit Stock of stock in product table
						   
						    
			            }
						  if($result5 == true){
						  	unset($_SESSION["shopping_cart"]);
						    echo json_encode(['msg' => 'OK', 'trans_no' => $transaction->trans_no]);
						  }else{
						  	exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($product->errors), 'location' => 'Fail here']));
						  }
				          
					  }
					  // pre_r($args2);
					  
				}else{
					//Show error
					exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($transaction->errors), 'location' => 'Fail at second attempt to save Transaction']));
				}
			}  		
      	}else{
      		exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($transaction->errors), 'location' => 'Fail at first attempt to save Transaction']));
      	}			      
} ?>