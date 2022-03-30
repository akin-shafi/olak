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
						<div class="table-responsive">
							<table class="table table-bordered table-sm">
								<thead>
									<tr>
										<th>Customer ID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Phone</th>
										<th>Email</th>
										<th>Items Bought</th>
										<th>Money Spent</th>
										<th>Last Login</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>#00001</td>
										<td>Alia</td>
										<td>Willams</td>
										<td>+143-148-60985</td>
										<td>aliawilllams@wafi.com</td>
										<td>250</td>
										<td>$4500</td>
										<td>10/10/2019 4:30pm</td>
									</tr>
									<tr>
										<td>#00002</td>
										<td>Nathan</td>
										<td>James</td>
										<td>+278-119-88790</td>
										<td>nathanjames@wafi.com</td>
										<td>390</td>
										<td>$3500</td>
										<td>12/10/2019 2:37am</td>
									</tr>
									<tr>
										<td>#00003</td>
										<td>Kelly</td>
										<td>Thomas</td>
										<td>+125-117-88763</td>
										<td>thomas-gm@wafi.com</td>
										<td>135</td>
										<td>$2400</td>
										<td>14/10/2019 7:50pm</td>
									</tr>
									<tr>
										<td>#00004</td>
										<td>Steve</td>
										<td>Smitth</td>
										<td>+334-676-66530</td>
										<td>smith-st@wafi.com</td>
										<td>765</td>
										<td>$7890</td>
										<td>18/10/2019 9:30pm</td>
									</tr>
									<tr>
										<td>#00005</td>
										<td>Kevin</td>
										<td>Oliver</td>
										<td>+435-667-99808</td>
										<td>kevin-oliver@wafi.com</td>
										<td>763</td>
										<td>$5690</td>
										<td>21/10/2019 3:20pm</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- Row end -->

	</div>
	<!-- Content wrapper end -->


			
<?php include(SHARED_PATH . '/admin_footer.php');?>