<?php require_once('../private/initialize.php');
require_login();

$page = 'Expenses';
$page_title = 'Expenses';
include(SHARED_PATH . '/admin_header.php');

$productObj = Product::find_by_undeleted();
$productArray = [];

foreach ($productObj as $value) {
  array_push($productArray, $value->name);
}
$fltDate = date('Y-m-d');

$products = is_unique_array($productArray);
$expenses = Expense::find_by_expense_type($fltDate);
$totalExpenses = Expense::get_total_expenses($fltDate)->total_amount;

?>
<style>
  th {
    font-size: 10px;
    vertical-align: middle;
  }

  /* td {
    min-width: 100px;
  } */
</style>

<div class="content-wrapper">
  <div class="d-flex justify-content-end">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#expenseModel">
      &plus; Add</button>
  </div>

  <div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

      <div class="card">
        <div class="card-body">
          <div class="table-container border-0 shadow" id="expenseReport">

          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="modal fade" id="expenseModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Record Expenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form id="expense_form">
        <div class="modal-body">
          <div class="container">
            <div class="d-flex justify-content-end align-items-center">
              <div class="mb-3 ">
                <select class="form-control" name="branch_id" id="branch_id" required>
                  <option value="">select branch</option>
                  <?php foreach (Branch::find_by_undeleted() as $data) : ?>
                    <option value="<?php echo $data->id ?>"><?php echo ucwords($data->name) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table custom-table table-sm">
                <thead>
                  <tr class="bg-primary text-white text-center">
                    <th>Expense Type</th>
                    <th>Product</th>
                    <th>Rate</th>
                    <th>Quantity (LTR)</th>
                    <th>Amount (<?php echo $currency ?>)</th>
                    <th>Narration</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody id="exp-table">
                  <tr class="text-center">
                    <td>
                      <select name="expense_type[]" class="form-control expense_type_1" id="expense_type">
                        <option value="">select type</option>
                        <?php foreach (Expense::EXPENSE_TYPE as $key => $data) : ?>
                          <option value="<?php echo $key ?>"><?php echo ucwords($data) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td>
                      <select name="product[]" class="form-control product_1" id="product">
                        <option value="">select product</option>
                        <?php foreach (array_unique($products) as $data) : ?>
                          <option value="<?php echo $data ?>"><?php echo strtoupper($data) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td>
                      <input type="text" class="form-control inpRate_1" id="inpRate" placeholder="Rate" readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control quantity_1" id="quantity" name="quantity[]" placeholder="Quantity">
                    </td>
                    <td>
                      <input type="text" class="form-control amount_1" id="amount" name="amount[]" placeholder="0,000.00" required>
                    </td>
                    <td>
                      <textarea name="narration[]" class="form-control narration_1" id="narration" placeholder="Enter Narration"></textarea>
                    </td>

                    <td>
                      <button type="button" class="btn btn-primary d-block m-auto" id="add_row">&plus;</button>
                    </td>

                  </tr>
                </tbody>
              </table>
            </div>

            <input type="hidden" class="form-control" id="total_item" value="1" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<input type="hidden" id="expId">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const EXPENSE_URL = 'inc/process.php';

    $('#expense_form').on("submit", function(e) {
      e.preventDefault();
      let expId = $('#expId').val()

      let formData = new FormData(this);

      if (expId == "") {
        formData.append('new_expense', 1)
      } else {
        formData.append('edit_expense', 1)
        formData.append('expId', expId)
      }

      $.ajax({
        url: EXPENSE_URL,
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
          $('.lds-hourglass').removeClass('d-none');
        },
        success: function(r) {
          if (r.success == true) {
            successAlert(r.msg);
            setTimeout(() => {
              $('.lds-hourglass').addClass('d-none');
              window.location.reload()
            }, 250);
          } else {
            errorAlert(r.msg);
          }
        }
      })
    });

    $(document).on("click", '.edit-btn', function() {
      let expId = this.dataset.id
      $('#expId').val(expId)
      $('#password').val('')
      $('#cPass').val('')

      $.ajax({
        url: EXPENSE_URL,
        method: "GET",
        data: {
          expId: expId,
          get_expense: 1
        },
        dataType: 'json',
        success: function(r) {
          $('#branch_id').val(r.data.branch_id)
          $('#expense_type').val(r.data.expense_type)
          $('#product').val(r.data.product)
          $('#quantity').val(r.data.quantity)
          $('#amount').val(r.data.amount)
          $('#narration').val(r.data.narration)
        }
      })
    });

    $(document).on('click', '.remove-btn', function() {
      let expId = this.dataset.id;
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
            url: EXPENSE_URL,
            method: "POST",
            data: {
              expId: expId,
              delete_expense: 1
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


    let count = 1;
    $(document).on('click', '#add_row', function() {
      count = count + 1;
      $('#total_item').val(count);

      let html_code = '';
      html_code += '<tr id="row_id_' + count + '">';

      html_code += '<td><select class="form-control" name="expense_type[]"><option>select type</option><?php foreach (Expense::EXPENSE_TYPE as $key => $data) { ?><option value="<?php echo $key; ?>"><?php echo $data; ?></option><?php } ?></select></td>'

      html_code += '<td><select class="form-control product_' + count + '" name="product[]"><option value="">select product</option><?php foreach (array_unique($products) as $data) { ?><option value="<?php echo $data; ?>"><?php echo $data; ?></option><?php } ?></select></td>'

      html_code += '<td><input type="text" class="form-control inpRate_' + count + '" placeholder="Rate" readonly></td>'

      html_code += '<td><input type="text" size="12" name="quantity[]"  class="form-control quantity_' + count + '" placeholder="Quantity"></td>'

      html_code += '<td><input type="text" name="amount[]" class="form-control amount_' + count + '" placeholder="0,000.00" required></td>'

      html_code += '<td><textarea name="narration[]" id="narration" class="form-control narration_' + count + '" placeholder="Enter Narration"></textarea></td>'

      html_code += '<td><button type="button" id="' + count + '" class="btn btn-secondary d-block m-auto remove_row">X</button></td></tr>'

      $('#exp-table').append(html_code);

      addRow()
    });

    $(document).on('click', '.remove_row', function() {
      let row_id = $(this).attr("id");
      $('#row_id_' + row_id).remove();
      count--;
      $('#total_item').val(count);
    });

    window.onload = () => {
      addRow()

      let branch = $('#fBranch').val()
      let filterDate = $('#filter_date').val()
      getDataSheet(branch, filterDate)
    }

    const addRow = () => {
      const totalItem = $('#total_item').val();
      for (let i = 1; i <= totalItem; i++) {
        let iQty = $('.quantity_' + i)
        let product = $('.product_' + i)
        let iRate = $('.inpRate_' + i)
        let amount = $('.amount_' + i)

        iQty.on('input', function() {
          let inpQty = Number(this.value)
          let inpRate = Number(iRate.val())

          let inpAmount = inpQty * inpRate
          amount.val(Math.ceil(inpAmount))
        })

        product.on('change', function() {
          let pName = this.value

          $.ajax({
            url: EXPENSE_URL,
            method: "GET",
            data: {
              pName: pName,
              get_rate: 1
            },
            dataType: 'json',
            success: function(r) {
              let inpRate = iRate.val(r.data.rate)
              const qty = iQty.val() != '' ? Number(iQty.val()) : 0
              const rate = Number(inpRate.val())
              let rAmount = qty * rate
              amount.val(Math.ceil(rAmount))
            }
          })
        })
      }
    }






    $(document).on('click', "#query", function() {
      let branch = $('#fBranch').val()
      if (branch == '') {
        alert('Kindly select a branch')
        window.location.reload();
      } else {
        let filterDate = $('#filter_date').val()
        getDataSheet(branch, filterDate)
      }
    })

    const getDataSheet = (branch, fltDate) => {
      $.ajax({
        url: EXPENSE_URL,
        method: "GET",
        data: {
          branch: branch,
          filterDate: fltDate,
          filter: 1
        },
        cache: false,
        beforeSend: function() {
          $('.lds-hourglass').removeClass('d-none');
        },
        success: function(r) {
          $('#expenseReport').html(r)
          setTimeout(() => {
            $('.lds-hourglass').addClass('d-none');
          }, 250);
        }
      })
    }

  })
</script>