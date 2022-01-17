<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payroll Items';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Employee Salary</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list mt-3 mt-lg-0"> <a href="<?php echo url_for('payroll/hr-addpayroll.php') ?>" class="btn btn-primary me-3">Add New Payroll</a> 
         	<button class="btn btn-secondary me-3" data-bs-toggle="modal" data-bs-target="#excelmodal"> <i class="las la-file-excel"></i> Download Monthly Excel Report </button> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
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
                        <option value="1" data-select2-id="select2-data-68-qxxj">Faith Harris</option>
                        <option value="2" data-select2-id="select2-data-69-4h6e">Austin Bell</option>
                        <option value="3" data-select2-id="select2-data-70-n21p">Maria Bower</option>
                        <option value="4" data-select2-id="select2-data-71-ud4x">Peter Hill</option>
                        <option value="5" data-select2-id="select2-data-72-bsgz">Victoria Lyman</option>
                        <option value="6" data-select2-id="select2-data-73-7491">Adam Quinn</option>
                        <option value="7" data-select2-id="select2-data-74-jipj">Melanie Coleman</option>
                        <option value="8" data-select2-id="select2-data-75-xx3l">Max Wilson</option>
                        <option value="9" data-select2-id="select2-data-76-vdk3">Amelia Russell</option>
                        <option value="10" data-select2-id="select2-data-77-3m24">Justin Metcalfe</option>
                        <option value="11" data-select2-id="select2-data-78-n5lu">Ryan Young</option>
                        <option value="12" data-select2-id="select2-data-79-v0s5">Jennifer Hardacre</option>
                        <option value="13" data-select2-id="select2-data-80-qste">Justin Parr</option>
                        <option value="14" data-select2-id="select2-data-81-v041">Julia Hodges</option>
                        <option value="15" data-select2-id="select2-data-82-osf2">Michael Sutherland</option>
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
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-payroll" role="grid" aria-describedby="hr-payroll_xxinfo">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 w-5 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="#Emp ID: activate to sort column ascending" style="width: 52.8993px;">#Emp ID</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="Emp Name: activate to sort column ascending" style="width: 174.41px;">Emp Name</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="Month-Year: activate to sort column ascending" style="width: 104.08px;">Month-Year</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="Designation: activate to sort column ascending" style="width: 114.653px;">Designation</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="($) Salary: activate to sort column ascending" style="width: 61.6146px;">($) Salary</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="Generated Date: activate to sort column ascending" style="width: 98.3854px;">Generated Date</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-payroll" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 63.0382px;">Status</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 260.503px;">Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td>#2987</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Faith Harris</h6>
                                          <p class="text-muted mb-0 fs-12">faith@gmail.com</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td>January-2021</td>
                                 <td>Web Designer</td>
                                 <td class="font-weight-semibold">$32,000</td>
                                 <td>01-02-2021</td>
                                 <td><span class="badge badge-success">Paid</span></td>
                                 <td class="text-start"> <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Share"> <i class="feather feather-share-2 text-warning"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-x text-danger"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>#4987</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/9.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Austin Bell</h6>
                                          <p class="text-muted mb-0 fs-12">austin@gmail.com</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td>December-2020</td>
                                 <td>Angular Developer</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-01-2021</td>
                                 <td><span class="badge badge-success">Paid</span></td>
                                 <td class="text-start"> <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Share"> <i class="feather feather-share-2 text-warning"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-x text-danger"></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>#6729</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/2.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Maria Bower</h6>
                                          <p class="text-muted mb-0 fs-12">maria@gmail.com</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td>November-2020</td>
                                 <td>Marketing analyst</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-12-2020</td>
                                 <td><span class="badge badge-danger">UnPaid</span></td>
                                 <td class="text-start"> <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Share"> <i class="feather feather-share-2 text-warning"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-x text-danger"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>#2098</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/10.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Peter Hill</h6>
                                          <p class="text-muted mb-0 fs-12">peter@gmail.com</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td>October-2020</td>
                                 <td>Testor</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-11-2020</td>
                                 <td><span class="badge badge-success">Paid</span></td>
                                 <td class="text-start"> <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Share"> <i class="feather feather-share-2 text-warning"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-x text-danger"></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>#1025</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/3.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Victoria Lyman</h6>
                                          <p class="text-muted mb-0 fs-12">victoria@gmail.com</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td>September-2020</td>
                                 <td>General Manager</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-10-2020</td>
                                 <td><span class="badge badge-success">Paid</span></td>
                                 <td class="text-start"> <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Share"> <i class="feather feather-share-2 text-warning"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-x text-danger"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>#3262</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/11.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Adam Quinn</h6>
                                          <p class="text-muted mb-0 fs-12">adam@gmail.com</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td>August-2020</td>
                                 <td>Accountant</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-09-2020</td>
                                 <td><span class="badge badge-success">Paid</span></td>
                                 <td class="text-start"> <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Share"> <i class="feather feather-share-2 text-warning"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-x text-danger"></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>#1025</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/4.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Melanie Coleman</h6>
                                          <p class="text-muted mb-0 fs-12">victoria@gmail.com</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td>July-2020</td>
                                 <td>App Designer</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>02-08-2020</td>
                                 <td><span class="badge badge-success">Paid</span></td>
                                 <td class="text-start"> <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Share"> <i class="feather feather-share-2 text-warning"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-x text-danger"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>#3698</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/12.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Max Wilson</h6>
                                          <p class="text-muted mb-0 fs-12">max@gmail.com</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td>June-2020</td>
                                 <td>PHP Developer</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>02-08-2020</td>
                                 <td><span class="badge badge-danger">UnPaid</span></td>
                                 <td class="text-start"> <a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> <a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Download"> <i class="feather feather-download  text-secondary"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" onclick="javascript:window.print();" data-bs-original-title="Print"> <i class="feather feather-printer text-success"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Share"> <i class="feather feather-share-2 text-warning"></i> </a> <a href="#" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-x text-danger"></i> </a> </td>
                              </tr>
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