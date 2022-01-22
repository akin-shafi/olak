<?php
require_once('private/initialize.php');

$page = 'My Leaves';
$page_title = 'My Leaves';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">My Leaves</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
         <div class="btn-list"> <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#leave_modal">Apply Leaves</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xl-9 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Leaves Summary</h4>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="emp-attendance_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" role="grid" aria-describedby="emp-attendance_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 text-center sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 21.5208px;">#ID</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Leave Type: activate to sort column ascending" style="width: 89.3125px;">Leave Type</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="From: activate to sort column ascending" style="width: 70.625px;">From</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="TO: activate to sort column ascending" style="width: 70.625px;">TO</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Days: activate to sort column ascending" style="width: 76.3125px;">Days</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Reason: activate to sort column ascending" style="width: 146.542px;">Reason</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Applied On: activate to sort column ascending" style="width: 70.625px;">Applied On</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 75.0417px;">Status</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 120px;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php foreach (EmployeeLeave::find_by_undeleted() as $leave) :
                                 $leave_type = EmployeeLeaveType::find_by_id($leave->leave_type)->name;
                              ?>
                                 <tr>
                                    <td class="text-center">1</td>
                                    <td><?php echo ucwords($leave_type); ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($leave->date_from)) ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($leave->date_to)) ?></td>
                                    <td class="font-weight-semibold"><?php echo ucwords($leave->duration) ?></td>
                                    <td><?php echo ucfirst($leave->reason) ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($leave->created_at)) ?></td>
                                    <td> <?php
                                          switch ($leave->status):
                                             case '1':
                                                echo '<span class="badge badge-primary">New</span>';
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
                                          ?> </td>
                                    <td class="text-start d-flex"> <a href="#" class="action-btns1" data-id="<?php echo $leave->id ?>" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-id="<?php echo $leave->id ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-id="<?php echo $leave->id ?>" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
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
   <div class="col-xl-3 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Leaves Overview</h4>
         </div>
         <div class="card-body">
            <div id="leavesoverview" class="mx-auto pt-2" style="min-height: 278.341px;">

            </div>
            <div class="row pt-7 pb-5  mx-auto text-center">
               <div class="col-md-7 mx-auto d-block">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label bg-primary me-2 my-auto"></span>Casual Leaves </div>
                     </div>
                     <div class="col-md-12 mt-3">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label badge-danger me-2 my-auto"></span>Sick Leaves </div>
                     </div>
                     <div class="col-md-12 mt-3">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label bg-secondary me-2 my-auto"></span>Gifted Leaves </div>
                     </div>
                     <div class="col-md-12 mt-3">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label bg-success me-2 my-auto"></span>Remaining Leaves </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="resize-triggers">
               <div class="expand-trigger">
                  <div style="width: 346px; height: 528px;"></div>
               </div>
               <div class="contract-trigger"></div>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="leaveapplictionmodal" style="display: none;" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">My Leave Application</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
         </div>
         <div class="modal-body">
            <div class="table-responsive">
               <table class="table mb-0">
                  <tbody>
                     <tr>
                        <td class="font-weight-semibold">Leave Type </td>
                        <td>:</td>
                        <td>Casual Leave</td>
                     </tr>
                     <tr>
                        <td class="font-weight-semibold">Date</td>
                        <td>:</td>
                        <td>16-01-2021</td>
                     </tr>
                     <tr>
                        <td class="font-weight-semibold">Days</td>
                        <td>:</td>
                        <td>1 day</td>
                     </tr>
                     <tr>
                        <td class="font-weight-semibold">Reason</td>
                        <td>:</td>
                        <td>Personal</td>
                     </tr>
                     <tr>
                        <td class="font-weight-semibold">Applied On</td>
                        <td>:</td>
                        <td>05-01-2021</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer"> <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Close</a> </div>
      </div>
   </div>
</div>


<?php include('inc/modal/all.php') ?>
<?php include(SHARED_PATH . '/footer.php') ?>

<script src="<?php echo url_for('assets/js/employee/emp-myleaves.js') ?>"></script>
<script src="<?php echo url_for('assets/plugins/pg-calendar-master/pignose.calendar.full.min.js') ?>"></script>

<script>
   $(document).ready(function() {
      const message = (req, res) => {
         swal(req + "!", res, {
            icon: req,
            timer: 2000,
            buttons: {
               confirm: {
                  className: req == "error" ? "btn btn-danger" : "btn btn-success",
               },
            },
         }).then(() => location.reload());
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

      const LEAVE_URL = "./inc/leave/";

      const leaveForm = document.getElementById("add_leave_form");

      leaveForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(LEAVE_URL, leaveForm);
      });
   })
</script>