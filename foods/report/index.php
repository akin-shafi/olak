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

              setTimeout(() => window.location.reload(), 500);
            }
          });

        }
      })

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

    window.onload = () => {
      let selectedDate = $('.range-text').text()
      let branch = $('#filter-branch').val()

      getExpenses(branch, selectedDate)
      addRow()
    }

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
      let selectedDate = $('.range-text').text()
      let branch = $('#filter-branch').val()
      getExpenses(branch, selectedDate)
    })

    const getExpenses = (branch, date) => {
      $.ajax({
        url: REMIT_URL,
        method: "GET",
        data: {
          branch: branch,
          rangeText: date,
          filter: 1
        },
        success: function(r) {
          $('#dataReport').html(r)
        }
      })
    }

  })
</script>