<?php

require_once('../../private/initialize.php');
// echo "<pre>";
// print_r(Client::find_all());
// echo "</pre>";
require_login();

$currencies = [
  "NGN", "USD", "CYP", "GHC", "KES", "XEU"
];

$service_type = '';

?>
<?php $page = 'Invoice';
$page_title = 'Billing & Invoicing'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>
<style type="text/css">
  label {
    color: #FFF !important;
    font-weight: bolder;
  }

  .active {
    background-color: #00b894
  }
</style>
<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


  <!-- Page header start -->
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
  <!-- Page header end -->


  <!-- Content wrapper start -->
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

            <form action="" method="post" id="expense_form">
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
              <!-- <input type="hidden" class="form-control" readonly  name="billing[invoiceNum]" value="<?php //echo date('dHs'); 
                                                                                                          ?>"> -->

              <div class="table-responsive">
                <section class=" row ">
                  <div class="form-group col-lg-3 col-md-3 ">
                    <label class="label-control">Client Name <sup class="error">*</sup></label>
                    <select required="" class="form-control client_id" name="billing[client_id]">
                      <option value="">Select Client</option>
                      <?php foreach (Client::find_by_undeleted() as $client) { ?>

                        <option value="<?php echo $client->id ?>"><?php echo $client->full_name(); ?></option>
                      <?php } ?>
                    </select>

                  </div>
                  <div class="form-group col-lg-3 col-md-3 ">
                    <label class="label-control">Billing Format <sup class="error">*</sup></label>
                    <select required="" class="form-control" name="billing[billingFormat]">
                      <option disabled selected="">Select Format</option>
                      <?php foreach (Billing::BILLING_FORMAT as $result => $value) { ?>
                        <option value="<?php echo $value; ?>">
                          <?php echo $value; ?>

                        </option>
                      <?php } ?>

                    </select>
                  </div>

                  <div class="form-group col-lg-3 col-md-3 ">
                    <label class="label-control">Application Date <sup class="error">*</sup></label>
                    <input required="" type="date" class="form-control" name="billing[start_date]" value="">


                  </div>

                  <div class="form-group col-lg-3 col-md-3 ">
                    <label class="label-control">Due Date <sup class="error">*</sup></label>
                    <input required="" type="date" name="billing[due_date]" class="form-control" id="dueDtate" value="">


                    <!-- <input type="date" class="form-control" name=""> -->
                  </div>

                  <!-- <div class="form-group col-lg-12 col-md-12 ">
                    <label class="label-control">Vehicle <sup class="error">*</sup></label>
                    <input required="" type="text" name="billing[vehicle]" class="form-control" id="vehicle" value="<?php //echo ($billing->vehicle); 
                                                                                                                    ?>">
                  </div> -->



                </section>
                <!--row end   -->
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

                              <select class="form-control form-control-sm service_type" required="" name="service_type[]" id="service_type1" data-srno="1">
                                <option disabled selected="">Select Type</option>
                                <?php foreach (Product::find_by_undeleted() as $result => $value) { ?>
                                  <option data-price="<?php echo $value->price ?>" value="<?php echo $value->id; ?>">
                                    <?php echo $value->pname; ?>
                                  </option>
                                <?php } ?>
                              </select>
                            </td>


                            <td><input type="text" required="" name="unit_cost[]" id="unit_cost1" data-srno="1" class="form-control form-control-sm number_only unit_cost" value=""></td>

                            <td><input type="text" required="" name="quantity[]" id="quantity1" data-srno="1" class="form-control form-control-sm quantity" value=""></td>

                            <td><input type="text" required="" name="amount[]" id="amount1" data-srno="1" class="form-control form-control-sm amount" readonly value=""></td>

                            <td><button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm">+</button></td>
                          </tr>
                          <input type="hidden" name="billing[total_amount]" id="famount" data-srno="1" class="form-control input-sm famount" value="" readonly>

                          <input type="hidden" name="billing[tax]" id="taxInput" data-srno="1" class="form-control input-sm famount" value="" readonly>

                          <input type="hidden" name="billing[grand_total]" id="grand_totalInput" data-srno="1" class="form-control input-sm grand_total" value="" readonly>


                        </table>
                        <!-- <div align="center">
                                   <button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs">+</button>
                                   </div> -->

                      </td>

                    </tr>


                    <tr>
                      <td class="col" align="right"><b>Total</b></td>
                      <td class="col" align="center"><b><span id="final_total_amt">NaN</span></b></td>
                    </tr>
                    <tr class="d-none">
                      <td class="col" align="right"><b>Tax</b></td>
                      <td class="col" align="center"><b><span id="tax">NaN</span></b></td>
                    </tr>
                    <tr class="d-none">
                      <td class="col" align="right"><b>Sum Total</b></td>
                      <td class="col" align="center"><b><span id="grand_total">NaN</span></b></td>
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
                          <button type="submit" name="create_request" id="create_request" class="btn btn-primary">Generate Invoice</button>
                        </td>
                      </tr>


                    </table>

                    <!-- <tr>
                             <td colspan="2"></td>
                          </tr> -->

                  </tbody>
                </table>
              </div>
            </form>
          </section>
          <!--form end -->


        </div><!-- col-10 end -->



      </div><!-- row end -->
    </section>


  </div>
  <!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->
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

    var final_total_amt = $('#final_total_amt').text('0.00');
    var count = 1;

    $(document).on('click', '#add_row', function() {
      count = count + 1;
      $('#total_item').val(count);

      var html_code = '';
      html_code += '<tr id="row_id_' + count + '">';
      html_code += '<td><span id="sr_no">' + count + '</span></td>';
      // html_code += '<td><input type="text" name="service_type[]" id="service_type'+count+'" class="form-control input-sm"></td>';
      html_code += '<td><select class="form-control form-control-sm service_type" required="" name="service_type[]" id="service_type' + count + '" data-srno="' + count + '"><option value="">Select</option><?php foreach (Product::find_by_undeleted() as $result => $value) { ?><option data-price="<?php echo $value->price ?>" value="<?php echo $value->id; ?>"><?php echo $value->pname ?></option><?php } ?></select></td>';
      html_code += '<td><input type="text" required="" name="unit_cost[]"  id="unit_cost' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only unit_cost"></td>';
      html_code += '<td><input type="text" required="" name="quantity[]" id="quantity' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only quantity" value="<?php echo empty($expRequest->quantity) ? 0 : ''; ?>"></td>';
      html_code += '<td><input type="text" required="" name="amount[]" id="amount' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only amount" readonly></td>';
      html_code += '<td><button type="button" name="remove_row" id="' + count + '" class="btn btn-danger p-0 pl-2 pr-2 remove_row">X</button></td></tr>';

      $('#expense-item-table').append(html_code);

    });

    $(document).on('click', '.remove_row', function() {

      var row_id = $(this).attr("id");
      var total_item_amount = $('#amount' + row_id).val();
      var final_amount = $('#final_total_amt').text();
      var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
      $('#final_total_amt').text(result_amount);
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

      $('#final_total_amt').text(final_item_total);
      // $('#famount').val($('#final_total_amt').text(final_item_total));

      var tamount = $('#final_total_amt')[0].innerText;
      // var tax = tamount / 100 * 5;
      var tax = 0;


      var grand_total = Number(tamount) + tax;
      // $('#grand_total').val() = grand_total;
      $('#tax')[0].innerText = tax;
      $('#grand_total')[0].innerText = grand_total;

      $('#taxInput')[0].value = tax;
      var ans = $('#grand_totalInput')[0].value = Number(grand_total);
      console.log(ans)

      $('#part_payment').val(ans);

    }

    $(document).on('input', '.unit_cost', function() {
      cal_final_total(count);
    });
    $(document).on('input', '.quantity', function() {
      cal_final_total(count);
    });

    function cal_balance() {
      var part_payment = Number($('#part_payment')[0].value);
      // console.log(part_payment);
      // console.log(ans);
      var new_gtotal = $('#grand_totalInput')[0].value;
      var balance = new_gtotal - part_payment;
      // console.log(balance);
      $('#balance')[0].value = Number(balance);


    }

    $(document).on('input', '#part_payment', function() {
      cal_balance();
    });


    $('#expense_form').on('submit', function(e) {
      e.preventDefault()
      var count_data = 0;
      var cus_id = $(".client_id").val();
      var grand_totalInput = $("#grand_totalInput").val();

      $('.amount').each(function() {
        count_data = count_data + 1;
      });

      if (count_data > 0) {

        var form_data = $(this).serialize();
        var part_payment = $("#part_payment").val();

        if (part_payment > 0) {

          $.ajax({
            url: "inc/fetch_wallet.php",
            method: "POST",
            data: {
              fetch_wallet: 1,
              customer_id: cus_id,
            },
            dataType: 'json',
            success: function(data) {
              if (Number(data.wallet_balance) > Number(grand_totalInput)) {
                submit_form(form_data);
              } else {
                errorAlert("Customer's wallet balance is low")
              }
            }
          });
          // check_wallet()
          // submit_form(form_data)
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
            errorAlert(data.msg)
          }
        }
      });
    }

    $(document).on('change', '.client_id', function() {
      var cus_id = $(this).val();
      // errorAlert(cus_id)
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
    });

    // function check_wallet(){
    //   var cus_id  = $("#client_id").val();
    //   var grand_totalInput = $("#grand_totalInput").val();
    //   $.ajax({
    //       url:"inc/fetch_wallet.php",
    //       method:"POST",
    //       data: {
    //         fetch_wallet: 1,
    //         customer_id: cus_id,
    //       },
    //       dataType: 'json',
    //       success:function (data) {
    //         if (data.wallet_balance < grand_totalInput) {
    //           errorAlert("Customer wallet balance is low")
    //         }else{
    //           submit_form();
    //         }
    //         // $("#wallet_value").html( "₦ " + data.wallet_balance)
    //       }
    //     });
    // }



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
    $('#final_total_amt').text(amount);

    console.log($('#famount').val());

  }, false);
</script>