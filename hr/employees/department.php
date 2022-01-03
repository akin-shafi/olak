<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Departments';
include(SHARED_PATH . '/admin_header.php');
?>
<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row align-items-center">
            <div class="col">
               <h3 class="page-title">Department</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Department</li>
               </ul>
            </div>
            <div class="col-auto float-end ms-auto">
               <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#department_modal"><i class="fa fa-plus"></i> Add Department</a>
            </div>
         </div>
      </div>

      <style>
         td {
            vertical-align: middle;
         }
      </style>

      <div class="row">
         <div class="col-md-12">
            <div>
               <table class="table table-striped custom-table mb-0 datatable" id="department-table">
                  <thead>
                     <tr>
                        <th style="width: 30px;">SN</th>
                        <th>Department Name</th>
                        <th>Created At</th>
                        <th class="text-end">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $sn = 1;
                     foreach (Department::find_by_undeleted() as $department) : ?>
                        <tr>
                           <td><?php echo $sn++ ?></td>
                           <td><?php echo ucwords($department->department_name) ?></td>
                           <td><?php echo date('Y-m-d', strtotime($department->created_at)) ?></td>

                           <td class="text-end">
                              <div class="dropdown dropdown-action">
                                 <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-id="<?php echo $department->id ?>" id="edit-department-btn"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-id="<?php echo $department->id ?>" id="delete-department-btn"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

   <div id="department_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="department-title">Add Department</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div id="showAlert"></div>

               <form id="add_department_form">
                  <div class="form-group">
                     <label>Department Name <span class="text-danger">*</span></label>
                     <input class="form-control" name="department_name" id="department_name" type="text">
                  </div>
                  <div class="submit-section">
                     <button class="btn btn-primary submit-btn" id="add_department_btn">Submit</button>
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

      const DEPARTMENT_URL = "inc/department_script.php";
      const departmentModal = new bootstrap.Modal(document.getElementById("department_modal"));
      const departmentTitle = document.getElementById('department-title');
      const submitDepartmentBtn = document.getElementById("add_department_btn");
      const departmentForm = document.getElementById("add_department_form");

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

      departmentForm.addEventListener("submit", async (e) => {
         e.preventDefault();

         const formData = new FormData(departmentForm);
         formData.append("addDepartment", 1);

         submitDepartmentBtn.innerText = "Please Wait...";

         const data = await fetch(DEPARTMENT_URL, {
            method: "POST",
            body: formData,
         });

         const response = await data.json();

         if (response.errors) {
            showAlert.innerHTML = response.errors

            setTimeout(() => {
               showAlert.innerHTML = '';
               submitDepartmentBtn.innerText = "Submit";
            }, 3000);
         }

         if (response.message) {
            message('success', response.message)
         }
      });

      $('#department-table tbody').on('click', '#edit-department-btn', async function(e) {
         let id = this.dataset.id
         departmentForm.id = 'edit_department_form';
         const editDepartmentForm = document.getElementById("edit_department_form");

         let data = await fetch(DEPARTMENT_URL + "?departmentId=" + id);
         let response = await data.json();

         document.getElementById('department_name').value = response.data.department_name;

         departmentTitle.innerText = 'Edit Department';
         submitDepartmentBtn.innerText = "Update";
         submitDepartmentBtn.id = "edit_department_btn";
         departmentModal.show();

         submitDepartmentBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            const editFormData = new FormData(editDepartmentForm);
            editFormData.append("update", 1);
            editFormData.append('departmentId', id);

            submitDepartmentBtn.innerText = "Please Wait...";

            let data = await fetch(DEPARTMENT_URL, {
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

         $('#department_modal').on('hidden.bs.modal', function() {
            location.reload()
         })
      });


      $('#department-table tbody').on('click', '#delete-department-btn', function() {
         let departmentId = this.dataset.id;

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
               fetch(DEPARTMENT_URL + '?departmentId=' + departmentId + '&deleted=1')
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