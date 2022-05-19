<?php //require_once('../../private/initialize.php'); 
?>
<?php if (isset($_POST)) {


	session_start();

	echo '<pre>';
	print_r($_POST);
	echo '</pre>';



	unset($_SESSION["return_cart"]);
	for ($i = 0; $i < count($_POST['product_id']); $i++) {
		$data = [
			'trans_no'              	 =>     $_POST['trans_no'][$i],
			'sale_id'               	 =>     $_POST['sale_id'][$i],
			'product_id'               =>     $_POST['product_id'][$i],
			'product_name'             =>     $_POST['product_name'][$i],
			'product_price'            =>     $_POST['product_price'][$i],
			'subtotal'            		 =>     $_POST['subtotal'][$i],
			'product_quantity'         =>     $_POST['product_quantity'][$i],
			'product_tax'         	   =>     $_POST['product_tax'][$i],
			'product_discount'         =>     $_POST['product_discount'][$i],
			'stockUnit'                =>     $_POST['stockUnit'][$i],
		];

		$_SESSION['return_cart'][] = $data;
		// exit(json_encode(['msg' => $data]));
	}
} ?>