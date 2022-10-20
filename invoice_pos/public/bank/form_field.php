<div class="row">
  
  <div class="form-group col-md-4">
    <label>Bank Name <span class="text-danger">*</span></label>
      <input type="text" name="bank[bank_name]"  class="form-control" value="<?php echo $bank->bank_name ?? ""; ?>">
  </div>


   <div class="form-group col-md-4">
    <label>Account Name <span class="text-danger">*</span></label>
    <input class="form-control" name="bank[account_name]" id="account_name" type="text"  value="<?php echo $bank->account_name ?? '' ?>">
  </div>

  <div class="form-group col-md-4">
    <label>Account Number <span class="text-danger">*</span></label>
    <input class="form-control" name="bank[account_number]" id="account_number" type="number"  value="<?php echo $bank->account_number ?? '' ?>">
  </div>

  <div class="form-group col-md-4">
    <label>Company <span class="text-danger">*</span></label>
    <select class="form-control" name="bank[company_id]">
      <option value="">Select Company</option>
        <?php foreach (Company::find_by_undeleted() as $value) : ?>
          <option value="<?php echo $value->id ?>" <?php echo $bank->company_id == $value->id ? "selected" : "" ?>><?php echo $value->company_name ?></option>
        <?php endforeach; ?>
      </select>      
    </select>
  </div>




 <div class="form-group col-md-4">
    <label>Branch </label>
    <select class="form-control" name="bank[branch_id]" >
      <option value="">Select Branch</option>
       <!-- <option value="central_account">Central Account</option> -->
        <?php foreach (Branch::find_by_undeleted() as $value) : ?>
          <option value="<?php echo $value->id ?>" <?php echo $bank->branch_id == $value->id ? "selected" : "" ?> ><?php echo $value->branch_name ?></option>
        <?php endforeach; ?>
      </select>      
    </select>
  </div>
  

</div>