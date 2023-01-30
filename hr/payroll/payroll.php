<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Compute Salary';
$sweetalert = 1;
include(SHARED_PATH . '/header.php');
$datatable = '';
$select2 = '';

$lastMonth = $_GET['q'] ?? '';
$thisMonth = date('Y-m');

$queryByMonth = !empty($thisMonth) ? $thisMonth : $lastMonth;
$employees = Employee::find_by_undeleted();
$payrolls = Payroll::find_by_month($queryByMonth);

$calculate_tax = 0;

$config = Configuration::find_by_process_salary(['process_salary' => 1, 'process_salary_date' => $queryByMonth]);
?>

<div class="page-header d-xl-flex d-block">
  <div class="page-leftheader">
    <h4 class="page-title"><?php echo $page_title ?></h4>
  </div>
  <div class="page-rightheader ms-md-auto">



    <form class="form-inline " id="find_week">
      <div class="form-group p-1">
        <label>Year: </label>
        <input type="text" class="form-control ms-1" id="compute_year" value="<?php echo date('Y') ?>" readonly>
      </div>

      <div class=" form-group p-1">
        <label>Month: </label>
        <select class="form-control ms-1" id="compute_month" data-placeholder="Select Month">
          <option label="Select Month" data-select2-id="select2-data-55-moyh"></option>
          <?php foreach (Payroll::MONTH as $key => $value) : ?>
            <option value="<?php echo $key; ?>" <?php echo $key == date('m', strtotime($queryByMonth)) ? 'selected' : '' ?> <?php echo $key > date('m') ? 'disabled' : '' ?>>
              <?php echo $value; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class=" form-group p-1">

        <button class="btn btn-primary btn-sm me-3" id="genPaySlip">Compute Salary</button>
      </div>
    </form>

  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

        <div class="d-flex justify-content-between">
          <div class="w-25">
            <div>Filter By Month:</div>
            <select class="form-control select2" id="byDate" data-placeholder="Select Month">
              <?php foreach (Payroll::MONTH as $key => $value) : ?>
                <option value="<?php echo $key; ?>" <?php echo $key == date('m', strtotime($queryByMonth)) ? 'selected' : '' ?>>
                  <?php echo $value; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div id="show_filter"></div>
        </div>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div id="hr-payroll_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

            <div class="row">
              <div class="col-sm-12">
                <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-payroll" role="grid">
                  <thead>
                    <tr role="row">
                      <th class="bg-white">#Emp ID</th>
                      <th class="bg-white">#Emp Name</th>
                      <th>Month</th>
                      <th>(₦) Gross Salary</th>
                      <?php if ($calculate_tax == 1) { ?>
                        <th>(₦) Monthly Tax</th>
                        <th>(₦) Pension</th>
                      <?php } ?>

                      <th>(₦) Salary Advance</th>
                      <th>(₦) Commitment (LTL)</th>
                      <th>(₦) Take Home</th>
                      <th>Status</th>
                      <th class="bg-white">Action</th>
                    </tr>
                  </thead>
                  <tbody id="get_payroll">
                    <?php
                    $sn = 1;
                    foreach ($payrolls as $value) :
                      $salary_advance = SalaryAdvance::find_by_employee_id($value->employee_id, ['current' => date('Y-m')]);
                      $employee = Employee::find_by_id($value->employee_id);
                      $salary = intval($value->present_salary);

                      $overtime = $value->overtime_allowance ?? 0;
                      $leave = $value->leave_allowance ?? 0;
                      $otherAllowance = $value->other_allowance ?? 0;

                      $commitment = isset($value->loan) ? intval($value->loan) : '0.00';
                      $salAdv = $salary_advance->total_requested != 0 ? intval($salary_advance->total_requested) : 0;
                      $otherDeduction = isset($value->other_deduction) ? $value->other_deduction : 0;

                      $totalAllowance = $overtime + $leave + $otherAllowance + $salary;
                      $totalDeduction = $commitment + $salAdv + $otherDeduction;

                      $tax = Payroll::tax_calculator(['netSalary' => $salary]);
                      $monthly_tax = intval($tax['monthly_tax']);
                      $pension = intval($tax['pension']);

                      if ($calculate_tax == 1) {
                        $take_home = $totalAllowance - ($monthly_tax + $pension + $totalDeduction);
                      } else {
                        $take_home = intval($totalAllowance) - intval($totalDeduction);
                      }

                    ?>
                      <tr>
                        <td class="bg-white">
                          <?php echo $sn++; ?>
                        </td>
                        <td class="bg-white">
                          <div class="d-flex">
                            <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
                            <div class="me-3 mt-0 mt-sm-1 d-block">
                              <h6 class="mb-1 fs-14"><?php echo isset($employee->first_name) ? $employee->full_name() : 'Not Set' ?></h6>
                              <p class="text-muted mb-0 fs-12">Emp ID: <?php echo isset($employee->id) ? str_pad($employee->id, 3, '0', STR_PAD_LEFT) : 'Not Set'; ?></p>
                            </div>
                          </div>
                        </td>
                        <td><?php echo date('M Y', strtotime($value->month)) ?></td>
                        <td><?php echo number_format($salary) ?></td>
                        <?php if ($calculate_tax == 1) { ?>
                          <td><?php echo  number_format($monthly_tax) ?></td>
                          <td><?php echo  number_format($pension) ?></td>
                        <?php } ?>
                        <td>
                          <?php echo !empty($salary_advance->total_requested) ? number_format(intval($salary_advance->total_requested)) : '0.00' ?>
                        </td>
                        <td><?php echo number_format($value->loan) ?></td>
                        <td class="font-weight-semibold"><?php echo number_format($take_home) ?></td>
                        <td>
                          <?php
                          $status = $value->payment_status;
                          if ($status == 1) {
                            $color = 'badge-primary';
                          } elseif ($status == 2) {
                            $color = 'badge-warning';
                          } else {
                            $color = 'badge-success';
                          }
                          ?>
                          <span class="badge <?php echo $color ?>">
                            <?php echo Payroll::STATUS[$status]; ?>

                          </span>
                        </td>
                        <td class="text-center">

                          <a href="#" class="btn btn-outline-primary action-btns" id="get_salary" data-id="<?php echo $value->employee_id ?>" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a>
                          <a href="#" class="btn btn-outline-warning action-btns" id="edit_salary" data-id="<?php echo $value->employee_id ?>" data-bs-toggle="modal" data-bs-target="#payroll_narration" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit"></i> </a>
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

