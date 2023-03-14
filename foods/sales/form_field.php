<input type="hidden" name="cash_flow">
<div class="modal-body">
	<div class="container">
		<input type="hidden" name="flow[company_id]" value="<?php echo $loggedInAdmin->company_id ?>">
		<input type="hidden" name="flow[branch_id]" value="<?php echo $loggedInAdmin->branch_id ?>">
		<div class="row">
			<div class="form-group col-12">
				<label>Date</label>
				<div><input type="date" name="flow[created_at]" class="form-control" value="<?php echo $cashFlow->created_at ?? ""; ?>" <?php in_array($loggedInAdmin->admin_level, [1,2]) ? "" : "readonly"; ?> ></div>
			</div>
			<div class="form-group col-6">
				<label>Cash Sales</label>
				<div><input type="number" name="flow[cash_sales]" class="form-control" value="<?php echo $cashFlow->cash_sales; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');"></div>
			</div>
			<div class="form-group col-6">
				<label>Credit Sales</label>
				<div><input type="number" name="flow[credit_sales]" class="form-control" value="<?php echo $cashFlow->credit_sales; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');"></div>
			</div>

			<div class="form-group col-6">
				<label>POS </label>
				<div><input type="number" name="flow[pos]" class="form-control" value="<?php echo $cashFlow->pos; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');"></div>
			</div>
			<div class="form-group col-6">
				<label>Transfer </label>
				<div><input type="number" name="flow[transfer]" class="form-control" value="<?php echo $cashFlow->transfer; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');"></div>
			</div>

			<div class="form-group col-6">
				<label>Bread Sales (POS + Transfer + Cash) </label>
				<div><input type="number" name="flow[bread]" class="form-control" value="<?php echo $cashFlow->bread; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');"></div>
			</div>
			<div class="form-group col-12">
				<label>Narration </label>
				<div>
					<textarea style="min-height: 200px" name="flow[narration]" class="form-control"><?php echo $cashFlow->narration; ?></textarea>
				</div>
			</div>

			<?php
			$uploads = Uploads::find_by_date(date('Y-m-d'));
			if (empty($uploads)) : ?>
				<div class="form-group col-12">
					<div class="custom-file">
						<label class="custom-file-label">Upload <sup class="text-secondary">(Optional)</sup></label>
						<input type="file" name="filename[]" class="custom-file-input" multiple>
					</div>
				</div>
			<?php endif; ?>
		</div>

	</div>
</div>