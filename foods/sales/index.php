<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'List Sales';
$cashFlow = CashFlow::find_by_cash_flow($loggedInAdmin->company_id, $loggedInAdmin->branch_id);
// $company = Company::find_by_id($loggedInAdmin->company_id);
// $branches = Branch::find_all_branch(['company_id' => $company->id]);
// $adminLevel = $loggedInAdmin->admin_level;
include(SHARED_PATH . '/admin_header.php'); ?>

<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			<div class="card">
				<div class="card-body">
					<div class="table-container border-0 shadow">
						<div class="table-responsive">
							<div class="d-flex justify-content-end mb-2">
								<a href="<?php echo url_for('/sales/new.php') ?>" class="btn float-end btn-primary " style="cursor: pointer">Add Sales</a>
							</div>
							<table id="dataSheet" class="table custom-table">
								<thead>
									<tr class="bg-primary text-white text-center">
										<th>SN</th>
										<th>Cash</th>
										<th>Credit</th>
										<th>POS</th>
										<th>Transfer</th>

										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php $sn = 1; foreach ($cashFlow as $key => $value): ?>
									<tr class=" text-center">
										<td><?php echo $sn++; ?></td>
										<td><?php echo $value->cash_sales ?></td>
										<td><?php echo $value->credit_sales ?></td>
										<td><?php echo $value->pos ?></td>
										<td><?php echo $value->transfer ?></td>
										<td><a href="<?php echo url_for('sales/edit.php?id='. $value->id) ?>" class="btn btn-primary">Edit</a></td>
									</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script type="text/javascript">
s
	
</script>