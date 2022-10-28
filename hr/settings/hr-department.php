<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Department';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="side-app">

   <div class="page-header d-xl-flex d-block">
      <div class="page-leftheader">
         <h4 class="page-title">Department / Designation</h4>
      </div>
      <div class="page-rightheader ms-md-auto">
         <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
            <div class="btn-list d-none">
               <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button>
               <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button>
               <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
            </div>
         </div>
      </div>
   </div>

   <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="col-xl-6 col-md-12 col-lg-12">
               <div class="card">
                  <div class="card-header  border-0">
                     <h4 class="card-title">Department Summary</h4>
                     <div class="page-rightheader ms-md-auto">
                        <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                           <div class="btn-list">
                              <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#department_modal">
                                 Add Department</a>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card-body">
                     <div class="table-responsive">
                        <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                           <div class="row">
                              <div class="col-sm-12">
                                 <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="dept-table" role="grid" aria-describedby="hr-table_info">
                                    <thead>
                                       <tr role="row">
                                          <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Department Name: activate to sort column ascending" style="width: 678.872px;">Department Name</th>
                                          <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php $sn = 1;
                                       foreach (Department::find_by_undeleted() as $department) : ?>
                                          <tr class="odd">
                                             <td><?php echo $sn++ ?></td>
                                             <td><?php echo ucwords($department->department_name) ?></td>

                                             <td>
                                                <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $department->id ?>" id="edit-dept-btn">
                                                   <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                                </a>
                                                <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $department->id ?>" id="delete_dept">
                                                   <i class="feather feather-trash-2"></i>
                                                </a>
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

            <div class="col-xl-6 col-md-12 col-lg-12">
               <div class="card">
                  <div class="card-header  border-0">
                     <h4 class="card-title">Job Title</h4>
                     <div class="page-rightheader ms-md-auto">
                        <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                           <div class="btn-list">
                              <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#designation_modal">
                                 Add Job Title</a>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card-body">
                     <div class="table-responsive">
                        <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                           <div class="row">
                              <div class="col-sm-12">
                                 <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="des-table" role="grid" aria-describedby="hr-table_info">
                                    <thead>
                                       <tr role="row">
                                          <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Designation Name: activate to sort column ascending" style="width: 678.872px;">Designation Name</th>
                                          <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php $sn = 1;
                                       foreach (Designation::find_by_undeleted() as $designate) : ?>
                                          <tr class="odd">
                                             <td><?php echo $sn++ ?></td>
                                             <td><?php echo ucwords($designate->designation_name) ?></td>

                                             <td>
                                                <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $designate->id ?>" id="edit_des">
                                                   <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                                </a>
                                                <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $designate->id ?>" id="delete_des">
                                                   <i class="feather feather-trash-2"></i>
                                                </a>
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
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
<script src="../../assets/plugins/circle-progress/circle-progress.min.js"></script>

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

      const departmentModal = new bootstrap.Modal(
         document.querySelector("#department_modal")
      );
      const departmentForm = document.querySelector("#add_department_form");
      const departmentTitle = document.querySelector("#department-title");
      const departmentBtn = document.querySelector("#add_department_btn");

      const designateModal = new bootstrap.Modal(
         document.querySelector("#designation_modal")
      );
      const designationForm = document.querySelector("#add_designation_form");
      const designationTitle = document.querySelector("#designation-title");
      const designationBtn = document.querySelector("#add_designation_btn");

      departmentForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(SETTING_URL, departmentForm);
      });

      $("#dept-table tbody").on("click", "#edit-dept-btn", async function() {
         let id = this.dataset.id;

         let data = await fetch(SETTING_URL + "?departmentId=" + id);
         let response = await data.json();

         document.getElementById("departmentId").value = id;
         document.getElementById("dept_name").value = response.data.department_name;

         departmentTitle.innerText = "Edit Department";
         departmentBtn.innerText = "Update";

         departmentModal.show();

         departmentBtn.addEventListener("click", async (e) => {
            e.preventDefault();
            submitForm(SETTING_URL, departmentForm);
         });

         $("#department_modal").on("hidden.bs.modal", function() {
            location.reload();
         });
      });

      $(document).on("click", "#delete_dept", function() {
         let delId = this.dataset.id;
         deleted(SETTING_URL + "?departmentId=" + delId + "&deleteDept=1");
      });

      designationForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(SETTING_URL, designationForm);
      });

      $("#des-table tbody").on("click", "#edit_des", async function() {
         let id = this.dataset.id;

         let data = await fetch(SETTING_URL + "?designationId=" + id);
         let response = await data.json();

         document.getElementById("designationId").value = id;
         document.getElementById("des_name").value = response.data.designation_name;
         document.getElementById("dept_id").value = response.data.department_id;

         designationTitle.innerText = "Edit Designation";
         designationBtn.innerText = "Update";

         designateModal.show();

         designationBtn.addEventListener("click", async (e) => {
            e.preventDefault();
            submitForm(SETTING_URL, designationForm);
         });

         $("#designation_modal").on("hidden.bs.modal", function() {
            location.reload();
         });
      });

      $(document).on("click", "#delete_des", function() {
         let delId = this.dataset.id;
         deleted(SETTING_URL + "?designationId=" + delId + "&deleteDes=1");
      });
   });
</script>