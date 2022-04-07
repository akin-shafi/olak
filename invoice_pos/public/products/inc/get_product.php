<?php require_once('../../../private/initialize.php'); ?>
<?php 
	$primaryKey = 'code';
	$product = Product::find_by_undeleted();
	// header('Content-Type: application/json');
	$response = json_encode([
		"draw"=>1, 
		"recordsTotal"=> count($product), 
		"recordsFiltered"=>count($product), 
		"data" => $product,
		"input" => []
	]); 
	// $response = json_encode($product);
	echo $response;


?>