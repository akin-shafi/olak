<?php

require_once('../../private/initialize.php');

require_login();

// Find all undeleted admins
$clients = Billing::find_by_undeleted();
// $admins = Admin::find_by_undeleted();

?>
<?php $page = 'Invoice'; $page_title = 'All Invoices'; ?>
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
			<?php echo display_session_message(); ?>
			<div class="row">

				<div class="col-lg-2 ">
					<?php include('sideNav.php'); ?>
				</div>
				<!--col-2 end -->

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

								</tr>
							</thead>
							<tbody>
								<?php $sn = 0;
								foreach (Billing::find_by_undeleted() as $client) { 
								 $customer = Client::find_by_id($client->client_id);
								 // pre_r();
								 // pre_r($client->client_id);
								?>
									<tr>
										<td><input type="checkbox" name=""></td>
										<td><?php echo ++$sn; ?></td>
										<td>
											<a href="<?php echo url_for('invoice/invoice.php?invoice_no=' . h(u($client->invoiceNum))); ?>">
												<i class="feather-file-text fs-18" title="view"></i> Invoice
											</a>
										</td>
										<td><?php echo h(ucwords($client->invoiceNum)); ?></td>
										<td><?php echo $customer->full_name(); ?></td>
										<td><?php echo h(ucwords($client->billingFormat)); ?></td>
										<td><?php echo h(ucwords($client->start_date)); ?></td>
										<td><?php echo h(ucwords($client->due_date)); ?></td>
										<td><?php echo h(ucwords($client->total_amount)); ?></td>
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