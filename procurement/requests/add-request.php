<?php require_once('../private/initialize.php');

$page = 'Request';
$page_title = 'Add Requests';
include(SHARED_PATH . '/admin_header.php');

$isHidden = true;

$companies = Company::find_by_undeleted();
$branches = Branch::find_all_branch();

?>

<style>
  .table-sm td,
  .table-sm th {
    padding: 0.5rem !important;
  }
</style>


<div class="content-page">
  <div class="container-fluid add-form-list">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Add Request</h4>
            </div>
          </div>
          <div class="card-body">
            <form id="expense_form" data-toggle="validator" enctype="multipart/form-data">
              <input type="hidden" name="new_request">

              <div class="table-responsive">
                <section class="d-flex justify-content-between align-items-center">
                  <div class="d-flex">
                    <div class="form-group">
                      <label class="label-control">Your full name <sup class="text-danger">*</sup></label>
                      <input type="text" class="form-control form-control-sm" name="req[full_name]" value="<?php echo $loggedInAdmin->full_name; ?>" data-errors="Please Enter Full Name." readonly>
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mx-3">
                      <label class="label-control">Company<sup class="text-danger">*</sup></label>
                      <select class="form-control form-control-sm" name="req[company_id]" id="company">
                        <?php foreach ($companies as $value) : ?>
                          <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="label-control">Branch<sup class="text-danger">*</sup></label>
                      <select class="form-control form-control-sm" name="req[branch_id]" id="branch" required>
                        <option value="">-select a branch-</option>
                        <?php foreach ($branches as $value) : ?>
                          <option value="<?php echo $value->id ?>">
                            <?php echo $value->name ?> </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="label-control">Due Date <sup class="text-danger">*</sup></label>
                    <input type="date" name="req[due_date]" class="form-control form-control-sm" id="dueDtate" data-errors="Please Enter Due Date." required>
                    <div class="help-block with-errors"></div>
                  </div>
                </section>

                <table class="table table-sm ">
                  <tbody>
                    <tr class="mtable">
                      <td colspan="2">
                        <table class="table table-sm table-hover shadow-sm" id="expense-item-table">
                          <thead class="bg-success">
                            <tr>
                              <th>SN</th>
                              <th>Item(s) <sup class="text-danger">*</sup></th>
                              <th>Quantity <sup class="text-danger">*</sup></th>
                              <th>Unit Price (<?php echo $currency ?>) <sup class="text-danger">*</sup></th>
                              <th>Amount (<?php echo $currency ?>)</th>
                              <th rowspan="1"></th>
                            </tr>
                          </thead>

                          <tbody>
                            <tr class="mtable">
                              <td><span id="sr_no">1</span></td>
                              <td>
                                <input type="text" name="item_name[]" class="form-control form-control-sm item_name" placeholder="Item name" required>
                              </td>
                              <td>
                                <input type="number" name="quantity[]" class="form-control form-control-sm quantity_1" placeholder="eg. 5" required>
                              </td>
                              <td>
                                <input type="number" name="unit_price[]" class="form-control form-control-sm unit_price_1" placeholder="eg. 120" required>
                              </td>
                              <td>
                                <input type="number" name="amount[]" class="form-control form-control-sm amt amount_1" placeholder="eg. 600" readonly>
                              </td>
                              <td>
                                <button type="button" id="add_row" class="btn btn-sm btn-success">+</button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center">
                  <div class="custom-file" style="width: 300px;">
                    <input type="file" name="vend_img" class="custom-file-input" id="vend_img">
                    <label class="custom-file-label" for="vend_img">Vendor Image Upload</label>
                  </div>

                  <div class="d-flex justify-content-end align-items-center">
                    <p class="mr-3"><b>To Balance</b></p>
                    <div>
                      <p class="mr-3" id="grand">0.00</p>
                      <input type="hidden" class="form-control form-control-sm" id="grand_total" name="req[grand_total]" readonly>
                    </div>
                  </div>
                </div>


                <table class="table table-sm my-4">
                  <tr>
                    <td>
                      <label for="note" class="text-muted text-uppercase">Terms & conditions</label>
                      <textarea name="req[note]" id="note" class="form-control form-control-sm" rows="3" placeholder="Terms and conditions">Payment is due within 15 days of request.</textarea>
                    </td>
                  </tr>

                  <tr>
                    <td align="center">
                      <input type="hidden" class="form-control form-control-sm " id="total_item" value="1">
                      <button type="submit" id="create_request" class="btn btn-primary">Submit Request</button>
                      <button type="reset" class="btn btn-danger">Reset</button>
                    </td>
                  </tr>
                </table>

              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
  $(document).ready(function() {
    const REQ_URL = './inc/request.php'

    // $(".custom-file-input").on("change", function() {
    //   let vendImg = $(this).val().split("\\").pop();
    //   $(this).siblings(".custom-file-label").addClass("selected").html(vendImg);
    // });

    let count = 1;

    $(document).on('click', '#add_row', function() {
      count = count + 1;
      $('#total_item').val(count);

      let html_code = '';
      html_code += '<tr id="row_id_' + count + '">';
      html_code += '<td><span id="sr_no">' + count + '</span></td>';

      html_code += '<td><div class="input-group"><input type="text" required="" name="item_name[]" class="form-control form-control-sm item_name_' + count + '" placeholder="Item name"></div></td>';

      html_code += '<td><input type="number" required="" name="quantity[]" class="form-control form-control-sm quantity_' + count + '"  placeholder="eg. 5"></td>';

      html_code += '<td><input type="number" required="" name="unit_price[]" class="form-control form-control-sm unit_price_' + count + '"  placeholder="eg. 120"></td>';

      html_code += '<td><input type="number" name="amount[]" class="form-control form-control-sm amt amount_' + count + '"  placeholder="eg. 600" readonly></td>';

      html_code += '<td><button type="button" id="' + count + '" class="btn btn-sm btn-danger remove_row">X</button></td></tr>';

      $('#expense-item-table').append(html_code);

      addSales()
    });

    $(document).on('click', '.remove_row', function() {
      let row_id = $(this).attr("id");
      $('#row_id_' + row_id).remove();
      count--;

      $('#total_item').val(count);

      calTotal();
    });


    $('#expense_form').on('submit', function(e) {
      e.preventDefault()
      let count_data = 0;

      $('.item_name').each(function() {
        count_data = count_data + 1;
      });

      if (count_data > 0) {
        let formData = new FormData(this);
        let form_data = $(this).serialize();
        submit_form(formData);
      } else {
        errorAlert(count_data);
      }
    });

    function submit_form(payload) {
      $.ajax({
        url: REQ_URL,
        method: "POST",
        data: payload,
        contentType: false,
        processData: false,
        cache: false,
        dataType: 'json',
        success: function(data) {
          if (data.success == true) {
            successAlert(data.message)
            window.location.href = '../invoice.php?invoice_no=' + data.invoice_no;
          } else {
            errorAlert(data.message)
          }
        }
      });
    }


    window.onload = () => {
      addSales()
    }

    const addSales = () => {

      const totalItem = $('#total_item').val();

      for (let i = 1; i <= totalItem; i++) {
        let qty = $('.quantity_' + i)
        let unitPrice = $('.unit_price_' + i)
        let amount = $('.amount_' + i)

        unitPrice.on('input', function() {
          let subTotal = Number(qty.val()) * Number(unitPrice.val())
          amount.val(subTotal);
          console.log(amount.val())

          calTotal();
        })

        // ! This will set the initial calculated result on page load. Thank you!
        // let subTotal = Number(amount.val()) * Number(unitPrice.val())
        // amount.val(subTotal);
      }
    }

    const calTotal = () => {
      const grandTotal = $('#grand_total')
      let totalAmount = 0;
      let amt = $('.amt')

      amt.each((i, el) => {
        if (el.value == '') return;
        totalAmount += parseFloat(el.value);
      })
      $('#grand').text(numberWithCommas(totalAmount));
      grandTotal.val(totalAmount);
    }

  });
</script>