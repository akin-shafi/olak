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
                                <!--  <th class="border-bottom-0 w-5 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="#Emp ID: activate to sort column ascending" style="width: 52.8993px;">#Emp ID</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="Emp Name: activate to sort column ascending" style="width: 174.41px;">Emp Name</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="(₦) Salary: activate to sort column ascending" style="width: 61.6146px;">(₦) Job Title</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="(₦) Salary Advance: activate to sort column ascending" style="width: 61.6146px;">(₦) Salary</th>
                                 
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 63.0382px;">Status</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 260.503px;">Actions</th> -->
                                 <th>SN</th>
                                 <th>Emp Name</th>
                                 <th>Job Title</th>
                                 <th>(₦) Salary</th>
                                 <th>Action</th>
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
                                     <td>
                                       <?php echo !empty($value->job_title) ? $value->job_title : 'Not Set' ?>
                                    </td>
                                    <td class="font-weight-semibold"><?php echo number_format(intval($value->present_salary), 2) ?></td>
                                   
                                    
                                    <td class="text-start"> 
                                       <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View Salary Details" aria-label="View"></i> </a> 

                                       

                                       <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print Salary Details"> <i class="feather feather-printer text-success"></i> </a>
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


<div class="modal fade show" id="viewsalarymodal" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">PaySlip</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
         </div>
         <div class="modal-header">
            <div> <img src="<?php echo url_for('assets/images/brand/logo.png') ?>" class="header-brand-img" alt="Dayonelogo"> </div>
            <div class="ms-auto">
               <!-- <div class="font-weight-bold text-md-right mt-3">Date: 01-02-2021</div> -->
            </div>
         </div>
         <div class="modal-body pt-1">
            <div class="table-responsive mt-3 mb-3">
               <table class="table mb-0 modal-paytable">
                  <tbody>
                     <tr>
                        <td> <strong>Emp ID:</strong> <span>2987</span> </td>
                        <td class="text-end"> <strong>Emp Name:</strong> <span>Faith Harris</span> </td>
                     </tr>
                     <tr>
                        <td> <strong>Location:</strong> <span>Ilorin</span> </td>
                        <!-- <td class="text-end"> <strong>Pay Period:</strong> <span>January-2021</span> </td> -->
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="table-responsive mt-4">
               <table class="table text-nowrap mb-0 border">
                  <tbody>
                     <tr>
                        <td class="p-0">
                           <table class="table text-nowrap mb-0">
                              <thead>
                                 <tr>
                                    <th class="fs-18" rowspan="1" colspan="2">Earnings</th>
                                 </tr>
                                 <tr>
                                    <th>Pay Type</th>
                                    <th class="border-start">Amount(<?php echo $currency ?>)</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>Basic</td>
                                    <td class="border-start">32,000</td>
                                 </tr>
                                 <tr>
                                    <td>HRA</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr>
                                    <td>Medical Allowance</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr>
                                    <td>Bonus Allowance</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr class="border-top">
                                    <td class="font-weight-semibold">Total Earnings</td>
                                    <td class="font-weight-semibold border-start">32,000</td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                        <td class="p-0">
                           <table class="table text-nowrap mb-0 border-start">
                              <thead>
                                 <tr>
                                    <th class="fs-18" rowspan="1" colspan="2">Deduction</th>
                                 </tr>
                                 <tr>
                                    <th>Pay Type</th>
                                    <th class="border-start">Amount</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>PF</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr>
                                    <td>Professional Tax</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr>
                                    <td>TDS</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr>
                                    <td>Loans &amp; Others</td>
                                    <td class="border-start">0.00</td>
                                 </tr>
                                 <tr class="border-top">
                                    <td class="font-weight-semibold">Total Deduction</td>
                                    <td class="font-weight-semibold border-start">0.00</td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="mt-4 mb-3">
               <table class="table mb-0">
                  <tbody>
                     <tr>
                        <td class="font-weight-semibold w-20 fs-18 pb-0 pt-0">Net Salary</td>
                        <td class="pb-0 pt-0">
                           <h4 class="font-weight-semibold mb-0 fs-24"><?php echo $currency ?> 32,000</h4>
                        </td>
                     </tr>
                     <tr>
                        <td class="font-weight-semibold w-20 pb-0 pt-1 text-muted">InWords</td>
                        <td class="pb-0 pt-1">
                           <h5 class="mb-0  text-muted">Thirty-Two Thousand only</h5>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="p-5 border-top text-center">
            <div class="text-center">
               <h6 class="mb-2">Integrated Olak Group.</h6>
               <p class="mb-1 fs-12">Adress</p>
               <div> <small>Tel No: +234 66904 8599,</small> <small>Email: info@olakgroups.com</small> </div>
            </div>
         </div>
         <div class="modal-footer">
            <div class="ms-auto"> 
               <a href="#" class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> Print</a> 
               <!-- <a href="#" class="btn btn-success"><i class="feather feather-download"></i> Download</a>  -->
               <!-- <a href="#" class="btn btn-primary"><i class="si si-paper-plane"></i> Send</a>  -->
               <a href="#" class="btn btn-danger" data-bs-dismiss="modal"><i class="feather feather-x"></i> Close</a> </div>
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
