<?php
require_once('../../private/initialize.php');

require_login();
$currencies = [
  "NGN", "USD", "CYP", "GHC", "KES", "XEU"
];

$service_type = '';
$company = Company::find_by_id($loggedInAdmin->company_id);
$branch = Branch::find_by_id($loggedInAdmin->branch_id);

?>
<?php $page = 'Invoice';
$page_title = 'Billing & Receipts'; ?>
<?php include(SHARED_PATH . '/admin_header.php');
?>
<style type="text/css">
  label {
    color: #FFF !important;
    font-weight: bolder;
  }

  .active {
    background-color: #00b894
  }
</style>

<div class="main-container">


  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title; ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">

          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
            <i class="feather-"></i>
          </a>
        </div>
      </div>
    </div>
  </div>


  <div class="content-wrapper">

    <section class="">
      <div class="row">


        <div class="col-lg-2 ">
          <?php include('sideNav.php'); ?>
        </div>
        <!--col-2 end -->
        <div class="col-lg-10">
          <section class="  p-3 bg-primary">
            <div class="text-center">
              <label for="wallet">Wallet Balance</label>
              <div>
                <h1 class="text-success text-center" id="wallet_value" style="font-size: 29px;">0.00</h1>
              </div>
            </div>

            <form id="expense_form">
              <input type="hidden" name="billing[company_id]" value="<?php echo ucwords($company->id) ?>" readonly>
              <input type="hidden" name="billing[branch_id]" value="<?php echo ucwords($branch->id) ?>" readonly>

              <input type="hidden" value="" name="billing[invoiceNum]">
              <input type="hidden" value="" name="new_invoice">

              <div class="d-none justify-content-between">
                <div class="form-group">
                  <label for="currency">Currency</label>
                  <select required="" name="billing[currency]" class="btn">
                    <?php foreach ($currencies as $currency) { ?>
                      <option value="<?php echo $currency; ?>"><?php echo $currency; ?></option>
                    <?php } ?>

                  </select>
                </div>
                <div class="form-group ">
                  <label for="payment_method">Payment Method</label>
                  <select class="form-control">
                    <option>Cash</option>
                    <option>Transfer</option>
                    <option>POS</option>
                    <option>Wallet</option>
                  </select>
                </div>
              </div>

              <div class="table-responsive">
                <div class="d-flex">
                  <div class="form-group mr-3 d-none">
                    <label class="label-control">Company <sup class="error">*</sup></label>
                    <input type="text" class="form-control" value="<?php echo ucwords($company->company_name) ?>" readonly>
                  </div>

                  <div class="form-group d-none">
                    <label class="label-control">Branch <sup class="error">*</sup></label>
                    <input type="text" class="form-control" value="<?php echo ucwords($branch->branch_name) ?>" readonly>
                  </div>
                </div>

                <section class="row">
                  <div class="form-group col-lg-3 col-md-3">
                    <label class="label-control">Customer Name <sup class="error">*</sup></label>
                    <div class="btn-group">
                      <select required class="form-control client_id select2" name="billing[client_id]" id="client">
                        <option value="">Select Customer</option>
                        <?php foreach (Client::find_by_undeleted($loggedInAdmin->branch_id) as $client) : ?>
                          <option value="<?php echo $client->id ?>"><?php echo $client->full_name(); ?></option>
                        <?php endforeach; ?>
                      </select>
                      <a href="<?php echo url_for('client/new.php') ?>" class="btn btn-success btn-sm">+</a>
                    </div>

                  </div>
                  <div class="form-group col-lg-3 col-md-3 ">
                    <label class="label-control">Payment Method <sup class="error">*</sup></label>
                    <div id="">
                      <select id="payment_method" required class="form-control payment_method" name="billing[billingFormat]">
                        <option value="">Select</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group col-lg-3 col-md-3 ">
                    <label class="label-control">Due Date <sup class="error">*</sup></label>
                    <input required="" type="text" name="billing[due_date]" class="form-control" readonly id="dueDtate" value="7">
                  </div>

                  <?php if ($accessControl->special_sales == 1): ?>
                    
                  <div class="form-group col-lg-3 col-md-3 pt-4 bg-light">
                    <div class="d-flex justify-content-between align-items-center" style="min-width: 150px;">
                      <div class="custom-control custom-switch mb-3 ">
                        <input type="checkbox" class="custom-control-input" id="rebate">
                        <label class="custom-control-label text-dark" for="rebate">Agent Rebate</label>
                      </div>
                    </div>

                    <!-- <label class="label-control">  <input type="checkbox" name="billing['rebate']"> Agent Rebate</label> -->
                  </div>
                  <?php endif ?>

                  <div class="form-group col-lg-3 col-md-3 created_date" style="display: none;">
                    <label class="label-control">Transaction Date <sup class="error">*</sup></label>

                    <input type="date" class="form-control" id="created_date" name="billing[created_date]">
                  </div>


                  <div class="form-group col-lg-3 col-md-3 agent_wrap" style="display: none;">
                    <label class="label-control">Agent Name <sup class="error">*</sup></label>

                    <div class="btn-group">
                      <select class="form-control select2" name="billing[agent_id]" id="agent_id">
                        <option value="">Select an agent</option>
                        <?php foreach (Agent::find_by_undeleted() as $agent) : ?>
                            <option value="<?php echo $agent->agent_id ?>"><?php echo $agent->full_name(); ?></option>
                          <?php endforeach; ?>
                      </select>
                      <a href="<?php echo url_for('agents/new.php') ?>" class="btn btn-success btn-sm">+</a>
                    </div>
                  </div>



                </section>
                <table class="table table-bordered">
                  <tbody>

                    <tr class="mtable">
                      <td colspan="2">

                        <table class="table table-bordered" id="expense-item-table">
                          <th>SN</th>
                          <th>Item/Service</th>
                          <th>Unit Cost</th>
                          <th>Quantity</th>
                          <th>Total Cost</th>
                          <!-- <th rowspan="1">Total</th> -->
                          <th rowspan="1"></th>

                          <tr class="mtable">
                            <td><span id="sr_no">1</span></td>
                            <td>

                              <select class="form-control form-control-sm service_type select2" required="" name="service_type[]" id="service_type1" data-srno="1">
                                <option disabled selected="">Select Type</option>
                                <?php foreach (Product::find_by_branch_id(['branch_id' => $loggedInAdmin->branch_id]) as $result => $value) { ?>
                                  <option data-price="<?php echo $value->price ?>" value="<?php echo $value->id; ?>">
                                    <?php echo $value->pname; ?>
                                  </option>
                                <?php } ?>
                              </select>
                            </td>


                            <td><input type="text" <?php echo $accessControl->special_sales == 1 ? '' : 'readonly' ?> required="" name="unit_cost[]" id="unit_cost1" data-srno="1" class="form-control form-control-sm number_only unit_cost" value=""></td>

                            <td><input type="text" required="" name="quantity[]" id="quantity1" data-srno="1" class="form-control form-control-sm quantity" value=""></td>

                            <td><input type="text" required="" name="amount[]" id="amount1" data-srno="1" class="form-control form-control-sm amount" readonly value=""></td>

                            <td><button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm">+</button></td>
                          </tr>
                          <input type="hidden" name="billing[total_amount]" id="famount" data-srno="1" class="form-control input-sm famount" value="" readonly>

                          <input type="hidden" name="billing[tax]" id="taxInput" data-srno="1" class="form-control input-sm famount" value="" readonly>

                          <input type="hidden" name="billing[grand_total]" id="grand_totalInput" data-srno="1" class="form-control input-sm grand_total" value="" readonly>
                        </table>
                      </td>

                    </tr>


                    <tr>
                      <td class="col" align="right"><b>Total</b></td>
                      <td class="col" align="center"><b><span id="final_total_amt">0.00</span></b>
                        <input type="hidden" id="final_total_input" name="">
                      </td>
                    </tr>
                    <tr class="d-none">
                      <td class="col" align="right"><b>Tax</b></td>
                      <td class="col" align="center"><b><span id="tax">0.00</span></b></td>
                    </tr>
                    <tr class="d-none">
                      <td class="col" align="right"><b>Sum Total</b></td>
                      <td class="col" align="center"><b><span id="grand_total">0.00</span></b></td>
                    </tr>

                    <table class="table table-bordered">
                      <tr>
                        <td class=""><b>Amount Paid</b></td>
                        <td class=""><input type="text" class="form-control" id="part_payment" name="billing[part_payment]" required="" value="0"></td>
                        <td><b>To Balance</b></td>
                        <td><input type="text" readonly class="form-control" id="balance" name="billing[balance]" value=""></td>
                      </tr>

                      <tr>
                        <td colspan="4" align="center">
                          <input type="hidden" name="total_item" class="form-control " id="total_item" value="1">
                          <button type="submit" name="create_request" id="create_request" class="btn btn-primary">Generate Receipt</button>
                        </td>
                      </tr>


                    </table>

                  </tbody>
                </table>
              </div>
            </form>
          </section>
          <!--form end -->
        </div><!-- col-10 end -->
      </div><!-- row end -->
    </section>
  </div><!-- Content wrapper end -->
