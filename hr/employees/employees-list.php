<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'All Employees';
include(SHARED_PATH . '/admin_header.php');
?>

<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row align-items-center">
            <div class="col">
               <h3 class="page-title">Employee</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Employee</li>
               </ul>
            </div>
            <div class="col-auto float-end ms-auto">
               <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#employee_modal"><i class="fa fa-plus"></i> Add Employee</a>
               <div class="view-icons">
                  <a href="<?php echo url_for('employees/') ?>" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                  <a href="<?php echo url_for('employees/employees-list.php') ?>" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
               </div>
            </div>
         </div>
      </div>
      <div class="row filter-row">
         <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
               <input type="text" class="form-control floating">
               <label class="focus-label">Employee ID</label>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
               <input type="text" class="form-control floating">
               <label class="focus-label">Employee Name</label>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus">
               <select class="select floating" name="search_by_designation" id="search_by_designation">
                  <option value="">Select Designation</option>
                  <?php foreach (Designation::find_by_undeleted() as $designation) : ?>
                     <option value="<?php echo $designation->id ?>">
                        <?php echo ucwords($designation->designation_name) ?>
                     </option>
                  <?php endforeach; ?>
               </select>
               <label class="focus-label">Designation</label>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <a href="#" class="btn btn-success w-100"> Search </a>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="table-responsive">
               <table class="table table-striped custom-table datatable" id="employee-table">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Employee ID</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th class="text-nowrap">Join Date</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th class="text-end no-sort">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach (Employee::find_by_undeleted() as $employee) :
                        $departmentName = Department::find_by_id($employee->department_id)->department_name;
                        $designationName = Designation::find_by_id($employee->designation_id)->designation_name;
                     ?>
                        <tr>
                           <td>
                              <h2 class="table-avatar">
                                 <a href="#" class="avatar">
                                    <img alt="" src="<?php echo url_for('/assets/uploads/' . $employee->photo); ?>">
                                 </a>
                                 <a href="#"><?php echo ucwords($employee->full_name()) ?></a>
                              </h2>
                           </td>
                           <td><?php echo strtoupper($employee->employee_id) ?></td>
                           <td><?php echo $employee->email ?></td>
                           <td><?php echo $employee->phone ?></td>
                           <td><?php echo date('M jS, Y', strtotime($employee->date_employed)) ?></td>
                           <td><?php echo ucwords($departmentName) ?></td>
                           <td><?php echo ucwords($designationName) ?></td>
                           <td class="text-end">
                              <div class="dropdown dropdown-action">
                                 <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-id="<?php echo $employee->id ?>" id="edit-employee-btn"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-id="<?php echo $employee->id ?>" id="delete-employee-btn"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

   <div id="employee_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="employee-title">Add Employee</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div id="showAlert"></div>

               <form id="add_employee_form">
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                           <input class="form-control" name="first_name" id="first_name" type="text">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-form-label">Last Name</label>
                           <input class="form-control" name="last_name" id="last_name" type="text">
                        </div>
                     </div>

                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Email <span class="text-danger">*</span></label>
                           <input class="form-control" name="email" id="email" type="email">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Password</label>
                           <input class="form-control" name="password" id="password" type="password">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Confirm Password</label>
                           <input class="form-control" name="confirm_password" id="confirm_password" type="password">
                        </div>
                     </div>

                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="employee_id" id="employee_id">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                           <div class="cal-icon">
                              <input class="form-control" name="date_employed" id="date_employed" type="date">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Phone </label>
                           <input class="form-control" name="phone" id="phone" type="text">
                        </div>
                     </div>

                     <div class="col-md-6">
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
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Designation <span class="text-danger">*</span></label>
                           <select class="select" name="designation_id" id="designation_id">
                              <option value="">Select Designation</option>
                              <?php foreach (Designation::find_by_undeleted() as $designation) : ?>
                                 <option value="<?php echo $designation->id ?>">
                                    <?php echo ucwords($designation->designation_name) ?>
                                 </option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-6 m-auto">
                        <div class="form-group">
                           <label class="col-form-label">Profile Image </label>
                           <input type="file" name="profile_image" class="form-control" id="profile_image">
                        </div>
                     </div>

                  </div>

                  <div class="table-responsive m-t-15 d-none">
                     <table class="table table-striped custom-table">
                        <thead>
                           <tr>
                              <th>Module Permission</th>
                              <th class="text-center">Read</th>
                              <th class="text-center">Write</th>
                              <th class="text-center">Create</th>
                              <th class="text-center">Delete</th>
                              <th class="text-center">Import</th>
                              <th class="text-center">Export</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Holidays</td>
                              <td class="text-center">
                                 <input checked="" type="checkbox">
                              </td>
                              <td class="text-center">
                                 <input type="checkbox">
                              </td>
                              <td class="text-center">
                                 <input type="checkbox">
                              </td>
                              <td class="text-center">
                                 <input type="checkbox">
                              </td>
                              <td class="text-center">
                                 <input type="checkbox">
                              </td>
                              <td class="text-center">
                                 <input type="checkbox">
                              </td>
                           </tr>

                        </tbody>
                     </table>
                  </div>

                  <div class="submit-section">
                     <button class="btn btn-primary submit-btn" id="add_employee_btn">Submit</button>
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

      const EMPLOYEE_URL = "inc/employee_script.php";
      const employeeModal = new bootstrap.Modal(document.getElementById("employee_modal"));
      const employeeTitle = document.getElementById('employee-title');
      const submitEmployeeBtn = document.getElementById("add_employee_btn");
      const employeeForm = document.getElementById("add_employee_form");

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

      employeeForm.addEventListener("submit", async (e) => {
         e.preventDefault();

         const formData = new FormData(employeeForm);
         formData.append("addEmployee", 1);

         submitEmployeeBtn.innerText = "Please Wait...";

         const data = await fetch(EMPLOYEE_URL, {
            method: "POST",
            body: formData,
         });

         const response = await data.json();

         if (response.errors) {
            showAlert.innerHTML = response.errors

            setTimeout(() => {
               showAlert.innerHTML = '';
               submitEmployeeBtn.innerText = "Submit";
            }, 3000);
         }

         if (response.message) {
            message('success', response.message)
         }
      });

      $('#employee-table tbody').on('click', '#edit-employee-btn', async function(e) {
         let id = this.dataset.id
         employeeForm.id = 'edit_employee_form';
         const editEmployeeForm = document.getElementById("edit_employee_form");

         let data = await fetch(EMPLOYEE_URL + "?employeeId=" + id);
         let response = await data.json();

         document.getElementById('first_name').value = response.data.first_name;
         document.getElementById('last_name').value = response.data.last_name;
         document.getElementById('email').value = response.data.email;
         document.getElementById('employee_id').value = response.data.employee_id;
         document.getElementById('date_employed').value = response.data.date_employed;
         document.getElementById('phone').value = response.data.phone;
         document.getElementById('department_id').value = response.data.department_id;
         document.getElementById('designation_id').value = response.data.designation_id;

         employeeTitle.innerText = 'Edit Employee';
         submitEmployeeBtn.innerText = "Update";
         submitEmployeeBtn.id = "edit_employee_btn";
         employeeModal.show();

         submitEmployeeBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            const editFormData = new FormData(editEmployeeForm);
            editFormData.append("update", 1);
            editFormData.append('employeeId', id);

            submitEmployeeBtn.innerText = "Please Wait...";

            let data = await fetch(EMPLOYEE_URL, {
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

         $('#employee_modal').on('hidden.bs.modal', function() {
            location.reload()
         })
      });


      $('#employee-table tbody').on('click', '#delete-employee-btn', function() {
         let employeeId = this.dataset.id;

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
               fetch(EMPLOYEE_URL + '?employeeId=' + employeeId + '&deleted=1')
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