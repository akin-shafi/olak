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

						<div style="width:100%;max-width:270px;margin:auto;">
							<?php if (!empty(is_array($session->message()))) : ?>
								<?php echo display_errors($session->message()); ?>
							<?php else : ?>
								<?php echo display_session_message(); ?>
							<?php endif; ?>
						</div>

						<div class="table-responsive" id="sales_list">

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>

<div class="modal fade" id="dipModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Enter Dip</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
			</div>

			<?php include('./form_fields.php'); ?>
		</div>
	</div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
	$(document).ready(function() {
		const SALES_URL = 'inc/process.php';

		$(document).on('click', '.dip', function() {
			let dip = this.dataset.id
			let sheetId = this.dataset.sheetId

			if (dip) {
				$('#product_id').val(dip)
			} else {
				$('#sheet_id').val(sheetId)
			}
			$('#dipModal').modal('show');
		})


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