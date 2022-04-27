<?php
require_once('../../private/initialize.php');

if (is_post_request()) {
	if (isset($_POST['new_access'])) {
		$adminId = $_POST['admin_id'];
		$fullName = Admin::find_by_id($adminId)->full_name();

		$companyIds = $_POST['company_id'];
		$branchIds = $_POST['branch_id'];

		$branchArr = [];
		$compArr = [];


		foreach ($companyIds as $bId) {
			array_push($compArr, $bId);
		}

		foreach ($branchIds as $bId) {
			array_push($branchArr, $bId);
		}

		$impCom = implode(', ', $compArr);
		$impBranch = implode(', ', $branchArr);

		$params = [
			'admin_id' => $adminId,
			'company_id' => $impCom,
			'branch_id' => $impBranch,
		];

		$adminBranch = new AccessControl($params);
		$adminBranch->save();

		exit(json_encode(['success' => true, 'msg' => 'Permission granted to ' . ucwords($fullName)]));
	}

	if (isset($_POST['deleted'])) {
		$id = $_POST['accessId'];

		$access = AccessControl::find_by_id($id);
		$access::deleted($id);

		exit(json_encode(['success' => true, 'msg' => 'Permission deleted successful!']));
	}
}



if (is_get_request()) {
	$selected = $_GET['selected'];

	$selectedArr = count($selected);

	if (!empty($selectedArr)) :
		for ($i = 0; $i < $selectedArr; $i++) :
			$compId = $selected[$i];
			$branch = Branch::find_by_company_ids($compId);

			if (!empty($branch[0]->company_name)) :
?>
				<div class="mb-3 col-md-12">
					<label for="branch_id" class="form-label"><?php echo ucwords($branch[0]->company_name) ?></label>
					<select class="select2 form-control branch" name="branch_id[]" type="text" multiple="multiple" required="">
						<?php foreach ($branch as $value) : ?>
							<option value="<?php echo $value->id ?>">
								<?php echo ucwords($value->branch_name) ?></option>
						<?php endforeach; ?>
					</select>
				</div>
<?php endif;
		endfor;
	endif;
}
?>

<script>
	$('.branch').select2({
		placeholder: 'Select company',
		allowClear: true,
		tokenSeparators: [' ']
	});
</script>