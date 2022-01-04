<?php
require_once('../private/initialize.php');

$totalStaff = Employee::count_all();

$page = 'Dashboard';
$page_title = 'HR Admin';
include(SHARED_PATH . '/admin_header.php');

$label_array = ['Olak Roofing Factory' => '200', 'Aroma Eatery' => '50', 'Olak Petroleum' => '100', 'Olak sales outlet' => '27', 'Olak Gas' => '16', 'Olak Supermarket' => '50', 'Aroma Bakery' => '100', 'Olak Procurement' => '23',];

$icon_array = ['Olak Roofing Factory', 'Aroma Eatery'];

?>
<style type="text/css">
	.design {
		border: 1px solid black;
	}
</style>


<?php
// $rand = mt_rand(1000, 9999);
// $rand = rand(1000, 9999);
// $rand = uniqid();


?>

<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
					<div class="welcome-box">
						<div class="welcome-img">
							<img alt="" src="assets/img/profiles/avatar-02.jpg">
						</div>
						<div class="welcome-det">
							<h3>Welcome, <?php echo $loggedInAdmin->full_name($loggedInAdmin->id) ?></h3>
							<p><?php echo date('F j, Y') ?> </p>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card-group m-b-30">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between ">
								<div>
									<span class="d-block">Total Staff</span>
								</div>
								<h3 class="mb-0 text-end"><?php echo $totalStaff; ?></h3>
							</div>
							<div style="border-bottom:3px solid green;" class="mt-2"></div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between ">
								<div>
									<span class="d-block">Permanent Staff</span>
								</div>
								<h3 class="mb-0 text-end">496</h3>
							</div>
							<div style="border-bottom:3px solid blue;" class="mt-2"></div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between ">
								<div>
									<span class="d-block">Casual Staff</span>
								</div>
								<h3 class="mb-0 text-end">70</h3>
							</div>
							<div style="border-bottom:3px solid gold;" class="mt-2"></div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="row">
			<?php foreach ($label_array as $title => $value) { ?>
				<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
					<div class="card dash-widget">
						<div class="card-body">
							<span class="dash-widget-icon"><i class="fa fa-user"></i></span>
							<div class="dash-widget-info">
								<span><?php echo $title; ?></span>
								<h3 class="font-12"><?php echo $value; ?></h3>

							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="row d-none">
			<div class="col-md-12 col-lg-12 col-xl-4 d-flex">
				<div class="card flex-fill dash-statistics">
					<div class="card-body">
						<h5 class="card-title">Statistics</h5>
						<div class="stats-list">
							<div class="stats-info">
								<p>Today Leave <strong>4 <small>/ 65</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Pending Invoice <strong>15 <small>/ 92</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Completed Projects <strong>85 <small>/ 112</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Open Tickets <strong>190 <small>/ 212</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Closed Tickets <strong>22 <small>/ 212</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Task Statistics</h4>
						<div class="statistics">
							<div class="row">
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Total Tasks</p>
										<h3>385</h3>
									</div>
								</div>
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Overdue Tasks</p>
										<h3>19</h3>
									</div>
								</div>
							</div>
						</div>
						<div class="progress mb-4">
							<div class="progress-bar bg-purple" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
							<div class="progress-bar bg-warning" role="progressbar" style="width: 22%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">22%</div>
							<div class="progress-bar bg-success" role="progressbar" style="width: 24%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">24%</div>
							<div class="progress-bar bg-danger" role="progressbar" style="width: 26%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">21%</div>
							<div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">10%</div>
						</div>
						<div>
							<p><i class="fa fa-dot-circle-o text-purple me-2"></i>Completed Tasks <span class="float-end">166</span></p>
							<p><i class="fa fa-dot-circle-o text-warning me-2"></i>Inprogress Tasks <span class="float-end">115</span></p>
							<p><i class="fa fa-dot-circle-o text-success me-2"></i>On Hold Tasks <span class="float-end">31</span></p>
							<p><i class="fa fa-dot-circle-o text-danger me-2"></i>Pending Tasks <span class="float-end">47</span></p>
							<p class="mb-0"><i class="fa fa-dot-circle-o text-info me-2"></i>Review Tasks <span class="float-end">5</span></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Today Absent <span class="badge bg-inverse-danger ms-2">5</span></h4>
						<div class="leave-info-box">
							<div class="media d-flex align-items-center">
								<a href="profile.html" class="avatar"><img alt="" src="assets/img/user.jpg"></a>
								<div class="media-body flex-grow-1">
									<div class="text-sm my-0">Martin Lewis</div>
								</div>
							</div>
							<div class="row align-items-center mt-3">
								<div class="col-6">
									<h6 class="mb-0">4 Sep 2019</h6>
									<span class="text-sm text-muted">Leave Date</span>
								</div>
								<div class="col-6 text-end">
									<span class="badge bg-inverse-danger">Pending</span>
								</div>
							</div>
						</div>
						<div class="leave-info-box">
							<div class="media d-flex align-items-center">
								<a href="profile.html" class="avatar"><img alt="" src="assets/img/user.jpg"></a>
								<div class="media-body flex-grow-1">
									<div class="text-sm my-0">Martin Lewis</div>
								</div>
							</div>
							<div class="row align-items-center mt-3">
								<div class="col-6">
									<h6 class="mb-0">4 Sep 2019</h6>
									<span class="text-sm text-muted">Leave Date</span>
								</div>
								<div class="col-6 text-end">
									<span class="badge bg-inverse-success">Approved</span>
								</div>
							</div>
						</div>
						<div class="load-more text-center">
							<a class="text-dark" href="javascript:void(0);">Load More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php');  ?>