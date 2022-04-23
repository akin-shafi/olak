<?php
require_once('../private/initialize.php');
$year = date('Y');
$employeeLeave = EmployeeLeave::find_leave_by_year($year);

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
            <a href="<?php echo url_for('leave/hr-leavesapplication.php') ?>" class="btn btn-primary"> <i class="feather feather-grid"></i> </a>

            <a href="<?php echo url_for('leave/hr-leavesapplication-list.php') ?>" class="btn btn-light"> <i class="feather feather-list"></i> </a>
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
               <?php if (!empty($employeeLeave)) : ?>
                  <?php foreach ($employeeLeave as $leave) :
                     $employee = Employee::find_by_id($leave->employee_id);
                     $leaveType = EmployeeLeaveType::find_by_id($leave->leave_type);

                     $date_from = new DateTime($leave->date_from);
                     $date_to = new DateTime($leave->date_to);
                     $date_approved = new DateTime($leave->date_approved);

                     $currentDate = strtotime(date('Y-m-d'));
                     $dateTo = strtotime($leave->date_to);
                     $timeLeft = $dateTo - $currentDate; //? Seconds
                     $daysLeft = round((($timeLeft / 24) / 60) / 60); //? Days
                  ?>
                     <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class="card border p-0 shadow-none">
                           <div class="card-header border-0">
                              <h3 class="card-title fs-12">Earned Leave Request</h3>
                              <?php if ($leave->approved_by != 0) : ?>
                                 <div class="ms-auto">
                                    <?php if ($daysLeft <= 0) : ?>
                                       <span class="badge badge-md badge-danger-light">Leave elapsed</span>
                                    <?php else : ?>
                                       <span class="badge badge-md badge-warning-light">
                                          <?php echo $daysLeft; ?> days left</span>
                                    <?php endif; ?>
                                 </div>
                              <?php endif; ?>
                           </div>

                           <div class="d-flex p-2">
                              <div>
                                 <div class="avatar avatar-lg brround d-block cover-image" data-image-src="<?php echo url_for('assets/uploads/profiles/' . $employee->photo) ?>" style="background: url(<?php echo url_for('assets/uploads/profiles/' . $employee->photo) ?>) center center;"></div>
                              </div>
                              <div class="ps-3">
                                 <h5 class="mb-0 mt-2 text-dark fs-12"><?php echo ucwords($employee->full_name()) ?></h5>
                                 <p class="text-muted fs-12 mt-1 mb-0">
                                    <?php echo ucwords($employee->branch) ?>
                                    <span class="my-auto fs-9 font-weight-normal  ms-1 me-1 text-black-20">/</span>
                                    <?php echo ucwords($employee->company) ?>
                                    <span class="my-auto fs-9 font-weight-normal  ms-1 me-1 text-black-20">/</span>
                                    <?php echo ucwords($employee->department) ?>
                                 </p>
                              </div>
                           </div>
                           <div class="card-body px-2 pt-2 bg-light">
                              <div class="mt-3 mb-3">
                                 <div class="h6 mb-1">
                                    <h4><?php echo ucwords($leaveType->name) ?></h4>
                                    <span class="feather feather-calendar"></span> : <?php echo date('d-m-Y', strtotime($leave->date_from)) ?>
                                    <span class="text-muted leave-to">To</span><?php echo date('d-m-Y', strtotime($leave->date_to)) ?>
                                    <span class="badge badge-md badge-primary-light ms-1"><?php echo $leave->duration ?></span>
                                 </div>
                                 <small class="text-muted fs-11">
                                    Applied On: <?php echo date('d-m-Y', strtotime($leave->created_at)) ?>
                                    (<span class="font-weight-semibold"><?php echo time_elapsed_string($leave->created_at, '') ?></span>)
                                 </small>
                              </div>

                              <div class="progress progress-sm mb-2 bg-danger">
                                 <div class="progress-bar bg-success" style="<?php echo 'width:' . $daysLeft . '%' ?>"></div>
                              </div>

                              <div class="d-flex align-items-end justify-content-between mb-0">
                                 <h6 class="fs-12 mb-0">Remaining Leaves</h6>
                                 <h6 class="font-weight-bold fs-12 mb-0">
                                    <?php if (isset($leave->days_left)) {
                                       echo $leave->days_left;
                                    } ?>
                                 </h6>
                              </div>
                           </div>
                           <div class="p-2">
                              <label class="form-label">Reason:</label>
                              <p class="text-muted leave-text mb-0"><?php echo $leave->reason ? ucfirst($leave->reason) : 'Not Set' ?></p>
                           </div>
                           <div class="card-footer p-0 border-top-0">
                              <div class="btn-group w-100 leaves-btns">
                                 <button type="button" data-id="<?php echo $leave->id ?>" class="btn w-100 <?php echo $leave->status == 3 ? 'btn-success text-light' : 'btn-outline-light' ?> text-success action" data-action="accept">Accept</button>
                                 <button type="button" data-id="<?php echo $leave->id ?>" class="btn w-100 <?php echo $leave->status == 2 ? 'btn-warning text-light' : 'btn-outline-light' ?> text-warning action" data-action="pending">Pending</button>
                                 <button type="button" data-id="<?php echo $leave->id ?>" class="btn w-100 <?php echo $leave->status == 4 ? 'btn-danger text-light' : 'btn-outline-light' ?> text-danger action" data-action="reject">Reject</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php endforeach; ?>
               <?php else : ?>
                  <div class="col-lg-6 col-md-12">
                     <h5 class="text-center">No data for leave request</h5>
                  </div>
               <?php endif; ?>
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