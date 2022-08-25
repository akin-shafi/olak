<?php require_once('../../../private/initialize.php');

if (is_post_request()) {
	if (!empty($_POST['customer_id'])) {
		$customer = Client::find_by_id($_POST['customer_id']);
		$wallet = Wallet::find_by_customer_id($customer->customer_id);

		exit(json_encode([
			'success' => true,
			'wallet_balance' => $wallet->balance,
		]));
	} else {
		exit(json_encode(['success' => true, 'wallet_balance' => 0]));
	}
}

if (is_get_request()) {
	if (isset($_GET['check_credit_facility'])) :
		$customer = Client::find_by_id($_GET['cId']);
		if ($customer->credit_facility == 1) : ?>
			<select required class="form-control payment_method" name="billing[billingFormat]">
				<option value="">Select</option>
				<?php foreach (Client::PAYMENT_METHOD as $key => $value) : ?>
					<option value="<?= $key ?>"><?= $value ?></option>
				<?php endforeach; ?>
			</select>
		<?php
		else : ?>
			<select required class="form-control payment_method" name="billing[billingFormat]">
				<option value="">Select</option>
				<option value="1">Wallet</option>
			</select>
<?php
		endif;
	endif;
}