<div class="modal fade" id="viewsalarymodal" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div id="salary_data">
        <!-- //? AJAX CALL -->
      </div>

    </div>
  </div>
</div>

<div id="payroll_narration" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loan-title">Other Payroll Narrations</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="add_payroll_narration_form" class="mb-0">
        <input type="hidden" name="salary[employee_id]" id="employee_id" readonly>
        <input type="hidden" id="present" disabled>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Employees</label>
                <input type="text" id="employee_name" class="form-control" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Leave Allowance <span class="text-danger">*</span></label>
                <input class="form-control" name="salary[leave_allowance]" id="leave_allowance" type="number" placeholder="Leave Allowance">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Overtime Allowance (HRS) <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">Hrs</span>
                  <input class="form-control" type="number" id="o_hrs" placeholder="e.g 5">
                  <span class="input-group-text"><?php echo $currency; ?></span>
                  <input class="form-control" name="salary[overtime_allowance]" type="number" id="overtime_allowance" placeholder="Overtime Allowance" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Other Allowance <span class="text-danger">*</span></label>
                <input class="form-control" name="salary[other_allowance]" id="other_allowance" type="number" placeholder="Other Allowance">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Other Deduction <span class="text-danger">*</span></label>
                <input class="form-control" name="salary[other_deduction]" id="other_deduction" type="number" placeholder="Other Deduction">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Note</label>
            <textarea name="salary[note]" id="note" class="form-control" cols="3" placeholder="Notes"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>


<input type="hidden" id="eUrl" value="<?php echo url_for('/') ?>">
<?php include(SHARED_PATH . '/footer.php'); ?>

