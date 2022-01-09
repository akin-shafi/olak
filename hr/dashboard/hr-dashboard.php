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
							<!-- <img alt="" src="assets/img/profiles/avatar-02.jpg"> -->
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
		<div class="row">

			<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Today Absent <span class="badge bg-inverse-danger ms-2">5</span></h4>
						<div class="leave-info-box">
							<div class="media d-flex align-items-center">
								<!-- <a href="profile.html" class="avatar"><img alt="" src="assets/img/user.jpg"></a> -->
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
								<!-- <a href="profile.html" class="avatar"><img alt="" src="assets/img/user.jpg"></a> -->
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
			<!-- Status 
				new 
				paid
				rejected
			-->
			<div class="col-md-8">
				<div class="p-2">
				  <div class="row">
				  	<ol class="col-6 list-group">
					  <li class="list-group-item d-flex justify-content-between align-items-start">
					    <div class="ms-2 me-auto">
					      <div class="fw-bold">Total loan Request</div>
					    </div>
					    <span class="">14</span>
					  </li>
					 </ol>

				  	<ol class="col-6 list-group list-group-numbered">
					  <li class="list-group-item d-flex justify-content-between align-items-start">
					    <div class="ms-2 me-auto">
					      <div class="fw-bold">Total loan Value</div>
					    </div>
					    <span class="">900,0000.00</span>
					  </li>
					</ol>
				  </div>
				</div>


                  <div class="card card-table flex-fill">
                     <div class="card-header">
                        <h3 class="card-title mb-0">Loan Request</h3>
                     </div>
                     <div class="card-body ">
                        <div class="table-responsive table-wrap p-2 ">
                           <table class="table table-nowrap custom-table mb-0 ">
                              <thead>
                                 <tr>
                                    <th>Ref No.</th>
                                    <th>Amount</th>
                                    <th>Date requested</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><a href="invoice-view.html">#REF-0001</a></td>
                                    <td>
                                       <h2><a href="#">150,000</a></h2>
                                    </td>
                                    <td>11 Jan, 2022</td>
                                    <td>
                                       <span class="badge bg-inverse-warning">New</span>
                                    </td>
                                    <td class="text-end">
	                                    <div class="btn-group btn-group-sm">
	                                      <div class="btn btn-sm btn-outline-success">Approve</div>
	                                      <div class="btn btn-sm btn-outline-danger">Reject</div>
	                                    </div>
	                                 </td>	
                                 </tr>
                                 

                                 
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="card-footer">
                        <a href="invoices.html">View all invoices</a>
                     </div>
                  </div>
               </div>
              
		</div>
	</div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php');  ?>