<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'All Sales';
include(SHARED_PATH . '/admin_header.php');

$company = Company::find_by_user_id($loggedInAdmin->id);
$branches = Branch::find_all_branch(['company_id' => $company->id]);
$branchArr = [];

foreach ($branches as $value) {
	array_push($branchArr, $value->id);
}

if ($loggedInAdmin->admin_level == 1) {
	$filterDataSheet = DataSheet::get_data_sheets();
} else {
	if (in_array($loggedInAdmin->branch_id, $branchArr)) {
		$filterDataSheet = DataSheet::get_data_sheets(['company' => $loggedInAdmin->company_id, 'branch' => $loggedInAdmin->branch_id]);
	}
}

$products = Product::find_by_undeleted();

?>
<style>
	td {
		min-width: 90px;
		padding: 0.2rem 0.3rem !important;
	}
</style>
<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			<div class="card">
				<div class="card-body">
					<div class="table-container">
						<div class="table-responsive">
							<!-- <table id="copy-print-csv_wrapper" class="table custom-table table-sm "> -->
							<table id="dataSheet" class="table custom-table">

							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
	const PET_URL = 'inc/process.php';

	window.onload = () => {
		let rangeText = $('.range-text').text()
		getDataSheet(rangeText)
	}

	$(document).on('click', ".daterangepicker", function() {
		let rangeText = $('.range-text').text()
		getDataSheet(rangeText)
	})

	const getDataSheet = (payload) => {
		$.ajax({
			url: PET_URL,
			method: "GET",
			data: {
				rangeText: payload,
				filter: 1
			},
			cache: false,
			beforeSend: function() {
				$('.lds-hourglass').removeClass('d-none');
			},
			success: function(r) {
				$('#dataSheet').html(r)
				setTimeout(() => {
					$('.lds-hourglass').addClass('d-none');
				}, 250);
			}
		})
	}
</script>