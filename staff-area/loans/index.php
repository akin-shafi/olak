<?php
require_once('../private/initialize.php');

$id = $loggedInAdmin->id;
$employee = Employee::find_by_id($id);

$employeeInfo = Employee::find_by_id($id) ?? '';
$shortTerm = SalaryAdvance::find_by_employee_id($id, ['requested' => date('Y-m')]) ?? '';
$salary = intval($employee->present_salary);
// if (!empty($salary)) {
//    $salaryDeduction = SalaryDeduction::find_by_deductions($salary->id)->total_deductions;
//    $salaryEarning = SalaryEarning::find_by_earnings($salary->id)->total_earnings;
// }

// $employeeSalaryEarning = SalaryEarning::find_by_earnings($id);
$department = $employee->department;
$designation = $employee->branch;
$education = EmployeeEducation::find_by_employee_id($id);
$experience = EmployeeExperience::find_by_employee_id($id);

$period = 'This month';
if (!empty($salary)) {
  $accessible_loan_percentage = 0.4;
  $accessible_loan_value = $salary * $accessible_loan_percentage;

  // Loan calculation
  $loan_received = $shortTerm->total_requested ?? 0;
  $loan_balance = $accessible_loan_value - $loan_received;
  $take_home = $salary - $loan_received;

  // Percentage Difference 

  $loan_received_percentage = ($loan_received / $accessible_loan_value) * 100;
  $loan_balance_percentage = ($loan_balance / $accessible_loan_value) * 100;
  $take_home_percentage = ($take_home / $salary) * 100;
}


