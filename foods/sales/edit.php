
<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'List Sales';



$id = $_GET['id'] ?? $loggedInAdmin->id;
$cashFlow = CashFlow::find_by_id($id);
if ($cashFlow == false) {
  redirect_to(url_for('sales/index.php'));
}

if (is_post_request()) {

  // Save record using post parameters
  $args = $_POST['flow'];
  $cashFlow->merge_attributes($args);
  $result = $cashFlow->save();

  if ($result === true) {

    // logfile
    log_action('Edit CashFlow', "id: {$admin->id}, Editted by {$loggedInAdmin->full_name()}", "Cash");

    $session->message('The CashFlow was updated successfully.');
    redirect_to(url_for('Sales/show.php?id=' . $id));
  } else {
    // show errors
  }
} else {

  // display the form

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
							<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
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