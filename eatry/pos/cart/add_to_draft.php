<?php require_once('../../private/initialize.php'); ?>

<?php if(isset($_POST)) { 

    if(!empty($_SESSION["shopping_cart"])) { 
		// pre_r($_POST);
    	$ref_no = $_POST['ref_no']; 

    	$draft =  Draft::find_by_ref($ref_no);
    	$data1 = [ 
          	'total_item' => $draft->total_item + $_POST['total_item'],
            'created_by' => $loggedInAdmin->id
          ];
        $draft->merge_attributes($data1); // merge newly created trans_no and
	    $result1 = $draft->save(); // Save other info into sales table 
	    // pre_r($draft);
	    // $result1 = true;
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