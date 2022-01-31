<?php
require_once('../private/initialize.php');

$page = 'Loan';
$page_title = 'Loan List';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="page-header d-xl-flex d-block">
  <div class="page-leftheader">
    <h4 class="page-title">Salary Advance</h4>
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
                  <span class="font-weight-semibold"><?php echo $value?></span>
                  <h3 class="mb-0 mt-1 <?php echo $color ?>"><?php echo $count ?></h3>
                </div>
              </div>
              <!-- <div class="col-5">
                <div class="icon1 bg-success-transparent my-auto  float-end"> <i class="las la-users"></i> </div>
              </div> -->
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
                          <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 64.5833px;">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $sn = 1;
                        foreach (SalaryAdvanceDetail::find_by_undeleted() as $key => $value) {
                          $employee = Employee::find_by_id($value->employee_id);
                          $class = $key % 2 == 0 ? 'even' : 'odd';
                          $image =  '../assets/images/users/male.png';
                        ?>
                          <tr class="<?php echo $class; ?>">
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $value->ref_no; ?></td>
                            <td>
                              <a href="<?php echo url_for('employees/hr-empview.php?id=' . $value->id); ?>" class="d-flex">
                                <span class="avatar avatar-md brround me-3" style="background-image: url( <?php echo $image ?>)"></span>

                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                  <h6 class="mb-1 fs-14"><?php echo $employee->full_name(); ?></h6>
                                  <p class="text-muted mb-0 fs-12"><?php echo $employee->email ?></p>
                                </div>
                              </a>

                            <td><?php echo $value->type == 1 ? 'Salary Advance' : 'Long Term'; ?></td>
                            <td><?php echo $value->amount ? number_format($value->amount) : 'Not Set'; ?></td>
                            <td><?php echo $value->date_requested ? date('M. jS, Y', strtotime($value->date_requested)) : 'Not Set'; ?></td>

                            <td>
                              <a class="btn btn-primary btn-icon btn-sm" href="hr-empview.html">
                                <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i>
                              </a>
                              <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a>
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
                                case '0':
                                  echo '<span class="badge badge-warning">Pending</span>';
                                  break;
                                case '1':
                                  echo '<span class="badge badge-success">Approved</span>';
                                  break;
                                default:
                                  echo '<span class="badge badge-danger">Rejected</span>';
                                  break;
                              endswitch;
                              ?>
                            </td>


                            <td class="text-start d-flex"> <a href="#" class="action-btns1" data-id="<?php echo $loan->id ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View"> <i class="feather feather-eye  text-primary"></i> </a> <a href="#" class="action-btns1" data-id="<?php echo $loan->id ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> </td>
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
      }
    };

    const EMPLOYEE_URL = "../inc/employee/";

    const loanForm = document.getElementById("add_loan_form");

    loanForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      submitForm(EMPLOYEE_URL, loanForm);
    });

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
    let isLongTerm = document.getElementById('isLongTerm');
    $('#loan_type').select2({
      dropdownParent: $('.select_loan')
    }).on("change", () => {
      if ($("#loan_type").val() == 2) {
        isLongTerm.classList.remove('d-none')
        isAdvance.classList.add('d-none')
      } else {
        isLongTerm.classList.add('d-none')
        isAdvance.classList.remove('d-none')
      }
    });
  });
</script>