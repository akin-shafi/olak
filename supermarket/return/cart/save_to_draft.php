<?php require_once('../../private/initialize.php'); ?>

<?php if(isset($_POST)) { 

    if(!empty($_SESSION["return_cart"])) { 
		// pre_r($_POST);
    	$uniqid =  rand(10, 100);
    	$rand = rand(10, 100);
    	$ref_no = "0" . str_pad($uniqid, 2, "0", STR_PAD_LEFT) . $rand;

    	$data1 = [ 
          	'ref_no' => $ref_no,
          	'customer_id' => $_POST['customer_id'],
          	'total_item' => $_POST['total_item'],
            'store_id' => $_SESSION['store_id'],
            'created_by' => $loggedInAdmin->id
          ];
        $draft = new Draft($data1);
	    $result1 = $draft->save(); // Save other info into sales table 
	    if ($result1 == true) {
	    	
			$args2 = $_POST['product_name'];
			for ($i = 0; $i < count($args2); $i++) {  
		          $data2 = [ 
		          	'ref_no' => $ref_no,
		            'product_id' => $_POST['product_id'][$i],
		            'product_name' => $_POST['product_name'][$i],
		            'quantity' => $_POST['quantity'][$i],
		            'product_price' => $_POST['product_price'][$i],
		            'total_price' => $_POST['total_price'][$i],
		          ];
		         
		         $draftDetails = new DraftDetails($data2);
		         $result2 = $draftDetails->save(); // Save other info into sales table  
			           	
			  }
			  if ($result2 == true) {  
	                exit(json_encode(['msg' => 'OK']));
	          } else {
	              exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($draftDetails->errors)]));
	          } 
	    }else{
	    	exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($draft->errors)]));
	    }

	}else{ 
		exit(json_encode(['msg' => 'FAIL', 'error' => 'Your Cart is empty'])); 
	}

}exit();  ?>