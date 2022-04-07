<?php require_once('../../../private/initialize.php'); ?>
<?php 
	// pre_r($_POST);
	
 ?>

<?php if (isset($_POST['type'])) {  
	$args = $_POST;
	$product = new Product($args);

	$data = [
        'image' => array_filter($_FILES['file']['name']),
        'created_by' => $loggedInAdmin->id
    ];

    $product->merge_attributes($data);

	pre_r($args);
}
	// $result = $product->save();
	// exit(json_encode(['msg' => 'OK', 'foodName' => $product->foodName]));

	// $food = $_POST['type']; 
	//   for ($i = 0; $i < count($food); $i++) { 
	//           $data = [
	//             'foodCategory' => $_POST['foodCategory'][$i],
	//             'foodName' => $_POST['foodName'][$i],
	//             'foodDescription' => $_POST['foodDescription'][$i],
	//             'foodPrice' => $_POST['foodPrice'][$i],
	//             'created_by' => $loggedInAdmin->id
	//           ];
	//       $foodMenu = new Product($data);
	//       // pre_r($foodMenu);
	//       $result = $foodMenu->save();
	      
	//   }
	// exit(json_encode(['msg' => 'OK', 'foodName' => $foodMenu->foodName]));
	 
	// }
?>