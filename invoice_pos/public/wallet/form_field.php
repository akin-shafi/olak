<style type="text/css">
  .bank_alt{display: none;}
</style>
<div class="row">
<input type="hidden" value="<?php echo date("Y-m-d H:i:s")?>" name="wallet[created_at]">
  <section class="col-lg-12 col-md-12 ">
    <dl class="row">
      <input type="hidden" class="form-control" name="wallet[created_by]" value="<?php echo $loggedInAdmin->id ?>">

      <?php if (in_array($loggedInAdmin->admin_level, [1, 2, 6])) { ?>
        
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
            <option value="<?php echo $value->id ?>" data-id="1" <?php echo $value->id == $loggedInAdmin->branch_id ? 'selected' : '' ?>><?php echo ucwords($value->branch_name) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

       <?php }else{ ?>

        <input type="hidden" class="form-control" value="<?php echo $loggedInAdmin->company_id ?>" name="wallet[company_id]">
        <input type="hidden" class="form-control" value="<?php echo $loggedInAdmin->branch_id ?>" name="wallet[branch_id]">
       <?php } ?>



      <div class="form-group col-md-4">
        <label>Customer Name<span class="text-danger">*</span></label>

        <?php if (!empty($c_id)) { ?>
          <h4><?php echo $customer_name ?></h4>
        <?php } ?>


          <div class="<?php echo !empty($c_id) ? "d-none" : "" ?>">
            <select name="wallet[customer_id]" class="form-control select2 w-100 cust_id " data-placeholder="Customer Name" required>
              <option label="Select Customer"></option>
              <?php foreach (Client::find_by_undeleted() as $value) : ?>
                <option data-balance="<?php echo $value->balance ?>"  value="<?php echo $value->customer_id ?>" 
                  <?php echo $id == $value->customer_id ? "selected" : "" ?>>  <?php echo ucwords($value->full_name()) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        
      </div>

      <div>
        <input type="hidden" name="wallet[balance]" id="balance">
      </div>

      <div class="form-group col-md-6 d-none">
        <label>Total Amount <span class="text-danger">*</span></label>

        <input type="text" name="wallet[amount]" id="famount" data-srno="1" class="form-control input-sm famount" value="0" readonly>

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
                        <th>Bank Name</th>
                        <th>Account No</th>
                        <th>Action</th>
                      </tr>
                      <tr>
                        <td>1</td>
                        
                        <td>
                          <select class="form-control form-control-sm payment_method " required="" name="payment_method[]" id="payment_method1" >
                              <option value="">Select</option>
                              <?php foreach (Billing::PAYMENT_METHOD as $key => $value) { ?>
                                  <option value="<?php echo $key; ?>" data-srno="1">
                                    <?php echo $value; ?>

                                  </option>
                              <?php } ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" required="" name="amount[]" id="amount1" data-srno="1" class="form-control form-control-sm number_only amount"></td>
                        </td>
                        <td>
                          <input class="bank_alt form-control" id="bank_alt1" >
                          <select class="form-control form-control-sm bank_name" required="" name="bank_name[]" id="bank_name1">
                            <option value="">Select</option>
                            <option value="0" style="display: none">Direct Cash</option>
                            <?php foreach (Bank::find_by_undeleted() as $result => $value) { ?><option data-id="1" data-acctname="<?php echo $value->account_name ?>"  data-acct="<?php echo $value->account_number ?>" value="<?php echo $value->id ; ?>"><?php echo $value->bank_name ?> </option><?php } ?></select>

                        </td>

                        <td><input class="form-control" name="account_no[]" id="account_no1" type="text" value="<?php echo $wallet->account_no ?? '' ?>" readonly></td>
                        <td><button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm">+</button></td>
                      </tr>
                    </table>
                </td>
              </tr>

              <tr class="">
                <td class="col" colspan="1" align="center">Total: <b><span id="final_total_amt">NaN</span></b>
                <input type="hidden" id="final_t_input" name="wallet[deposit]">
              </td>
                <td class="col" colspan="1" align="center"> Book Balance : <b><span id="final_total_balance">NaN</span></b>
                <input type="hidden" id="final_t_balance" name="wallet[balance]">
              </td>

               
              </tr>
            </tbody>
        </table> 
      </div>
    </dl>
 </section>

 <section class="col-lg-12 col-md-12">
  <dl class="row">
    

    <div class="form-group col-md-6 ">
      <label>Narration </label>
      <textarea required class="form-control" name="wallet[narration]" type="text"><?php echo $wallet->narration ?? '' ?></textarea>
    </div>
  </dl>

