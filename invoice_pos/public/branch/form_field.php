
 <div class="modal-body">
  <input type="hidden" name="branchId" id="branchId" readonly>
  <div class="form-group">
    <label>Company <span class="text-danger">*</span></label>
    <select name="branch[company_id]" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Company Name" id="company_id" required>
      <option label="Company Name"></option>
      <?php foreach (Company::find_by_undeleted() as $value) : ?>
        <option value="<?php echo $value->id ?>" <?php echo $value->id == $branch->company_id ? 'selected' : '' ?>><?php echo ucwords($value->company_name) ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label>Branch <span class="text-danger">*</span></label>
    <input class="form-control" name="branch[branch_name]" id="branch_name" type="text" placeholder="Branch Name" value="<?php echo h($branch->branch_name); ?>">
  </div>
  <div class="form-group">
    <label>Address <span class="text-danger">*</span></label>
    <input class="form-control" name="branch[address]" id="branch_address" type="text" placeholder="Branch Address" value="<?php echo h($branch->address); ?>">
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>State <span class="text-danger">*</span></label>
        <input class="form-control" name="branch[state]" id="branch_state" type="text" placeholder="Branch State" value="<?php echo h($branch->state); ?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>City <span class="text-danger">*</span></label>
        <input class="form-control" name="branch[city]" id="branch_city" type="text" placeholder="Branch City" value="<?php echo h($branch->city); ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label>Establishment Date <span class="text-danger">*</span></label>
    <input class="form-control" name="branch[established_in]" id="established_in" type="date" value="<?php echo h($branch->established_in); ?>">
  </div>
</div>