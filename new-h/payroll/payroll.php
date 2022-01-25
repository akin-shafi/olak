<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payroll';
include(SHARED_PATH . '/header.php');
$datatable = '';
$select2 = '';
$employees = Employee::find_by_undeleted();
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Employee Salary</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list mt-3 mt-lg-0"> <button type="button" class="btn btn-primary me-3" id="generate_payslip">Generate Payslip</button>
            <button class="btn btn-secondary me-3" data-bs-toggle="modal" data-bs-target="#excelmodal"> <i class="las la-file-excel"></i> Download Monthly Excel Report </button> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <div class="row">
               <div class="col-md-12 col-lg-3" data-select2-id="select2-data-67-rw6j">
                  <div class="form-group" data-select2-id="select2-data-66-6byr">
                     <label class="form-label">Employee Name:</label>
                     <select name="attendance" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Employee" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-25-irhg">
                        <option label="Select Employee" data-select2-id="select2-data-27-u6o2"></option>
                        <?php foreach ($employees as $key => $value) { ?>
                           <option value="<?php echo $value->employee_id  ?>" data-select2-id="select2-data-68-qxxj">
                              <?php echo Employee::find_by_id($value->id)->full_name()  ?></option>
                        <?php } ?>
                     </select>

                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="">
               <div id="hr-payroll_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-payroll" role="grid" aria-describedby="hr-payroll_xxinfo">
                           <thead>
                              <tr role="row">
                                 <th class="bg-white">#Emp ID</th>
                                 <th class="bg-white">#Emp Name</th>
                                 <th>(₦) Salary</th>
                                 <th>(₦) Salary Advance</th>
                                 <th>(₦) Loan</th>
                                 <th>(₦) Take Home</th>
                                 <th>Status</th>
                                 <th class="bg-white">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php foreach (Employee::find_by_undeleted() as $value) :
                                 $empLoan = EmployeeLoan::find_by_employee_id($value->id);
                                 $salary_advance = SalaryAdvance::find_by_employee_id($value->id);
                                 $salary = intval($value->present_salary);
                                 $take_home = intval($salary) - intval($empLoan);
                                 $sn = 1;
                              ?>
                                 <tr>
                                    <td class="bg-white"><?php echo $sn++ ; ?></td>
                                    <td class="bg-white">
                                       <div class="d-flex">
                                          <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
                                          <div class="me-3 mt-0 mt-sm-1 d-block">
                                             <h6 class="mb-1 fs-14"><?php echo $value->full_name() ?></h6>
                                             <p class="text-muted mb-0 fs-12"><?php echo strtolower($value->email) ?></p>
                                          </div>
                                       </div>
                                    </td>
                                    <td><?php echo number_format($salary) ?></td>
                                    <td>
                                       <?php echo !empty($salary_advance->total_requested) ? number_format($salary_advance->total_requested) : '0.00' ?>
                                    </td>
                                    <td>
                                       <?php echo !empty($empLoan->amount) ? number_format($empLoan->amount) : '0.00' ?>
                                    </td>
                                    <td class="font-weight-semibold"><?php echo number_format($take_home) ?></td>
                                    <td><span class="badge badge-danger">Unpaid</span></td>
                                    <td class="text-start bg-white"> <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a></td>
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

<?php include(SHARED_PATH . '/footer.php'); ?>

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

      const SETTING_URL = "../inc/setting/generate_payslip.php";

      const generateSlip = document.getElementById("generate_payslip");

      generateSlip.addEventListener("click", async (e) => {
         $.ajax({
            url: SETTING_URL,
            method: "POST",
            data: {
               generateSlip: 1,
            },
            dataType: "json",
            success: function(r) {
               if (r.success == true) {
                  console.log('welcome back');
               } else {
                  // errorAlert("Success email not sent")
               }
            }
         })
      })

      // generateSlip.addEventListener("click", async (e) => {
      //    e.preventDefault();
      //    let data = await fetch(SETTING_URL + '?generate')
      //    let res = await data.json();
      //    console.log(res.message);
      //    console.log(e);
      // });
   })
</script>
