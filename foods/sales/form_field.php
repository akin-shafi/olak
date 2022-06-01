
	<input type="hidden" name="cash_flow">
	<div class="modal-body">
		<div class="container">
			<input type="hidden" name="flow[company_id]" value="<?php echo $loggedInAdmin->company_id ?>">
			<input type="hidden" name="flow[branch_id]" value="<?php echo $loggedInAdmin->branch_id ?>">
			<div class="row">
				<div class="form-group col-6">
					<label>Cash Sales</label>
					<div><input type="text" name="flow[cash_sales]" class="form-control" value="<?php echo $cashFlow->cash_sales; ?>"></div>
				</div>
				<div class="form-group col-6">
					<label>Credit Sales</label>
					<div><input type="text" name="flow[credit_sales]" class="form-control" value="<?php echo $cashFlow->credit_sales; ?>"></div>
				</div>
				
				<div class="form-group col-6">
					<label>POS </label>
					<div><input type="text" name="flow[pos]" class="form-control" value="<?php echo $cashFlow->pos; ?>"></div>
				</div>
				<div class="form-group col-6">
					<label>Transfer </label>
					<div><input type="text" name="flow[transfer]" class="form-control" value="<?php echo $cashFlow->transfer; ?>"></div>
				</div>
				<div class="form-group col-12">
					<label>Narration </label>
					<div>
						<textarea style="min-height: 200px" name="flow[narration]" class="form-control"><?php echo $cashFlow->narration; ?></textarea>
					</div>
				</div>
			</div>
			
		</div>
	</div>


	

	
