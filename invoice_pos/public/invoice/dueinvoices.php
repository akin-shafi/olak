<?php

require_once('../../private/initialize.php');

require_login();

// Find all undeleted admins
$due = Billing::find_due_date();
// $admins = Admin::find_by_undeleted();

?>
<?php $page = 'Invoice';
$page_title = 'Due Invoices'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


	<!-- Page header start -->
	<div class="page-title">
		<div class="row gutters">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<h5 class="title">All Invoices</h5>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="daterange-container">
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
				</div>
			</div>
		</div>
	</div>
	<!-- Page header end -->


	<!-- Content wrapper start -->
	<div class="content-wrapper">

		<section class="">
			<div class="row">


				<div class="col-lg-2 ">
					<?php include('sideNav.php'); ?>
				</div>
				<!--col-2 end -->

				<?php echo display_session_message(); ?>

				<div class="col-lg-10">
					<div class="table-responsive">
						<table id="rowSelection" class=" table table-striped table-hover responsive nowrap" style="width:100%">
							<thead>
								<tr class="border-bottom bg-primary">
									<th><i class="uk-icon-square"></i></th>
									<th>S/N</th>
									<th>Action</th>
									<th>Invoice No.</th>
									<th>Client Name</th>
									<th>Billing Format</th>
									<th>Start Date</th>
									<th>Due Date</th>
									<th>Total Amount</th>
									<!-- <th>Part Payment</th> -->
									<!-- <th>Balance</th> -->

								</tr>
							</thead>
							<tbody>
								<?php $sn = 0;
								foreach ($due as $client) { ?>
									<tr>
										<td><input type="checkbox" name=""></td>
										<td><?php echo ++$sn; ?></td>
										<td>
											<!-- <i class="btn btn-sm p-1 fs-12 btn-outline-dark  uk-icon-pencil" data-toggle="modal" data-target=".myModal"></i> -->
											<a href="<?php echo url_for('admin/timing_billing/invoice.php?id=' . h(u($client->id))); ?>">
												<i class="btn btn-sm p-1 fs-12 btn-outline-dark  uk-icon-expand" title="view"></i>
											</a>
										</td>
										<td><?php echo h(ucwords($client->invoiceNum)); ?></td>
										<td><?php echo isset($client->client_name) ? h(ucwords($client->client_name)) : 'Not Set'; ?></td>
										<td><?php echo h(ucwords($client->billingFormat)); ?></td>
										<td><?php echo h(ucwords($client->start_date)); ?></td>
										<td><?php echo h(ucwords($client->due_date)); ?></td>
										<td><?php echo h(ucwords($client->total_amount)); ?></td>
										<!-- <td><?php //echo h(ucwords($client->part_payment)); 
															?></td> -->
										<!-- <td><?php //echo h(ucwords($client->balance)); 
															?></td> -->

									</tr>
								<?php } ?>
							</tbody>
						</table>

					</div>
					<!-- <div class="btn-group">
							<div class="btn btn-danger btn-sm">Clear Check</div>
						</div> -->
				</div>
			</div>
		</section>

	</div>
	<!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->

<?php include(SHARED_PATH . '/admin_footer.php');
?>