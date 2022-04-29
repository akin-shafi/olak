<?php require_once('../private/initialize.php');

$page = 'Home';
$page_title = 'Sales Dashboard';
include(SHARED_PATH . '/admin_header.php');

$metricProfit = [];
$metricSales = [];
$metricExpenses = [];
$metricMonth = [];

$sales = DataSheet::find_by_metrics();
$expenses = Expense::find_by_metrics();

foreach ($sales as $value) {
	$abrMonth = date('M', strtotime('01-' . $value->month . date('-Y')));
	array_push($metricSales, $value->inflow);
	array_push($metricMonth, $abrMonth);
}

foreach ($expenses as $value) {
	array_push($metricExpenses, $value->outflow);
}

for ($i = 0; $i < count($metricSales); $i++) {
	$sal = intval($metricSales[$i]);
	$exp = intval($metricExpenses[$i]);
	$pro = $sal - $exp;
	array_push($metricProfit, $pro);
}

$impSales = implode(',',  $metricSales);
$impExpenses = implode(',',  $metricExpenses);
$impProfit = implode(',',  $metricProfit);

$impMonth = implode('","',  $metricMonth);

$inflow = $impSales;
$outflow = $impExpenses;
$profit = $impProfit;
$month = '"' . $impMonth . '"';

?>



