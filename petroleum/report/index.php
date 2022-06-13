<?php require_once('../private/initialize.php');
require_login();

$page = 'Reports';
$page_title = 'Sales & Expenses';
include(SHARED_PATH . '/admin_header.php');

?>

<style>
  th {
    font-size: 12px;
    vertical-align: middle;
  }

  .table td {
    vertical-align: middle;
    min-width: 150px;
  }
</style>

<div class="content-wrapper">
  <div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

      <div class="card">
        <div class="card-body" id="dataReport">

        </div>
      </div>
    </div>
  </div>

</div>

<div class="modal fade" id="salesModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Other Cash Remittance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form id="remittance_form">
        <div class="modal-body p-3">
          <div class="table-responsive">
            <table class="table custom-table table-sm">
              <thead>
                <tr class="bg-primary text-white text-center">
                  <th>Narration</th>
                  <th>Quantity (LTR)</th>
                  <th>Rate</th>
                  <th>Amount (<?php echo $currency ?>)</th>
                  <th></th>
                </tr>
              </thead>

              <tbody id="remit-table">
                <tr class="text-center">
                  <td>
                    <textarea name="narration[]" class="form-control narration_1" id="narration" placeholder="Enter Narration"></textarea>
                  </td>
                  <td>
                    <input type="text" class="form-control quantity_1" id="quantity" name="quantity[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" placeholder="Quantity">
                  </td>
                  <td>
                    <input type="text" class="form-control inpRate_1" id="inpRate" name="rate[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" placeholder="Rate">
                  </td>
                  <td>
                    <input type="text" class="form-control amount_1" id="amount" name="amount[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" placeholder="0,000.00" required>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<input type="hidden" id="remId">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const REMIT_URL = 'inc/process.php';

    $('#remittance_form').on("submit", function(e) {
      e.preventDefault();
      let remId = $('#remId').val()

      let formData = new FormData(this);

      if (remId == "") {
        formData.append('new_remit', 1)
      } else {
        formData.append('edit_remit', 1)
        formData.append('remId', remId)
      }

      $.ajax({
        url: REMIT_URL,
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

    $('.edit-btn').on("click", function() {
      let remId = this.dataset.id
      $('#remId').val(remId)
      $('#password').val('')
      $('#cPass').val('')

      $.ajax({
        url: REMIT_URL,
        method: "GET",
        data: {
          remId: remId,
          get_remit: 1
        },
        dataType: 'json',
        success: function(r) {
          $('#narration').val(r.data.narration)
          $('#quantity').val(r.data.quantity)
          $('#inpRate').val(r.data.rate)
          $('#amount').val(r.data.amount)
        }
      })
    });

    $(document).on('click', '.remove-btn', function() {
      let remId = this.dataset.id;
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
            url: REMIT_URL,
            method: "POST",
            data: {
              remId: remId,
              delete_remit: 1
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

      html_code += '<td><textarea name="narration[]" id="narration" class="form-control narration_' + count + '" placeholder="Enter Narration"></textarea></td>'

      html_code += '<td><input type="text" size="12" name="quantity[]"  class="form-control quantity_' + count + '" placeholder="Quantity"></td>'

      html_code += '<td><input type="text" class="form-control inpRate_' + count + '" name="rate[]" placeholder="Rate" readonly></td>'

      html_code += '<td><input type="text" name="amount[]" class="form-control amount_' + count + '" placeholder="0,000.00" required></td>'

      html_code += '<td><button type="button" id="' + count + '" class="btn btn-secondary d-block m-auto remove_row">X</button></td></tr>'

      $('#remit-table').append(html_code);

      addRow()
    });

    $(document).on('click', '.remove_row', function() {
      let row_id = $(this).attr("id");
      $('#row_id_' + row_id).remove();
      count--;
      $('#total_item').val(count);
    });


    const addRow = () => {
      const totalItem = $('#total_item').val();
      for (let i = 1; i <= totalItem; i++) {
        let iQty = $('.quantity_' + i)
        let product = $('.product_' + i)
        let iRate = $('.inpRate_' + i)
        let amount = $('.amount_' + i)

        iRate.on('input', function() {
          let inpQty = Number(this.value)
          let inpRate = Number(iRate.val())

          let inpAmount = inpQty * inpRate
          amount.val(Math.ceil(inpAmount))
        })
      }
    }



    $(document).on('click', "#query", function() {
      let branch = $('#filter-branch').val()
      if (branch == '') {
        alert('Kindly select a branch')
        window.location.reload();
      } else {
        let selectedDate = $('.range-text').text()
        getDataSheet(branch, selectedDate)
      }
    })

    const getDataSheet = (branch, fltDate) => {
      $.ajax({
        url: REMIT_URL,
        method: "GET",
        data: {
          branch: branch,
          rangeText: fltDate,
          filter: 1
        },
        cache: false,
        beforeSend: function() {
          $('.lds-hourglass').removeClass('d-none');
        },
        success: function(r) {
          $('#dataReport').html(r)
          setTimeout(() => {
            $('.lds-hourglass').addClass('d-none');
          }, 250);
        }
      })
    }

    let selectedDate = $('.range-text').text()
    let branch = $('#filter-branch').val()
    getDataSheet(branch, selectedDate)
    addRow()
  })
</script>