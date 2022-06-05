<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'List Sales';



$id = $_GET['id'] ?? $loggedInAdmin->id;
$cashFlow = CashFlow::find_by_id($id);
if ($cashFlow == false) {
	redirect_to(url_for('sales/'));
}

if (is_post_request()) {

	$args = $_POST['flow'];
	$cashFlow->merge_attributes($args);
	$result = $cashFlow->save();

	if ($result === true) {

		log_action('Edit CashFlow', "id: {$loggedInAdmin->id}, Edited by {$loggedInAdmin->full_name}", "cash");

		$session->message('The CashFlow was updated successfully.');
		redirect_to(url_for('sales/show.php?id=' . $id));
	}
}


include(SHARED_PATH . '/admin_header.php'); ?>

<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			<div class="card">
				<div class="card-body">
					<form method="post">
						<?php include('form_field.php') ?>
						<div class="modal-footer">
							<a href="<?php echo url_for('sales/') ?>" class="btn btn-dark">Back</a>
							<button type="submit" class="btn btn-primary" id="save_expenses">Edit</button>
						</div>
					</form>

				</div>
			</div>

		</div>
	</div>

</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script type="text/javascript">
	$(document).on('click', '.enterDeep', function() {
		$("#enterDeepModal").modal('show')
	})
</script>