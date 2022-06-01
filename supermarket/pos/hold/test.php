<?php require_once('../../private/initialize.php'); ?>
<?php 
if(isset($_POST["action"])){
	if($_POST["action"] == 'remove')
	{	$id = $_POST["product_id"];
		$item = DraftDetails::find_by_id($id);
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
    	
	    	$is_available = 0;
			$all_item =  DraftDetails::find_by_ref($ref_no);
			foreach ($all_item as $keys =>  $value) {
				$product = DraftDetails::find_by_product_id($value->product_id);
				if($keys == $_POST["product_id"])
				{
					$is_available++;
					$data = [
					    'quantity' => $product->quantity + $_POST["product_quantity"]
					];
					$product->merge_attributes($data); // merge newly created trans_no and
				    $result1 = $product->save();
				}
				
			}
			if($is_available == 0){	
				  $data2 = [ 
		          	'ref_no' => $ref_no,
		            'product_id' => $_POST['product_id'],
		            'product_name' => $_POST['product_name'],
		            'quantity' => $_POST['product_quantity'],
		            'product_price' => $_POST['product_price'],
		            'total_price' => $_POST['product_price'] * $_POST['product_quantity'],
		          ];
		         
		         $edit = new DraftDetails($data2);
		         $result1 = $edit->save(); // Save other info into sales table 

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
			
	}
}
?>