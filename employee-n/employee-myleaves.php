<?php
require_once('private/initialize.php');

$page = 'My Leaves';
$page_title = 'My Leaves';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">My Leaves</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
         <div class="btn-list"> <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#applyleaves">Apply Leaves</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xl-9 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Leaves Summary</h4>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="emp-attendance_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" role="grid" aria-describedby="emp-attendance_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 text-center sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 21.5208px;">#ID</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Leave Type: activate to sort column ascending" style="width: 89.3125px;">Leave Type</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="From: activate to sort column ascending" style="width: 70.625px;">From</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="TO: activate to sort column ascending" style="width: 70.625px;">TO</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Days: activate to sort column ascending" style="width: 76.3125px;">Days</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Reason: activate to sort column ascending" style="width: 146.542px;">Reason</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Applied On: activate to sort column ascending" style="width: 70.625px;">Applied On</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 75.0417px;">Status</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 120px;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td class="text-center">1</td>
                                 <td>Casual Leave</td>
                                 <td>16-01-2021</td>
                                 <td>16-01-2021</td>
                                 <td class="font-weight-semibold">1 Day</td>
                                 <td>Personal</td>
                                 <td>05-01-2021</td>
                                 <td> <span class="badge badge-primary">New</span> </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td class="text-center">2</td>
                                 <td>Sick Leave</td>
                                 <td>14-01-2021</td>
                                 <td>15-01-2021</td>
                                 <td class="font-weight-semibold">2 Days</td>
                                 <td>Going to Hospital</td>
                                 <td>13-01-2021</td>
                                 <td> <span class="badge badge-success">Approved</span> </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td class="text-center">3</td>
                                 <td>Casual Leave</td>
                                 <td>21-01-2021</td>
                                 <td>27-01-2021</td>
                                 <td class="font-weight-semibold">7 Days</td>
                                 <td>Going to Family Trip</td>
                                 <td>11-01-2021</td>
                                 <td> <span class="badge badge-warning">Pending</span> </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td class="text-center">4</td>
                                 <td>Casual Leave</td>
                                 <td>05-01-2021</td>
                                 <td>05-01-2021</td>
                                 <td class="font-weight-semibold">1 Days</td>
                                 <td>Personal</td>
                                 <td>12-12-2020</td>
                                 <td> <span class="badge badge-success">Approved</span> </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td class="text-center">5</td>
                                 <td>Medical Leave</td>
                                 <td>22-01-2021</td>
                                 <td>22-01-2021</td>
                                 <td class="font-weight-semibold">1 Days</td>
                                 <td>Take Rest</td>
                                 <td>21-01-2021</td>
                                 <td> <span class="badge badge-success">Approved</span> </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td class="text-center">6</td>
                                 <td>Casual Leave</td>
                                 <td>18-01-2021</td>
                                 <td>19-01-2021</td>
                                 <td class="font-weight-semibold">2 Days</td>
                                 <td>Going to my Hometown</td>
                                 <td>10-01-2021</td>
                                 <td> <span class="badge badge-warning">Pending</span> </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td class="text-center">7</td>
                                 <td>Casual Leave</td>
                                 <td>11-01-2021</td>
                                 <td>11-01-2021</td>
                                 <td class="font-weight-semibold">1st Half Day</td>
                                 <td>Going to Hosiptal</td>
                                 <td>11-01-2021</td>
                                 <td> <span class="badge badge-danger">Rejected</span> </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td class="text-center">8</td>
                                 <td>Medical Leave</td>
                                 <td>09-01-2021</td>
                                 <td>09-01-2021</td>
                                 <td class="font-weight-semibold">1 Days</td>
                                 <td>Going to Hosiptal</td>
                                 <td>08-01-2021</td>
                                 <td> <span class="badge badge-success">Approved</span> </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td class="text-center">9</td>
                                 <td>Casual Leave</td>
                                 <td>08-01-2021</td>
                                 <td>07-01-2021</td>
                                 <td class="font-weight-semibold">2 Days</td>
                                 <td>Personal</td>
                                 <td>25-12-2020</td>
                                 <td> <span class="badge badge-success">Approved</span> </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td class="text-center">10</td>
                                 <td>Casual Leave</td>
                                 <td>21-12-2020</td>
                                 <td>21-12-2020</td>
                                 <td class="font-weight-semibold">1 Days</td>
                                 <td>Personal</td>
                                 <td>19-12-2020</td>
                                 <td> <span class="badge badge-danger">Rejected</span> </td>
                                 <td class="text-start d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal"> <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="view" aria-label="view"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <i class="feather feather-trash-2 text-danger"></i> </a> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#reportmodal"> <i class="feather feather-info text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report" aria-label="Report"></i> </a> </td>
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
   <div class="col-xl-3 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Leaves Overview</h4>
         </div>
         <div class="card-body">
            <div id="leavesoverview" class="mx-auto pt-2" style="min-height: 278.341px;">
               
            </div>
            <div class="row pt-7 pb-5  mx-auto text-center">
               <div class="col-md-7 mx-auto d-block">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label bg-primary me-2 my-auto"></span>Casual Leaves </div>
                     </div>
                     <div class="col-md-12 mt-3">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label badge-danger me-2 my-auto"></span>Sick Leaves </div>
                     </div>
                     <div class="col-md-12 mt-3">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label bg-secondary me-2 my-auto"></span>Gifted Leaves </div>
                     </div>
                     <div class="col-md-12 mt-3">
                        <div class="d-flex font-weight-semibold"> <span class="dot-label bg-success me-2 my-auto"></span>Remaining Leaves </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="resize-triggers">
               <div class="expand-trigger">
                  <div style="width: 346px; height: 528px;"></div>
               </div>
               <div class="contract-trigger"></div>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="leaveapplictionmodal" style="display: none;" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">My Leave Application</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
         </div>
         <div class="modal-body">
            <div class="table-responsive">
               <table class="table mb-0">
                  <tbody>
                     <tr>
                        <td class="font-weight-semibold">Leave Type </td>
                        <td>:</td>
                        <td>Casual Leave</td>
                     </tr>
                     <tr>
                        <td class="font-weight-semibold">Date</td>
                        <td>:</td>
                        <td>16-01-2021</td>
                     </tr>
                     <tr>
                        <td class="font-weight-semibold">Days</td>
                        <td>:</td>
                        <td>1 day</td>
                     </tr>
                     <tr>
                        <td class="font-weight-semibold">Reason</td>
                        <td>:</td>
                        <td>Personal</td>
                     </tr>
                     <tr>
                        <td class="font-weight-semibold">Applied On</td>
                        <td>:</td>
                        <td>05-01-2021</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer"> <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Close</a> </div>
      </div>
   </div>