<script>
  $(document).ready(function() {
    var eUrl = $("#eUrl").val();
    const message = (req, res) => {
      swal(req + "!", res, {
        icon: req,
        timer: 2000,
        buttons: {
          confirm: {
            className: req == "error" ? "btn btn-danger" : "btn btn-success",
          },
        },
      })
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

    const PAYROLL_URL = eUrl + "payroll/inc/payroll_script.php";
    const SETTING_URL = "inc/setting/generate_payslip.php";
    const SALARY_URL = "inc/payrolItem.php";
    const GET_PAYROLL_URL = eUrl + "payroll/inc/get_payroll.php";

    const payrollForm = document.getElementById("add_payroll_narration_form");
    const getSalary = document.getElementById("get_salary");

    $('tbody').on('click', '#get_salary', async function() {
      let empId = this.dataset.id;
      let filterDate = $("#byDate").val()

      let data = await fetch(SALARY_URL + '?empId=' + empId + '&salary_date=' + filterDate)
      let res = await data.text();

      $('#salary_data').html(res);
    })

    $('tbody').on('click', '#edit_salary', async function() {
      let empId = this.dataset.id;
      let filterDate = $("#byDate").val()

      let data = await fetch(PAYROLL_URL + '?empId=' + empId + '&date=' + filterDate + '&salary_data')
      let res = await data.json();
      let params = res.data;

      let presentSalary = Number(params.present_salary);
      $('#present').val(presentSalary)


      $('#employee_id').val(params.id);
      $('#employee_name').val(params.first_name + ' ' + params.last_name);

      $('#overtime_allowance').val(params.overtime_allowance)
      $('#leave_allowance').val(params.leave_allowance);
      $('#overtime_allowance').val(params.overtime_allowance);
      $('#other_allowance').val(params.other_allowance);
      $('#other_deduction').val(params.other_deduction);
      $('#note').val(params.note);
    })

    $('#o_hrs').on('input', function() {
      let pSalary = Number($('#present').val())
      let oHour = Number(this.value);

      let overtimeAllowance = 0.2 * (oHour * pSalary) / (22 * 8)
      let oTA = roundToTwo(overtimeAllowance)
      $('#overtime_allowance').val(oTA)
    })

    function roundToTwo(params) {
      return +(Math.round(params + 'e+2') + 'e-2')
    }

    payrollForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      submitForm(PAYROLL_URL, payrollForm);
      setTimeout(() => {
        window.location.reload();
      }, 1500);
    });

    $(document).on('click', '#PaySlipDisabled', function() {
      message('error', 'Payslip already generated for this month. Thank You!');
    })

    function errorOption(title, text) {
      swal({
          title: title,
          text: text,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            updateSalary()
          }
        });
    }

    function check_status(filterYear, filterDate) {

      $.ajax({
        url: 'inc/compute_salary.php',
        method: "POST",
        data: {
          check_status: 1,
          year: filterYear,
          month: filterDate,
        },
        dataType: 'json',
        success: function(data) {
          if (data.success == true) {
            errorOption(data.msg, data.sub);
          } else {
            computeSalary();
          }
        }
      })

    }

    function computeSalary() {
      var filterYear = $("#compute_year").val()
      var filterDate = $("#compute_month").val()
      $.ajax({
        url: 'inc/compute_salary.php',
        method: "POST",
        data: {
          computeSalary: 1,
          year: filterYear,
          month: filterDate,
          present_days: 31,
        },
        dataType: 'json',
        beforeSend: function() {
          $('#ajax_loader').show();
        },
        success: function(data) {
          if (data.success == true) {
            $('#ajax_loader').hide();
            successAlert(data.msg)
            get_record(filterYear, filterDate)
          } else {
            $('#ajax_loader').hide();
            errorAlert(data.msg);

          }
        }
      })
    }

    function updateSalary() {
      let filterYear = $("#compute_year").val()
      let filterDate = $("#compute_month").val()
      $.ajax({
        url: 'inc/compute_salary.php',
        method: "POST",
        data: {
          updateSalary: 1,
          year: filterYear,
          month: filterDate,
        },
        dataType: 'json',
        beforeSend: function() {
          $('#ajax_loader').show();
        },
        success: function(data) {
          if (data.success == true) {
            $('#ajax_loader').hide();
            successAlert(data.msg)
          } else {
            $('#ajax_loader').hide();
            errorAlert(data.msg);

          }
        }
      })
    }

    var filterYear = $("#compute_year").val()
    var filterDate = $("#compute_month").val()
    load_filter(filterYear, filterDate);

    function load_filter(filterYear, filterDate) {
      $.ajax({
        url: 'inc/get_payroll.php',
        method: "GET",
        data: {
          load_filter: 1,
          year: filterYear,
          month: filterDate,
        },
        success: function(data) {
          $("#show_filter").html(data)
        }
      })
    }

    $(document).on('click', '#genPaySlip', function(e) {
      e.preventDefault();
      let filterYear = $("#compute_year").val()
      let filterDate = $("#compute_month").val()
      check_status(filterYear, filterDate)
    })

    $(document).on('click', '#push', function() {
      let filterYear = $("#compute_year").val()
      let filterDate = $("#byDate").val()

      $.ajax({
        url: 'inc/payroll_script.php',
        method: "POST",
        data: {
          push: 1,
          month: filterDate,
        },
        dataType: 'json',
        success: function(data) {
          if (data.success == true) {
            message('success', data.msg);
            get_record(filterYear, filterDate)
          } else {
            message('error', data.msg);
          }
        }
      })
    })

    function get_record(filterYear, filterDate) {
      $('tbody#get_payroll').html("<h2 class='text-center'>Processing...</h2>");
      $.ajax({
        url: 'inc/get_payroll.php',
        method: "get",
        data: {
          push: 1,
          filter_date: filterDate,
        },
        success: function(data) {
          load_filter(filterYear, filterDate);
          $('tbody#get_payroll').html(data);
        }
      })
    }

    $('#byDate').on("change", async () => {
      let filterYear = $("#compute_year").val()
      let filterDate = $("#byDate").val()
      get_record(filterYear, filterDate)

    });
  })
</script>