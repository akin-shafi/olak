<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Employee Salary';
include(SHARED_PATH . '/admin_header.php');
?>

<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row align-items-center">
            <div class="col">
               <h3 class="page-title">Employee Salary</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Salary</li>
               </ul>
            </div>
            <div class="col-auto float-end ms-auto">
               <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#salary_modal"><i class="fa fa-plus"></i> Add Salary</a>
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
               <table class="table table-striped custom-table datatable" id="salary-table">
                  <thead>
                     <tr>
                        <th>SN</th>
                        <th>Employee</th>
                        <th>Employee ID</th>
                        <th>Email</th>
                        <th>Join Date</th>
                        <th>Role</th>
                        <th>Salary</th>
                        <th>Payslip</th>
                        <th class="text-end">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $sn = 1;
                     foreach (Salary::find_by_undeleted() as  $salary) :
                        $employee = Employee::find_by_id($salary->employee_id);
                        $earning = SalaryEarning::find_by_salary_id($salary->id);
                        $deduction = SalaryDeduction::find_by_salary_id($salary->id);
                        $departmentName = Department::find_by_id($employee->department_id)->department_name;
                        $designationName = Designation::find_by_id($employee->designation_id)->designation_name;
                     ?>
                        <tr>
                           <td><?php echo $sn++; ?></td>
                           <td>
                              <h2 class="table-avatar">
                                 <a href="<?php echo url_for('employees/profile.php?employee_id=' . $salary->employee_id) ?>" class="avatar">
                                    <img alt="" src="<?php echo url_for('/assets/uploads/' . $employee->photo); ?>">
                                 </a>
                                 <a href="<?php echo url_for('employees/profile.php?employee_id=' . $salary->employee_id) ?>">
                                    <?php echo ucwords($employee->full_name()); ?>
                                    <span><?php echo ucwords($designationName); ?></span>
                                 </a>
                              </h2>
                           </td>
                           <td><?php echo strtoupper($employee->employee_id); ?></td>
                           <td><?php echo $employee->email; ?></td>
                           <td><?php echo date('M jS, Y', strtotime($employee->date_employed)); ?></td>
                           <td><?php echo ucwords($departmentName); ?></td>
                           <td><?php echo '₦ ' . number_format(intval($salary->net_salary), 2); ?></td>

                           <td>
                              <a class="btn btn-sm btn-primary" href="<?php echo url_for('payroll/salary-view.php?generate=' . $salary->id) ?>">Generate Slip</a>
                           </td>

                           <td class="text-end">
                              <div class="dropdown dropdown-action">
                                 <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-id="<?php echo $salary->id; ?>" id="edit-salary-btn"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-id="<?php echo $salary->id; ?>" id="delete-salary-btn"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

   <div id="salary_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="salary-title">Add Staff Salary</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div id="showAlert"></div>

               <form id="add_salary_form">
                  <div class=" row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Select Staff</label>
                           <select class="form-control" name="salary[employee_id]" id="employee_id">
                              <option value="">Select Staff</option>
                              <?php foreach (Employee::find_by_undeleted() as $employee) : ?>
                                 <option value="<?php echo $employee->id; ?>">
                                    <?php echo ucwords($employee->full_name()); ?>
                                 </option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <label>Net Salary</label>
                        <input class="form-control" name="salary[net_salary]" id="net_salary" type="text" readonly>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-sm-6">
                        <h4 class="text-primary">Earnings</h4>
                        <div class="form-group">
                           <label>Actual Amount</label>
                           <input class="form-control" name="earning[actual_amount]" id="actual_amount" type="number">
                        </div>
                        <div class="form-group">
                           <label>Basic</label>
                           <input class="form-control" name="earning[basic_salary]" id="basic_salary" type="text" readonly>
                        </div>
                        <div class="form-group">
                           <label>House Rent Allowance (?%)</label>
                           <input class="form-control" name="earning[housing]" id="housing" type="text" readonly>
                        </div>
                        <div class="form-group">
                           <label>Dressing Allowance</label>
                           <input class="form-control" name="earning[dressing]" id="dressing" type="text" readonly>
                        </div>
                        <div class="form-group">
                           <label>Transport Allowance</label>
                           <input class="form-control" name="earning[transport]" id="transport" type="text" readonly>
                        </div>
                        <div class="form-group">
                           <label>Utility Allowance</label>
                           <input class="form-control" name="earning[utility]" id="utility" type="text" readonly>
                        </div>
                        <div class="form-group">
                           <label>Other Allowances</label>
                           <input class="form-control" name="earning[others]" id="other_earning" type="text" readonly>
                        </div>
                        <div class="add-more">
                           <a href="#"><i class="fa fa-plus-circle"></i> Add More</a>
                        </div>
                     </div>

                     <div class="col-sm-6">
                        <h4 class="text-primary">Deductions</h4>
                        <div class="form-group">
                           <label>Tax (PAYE)</label>
                           <input class="form-control" name="deduction[tax]" id="tax" type="text">
                        </div>
                        <div class="form-group">
                           <label>Employee Pension</label>
                           <input class="form-control" name="deduction[pension]" id="pension" type="text">
                        </div>

                        <div class="form-group">
                           <label>Others</label>
                           <input class="form-control" name="deduction[others]" id="other_deduction" type="text">
                        </div>
                        <div class="add-more">
                           <a href="#"><i class="fa fa-plus-circle"></i> Add More</a>
                        </div>
                     </div>
                  </div>
                  <div class="submit-section">
                     <button class="btn btn-primary submit-btn" id="add_salary_btn">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script type="text/javascript">
   $(document).ready(function() {

      const SALARY_URL = "inc/salary_script.php";
      const MORE_FIELDS = "inc/form_fields.php";
      const salaryModal = new bootstrap.Modal(document.querySelector("#salary_modal"));
      const salaryTitle = document.querySelector('#salary-title');
      const submitSalaryBtn = document.querySelector("#add_salary_btn");
      const salaryForm = document.querySelector("#add_salary_form");

      const showAlert = document.querySelector('#showAlert');

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

      salaryForm.addEventListener("submit", async (e) => {
         e.preventDefault();

         const formData = new FormData(salaryForm);
         formData.append("addSalary", 1);

         submitSalaryBtn.innerText = "Please Wait...";

         const data = await fetch(SALARY_URL, {
            method: "POST",
            body: formData,
         });

         const response = await data.json();

         if (response.errors) {
            showAlert.innerHTML = response.errors

            setTimeout(() => {
               showAlert.innerHTML = '';
               submitSalaryBtn.innerText = "Submit";
            }, 3000);
         }

         if (response.message) {
            message('success', response.message)
         }
      });

      $('#salary-table tbody').on('click', '#edit-salary-btn', async function(e) {
         let id = this.dataset.id

         salaryForm.id = 'edit_salary_form';
         const editSalaryForm = document.querySelector("#edit_salary_form");

         let data = await fetch(SALARY_URL + "?salaryId=" + id);
         let response = await data.json();

         document.querySelector('#employee_id').value = response.data.employee_id;
         document.querySelector('#actual_amount').value = response.data.actual_amount;
         document.querySelector('#basic_salary').value = response.data.basic_salary;
         document.querySelector('#housing').value = response.data.housing;
         document.querySelector('#dressing').value = response.data.dressing;
         document.querySelector('#transport').value = response.data.transport;
         document.querySelector('#utility').value = response.data.utility;
         document.querySelector('#other_earning').value = response.data.other_earning;

         document.querySelector('#tax').value = response.data.tax;
         document.querySelector('#pension').value = response.data.pension;
         document.querySelector('#other_deduction').value = response.data.other_deduction;

         document.querySelector('#net_salary').value = response.data.net_salary;

         salaryTitle.innerText = 'Edit Salary';
         submitSalaryBtn.innerText = "Update";
         submitSalaryBtn.id = "edit_salary_btn";
         salaryModal.show();

         submitSalaryBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            const editFormData = new FormData(editSalaryForm);
            editFormData.append("update", 1);
            editFormData.append('salaryId', id);

            submitSalaryBtn.innerText = "Please Wait...";

            let data = await fetch(SALARY_URL, {
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

         $('#salary_modal').on('hidden.bs.modal', function() {
            location.reload()
         })
      });


      $('#salary-table tbody').on('click', '#delete-salary-btn', function() {
         let salaryId = this.dataset.id;

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
               fetch(SALARY_URL + '?salaryId=' + salaryId + '&deleted=1')
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


      // ! CALCULATOR
      const actual_amount = document.querySelector('#actual_amount');
      const basic_salary = document.querySelector('#basic_salary');
      const housing = document.querySelector('#housing');
      const dressing = document.querySelector('#dressing');
      const transport = document.querySelector('#transport');
      const utility = document.querySelector('#utility');
      const other_earning = document.querySelector('#other_earning');

      actual_amount.addEventListener('keyup', function() {
         let salary = actual_amount.value;

         basic_salary.value = Math.round(salary * 0.12);
         housing.value = Math.round(salary * 0.32);
         dressing.value = Math.round(salary * 0.07);
         transport.value = Math.round(salary * 0.08);
         utility.value = Math.round(salary * 0.06);
         other_earning.value = Math.round(salary * 0.35);
      })

   });
</script>