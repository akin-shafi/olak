<?php require_once('../../private/initialize.php'); ?>
<?php 
if(isset($_POST["action"])){
	if($_POST["action"] == 'remove')
	{	$id = $_POST["product_id"];
		$item = Sales::find_by_id($id);
		pre_r($id);
		$result = $item->deleted($id);
	}
} 

if(isset($_POST["edit"])){

	if($_POST["edit"] == "edit_quantity"){
		$id = $_POST["product_id"];
		$total = $_POST['product_price'] * $_POST['product_quantity'];
		$data = [
		    'product_quantity' => $_POST["product_quantity"],
            'product_quantity' => $_POST['product_quantity'],
            'unit_price' => $_POST['product_price'],
            'subtotal' => $total,
		];
		$edit =  Sales::find_by_id($id);
		$edit->merge_attributes($data); // merge newly created trans_no and
	    $result = $edit->save();
	   
	}
}
if (isset($_POST["save"])){
 	$args = $_POST;
 	$trans_no = $_POST["trans_no"];
 	$product_id = $_POST['id'];
	for ($i = 0; $i < count($product_id); $i++) {
		$edit =  Sales::find_by_id($product_id[$i]); 
		$data = [
            'product_name' => $_POST['product_name'][$i],
            'quantity' => $_POST['quantity'][$i],
            'unit_price' => $_POST['product_price'][$i],
            'subtotal' => $_POST['total_price'][$i],
		];
		
		$edit->merge_attributes($data);
	    $result = $edit->save();
	}
 	
 	if ($result == true ) {
 		$transaction =  Transaction::find_transaction($trans_no);
 		$data2 = [
		    'total_item' => $_POST["total_item"],
            'quantity_in_item' => $_POST['quantity_in_item'],
            'cost_of_item' => $_POST['gtotal'],
            'total_paid' => $_POST['gtotal'],
		];
		$transaction->merge_attributes($data2); 
		$result2 = $transaction->save();
		// pre_r($transaction);
		if ($result2 == true ) {
			exit(json_encode(['msg' => 'OK']));
		}
 	}
 	
	
}
?>