<?php

require_once('../../private/initialize.php');
require_login();

$invoiceNum = $_GET['invoiceNum'] ?? '1';

$billing = Billing::find_by_invoice_no($invoiceNum);

$invoices = Invoice::find_by_transid($billing->invoiceNum);
$clients = Client::find_by_id($billing->client_id);

// pre_r($billing);

$currencies = [
  "NGN", "USD", "CYP", "GHC", "KES", "XEU"
];

$service_type = '';
?>

<?php $page = 'Invoice';
$page_title = 'Edit Invoice'; ?>
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

        <div class="col-lg-10">
          <section class="  p-3 bg-primary">
            <div class="text-center">
              <label for="wallet">Wallet Balance</label>
              <div>
                <h1 class="text-success text-center" id="wallet_value" style="font-size: 29px;">0.00</h1>
              </div>
            </div>

            <form id="expense_form">
              <input type="hidden" value="" name="billing[invoiceNum]">
              <input type="hidden" value="" name="edit_invoice">
              <input type="hidden" value="<?php echo $invoiceNum; ?>" name="invoice_num">
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
                <section class=" row ">
                  <div class="form-group col-lg-3 col-md-3 ">
                    <label class="label-control">Client Name <sup class="error">*</sup></label>
                    <select required="" class="form-control client_id" name="billing[client_id]">
                      <option value="">Select Client</option>
                      <?php foreach (Client::find_by_undeleted() as $client) { ?>

                        <option value="<?php echo $client->id ?>" <?php echo $client->id == $billing->client_id ? 'selected' : '' ?>><?php echo $client->full_name(); ?></option>
                      <?php } ?>
                    </select>

                  </div>
                  <div class="form-group col-lg-3 col-md-3 ">
                    <label class="label-control">Billing Format <sup class="error">*</sup></label>
                    <select required="" class="form-control" name="billing[billingFormat]">
                      <option disabled selected="">Select Format</option>
                      <?php foreach (Billing::BILLING_FORMAT as $result => $value) { ?>
                        <option value="<?php echo $value; ?>" <?php echo $value == $billing->billingFormat ? 'selected' : '' ?>>
                          <?php echo $value; ?>

                        </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-lg-3 col-md-3 ">
                    <label class="label-control">Application Date <sup class="error">*</sup></label>
                    <input required="" type="date" class="form-control" name="billing[start_date]" value="<?php echo $billing->start_date ?>">
                  </div>

                  <div class="form-group col-lg-3 col-md-3 ">
                    <label class="label-control">Due Date <sup class="error">*</sup></label>
                    <input required="" type="date" name="billing[due_date]" class="form-control" id="dueDtate" value="<?php echo $billing->due_date ?>">
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
                          <th rowspan="1">
                            <button type="button" id="add_row" class="btn btn-success btn-sm float-right">+</button>
                          </th>

                          <?php $sn = 1;
                          foreach ($invoices as $trans) { ?>
                            <tr class="mtable">
                              <td><span id="sr_no"><?php echo $sn++ ?></span></td>
                              <td>

                                <select class="form-control form-control-sm service_type" required="" name="service_type[]" id="service_type1" data-srno="<?php echo $sn ?>">
                                  <option disabled selected="">Select Type</option>
                                  <?php foreach (Product::find_by_undeleted() as $result => $value) { ?>
                                    <option data-price="<?php echo $value->price ?>" value="<?php echo $value->id; ?>" <?php echo $value->id == $trans->service_type ? "selected" : '' ?>>
                                      <?php echo $value->pname; ?>
                                    </option>
                                  <?php } ?>
                                </select>
                              </td>

                              <td><input type="text" required="" name="unit_cost[]" id="unit_cost<?php echo $sn ?>" data-srno="<?php echo $sn ?>" class="form-control form-control-sm number_only unit_cost" value="<?php echo $trans->unit_cost ?>"></td>

                              <td><input type="text" required="" name="quantity[]" id="quantity<?php echo $sn ?>" data-srno="<?php echo $sn ?>" class="form-control form-control-sm quantity" value="<?php echo $trans->quantity ?>"></td>

                              <td><input type="text" required="" name="amount[]" id="amount<?php echo $sn ?>" data-srno="<?php echo $sn ?>" class="form-control form-control-sm amount" readonly value="<?php echo $trans->amount ?>"></td>
                              <td><button type="button" data-id="<?php echo $trans->id; ?>" class="btn btn-danger btn-sm delete_row">X</button></td>
                            </tr>
                          <?php } ?>
                          <input type="hidden" name="billing[total_amount]" id="famount" data-srno="1" class="form-control input-sm famount" value="" readonly>

                          <input type="hidden" name="billing[tax]" id="taxInput" data-srno="1" class="form-control input-sm famount" value="" readonly>

                          <input type="hidden" name="billing[grand_total]" id="grand_totalInput" data-srno="1" class="form-control input-sm grand_total" value="" readonly>

                          <input type="hidden" id="init_balance" class="form-control input-sm" value="<?php echo $billing->balance; ?>" readonly>

                        </table>
                      </td>
                    </tr>

                    <tr>
                      <td class="col p-1" align="right"><b>Subtotal</b></td>
                      <td class="col p-1 pl-3" align="left"><b><span id="final_total_amt">NaN</span></b></td>
                    </tr>
                    <tr>
                      <td class="col" align="right"><b>Outstanding</b></td>
                      <td class="col pl-3" align="left"><b><span><?php echo $billing->balance; ?></span></b></td>
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
                        <td class=""><input type="text" class="form-control" id="part_payment" name="billing[part_payment]" required="" value="<?php echo $billing->part_payment ?>"></td>
                        <td><b>To Balance</b></td>
                        <td><input type="text" readonly class="form-control" id="balance" name="billing[balance]" value="<?php echo !empty($billing->balance) ? $billing->balance : '0' ?>"></td>
                      </tr>

                      <tr>
                        <td colspan="4" align="center">
                          <input type="hidden" name="total_item" class="form-control " id="total_item" value="1">
                          <button type="submit" name="create_request" id="create_request" class="btn btn-primary">Generate Invoice</button>
                        </td>
                      </tr>
                    </table>
                  </tbody>
                </table>
              </div>
            </form>
          </section>

        </div>
      </div>
    </section>
  </div>
</div>

<input type="hidden" value="<?php echo url_for('invoice/') ?>" id="eUrl">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
  $(document).ready(function() {
    let eUrl = $("#eUrl").val()
    $(document).on('change', '#bank_name', function() {
      let selected = $("#bank_name").find('option:selected');
      let data = selected.data("id");
      // alert(acct_no);
      $("#acct_no").val(data);
    });

    let final_total_amt = $('#final_total_amt').text('0.00');
    let count = 100;

    $(document).on('click', '#add_row', function() {
      count = count + 1;
      $('#total_item').val(count);

      let html_code = '';
      html_code += '<tr id="row_id_' + count + '">';
      html_code += '<td><span id="sr_no">' + count + '</span></td>';
      html_code += '<td><select class="form-control form-control-sm service_type" required="" name="service_type[]" id="service_type' + count + '" data-srno="' + count + '"><option value="">Select</option><?php foreach (Product::find_by_undeleted() as $result => $value) { ?><option data-price="<?php echo $value->price ?>" value="<?php echo $value->id; ?>"><?php echo $value->pname ?></option><?php } ?></select></td>';
      html_code += '<td><input type="text" required="" name="unit_cost[]"  id="unit_cost' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only unit_cost"></td>';
      html_code += '<td><input type="text" required="" name="quantity[]" id="quantity' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only quantity" value="<?php echo empty($expRequest->quantity) ? 0 : ''; ?>"></td>';
      html_code += '<td><input type="text" required="" name="amount[]" id="amount' + count + '" data-srno="' + count + '" class="form-control form-control-sm number_only amount" readonly></td>';
      html_code += '<td><button type="button" id="' + count + '" class="btn btn-danger btn-sm remove_row">X</button></td></tr>';

      $('#expense-item-table').append(html_code);
    });

    $(document).on('click', '.remove_row', function() {
      let row_id = $(this).attr("id");
      let total_item_amount = $('#amount' + row_id).val();
      let final_amount = $('#final_total_amt').text();
      let result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
      $('#final_total_amt').text(result_amount);
      $('#part_payment').val(result_amount);
      $('#row_id_' + row_id).remove();
      count--;

      $('#total_item').val(count);
    });

    $(document).on('click', '.delete_row', function() {
      let deleteRow = this.dataset.id;
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "inc/index.php",
            method: "POST",
            data: {
              id: deleteRow,
              delete_invoice: 1
            },
            dataType: 'json',
            success: function(data) {
              Swal.fire(
                'Deleted!',
                data.msg,
                'success'
              )
            }
          });

        }
      }).then(() => window.location.reload())

    });

    $(document).on('change', '.service_type', function() {
      let selected = $(this).find('option:selected');
      let data = selected.data("price");
      let row_id = $(this).data("srno");
      $('#unit_cost' + row_id).val(data);
      cal_final_total(count)
    });


    function cal_final_total(count) {
      let final_item_total = 0;
      for (let j = 1; j <= count; j++) {
        let quantity = 0;
        let unit_cost = 0;
        let actual_amount = 0;
        let item_total = 0;

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

      let tamount = $('#final_total_amt')[0].innerText;
      // let tax = tamount / 100 * 5;
      let tax = 0;


      let grand_total = Number(tamount) + tax;
      $('#tax')[0].innerText = tax;
      $('#grand_total')[0].innerText = grand_total;

      $('#taxInput')[0].value = tax;
      let ans = $('#grand_totalInput')[0].value = Number(grand_total);

      $('#part_payment').val(ans);
    }

    $(document).on('input', '.unit_cost', function() {
      cal_final_total(count);
    });
    $(document).on('input', '.quantity', function() {
      cal_final_total(count);
    });

    function cal_balance() {
      let grand = Number($('#final_total_amt').text());
      let initBalance = Number($('#init_balance').val());
      let part_payment = Number($('#part_payment').val());

      let newBalance = grand + initBalance - part_payment;
      $('#balance').val(Number(newBalance));
    }

    $(document).on('input', '#part_payment', function() {
      cal_balance();
    });


    $('#expense_form').on('submit', function(e) {
      e.preventDefault()
      let count_data = 0;
      let cus_id = $(".client_id").val();
      let grand_totalInput = $("#grand_totalInput").val();

      // errorAlert(grand_totalInput)

      $('.amount').each(function() {
        count_data = count_data + 1;
      });

      if (count_data > 0) {
        let form_data = $(this).serialize();
        let part_payment = $("#part_payment").val();

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
      let cus_id = $(this).val();
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
    //   let cus_id  = $("#client_id").val();
    //   let grand_totalInput = $("#grand_totalInput").val();
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



  });

  let leave = document.querySelectorAll('.amount');
  let amount = 0.00;
  window.addEventListener("load", function() {
    for (let i = 0; i < leave.length; i++) {
      amount += parseFloat(leave[i].value);
    }
    $('#famount').val(amount);
    $('#final_total_amt').text(amount);

  }, false);
</script>