<section>

<script type="text/javascript">
  
  $(document).on('change', '.payment_method', function() {
    let selected = $(this).find('option:selected');
    let val = selected.val();
    let id = selected.data("srno");
    if (val == 2) {
      // $('#bank_name'+ id).val(4).trigger('change').attr('readonly', true);
      $('#bank_name'+ id).val(0).trigger('change').css('display', 'none');
      $('#bank_alt'+ id).css("display", "block").val("Direct Cash").attr('readonly', true);
      $("#account_no"+ id).val(0);
    }else{
      $('#bank_name'+ id).css('display', 'block').val('').trigger('change');
      $('#bank_alt'+ id).css("display", "none");
    }
  });

  $(document).on('change', '.bank_name', function() {
    let selected = $(this).find('option:selected');
    let id = selected.data("id");
    let account_no = selected.data("acct");
    let account_name = selected.data("acctname");
    // console.log(account_name)
    $("#account_no"+ id).val(account_no + " - " + account_name);
  });

  const selected = $(".cust_id").find('option:selected')
  get(selected);


  $(document).on('change', '.cust_id', function() {
    const selected = $(this).find('option:selected')
    get(selected)
  });

  function get(selected){
    let balance = selected.data('balance');
    $("#balance").val(balance)
    $('#final_total_balance').text(balance);
  }



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
      $('#final_t_input').val(final_item_total);
      $('#famount').val(final_item_total);

      let selected = $('.cust_id').find('option:selected');
      let b = selected.data('balance');

      const reload_val = parseInt(b) + final_item_total
      $('#balance').val(reload_val);
      $('#final_total_balance').text(reload_val);
      $('#final_t_balance').val(reload_val);
      


      // cal_wallet_bal(final_item_total)


  }

  // function cal_wallet_bal(final_item_total){
  //     let selected = $('.cust_id').find('option:selected');
  //     let b = selected.data('balance');

  //     const reload_val = parseInt(b) + final_item_total
  //     $('#balance').val(reload_val);
  // }


  $(document).on('click', '#add_row', function() {
      count = count + 1;
      $('#total_item').val(count);

      var html_code = '';
      html_code += '<tr id="row_id_' + count + '">';
      html_code += '<td><span id="sr_no">' + count + '</span></td>';
      html_code += '<td><select class="form-control form-control-sm payment_method select2" required="" name="payment_method[]" id="payment_method' + count + '" ><option value="">Select</option><?php foreach (Billing::PAYMENT_METHOD as $result => $value) { ?><option data-srno="' + count + '" value="<?php echo $result; ?>"><?php echo $value ?></option><?php } ?></select></td>';
     
      html_code += '<td><input type="text" required="" name="amount[]" id="amount' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only amount" value=""></td>';

      html_code += '<td><input class="bank_alt form-control" id="bank_alt' + count + '" ><select class="form-control form-control-sm bank_name" required="" name="bank_name[]" id="bank_name' + count + '"><option value="">Select</option> <option value="0" style="display: none">Direct Cash</option><?php foreach (Bank::find_by_undeleted() as $result => $value) { ?><option data-id="' + count + '" data-acctname="<?php echo $value->account_name ?>" data-acct="<?php echo $value->account_number ?>" value="<?php echo $value->id ; ?>"><?php echo $value->bank_name ?> </option><?php } ?></select></td>';

      html_code += '<td><input class="form-control" name="account_no[]" id="account_no' + count + '" type="text" value="<?php echo $wallet->account_no ?? '' ?>" readonly></td>';
 

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