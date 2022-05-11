<?php require_once('../private/initialize.php');

$page = 'Request';
$page_title = 'Edit Requests';
include(SHARED_PATH . '/admin_header.php');


if (empty($_GET['invoice_no'])) {
  redirect_to('../requests');
}

$invoiceNo = $_GET['invoice_no'];

$invoice = Request::find_by_invoice($invoiceNo);
$requestDetails = RequestDetail::find_by_requests($invoice->id);

$companies = Company::find_by_undeleted();
$branches = Branch::find_all_branch();


if (empty($invoice)) {
  redirect_to('../requests');
}

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
              <h4 class="card-title">Edit Request</h4>
            </div>
          </div>
          <div class="card-body">
            <form id="expense_form" data-toggle="validator">
              <input type="hidden" name="edit_request">
              <input type="hidden" name="invoice_no" value="<?php echo $invoiceNo ?>">

              <div class="table-responsive">
                <section class="d-flex justify-content-between align-items-center">
                  <div class="d-flex">
                    <div class="form-group">
                      <label class="label-control">Your full name <sup class="text-danger">*</sup></label>
                      <input type="text" class="form-control form-control-sm" name="req[full_name]" value="<?php echo $invoice->full_name ?>" placeholder="Enter your full name" data-errors="Please Enter Full Name." readonly>
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mx-3">
                      <label class="label-control">Company<sup class="text-danger">*</sup></label>
                      <select class="form-control form-control-sm select2 company" name="req[company_id]" id="company" required>
                        <option value="">-select a company-</option>
                        <?php foreach ($companies as $value) : ?>
                          <option value="<?php echo $value->id ?>" <?php echo $value->id == $invoice->company_id ? 'selected' : '' ?>>
                            <?php echo $value->name ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="label-control">Branch<sup class="text-danger">*</sup></label>
                      <select class="form-control form-control-sm select2 company" name="req[branch_id]" id="branch" required>
                        <option value="">-select a branch-</option>
                        <?php foreach ($branches as $value) : ?>
                          <option value="<?php echo $value->id ?>" <?php echo $value->id == $invoice->branch_id ? 'selected' : '' ?>>
                            <?php echo $value->name ?> </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="label-control">Due Date <sup class="text-danger">*</sup></label>
                    <input type="date" name="req[due_date]" value="<?php echo $invoice->due_date ?>" class="form-control form-control-sm" id="dueDtate" data-errors="Please Enter Due Date." required>
                    <div class="help-block with-errors"></div>
                  </div>
                </section>

                <table class="table table-sm ">
                  <tbody>
                    <tr class="mtable">
                      <td colspan="2">
                        <table class="table table-sm table-hover shadow-sm" id="expense-table">
                          <thead class="bg-warning">
                            <tr>
                              <th>Item(s) <sup class="text-danger">*</sup></th>
                              <th>Quantity <sup class="text-danger">*</sup></th>
                              <th>Unit Price (<?php echo $currency ?>) <sup class="text-danger">*</sup></th>
                              <th>Amount (<?php echo $currency ?>)</th>
                              <th rowspan="1"></th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php foreach ($requestDetails as $data) : ?>
                              <tr class="mtable">
                                <td>
                                  <input type="text" name="item_name[]" value="<?php echo $data->item_name; ?>" class="form-control form-control-sm item_name" placeholder="Item name" required>
                                </td>
                                <td>
                                  <input type="number" name="quantity[]" value="<?php echo $data->quantity; ?>" class="form-control form-control-sm quantity" id="qty_<?php echo $data->id; ?>" placeholder="eg. 5" required>
                                </td>
                                <td>
                                  <input type="number" name="unit_price[]" value="<?php echo $data->unit_price; ?>" class="form-control form-control-sm unit_price" id="price_<?php echo $data->id; ?>" placeholder="eg. 120" required>
                                </td>
                                <td>
                                  <input type="number" name="amount[]" value="<?php echo $data->amount; ?>" class="form-control form-control-sm amt amount" id="amount_<?php echo $data->id; ?>" placeholder="eg. 600" readonly>
                                </td>
                                <td>
                                  <button type="button" class="btn btn-sm btn-danger delete_request" data-id="<?php echo $data->id; ?>">x</button>
                                </td>
                              </tr>
                            <?php endforeach; ?>
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
                      <p class="mr-3" id="grand"><?php echo number_format(intval($invoice->grand_total), 2); ?></p>
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

    $('#expense_form').on('submit', function(e) {
      e.preventDefault()
      let count_data = 0;

      $('.item_name').each(function() {
        count_data = count_data + 1;
      });

      if (count_data > 0) {
        let form_data = $(this).serialize();
        submit_form(form_data);
      } else {
        errorAlert(count_data);
      }
    });

    function submit_form(form_data) {
      $.ajax({
        url: "./inc/request.php",
        method: "POST",
        data: form_data,
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

    $(document).on('click', '.delete_request', function() {
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
            url: REQ_URL,
            method: "POST",
            data: {
              id: deleteRow,
              delete_request: 1
            },
            dataType: 'json',
            success: function(data) {
              Swal.fire(
                'Deleted!',
                data.message,
                'success'
              )
              setTimeout(() => window.location.reload(), 1000);
            }
          });

        }
      })

    });


    window.onload = () => {
      addSales()
    }

    const addSales = () => {
      let unitPrice = document.querySelectorAll('.unit_price')

      unitPrice.forEach(elem => {
        elem.addEventListener('input', function() {
          let tRow = $(this).closest('#expense-table tr');

          let qty = parseInt(tRow.find('.quantity').val(), 10)
          let price = parseInt(tRow.find('.unit_price').val(), 10)
          let subTotal = qty * price

          tRow.find('.amount').val(subTotal)
          calTotal();
        })
      });

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