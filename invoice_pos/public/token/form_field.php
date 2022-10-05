<div class="row">
  <div class="form-group col-md-4">
    <label>Customer Name<span class="text-danger">*</span></label>

    <?php if (!empty($c_id)) { ?>
      <h4><?php echo $customer_name ?></h4>
      <input type="hidden" readonly name="token[customer_id]" class="form-control" value="<?php echo $id; ?>">
    <?php } else { ?>
      <select name="token[customer_id]" class="form-control select2 w-100" data-placeholder="Customer Name" required>
        <option label="Select Customer"></option>
        <?php foreach (Client::find_by_undeleted() as $value) : ?>
          <option value="<?php echo $value->customer_id ?>"><?php echo ucwords($value->full_name()) ?></option>
        <?php endforeach; ?>
      </select>
    <?php } ?>
  </div>

  <div class="form-group col-md-4">
    <label>Token Type </label>
    <select class="form-control" name="token[token_type]" >
      <option value="">Select Type</option>
       <!-- <option value="central_account">Central Account</option> -->
        <?php foreach (Token::TOKEN_TYPE as $key => $value) : ?>
          <option value="<?php echo $key ?>" <?php echo $token->token_type == $key ? "selected" : "" ?> ><?php echo $value ?></option>
        <?php endforeach; ?>
      </select>      
    </select>
  </div>

  <div class="form-group col-md-4">
    <label>Amount <span class="text-danger">*</span></label>
      <input type="number" name="token[amount]"  class="form-control" value="<?php echo $token->amount ?? ""; ?>">
  </div>
</div>