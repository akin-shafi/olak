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
               <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                     <label class="form-label">Month:</label>
                     <select class="form-control select2" data-placeholder="Select Month">
                        <option label="Select Month" data-select2-id="select2-data-55-moyh"></option>
                        <option value="1" <?php echo date('m') == '1' ? 'selected' : '' ?>>January</option>
                        <option value="2" <?php echo date('m') == '2' ? 'selected' : '' ?>>February</option>
                        <option value="3" <?php echo date('m') == '3' ? 'selected' : '' ?>>March</option>
                        <option value="4" <?php echo date('m') == '4' ? 'selected' : '' ?>>April</option>
                        <option value="5" <?php echo date('m') == '5' ? 'selected' : '' ?>>May</option>
                        <option value="6" <?php echo date('m') == '6' ? 'selected' : '' ?>>June</option>
                        <option value="7" <?php echo date('m') == '7' ? 'selected' : '' ?>>July</option>
                        <option value="8" <?php echo date('m') == '8' ? 'selected' : '' ?>>August</option>
                        <option value="9" <?php echo date('m') == '9' ? 'selected' : '' ?>>September</option>
                        <option value="10" <?php echo date('m') == '10' ? 'selected' : '' ?>>October</option>
                        <option value="11" <?php echo date('m') == '11' ? 'selected' : '' ?>>November</option>
                        <option value="12" <?php echo date('m') == '12' ? 'selected' : '' ?>>December</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                     <label class="form-label">Year:</label>
                     <select class="form-control select2" data-placeholder="Select Year">
                        <option label="Select Year" data-select2-id="select2-data-75-ehux"></option>
                        <option value="2024" <?php echo date('Y') == '2024' ? 'selected' : '' ?>>2024</option>
                        <option value="2023" <?php echo date('Y') == '2023' ? 'selected' : '' ?>>2023</option>
                        <option value="2022" <?php echo date('Y') == '2022' ? 'selected' : '' ?>>2022</option>
                        <option value="2021" <?php echo date('Y') == '2021' ? 'selected' : '' ?>>2021</option>
                        <option value="2020" <?php echo date('Y') == '2020' ? 'selected' : '' ?>>2020</option>
                        <option value="2019" <?php echo date('Y') == '2019' ? 'selected' : '' ?>>2019</option>
                        <option value="2018" <?php echo date('Y') == '2018' ? 'selected' : '' ?>>2018</option>
                        <option value="2017" <?php echo date('Y') == '2017' ? 'selected' : '' ?>>2017</option>
                        <option value="2016" <?php echo date('Y') == '2016' ? 'selected' : '' ?>>2016</option>
                        <option value="2015" <?php echo date('Y') == '2015' ? 'selected' : '' ?>>2015</option>
                        <option value="2014" <?php echo date('Y') == '2014' ? 'selected' : '' ?>>2014</option>
                        <option value="2013" <?php echo date('Y') == '2013' ? 'selected' : '' ?>>2013</option>
                        <option value="2012" <?php echo date('Y') == '2012' ? 'selected' : '' ?>>2012</option>
                        <option value="2011" <?php echo date('Y') == '2011' ? 'selected' : '' ?>>2011</option>
                        <option value="2019" <?php echo date('Y') == '2019' ? 'selected' : '' ?>>2019</option>
                        <option value="2010" <?php echo date('Y') == '2010' ? 'selected' : '' ?>>2010</option>
                     </select>

                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="hr-payroll_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-payroll" role="grid">
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
                              <?php $sn = 1;
                              foreach (Employee::find_by_undeleted() as $value) :
                                 $empLoan = LongTermLoan::find_by_employee_id($value->id);
                                 $salary_advance = SalaryAdvance::find_by_employee_id($value->id);
                                 $salary = intval($value->present_salary);
                                 $commitment = isset($empLoan->commitment) ? $empLoan->commitment : '0.00';
                                 $take_home = intval($salary) - (intval($commitment) + intval($salary_advance->total_requested));

                              ?>
                                 <tr>
                                    <td class="bg-white"><?php echo $sn++; ?></td>
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
                                    <td><?php echo number_format($commitment) ?></td>
                                    <td class="font-weight-semibold"><?php echo number_format($take_home) ?></td>
                                    <td><span class="badge badge-danger">Unpaid</span></td>
                                    <td class="text-start bg-white">
                                       <a href="#" class="action-btns" id="get_salary" data-id="<?php echo $value->id ?>" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a>
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
      const PAYROLL_URL = "./inc/salary_data.php";

      const generateSlip = document.getElementById("generate_payslip");
      const getSalary = document.getElementById("get_salary");

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

      $('tbody').on('click', '#get_salary', async function() {
         let empId = this.dataset.id;
         let data = await fetch(PAYROLL_URL + '?empId=' + empId + '&salary_data')
         let res = await data.text();

         $('#salary_data').html(res);
      })

      // getSalary.addEventListener("click", async (e) => {
      //    e.preventDefault();
      //    let data = await fetch(SETTING_URL + '?generate')
      //    let res = await data.json();
      //    console.log(res.message);
      //    console.log(e);
      // });
   })
</script>