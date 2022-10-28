<?php
require_once('../private/initialize.php');

$page = 'Loan';
$page_title = 'Salary Advance';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>


<div class="page-header d-xl-flex d-block">
  <div class="page-leftheader">
    <div class="btn-group">
      <h4 class="btn btn-outline-primary">
        <a href="<?php echo url_for('loan/hr-loan.php') ?>">Long Term Loan</a>
      </h4>
      <h4 class="btn btn-primary ">Salary Advance</h4>
    </div>
  </div>
  <div class="page-rightheader ms-md-auto">
    <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
      <div class="btn-list">
        <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#loan_request">
          Make Request</button>
        <!-- <a href="<?php //echo url_for('loan/hr-loan.php') 
                      ?>" class="btn btn-outline-dark"><i class="las la-arrow-left"></i> Long Term</a> -->
        <?php //foreach (Configuration::find_all() as $value) :
        //if (Configuration::find_all()[0]->loan_config == 1) :
        //echo '<button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#loan_request">Make Request</button>';
        //else :
        //echo '<button type="button" class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#loan_request_closed">Loan Request</button>';
        //endif;
        ////endforeach; 
        ?>

        <button class="btn btn-primary d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
      </div>
    </div>
  </div>
</div>




<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12">
    <div class="row">
      <?php

      foreach (SalaryAdvanceDetail::STATUS as $key => $value) {
        $count = count(SalaryAdvanceDetail::find_by_status($key)) ?? 0;
        $color = SalaryAdvanceDetail::COLOR[$key];
      ?>
        <div class="col-xl-3 col-lg-6 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-7">
                  <div class="mt-0 text-start">
                    <span class="font-weight-semibold"><?php echo $value ?></span>
                    <h3 class="mb-0 mt-1 <?php echo $color ?>"><?php echo $count ?></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>


    <div class="row">
      <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header  border-0">
            <h4 class="card-title">Salary Advance Summary</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                <div class="row">
                  <div class="col-sm-12">

                    <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-table" role="grid" aria-describedby="hr-table_info">
                      <thead>
                        <tr role="row">
                          <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="No" style="width: 17.8125px;">SN</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Emp Name: activate to sort column ascending" style="width: 185.017px;">Ref. No</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Emp Name: activate to sort column ascending" style="width: 185.017px;">Emp Name</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Loan Type: activate to sort column ascending" style="width: 159.028px;">Loan Type</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 113.663px;">Amount</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Date Requested: activate to sort column ascending" style="width: 94.0799px;">Date Requested</th>
                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 113.663px;">Status</th>
                          <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 64.5833px;">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $sn = 1;
                        $dated = date('Y-m');
                        foreach (SalaryAdvanceDetail::find_by_undeleted() as $key => $value) {
                          $employee = Employee::find_by_id($value->employee_id);
                          $class = $key % 2 == 0 ? 'even' : 'odd';
                          $image =  '../assets/images/users/male.png';
                        ?>
                          <tr class="<?php echo $class; ?>">
                            <td><?php echo $sn++; ?></td>
                            <td>
                              <a href="<?php echo url_for('loan/receipt.php?id=' . $value->id) ?>">
                                <?php echo $value->ref_no; ?></a>
                            </td>
                            <td>
                              <a href="<?php echo url_for('employees/hr-empview.php?id=' . $employee->id); ?>" class="d-flex align-items-center">
                                <span class="avatar avatar-md brround me-3" style="background-image: url( <?php echo $image ?>);"></span>

                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                  <h6 class="mb-1 fs-14"><?php echo $employee->full_name(); ?></h6>
                                  <p class="text-muted mb-0 fs-12"><?php echo $employee->email ?></p>
                                </div>
                              </a>

                            <td><?php echo $value->type == 1 ? 'Salary Advance' : 'Long Term'; ?></td>
                            <td><?php echo $value->amount ? number_format($value->amount) : 'Not Set'; ?></td>
                            <td><?php echo $value->date_requested ? date('M. jS, Y', strtotime($value->date_requested)) : 'Not Set'; ?></td>

                            <td>
                              <?php switch ($value->status):
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
                                <?php if (in_array($value->status, [1, 2, 3])) : ?>
                                  <button class="dropdown-item status" data-id="<?php echo $value->id; ?>" data-status="2">
                                    <i class="feather feather-loader"></i>
                                    Pending
                                  </button>
                                  <button class="dropdown-item status" data-id="<?php echo $value->id; ?>" data-status="3">
                                    <i class="feather feather-check"></i>
                                    Approve
                                  </button>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item text-dark status" data-id="<?php echo $value->id; ?>" data-status="4" <?php echo $value->status == 4 ? 'disabled' : '' ?>>
                                  <i class="feather feather-delete"></i>
                                  Reject
                                </button>
                              </div>
                            </td>
                            <td>
                              <button data-id="<?php echo $value->id ?>" class="btn btn-outline-info btn-sm" id="editSalaryAdvance">
                                Edit</button>
                              <button data-id="<?php echo $value->id ?>" class="btn btn-outline-danger btn-sm deleted">Delete</button>
                            </td>
                          </tr>
                        <?php } ?>

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
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="add_loan_form" class="mb-0">
        <input type="hidden" name="loan[created_by]" value="<?php echo $loggedInAdmin->id ?>" id="">
        <input type="hidden" name="updatedSalaryAdvance" id="upLoan" readonly>

        <div class="modal-body">
          <div class="form-group">
            <label>Employees</label>
            <select class="form-control select2 select2-hidden-accessible employeeId" name="loan[employee_id]" id="employee_id" required>
              <option value="">Select Employee</option>
              <?php foreach (Employee::find_by_undeleted() as $employee) : ?>
                <option value="<?php echo $employee->id ?>">
                  <?php echo ucwords($employee->full_name())  ?> (<?php echo  !empty($employee->present_salary) ? number_format(intval($employee->present_salary), 2) : 'Not Set' ?>)

                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Loan Type</label>
                <select class="form-control select2 select2-hidden-accessible" name="loan[type]" id="loan_type" required>
                  <option value="">Select Loan Type</option>
                  <option value="1" selected>Salary Advance</option>
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

          <div class="table-responsive border my-3 " id="isAdvance">
            <table class="table table-hover table-sm ">
              <thead class="text-center">
                <tr>
                  <th>Salary</th>
                  <th>Loan Obtainable (40%) of Basic</th>
                  <th>Loan Balance</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <td><span id="sal"></span></td>
                  <td><span id="allowable"></span></td>
                  <td><span id="loan_balance"></span></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="form-group">
            <label>Note</label>
            <textarea name="loan[note]" class="form-control" id="note" cols="3" placeholder="Notes"></textarea>
          </div>

          <div class="form-group">
            <label class="col-form-label">Loan Form <small class="text-info">(optional)</small> </label>
            <input type="file" name="filename" class="form-control">
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary" id="short_btn">Submit</button>
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
        }, 1000);
      }
    };

    const EMPLOYEE_URL = "../inc/employee/";
    const RECEIPT_URL = "./receipt.php";
    const PROCESS_URL = './inc/process.php';

    const loanModal = new bootstrap.Modal(
      document.querySelector("#loan_request")
    );
    const loanForm = document.getElementById("add_loan_form");
    const shortTitle = document.querySelector("#loan-title");
    const shortBtn = document.querySelector("#short_btn");

    loanForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      submitForm(EMPLOYEE_URL, loanForm);
    });

    $("tbody").on("click", "#editSalaryAdvance", async function() {
      let id = this.dataset.id;
      $('#upLoan').val(id);
      let data = await fetch(PROCESS_URL + "?salAdvId=" + id);
      let res = await data.json();

      $('#employee_id').attr('disabled', true)
      $('#employee_id').select2({
        dropdownParent: $('#loan_request')
      }).val(res.data.employee_id).trigger('change.select2')

      $('#amount').val(res.data.amount)
      $('#note').val(res.data.note)

      shortTitle.innerText = "Edit Salary Advance";
      shortBtn.innerText = "Update";

      loanModal.show();

      shortBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        submitForm(PROCESS_URL, loanForm);
      });
    });

    $('tbody').on('click', '.deleted', function() {
      let salAdvance = this.dataset.id;

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
                removeSA: salAdvance
              },
              dataType: 'json',
              success: function(data) {
                message("success", data.message);

                setTimeout(() => {
                  window.location.reload();
                }, 1000);
              }
            })
          }
        });

    })

    $('tbody').on('click', '.status', function() {
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
      const data = await fetch(EMPLOYEE_URL + '?detailId=' + id + '&salary_advance_status=' + status);
      const res = await data.json();
      if (status == 4) {
        swal(res.message, {
          icon: "success",
        });
      } else if (status == 3) {
        window.location.href = RECEIPT_URL + '?id=' + id
      } else {
        message('success', res.message)
        setTimeout(() => {
          window.location.reload();
        }, 1000);
      }
    }

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

    let isAdvance = document.getElementById('isAdvance');
    $('#loan_type').select2({
      dropdownParent: $('.select_loan')
    }).on("change", () => {
      if ($("#loan_type").val() == 2) {
        // isAdvance.classList.add('d-none')
      } else {
        // isAdvance.classList.remove('d-none')
      }
    });
  });
</script>