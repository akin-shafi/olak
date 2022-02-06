<?php
require_once('../private/initialize.php');

$page = 'Expenses';
$page_title = 'Expenses';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>
<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Expenses</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
         <div class="btn-list"> <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#expensemodal">Add Expenses</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xl-12 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">My Expenses Summary</h4>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="emp-attendance_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" role="grid" aria-describedby="emp-attendance_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 52.5417px;">#ID</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending" style="width: 169.062px;">Title</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Purchase From: activate to sort column ascending" style="width: 192.5px;">Purchase From</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 119.979px;">Date</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Amount ($): activate to sort column ascending" style="width: 120.396px;">Amount ($)</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Paid By" style="width: 159.354px;">Paid By</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Aprroval Status: activate to sort column ascending" style="width: 158.458px;">Aprroval Status</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 133.708px;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td>#01</td>
                                 <td>Bike Services</td>
                                 <td>ABC Service Center</td>
                                 <td>01-10-2021</td>
                                 <td class="font-weight-semibold">$678</td>
                                 <td>Card</td>
                                 <td><span class="badge badge-success">Approved</span></td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View"> <i class="feather feather-eye  text-primary"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>#02</td>
                                 <td>Bike Services</td>
                                 <td>ABC Service Center</td>
                                 <td>01-10-2021</td>
                                 <td class="font-weight-semibold">$678</td>
                                 <td>Card</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="badge badge-danger">Rejected </span> 
                                       <div class="mt-1 ms-1"> <span class="feather feather-info" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Duplicated Invoice" aria-label="Duplicated Invoice"></span> </div>
                                    </div>
                                 </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View"> <i class="feather feather-eye  text-primary"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>#03</td>
                                 <td>Pens</td>
                                 <td>Books stationery</td>
                                 <td>11-12-2020</td>
                                 <td class="font-weight-semibold">$12</td>
                                 <td>Cash</td>
                                 <td><span class="badge badge-success">Approved</span></td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View"> <i class="feather feather-eye  text-primary"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>#04</td>
                                 <td>Mouse Pad</td>
                                 <td>Aamzon</td>
                                 <td>21-11-2020</td>
                                 <td class="font-weight-semibold">$45</td>
                                 <td>Online Payment</td>
                                 <td><span class="badge badge-warning">Pending</span></td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View"> <i class="feather feather-eye  text-primary"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>#05</td>
                                 <td>Data Connection</td>
                                 <td>PhonePe</td>
                                 <td>16-10-2020</td>
                                 <td class="font-weight-semibold">$599</td>
                                 <td>Online Payment</td>
                                 <td><span class="badge badge-success">Approved</span></td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View"> <i class="feather feather-eye  text-primary"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>#06</td>
                                 <td>Mobile Recharge</td>
                                 <td>PhonePe</td>
                                 <td>15-10-2020</td>
                                 <td class="font-weight-semibold">$100</td>
                                 <td>Online Payment</td>
                                 <td><span class="badge badge-success">Approved</span></td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View"> <i class="feather feather-eye  text-primary"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>#07</td>
                                 <td>Bike Fuel</td>
                                 <td>Petrol Bunk</td>
                                 <td>12-09-2020</td>
                                 <td class="font-weight-semibold">$220</td>
                                 <td>Card</td>
                                 <td><span class="badge badge-warning">Pending</span></td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View"> <i class="feather feather-eye  text-primary"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>#08</td>
                                 <td>Bike Fuel</td>
                                 <td>Petrol Bunk</td>
                                 <td>12-09-2020</td>
                                 <td class="font-weight-semibold">$220</td>
                                 <td>Card</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="badge badge-danger">Rejected </span> 
                                       <div class="mt-1 ms-1"> <span class="feather feather-info" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Duplicated Invoice" aria-label="Duplicated Invoice"></span> </div>
                                    </div>
                                 </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View"> <i class="feather feather-eye  text-primary"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> </td>
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

<div class="modal fade" id="expensemodal">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add Expense</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
         </div>
         <div class="modal-body">
            <div class="leave-types">
               <div class="form-group"> <label class="form-label">Title:</label> <input type="text" class="form-control" placeholder="text" value=""> </div>
               <div class="form-group"> <label class="form-label">Purchase Place:</label> <input type="text" class="form-control" placeholder="text" value=""> </div>
               <div class="form-group"> <label class="form-label">Price ($):</label> <input type="text" class="form-control" placeholder="$30" value=""> </div>
               <div class="form-group">
                  <label class="form-label">Date:</label> 
                  <div class="input-group">
                     <input type="text" name="singledaterange" class="form-control" placeholder="select dates"> 
                     <div class="input-group-append">
                        <div class="input-group-text"> <i class="bx bx-calendar"></i> </div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="form-label">Upload Invoice</div>
                  <div class="form-group"> <label for="form-label" class="form-label"></label> <input class="form-control" type="file"> </div>
               </div>
               <div class="form-group"> <label class="form-label">Note:</label> <textarea class="form-control" rows="3">Some text here...</textarea> </div>
            </div>
         </div>
         <div class="modal-footer">
            <div class="ms-auto"> <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a> <a href="#" class="btn btn-primary">Submit</a> </div>
         </div>
      </div>
   </div>
</div>


<?php include (SHARED_PATH . '/footer.php') ?>

<script src="<?php echo url_for('assets/js/employee/emp-expenses.js') ?>"></script>