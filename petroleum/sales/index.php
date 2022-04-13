<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'All Sales';
include(SHARED_PATH . '/admin_header.php');

$array = ['Rate', 'open stock', 'new stock'];

$dataSheets = DataSheet::get_data_sheets();
$products = Product::find_by_undeleted();

?>

<!-- Content wrapper start -->
<div class="content-wrapper">
	<!-- Row start -->
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
	<!-- Row end -->

</div>
<!-- Content wrapper end -->



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
	const PET_URL = 'inc/process.php';

	// $(document).on('click', ".applyBtn", function() {
	// 	let dateRange = $('.drp-selected').text()
	// 	console.log(dateRange);
	// })


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