</div>
<div class="modal fade" id="reportmodal" style="display: none;" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Report</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
         </div>
         <div class="modal-body">
            <div class="form-group"> <label class="form-label">Email Address</label> <input type="text" class="form-control" placeholder="hr@gmail.com" value="" readonly=""> </div>
            <div class="form-group"> <label class="form-label">Subject</label> <textarea class="form-control" rows="3">Some text here...</textarea> </div>
         </div>
         <div class="modal-footer"> <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a> <a href="#" class="btn btn-primary">Submit</a> </div>
      </div>
   </div>
</div>
<div class="modal fade" id="applyleaves" style="display: none;" aria-hidden="true">
   <div class="modal-dialog" role="document" data-select2-id="select2-data-26-l5v6">
      <div class="modal-content" data-select2-id="select2-data-25-cvqx">
         <div class="modal-header">
            <h5 class="modal-title">Apply Leaves</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
         </div>
         <div class="modal-body">
            <div class="leave-types" data-select2-id="select2-data-24-j2g1">
               <div class="form-group" data-select2-id="select2-data-23-x4k4">
                  <label class="form-label">Leaves Dates</label> 
                  <select name="projects" class="form-control custom-select select2 " id="daterange-categories">
                     <option value="single" data-select2-id="select2-data-8-rpp1">Single Leaves</option>
                     <option value="multiple" data-select2-id="select2-data-29-tvho">Multiple Leaves</option>
                  </select>
                  
               </div>
               <div class="leave-content active" id="single" style="display: none;">
                  <div class="form-group">
                     <label class="form-label">Date Range:</label> 
                     <div class="input-group">
                        <input type="text" name="singledaterange" class="form-control" placeholder="select dates"> 
                        <div class="input-group-append">
                           <div class="input-group-text"> <i class="bx bx-calendar"></i> </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="leave-content" id="multiple" style="display: block;">
                  <div class="form-group">
                     <label class="form-label">Date Range:</label> 
                     <div class="input-group">
                        <input type="text" name="daterange" class="form-control" placeholder="select dates"> 
                        <div class="input-group-append">
                           <div class="input-group-text"> <i class="bx bx-calendar"></i> </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="form-label">Leaves Types</label> 
                  <select name="projects" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-18-k3qr">
                     <option label="select" data-select2-id="select2-data-20-0cct"></option>
                     <option value="1">Half Day Leave</option>
                     <option value="2">Casual Leaves</option>
                     <option value="3">Sick Leaves</option>
                     <option value="4">Maternity Leaves</option>
                     <option value="5">Paternity Leaves</option>
                     <option value="6">Annual Leaves</option>
                     <option value="6">Unpaid Leaves</option>
                     <option value="8">Other Leaves</option>
                  </select>
                  
               </div>
               <div class="form-group"> <label class="form-label">Reason:</label> <textarea class="form-control" rows="5">Some text here...</textarea> </div>
            </div>
         </div>
         <div class="modal-footer">
            <div class=""> <label class="mb-0 font-weight-semibold">Selected Days:</label> <span class="badge badge-danger badge-pill ms-2">2</span> </div>
            <div class="ms-auto"> <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a> <a href="#" class="btn btn-primary">Submit</a> </div>
         </div>
      </div>
   </div>
</div>



<?php include (SHARED_PATH . '/footer.php') ?>

<script src="<?php echo url_for('assets/js/employee/emp-myleaves.js') ?>"></script>
<script src="<?php echo url_for('assets/plugins/pg-calendar-master/pignose.calendar.full.min.js') ?>"></script>