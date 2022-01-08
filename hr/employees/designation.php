<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Designation';
include(SHARED_PATH . '/admin_header.php');
?>
<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row align-items-center">
            <div class="col">
               <h3 class="page-title">Designations</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Designations</li>
               </ul>
            </div>
            <div class="col-auto float-end ms-auto">
               <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#designation_modal"><i class="fa fa-plus"></i> Add Designation</a>
            </div>
         </div>
      </div>

      <style>
         th,
         td {
            vertical-align: middle;
            font-size: 14px;
         }
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="table-responsive">
               <table class="table table-striped custom-table mb-0 datatable" id="designation-table">
                  <thead>
                     <tr>
                        <th style="width: 30px;">SN</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Created At</th>
                        <th class="text-end">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $sn = 1;
                     foreach (Designation::find_by_undeleted() as $designation) :
                        $departmentName = Department::find_by_id($designation->department_id)->department_name; ?>
                        <tr>
                           <td><?php echo $sn++ ?></td>
                           <td><?php echo ucwords($designation->designation_name) ?></td>
                           <td><?php echo ucwords($departmentName) ?></td>
                           <td><?php echo date('Y-m-d', strtotime($designation->created_at)) ?></td>

                           <td class="text-end">
                              <div class="dropdown dropdown-action">
                                 <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-id="<?php echo $designation->id ?>" id="edit-designation-btn"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-id="<?php echo $designation->id ?>" id="delete-designation-btn"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                 </div>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <div id="designation_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="designation-title">Add Designation</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div id="showAlert"></div>

               <form id="add_designation_form">
                  <div class="form-group">
                     <label>Designation Name <span class="text-danger">*</span></label>
                     <input class="form-control" name="designation_name" id="designation_name" type="text">
                  </div>
                  <div class="form-group">
                     <label>Department <span class="text-danger">*</span></label>
                     <select class="select" name="department_id" id="department_id">
                        <option value="">Select Department</option>
                        <?php foreach (Department::find_by_undeleted() as $department) : ?>
                           <option value="<?php echo $department->id ?>">
                              <?php echo ucwords($department->department_name) ?>
                           </option>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div class="submit-section">
                     <button class="btn btn-primary submit-btn" id="add_designation_btn">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php');  ?>

<script type="text/javascript">
   $(document).ready(function() {

      const DESIGNATION_URL = "inc/designation_script.php";
      const designationModal = new bootstrap.Modal(document.getElementById("designation_modal"));
      const designationTitle = document.getElementById('designation-title');
      const submitDesignationBtn = document.getElementById("add_designation_btn");
      const designationForm = document.getElementById("add_designation_form");

      const showAlert = document.getElementById('showAlert');

      const message = (req, res) => {
         swal(req + "!", res, {
            icon: req,
            buttons: {
               confirm: {
                  className: (req == 'error') ? 'btn btn-danger' : 'btn btn-success'
               }
            }
         }).then(() => location.reload())
      }

      designationForm.addEventListener("submit", async (e) => {
         e.preventDefault();

         const formData = new FormData(designationForm);
         formData.append("addDesignation", 1);

         submitDesignationBtn.innerText = "Please Wait...";

         const data = await fetch(DESIGNATION_URL, {
            method: "POST",
            body: formData,
         });

         const response = await data.json();

         if (response.errors) {
            showAlert.innerHTML = response.errors

            setTimeout(() => {
               showAlert.innerHTML = '';
               submitDesignationBtn.innerText = "Submit";
            }, 3000);
         }

         if (response.message) {
            message('success', response.message)
         }
      });

      $('#designation-table tbody').on('click', '#edit-designation-btn', async function(e) {
         let id = this.dataset.id
         designationForm.id = 'edit_designation_form';
         const editDesignationForm = document.getElementById("edit_designation_form");

         let data = await fetch(DESIGNATION_URL + "?designationId=" + id);
         let response = await data.json();

         document.getElementById('designation_name').value = response.data.designation_name;
         document.getElementById('department_id').value = response.data.department_id;

         designationTitle.innerText = 'Edit Designation';
         submitDesignationBtn.innerText = "Update";
         submitDesignationBtn.id = "edit_designation_btn";
         designationModal.show();

         submitDesignationBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            const editFormData = new FormData(editDesignationForm);
            editFormData.append("update", 1);
            editFormData.append('designationId', id);

            submitDesignationBtn.innerText = "Please Wait...";

            let data = await fetch(DESIGNATION_URL, {
               method: "POST",
               body: editFormData,
            });
            let response = await data.json();

            if (response.errors) {
               message('error', response.errors)
            } else {
               message('success', response.message)
            }
         });

         $('#designation_modal').on('hidden.bs.modal', function() {
            location.reload()
         })
      });


      $('#designation-table tbody').on('click', '#delete-designation-btn', function() {
         let designationId = this.dataset.id;

         swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            buttons: {
               confirm: {
                  text: 'Yes, delete it!',
                  className: 'btn btn-danger'
               },
               cancel: {
                  visible: true,
                  className: 'btn btn-secondary'
               }
            }
         }).then(Delete => {
            if (Delete) {
               fetch(DESIGNATION_URL + '?designationId=' + designationId + '&deleted=1')
                  .then(response => response.json()).then(data => {
                     swal({
                        title: 'Deleted!',
                        text: data.message,
                        icon: 'success',
                        buttons: {
                           confirm: {
                              className: 'btn btn-success'
                           }
                        }
                     }).then(() => location.reload());
                  })
            } else {
               swal.close();
            }
         })
      });

   });
</script>