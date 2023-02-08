<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'List Sales';

include(SHARED_PATH . '/admin_header.php'); ?>

<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			<div class="card">
				<div class="card-body">
					<div class="table-container border-0 shadow" id="list-sales">

					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		const SALES_URL = 'inc/process.php';

		$(document).on('click', "#query", function() {
			let selectedDate = $('.range-text').text()
			let branch = $('#filter-branch').val()
			getExpenses(branch, selectedDate)
		})

		const getExpenses = (branch, date) => {
			$.ajax({
				url: SALES_URL,
				method: "GET",
				data: {
					branch: branch,
					rangeText: date,
					filter: 1
				},
				success: function(r) {
					$('#list-sales').html(r)
				}
			})
		}

		let selectedDate = $('.range-text').text()
		let branch = $('#filter-branch').val()
		getExpenses(branch, selectedDate)
	})
</script>