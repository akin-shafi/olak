<?php
require_once('../private/initialize.php');

$departments = Department::find_by_undeleted();

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
               <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_department_modal"><i class="fa fa-plus"></i> Add Department</a>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div>
               <table class="table table-striped custom-table mb-0 datatable" id="department-table">
                  <thead>
                     <tr>
                        <th style="width: 30px;">#</th>
                        <th>Department Name</th>
                        <th class="text-end">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $sn = 1;
                     foreach ($departments as $department) : ?>
                        <tr>
                           <td><?php echo $sn++; ?></td>
                           <td><?php echo ucwords($department->name); ?></td>
                           <td class="text-end">
                              <div class="dropdown dropdown-action">
                                 <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-id="<?php echo $department->id ?>" id="edit-btn">
                                       <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" data-id="<?php echo $department->id ?>" id="delete-btn"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

   <div id="add_department_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Add Department</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form id="department-form">
                  <div class="form-group">
                     <label>Department Name <span class="text-danger">*</span></label>
                     <input class="form-control" name="name" type="text" id="department_name">
                  </div>
                  <div class="submit-section">
                     <button class="btn btn-primary submit-btn" id="submit-department-btn">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php');  ?>

<script>
   const URL = "inc/manage_department.php";
   const departmentModal = new bootstrap.Modal(document.getElementById("add_department_modal"));
   const departmentForm = document.getElementById('department-form');
   const submitBtn = document.getElementById("submit-department-btn");
   const showAlert = document.getElementById("showAlert");

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
      e.stopPropagation();

      const formData = new FormData(departmentForm);
      formData.append("addDept", 1);

      submitBtn.innerText = "Please Wait...";

      const data = await fetch(URL, {
         method: "POST",
         body: formData,
      });

      const response = await data.json();

      if (response.errors) {
         message('error', response.errors)
         departmentModal.hide();
      }

      if (response.message) {
         message('success', response.message)
         departmentForm.reset();
         departmentModal.hide();
      }
   });

   $('#department-table tbody').on('click', '#edit-btn', async function(e) {
      let deptId = this.dataset.id
      departmentForm.id = 'edit-department-form';

      let data = await fetch(URL + "?departmentId=" + deptId);
      let response = await data.json();

      if (response.errors) {
         message('error', response.errors)
      } else {
         const updateDepartmentForm = document.getElementById("edit-department-form");

         document.getElementById('department_name').value = response.data.name

         submitBtn.innerHTML = "Update";
         submitBtn.id = "edit-category-btn";
         submitBtn.setAttribute('data-id', response.data.id);

         $('#add_department_modal').modal('show');

         submitBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            let id = this.dataset.id

            const editFormData = new FormData(updateDepartmentForm);
            editFormData.append("update", 1);
            editFormData.append("departmentId", id);

            submitBtn.value = "Please Wait...";

            let data = await fetch(URL, {
               method: "POST",
               body: editFormData,
            });
            let response = await data.json();

            if (response.errors) {
               message('error', response.errors)
            } else {
               message('success', response.message);
            }
         });
      }
   });

   $('#department-table tbody').on('click', '#delete-btn', function() {
      let depId = this.dataset.id;

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
            fetch(URL + '?departmentId=' + depId + '&delete')
               .then(response => response.json())
               .then(data => {
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
      });
   });
</script>