</div>


<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<input type="hidden" value="<?php echo url_for('invoice/') ?>" id="eUrl">
<?php include(SHARED_PATH . '/admin_footer.php');
?>

<script>
  $(document).ready(function() {
    var eUrl = $("#eUrl").val()
    $(document).on('change', '#bank_name', function() {
      var selected = $("#bank_name").find('option:selected');
      var data = selected.data("id");
      // alert(acct_no);
      $("#acct_no").val(data);
    });

    $(document).on('change', '#rebate', function() {

      $(".agent_wrap").toggle();
      if($(this).is(':checked') == true){
        $("#agent_id").prop('required',true);
      }else{
        $("#agent_id").prop("required", false);
      }
      
    })

    var final_total_amt = $('#final_total_amt').text(0);
    var count = 1;

    $(document).on('click', '#add_row', function() {
      count = count + 1;
      $('#total_item').val(count);

      var html_code = '';
      html_code += '<tr id="row_id_' + count + '">';
      html_code += '<td><span id="sr_no">' + count + '</span></td>';
      html_code += '<td><select class="form-control form-control-sm service_type select2" required="" name="service_type[]" id="service_type' + count + '" data-srno="' + count + '"><option value="">Select</option><?php foreach (Product::find_by_branch_id(['branch_id' => $loggedInAdmin->branch_id]) as $result => $value) { ?><option data-price="<?php echo $value->price ?>" value="<?php echo $value->id; ?>"><?php echo $value->pname ?></option><?php } ?></select></td>';
      html_code += '<td><input type="text" <?php echo $accessControl->special_sales == 1 ? '' : 'readonly' ?>  required="" name="unit_cost[]"  id="unit_cost' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only unit_cost"></td>';
      html_code += '<td><input type="text" required="" name="quantity[]" id="quantity' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only quantity" value="<?php echo empty($expRequest->quantity) ? '' : ''; ?>"></td>';
      html_code += '<td><input type="text" required="" name="amount[]" id="amount' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only amount" readonly></td>';
      html_code += '<td><button type="button" name="remove_row" id="' + count + '" class="btn btn-danger p-0 pl-2 pr-2 remove_row">X</button></td></tr>';

      $('#expense-item-table').append(html_code);

    });

    $(document).on('click', '.remove_row', function() {

      var row_id = $(this).attr("id");
      var total_item_amount = $('#amount' + row_id).val();
      var final_amount = $('#final_total_input').val();
      var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
      $('#final_total_amt').text(formatToCurrency(result_amount));
      $('#part_payment').val(result_amount);
      $('#final_total_input').val(result_amount);
      $('#row_id_' + row_id).remove();
      count--;
      $('#total_item').val(count);

    });

    $(document).on('change', '.service_type', function() {
      var selected = $(this).find('option:selected');
      var data = selected.data("price");
      var row_id = $(this).data("srno");
      $('#unit_cost' + row_id).val(data);
      cal_final_total(count)
    });

    function cal_final_total(count) {
      var final_item_total = 0;
      for (var j = 1; j <= count; j++) {
        var quantity = 0;
        var unit_cost = 0;
        var actual_amount = 0;
        var item_total = 0;

        quantity = $('#quantity' + j).val();
        if (quantity > 0) {
          unit_cost = $('#unit_cost' + j).val();
          if (unit_cost > 0) {
            actual_amount = parseFloat(quantity) * parseFloat(unit_cost);
            $('#amount' + j).val(actual_amount);
          }

          item_total = parseFloat(actual_amount);

          final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
          $('#famount').val(final_item_total);

        }


      }

      let amt = formatToCurrency(final_item_total);

      $('#final_total_amt').text(amt);
      $('#final_total_input').val(final_item_total);
      var tamount = final_item_total;
      var tax = 0;

      var grand_total = Number(tamount) + tax;
      // $('#grand_total').val() = grand_total;
      $('#tax')[0].innerText = tax;
      $('#grand_total')[0].innerText = grand_total;

      $('#taxInput')[0].value = tax;
      var ans = $('#grand_totalInput')[0].value = Number(grand_total);
      $('#part_payment').val(ans);

    }

    $(document).on('input', '.unit_cost', function() {
      cal_final_total(count);
    });
    $(document).on('input', '.quantity', function() {
      cal_final_total(count);
    });

    function cal_balance() {
      var part_payment = $('#part_payment').val();
      var new_gtotal = $('#grand_totalInput').val();
      var balance = new_gtotal - part_payment;
      $('#balance').val(balance);
    }

    $(document).on('input', '#part_payment', function() {
      cal_balance();
    });


    $('#expense_form').on('submit', function(e) {
      e.preventDefault()
      let count_data = 0;
      let cus_id = $(".client_id").val();
      let grand_totalInput = $("#grand_totalInput").val();
      let payment_method = $("#payment_method").val();

      $('.amount').each(function() {
        count_data = count_data + 1;
      });

      if (count_data > 0) {

        var form_data = $(this).serialize();
        var part_payment = $("#part_payment").val();
        if (part_payment > 0) {
          if (payment_method == 1) {
            $.ajax({
              url: "inc/fetch_wallet.php",
              method: "POST",
              data: {
                fetch_wallet: 1,
                customer_id: cus_id,
              },
              dataType: 'json',
              success: function(data) {

                if (Number(data.unformated_balance) >= Number(grand_totalInput)) {
                  submit_form(form_data);
                } else {
                  errorAlert("Customer's wallet balance is low")
                }

              }
            });
          } else if(payment_method == 3){
            processBacklog(form_data);
          }else{
            submit_form(form_data);
          }
        } else {
          errorAlert("Enter Amount Paid");
        }

      } else {
        errorAlert(count_data);
      }
    });
    // Form Submission

    function submit_form(form_data) {
      $.ajax({
        url: "inc/index.php",
        method: "POST",
        data: form_data,
        dataType: 'json',
        success: function(data) {
          if (data.success == true) {
            successAlert(data.msg)
            window.location.href = eUrl + '/invoice.php?invoice_no=' + data.invoice_no;
          } else {
            alert(data.msg)
          }
        }
      });
    }

    function processBacklog(form_data) {
      $.ajax({
        url: "inc/processBacklog.php",
        method: "POST",
        data: form_data,
        dataType: 'json',
        success: function(data) {
          if (data.success == true) {
            successAlert(data.msg)
            window.location.href = eUrl + '/invoice.php?invoice_no=' + data.invoice_no;
          } else {
            alert(data.msg)
          }
        }
      });
    }
    
    $(document).on('change', '.payment_method', function() {
      var payment_method = $(this).val();
      var cus_id = $(".client_id").val();

      if (payment_method == 1) {
        check_wallet(cus_id);
        $(".created_date").hide();
        $("#created_date").prop('required',false);
      } else if(payment_method == 3) {
        $(".created_date").toggle();
        $("#created_date").prop('required',true);
      }else{
        $("#wallet_value").html("0.00");
        $(".created_date").hide();
        $("#created_date").prop('required',false);
      }
    });

    $(document).on('change', '.client_id', function() {
      var cus_id = $(this).val();
      var payment_method = $(".payment_method").val();

      getPaymentMethod(cus_id)

      if (payment_method == 1) {
        check_wallet(cus_id)
      } else {
        $("#wallet_value").html("0.00")
      }
    });

    function getPaymentMethod(cus_id) {
      $.ajax({
        url: "inc/fetch_wallet.php",
        method: "GET",
        data: {
          check_credit_facility: 1,
          cId: cus_id,
        },
        success: function(data) {
          const pMethod = $("#payment_method");
          pMethod.html(data)
        }
      });
    }

    function check_wallet(cus_id) {
      $.ajax({
        url: "inc/fetch_wallet.php",
        method: "POST",
        data: {
          fetch_wallet: 1,
          customer_id: cus_id,
        },
        dataType: 'json',
        success: function(data) {
          $("#wallet_value").html("₦ " + data.wallet_balance)
        }
      });
    }



  }); // Document.ReadyState




  var leave = document.querySelectorAll('.amount');
  var amount = 0.00;
  window.addEventListener("load", function() {
    for (let i = 0; i < leave.length; i++) {
      // console.log(leave[i].value);
      amount += parseFloat(leave[i].value);
    }
    // alert("All is well");
    $('#famount').val(amount);
    let amt = formatToCurrency(amount)
    $('#final_total_amt').text(amt);

  }, false);

  function formatToCurrency(amount){
      return (amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
  }
</script>