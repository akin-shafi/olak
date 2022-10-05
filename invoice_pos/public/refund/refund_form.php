<div class="row">
  <div class="form-group col-md-4">
    <label>Customer Name<span class="text-danger">*</span></label>

    <?php if (!empty($c_id)) { ?>
      <h4><?php echo $customer_name ?></h4>
      <input type="hidden" readonly name="refund[customer_id]" class="form-control" value="<?php echo $id; ?>">
    <?php } else { ?>
      <select name="refund[customer_id]" class="form-control select2 w-100" data-placeholder="Customer Name" required>
        <option label="Select Customer"></option>
        <?php foreach (Client::find_by_undeleted() as $value) : ?>
          <option value="<?php echo $value->customer_id ?>"><?php echo ucwords($value->full_name()) ?></option>
        <?php endforeach; ?>
      </select>
    <?php } ?>
  </div>

  <div class="form-group col-md-4">
    <label>Amount </label>
    <input type="number" name="refund[amount]" class="form-control" value="<?php echo $refund->amount ?? ""; ?>">
  </div>

  <div class="form-group col-md-4">
    <label>Bank Name <span class="text-danger">*</span></label>
    <input type="text" name="refund[bank_name]"  class="form-control" value="<?php echo $refund->bank_name ?? ""; ?>">
  </div>

  <div class="form-group col-md-4">
    <label>Bank Account <span class="text-danger">*</span></label>
    <input type="number" name="refund[bank_account]"  class="form-control" value="<?php echo $refund->bank_account ?? ""; ?>">
  </div>
</div>