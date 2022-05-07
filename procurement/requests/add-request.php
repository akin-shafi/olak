<?php require_once('../private/initialize.php');

$page = 'Request';
$page_title = 'Add Requests';
include(SHARED_PATH . '/admin_header.php');

$isHidden = false;

$units = Request::UNIT;
$companies = Request::get_all_companies();

?>

<style>
  .table-sm td,
  .table-sm th {
    padding: 0.5rem !important;
  }

  .select2-container--bootstrap-5.select2-container--focus .select2-selection,
  .select2-container--bootstrap-5.select2-container--open .select2-selection,
  .select2-container--bootstrap-5 .select2-dropdown .select2-search .select2-search__field:focus {
    box-shadow: none !important;
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
            <form id="expense_form" data-toggle="validator">
              <input type="hidden" name="new_request">

              <div class="table-responsive">
                <section class="d-flex justify-content-between align-items-center">
                  <div class="d-flex">
                    <div class="form-group">
                      <label class="label-control">Your full name <sup class="text-danger">*</sup></label>
                      <input type="text" class="form-control" name="full_name" placeholder="Enter your full name" data-errors="Please Enter Full Name." required>
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mx-3">
                      <label class="label-control">Company<sup class="text-danger">*</sup></label>
                      <select class="form-control select2 company" name="company_id" id="company" required>
                        <option value="">-select a company-</option>
                        <?php foreach ($companies as $value) : ?>
                          <option value="<?php echo $value->id ?>"><?php echo $value->company_name ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <div id="branch"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="label-control">Due Date <sup class="text-danger">*</sup></label>
                    <input type="date" name="due_date" class="form-control" id="dueDtate" data-errors="Please Enter Due Date." required>
                    <div class="help-block with-errors"></div>
                  </div>
                </section>

                <table class="table table-sm ">
                  <tbody>
                    <tr class="mtable">
                      <td colspan="2">
                        <table class="table table-sm" id="expense-item-table">
                          <th>SN</th>
                          <th>Item/Service <sup class="text-danger">*</sup></th>
                          <th>Quantity <sup class="text-danger">*</sup></th>
                          <th rowspan="1"></th>

                          <tr class="mtable">
                            <td><span id="sr_no">1</span></td>

                            <td>
                              <div class="input-group">
                                <input type="text" name="item_name[]" id="item_name1" data-srno="1" class="form-control col-8 item_name" placeholder="Item name" data-errors="Please Enter Item Name." required>
                                <div class="help-block with-errors"></div>

                                <select class="form-control col-4" name="unit[]" id="unit">
                                  <option value="">Unit of measure</option>
                                  <?php foreach ($units as $key => $value) : ?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </td>

                            <td>
                              <input type="text" name="quantity[]" id="quantity1" data-srno="1" class="form-control quantity" placeholder="eg. 5" data-errors="Please Enter Quantity." required>
                              <div class="help-block with-errors"></div>
                            </td>

                            <td>
                              <button type="button" id="add_row" class="btn btn-success">+</button>
                            </td>
                          </tr>
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
                          <textarea name="note" id="note" class="form-control" rows="3" placeholder="Note"></textarea>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="4" align="center">
                          <input type="hidden" class="form-control " id="total_item" value="1">
                          <button type="submit" id="create_request" class="btn btn-primary">Submit Request</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
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
      html_code += '<td><span id="sr_no">' + count + '</span></td>';

      html_code += '<td><div class="input-group"><input type="text" required="" name="item_name[]" id="item_name' + count + '" class="form-control col-8 item_name" placeholder="Item name"><select class="form-control col-4" name="unit[]" id="unit' + count + '"><?php foreach ($units as $key => $value) : ?><option value="<?php echo $key ?>"><?php echo $value ?></option><?php endforeach; ?></select></div></td>';

      html_code += '<td><input type="text" required="" name="quantity[]" id="quantity' + count + '" class="form-control quantity"  placeholder="eg. 5"></td>';

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
        url: REQ_URL,
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

    $('.company').select2({
      theme: 'bootstrap-5'
    }).on('change', function() {
      var selected = $(".select2 option:selected").val();
      console.log(selected);
      $.ajax({
        url: REQ_URL,
        method: "GET",
        data: {
          company_id: selected
        },
        success: function(data) {
          console.log(data);
          $('#branch').html(data)
        }
      });
    });


  });
</script>