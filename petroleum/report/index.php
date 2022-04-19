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

$filterDataSheet = DataSheet::data_sheet_report();
$creditSales = Expense::find_by_expense_type(['expense' => 1]);
$totalCredit = Expense::get_total_expenses(['expense' => 1])->total_amount;

$operatingExp = Expense::find_by_expense_type(['expense' => 2]);
$totalOpExp = Expense::get_total_expenses(['expense' => 2])->total_amount;

$nonOpgExp = Expense::find_by_expense_type(['expense' => 3]);
$totalNonOpExp = Expense::get_total_expenses(['expense' => 3])->total_amount;

$headOfficeExp = Expense::find_by_expense_type(['expense' => 4]);
$totalHOExp = Expense::get_total_expenses(['expense' => 4])->total_amount;
?>
<style>
  th {
    font-size: 10px;
    vertical-align: middle;
  }

  .table td {
    vertical-align: baseline;
    min-width: 50px;
  }
</style>

<div class="content-wrapper">
  <!-- <div class="d-flex justify-content-end">
    <?php //if ($loggedInAdmin->admin_level == 1) : 
    ?>
      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#userModel">
        &plus; Create User</button>
    <?php //endif; 
    ?>
  </div> -->

  <div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

      <div class="card">
        <div class="card-body">
          <div class="table-container">
            <h3>Cash/Sales Daily Analysis</h3>
            <div class="table-responsive">
              <table class="table custom-table table-sm">
                <thead>
                  <tr class="bg-primary text-white text-center">
                    <th>Date</th>
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
                  <tr>
                    <td rowspan="100"><?php echo date('Y-m-d', strtotime($filterDataSheet[0]->created_at)) ?></td>
                  </tr>
                  <tr>
                    <th colspan="7" class="bg-primary text-white">
                      <h5 class="mb-0">Cash Remittance</h5>
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
                        <?php echo number_format(0); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format(0); ?>
                      </td>
                      <td></td>
                    </tr>
                  <?php endforeach; ?>

                  <?php foreach ($filterDataSheet as $data) : ?>
                    <tr>
                      <td>
                        <?php echo 'Surplus on (' . strtoupper($data->name) . ')'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format(0); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format(0); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format(0); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format(0); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format(0); ?>
                      </td>
                      <td></td>
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
                        <?php echo ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td></td>
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
                        <?php echo ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td></td>
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
                        <?php echo ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td></td>
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
                        <?php echo ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo ''; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($data->amount); ?>
                      </td>
                      <td></td>
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

                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>

<div class="modal fade" id="userModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form id="user_form" enctype="multipart/form-data">
        <input type="hidden" name="user[created_by]" value="<?php echo $loggedInAdmin->id ?>" readonly>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fName" class="col-form-label">Full Name</label>
                  <input type="text" class="form-control" name="user[full_name]" id="fName" placeholder="Full name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="aLevel" class="col-form-label">Admin Level</label>
                  <select name="user[admin_level]" class="form-control" id="aLevel" required>
                    <option value="">select level</option>
                    <?php foreach (Admin::ADMIN_LEVEL as $key => $data) : ?>
                      <option value="<?php echo $key ?>"><?php echo $data ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cName" class="col-form-label">Company Name</label>
                  <input type="text" class="form-control" id="cName" value="<?php echo $company->name ?>" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="regNo" class="col-form-label">Branch</label>
                  <select name="user[branch_id]" class="form-control" id="bId" required>
                    <option value="">select branch</option>
                    <?php foreach ($branches as $data) : ?>
                      <option value="<?php echo $data->id ?>"><?php echo ucwords($data->name) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="col-form-label">Email</label>
                  <input type="text" class="form-control" name="user[email]" id="email" placeholder="Email" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone" class="col-form-label">Phone</label>
                  <input type="tel" class="form-control" name="user[phone]" id="phone" placeholder="Phone number" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password" class="col-form-label">Password</label>
                  <input type="password" class="form-control" name="user[password]" id="password" placeholder="12345">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cPass" class="col-form-label">Confirm password</label>
                  <input type="password" class="form-control" name="user[confirm_password]" id="cPass" placeholder="12345">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="address" class="col-form-label">Address</label>
                  <textarea name="user[address]" id="address" class="form-control" placeholder="Contact address" rows="3"></textarea>
                </div>
              </div>
              <div class="col-md-6 m-auto">
                <div class="form-group">
                  <label for="avatar" class="col-form-label">Profile Image</label>
                  <input type="file" class="form-control" name="profile" id="avatar">
                </div>
              </div>
            </div>
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

<input type="hidden" id="uId">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const USER_URL = 'inc/process.php';

    $('#user_form').on("submit", function(e) {
      e.preventDefault();
      let uId = $('#uId').val()

      let formData = new FormData(this);

      if (uId == "") {
        formData.append('new_user', 1)
      } else {
        formData.append('edit_user', 1)
        formData.append('uId', uId)
      }

      $.ajax({
        url: USER_URL,
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
      let uId = this.dataset.id
      $('#uId').val(uId)
      $('#password').val('')
      $('#cPass').val('')

      $.ajax({
        url: USER_URL,
        method: "GET",
        data: {
          uId: uId,
          get_user: 1
        },
        dataType: 'json',
        success: function(r) {
          $('#fName').val(r.data.full_name)
          $('#email').val(r.data.email)
          $('#phone').val(r.data.phone)
          // $('#cName').val(r.data.name)
          $('#aLevel').val(r.data.admin_level)
          $('#bId').val(r.data.branch_id)
          $('#address').val(r.data.address)
        }
      })
    });

    $(document).on('click', '.remove-btn', function() {
      let uId = this.dataset.id;
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
            url: USER_URL,
            method: "POST",
            data: {
              uId: uId,
              delete_user: 1
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
  })
</script>