<?php require_once('../private/initialize.php');

$page = 'Sales';
$page_title = 'Add Sales';


$uploadDir = './uploads/';

if (is_post_request()) {
	$args = $_POST['flow'];

	$args['created_by'] = $loggedInAdmin->id;

	$cashFlow = new CashFlow($args);
	$result = $cashFlow->save();

	if ($result == true) {
		$newId = $cashFlow->id;
		$cFlow = CashFlow::find_by_id($newId);

		$countFiles = count($_FILES['filename']['name']);

		if ($countFiles > 0) {
			for ($i = 0; $i < $countFiles; $i++) :
				$fileTmpPath = $_FILES['filename']['tmp_name'][$i];
				$fileName = $_FILES['filename']['name'][$i];

				$fileNameExp = explode('.', $fileName);
				$fileExt = strtolower(end($fileNameExp));
				$newFileName = md5(time() . $fileName) . '.' . $fileExt;
				$allowedFileExt = ['jpg', 'png', 'gif', 'jpeg', 'pdf'];
				$dest_path = $uploadDir . $newFileName;

				if (isset($fileName) && !empty($fileName)) {
					if (in_array($fileExt, $allowedFileExt)) {
						if (!empty($cFlow->file_name)) {
							unlink($uploadDir . $cFlow->file_name);
						}
						if (move_uploaded_file($fileTmpPath, $dest_path)) {
							$data = [
								'cash_flow_id' 	=> $newId,
								'file_name' 		=> $newFileName,
							];
						} else {
							exit(json_encode(['success' => false, 'msg' => 'File not uploaded!']));
						}
					} else {
						exit(json_encode(['success' => false, 'msg' => 'Upload failed. Allowed file types: ' . implode(',', $allowedFileExt)]));
					}
				}

				$uploads = new Uploads($data);
				$uploads->save();
			endfor;
		}


		$session->message('Data Saved successfully.');
		redirect_to(url_for('/sales/'));
	}
} else {
	$cashFlow = new CashFlow;
}

$date = date('Y-m-d');
$singleCashFlow = CashFlow::single_cash_flow($date, ['company' => $loggedInAdmin->company_id, 'branch' => $loggedInAdmin->branch_id]);

include(SHARED_PATH . '/admin_header.php'); ?>

<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<?php if (isset($singleCashFlow->created_at) && $singleCashFlow->created_at == $date) : ?>
				<div class="alert alert-primary" style="display:grid;place-items:center;height:60vh">
					<h1>You are not permitted to enter sales.</h1>
				</div>
			<?php else : ?>
				<div class="card">
					<div class="card-body">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<?php if (display_errors($cashFlow->errors)) { ?>
										<!-- <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
										<?php echo display_errors($cashFlow->errors); ?>
										<!-- </div> -->
									<?php } ?>
								</div>
							</div>
						</div>
						<form method="post" enctype="multipart/form-data">
							<?php include('form_field.php') ?>
							<div class="modal-footer">
								<a href="<?php echo url_for('sales/') ?>" class="btn btn-dark">Back</a>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>

					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>

</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script type="text/javascript">
	$(document).on('click', '.enterDeep', function() {
		$("#enterDeepModal").modal('show')
	})
</script>