<?php require_once('../../private/initialize.php'); ?>
<?php 
if(isset($_POST["action"])){
	if($_POST["action"] == 'remove')
	{	$id = $_POST["product_id"];
		if ($_POST['from'] == 1) {
			$item = DraftDetails::find_by_id($id);
		}else{
			$item = CreditDetails::find_by_id($id);
		}
		
		// pre_r($item);
		$result = $item->delete();
	}
} 

if(isset($_POST["edit"])){

	if($_POST["edit"] == "edit_quantity"){
		$id = $_POST["product_id"];
		$data = [
		    'quantity' => $_POST["product_quantity"]
		];
		$edit =  DraftDetails::find_by_id($id);
		$edit->merge_attributes($data); // merge newly created trans_no and
	    $result = $edit->save();
	    // pre_r($edit);
	}
}



if(isset($_POST["action"])){

	if($_POST["action"] == "add"){
		$ref_no = $_POST['ref_no']; 
		$product_id = $_POST['product_id']; 
    	
    	$product = DraftDetails::find_by_product_id($product_id);

    	

	    $data2 = [ 
          	'ref_no' => $ref_no,
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'quantity' => $_POST['product_quantity'],
            'product_price' => $_POST['product_price'],
            'total_price' => $_POST['product_price'] * $_POST['product_quantity'],
          ];
         
         $product = new DraftDetails($data2);
         $result1 = $product->save(); // Save other info into sales table 

         if ($result1 == true) {  
                $draft =  Draft::find_by_ref($ref_no);
		    	$data1 = [ 
		          	'total_item' => $draft->total_item + $_POST['product_quantity'],
		            'created_by' => $loggedInAdmin->id
		        ];
		        $draft->merge_attributes($data1); // merge newly created trans_no and
			    $result2 = $draft->save(); // Save other info into sales table 
			    if ($result2  == true) {
			    	exit(json_encode(['msg' => 'OK']));
			    }else{
			    	exit(json_encode(
			    		['msg' => 'FAIL', 'error' => display_errors($draft->errors)]));
			    }
		 } 
	}

	if($_POST["action"] == 'empty')
	{
		$ref_no = $_POST["ref_no"];
		if ($_POST['from'] == 2) {
			$item = CreditDetails::find_by_ref($ref_no);
		}else{
			$item = DraftDetails::find_by_ref($ref_no);
		}
		// $item = DraftDetails::find_by_ref($ref_no);
		// pre_r($item);
		if (!empty($item)) {
			foreach ($item as $key => $value) {
				if ($_POST['from'] == 2) {
					$each = CreditDetails::find_by_id($value->id);
				}else{
					$each = DraftDetails::find_by_id($value->id);
				}
				
				$result = $each->delete();
			}
			if ($result == true) {
				if ($_POST['from'] == 2) {
					$draft = Credit::find_by_ref($ref_no);
				}else{
					$draft = Draft::find_by_ref($ref_no);
				}
				
				$result2 = $draft->delete();
				if ($result2 == true) {
					exit(json_encode(['msg' => 'OK']));
				}else{
					exit(json_encode(['msg' => 'FAIL']));
				}
			}else{
				exit(json_encode(['msg' => 'DraftDetails Fail']));
			}

		}else{
			exit(json_encode(['msg' => 'empty']));
		}
		
	}
	
	if($_POST["action"] == "delete_draft"){
		$ref_no = $_POST["ref_no"];
		$item = DraftDetails::find_by_ref($ref_no);
		// pre_r($item);

		if (!empty($item)) {
			foreach ($item as $key => $value) {
				$each = DraftDetails::find_by_id($value->id);
				$result = $each->delete();
			}
			if ($result == true) {
				$draft = Draft::find_by_ref($ref_no);
				$result2 = $draft->delete();
				if ($result2 == true) {
					exit(json_encode(['msg' => 'OK']));
				}else{
					exit(json_encode(['msg' => 'FAIL']));
				}
			}else{
				exit(json_encode(['msg' => 'DraftDetails Fail']));
			}

		}else{
			exit(json_encode(['msg' => 'empty']));
		}
	}
}
?>