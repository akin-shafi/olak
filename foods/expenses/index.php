<?php require_once('../private/initialize.php');
require_login();

$page = 'Expenses';
$page_title = 'Expenses';
include(SHARED_PATH . '/admin_header.php');

// $productObj = Product::find_by_undeleted();
// $productArray = [];

// foreach ($productObj as $value) {
//   array_push($productArray, $value->name);
// }
// $fltDate = date('Y-m-d');

// $products = is_unique_array($productArray);
// $expenses = Expense::find_by_expenses($fltDate);
// $totalExpenses = Expense::get_total_expenses($fltDate)->total_amount;

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
    <?php if ($loggedInAdmin->admin_level != 3) : ?>
      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#expenseModel">
        &plus; Add Expenses</button>
    <?php endif; ?>
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
      <form id="expenses_form">
        <div class="modal-body">
          <div class="container">
            <div class="d-flex justify-content-end align-items-center">
              <div class="mb-3 ">
                <input type="hidden" class="form-control" name="branch_id" value="<?php echo $loggedInAdmin->branch_id ?>">
                <select class="form-control" id="branch_id" disabled>
                  <option value="">select branch</option>
                  <?php foreach (Branch::find_by_undeleted() as $data) : ?>
                    <option value="<?php echo $data->id ?>" <?php echo $data->id == $loggedInAdmin->branch_id ? 'selected' : '' ?>>
                      <?php echo ucwords($data->name) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table custom-table table-sm">
                <thead>
                  <tr class="bg-primary text-white text-center">
                    <th>Title</th>
                    <th>Quantity</th>
                    <th>Amount (<?php echo $currency ?>)</th>
                    <th>Narration</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody id="exp-table">
                  <tr class="text-center">
                    <td>
                      <input type="text" name="title[]" class="form-control title_1" id="title" required>
                    </td>
                    <td>
                      <input type="number" class="form-control quantity_1" id="quantity" name="quantity[]" </td>
                    <td>
                      <input type="number" class="form-control amount_1" id="amount" name="amount[]" required>
                    </td>
                    <td>
                      <textarea name="narration[]" class="form-control narration_1" id="narration" required></textarea>
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
          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="save_expenses">Save</button>
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

    $('#expenses_form').on("submit", function(e) {
      e.preventDefault();
      $('#save_expenses').attr('disabled', true)
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
          $('#title').val(r.data.title)
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

      html_code += '<td><input type="text" size="12" name="title[]"  class="form-control title_' + count + '" required></td>'

      html_code += '<td><input type="number" size="12" name="quantity[]"  class="form-control quantity_' + count + '"></td>'

      html_code += '<td><input type="number" name="amount[]" class="form-control amount_' + count + '" required></td>'

      html_code += '<td><textarea name="narration[]" id="narration" class="form-control narration_' + count + '" required></textarea></td>'

      html_code += '<td><button type="button" id="' + count + '" class="btn btn-secondary d-block m-auto remove_row">X</button></td></tr>'

      $('#exp-table').append(html_code);

      // addRow()
    });

    $(document).on('click', '.remove_row', function() {
      let row_id = $(this).attr("id");
      $('#row_id_' + row_id).remove();
      count--;
      $('#total_item').val(count);
    });

    $(document).on('click', "#query", function() {
      let selectedDate = $('.range-text').text()
      let branch = $('#filter-branch').val()
      getExpenses(branch, selectedDate)
    })

    const getExpenses = (branch, date) => {
      $.ajax({
        url: EXPENSE_URL,
        method: "GET",
        data: {
          branch: branch,
          rangeText: date,
          filter: 1
        },
        success: function(r) {
          $('#expenseReport').html(r)
        }
      })
    }

    let selectedDate = $('.range-text').text()
    let branch = $('#filter-branch').val()
    getExpenses(branch, selectedDate)
  })
</script>