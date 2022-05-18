<?php

require_once('../../private/initialize.php');

require_login();

$clients = Billing::find_by_undeleted();
$companies = Company::find_by_undeleted();
// $branches = Branch::find_by_company_id($companyId);

?>
<?php $page = 'Invoice';
$page_title = 'All Invoices'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div class="main-container">
	<div class="page-title">
		<div class="row gutters">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<h5 class="title">All Invoices</h5>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

				<div class="d-flex justify-content-end align-items-center">
					<div class="btn-group">
						<select class="form-control mr-2" id="company">
							<option value="">Select company</option>
							<?php foreach ($companies as $company) : ?>
								<option value="<?php echo $company->id ?>">
									<?php echo ucwords($company->company_name) ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="btn-group" id="get_branch">
						<select class="form-control" id="branch">
							<option value="">Select branch</option>
						</select>
						<button class="btn btn-primary query">
							<i class="feather-filter"></i></button>
					</div>

					<!-- <div class="daterange-container">
						<div class="date-range">
							<div id="reportrange">
								<i class="feather-calendar cal"></i>
								<span class="range-text">Jan 20, 2020 - Feb 18, 2020</span>
								<i class="feather-chevron-down arrow"></i>
							</div>
						</div>
						<a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
							<i class="feather-download"></i>
						</a>
					</div> -->
				</div>
			</div>
		</div>
	</div>

	<div class="content-wrapper">

		<section class="">
			<?php echo display_session_message(); ?>
			<div class="row">

				<div class="col-lg-2 ">
					<?php include('sideNav.php'); ?>
				</div>

				<div class="col-lg-10">
					<div class="table-responsive" id="complete_filter">

					</div>
					<!-- <div class="btn-group">
							<div class="btn btn-danger btn-sm">Clear Check</div>
						</div> -->
				</div>
			</div>
		</section>

	</div>


</div>

<?php include(SHARED_PATH . '/admin_footer.php');
?>

<script>
	$(document).ready(function() {
		const FILTER_URL = "inc/filter.php";

		$('#company').on('change', function() {
			let companyId = this.value;
			getBranches(companyId)
		})

		function getBranches(params) {
			$.ajax({
				url: FILTER_URL,
				method: "GET",
				data: {
					comp_id: params
				},
				success: function(r) {
					$('#get_branch').html(r);
				}
			});
		}

		$(document).on('click', '.query', function() {
			let companyId = $('#company').val()
			let branchId = $('#branch').val()

			if ((companyId == '') || (branchId == '')) {
				errorAlert('Company and branch is required!')
				return
			}

			completeFilter(companyId, branchId)
		})

		function completeFilter(companyId, branchId) {
			$.ajax({
				url: FILTER_URL,
				method: "GET",
				data: {
					companyId: companyId,
					branchId: branchId,
					complete_filter: 1
				},
				success: function(r) {
					$('#complete_filter').html(r);
				}
			});
		}
		completeFilter()

		$(document).on('click', '#delete_void', function() {
			let deleteVoid = this.dataset.id;
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
						url: "inc/index.php",
						method: "POST",
						data: {
							id: deleteVoid,
							delete_void: 1
						},
						dataType: 'json',
						success: function(data) {
							Swal.fire(
								'Deleted!',
								data.msg,
								'success'
							)
						}
					});
				}
			}).then(() => window.location.reload())

		});
	})
</script>