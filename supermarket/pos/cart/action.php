<?php

//action.php

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		
		if(isset($_SESSION["shopping_cart"]))
		{
			$is_available = 0;
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{ 
				if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])
				{
					$is_available++;
					if($_SESSION["shopping_cart"][$keys]['product_quantity'] >= $_POST["leftover"]){
						
						exit('low');
					}else{
						$_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
					}
				}
			}
			if($is_available == 0)
			{
				$item_array = array(
					'product_id'               =>     $_POST["product_id"],  
					'product_name'             =>     $_POST["product_name"],  
					'product_price'            =>     $_POST["product_price"],  
					'product_quantity'         =>     $_POST["product_quantity"],
					'product_tax'         	   =>     $_POST["product_tax"],
					'product_discount'         =>     $_POST["product_discount"],
					'leftover'        		   =>     $_POST["leftover"],
				);
				
				if($_POST["product_quantity"] >= $_POST["leftover"]){
					exit('low');
				}else{
					$_SESSION["shopping_cart"][] = $item_array;
					
				}
				
				
				
			}
		}
		else
		{
			$item_array = array(
				'product_id'               =>     $_POST["product_id"],  
				'product_name'             =>     $_POST["product_name"],  
				'product_price'            =>     $_POST["product_price"],  
				'product_quantity'         =>     $_POST["product_quantity"],
				'product_tax'         	   =>     $_POST["product_tax"],
				'product_discount'         =>     $_POST["product_discount"],
				'leftover'         	       =>     $_POST["leftover"],
			);
			
			if($_POST["product_quantity"] > $_POST["leftover"]){
				exit('low');
			}else{
				$_SESSION["shopping_cart"][] = $item_array;
			}
		}
	}

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["product_id"] == $_POST["product_id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["shopping_cart"]);
	}


}

if(isset($_POST["edit"]))
{
	

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["product_id"] == $_POST["product_id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["shopping_cart"]);
	}

	if($_POST["action"] == "edit_quantity")
	{
		if(isset($_SESSION["shopping_cart"]))
		{
			$is_available = 0;
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
				if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])
				{
					$is_available++;
					if($_SESSION["shopping_cart"][$keys]['product_quantity'] >= $_POST["leftover"]){
						
						exit('low');
					}else{
						$_SESSION["shopping_cart"][$keys]['product_quantity'] = $_POST["product_quantity"];
					}
					
				}
			}
			if($is_available == 0)
			{
				$item_array = array(
					'product_id'               =>     $_POST["product_id"],  
					'product_name'             =>     $_POST["product_name"],  
					'product_price'            =>     $_POST["product_price"],  
					'product_quantity'         =>     $_POST["product_quantity"],
					'product_tax'         	   =>     $_POST["product_tax"],
				);
				if($_POST["product_quantity"] >= $_POST["leftover"]){
					exit('low');
				}else{
					$_SESSION["shopping_cart"][] = $item_array;
				}
			}
		}
		else
		{
			$item_array = array(
				'product_id'               =>     $_POST["product_id"],  
				'product_name'             =>     $_POST["product_name"],  
				'product_price'            =>     $_POST["product_price"],  
				'product_quantity'         =>     $_POST["product_quantity"],
				'product_tax'         	   =>     $_POST["product_tax"],
			);
			if($_POST["product_quantity"] >= $_POST["leftover"]){
					exit('low');
			}else{
					$_SESSION["shopping_cart"][] = $item_array;
			}
		}
	}

	// if($_POST["edit"] == "edit_product")
	// {
	// 	if(isset($_SESSION["shopping_cart"]))
	// 	{
	// 		$is_available = 0;
	// 		foreach($_SESSION["shopping_cart"] as $keys => $values)
	// 		{
	// 			if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])
	// 			{
	// 				$is_available++;
	// 				$_SESSION["shopping_cart"][$keys]['product_quantity'] = $_POST["product_quantity"];
	// 			}
	// 		}
	// 		if($is_available == 0)
	// 		{
	// 			$item_array = array(
	// 				'product_id'               =>     $_POST["product_id"],  
	// 				'product_name'             =>     $_POST["product_name"],  
	// 				'product_price'            =>     $_POST["product_price"],  
	// 				'product_quantity'         =>     $_POST["product_quantity"],
	// 				'product_tax'         	   =>     $_POST["product_tax"],
	// 				'product_discount'         =>     $_POST["product_discount"],
	// 			);
				
	// 			$_SESSION["shopping_cart"][] = $item_array;
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$item_array = array(
	// 			'product_id'               =>     $_POST["product_id"],  
	// 			'product_name'             =>     $_POST["product_name"],  
	// 			'product_price'            =>     $_POST["product_price"],  
	// 			'product_quantity'         =>     $_POST["product_quantity"],
	// 			'product_tax'         	   =>     $_POST["product_tax"],
	// 			'product_discount'         =>     $_POST["product_discount"],
	// 		);
	// 		$_SESSION["shopping_cart"][] = $item_array;
	// 	}
	// } 

	
}

?>