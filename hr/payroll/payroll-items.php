<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payroll Items';
include(SHARED_PATH . '/admin_header.php');
?>

<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row align-items-center">
            <div class="col">
               <h3 class="page-title">Payroll Items</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Payroll Items</li>
               </ul>
            </div>
         </div>
      </div>
      <div class="page-menu">
         <div class="row">
            <div class="col-sm-12">
               <ul class="nav nav-tabs nav-tabs-bottom">
                  <li class="nav-item">
                     <a class="nav-link active" data-bs-toggle="tab" href="#tab_additions">Additions</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-bs-toggle="tab" href="#tab_overtime">Overtime</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-bs-toggle="tab" href="#tab_deductions">Deductions</a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <div class="tab-content">
         <div class="tab-pane show active" id="tab_additions">
            <div class="text-end mb-4 clearfix">
               <button class="btn btn-primary add-btn" type="button" data-bs-toggle="modal" data-bs-target="#add_addition"><i class="fa fa-plus"></i> Add Addition</button>
            </div>
            <div class="payroll-table card">
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-hover table-radius datatable">
                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>% Based</th>
                              <th class="text-end">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach (PayrollAddition::find_by_undeleted() as $add) : ?>
                              <tr>
                                 <th><?php echo ucwords($add->name) ?></th>
                                 <td><?php echo $add->value ?></td>
                                 <td class="text-end">
                                    <div class="dropdown dropdown-action">
                                       <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <a class="dropdown-item" href="#" data-id="<?php echo $add->id ?>" id="edit_addition"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                          <a class="dropdown-item" href="#" data-id="<?php echo $add->id ?>" id="delete_addition"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

         <div class="tab-pane" id="tab_overtime">
            <div class="text-end mb-4 clearfix">
               <button class="btn btn-primary add-btn" type="button" data-bs-toggle="modal" data-bs-target="#add_overtime"><i class="fa fa-plus"></i> Add Overtime</button>
            </div>
            <div class="payroll-table card">
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-hover table-radius datatable">
                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>Daily (₦)</th>
                              <th class="text-end">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach (PayrollOvertime::find_by_undeleted() as $over) : ?>
                              <tr>
                                 <th><?php echo ucwords($over->name) ?></th>
                                 <td><?php echo $over->value ?></td>
                                 <td class="text-end">
                                    <div class="dropdown dropdown-action">
                                       <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <a class="dropdown-item" href="#" data-id="<?php echo $over->id ?>" id="edit_overtime"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                          <a class="dropdown-item" href="#" data-id="<?php echo $over->id ?>" id="delete_overtime"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

         <div class="tab-pane" id="tab_deductions">
            <div class="text-end mb-4 clearfix">
               <button class="btn btn-primary add-btn" type="button" data-bs-toggle="modal" data-bs-target="#add_deduction"><i class="fa fa-plus"></i> Add Deduction</button>
            </div>
            <div class="payroll-table card">
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-hover table-radius datatable">
                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>Amount (₦)</th>
                              <th class="text-end">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach (PayrollDeduction::find_by_undeleted() as $deduct) : ?>
                              <tr>
                                 <th><?php echo ucwords($deduct->name) ?></th>
                                 <td><?php echo $deduct->value ?></td>
                                 <td class="text-end">
                                    <div class="dropdown dropdown-action">
                                       <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <a class="dropdown-item" href="#" data-id="<?php echo $deduct->id ?>" id="edit_deduction"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                          <a class="dropdown-item" href="#" data-id="<?php echo $deduct->id ?>" id="delete_deduction"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
      </div>
   </div>
</div>

<?php include('inc/modal/all.php');  ?>
<?php include(SHARED_PATH . '/admin_footer.php');  ?>

