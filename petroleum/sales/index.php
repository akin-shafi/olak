<?php require_once('../private/initialize.php');  

$page = 'Sales';
$page_title = 'All Sales';
include(SHARED_PATH . '/admin_header.php');
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
								<table id="copy-print-csv" class="table custom-table">
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
											<td>Product</td>
											<td>PMS (Tank1)</td>
											<td>PMS (Tank2)</td>
											<td>PMS (Tank3)</td>
											<td>PMS (Tank4)</td>
											<td>PMS (Tank5)</td>
											<td>AGO (Tank6)</td>
											<td>DPK (Tank7)</td>
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