<!-- Content wrapper start -->
<div class="content-wrapper">
	<h3>Welcome to Olak Petroleum</h3>

	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="row gutters">
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="info-tiles">
						<div class="info-icon">
							<i class="icon-account_circle"></i>
						</div>
						<div class="stats-detail">
							<h3>185k</h3>
							<p>Active Users</p>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="info-tiles">
						<div class="info-icon">
							<i class="icon-watch_later"></i>
						</div>
						<div class="stats-detail">
							<h3>450</h3>
							<p>Active Agents</p>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="info-tiles">
						<div class="info-icon">
							<i class="icon-visibility"></i>
						</div>
						<div class="stats-detail">
							<h3>7500</h3>
							<p>Visitors</p>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="info-tiles">
						<div class="info-icon">
							<i class="icon-shopping_basket"></i>
						</div>
						<div class="stats-detail">
							<h3>$300k</h3>
							<p>Sales</p>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="info-tiles">
						<div class="info-icon secondary">
							<i class="icon-check_circle"></i>
						</div>
						<div class="stats-detail">
							<h3>250</h3>
							<p>Signups</p>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="info-tiles">
						<div class="info-icon secondary">
							<i class="icon-archive"></i>
						</div>
						<div class="stats-detail">
							<h3>2500</h3>
							<p>Orders</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<h3 class=""><span class="badge badge-primary">Data Analysis</span></h3>
		</div>

		<div class="card-body">
			<div class="row gutters">
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">

					<div id="consolidated-bar-chart"></div>

					<div class="row gutters justify-content-center">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="info-stats m-0">
								<span class="info-label"></span>
								<p class="info-title">Profit</p>
								<h3 class="info-total"><?php echo $currency; ?>
									<?php echo !empty($metricProfit) ? number_format(array_sum($metricProfit)) : '0.00' ?>
								</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="info-stats m-0">
								<span class="info-label" style="border: 2px solid rgb(46, 41, 78);"></span>
								<p class="info-title">Revenue</p>
								<h3 class="info-total"><?php echo $currency; ?>
									<?php echo !empty($metricSales) ? number_format(array_sum($metricSales)) : '0.00' ?>
								</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="info-stats m-0">
								<span class="info-label secondary"></span>
								<p class="info-title">Expenses</p>
								<h3 class="info-total"><?php echo $currency; ?>
									<?php echo !empty($metricExpenses) ? number_format(array_sum($metricExpenses)) : '0.00' ?>
								</h3>
							</div>
						</div>
					</div>

					<!-- <div class="barChartOrders"></div> -->
					<!-- <div class="barChart"></div> -->
					<!-- <div id="basic-area-spline-graph"></div> -->
					<!-- <div id="basic-bar-graph"></div> -->
					<!-- <div id="basic-column-graph-datalables"></div>//? qualified -->
					<!-- <div id="basic-column-graph-rotated-labels"></div> -->
					<!-- <div id="basic-donut-graph-gradient"></div>//? Qualified -->
					<!-- <div id="basic-donut-graph-monochrome-gradient"></div>//? More Qualified -->
					<!-- <div id="basic-pie-graph-gradient"></div>//? Qualified -->
					<!-- <div id="basic-pie-graph-monochrome-gradient"></div>//? More Qualified -->


				</div>

				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
					<div id="basic-pie-graph-gradient"></div>
				</div>
			</div>
		</div>
	</div>

	<!-- <div class="row gutters">
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
			<div class="card h-420">
				<div class="card-header">
					<div class="card-title">Visitors</div>
				</div>
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-xl-10">
							<div id="world-map-markers2" class="chart-height-md1"></div>
						</div>
					</div>
					<div class="row gutters justify-content-center">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
							<div class="info-stats">
								<span class="info-label"></span>
								<p class="info-title">Visitors</p>
								<h3 class="info-total">9000</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
							<div class="info-stats">
								<span class="info-label"></span>
								<p class="info-title">Bookings</p>
								<h3 class="info-total">8000</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
							<div class="info-stats">
								<span class="info-label secondary"></span>
								<p class="info-title">Cancellations</p>
								<h3 class="info-total">75</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
			<div class="card h-420">
				<div class="card-header">
					<div class="card-title">Reports</div>
				</div>
				<div class="card-body">
					<div class="chartist threshold-scheme">
						<div class="thresholdChart"></div>
					</div>
					<div class="row gutters">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
							<div class="overall-earnings">
								<div class="earnings-icon">
									<i class="icon-local_airport"></i>
								</div>
								<div class="earnings-stats">
									<p>Flights</p>
									<h3>$75,000</h3>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
							<div class="overall-earnings">
								<div class="earnings-icon dark">
									<i class="icon-star"></i>
								</div>
								<div class="earnings-stats">
									<p>Hotels</p>
									<h3>$95,000</h3>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
							<div class="overall-earnings">
								<div class="earnings-icon secondary">
									<i class="icon-local_taxi"></i>
								</div>
								<div class="earnings-stats">
									<p>Taxi</p>
									<h3>$32,000</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<!-- <div class="row gutters">
		<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
			<div class="card h-320">
				<div class="card-header">
					<div class="card-title">Messages</div>
				</div>
				<div class="card-body">
					<div class="customScroll5">
						<ul class="user-messages">
							<li class="clearfix">
								<div class="customer">AM</div>
								<div class="delivery-details">
									<span class="badge badge-primary">Ordered</span>
									<h5>Aaleyah Malik</h5>
									<p>We are pleased to inform that the following ticket no. <b>WAFI510</b> have been booked.</p>
								</div>
							</li>
							<li class="clearfix">
								<div class="customer">AS</div>
								<div class="delivery-details">
									<span class="badge badge-primary">Delivered</span>
									<h5>Ali Sayed</h5>
									<p>The carrier successfully delivered the message to the end user.</p>
								</div>
							</li>
							<li class="clearfix">
								<div class="customer">ZR</div>
								<div class="delivery-details">
									<span class="badge badge-primary">Cancelled</span>
									<h5>Zaira Raheem</h5>
									<p>The following describe the status codes and messages states for delivery receipts.</p>
								</div>
							</li>
							<li class="clearfix">
								<div class="customer secondary">LJ</div>
								<div class="delivery-details">
									<span class="badge badge-secondary">Returned</span>
									<h5>Lily Jordan</h5>
									<p>Status codes and descriptions are returned in the following OpenMarket-specific TLVs When a delivery receipt is received.</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
			<div class="card h-320">
				<div class="card-header">
					<div class="card-title">Top Five Agents</div>
				</div>
				<div class="card-body">
					<div class="customScroll5">
						<div class="top-agents-container">
							<div class="top-agent">
								<img src="<?php echo url_for('png/user.png') ?>" class="avatar" alt="Agent" />
								<div class="agent-details">
									<h6>Zuairia Zaman</h6>
									<div class="agent-score">
										<div class="progress">
											<div class="progress-bar bg-primary" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<div class="points">
											<div class="left">Rank #1</div>
											<div class="right">9,800 Ratings</div>
										</div>
									</div>
								</div>
							</div>
							<div class="top-agent">
								<img src="<?php echo url_for('png/user22.png') ?>" class="avatar" alt="Agent" />
								<div class="agent-details">
									<h6>Lily Jordan</h6>
									<div class="agent-score">
										<div class="progress">
											<div class="progress-bar bg-primary" role="progressbar" style="width: 76%" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<div class="points">
											<div class="left">Rank #2</div>
											<div class="right">7,500 Ratings</div>
										</div>
									</div>
								</div>
							</div>
							<div class="top-agent">
								<img src="<?php echo url_for('png/user6.png') ?>" class="avatar" alt="Agent" />
								<div class="agent-details">
									<h6>Ali Sayed</h6>
									<div class="agent-score">
										<div class="progress">
											<div class="progress-bar bg-secondary" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<div class="points">
											<div class="left">Rank #3</div>
											<div class="right">4,200 Ratings</div>
										</div>
									</div>
								</div>
							</div>
							<div class="top-agent">
								<img src="<?php echo url_for('png/user20.png') ?>" class="avatar" alt="Agent" />
								<div class="agent-details">
									<h6>Aaleyah Malik</h6>
									<div class="agent-score">
										<div class="progress">
											<div class="progress-bar bg-secondary" role="progressbar" style="width: 58%" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<div class="points">
											<div class="left">Rank #4</div>
											<div class="right">3,800 Ratings</div>
										</div>
									</div>
								</div>
							</div>
							<div class="top-agent">
								<img src="<?php echo url_for('png/user13.png') ?>" class="avatar" alt="Agent" />
								<div class="agent-details">
									<h6>Aabid Raheem</h6>
									<div class="agent-score">
										<div class="progress">
											<div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<div class="points">
											<div class="left">Rank #5</div>
											<div class="right">1,200 Ratings</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
			<div class="card h-320">
				<div class="card-header">
					<div class="card-title">Overall Ratings</div>
				</div>
				<div class="card-body">
					<div class="user-ratings">
						<div class="total-ratings">
							<h2>4.5</h2>
							<div class="rating-stars">
								<div id="rate1"></div>
							</div>
						</div>
						<div class="ratings-list-container">
							<div class="ratings-list">
								<div class="rating-level">5.0</div>
								<div class="rating-stars">
									<div class="rateA"></div>
								</div>
								<div class="total">
									8,500 <span class="percentage">65%</span>
								</div>
							</div>
							<div class="ratings-list">
								<div class="rating-level">4.0</div>
								<div class="rating-stars">
									<div class="rateB"></div>
								</div>
								<div class="total">
									3,500 <span class="percentage">20%</span>
								</div>
							</div>
							<div class="ratings-list">
								<div class="rating-level">3.0</div>
								<div class="rating-stars">
									<div class="rateC"></div>
								</div>
								<div class="total">
									1,400 <span class="percentage">15%</span>
								</div>
							</div>
							<div class="ratings-list">
								<div class="rating-level">2.0</div>
								<div class="rating-stars">
									<div class="rateD"></div>
								</div>
								<div class="total">
									300 <span class="percentage">05%</span>
								</div>
							</div>
							<div class="ratings-list">
								<div class="rating-level">1.0</div>
								<div class="rating-stars">
									<div class="rateE"></div>
								</div>
								<div class="total">
									75 <span class="percentage">03%</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->

</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
	function numberWithCommas(params) {
		return params.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	var options = {
		chart: {
			height: 350,
			type: 'bar',
		},
		plotOptions: {
			bar: {
				horizontal: false,
				endingShape: 'rounded',
				columnWidth: '50%',
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		series: [{
			name: 'Net Profit',
			data: [<?php echo $profit; ?>]
		}, {
			name: 'Revenue',
			data: [<?php echo $inflow; ?>]
		}, {
			name: 'Expenses Incurred',
			data: [<?php echo $outflow; ?>]
		}],
		xaxis: {
			categories: [<?php echo $month; ?>],
		},
		yaxis: {
			title: {
				text: 'Monetary value in (<?php echo $currency; ?>)'
			}
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function(val) {
					return "<?php echo $currency; ?> " + numberWithCommas(val)
				}
			}
		},
		grid: {
			row: {
				colors: ['#f5f9fe', '#ffffff'], // takes an array which will be repeated on columns
				opacity: 0.5
			},
		},
		colors: ["#1B998B", "#2E294E", "#D7263D", "#F46036", "#E2C044"],
	}
	var chart = new ApexCharts(
		document.querySelector("#consolidated-bar-chart"),
		options
	);
	chart.render();
</script>