$page = 'Loan';
$page_title = 'My Loans';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>
<div class="page-header d-xl-flex d-block">
  <div class="page-leftheader">
    <h4 class="page-title"><?php echo $page_title; ?></h4>
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

        <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <?php if (!empty($salary)) : ?>
          <div class="row font-weight-bold">
            <div class="col-md-4">
              <div class="card-group">
                <div class="card-body p-2">
                  <div>
                    <p><i class="feather feather-circle text-purple me-2"></i>Current Salary <span class="float-right"><?php echo number_format($salary, 2) ?></span></p>
                    <p><i class="feather feather-circle text-warning me-2"></i>Accessible loan (%) <span class="float-right"><?php echo $accessible_loan_percentage * 100 ?>%</span></p>
                    <p><i class="feather feather-circle text-success me-2"></i>Accessible loan (₦) <span class="float-right"><?php echo number_format($accessible_loan_value, 2); ?></span></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="card-group">
                <div class="card-body border-0 p-2">
                  <div class="d-flex justify-content-between mb-3">
                    <div>
                      <span class="d-block">Loan requested</span>
                    </div>
                    <div>
                      <span class="text-success"><?php echo round($loan_received_percentage) ?>%</span>
                    </div>
                  </div>
                  <h3 class="mb-3"><?php echo $currency . " " . number_format($loan_received, 2) ?></h3>
                  <div class="progress mb-2" style="height: 5px;">
                    <div class="progress-bar bg-secondary d-none" role="progressbar" style="width: 100%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mb-0 text-muted"><?php echo $period; ?></p>
                </div>

                <?php if ($loan_received != 0) : ?>
                  <div class="card-body border border-top-0 border-bottom-0 p-2">
                    <div class="d-flex justify-content-between mb-3">
                      <div>
                        <span class="d-block">Loan Balance</span>
                      </div>
                      <div>
                        <span class="text-danger"><?php echo round($loan_balance_percentage); ?>%</span>
                      </div>
                    </div>
                    <h3 class="mb-3"><?php echo $currency . " " . number_format($loan_balance, 2) ?></h3>
                    <div class="progress mb-2" style="height: 5px;">
                      <div class="progress-bar bg-secondary d-none" role="progressbar" style="width: 100%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0 text-muted"><?php echo $period; ?></p>
                  </div>
                <?php
                endif;
                ?>


                <div class="card-body border-0 p-2">
                  <div class="d-flex justify-content-between mb-3">
                    <div>
                      <span class="d-block">Current take home</span>
                    </div>
                    <div>
                      <span class="text-danger"><?php echo round($take_home_percentage); ?>%</span>
                    </div>
                  </div>
                  <h3 class="mb-3"><?php echo $currency . " " . number_format($take_home, 2) ?></h3>
                  <div class="progress mb-2" style="height: 5px;">
                    <div class="progress-bar bg-secondary d-none" role="progressbar" style="width: 100%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mb-0 text-muted"><?php echo $period; ?></p>
                </div>
              </div>
            </div>
          </div>

        <?php else : ?>
          <h5 class="text-center">Salary is not set for
            <span class="text-primary">
              <?php echo ucwords($employee->full_name()); ?>
            </span>
          </h5>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="col-xl-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header border-0">
        <h4 class="card-title">Salary Advance Summary</h4>
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
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Amount (₦): activate to sort column ascending" style="width: 120.396px;">Amount (₦)</th>
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Date Requested: activate to sort column ascending" style="width: 119.979px;">Date Requested</th>
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Date Issued: activate to sort column ascending" style="width: 119.979px;">Date Issued</th>
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Aprroval Status: activate to sort column ascending" style="width: 158.458px;">Approval Status</th>
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 133.708px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sn = 1;
                    $dated = date('Y-m');
                    foreach (SalaryAdvanceDetail::find_by_salary_advance($loggedInAdmin->id, ['requested' => $dated]) as $loan) : ?>
                      <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo strtoupper($loan->ref_no) ?></td>
                        <td><?php echo number_format($loan->amount) ?></td>
                        <td><?php echo date('Y-m-d', strtotime($loan->date_requested)) ?></td>
                        <td><?php echo $loan->date_issued != '0000-00-00' ? date('Y-m-d', strtotime($loan->date_issued)) : 'Not Set' ?></td>

                        <td>
                          <?php
                          switch ($loan->status):
                            case '1':
                              echo '<span class="badge badge-warning">Pending</span>';
                              break;
                            case '2':
                              echo '<span class="badge badge-warning">Pending</span>';
                              break;
                            case '3':
                              echo '<span class="badge badge-success">Approved</span>';
                              break;
                            default:
                              echo '<span class="badge badge-danger">Rejected</span>';
                              break;
                          endswitch;
                          ?>
                        </td>

                        <td class="text-start d-flex">
                          <button class="btn btn-sm btn-outline-primary me-2" data-id="<?php echo $loan->id ?>" id="get_advance_detail" data-bs-toggle="modal" data-bs-target="#loan_detail"> <i class="feather feather-eye"></i> </button>
                          <!-- <button class="btn btn-sm btn-outline-danger" data-id="<?php //echo $loan->id 
                                                                                      ?>" id="delete_loan" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2"></i> </button> -->
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
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Amount Requested (₦): activate to sort column ascending" style="width: 120.396px;">Amount Requested (₦)</th>
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Amount Committed (₦): activate to sort column ascending" style="width: 120.396px;">Amount Committed (₦)</th>
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Duration: activate to sort column ascending" style="width: 119.979px;">Duration</th>
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Date Requested: activate to sort column ascending" style="width: 119.979px;">Date Requested</th>
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Date Approved: activate to sort column ascending" style="width: 119.979px;">Date Approved</th>
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Aprroval Status: activate to sort column ascending" style="width: 158.458px;">Approval Status</th>
                      <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 133.708px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sn = 1;
                    foreach (LongTermLoanDetail::find_by_undeleted() as $loan) :
                      $longTerm = LongTermLoan::find_by_employee_id($loan->employee_id);
                    ?>
                      <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo strtoupper($loan->ref_no) ?></td>
                        <td><?php echo number_format($longTerm->amount_requested) ?></td>
                        <td><?php echo number_format($longTerm->commitment) ?></td>
                        <td><?php echo ucwords($loan->commitment_duration) ?></td>
                        <td><?php echo date('Y-m-d', strtotime($loan->created_at)) ?></td>
                        <td><?php echo $loan->date_approved != '0000-00-00' ? date('Y-m-d', strtotime($loan->date_approved)) : 'Not Set' ?></td>

                        <td>
                          <?php
                          switch ($loan->status):
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
                          endswitch;
                          ?>
                        </td>


                        <td class="text-start d-flex">
                          <button class="btn btn-sm btn-outline-primary me-2" data-id="<?php echo $loan->id ?>" id="get_long_detail" data-bs-toggle="modal" data-bs-target="#loan_detail"> <i class="feather feather-eye"></i> </button>
                          <!-- <button class="btn btn-sm btn-outline-danger" data-id="<?php //echo $loan->id 
                                                                                      ?>" id="delete_long_loan" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2"></i> </button> -->
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

