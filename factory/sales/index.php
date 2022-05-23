<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'All Sales';
include(SHARED_PATH . '/admin_header.php');

if ($access->sales_mgt != 1) {
	redirect_to('../dashboard/');
}

$phase = (isset($_GET['phase']) && $_GET['phase'] == 2) ? 'process_two.php' : 'process_one.php';


$products = Product::find_by_undeleted();

?>

<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			<div class="card">
				<div class="card-body">
					<div class="table-container border-0 shadow">

						<div class="text-center my-3">
							<div class="btn-group" role="group">
								<a href="<?php echo url_for('/sales/?phase=1') ?>" class="btn btn-outline-info">
									Phase One Sales</a>
								<a class="btn btn-dark text-white">
									&LeftArrowRightArrow;</a=>
									<a href="<?php echo url_for('/sales/?phase=2') ?>" class="btn btn-outline-info">
										Phase Two Sales</a>
							</div>
						</div>

						<div class="table-responsive" id="dataSheet">
							<!-- <table id="copy-print-csv_wrapper" class="table custom-table table-sm "> -->

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
	const PHASE_URL = 'inc/<?php echo $phase; ?>';

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
			url: PHASE_URL,
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
		let stockId = this.dataset.id;
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
					url: PHASE_URL,
					method: "POST",
					data: {
						stockId: stockId,
						delete_stock: 1
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