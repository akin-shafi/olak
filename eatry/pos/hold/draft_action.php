<?php //require_once('../../private/initialize.php'); ?>
<?php if(isset($_POST)){ 
 

  session_start();

  unset($_SESSION["hold_cart"]);
  	for ($i= 0; $i < count($_POST['product_id']); $i++) { 
		$data = [
				'product_id'               =>     $_POST['product_id'][$i],  
				'product_name'             =>     $_POST['product_name'][$i],  
				'product_price'            =>     $_POST['product_price'][$i],  
				'product_quantity'         =>     $_POST['product_quantity'][$i],
				'product_tax'         	   =>     $_POST['product_tax'][$i],
				'product_discount'         =>     $_POST['product_discount'][$i],
				'stockUnit'                =>     $_POST['stockUnit'][$i],

		];
		// print_r($data);
		$_SESSION['hold_cart'][] = $data;
		// exit(json_encode(['msg' => $data]));
	}
  	

} ?>