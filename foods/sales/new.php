<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'Add Sales';


if (is_post_request()) {
  	  $args = $_POST['flow'];

  	  // pre_r($args);
      $args['created_by'] = $loggedInAdmin->id;
      $cashFlow = new CashFlow($args);
      $result = $cashFlow->save();

  if ($result == true) {
    // $new_id = $admin->id;
    $session->message('Data Saved successfully.');
    redirect_to(url_for('/sales/'));
  } 
} else {
  // display the form
  $cashFlow = new CashFlow;
}


include(SHARED_PATH . '/admin_header.php'); ?>

<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			<div class="card">
				<div class="card-body">
					<?php if (display_errors($cashFlow->errors)) { ?>
				      <div class="alert alert-danger alert-dismissible fade show" role="alert">
				        <?php echo display_errors($cashFlow->errors); ?>
				        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				          <span aria-hidden="true">×</span>
				        </button>
				      </div>
				    <?php } ?>
					<form method="post">
						<?php include('form_field.php') ?>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" id="save_expenses">Save</button>
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