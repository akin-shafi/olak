<?php require_once('../private/initialize.php');

$page = 'Request';
$page_title = 'Add Requests';
include(SHARED_PATH . '/admin_header.php');

$isHidden = true;

$companies = Company::find_by_undeleted();
$branches = Branch::find_all_branch();

$isRequester = $loggedInAdmin->admin_level == 4 ? true : false;
// $data = Expenses::find_by_id(1) ?? '';
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

          <form data-toggle="validator" class="row" enctype="multipart/form-data">
            <div class="form-group col-lg-4 col-sm-12">
              <label for="date">Date</label>
              <input type="date" class="form-control" id="date" name="date" value="<?php //echo $data->date ?? ''; ?>">
            </div>
            <div class="form-group col-lg-4 col-sm-12">
              <label for="expense_type">Expense Type</label>
              <select class="form-control select2" id="expense_type" name="expense_type" >
                <option value="">Select</option>
                <?php foreach (ExpensesType::find_by_undeleted() as $key => $value) { ?>
                <option value="<?= $value->id ?>"><?= $value->expense_account ?></option>
                <?php }?>
              </select>

              <!-- <input type="text" class="form-control" id="expense_type" name="expense_type" value="<?php //echo $data->expense_type ?? ''; ?>"> -->
            </div>
            <div class="form-group col-lg-4 col-sm-12">
              <label for="amount">Amount</label>
              <input type="text" class="form-control" id="amount" name="amount" value="<?php //echo $data->amount ?? ''; ?>">
            </div>
            <div class="form-group col-lg-4 col-sm-12">
              <label for="paid_through">Paid Through</label>
              <select class="form-control" id="paid_through" name="paid_through" >
                <option value="">Select</option>
                <?php foreach (Expenses::PAID_THROUGH as $key => $value) { ?>
                <option value="<?= $key ?>"><?= $value ?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group col-lg-4 col-sm-12">
              <label for="vendor">Vendor</label>
              <input type="text" class="form-control" id="vendor" name="vendor" value="<?php //echo $data->vendor ?? ''; ?>">
            </div>
            <div class="form-group col-lg-4 col-sm-12">
              <label for="reference">Reference</label>
              <input type="text" class="form-control" id="reference" name="reference" value="<?php //echo $data->reference ?? ''; ?>">
            </div>
            <div class="form-group col-lg-12 col-sm-12">
              <label for="note">Note</label>
              <textarea class="form-control" placeholder="Max 500 character" id="note" name="note"><?php //echo $data->note ?? ''; ?></textarea>
            </div>
            <div class="form-group col-lg-12 col-sm-12">
            <button type="submit" class="w-100 btn btn-primary">Submit</button>
            </div>
          </form>

           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<input type="hidden" value="<?php //echo $data->isRequester ?? ''; ?>" id="requester">
<?php include(SHARED_PATH . '/admin_footer.php') ?? ''; ?>

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

      html_code += '<td><input type="number" name="unit_price[]" value="0" class="form-control form-control-sm unit_price_' + count + '"  placeholder="eg. 120" <?php //echo $data->isRequester ? 'readonly' : '' ?>></td>';

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

      let requester = $('#requester').val()

      for (let i = 1; i <= totalItem; i++) {
        let qty = $('.quantity_' + i)
        let unitPrice = $('.unit_price_' + i)
        let amount = $('.amount_' + i)

        if (requester != '') {
          qty.on('input', function() {
            let subTotal = Number(qty.val()) * Number(unitPrice.val())
            amount.val(subTotal);

            calTotal();
          })
        } else {
          unitPrice.on('input', function() {
            let subTotal = Number(qty.val()) * Number(unitPrice.val())
            amount.val(subTotal);

            calTotal();
          })
        }

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