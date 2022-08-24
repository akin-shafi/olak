<div class="row">
  <section class="col-lg-6 col-md-6 ">
    <dl class="row">
      <input type="hidden" class="form-control" name="wallet[created_by]" value="<?php echo $loggedInAdmin->id ?>">

      <?php if ($loggedInAdmin->admin_level == 1) { ?>
        
      <div class="form-group col-md-6">
        <label>Company Name <span class="text-danger">*</span></label>

        <select name="wallet[company_id]" class="form-control select2" data-placeholder="Company Name" required>
          <option label="Select Customer"></option>
          <?php foreach (Company::find_by_undeleted() as $value) : ?>
            <option value="<?php echo $value->id ?>" <?php echo $value->id == $loggedInAdmin->company_id ? 'selected' : '' ?>><?php echo ucwords($value->company_name) ?></option>
          <?php endforeach; ?>
        </select>

      </div>
      <div class="form-group col-md-6">
        <label>Branch Name <span class="text-danger">*</span></label>
        <!-- <input type="text" class="form-control" name="wallet[branch_id]" value=""> -->

        <select name="wallet[branch_id]" class="form-control select2" data-placeholder="Branch Name" required>
          <option label="Select Branch"></option>
          <?php foreach (Branch::find_by_undeleted() as $value) : ?>
            <option value="<?php echo $value->id ?>" <?php echo $value->id == $loggedInAdmin->branch_id ? 'selected' : '' ?>><?php echo ucwords($value->branch_name) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

       <?php }else{ ?>

        <input type="hidden" class="form-control" value="<?php echo $loggedInAdmin->company_id ?>" name="wallet[company_id]">
        <input type="hidden" class="form-control" value="<?php echo $loggedInAdmin->branch_id ?>" name="wallet[branch_id]">
       <?php } ?>



      <div class="form-group col-md-6">
        <label>Customer Name<span class="text-danger">*</span></label>

        <?php if (!empty($c_id)) { ?>
          <h4><?php echo $customer_name ?></h4>
          <input type="hidden" readonly name="wallet[customer_id]" class="form-control" value="<?php echo $id; ?>">
        <?php } else { ?>
          <select name="wallet[customer_id]" class="form-control select2 w-100" data-placeholder="Customer Name" required>
            <option label="Select Customer"></option>
            <?php foreach (Client::find_by_undeleted() as $value) : ?>
              <option value="<?php echo $value->customer_id ?>"><?php echo ucwords($value->full_name()) ?></option>
            <?php endforeach; ?>
          </select>
        <?php } ?>
      </div>


      <div class="form-group col-md-6">
        <label>Total Amount <span class="text-danger">*</span></label>

        <input type="text" name="wallet[amount]" id="famount" data-srno="1" class="form-control input-sm famount" value="0" readonly>

        <!-- <input class="form-control" name="wallet[amount]" readonly id="comp_reg" type="number" value="<?php echo $wallet->amount ?? '' ?>"> -->
      </div>

      <div class="form-group col-md-12">
        <table class="table table-bordered">
            <tbody>

              <tr class="mtable">
                <td colspan="2">
                  <table class="table table-bordered" id="expense-item-table">
                      <tr>
                        <th>S/N</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                      <tr>
                        <td>1</td>
                        
                        <td>
                          <select class="form-control form-control-sm payment_method " required="" name="payment_method[]" id="payment_method1" data-srno="1">
                              <option value="">Select</option>
                              <?php foreach (Billing::PAYMENT_METHOD as $key => $value) { ?>
                                  <option value="<?php echo $key; ?>">
                                    <?php echo $value; ?>

                                  </option>
                              <?php } ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" required="" name="amount[]" id="amount1" data-srno="1" class="form-control form-control-sm number_only amount"></td>
                        </td>
                        <td><button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm">+</button></td>
                      </tr>
                    </table>
                </td>
              </tr>

              <tr class="">
                <td class="col" colspan="4" align="center">Total: <b><span id="final_total_amt">NaN</span></b></td>

               
              </tr>
            </tbody>
        </table> 
      </div>
    </dl>
 </section>

 <section class="col-lg-6 col-md-6">
  <dl class="row">
    

    <div class="form-group col-md-6">
      <label>Bank Name <span class="text-danger">*</span></label>

      <select class="form-control select2" id="bank_name" name="wallet[bank_name]">
        <option value="">Select Bank</option>
        <?php foreach (Bank::find_by_undeleted() as $value) : ?>
          <option value="<?php echo $value->id ?>" data-id="<?php echo $value->account_number ?>"><?php echo $value->bank_name ?></option>
        <?php endforeach; ?>
      </select>


      </select>
    </div>

    <div class="form-group col-md-6">
      <label>Account No<span class="text-danger">*</span></label>
      <input class="form-control" name="wallet[account_no]" id="account_no" type="number" value="<?php echo $wallet->account_no ?? '' ?>" readonly>
    </div>

    <div class="form-group col-md-6">
      <label>Reference No </label>
      <input class="form-control" name="wallet[refrence_no]" id="refrence_no" type="text" value="<?php echo $wallet->refrence_no ?? '' ?>">
    </div>

    <div class="form-group col-md-6">
      <label>Description </label>
      <textarea class="form-control" name="wallet[description]" type="text"><?php echo $wallet->description ?? '' ?></textarea>
    </div>
  </dl>

