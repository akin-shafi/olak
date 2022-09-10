<div class="card">
  <div class="card-body">

    <div class="row">
      <div class="form-group col-md-4 col-sm-6 col-12">
        <input type="hidden" name="agent[created_by]" value="<?php echo $loggedInAdmin->id; ?>" class="form-control">
        <input type="hidden" name="agent[company_id]" value="<?php echo $loggedInAdmin->company_id; ?>" class="form-control">
        <input type="hidden" name="agent[branch_id]" value="<?php echo $loggedInAdmin->branch_id; ?>" class="form-control">
        <input type="text" name="agent[first_name]" value="<?php echo $agent->first_name; ?>" class="form-control" id="first_name" placeholder="First Name">
      </div>
      <div class="form-group col-md-4 col-sm-6 col-12">
        <input type="text" name="agent[last_name]" value="<?php echo $agent->last_name; ?>" class="form-control" id="last_name" placeholder="Last Name">
      </div>
      
      <div class="form-group col-md-4 col-sm-6 col-12">
        <input type="text" name="agent[phone]" value="<?php echo $agent->phone; ?>" class="form-control" id="phone" placeholder="Phone Number">
      </div>
      <div class="form-group col-md-4 col-sm-6 col-12">
        <input type="text" name="agent[bank_name]" value="<?php echo $agent->bank_name; ?>" class="form-control" id="bank_name" placeholder="Bank Name">
      </div>
      <div class="form-group col-md-4 col-sm-6 col-12">
        <input type="text" name="agent[account_no]" value="<?php echo $agent->account_no; ?>" class="form-control" id="account_no" placeholder="Account Number">
      </div>
      <div class="form-group col-md-4 col-sm-6 col-12">
        <input type="text" name="agent[email]" value="<?php echo $agent->email; ?>" class="form-control" id="email" placeholder="Email">
      </div>

      <div class="form-group col-md-12 col-sm-12 col-12">
        <textarea name="agent[address]" class="form-control" id="address" placeholder="Address"><?php echo $agent->address; ?></textarea>
      </div>
      

    </div>
  </div>

  <div class="card-footer">
    <input type="submit" class="btn btn-success float-right" value="Create">
  </div>
</div>