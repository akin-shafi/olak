<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'All Sales';
include(SHARED_PATH . '/admin_header.php');

if ($access->sales_mgt != 1) {
	redirect_to('../dashboard/');
}

if ($loggedInAdmin->admin_level == 1) {
	$filterDataSheet = DataSheet::get_data_sheets();
} else {
	$filterDataSheet = DataSheet::get_data_sheets(['company' => $loggedInAdmin->company_id, 'branch' => $loggedInAdmin->branch_id]);
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
					<div class="table-container border-0 shadow">
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
		let branch = $('#fBranch').val()
		let rangeText = $('.range-text').text()
		getDataSheet(branch, rangeText)
	}

	$(document).on('click', "#query", function() {
		let branch = $('#fBranch').val()
		if (branch == '') {
			alert('Kindly select a branch')
		} else {
			let rangeText = $('.range-text').text()
			getDataSheet(branch, rangeText)
		}
	})

	const getDataSheet = (branch, range) => {
		$.ajax({
			url: PET_URL,
			method: "GET",
			data: {
				branch: branch,
				rangeText: range,
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



	$(document).on('click', '.remove-btn', function() {
		let dataSheetId = this.dataset.id;
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: PET_URL,
					method: "POST",
					data: {
						dataSheetId: dataSheetId,
						delete_tank: 1
					},
					dataType: 'json',
					success: function(data) {
						Swal.fire(
							'Deleted!',
							data.msg,
							'success'
						)
						setTimeout(() => {
							window.location.reload()
						}, 1000);
					}
				});

			}
		})

	});
</script>