<?php 
require_once('../../private/initialize.php'); 

if (isset($_POST)) {
	$args = $_POST;
	$company = new Company($args);
	$result = $company->save();
	if ($result == true) {
			exit(json_encode(['msg' => 'Created Successful', 'success' => true, ]));
	}else{
		exit(json_encode(['msg' => display_errors($company->errors), 'success' => false ]));
	}
}
?>