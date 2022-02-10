<?php
require_once('../private/initialize.php');

$page = 'Dashboard';
$page_title = 'User Dashboard';
include(SHARED_PATH . '/admin_header.php');

?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><strong class="text-right">Last 12 months Income </strong></h3>
					</div>
					<div class="box-body">
						<div id="incomeChart"></div>
					</div>
				</div>
				<div class="box mt-10">
					<div class="box-header with-border">
						<h3 class="box-title">Net Income</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Fiscal year <i class="fa fa-info-circle" data-toggle="tooltip" data-title="Fiscal year start is January 01"></i></th>
										<th>2021</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Income</td>
										<td>€37,128.58</td>
									</tr>
									<tr>
										<td>Expense</td>
										<td>€13669</td>
									</tr>
									<tr>
										<td>Net Income </td>
										<td><strong>€23,459.58</strong></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Upcomming Recurring Payments</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th> Customer</th>
										<th>Total</th>
										<th>Amount Due</th>
										<th>Next Payment</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Richard Brunson</td>
										<td>€8576.00</td>
										<td>€0</td>
										<td>28 Dec 2021</td>
										<td>
											<span class="custom-label-lg label-light-info">Upcomming</span>
										</td>
									</tr>
									<tr>
										<td>frank Rubi</td>
										<td>€185.00</td>
										<td>€185</td>
										<td>24 Jan 2022</td>
										<td>
											<span class="custom-label-lg label-light-info">Upcomming</span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="text-center bt-1 border-light p-10">
						<a class="d-block font-size-14" href="http://accufy.originlabsoft.com/admin/invoice/type/3?recurring=1">All Invoices <i class="fa fa-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Overdue Invoices</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th> Customer</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Alex Smith</td>
										<td>€400.00</td>
									</tr>
									<tr>
										<td>Alex Smith</td>
										<td>€300.00</td>
									</tr>
									<tr>
										<td>Customer USD</td>
										<td>€250.00</td>
									</tr>
									<tr>
										<td>dfdfd</td>
										<td>€1000.00</td>
									</tr>
									<tr>
										<td>Customer USD</td>
										<td>€2500.00</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="text-center bt-1 border-light p-10">
						<a class="d-block font-size-14" href="http://accufy.originlabsoft.com/admin/invoice/type/1">See all overdue invoices <i class="fa fa-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Pending Invoices</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th> Customer</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>keshab</td>
										<td>€500.00</td>
									</tr>
									<tr>
										<td>Viddd</td>
										<td>€800.00</td>
									</tr>
									<tr>
										<td>test customer</td>
										<td>€500.00</td>
									</tr>
									<tr>
										<td>test customer</td>
										<td>€300.00</td>
									</tr>
									<tr>
										<td>Dede</td>
										<td>€400.00</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="text-center bt-1 border-light p-10">
						<a class="d-block font-size-14" href="http://accufy.originlabsoft.com/admin/invoice/type/1">All Invoices <i class="fa fa-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="box hide">
					<div class="box-header with-border">
						<h3 class="box-title">Recently Paid Invoices</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th> Customer</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Alex Smith</td>
										<td>€135.00</td>
									</tr>
									<tr>
										<td>keshab</td>
										<td>€450.00</td>
									</tr>
									<tr>
										<td>John Smith</td>
										<td>€500.00</td>
									</tr>
									<tr>
										<td>test customer</td>
										<td>€400.00</td>
									</tr>
									<tr>
										<td>Popo</td>
										<td>€6840.00</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="text-center bt-1 border-light p-10">
						<a class="d-block font-size-14" href="http://accufy.originlabsoft.com/admin/invoice/type/3">See all paid invoices <i class="fa fa-long-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>