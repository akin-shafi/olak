<?php require_once('../../../private/initialize.php'); ?>


<?php if (isset($_POST['product_name'])) { 
 
	$args = $_POST['product_name']; 

	  // pre_r($args);
	  for ($i = 0; $i < count($args); $i++) { 
	          $data = [
	          	'order_by' => $_POST['order_by'][$i],
	            'product_name' => $_POST['product_name'][$i],
	            'product_quantity' => $_POST['product_quantity'][$i],
	            'product_price' => $_POST['product_price'][$i],
	            'total_price' => $_POST['total_price'][$i],
	            
	            'created_by' => $loggedInAdmin->id
	          ];
	      $cart = new Order($data);
	      // pre_r($cart);
	      $result = $cart->save();  
	      
	  }
	  if($result === true){
      	echo json_encode(['msg' => 'OK']);
      	unset($_SESSION["shopping_cart"]);
      }else{
      	echo json_encode(['msg' => 'FAIL']);
      }
  		
	 

 }
 ?>

 