<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'Add Sales';

include(SHARED_PATH . '/admin_header.php');

?>

<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			<div class="card">
				<div class="card-body">
					<div class="table-container border-0 shadow">
						<?php if (isset($message)) : ?>
							<div class="alert alert-success justify-content-center">
								<?php echo $message ?? ''; ?>
							</div>
						<?php endif; ?>
						<div class="table-responsive" id="sales_list">
							
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
	$(document).ready(function() {
		const SALES_URL = 'inc/process.php';

		$(document).on('click', '.remove_row', function() {
			let row_id = $(this).attr("id");
			$('#row_id_' + row_id).remove();
			count--;
			$('#total_item').val(count);
		});

		window.onload = () => {
			let branch = $('#fBranch').val()
			let filterDate = $('#filter_date').val()
			getDataSheet(branch, filterDate)
		}

		$(document).on('click', "#query", function() {
			let branch = $('#fBranch').val()
			if (branch == '') {
				alert('Kindly select a branch')
				window.location.reload();
			} else {
				let filterDate = $('#filter_date').val()
				getDataSheet(branch, filterDate)
			}
		})

		const getDataSheet = (branch, fltDate) => {
			$.ajax({
				url: SALES_URL,
				method: "GET",
				data: {
					branch: branch,
					filterDate: fltDate,
					filter: 1
				},
				cache: false,
				beforeSend: function() {
					$('.lds-hourglass').removeClass('d-none');
				},
				success: function(r) {
					$('#sales_list').html(r)
					setTimeout(() => {
						$('.lds-hourglass').addClass('d-none');
					}, 250);
				}
			})
		}

	})
</script>