<script>
   const PAYROLL_URL = "inc/salary_script.php";

   const additionModal = new bootstrap.Modal(document.querySelector("#add_addition"));
   const overtimeModal = new bootstrap.Modal(document.querySelector("#add_overtime"));
   const deductionModal = new bootstrap.Modal(document.querySelector("#add_deduction"));

   const additionForm = document.getElementById("add_addition_form");
   const deductionForm = document.getElementById("add_deduction_form");
   const overtimeForm = document.getElementById("add_overtime_form");

   const additionBtn = document.querySelector("#addition_btn");
   const deductionBtn = document.querySelector("#deduction_btn");
   const overtimeBtn = document.querySelector("#overtime_btn");


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

   const deleted = async (url) => {
      swal({
         title: 'Are you sure?',
         text: 'You won\'t be able to reverse this!',
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
            fetch(url)
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
   };

   const submitPayroll = async (url, payload) => {
      const formData = new FormData(payload);

      const data = await fetch(url, {
         method: "POST",
         body: formData,
      });

      const response = await data.json();

      if (response.errors) {
         message('error', response.errors)
      }

      if (response.message) {
         message('success', response.message)
      }
   };

   additionForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitPayroll(PAYROLL_URL, additionForm);
   });

   deductionForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitPayroll(PAYROLL_URL, deductionForm);
   });

   overtimeForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitPayroll(PAYROLL_URL, overtimeForm);
   });

   $('tbody').on('click', '#edit_addition', async function(e) {
      let id = this.dataset.id

      additionForm.id = 'edit_addition_form';
      const editAdditionForm = document.querySelector("#edit_addition_form");

      let data = await fetch(PAYROLL_URL + "?addId=" + id);
      let response = await data.json();

      document.querySelector('#addition_name').value = response.data.name;
      document.querySelector('#addition_value').value = response.data.value;

      additionModal.show();

      additionBtn.addEventListener("click", async (e) => {
         e.preventDefault();

         const editFormData = new FormData(editAdditionForm);
         editFormData.append("update", 1);
         editFormData.append('editAdding', 1);
         editFormData.append('addId', id);

         let data = await fetch(PAYROLL_URL, {
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
   });

   $('tbody').on('click', '#edit_deduction', async function(e) {
      let id = this.dataset.id

      deductionForm.id = 'edit_deduction_form';
      const editDeductionForm = document.querySelector("#edit_deduction_form");

      let data = await fetch(PAYROLL_URL + "?deductId=" + id);
      let response = await data.json();

      document.querySelector('#deduction_name').value = response.data.name;
      document.querySelector('#deduction_value').value = response.data.value;

      deductionModal.show();

      deductionBtn.addEventListener("click", async (e) => {
         e.preventDefault();

         const editFormData = new FormData(editDeductionForm);
         editFormData.append("update", 1);
         editFormData.append('editDeduction', 1);
         editFormData.append('deductId', id);

         let data = await fetch(PAYROLL_URL, {
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
   });

   $('tbody').on('click', '#edit_overtime', async function(e) {
      let id = this.dataset.id

      overtimeForm.id = 'edit_overtime_form';
      const editOvertimeForm = document.querySelector("#edit_overtime_form");

      let data = await fetch(PAYROLL_URL + "?overId=" + id);
      let response = await data.json();

      document.querySelector('#overtime_name').value = response.data.name;
      document.querySelector('#overtime_value').value = response.data.value;

      overtimeModal.show();

      overtimeBtn.addEventListener("click", async (e) => {
         e.preventDefault();

         const editFormData = new FormData(editOvertimeForm);
         editFormData.append("update", 1);
         editFormData.append('editOvertime', 1);
         editFormData.append('overId', id);

         let data = await fetch(PAYROLL_URL, {
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
   });

   $(document).on('click', '#delete_addition', function() {
      let delId = this.dataset.id;
      deleted(PAYROLL_URL + '?delId=' + delId + '&deleteAddition=1');
   });

   $(document).on('click', '#delete_deduction', function() {
      let delId = this.dataset.id;
      deleted(PAYROLL_URL + '?delId=' + delId + '&deleteDeduction=1');
   });

   $(document).on('click', '#delete_overtime', function() {
      let delId = this.dataset.id;
      deleted(PAYROLL_URL + '?delId=' + delId + '&deleteOvertime=1');
   });
</script>