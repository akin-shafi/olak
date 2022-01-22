<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payroll Items';
include(SHARED_PATH . '/header.php');
$datatable = '';
$select2 = '';
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Employee Salary</h4>
   </div>
   <!-- <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list mt-3 mt-lg-0"> <button type="button" class="btn btn-primary me-3" id="generate_payslip">Generate Payslip</button>
            <button class="btn btn-secondary me-3" data-bs-toggle="modal" data-bs-target="#excelmodal"> <i class="las la-file-excel"></i> Download Monthly Excel Report </button> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
         </div>
      </div>
   </div> -->
</div>

<div class="row">
   <div class="col-md-12">
      <div class="card">
         
         <div class="card-body">
            <div class="table-responsive">
               <div id="hr-payroll_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-payroll" role="grid" aria-describedby="hr-payroll_xxinfo">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 w-5 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="#Emp ID: activate to sort column ascending" style="width: 52.8993px;">#Emp ID</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="Emp Name: activate to sort column ascending" style="width: 174.41px;">Emp Name</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="(₦) Salary: activate to sort column ascending" style="width: 61.6146px;">(₦) Salary</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="(₦) Salary Advance: activate to sort column ascending" style="width: 61.6146px;">(₦) Salary Advance</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="(₦) Loan: activate to sort column ascending" style="width: 61.6146px;">(₦) Loan</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 63.0382px;">Status</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 260.503px;">Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $sn = 1; foreach (Employee::find_by_undeleted() as $value) :
                                 $empLoan = EmployeeLoan::find_by_employee_id($value->id);
                              ?>
                                 <tr>
                                    <td>#<?php echo $sn++ ?></td>
                                    <td>
                                       <div class="d-flex">
                                          <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
                                          <div class="me-3 mt-0 mt-sm-1 d-block">
                                             <h6 class="mb-1 fs-14"><?php echo $value->full_name() ?></h6>
                                             <p class="text-muted mb-0 fs-12"><?php echo strtolower($value->email) ?></p>
                                          </div>
                                       </div>
                                    </td>
                                    <td class="font-weight-semibold"><?php echo number_format(intval($value->present_salary)) ?></td>
                                    <td>
                                       <?php echo isset($empLoan->type) && $empLoan->type == '1'
                                          ? number_format($empLoan->amount) : '0.00' ?>
                                    </td>
                                    <td>
                                       <?php echo isset($empLoan->type) && $empLoan->type == '2'
                                          ? number_format($empLoan->amount) : '0.00' ?>
                                    </td>

                                    <td><span class="badge badge-warning">Nill</span></td>
                                    <td class="text-start"> <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a></td>
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
