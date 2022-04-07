<div class="modal-body">
  <input type="hidden" name="companyId" id="companyId" readonly>
  <div class="form-group">
    <label>Company <span class="text-danger">*</span></label>
    <input class="form-control" name="company[company_name]" id="comp_name" type="text" placeholder="Company Name" value="<?php echo $company->company_name ?? '' ?>">
  </div>
  <div class="form-group">
    <label>Registration Number <span class="text-danger">*</span></label>
    <input class="form-control" name="company[registration_no]" id="comp_reg" type="text" placeholder="Registration Number" value="<?php echo $company->registration_no ?? '' ?>">
  </div>
  <div class="form-group">
    <label>Company Logo</label><input class="form-control" name="logo" type="file">
  </div>
</div>