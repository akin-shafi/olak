<?php require_once('../private/initialize.php');  

$page = 'Sales';
$page_title = 'All Sales';
include(SHARED_PATH . '/admin_header.php');

$array = ['Rate', 'open stock', 'new stock'];
?>



	<!-- Content wrapper start -->
	<div class="content-wrapper">
		<!-- Row start -->
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

				<div class="card">
					<div class="card-body">
						<div class="table-container">
							<div class="table-responsive">
								<table  class="table custom-table">
									<thead>
										<tr class="bg-primary text-white ">
											<th class="font-weight-bold">Product</th>
											<th class="font-weight-bold text-right">PMS (Tank1)</th>
											<th class="font-weight-bold text-right">PMS (Tank2)</th>
											<th class="font-weight-bold text-right">PMS (Tank3)</th>
											<th class="font-weight-bold text-right">PMS (Tank4)</th>
											<th class="font-weight-bold text-right">PMS (Tank5)</th>
											<th class="font-weight-bold text-right">AGO (Tank6)</th>
											<th class="font-weight-bold text-right">DPK (Tank7)</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Rate</td>
											<td>1</td>
											<td>2</td>
											<td>3</td>
											<td>4</td>
											<td>5</td>
											<td>6</td>
											<td>7</td>
										</tr>
										<tr>
											<td>open stock</td>
											<td>1</td>
											<td>2</td>
											<td>3</td>
											<td>4</td>
											<td>5</td>
											<td>6</td>
											<td>7</td>
										</tr>
										<tr>
											<td>New stock</td>
											<td>1</td>
											<td>2</td>
											<td>3</td>
											<td>4</td>
											<td>5</td>
											<td>6</td>
											<td>7</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- Row end -->

	</div>
	<!-- Content wrapper end -->


			
<?php include(SHARED_PATH . '/admin_footer.php');?>