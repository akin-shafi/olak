<?php
require_once('../../private/initialize.php');

//action.php

// session_start();

if (isset($_POST["action"])) {
	if ($_POST["action"] == "add") {
		if (isset($_SESSION["return_cart"])) {
			$is_available = 0;
			foreach ($_SESSION["return_cart"] as $keys => $values) {
				if ($_SESSION["return_cart"][$keys]['product_id'] == $_POST["product_id"]) {
					$is_available++;
					$_SESSION["return_cart"][$keys]['product_quantity'] = $_SESSION["return_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
				}
			}

			if ($is_available == 0) {
				$item_array = array(
					'product_id'               =>     $_POST["product_id"],
					'product_name'             =>     $_POST["product_name"],
					'product_price'            =>     $_POST["product_price"],
					'product_quantity'         =>     $_POST["product_quantity"],
					'product_tax'         	   =>     $_POST["product_tax"],
					'product_discount'         =>     $_POST["product_discount"],
					'stockUnit'                =>     $_POST["stockUnit"],
					'edit_item'                =>     $_POST["edit_item"] ?? '',
				);
				$_SESSION["return_cart"][] = $item_array;
			}
		} else {
			$item_array = array(
				'product_id'          =>    $_POST["product_id"],
				'product_name'        =>    $_POST["product_name"],
				'product_price'       =>    $_POST["product_price"],
				'product_quantity'    =>    $_POST["product_quantity"],
				'product_tax'        	=>    $_POST["product_tax"],
				'product_discount'    =>    $_POST["product_discount"],
				'stockUnit'           =>    $_POST["stockUnit"],
				'edit_item'           =>    $_POST["edit_item"],
			);
			$_SESSION["return_cart"][] = $item_array;
		}
	}

	if ($_POST["action"] == 'remove') {
		foreach ($_SESSION["return_cart"] as $keys => $values) {
			if ($values["product_id"] == $_POST["product_id"]) {
				$sales = Sales::find_by_id($values['sale_id']);

				$deleted = $sales::deleted($sales->id);

				if ($deleted) {
					$productIdFromSales = $sales->product_id;
					$productQuantityFromSales = $sales->product_quantity;
					$product = Product::find_by_id($productIdFromSales);

					$productQuantityLeft 			= $product->quantity + $productQuantityFromSales;
					$totalProductQuantitySold = $product->sold_bottle - $productQuantityFromSales;

					$productData = [
						'quantity' => $productQuantityLeft,
						'sold_bottle' => $totalProductQuantitySold,
					];

					$product->merge_attributes($productData);
					$productResult = $product->save();

					if ($productResult == true) {
						$stock = StockDetails::find_by_ref($product->ref_no);

						$stockData = [
							'sold_stock' => $product->sold_bottle,
							'qty_left' => $product->quantity,
							'updated_by' => $loggedInAdmin->id,
							'updated_at' => date('Y-m-d H:i:s'),
						];

						$stock->merge_attributes($stockData);
						$stockResult = $stock->save();
					}
				}


				unset($_SESSION["return_cart"][$keys]);
			}
		}
	}

	if ($_POST["action"] == 'empty') {
		unset($_SESSION["return_cart"]);
	}
}

if (isset($_POST["edit"])) {

	if (isset($_POST["action"]) && $_POST["action"] == 'remove') {
		foreach ($_SESSION["return_cart"] as $keys => $values) {
			if ($values["product_id"] == $_POST["product_id"]) {
				unset($_SESSION["return_cart"][$keys]);
			}
		}
	}

	if (isset($_POST["action"]) && $_POST["action"] == 'empty') {
		unset($_SESSION["return_cart"]);
	}

	if ($_POST["edit"] == "edit_quantity") {
		if (isset($_SESSION["return_cart"])) {
			$is_available = 0;
			foreach ($_SESSION["return_cart"] as $keys => $values) {
				if ($_SESSION["return_cart"][$keys]['product_id'] == $_POST["product_id"]) {
					$is_available++;
					$_SESSION["return_cart"][$keys]['product_quantity'] = $_POST["product_quantity"];
				}
			}
			if ($is_available == 0) {
				$item_array = array(
					'product_id'               =>     $_POST["product_id"],
					'product_name'             =>     $_POST["product_name"],
					'product_price'            =>     $_POST["product_price"],
					'product_quantity'         =>     $_POST["product_quantity"],
					'product_tax'         	   =>     $_POST["product_tax"],
					'stockUnit'                =>     $_POST["stockUnit"],
					'edit_item'                =>     $_POST["edit_item"],
				);
				$_SESSION["return_cart"][] = $item_array;
			}
		} else {
			$item_array = array(
				'product_id'               =>     $_POST["product_id"],
				'product_name'             =>     $_POST["product_name"],
				'product_price'            =>     $_POST["product_price"],
				'product_quantity'         =>     $_POST["product_quantity"],
				'product_tax'         	   =>     $_POST["product_tax"],
				'stockUnit'                =>     $_POST["stockUnit"],
				'edit_item'                =>     $_POST["edit_item"],
			);
			$_SESSION["return_cart"][] = $item_array;
		}
	}

	if ($_POST["edit"] == "edit_product") {
		if (isset($_SESSION["return_cart"])) {
			$is_available = 0;
			foreach ($_SESSION["return_cart"] as $keys => $values) {
				if ($_SESSION["return_cart"][$keys]['product_id'] == $_POST["product_id"]) {
					$is_available++;
					$_SESSION["return_cart"][$keys]['product_quantity'] = $_POST["product_quantity"];
				}
			}
			if ($is_available == 0) {
				$item_array = array(
					'product_id'               =>     $_POST["product_id"],
					'product_name'             =>     $_POST["product_name"],
					'product_price'            =>     $_POST["product_price"],
					'product_quantity'         =>     $_POST["product_quantity"],
					'product_tax'         	   =>     $_POST["product_tax"],
					'product_discount'         =>     $_POST["product_discount"],
					'stockUnit'                =>     $_POST["stockUnit"],
					'edit_item'                =>     $_POST["edit_item"],
				);
				$_SESSION["return_cart"][] = $item_array;
			}
		} else {
			$item_array = array(
				'product_id'               =>     $_POST["product_id"],
				'product_name'             =>     $_POST["product_name"],
				'product_price'            =>     $_POST["product_price"],
				'product_quantity'         =>     $_POST["product_quantity"],
				'product_tax'         	   =>     $_POST["product_tax"],
				'product_discount'         =>     $_POST["product_discount"],
				'stockUnit'                =>     $_POST["stockUnit"],
				'edit_item'                =>     $_POST["edit_item"],
			);
			$_SESSION["return_cart"][] = $item_array;
		}
	}
}
