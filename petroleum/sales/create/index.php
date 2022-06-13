<?php require_once('../../private/initialize.php');

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
							<?php if (!empty(is_array($session->message()))) :
								echo display_errors($session->message());
							endif; ?>
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
				<h5 class="modal-title">Enter Value</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
			</div>

			<div id="form_fields"></div>

		</div>
	</div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
	$(document).ready(function() {
		const SALES_URL = '../inc/process.php';

		$(document).on('click', '.dip', function() {
			let dip = this.dataset.id
			let sheetId = this.dataset.sheetId

			getFormFields(dip, sheetId)

			$('#dipModal').modal('show');
		})

		$(document).on('click', "#query", function() {
			let selectedDate = $('.range-text').text()
			let branch = $('#filter-branch').val()

			if (branch == '') {
				alert('Kindly select a branch')
			} else {
				getDataSheet(branch, selectedDate)
			}
		})

		const getFormFields = (productId, sheetId) => {
			$.ajax({
				url: SALES_URL,
				method: "GET",
				data: {
					dipPID: productId,
					sheetId: sheetId,
					get_form_fields: 1
				},
				cache: false,
				success: function(r) {
					$('#form_fields').html(r)
				}
			})
		}

		const getDataSheet = (branch, date) => {
			$.ajax({
				url: SALES_URL,
				method: "GET",
				data: {
					branch: branch,
					rangeText: date,
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


		let selectedDate = $('.range-text').text()
		let branch = $('#filter-branch').val()
		getDataSheet(branch, selectedDate)
	})
</script>