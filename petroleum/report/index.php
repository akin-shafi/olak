<?php require_once('../private/initialize.php');
require_login();

if ($loggedInAdmin->admin_level != 1) {
  redirect_to('../report/');
}

$page = 'Reports';
$page_title = 'Sales Report';
include(SHARED_PATH . '/admin_header.php');

$user = $loggedInAdmin;
$dateConvertFrom = date('Y-m-d');
$dateConvertTo = date('Y-m-d');

$remittance = Remittance::find_by_undeleted(['order' => 'ASC']);
$additionalRemit = Remittance::get_total_remittance()->total_amount;

$filterDataSheet = DataSheet::data_sheet_report();
$arr = [];
foreach ($filterDataSheet as $value) {
  array_push($arr, $value->inflow);
}
$totalCashRemit = array_sum($arr);

$creditSales = Expense::find_by_expense_type(['expense' => 1]);
$totalCredit = Expense::get_total_expenses(['expense' => 1])->total_amount;

$operatingExp = Expense::find_by_expense_type(['expense' => 2]);
$totalOpExp = Expense::get_total_expenses(['expense' => 2])->total_amount;

$nonOpgExp = Expense::find_by_expense_type(['expense' => 3]);
$totalNonOpExp = Expense::get_total_expenses(['expense' => 3])->total_amount;

$headOfficeExp = Expense::find_by_expense_type(['expense' => 4]);
$totalHOExp = Expense::get_total_expenses(['expense' => 4])->total_amount;

$transExp = Expense::find_by_expense_type(['expense' => 5]);
$totalTransExp = Expense::get_total_expenses(['expense' => 5])->total_amount;

$totalSales = intval($additionalRemit) + intval($totalCashRemit);
$totalExpenses = $totalCredit + $totalOpExp + $totalNonOpExp + $totalHOExp + $totalTransExp;
$cashToHO = $totalSales - $totalExpenses;

$grandTotal = $totalExpenses + $cashToHO;
?>

