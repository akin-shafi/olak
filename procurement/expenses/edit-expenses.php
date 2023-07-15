<?php require_once('../private/initialize.php');

$page = 'Request';
$page_title = 'Edit Expenses';
include(SHARED_PATH . '/admin_header.php');


if (empty($_GET['id'])) {
  redirect_to(url_for('requests/'));
}

$expense_id = $_GET['id'] ?? 1;
$data = Expenses::find_by_id($expense_id);

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
        <div class="my-2">
          <a href="<?php echo url_for('expenses/') ?>" class="btn btn-primary"><< Back</a>
        </div>

        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title"><?= $page_title ?></h4>
            </div>
          </div>
          <div class="card-body">
          <form data-toggle="validator" class="row" enctype="multipart/form-data">
            <div class="form-group col-lg-4 col-sm-12">
              <label for="date">Date</label>
              <input type="date" class="form-control" id="date" name="date" value="<?php echo $data->date ?? ''; ?>">
            </div>
            <div class="form-group col-lg-4 col-sm-12">
              <label for="expense_type">Expense Type</label>
              <select class="form-control select2" id="expense_type" name="expense_type" >
                <option value="">Select</option>
                <?php foreach (ExpensesType::find_by_undeleted() as $key => $value) { ?>
                <option value="<?= $value->id ?>" <?php echo !empty($data->expense_type) && $data->expense_type == $value->id ? 'selected' : '' ?>><?= $value->expense_account ?></option>
                <?php }?>
              </select>
              <!-- <input type="text" class="form-control" id="expense_type" name="expense_type" value="<?php //echo $data->expense_type ?? ''; ?>"> -->
            </div>
            <div class="form-group col-lg-4 col-sm-12">
              <label for="amount">Amount</label>
              <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $data->amount ?? ''; ?>">
            </div>
            <div class="form-group col-lg-4 col-sm-12">
              <label for="paid_through">Paid Through</label>
              <select class="form-control" id="paid_through" name="paid_through" >
                <option value="">Select</option>
                <?php foreach (Expenses::PAID_THROUGH as $key => $value) { ?>
                <option value="<?= $key ?>" <?php echo !empty($data->paid_through) && $data->paid_through == $key ? 'selected' : '' ?>><?= $value ?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group col-lg-4 col-sm-12">
              <label for="vendor">Vendor</label>
              <input type="text" class="form-control" id="vendor" name="vendor" value="<?php echo $data->vendor ?? ''; ?>">
            </div>
            <div class="form-group col-lg-4 col-sm-12">
              <label for="reference">Reference</label>
              <input type="text" class="form-control" id="reference" name="reference" value="<?php echo $data->reference ?? ''; ?>">
            </div>
            <div class="form-group col-lg-12 col-sm-12">
              <label for="note">Note</label>
              <textarea class="form-control" placeholder="Max 500 character" id="note" name="note"><?php echo $data->note ?? ''; ?></textarea>
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


<input type="hidden" value="<?php echo $isRequester; ?>" id="requester">
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
      let qty = document.querySelectorAll('.qty')
      let requester = $('#requester').val()

      if (requester != '') {
        qty.forEach(elem => {
          elem.addEventListener('input', function() {
            let tRow = $(this).closest('#expense-table tr');

            let qty = parseInt(tRow.find('.quantity').val(), 10)
            let price = parseInt(tRow.find('.unit_price').val(), 10)
            let subTotal = qty * price

            tRow.find('.amount').val(subTotal)
            calTotal();
          })
        });
      } else {
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

    }

    const calTotal = () => {
      // const grandTotal = $('#grand_total')
      let totalAmount = 0;
      let amt = $('.amt')

      amt.each((i, el) => {
        if (el.value == '') return;
        totalAmount += parseFloat(el.value);
      })
      $('#grand').text(numberWithCommas(totalAmount));
      $('#grand_total').val(totalAmount);
    }
  });
</script>