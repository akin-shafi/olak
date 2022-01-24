<?php
require_once('../private/initialize.php');

$page = 'Leave';
$page_title = 'Leave Settings';
include(SHARED_PATH . '/header.php');

?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Leave Settings</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list"> <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#leave_type_modal">Add Leave Type</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Leaves Types</h4>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="hr-leavestypes_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  <div class="row">
                     <div class="col-sm-12 col-md-6"></div>
                     <div class="col-sm-12 col-md-6"></div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-leavestypes" role="grid">
                           <thead>
                              <tr role="row">
                                 <th>SN</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" style="width: 477.062px;">Leaves Type</th>
                                 <th class="border-bottom-0 text-center sorting_disabled" rowspan="1" colspan="1" style="width: 398.938px;">No.of Leaves</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" style="width: 383.333px;">Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $sn = 1;
                              foreach (EmployeeLeaveType::find_by_undeleted() as $leave) : ?>
                                 <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td><?php echo ucwords($leave->name) ?></td>
                                    <td class="text-center font-weight-semibold">
                                       <?php echo ucwords($leave->duration) ?></td>

                                    <td>
                                       <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $leave->id ?>" data-bs-toggle="modal" data-bs-target="#leave_type_modal" id="edit_leave">
                                          <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                       </a>
                                       <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $leave->id ?>" id="delete_leave">
                                          <i class="feather feather-trash-2"></i>
                                       </a>
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-5"></div>
                     <div class="col-sm-12 col-md-7"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<?php include('../inc/modal/all.php'); ?>
<?php include(SHARED_PATH . '/footer.php') ?>


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
                        timer: 2000,
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

      const SETTING_URL = "../inc/setting/";

      const leaveForm = document.getElementById("add_leave_type_form");

      leaveForm.addEventListener("submit", (e) => {
         e.preventDefault();
         submitForm(SETTING_URL, leaveForm);
      });

      $("#hr-leavestypes tbody").on("click", "#edit_leave", async function() {
         let id = this.dataset.id;

         let data = await fetch(SETTING_URL + "?leaveId=" + id);
         let response = await data.json();

         document.querySelector('#leaveId').value = id
         document.querySelector('#leave_name').value = response.data.name
         document.querySelector('#leave_duration').value = response.data.duration

         leaveForm.addEventListener("submit", (e) => {
            e.preventDefault();
            submitForm(SETTING_URL, leaveForm);
         });
      });

      $("#hr-leavestypes tbody").on("click", "#delete_leave", function() {
         let id = this.dataset.id;
         deleted(SETTING_URL + "?leaveId=" + id + "&deleteLeaveType");
      });
   })
</script>