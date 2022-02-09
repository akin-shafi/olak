<?php
require_once('../private/initialize.php');

$page = 'Loan';
$page_title = 'Loan Management';
include(SHARED_PATH . '/header.php');
$datatable = '';

$totalLoanRequested = intval(count(LongTermLoanDetail::find_by_undeleted())) + intval(count(SalaryAdvanceDetail::find_by_undeleted()));

$longLoanPending        = LongTermLoanDetail::find_by_loan_approved(['status' => 1])->counts;
$salaryAdvancePending   = SalaryAdvanceDetail::find_by_loan_approved(['status' => 1])->counts;
$salaryAdvancePending2  = SalaryAdvanceDetail::find_by_loan_approved(['status' => 2])->counts;

$longLoanApproved       = LongTermLoanDetail::find_by_loan_approved(['status' => 2])->counts;
$salaryAdvanceApproved  = SalaryAdvanceDetail::find_by_loan_approved(['status' => 3])->counts;

$longLoanRejected       = LongTermLoanDetail::find_by_loan_approved(['status' => 3])->counts;
$salaryAdvanceRejected  = SalaryAdvanceDetail::find_by_loan_approved(['status' => 4])->counts;

?>

<div class="page-header d-xl-flex d-block">
  <div class="page-leftheader">
     <div class="btn-group">
      
      <h4 class="page-title me-3">Long Term Loan |</h4>
      <h4 class="page-title me-3 text-muted"><a style="text-decoration: underline;" href="<?php echo url_for('loan/salary_adv_mgt.php') ?>">Salary Advance</a></h4>
    </div>

   
  </div>
  <div class="page-rightheader ms-md-auto">
    <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
      <div class="btn-list">
        <?php foreach (Configuration::find_all() as $value) :
          if ($value->loan_config == 1) :
            echo '<button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#loan_request">Loan Request</button>';
          else :
            echo '<button type="button" class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#loan_request_closed">Loan Request</button>';
          endif;
        endforeach; ?>

        <button class="btn btn-primary d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12">
    <div class="row">

      <div class="col-xl-3 col-lg-6 col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-7">
                <div class="mt-0 text-start">
                  <span class="font-weight-semibold">Total Requested</span>
                  <h3 class="mb-0 mt-1 text-primary"><?php echo $totalLoanRequested ?? 0 ?></h3>
                </div>
              </div>
              <div class="col-5">
                <div class="icon1 bg-primary-transparent my-auto  float-end"> <i class="las la-business-time"></i> </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-lg-6 col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-7">
                <div class="mt-0 text-start">
                  <span class="font-weight-semibold">Total Pending</span>
                  <h3 class="mb-0 mt-1 text-secondary"><?php echo intval($longLoanPending + $salaryAdvancePending + $salaryAdvancePending2) ?? 0 ?></h3>
                </div>
              </div>
              <div class="col-5">
                <div class="icon1 bg-secondary-transparent my-auto  float-end"> <i class="las la-hourglass-half"></i> </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-lg-6 col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-7">
                <div class="mt-0 text-start">
                  <span class="font-weight-semibold">Total Approved</span>
                  <h3 class="mb-0 mt-1 text-success"><?php echo intval($longLoanApproved + $salaryAdvanceApproved) ?? 0 ?></h3>
                </div>
              </div>
              <div class="col-5">
                <div class="icon1 bg-success-transparent my-auto  float-end"> <i class="las la-exchange-alt"></i> </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-lg-6 col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-7">
                <div class="mt-0 text-start">
                  <span class="font-weight-semibold">Total Rejected</span>
                  <h3 class="mb-0 mt-1 text-danger"><?php echo intval($longLoanRejected + $salaryAdvanceRejected) ?? 0 ?></h3>
                </div>
              </div>
              <div class="col-5">
                <div class="icon1 bg-danger-transparent my-auto  float-end"> <i class="las la-sitemap"></i> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header border-0">
            <h4 class="card-title">Long Term Loan Summary</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div id="emp-attendance_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                <div class="row">
                  <div class="col-sm-12">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" role="grid" aria-describedby="emp-attendance_info">
                      <thead>
                        <tr role="row">
                          <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 52.5417px;">SN</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Ref No: activate to sort column ascending" style="width: 169.062px;">Ref No</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Ref No: activate to sort column ascending" style="width: 169.062px;">Emp Name</th>

                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Amount Requested (₦): activate to sort column ascending" style="width: 120.396px;">Amount Requested (₦)</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Amount Committed (₦): activate to sort column ascending" style="width: 120.396px;">Amount Committed (₦)</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Duration: activate to sort column ascending" style="width: 119.979px;">Duration</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Date Requested: activate to sort column ascending" style="width: 119.979px;">Date Requested</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Date Approved: activate to sort column ascending" style="width: 119.979px;">Date Approved</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 133.708px;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $sn = 1;
                        foreach (LongTermLoanDetail::find_by_undeleted() as $loan) :
                          $longTerm = LongTermLoan::find_by_employee_id($loan->employee_id);
                          $employee = Employee::find_by_id($loan->employee_id);
                        ?>
                          <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo strtoupper($loan->ref_no) ?></td>
                            <td>
                              <div class="d-flex">
                                <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                  <h6 class="mb-1 fs-14"><?php echo $employee->first_name ? $employee->full_name() : 'Not Set' ?></h6>
                                  <p class="text-muted mb-0 fs-12"><?php echo strtolower($employee->email) ?></p>
                                  <p class="text-muted mb-0 fs-12">Emp ID: <?php echo  str_pad($loan->employee_id, 3, '0', STR_PAD_LEFT); ?></p>
                                </div>
                              </div>
                            </td>
                            <td><?php echo number_format(intval($longTerm->amount_requested)) ?></td>
                            <td><?php echo number_format(intval($longTerm->commitment)) ?></td>
                            <td><?php echo ucwords($loan->commitment_duration) ?></td>
                            <td><?php echo date('Y-m-d', strtotime($loan->created_at)) ?></td>
                            <td><?php echo $loan->date_approved != '0000-00-00' ? date('Y-m-d', strtotime($loan->date_approved)) : 'Not Set' ?></td>
                            <td>
                              <div class="btn-group">
                                <button class="btn <?php echo $loan->status == 1 ? 'btn-warning' : 'btn-outline-warning' ?> btn-icon status" data-id="<?php echo $loan->id; ?>" data-status="1">
                                  <i class="feather feather-loader"></i>
                                  Pending
                                </button>
                                <button class="btn <?php echo $loan->status == 2 ? 'btn-success' : 'btn-outline-success' ?> btn-icon status" data-id="<?php echo $loan->id; ?>" data-status="2">
                                  <i class="feather feather-check"></i>
                                  Approve
                                </button>
                                <button class="btn <?php echo $loan->status == 3 ? 'btn-danger' : 'btn-outline-danger' ?> btn-icon status" data-id="<?php echo $loan->id; ?>" data-status="3">
                                  <i class="feather feather-delete"></i>
                                  Reject
                                </button>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>

                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<div id="loan_request" class="modal custom-modal fade select_loan" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loan-title">Loan Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="add_loan_form" class="mb-0">
        <div class="modal-body">
          <div class="form-group">
            <label>Employees</label>
            <select class="form-control select2 select2-hidden-accessible employeeId" name="loan[employee_id]" id="employee_id" required>
              <option value="">Select Employee</option>
              <?php foreach (Employee::find_by_undeleted() as $employee) : ?>
                <option value="<?php echo $employee->id ?>">
                  <?php echo ucwords($employee->full_name()) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Loan Type</label>
                <select class="form-control select2 select2-hidden-accessible" name="loan[type]" id="loan_type" required>
                  <option value="">Select Loan Type</option>
                  <option value="2">Long Term</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Amount</label>
                <input type="number" class="form-control" name="loan[amount]" placeholder="Request Amount" required>
              </div>
            </div>
          </div>

          <div class="row d-none" id="isLongTerm">
            <div class="col-md-6">
              <div class="form-group">
                <label>Pay-back Duration</label>
                <input type="text" class="form-control" name="loan[loan_duration]" placeholder="Duration">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Monthly Deduction</label>
                <input type="number" class="form-control" name="loan[loan_deduction]" placeholder="Deduction Rate">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Note</label>
            <textarea name="loan[note]" class="form-control" cols="3" placeholder="Notes"></textarea>
          </div>

          <div class="form-group">
            <label class="col-form-label">Loan Form <small class="text-info">(optional)</small> </label>
            <input type="file" name="filename" class="form-control">
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Submit</button>
        </div>
      </form>
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
        timer: 2000,
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
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      }
    };

    const EMPLOYEE_URL = "../inc/employee/";

    const loanForm = document.getElementById("add_loan_form");

    loanForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      submitForm(EMPLOYEE_URL, loanForm);
    });

    $('tbody').on('click', '.status', async function() {
      let detailId = this.dataset.id;
      let loan_status = this.dataset.status;

      const data = await fetch(EMPLOYEE_URL + '?detailId=' + detailId + '&long_term_status=' + loan_status);
      const res = await data.json();

      message('success', res.message);
      setTimeout(() => {
        window.location.reload();
      }, 2000);
    })

    $('#employee_id').select2({
      dropdownParent: $('.select_loan')
    }).on("change", async () => {
      let emp_id = $("#employee_id").val()
      let data = await fetch(EMPLOYEE_URL + '?employeeId=' + emp_id)
      let res = await data.json();

      let salary = res.data.present_salary;
      let balance = res.balance;

      document.getElementById('sal').innerText = salary != '' ? numberWithCommas(salary) : 'Not set';
      document.getElementById('allowable').innerText = numberWithCommas(salary * 0.4);
      document.getElementById('loan_balance').innerText = balance != '' ? numberWithCommas(balance) : 'Not set'
    });

    let isLongTerm = document.getElementById('isLongTerm');
    $('#loan_type').select2({
      dropdownParent: $('.select_loan')
    }).on("change", () => {
      if ($("#loan_type").val() == 2) {
        isLongTerm.classList.remove('d-none')
      } else {
        isLongTerm.classList.add('d-none')
      }
    });
  });
</script>