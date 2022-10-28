<?php
require_once('../private/initialize.php');

$page = 'Loan';
$page_title = 'Special Loan Management';
include(SHARED_PATH . '/header.php');
$datatable = '';

$date = $_GET['date'] ?? '';
$emp_id = $_GET['emp_id'] ?? '';
$amount = $_GET['amount'] ?? '';

if (empty($emp_id)) redirect_to('../loan/hr-loan.php');

$longTerm = LongTermLoan::find_by_employee_id($emp_id, ['requested' => $date]);
$longTermDet = LongTermLoanDetail::find_by_employee_id($emp_id, ['requested' => $date]);
$employee = Employee::find_by_id($emp_id);

$amountRequest = intval($longTerm->amount_requested);
$amountPaid = intval($longTerm->amount_paid);
$balance = $amountRequest - $amountPaid;
?>

<div class="page-header d-xl-flex justify-content-between align-items-center d-block">
  <a href="<?php echo url_for('/loan/hr-loan.php') ?>" class="btn btn-primary">&leftarrow; Back</a>
</div>


<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12">
    <div class="row">
      <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header border-0">
            <h4 class="card-title">Long Term Loan Details</h4>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-lg-4 col-md-5 col-sm-12">
                <div class="list-group">
                  <div class="list-group-item list-group-item-action flex-column align-items-start active">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Employee Name</h5>
                    </div>

                    <div class="d-flex align-items-center">
                      <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
                      <div class="me-3 mt-0 mt-sm-1 d-block">
                        <h6 class="mb-1 fs-14"><?php echo $employee->first_name ? $employee->full_name() : 'Not Set' ?></h6>
                        <p class="text-muted mb-0 fs-12"><?php echo strtolower($employee->email) ?></p>
                        <p class="text-muted mb-0 fs-12">Emp ID: <?php echo  str_pad($longTermDet->employee_id, 3, '0', STR_PAD_LEFT); ?></p>
                      </div>
                    </div>

                    <small><?php echo strtoupper($longTermDet->ref_no) ?></small>
                  </div>

                  <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Previous Loan</h5>
                    </div>
                    <p class="mb-1"><?php echo '₦' . number_format($amountRequest, 2) ?></p>
                    <small>Date Requested: <?php echo date('Y-m-d', strtotime($longTermDet->created_at)) ?></small><br>
                    <small>Date Approved: <?php echo $longTermDet->date_approved != '0000-00-00' ? date('Y-m-d', strtotime($longTermDet->date_approved)) : 'Not Set' ?></small><br>
                  </div>

                  <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Previous Payment</h5>
                    </div>
                    <p class="mb-1"><?php echo '₦' . number_format(intval($longTerm->commitment), 2) ?></p>
                    <small>Start Deduction: <?php echo $longTerm->deduction_date != '' ? date('Y-m-d', strtotime($longTerm->deduction_date)) : 'Not Set' ?></small><br>
                    <small>Duration: <?php echo ucwords($longTermDet->commitment_duration) ?></small><br>
                  </div>

                  <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Balance</h5>
                      <small class="font-weight-bold"><?php echo number_format($balance, 2) ?></small>
                      <input type="hidden" value="<?php echo $balance ?>" name="loan[amount_paid]" form="add_loan_form" id="balance" readonly>
                    </div>
                  </div>

                  <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between mb-3">
                      <h5 class="mb-0">Total Loan</h5>
                      <small class="font-weight-bold total_loan"><?php echo number_format($balance, 2) ?></small>
                      <input type="hidden" name="loan[amount]" value="<?php echo $balance ?>" class="total_loan" form="add_loan_form" readonly>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Duration</h5>
                      <small class="font-weight-bold duration"><?php echo $amountPaid / $balance ?></small>
                      <input type="hidden" name="loan[duration]" class="duration" readonly>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-8 col-md-7 col-sm-12 border">
                <form id="add_loan_form" class="mb-0">
                  <input type="hidden" name="special_loan" value="<?php echo $longTermDet->id ?>" id="longId" readonly>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="ded_date" class="form-label">Start Deduction</label>
                          <input type="date" name="loan[deduction_date]" class="form-control" id="ded_date" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Amount (<?php echo $currency ?>)</label>
                          <input type="number" class="form-control" value="<?php echo $amount ?>" id="amount" placeholder="Request Amount" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Pay-back Duration (In Month)</label>
                          <input type="text" class="form-control duration" value="0" name="loan[loan_duration]" id="duration" placeholder="Duration" readonly>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Monthly Deduction (<?php echo $currency ?>)</label>
                          <input type="text" class="form-control deduction" name="loan[loan_deduction]" id="deduction" placeholder="Deduction Rate" readonly>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Note</label>
                          <textarea name="loan[note]" class="form-control" cols="3" placeholder="Notes"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button class="btn btn-primary" id="loan_btn">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php') ?>
<script src="<?php echo url_for('assets/plugins/chart.min/chart.min.js') ?>"></script>
<script src="<?php echo url_for('assets/plugins/chart.min/rounded-barchart.js') ?>"></script>
<script src="<?php echo url_for('assets/plugins/apexchart/apexcharts.js') ?>"></script>

<script>
  $(document).ready(function() {
    function numberWithCommas(params) {
      return params.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    const message = (req, res) => {
      swal(req + "!", res, {
        icon: req,
        // timer: 2000,
        buttons: {
          confirm: {
            className: req == "error" ? "btn btn-danger" : "btn btn-success",
          },
        },
      });
    };

    const submitForm = async (url, payload) => {
      const formData = new FormData(payload);

      const data = await fetch(url, {
        method: "POST",
        body: formData,
      });

      const res = await data.json();

      if (res.errors) {
        message("error", res.errors);
      }

      if (res.message) {
        message("success", res.message);
      }
    };

    const PROCESS_URL = './inc/process.php';

    const loanForm = document.getElementById("add_loan_form");
    const loanBtn = document.querySelector("#loan_btn");

    loanBtn.addEventListener("click", async (e) => {
      e.preventDefault();
      submitForm(PROCESS_URL, loanForm);
      setTimeout(() => {
        window.location.href = './hr-loan.php';
      }, 1000);

    });


    $('#amount').on('input', function() {
      let amount = Number($(this).val());
      calDuration(amount)
    })

    const calDuration = function(params) {
      let balance = Number($('#balance').val())

      let totalLoan = balance + Number(params)

      let percentageDeduction = totalLoan * 0.1
      let payDuration = totalLoan / percentageDeduction

      $('.total_loan').text(numberWithCommas(totalLoan) + '.00')
      $('.total_loan').val(totalLoan)

      $('.duration').text(payDuration)
      $('.duration').val(payDuration)

      $('.deduction').val(percentageDeduction)
    }

    let amount = Number($('#amount').val());
    calDuration(amount)



  });
</script>