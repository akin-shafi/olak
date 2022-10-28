<?php
require_once('../private/initialize.php');

$page = 'Blank';
$page_title = 'Blank';
include(SHARED_PATH . '/header.php');

?>


<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Attendance View</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list"> <a href="<?php echo url_for('attendance/hr-attmark.php') ?>" class="btn btn-primary me-3">Mark Attendance</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Days Overview This Month</h4>
         </div>
         <div class="card-body pt-0 pb-3">
            <div class="row mb-0 pb-0">
               <div class="col-md-6 col-lg-2 text-center py-5">
                  <span class="avatar avatar-md bradius fs-20 bg-primary-transparent">31</span> 
                  <h5 class="mb-0 mt-3">Total Working Days</h5>
               </div>
               <div class="col-md-6 col-lg-2 text-center py-5 ">
                  <span class="avatar avatar-md bradius fs-20 bg-success-transparent">24</span> 
                  <h5 class="mb-0 mt-3">Present Days</h5>
               </div>
               <div class="col-md-6 col-lg-2 text-center py-5">
                  <span class="avatar avatar-md bradius fs-20 bg-danger-transparent">2</span> 
                  <h5 class="mb-0 mt-3">Absent Days</h5>
               </div>
               <div class="col-md-6 col-lg-2 text-center py-5">
                  <span class="avatar avatar-md bradius fs-20 bg-warning-transparent">0</span> 
                  <h5 class="mb-0 mt-3">Half Days</h5>
               </div>
               <div class="col-md-6 col-lg-2 text-center py-5 ">
                  <span class="avatar avatar-md bradius fs-20 bg-orange-transparent">2</span> 
                  <h5 class="mb-0 mt-3">Late Days</h5>
               </div>
               <div class="col-md-6 col-lg-2 text-center py-5">
                  <span class="avatar avatar-md bradius fs-20 bg-pink-transparent">5</span> 
                  <h5 class="mb-0 mt-3">Holidays</h5>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xl-12 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="row">
               <div class="col-md-12 col-lg-3">
                  <div class="form-group">
                     <label class="form-label">Select Date:</label> 
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text"> <i class="feather feather-calendar"></i> </div>
                        </div>
                        <input class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYYY" type="text" id="dp1642542745125"> 
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="hr-checkall"> <label class="custom-control custom-checkbox mb-0"> <input type="checkbox" class="custom-control-input" id="checkAll"> <span class="custom-control-label">Check All</span> </label> </div>
               </div>
            </div>
            <div class="table-responsive">
               <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  <div class="row">
                     <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="hr-table_length">
                           <label>
                              Show 
                              <select name="hr-table_length" aria-controls="hr-table" class="form-select form-select-sm">
                                 <option value="10">10</option>
                                 <option value="25">25</option>
                                 <option value="50">50</option>
                                 <option value="100">100</option>
                              </select>
                              entries
                           </label>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6">
                        <div id="hr-table_filter" class="dataTables_filter"><label><input type="search" class="form-control form-control-sm" placeholder="Search..." aria-controls="hr-table"></label></div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-table" role="grid" aria-describedby="hr-table_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 w-5 sorting sorting_asc" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#Emp ID: activate to sort column descending" style="width: 52.8958px;">#Emp ID</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Emp Name: activate to sort column ascending" style="width: 250.75px;">Emp Name</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 108.854px;">Status</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Clock In: activate to sort column ascending" style="width: 95.5px;">Clock In</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Clock Out: activate to sort column ascending" style="width: 97.7292px;">Clock Out</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="IP Address: activate to sort column ascending" style="width: 125.833px;">IP Address</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Working From: activate to sort column ascending" style="width: 134.25px;">Working From</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Attendance: activate to sort column ascending" style="width: 132.812px;">Attendance</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 122.042px;">Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td class="sorting_1">#0245</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/13.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Justin Metcalfe</h6>
                                          <p class="text-muted mb-0 fs-12">Web Designer</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>10:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>225.192.45.1</td>
                                 <td>Office</td>
                                 <td><span class="badge badge-success">Marked</span></td>
                                 <td>
                                    <div class="d-flex"> <label class="custom-control custom-checkbox-md"> <input type="checkbox" class="custom-control-input-success" name="example-checkbox1" value="option1" checked=""> <span class="custom-control-label-md success"></span> </label> <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#presentmodal1"> <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td class="sorting_1">#1025</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/3.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Victoria Lyman</h6>
                                          <p class="text-muted mb-0 fs-12">General Manager</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>225.192.45.1</td>
                                 <td>Office</td>
                                 <td><span class="badge badge-success">Marked</span></td>
                                 <td>
                                    <div class="d-flex"> <label class="custom-control custom-checkbox-md"> <input type="checkbox" class="custom-control-input-success" name="example-checkbox1" value="option1" checked=""> <span class="custom-control-label-md success"></span> </label> <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </div>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td class="sorting_1">#2098</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/10.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Peter Hill</h6>
                                          <p class="text-muted mb-0 fs-12">Testor</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td><span class="badge badge-warning-light">Half Day</span></td>
                                 <td>09:30 AM</td>
                                 <td>01:30 PM</td>
                                 <td>225.192.45.1</td>
                                 <td>Office</td>
                                 <td><span class="badge badge-danger">Not Marked</span></td>
                                 <td>
                                    <div class="d-flex"> <label class="custom-control custom-checkbox-md"> <input type="checkbox" class="custom-control-input-success" name="example-checkbox1" value="option1"> <span class="custom-control-label-md success"></span> </label> <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#halfpresentmodal"> <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td class="sorting_1">#2987</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Faith Harris</h6>
                                          <p class="text-muted mb-0 fs-12">Web Designer</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>225.192.45.1</td>
                                 <td>Office</td>
                                 <td><span class="badge badge-success">Marked</span></td>
                                 <td>
                                    <div class="d-flex"> <label class="custom-control custom-checkbox-md"> <input type="checkbox" class="custom-control-input-success" name="example-checkbox1" value="option1" checked=""> <span class="custom-control-label-md success"></span> </label> <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </div>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td class="sorting_1">#3262</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/11.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Adam Quinn</h6>
                                          <p class="text-muted mb-0 fs-12">Accountant</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>225.192.45.1</td>
                                 <td>Office</td>
                                 <td><span class="badge badge-success">Marked</span></td>
                                 <td>
                                    <div class="d-flex"> <label class="custom-control custom-checkbox-md"> <input type="checkbox" class="custom-control-input-success" name="example-checkbox1" value="option1" checked=""> <span class="custom-control-label-md success"></span> </label> <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td class="sorting_1">#3489</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/4.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Melanie Coleman</h6>
                                          <p class="text-muted mb-0 fs-12">App Designer</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>225.192.45.1</td>
                                 <td>Office</td>
                                 <td><span class="badge badge-success">Marked</span></td>
                                 <td>
                                    <div class="d-flex"> <label class="custom-control custom-checkbox-md"> <input type="checkbox" class="custom-control-input-success" name="example-checkbox1" value="option1" checked=""> <span class="custom-control-label-md success"></span> </label> <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </div>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td class="sorting_1">#3698</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/12.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Max Wilson</h6>
                                          <p class="text-muted mb-0 fs-12">PHP Developer</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td><span class="badge badge-orange-light">Late</span></td>
                                 <td>10:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>225.192.45.1</td>
                                 <td>Office</td>
                                 <td><span class="badge badge-danger">Not Marked</span></td>
                                 <td>
                                    <div class="d-flex"> <label class="custom-control custom-checkbox-md"> <input type="checkbox" class="custom-control-input-success" name="example-checkbox1" value="option1"> <span class="custom-control-label-md success"></span> </label> <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#presentmodal1"> <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td class="sorting_1">#4987</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/9.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Austin Bell</h6>
                                          <p class="text-muted mb-0 fs-12">Angular Developer</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td><span class="badge badge-danger-light">Absent</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>225.192.45.2</td>
                                 <td>Office</td>
                                 <td><span class="badge badge-danger">Not Marked</span></td>
                                 <td>
                                    <div class="d-flex"> <label class="custom-control custom-checkbox-md"> <input type="checkbox" class="custom-control-input-success" name="example-checkbox1" value="option1"> <span class="custom-control-label-md success"></span> </label> <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#presentmodal1"> <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </div>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td class="sorting_1">#5612</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/5.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Amelia Russell</h6>
                                          <p class="text-muted mb-0 fs-12">UX Designer</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>10:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>225.192.45.1</td>
                                 <td>Office</td>
                                 <td><span class="badge badge-success">Marked</span></td>
                                 <td>
                                    <div class="d-flex"> <label class="custom-control custom-checkbox-md"> <input type="checkbox" class="custom-control-input-success" name="example-checkbox1" value="option1" checked=""> <span class="custom-control-label-md success"></span> </label> <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#presentmodal1"> <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td class="sorting_1">#6729</td>
                                 <td>
                                    <div class="d-flex">
                                       <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/2.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-1 d-block">
                                          <h6 class="mb-1 fs-14">Maria Bower</h6>
                                          <p class="text-muted mb-0 fs-12">Marketing analyst</p>
                                       </div>
                                    </div>
                                 </td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>225.192.45.1</td>
                                 <td>Office</td>
                                 <td><span class="badge badge-success">Marked</span></td>
                                 <td>
                                    <div class="d-flex"> <label class="custom-control custom-checkbox-md"> <input type="checkbox" class="custom-control-input-success" name="example-checkbox1" value="option1" checked=""> <span class="custom-control-label-md success"></span> </label> <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="hr-table_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div>
                     </div>
                     <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="hr-table_paginate">
                           <ul class="pagination">
                              <li class="paginate_button page-item previous disabled" id="hr-table_previous"><a href="#" aria-controls="hr-table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                              <li class="paginate_button page-item active"><a href="#" aria-controls="hr-table" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                              <li class="paginate_button page-item next disabled" id="hr-table_next"><a href="#" aria-controls="hr-table" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer"> <a href="#" class="btn btn-primary float-end">Save All</a> </div>
      </div>
   </div>
</div>

<?php include (SHARED_PATH . '/footer.php') ?>