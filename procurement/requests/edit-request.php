<?php require_once('../private/initialize.php');

$page = 'Request';
$page_title = 'Edit Requests';
include(SHARED_PATH . '/admin_header.php');

$isHidden = false;

$units = Request::UNIT;

if (empty($_GET['invoice_no'])) {
  redirect_to('../requests');
}

$invoiceNo = $_GET['invoice_no'];

$invoices = Request::find_by_invoices($invoiceNo);
$invoice = Request::find_by_invoice($invoiceNo);

$companies = Request::get_all_companies();
$branches = Request::get_all_branches($invoice->company_id);


if (empty($invoice)) {
  redirect_to('../requests');
}

$companyName = Request::get_company($invoice->company_id)->company_name;
$branchName = Request::get_branch($invoice->branch_id)->branch_name;


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
              <input type="hidden" name="invoice_num" value="<?php echo $invoiceNo ?>">

              <div class="table-responsive">
                <section class="d-flex justify-content-between align-items-center">
                  <div class="d-flex">
                    <div class="form-group">
                      <label class="label-control">Your full name <sup class="text-danger">*</sup></label>
                      <input type="text" class="form-control" name="full_name" value="<?php echo $invoice->full_name ?>" placeholder="Enter your full name" data-errors="Please Enter Full Name." readonly>
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mx-3">
                      <label class="label-control">Company<sup class="text-danger">*</sup></label>
                      <select class="form-control select2 company" name="company_id" id="company" required>
                        <option value="">-select a company-</option>
                        <?php foreach ($companies as $value) : ?>
                          <option value="<?php echo $value->id ?>" <?php echo $value->id == $invoice->company_id ? 'selected' : '' ?>>
                            <?php echo $value->company_name ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="label-control">Branch<sup class="text-danger">*</sup></label>
                      <select class="form-control select2 company" name="branch_id" id="branch" required>
                        <option value="">-select a branch-</option>
                        <?php foreach ($branches as $value) : ?>
                          <option value="<?php echo $value->id ?>" <?php echo $value->id == $invoice->branch_id ? 'selected' : '' ?>>
                            <?php echo $value->branch_name ?> </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="label-control">Due Date <sup class="text-danger">*</sup></label>
                    <input type="date" name="due_date" value="<?php echo $invoice->due_date ?>" class="form-control" id="dueDtate" data-errors="Please Enter Due Date." required>
                    <div class="help-block with-errors"></div>
                  </div>
                </section>

                <table class="table table-sm ">
                  <tbody>
                    <tr class="mtable">
                      <td colspan="2">
                        <table class="table table-sm" id="expense-item-table">
                          <th>Item/Service <sup class="text-danger">*</sup></th>
                          <th>Quantity <sup class="text-danger">*</sup></th>
                          <th rowspan="1">
                            <button type="button" id="add_row" class="btn btn-success">+</button>
                          </th>

                          <?php foreach ($invoices as $data) : ?>
                            <tr class="mtable">

                              <td>
                                <div class="input-group">
                                  <input type="text" name="item_name[]" value="<?php echo $data->item_name ?>" id="item_name1" data-srno="1" class="form-control col-8 item_name" placeholder="Item name" data-errors="Please Enter Item Name." required>
                                  <div class="help-block with-errors"></div>

                                  <select class="form-control col-4" name="unit[]" id="unit">
                                    <option value="">Unit of measure</option>
                                    <?php foreach ($units as $key => $value) : ?>
                                      <option value="<?php echo $key ?>" <?php echo $key == $data->unit ? 'selected' : '' ?>><?php echo $value ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </td>

                              <td>
                                <input type="text" name="quantity[]" value="<?php echo $data->quantity ?>" id="quantity1" data-srno="1" class="form-control quantity" placeholder="1" data-errors="Please Enter Quantity." required>
                                <div class="help-block with-errors"></div>
                              </td>

                              <td>
                                <button type="button" class="btn btn-danger delete_request" data-id="<?php echo $data->id; ?>">x</button>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </table>
                      </td>
                    </tr>


                    <table class="table table-sm">
                      <?php if ($isHidden) : ?>
                        <tr>
                          <td class=""><b>Amount Paid</b></td>
                          <td class=""><input type="text" class="form-control" id="part_payment" name="part_payment" required="" value="0"></td>
                          <td><b>To Balance</b></td>
                          <td><input type="text" readonly class="form-control" id="balance" name="balance"></td>
                        </tr>
                      <?php endif; ?>

                      <tr>
                        <td>
                          <textarea name="note" id="note" class="form-control" rows="3" placeholder="Note"><?php echo $invoice->note ?></textarea>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="4" align="center">
                          <input type="hidden" class="form-control " id="total_item" value="1">
                          <button type="submit" id="create_request" class="btn btn-primary">Update Request</button>
                        </td>
                      </tr>
                    </table>

                  </tbody>
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

    let count = 1;

    $(document).on('click', '#add_row', function() {
      count = count + 1;
      $('#total_item').val(count);

      let html_code = '';
      html_code += '<tr id="row_id_' + count + '">';

      html_code += '<td><div class="input-group"><input type="text" required="" name="item_name[]" id="item_name' + count + '" class="form-control col-8 item_name" placeholder="Item name"><select class="form-control col-4" name="unit[]" id="unit' + count + '"><?php foreach ($units as $key => $value) : ?><option value="<?php echo $key ?>"><?php echo $value ?></option><?php endforeach; ?></select></div></td>';

      html_code += '<td><input type="text" required="" name="quantity[]" id="quantity' + count + '" class="form-control quantity"></td>';

      html_code += '<td><button type="button" id="' + count + '" class="btn btn-danger remove_row">X</button></td></tr>';

      $('#expense-item-table').append(html_code);
    });

    $(document).on('click', '.remove_row', function() {
      let row_id = $(this).attr("id");
      $('#row_id_' + row_id).remove();
      count--;
      $('#total_item').val(count);
    });


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
  });
</script>