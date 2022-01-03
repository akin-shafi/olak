<?php
require_once('../../private/initialize.php');

$response = [
	'errors' => null,
	'message' => '',
	'data' => '',
];

if (is_post_request()) {

	if (isset($_POST) && !isset($_POST['update'])) {
		$args = $_POST;
		$company = new Company($args);
		$result = $company->save();
		if ($result == true) {
			exit(json_encode(['message' => 'Company created Successfully', 'success' => true,]));
		} else {
			http_response_code(401);
			$response['errors'] = display_errors($company->errors);
		}
	}

	if (isset($_POST['update'])) {

		if (isset($_POST['companyId'])) {
			$company = Company::find_by_id($_POST['companyId']);

			$args = [
				'company_name' => $_POST['company_name'],
				'registration_no' => $_POST['registration_no'],
			];

			$company->merge_attributes($args);
			$company->save();

			if ($company) :
				http_response_code(200);
				$response['message'] = 'Company updated successfully';
			endif;
		}
	}
}

if (is_get_request()) {
	if (isset($_GET['companyId']) && !isset($_GET['deleted'])) {
		$company = Company::find_by_id($_GET['companyId']);

		http_response_code(200);
		exit(json_encode(['data' => $company]));
	}

	if (isset($_GET['deleted'])) {
		Company::deleted($_GET['companyId']);

		http_response_code(200);
		$response['message'] = 'Record deleted successfully';
	}
}
exit(json_encode($response));
