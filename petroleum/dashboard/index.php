<?php require_once('../private/initialize.php');

$page = 'Home';
$page_title = 'Sales Dashboard';
include(SHARED_PATH . '/admin_header.php');

if (empty($access->dashboard) || $access->dashboard != 1) :
	redirect_to('../sales/');
endif;

/*
$metricProfit = [];
$metricSales = [];
$metricExpenses = [];
$metricMonth = [];


$sales = DataSheet::find_by_metrics();
$expenses = Expense::find_by_metrics();

foreach ($sales as $value) {
	$abrMonth = date('M', strtotime('01-' . $value->month . date('-Y')));
	$nextInflow = !empty($value->inflow) ? $value->inflow : 0;

	array_push($metricSales, $nextInflow);
	array_push($metricMonth, $abrMonth);
}

foreach ($expenses as $value) {
	$nextOutflow = !empty($value->outflow) ? $value->outflow : 0;
	array_push($metricExpenses, $nextOutflow);
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

$pieProfit = array_sum($metricProfit);
$pieSales = array_sum($metricSales);
$pieExpenses = array_sum($metricExpenses);
*/

$admins = Admin::find_by_undeleted();
$products = Product::find_by_undeleted();
$stockSheet = DataSheet::get_stock_sheet();



$branches = Branch::find_by_undeleted(['order' => 'ASC']);
?>

<style>
	th {
		vertical-align: middle;
		font-size: 10px !important;
		text-align: center;
	}
</style>


<!-- Content wrapper start -->
<div class="content-wrapper">

	<div class="card">
		<div class="card-body">
			<h3>Welcome to Olak Petroleum</h3>

			<div class="row gutters d-none">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
					<div class="row gutters">
						<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
							<div class="info-tiles border-0 shadow-sm">
								<a href="<?php echo url_for('/settings/manage_user.php') ?>">
									<div class="info-icon">
										<i class="icon-account_circle"></i>
									</div>
									<div class="stats-detail">
										<h5><?php echo count($admins); ?></h5>
										<p>Active Users</p>
									</div>
								</a>
							</div>
						</div>
						<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
							<div class="info-tiles border-0 shadow-sm">
								<div class="info-icon secondary">
									<i class="icon-archive"></i>
								</div>
								<div class="stats-detail">
									<h5><?php echo number_format($stockSheet->total_stock); ?> (LTR)</h5>
									<p>Total Stock</p>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
							<div class="info-tiles border-0 shadow-sm">
								<div class="info-icon">
									<i class="icon-check_circle"></i>
								</div>
								<div class="stats-detail">
									<h5><?php echo number_format($stockSheet->sales_in_ltr); ?> (LTR)</h5>
									<p>Stock Sales</p>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
							<div class="info-tiles border-0 shadow-sm">
								<div class="info-icon secondary">
									<i class="icon-shopping_basket"></i>
								</div>
								<div class="stats-detail">
									<h5><?php echo number_format($stockSheet->expected_stock); ?> (LTR)</h5>
									<p>Expected Stock</p>
								</div>
							</div>
						</div>

						<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
							<div class="info-tiles border-0 shadow-sm">
								<div class="info-icon">
									<i class="icon-watch_later"></i>
								</div>
								<div class="stats-detail">
									<h5><?php echo number_format($stockSheet->actual_stock); ?> (LTR)</h5>
									<p>Actual Stock</p>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
							<div class="info-tiles border-0 shadow-sm">
								<div class="info-icon">
									<i class="icon-layers2"></i>
								</div>
								<div class="stats-detail">
									<h5><?php echo number_format($stockSheet->over_or_short); ?> (LTR)</h5>
									<p>Over/Short</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12 mb-5">
					<div class="shadow-sm">
						<div id="consolidated-bar">
							<div class="card text-center text-uppercase border-0">
								<div class="card-header">
									<h4 class="card-title">Monthly Break-down for the year <?php echo date('Y'); ?></h4>
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
				</div>

				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-5">
					<div class="shadow-sm h-100">
						<div id="consolidated-pie">
							<div class="card text-center text-uppercase border-0">
								<div class="card-header">
									<h4 class="card-title">January - <?php echo date('F, Y'); ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-5">
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
		</div> -->

				<!-- <div class="customScroll5">
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
						</div> -->



				<!-- <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5 d-none">
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
				</div> -->

			</div>

			<div class="row">
				<div class="col-12">
					<div class="d-flex justify-content-between align-items-center shadow-sm p-2 mb-2">
						<h4 class="mb-0 text-uppercase">Product Sales Summary for the month of (<?php echo date('M, Y'); ?>)</h4>
						<div class="btn-group">
							<select class="form-control" name="branch_query" id="branch_query">
								<?php foreach ($branches as $branch) : ?>
									<option value="<?php echo $branch->id ?>"><?php echo $branch->name ?></option>
								<?php endforeach; ?>
							</select>
							<button class="btn btn-sm btn-primary" id="filter_branch"><i class="icon-search"></i></button>
						</div>
					</div>
				</div>
			</div>

			<div id="salesReport">
				<!-- //? This is coming from ./dashTable -->
			</div>
		</div>
	</div>

</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>
<?php include('./dashChart/active-chart.php'); ?>

<script>
	$(document).ready(function() {
		const TABLE_URL = './dashTable/'

		$(document).on('click', "#filter_branch", function() {
			let branch = $('#branch_query').val()
			if (branch == '') {
				alert('Kindly select a branch')
			} else {
				getDataSheet(branch)
			}
		})

		const getDataSheet = (branch) => {
			$.ajax({
				url: TABLE_URL,
				method: "GET",
				data: {
					branch: branch,
					filter: 1
				},
				cache: false,
				beforeSend: function() {
					$('.lds-hourglass').removeClass('d-none');
				},
				success: function(r) {
					$('#salesReport').html(r)
					setTimeout(() => {
						$('.lds-hourglass').addClass('d-none');
					}, 250);
				}
			})
		}

		window.onload = () => {
			let branch = $('#branch_query').val()
			getDataSheet(branch);
		}
	})
</script>