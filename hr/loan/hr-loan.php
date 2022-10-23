<?php
require_once('../private/initialize.php');

$page = 'Loan';
$page_title = 'Loan Management';
include(SHARED_PATH . '/header.php');
$datatable = '';

$year = date('Y');
$totalLoanRequested = intval(count(LongTermLoanDetail::find_loan_by_year($year)));

$longLoanPending  = LongTermLoanDetail::find_by_loan_approved(['status' => 2])->counts;
$longLoanApproved = LongTermLoanDetail::find_by_loan_approved(['status' => 3])->counts;
$longLoanRejected = LongTermLoanDetail::find_by_loan_approved(['status' => 4])->counts;

?>

<div class="page-header d-xl-flex d-block">
  <div class="page-leftheader">
    <div class="btn-group">
      <h4 class="btn btn-primary">Long Term Loan</h4>
      <h4 class="btn btn-outline-primary ">
        <a href="<?php echo url_for('loan/salary_adv_mgt.php') ?>">Salary Advance</a>
      </h4>
    </div>
  </div>

  <div class="page-rightheader ms-md-auto">
    <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
      <div class="btn-list">
        <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#loan_request">
          Loan Request</button>

        <?php //foreach (Configuration::find_all() as $value) :
        //if (Configuration::find_all()[0]->loan_config == 1) :
        //echo '<button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#loan_request">Loan Request</button>';
        //else :
        // echo '<button type="button" class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#loan_request_closed">Loan Request</button>';
        //endif;
        //endforeach; 
        ?>

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
                  <h3 class="mb-0 mt-1 text-secondary"><?php echo intval($longLoanPending) ?? 0 ?></h3>
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
                  <h3 class="mb-0 mt-1 text-success"><?php echo intval($longLoanApproved) ?? 0 ?></h3>
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
                  <h3 class="mb-0 mt-1 text-danger"><?php echo intval($longLoanRejected) ?? 0 ?></h3>
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
                          <th class="border-bottom-0 sorting_disabled" aria-label="#ID">SN</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-label="Ref No: activate to sort column ascending">Ref No</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-label="Ref No: activate to sort column ascending">Emp Name</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-label="Amount Requested (₦): activate to sort column ascending">Amount Requested (₦)</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-label="Amount Committed (₦): activate to sort column ascending">Amount Committed (₦)</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-label="Duration: activate to sort column ascending">Duration</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-label="Date Requested: activate to sort column ascending">Date Requested</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-label="Start Deduction: activate to sort column ascending">Start Deduction</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-label="Date Approved: activate to sort column ascending">Date Approved</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-label="Status: activate to sort column ascending">Status</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-label="Action: activate to sort column ascending">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $sn = 1;
                        foreach (LongTermLoan::find_loan_by_year(date('Y')) as $loan) :
                          $longTermDet = LongTermLoanDetail::find_by_employee_id($loan->employee_id);
                          $employee = Employee::find_by_id($loan->employee_id);
                          // pre_r($loan);
                        ?>
                          <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo strtoupper($longTermDet->ref_no) ?></td>
                            <td>
                              <div class="d-flex align-items-center">
                                <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                  <h6 class="mb-1 fs-14"><?php echo $employee->first_name ? $employee->full_name() : 'Not Set' ?></h6>
                                  <p class="text-muted mb-0 fs-12"><?php echo strtolower($employee->email) ?></p>
                                  <p class="text-muted mb-0 fs-12">Emp ID: <?php echo  str_pad($longTermDet->employee_id, 3, '0', STR_PAD_LEFT); ?></p>
                                </div>
                              </div>
                            </td>
                            <td><?php echo number_format(intval($loan->amount_requested)) ?></td>
                            <td><?php echo number_format(intval($loan->commitment)) ?></td>
                            <td><?php echo ucwords($loan->loan_duration) ?></td>
                            <td><?php echo date('Y-m-d', strtotime($loan->date_requested)) ?></td>
                            <td><?php echo $loan->deduction_date != ''
                                  ? date('Y-m-d', strtotime($loan->deduction_date)) : 'Not Set' ?></td>

                            <td><?php echo $longTermDet->date_approved == '' ? 'Not Yet approved' : date('Y-m-d', strtotime($longTermDet->date_approved)) ?></td>

                            <td>
                              <?php switch ($longTermDet->status):
                                case '2':
                                  echo '<span class="badge bg-warning">
                                  <i class="feather feather-loader"></i> Pending</span>';
                                  break;
                                case '3':
                                  echo '<span class="badge bg-success">
                                  <i class="feather feather-check"></i> Approved</span>';
                                  break;
                                case '4':
                                  echo '<span class="badge bg-danger">
                                  <i class="feather feather-x-circle"></i> Rejected</span>';
                                  break;

                                default:
                                  echo '<span class="badge bg-primary">
                                  <i class="feather feather-compass"></i> New</span>';
                                  break;
                              endswitch; ?>

                              <button class="btn btn-outline-primary " type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="triggerId">
                                <?php if (in_array($longTermDet->status, [1, 2])) : ?>
                                  <button class="dropdown-item status" data-id="<?php echo $longTermDet->id; ?>" data-status="2">
                                    <i class="feather feather-loader"></i>
                                    Pending
                                  </button>
                                  <button class="dropdown-item status" data-id="<?php echo $longTermDet->id; ?>" data-status="3">
                                    <i class="feather feather-check"></i>
                                    Approve
                                  </button>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item text-dark status" data-id="<?php echo $longTermDet->id; ?>" data-status="4" <?php echo $longTermDet->status == 4 ? 'disabled' : '' ?>>
                                  <i class="feather feather-delete"></i>
                                  Reject
                                </button>
                              </div>
                            </td>

                            <td>
                              <button data-id="<?php echo $longTermDet->id ?>" class="btn btn-outline-info btn-sm" id="editLongLoan">
                                Edit</button>
                              <button data-id="<?php echo $longTermDet->id ?>" class="btn btn-outline-danger btn-sm deleted">Delete</button>
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
        <input type="hidden" name="updatedLongLoan" id="upLoan" readonly>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Employees</label>
                <select class="form-control select2 select2-hidden-accessible employeeId" name="loan[employee_id]" id="employee_id" required>
                  <option value="">Select Employee</option>
                  <?php foreach (Employee::find_by_undeleted() as $employee) : ?>
                    <option value="<?php echo $employee->id ?>">
                      <?php echo ucwords($employee->full_name())  ?> (<?php echo  !empty($employee->present_salary) ? number_format(intval($employee->present_salary), 2) : 'Not Set' ?>)</option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="ded_date" class="form-label">Start Deduction</label>
                <input type="date" name="loan[deduction_date]" class="form-control" id="ded_date" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Loan Type</label>
                <select class="form-control select2 select2-hidden-accessible" name="loan[type]" id="loan_type" required>
                  <option value="">Select Loan Type</option>
                  <option value="2" selected>Long Term</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Amount</label>
                <input type="number" class="form-control" name="loan[amount]" id="amount" placeholder="Request Amount" required>
              </div>
            </div>
          </div>

          <div class="row " id="isLongTerm">
            <div class="col-md-6">
              <div class="form-group">
                <label>Monthly Deduction (Currency)</label>
                <input type="text" class="form-control insert" name="loan[loan_deduction]" id="deduction" placeholder="Deduction Rate" readonly>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Pay-back Duration (In Month)</label>
                <input type="text" class="form-control insert" value="0" id="duration" name="loan[loan_duration]" placeholder="Duration">
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
          <button class="btn btn-primary" id="loan_btn">Submit</button>
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

      if (res.option) {
        swal({
            title: res.errors,
            text: "Do you want to put in for special loan?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((isSpecial) => {
            if (isSpecial) {
              let amount = $('#amount').val()
              let url = './special-loan.php?emp_id=' + res.emp_id + '&amount=' + amount + '&date=' + res.date_requested
              window.location.href = url
            }
          });
      } else if (res.message) {
        message("success", res.message);
        setTimeout(() => {
          window.location.reload();
        }, 1000);
      } else {
        message("error", res.errors);
      }


    };

    const EMPLOYEE_URL = "../inc/employee/";
    const PROCESS_URL = './inc/process.php';

    const loanModal = new bootstrap.Modal(
      document.querySelector("#loan_request")
    );
    const loanForm = document.getElementById("add_loan_form");
    const loanTitle = document.querySelector("#loan-title");
    const loanBtn = document.querySelector("#loan_btn");

    loanForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      submitForm(EMPLOYEE_URL, loanForm);
    });

    $("tbody").on("click", "#editLongLoan", async function() {
      let id = this.dataset.id;
      $('#upLoan').val(id);
      let data = await fetch(PROCESS_URL + "?longId=" + id);
      let res = await data.json();
      let params = res.data

      $('#employee_id').attr('disabled', true)
      $('#employee_id').select2({
        dropdownParent: $('#loan_request')
      }).val(params.employee_id).trigger('change.select2')

      $('#loan_type').val(params.type)
      $('#amount').val(params.amount_requested)
      $('#deduction').val(params.commitment)
      $('#duration').val(params.duration)
      $('#ded_date').val(params.deduction_date)

      loanTitle.innerText = "Edit Long Term Loan";
      loanBtn.innerText = "Update";

      loanModal.show();

      loanBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        submitForm(PROCESS_URL, loanForm);
      });
    });

    $('tbody').on('click', '.deleted', function() {
      let longLoan = this.dataset.id;

      swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((del) => {
          if (del) {
            $.ajax({
              url: PROCESS_URL,
              method: "POST",
              data: {
                removeLL: longLoan
              },
              dataType: 'json',
              success: function(data) {
                message("success", data.msg);

                setTimeout(() => {
                  window.location.reload();
                }, 1000);
              }
            })
          }
        });

    })

    $('tbody').on('click', '.status', async function() {
      let detailId = this.dataset.id;
      let loan_status = this.dataset.status;

      if (loan_status == 4) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              updateStatus(detailId, loan_status)
            }
          });
      } else {
        updateStatus(detailId, loan_status)
      }
    })


    const updateStatus = async (id, status) => {
      const data = await fetch(EMPLOYEE_URL + '?detailId=' + id + '&long_term_status=' + status);
      const res = await data.json();
      if (status == 4) {
        swal(res.message, {
          icon: "success",
        });
      } else {
        message('success', res.message)
      }

      setTimeout(() => {
        window.location.reload();
      }, 1000);
    }

    $('#employee_id').select2({
      dropdownParent: $('.select_loan')
    }).on("change", async () => {
      let emp_id = $("#employee_id").val()
      let data = await fetch(EMPLOYEE_URL + '?employeeId=' + emp_id)
      let res = await data.json();

      let salary = res.data.present_salary;
      let balance = res.balance;


      // document.getElementById('sal').innerText = salary != '' ? numberWithCommas(salary) : 'Not set';
      // document.getElementById('allowable').innerText = numberWithCommas(salary * 0.4);
      // document.getElementById('loan_balance').innerText = balance != '' ? numberWithCommas(balance) : 'Not set'
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



    $('#amount').on('input', function() {
      let amount = Number($(this).val());
      let result = amount * 0.1
      let payDuration = amount / result

      $('#deduction').val(result)
      $('#duration').val(payDuration)
    })

    $('#duration').on('input', function() {
      let amount = $("#amount").val();
      let duration = Number($(this).val())
      let result = amount / duration
      // let payDuration = amount / result

      $('#deduction').val(result)
      // $('#duration').val(payDuration)
    })

    // $('#deduction').on('input', function() {
    //   let deAmount = Number($(this).val());
    //   calculator('duration', deAmount)
    // })

    // $('#duration').on('input', function() {
    //   let durVal = Number($(this).val());
    //   calculator('deduction', durVal)
    // })

    const calculator = (elem, divisor) => {
      let dividend = Number($("#amount").val());
      let element = '#' + elem
      let result = dividend / divisor;
      $(element).val(Math.ceil(result));
    }
  });
</script>