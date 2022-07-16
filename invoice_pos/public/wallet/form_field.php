<div class="row">
  <input type="hidden" class="form-control" name="wallet[created_by]" value="<?php echo $loggedInAdmin->id ?>">
  <div class="form-group col-md-4">
    <label>Company Name <span class="text-danger">*</span></label>

    <select name="wallet[company_id]" class="form-control select2" data-placeholder="Company Name" required>
      <option label="Select Customer"></option>
      <?php foreach (Company::find_by_undeleted() as $value) : ?>
        <option value="<?php echo $value->id ?>" <?php echo $value->id == $loggedInAdmin->company_id ? 'selected' : '' ?>><?php echo ucwords($value->company_name) ?></option>
      <?php endforeach; ?>
    </select>

  </div>
  <div class="form-group col-md-4">
    <label>Branch Name <span class="text-danger">*</span></label>
    <!-- <input type="text" class="form-control" name="wallet[branch_id]" value=""> -->

    <select name="wallet[branch_id]" class="form-control select2" data-placeholder="Branch Name" required>
      <option label="Select Branch"></option>
      <?php foreach (Branch::find_by_undeleted() as $value) : ?>
        <option value="<?php echo $value->id ?>" <?php echo $value->id == $loggedInAdmin->branch_id ? 'selected' : '' ?>><?php echo ucwords($value->branch_name) ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group col-md-4">
    <label>Customer <span class="text-danger">*</span></label>

    <?php if (!empty($c_id)) { ?>
      <h4><?php echo $customer_name ?></h4>
      <input type="hidden" readonly name="wallet[customer_id]" class="form-control" value="<?php echo $id; ?>">
    <?php } else { ?>
      <select name="wallet[customer_id]" class="form-control select2" data-placeholder="Customer Name" required>
        <option label="Select Customer"></option>
        <?php foreach (Client::find_by_undeleted() as $value) : ?>
          <option value="<?php echo $value->customer_id ?>"><?php echo ucwords($value->full_name()) ?></option>
        <?php endforeach; ?>
      </select>
    <?php } ?>


  </div>


  <div class="form-group col-md-4">
    <label>Amount <span class="text-danger">*</span></label>
    <input class="form-control" name="wallet[amount]" id="comp_reg" type="number" value="<?php echo $wallet->amount ?? '' ?>">
  </div>

  <div class="form-group col-md-4">
    <label>Reference No </label>
    <input class="form-control" name="wallet[refrence_no]" id="refrence_no" type="text" value="<?php echo $wallet->refrence_no ?? '' ?>">
  </div>

  <div class="form-group col-md-4">
    <label>Bank Name <span class="text-danger">*</span></label>

    <select class="form-control select2" id="bank_name" name="wallet[bank_name]">
      <option value="">Select Bank</option>
      <?php foreach (Bank::find_by_undeleted() as $value) : ?>
        <option value="<?php echo $value->id ?>" data-id="<?php echo $value->account_number ?>"><?php echo $value->bank_name ?></option>
      <?php endforeach; ?>
    </select>


    </select>
  </div>

  <div class="form-group col-md-4">
    <label>Account No<span class="text-danger">*</span></label>
    <input class="form-control" name="wallet[account_no]" id="account_no" type="number" value="<?php echo $wallet->account_no ?? '' ?>" readonly>
  </div>


  <div class="form-group col-md-4">
    <label>Description </label>
    <textarea class="form-control" name="wallet[description]" type="text"><?php echo $wallet->description ?? '' ?></textarea>
  </div>


</div>

<script type="text/javascript">
  $(document).on('change', '#bank_name', function() {
    var selected = $("#bank_name").find('option:selected');
    var data = selected.data("id");
    $("#account_no").val(data);
  });
</script>