<section>

<script type="text/javascript">
  $(document).on('change', '#bank_name', function() {
    var selected = $("#bank_name").find('option:selected');
    var data = selected.data("id");
    $("#account_no").val(data);
  });



  var final_total_amt = $('#final_total_amt').text('0.00');
  var count = 1;

  function cal_final_total(count) {
      var final_item_total = 0;
      for (var j = 1; j <= count; j++) {
        var quantity = 0;
        var amount = 0;
        var actual_amount = 0;
        var item_total = 0;

        quantity = 1;
        if (quantity > 0) {
          amount = $('#amount' + j).val();
          if (amount > 0) {
            actual_amount = parseFloat(quantity) * parseFloat(amount);
            $('#amount' + j).val(actual_amount);
          }

          item_total = parseFloat(actual_amount);

          final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
          $('#famount').val(final_item_total);

        }


      }

      $('#final_total_amt').text(final_item_total);
      $('#famount').val(final_item_total);


  }


  $(document).on('click', '#add_row', function() {
      count = count + 1;
      $('#total_item').val(count);

      var html_code = '';
      html_code += '<tr id="row_id_' + count + '">';
      html_code += '<td><span id="sr_no">' + count + '</span></td>';
      html_code += '<td><select class="form-control form-control-sm payment_method select2" required="" name="payment_method[]" id="payment_method' + count + '" data-srno="' + count + '"><option value="">Select</option><?php foreach (Billing::PAYMENT_METHOD as $result => $value) { ?><option value="<?php echo $result; ?>"><?php echo $value ?></option><?php } ?></select></td>';
     
      html_code += '<td><input type="text" required="" name="amount[]" id="amount' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only amount" value=""></td>';
      html_code += '<td><button type="button" name="remove_row" id="' + count + '" class="btn btn-danger p-0 pl-2 pr-2 remove_row">X</button></td></tr>';

      $('#expense-item-table').append(html_code);

    });

    $(document).on('click', '.remove_row', function() {

      var row_id = $(this).attr("id");
      var total_item_amount = $('#amount' + row_id).val();
      if (total_item_amount == "") {
        total_item_amount = 0;
      }
      var final_amount = $('#final_total_amt').text();
      var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
      $('#final_total_amt').text(result_amount);
      $('#row_id_' + row_id).remove();
      count--;
      $('#total_item').val(count);

    });

   $(document).on('input', '.amount', function() {
      cal_final_total(count);
   });
  
</script>