<div class="modal fade" id="loan_detail">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Loan Details</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
      <div class="modal-body">
        <h6>Notes:</h6>
        <p id="loan_notes"></p>
      </div>
      <div class="modal-footer">
        <div class="ms-auto"> <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a> </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="expensemodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Expense</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
      <div class="modal-body">
        <div class="leave-types">
          <div class="form-group"> <label class="form-label">Title:</label> <input type="text" class="form-control" placeholder="text" value=""> </div>
          <div class="form-group"> <label class="form-label">Purchase Place:</label> <input type="text" class="form-control" placeholder="text" value=""> </div>
          <div class="form-group"> <label class="form-label">Price ($):</label> <input type="text" class="form-control" placeholder="$30" value=""> </div>
          <div class="form-group">
            <label class="form-label">Date:</label>
            <div class="input-group">
              <input type="text" name="singledaterange" class="form-control" placeholder="select dates">
              <div class="input-group-append">
                <div class="input-group-text"> <i class="bx bx-calendar"></i> </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label">Upload Invoice</div>
            <div class="form-group"> <label for="form-label" class="form-label"></label> <input class="form-control" type="file"> </div>
          </div>
          <div class="form-group"> <label class="form-label">Note:</label> <textarea class="form-control" rows="3">Some text here...</textarea> </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="ms-auto"> <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a> <a href="#" class="btn btn-primary">Submit</a> </div>
      </div>
    </div>
  </div>
</div>


<?php include('../inc/modal/all.php') ?>
<?php include(SHARED_PATH . '/footer.php') ?>

<script>
  $(document).ready(function() {
    function numberWithCommas(params) {
      return params.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    const message = (req, res) => {
      swal(req + "!", res, {
        icon: req,
        timer: 3000,
        buttons: {
          confirm: {
            className: req == "error" ? "btn btn-danger" : "btn btn-success",
          },
        },
      }).then(() => location.reload());
    };

    const deleted = async (url) => {
      swal({
        title: "Are you sure?",
        text: "You won't be able to reverse this!",
        icon: "warning",
        buttons: {
          confirm: {
            text: "Yes, delete it!",
            className: "btn btn-danger",
          },
          cancel: {
            visible: true,
            className: "btn btn-secondary",
          },
        },
      }).then((Delete) => {
        if (Delete) {
          fetch(url)
            .then((res) => res.json())
            .then((data) => {
              swal({
                title: "Deleted!",
                text: data.message,
                icon: "success",
                buttons: {
                  confirm: {
                    className: "btn btn-success",
                  },
                },
              }).then(() => location.reload());
            });
        } else {
          swal.close();
        }
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

    const LOAN_URL = "../inc/loan/";

    const loanForm = document.getElementById("add_loan_form");

    loanForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      submitForm(LOAN_URL, loanForm);
    });

    $(document).on('click', '#get_advance_detail', async function() {
      let loan_id = this.dataset.id;
      let data = await fetch(LOAN_URL + '?loan_id=' + loan_id + '&get_note')
      let res = await data.json();

      $('#loan_notes').html(res.note);
    })

    // $(document).on("click", "#delete_loan", function() {
    //   let loan_id = this.dataset.id;
    //   deleted(LOAN_URL + "?loan_id=" + loan_id + "&deleted");
    // });

    $(document).on('click', '#get_long_detail', async function() {
      let loan_id = this.dataset.id;
      let data = await fetch(LOAN_URL + '?loan_id=' + loan_id + '&get_long_note')
      let res = await data.json();

      $('#loan_notes').html(res.note);
    })

    // $(document).on("click", "#delete_long_loan", function() {
    //   let loan_id = this.dataset.id;
    //   deleted(LOAN_URL + "?loan_id=" + loan_id + "&deleteLong");
    // });

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