<style>
  th {
    font-size: 10px;
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
        <div class="card-body">
          <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h3 class="mb-0">Cash/Sales Daily Analysis</h3>
              <a href="<?php echo '#!'?>" class="btn btn-primary">Summary</a>
            </div>
            <div class="table-responsive">
              <table class="table custom-table table-sm">
                <thead>
                  <tr class="bg-primary text-white text-center">
                    <!-- <th>Date</th> -->
                    <th>Particulars</th>
                    <th>Quantity (LTR)</th>
                    <th>Rate (<?php echo $currency ?>)</th>
                    <th>Inflow (<?php echo $currency ?>)</th>
                    <th>Credit sales (<?php echo $currency ?>)</th>
                    <th>Outflow (<?php echo $currency ?>)</th>
                    <th>Remarks</th>
                  </tr>
                </thead>

                <tbody>
                  <!-- <tr>
                    <td rowspan="100"><?php //echo date('Y-m-d', strtotime($filterDataSheet[0]->created_at)) 
                                      ?></td>
                  </tr> -->
                  <tr class="bg-primary text-white">
                    <th colspan="6">
                      <h5 class="mb-0">Cash Remittance</h5>
                    </th>
                    <th>
                      <button class="btn btn-info d-block m-auto py-0 px-2" data-toggle="modal" data-target="#salesModel">
                        &plus; Remit</button>
                    </th>
                  </tr>
                  <?php foreach ($filterDataSheet as $data) : ?>
                    <tr>
                      <td>
                        <?php echo 'Cash Sales (' . strtoupper($data->name) . ')'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->sales_quantity); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->rate); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->inflow); ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td>
                        Data is from the sales reps!
                      </td>
                    </tr>
                  <?php endforeach; ?>

                  <?php foreach ($remittance as $data) : ?>
                    <tr>
                      <td>
                        <?php echo ucwords($data->narration); ?>
                      </td>
                      <td class="text-right">
                        <?php echo $data->quantity != '' ? number_format(intval($data->quantity)) : '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo $data->rate != '' ? number_format(intval($data->rate)) : '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format(intval($data->amount)); ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td>NOTE: The remit button is used to add exceptional cash inflow that was not captured from the normal sales of the day</td>
                    </tr>
                  <?php endforeach; ?>

                  <tr>
                    <th colspan="7" class="bg-secondary text-white">
                      <h5 class="mb-0">Credit sales</h5>
                    </th>
                  </tr>

                  <?php foreach ($creditSales as $data) :
                    $rate = Product::find_by_name($data->product)->rate;
                  ?>
                    <tr>
                      <td>
                        <?php echo ucwords($data->narration); ?>
                      </td>
                      <td class="text-right">
                        <?php echo $data->quantity .  'L of ' . $data->product; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($rate); ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td>
                        This is registered from the Expenses page
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <tr>
                    <td colspan="5">
                      <h5 class="mb-0">Total</h5>
                    </td>
                    <td class="text-right">
                      <h5 class="mb-0"> <?php echo number_format($totalCredit); ?></h5>
                    </td>
                  </tr>

                  <tr>
                    <th colspan="7" class="bg-secondary text-white">
                      <h5 class="mb-0">Operating Expenses</h5>
                    </th>
                  </tr>

                  <?php foreach ($operatingExp as $data) :
                    $rate = !empty($data->product) ? Product::find_by_name($data->product)->rate : '';
                  ?>
                    <tr>
                      <td>
                        <?php echo ucwords($data->narration); ?>
                      </td>
                      <td class="text-right">
                        <?php echo !empty($data->quantity) ? $data->quantity .  'L of ' . $data->product : ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo !empty($rate) ? number_format($rate) : ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td>
                        This is registered from the Expenses page
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <tr>
                    <td colspan="5">
                      <h5 class="mb-0">Total</h5>
                    </td>
                    <td class="text-right">
                      <h5 class="mb-0"> <?php echo number_format($totalOpExp); ?></h5>
                    </td>
                    <td></td>
                  </tr>

                  <tr>
                    <th colspan="7" class="bg-secondary text-white">
                      <h5 class="mb-0">Non-Operating Expenses</h5>
                    </th>
                  </tr>

                  <?php foreach ($nonOpgExp as $data) : ?>
                    <tr>
                      <td>
                        <?php echo ucwords($data->narration); ?>
                      </td>
                      <td class="text-right">
                        <?php echo !empty($data->quantity) ? $data->quantity .  'L of ' . $data->product : ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td>
                        This is registered from the Expenses page
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <tr>
                    <td colspan="5">
                      <h5 class="mb-0">Total</h5>
                    </td>
                    <td class="text-right">
                      <h5 class="mb-0"> <?php echo number_format($totalNonOpExp); ?></h5>
                    </td>
                    <td></td>
                  </tr>

                  <tr>
                    <th colspan="7" class="bg-secondary text-white">
                      <h5 class="mb-0">Head Office Expenses</h5>
                    </th>
                  </tr>
                  <?php foreach ($headOfficeExp as $data) :
                    $rate = !empty($data->product) ? Product::find_by_name($data->product)->rate : '';
                  ?>
                    <tr>
                      <td>
                        <?php echo ucwords($data->narration); ?>
                      </td>
                      <td class="text-right">
                        <?php echo !empty($data->quantity) ? $data->quantity .  'L of ' . $data->product : ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo !empty($rate) ? number_format($rate) : ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo '-'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td>
                        This is registered from the Expenses page
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <tr>
                    <td colspan="5">
                      <h5 class="mb-0">Total</h5>
                    </td>
                    <td class="text-right">
                      <h5 class="mb-0"> <?php echo number_format($totalHOExp); ?></h5>
                    </td>
                    <td></td>
                  </tr>

                  <tr>
                    <th colspan="7" class="bg-secondary text-white">
                      <h5 class="mb-0">Transfer</h5>
                    </th>
                  </tr>

                  <?php foreach ($transExp as $data) : ?>
                    <tr>
                      <td colspan="5">
                        <?php echo ucwords($data->narration); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td>
                        This is registered from the Expenses page
                      </td>
                    </tr>
                  <?php endforeach; ?>

                  <!-- <tr class="bg-dark">
                    <td colspan="7"></td>
                  </tr> -->

                  <tr style="border: 3px solid black">
                    <td colspan="5" class="font-weight-bold text-uppercase">
                      <?php echo 'Cash to HEAD OFFICE'; ?>
                    </td>
                    <td class="text-right font-weight-bold">
                      <?php echo number_format($cashToHO); ?>
                    </td>
                    <td>
                      This section of the report is auto-generated! <br><br>
                      NOTE: Cash to head office = Total sales (<?php echo number_format($totalSales) ?>) - Total expenses (<?php echo number_format($totalExpenses); ?>)
                    </td>
                  </tr>

                  <!-- <tr class="bg-dark">
                    <td colspan="7"></td>
                  </tr> -->

                  <tr>
                    <td colspan="3">
                      <h4 class="mb-0"><?php echo 'Grand Total'; ?></h4>
                    </td>
                    <td class="text-right">
                      <h4 class="mb-0"><?php echo number_format($totalSales); ?></h4>
                    </td>
                    <td class="text-right">
                      <h4 class="mb-0">
                        <?php echo number_format($totalCredit); ?>
                      </h4>
                    </td>
                    <td class="text-right">
                      <h4 class="mb-0">
                        <span class="text-secondary" style="border-bottom: 3px double">
                          <?php echo number_format($grandTotal); ?></span>
                      </h4>
                    </td>
                    <td>
                      Since Inflow is equal to Outflow hence, account is balance! <br><br>
                      NOTE: Grand Total = Cash to head office (<?php echo number_format($cashToHO); ?>) + Sum of expenses (<?php echo number_format($totalExpenses); ?>)
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

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
                  <?php if ($loggedInAdmin->admin_level == 1) : ?>
                    <th>Action</th>
                  <?php endif; ?>
                </tr>
              </thead>

              <tbody id="remit-table">
                <tr class="text-center">
                  <td>
                    <textarea name="narration[]" class="form-control narration_1" id="narration" placeholder="Enter Narration"></textarea>
                  </td>
                  <td>
                    <input type="text" class="form-control quantity_1" id="quantity" name="quantity[]" placeholder="Quantity">
                  </td>
                  <td>
                    <input type="text" class="form-control inpRate_1" id="inpRate" name="rate[]" placeholder="Rate">
                  </td>
                  <td>
                    <input type="text" class="form-control amount_1" id="amount" name="amount[]" placeholder="0,000.00" required>
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

    window.onload = () => {
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

  })
</script>