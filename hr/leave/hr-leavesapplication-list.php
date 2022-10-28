<?php
require_once('../private/initialize.php');
$date = date('Y');
$employeeLeave = EmployeeLeave::find_leave_by_year($date);

$page = 'Leave';
$page_title = 'Leave Applications';
include(SHARED_PATH . '/header.php');
?>


<div class="page-header d-xl-flex d-block">
  <div class="page-leftheader">
    <h4 class="page-title">Leave Applications</h4>
  </div>
  <div class="page-rightheader ms-md-auto">
    <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
      <a href="#" class="btn btn-primary me-3 mt-3 mt-lg-0 mb-3 mb-md-0" data-bs-toggle="modal" data-bs-target="#leave_modal"> Request Leave</a>

      <div class="btn-list">
        <a href="<?php echo url_for('leave/hr-leavesapplication.php') ?>" class="btn btn-light"> <i class="feather feather-grid"></i></a>

        <a href="<?php echo url_for('leave/hr-leavesapplication-list.php') ?>" class="btn btn-primary"> <i class="feather feather-list"></i></a>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header border-bottom-0">
        <h4 class="card-title">Recent Earned Leave Applications</h4>
      </div>
      <div class="card-body">
        <div class="row">



          <div class="table-responsive">
            <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

              <div class="row">
                <div class="col-sm-12">
                  <table class="table table-vcenter text-nowrap fs-12 table-bordered border-bottom dataTable no-footer" role="grid">
                    <thead>
                      <tr role="row" class="fs-12">
                        <th>Employee</th>
                        <th>Leave Type</th>
                        <th>Outstanding</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Duration</th>
                        <th>Countdown</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Approved By</th>
                        <th>Date Approved</th>
                        <th>Created At</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($employeeLeave)) : ?>
                        <?php foreach ($employeeLeave as $leave) :
                          $employee = Employee::find_by_id($leave->employee_id);
                          $leaveType = EmployeeLeaveType::find_by_id($leave->leave_type);

                          $approvedBy = $leave->approved_by != 0
                            ? Admin::find_by_id($leave->approved_by)->full_name() : 'NOT SET';
                          $dateApproved = $leave->approved_by != 0 ? date('F d, Y', strtotime($leave->date_approved)) : 'NOT SET';
                          $createdAt = date('F d, Y', strtotime($leave->created_at));

                          $currentDate = strtotime(date('Y-m-d'));
                          $dateTo = strtotime($leave->date_to);
                          $timeLeft = $dateTo - $currentDate; //? Seconds
                          $daysLeft = round((($timeLeft / 24) / 60) / 60); //? Days
                        ?>
                          <tr>
                            <td>
                              <?php echo ucwords($employee->full_name()) ?>
                            </td>
                            <td><?php echo ucwords($leaveType->name) . ' (' . $leaveType->duration . ')'; ?></td>
                            <td><?php echo $leave->days_left . ' days' ?></td>
                            <td><?php echo date('d-m-Y', strtotime($leave->date_from)) ?></td>
                            <td><?php echo date('d-m-Y', strtotime($leave->date_to)) ?></td>
                            <td><?php echo $leave->duration ?></td>
                            <td>
                              <div class="ms-auto">
                                <?php if ($daysLeft <= 0) : ?>
                                  <span class="badge badge-md badge-danger-light">Leave elapsed</span>
                                <?php else : ?>
                                  <span class="badge badge-md badge-info-light">
                                    <?php echo $daysLeft; ?> days left</span>
                                <?php endif; ?>
                              </div>
                            </td>
                            <td><?php echo !empty($leave->reason) ? ucfirst($leave->reason) : "NOT SET" ?></td>
                            <td><?php switch ($leave->status) {
                                  case '2':
                                    echo '<span class="badge badge-md badge-warning">Pending</span>';
                                    break;
                                  case '3':
                                    echo '<span class="badge badge-md badge-success">Approved</span>';
                                    break;
                                  case '4':
                                    echo '<span class="badge badge-md badge-danger">Rejected</span>';
                                    break;

                                  default:
                                    echo '<span class="badge badge-md badge-warning">New Request</span>';
                                    break;
                                } ?></td>
                            <td><?php echo $approvedBy ?></td>
                            <td><?php echo $dateApproved ?></td>
                            <td><?php echo $createdAt ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <div class="col-lg-6 col-md-12">
                          <h5 class="text-center">No data for leave request</h5>
                        </div>
                      <?php endif; ?>
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


<?php include(SHARED_PATH . '/footer.php') ?>

<script src="<?php echo url_for('assets/js/employee/emp-myleaves.js') ?>"></script>
<script src="<?php echo url_for('assets/plugins/pg-calendar-master/pignose.calendar.full.min.js') ?>"></script>

<script>
  $(document).ready(function() {
    $('.select2').select2({
      dropdownParent: $('.select_leave')
    });

    const message = (req, res) => {
      swal(req + "!", res, {
        icon: req,
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

    const EMPLOYEE_URL = "../inc/employee/";

    const leaveForm = document.getElementById("add_leave_form");

    leaveForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      submitForm(EMPLOYEE_URL, leaveForm);
    });

    $(".action").on("click", async function() {
      let id = this.dataset.id;
      let action = this.dataset.action;

      let data = await fetch(EMPLOYEE_URL + "?leaveId=" + id + '&leave_status=' + action);
      let res = await data.json();

      message('success', res.message)
    });
  })
</script>