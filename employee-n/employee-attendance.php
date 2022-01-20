<?php
require_once('private/initialize.php');

$page = 'Attendance';
$page_title = 'Attendance';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Attendance</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="d-flex">
            <div class="header-datepicker me-3">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <div class="input-group-text"> <i class="feather feather-calendar"></i> </div>
                  </div>
                  <input class="form-control fc-datepicker hasDatepicker" type="text" id="dp1642657679520"> 
               </div>
            </div>
         </div>
         <div class="d-lg-flex">
            <div class="btn-list"> <button class="btn btn-primary me-4" data-bs-toggle="modal" data-bs-target="#clockinmodal">Clock In</button> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xl-3 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="countdowntimer mt-0"> <span id="clocktimer2" class="border-0 style size_md" style="background: transparent; color: rgb(49, 62, 106); border-color: transparent;">06:48:38</span> <label class="form-label">Current Time</label> </div>
            <div class="btn-list text-center mt-5"> <a href="#" class="btn ripple btn-primary disabled">Clock in</a> <a href="#" class="btn ripple btn-primary">Clock Out</a> </div>
         </div>
      </div>
   </div>
   <div class="col-xl-9 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Days Overview This Month</h4>
         </div>
         <div class="card-body pt-0 pb-3">
            <div class="row mb-0 pb-0">
               <div class="col-md-6 col-xl-2 text-center py-5">
                  <span class="avatar avatar-md bradius fs-20 bg-primary-transparent">31</span> 
                  <h5 class="mb-0 mt-3">Total Working Days</h5>
               </div>
               <div class="col-md-6 col-xl-2 text-center py-5 ">
                  <span class="avatar avatar-md bradius fs-20 bg-success-transparent">24</span> 
                  <h5 class="mb-0 mt-3">Present Days</h5>
               </div>
               <div class="col-md-6 col-xl-2 text-center py-5">
                  <span class="avatar avatar-md bradius fs-20 bg-danger-transparent">2</span> 
                  <h5 class="mb-0 mt-3">Absent Days</h5>
               </div>
               <div class="col-md-6 col-xl-2 text-center py-5">
                  <span class="avatar avatar-md bradius fs-20 bg-warning-transparent">0</span> 
                  <h5 class="mb-0 mt-3">Half Days</h5>
               </div>
               <div class="col-md-6 col-xl-2 text-center py-5 ">
                  <span class="avatar avatar-md bradius fs-20 bg-orange-transparent">2</span> 
                  <h5 class="mb-0 mt-3">Late Days</h5>
               </div>
               <div class="col-md-6 col-xl-2 text-center py-5">
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
         <div class="card-header  border-0">
            <h4 class="card-title">Attendance Overview</h4>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-12 col-lg-12 col-xl-5">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">From:</label> 
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <div class="input-group-text"> <i class="feather feather-calendar"></i> </div>
                              </div>
                              <input class="form-control fc-datepicker hasDatepicker" placeholder="19 Feb 2020" type="text" id="dp1642657679521"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">To:</label> 
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <div class="input-group-text"> <i class="feather feather-calendar"></i> </div>
                              </div>
                              <input class="form-control fc-datepicker hasDatepicker" placeholder="19 Feb 2020" type="text" id="dp1642657679522"> 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 col-lg-12 col-xl-3">
                  <div class="form-group">
                     <label class="form-label">Month:</label> 
                     <select name="attendance" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Month" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-22-kdi9">
                        <option label="Select Month" data-select2-id="select2-data-24-4518"></option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                     </select>
                    
                  </div>
               </div>
               <div class="col-md-12 col-lg-12 col-xl-3">
                  <div class="form-group">
                     <label class="form-label">Year:</label> 
                     <select name="attendance" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Year" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-42-fk9t">
                        <option label="Select Year" data-select2-id="select2-data-44-a6o4"></option>
                        <option value="1">2024</option>
                        <option value="2">2023</option>
                        <option value="3">2022</option>
                        <option value="4">2021</option>
                        <option value="5">2020</option>
                        <option value="6">2019</option>
                        <option value="7">2018</option>
                        <option value="8">2017</option>
                        <option value="9">2016</option>
                        <option value="10">2015</option>
                        <option value="11">2014</option>
                        <option value="12">2013</option>
                        <option value="13">2012</option>
                        <option value="14">2011</option>
                        <option value="15">2019</option>
                        <option value="16">2010</option>
                     </select>
                     
                  </div>
               </div>
               <div class="col-md-12 col-lg-12 col-xl-1">
                  <div class="form-group mt-5"> <a href="#" class="btn btn-primary btn-block">Search</a> </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="emp-attendance_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer"  role="grid" aria-describedby="emp-attendance_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 sorting sorting_desc" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-sort="descending" aria-label="Date: activate to sort column ascending" style="width: 207.292px;">Date</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 195.729px;">Status</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Clock-In: activate to sort column ascending" style="width: 182.458px;">Clock-In</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Clock-Out: activate to sort column ascending" style="width: 190.521px;">Clock-Out</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Progress: activate to sort column ascending" style="width: 175.854px;">Progress</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Hours: activate to sort column ascending" style="width: 228.812px;">Hours</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td class="sorting_1">20-01-2021</td>
                                 <td><span class="badge badge-success">Present</span></td>
                                 <td>09:35 AM</td>
                                 <td>06:55 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td>09h :10 mins</td>
                              </tr>
                              <tr class="even">
                                 <td class="sorting_1">19-01-2021</td>
                                 <td><span class="badge badge-success">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td>09h :00 mins</td>
                              </tr>
                              <tr class="odd">
                                 <td class="sorting_1">18-01-2021</td>
                                 <td><span class="badge badge-danger">Absent</span></td>
                                 <td>00:00 AM</td>
                                 <td>00:00 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar w-100"></div>
                                    </div>
                                 </td>
                                 <td>00h :00 mins</td>
                              </tr>
                              <tr class="even">
                                 <td class="sorting_1">17-01-2021</td>
                                 <td><span class="badge badge-success">Present</span></td>
                                 <td>9:30 AM</td>
                                 <td>6:55 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td>09h :20 mins</td>
                              </tr>
                              <tr class="odd">
                                 <td class="sorting_1">16-01-2021</td>
                                 <td><span class="badge badge-warning">Late</span></td>
                                 <td>10:30 AM</td>
                                 <td>6:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm">
                                       <div class="progress-bar bg-success w-80"></div>
                                       <div class="progress-bar bg-yellow w-20"></div>
                                    </div>
                                 </td>
                                 <td>08h :00 mins</td>
                              </tr>
                              <tr class="even">
                                 <td class="sorting_1">15-01-2021</td>
                                 <td><span class="badge badge-success">Present</span></td>
                                 <td>9:30 AM</td>
                                 <td>6:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td>09h :00 mins</td>
                              </tr>
                              <tr class="odd">
                                 <td class="sorting_1">14-01-2021</td>
                                 <td><span class="badge badge-warning">Late</span></td>
                                 <td>11:30 AM</td>
                                 <td>6:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm">
                                       <div class="progress-bar bg-success w-60"></div>
                                       <div class="progress-bar bg-yellow w-40"></div>
                                    </div>
                                 </td>
                                 <td>07h :00 mins</td>
                              </tr>
                              <tr class="even">
                                 <td class="sorting_1">13-01-2021</td>
                                 <td><span class="badge badge-success">Present</span></td>
                                 <td>9:35 AM</td>
                                 <td>6:35 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td>09h :05 mins</td>
                              </tr>
                              <tr class="odd">
                                 <td class="sorting_1">12-01-2021</td>
                                 <td><span class="badge badge-success">Present</span></td>
                                 <td>9:30 AM</td>
                                 <td>6:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td>09h :00 mins</td>
                              </tr>
                              <tr class="even">
                                 <td class="sorting_1">11-01-2021</td>
                                 <td><span class="badge badge-danger">Absent</span></td>
                                 <td>00:00 AM</td>
                                 <td>00:00 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar  w-100"></div>
                                    </div>
                                 </td>
                                 <td>00h :00 mins</td>
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

<div class="modal fade" id="clockinmodal">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title"><span class="feather feather-clock  me-1"></span>Clock In</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
         </div>
         <div class="modal-body">
            <div class="countdowntimer"> <span id="clocktimer" class="border-0 style size_md" style="background: transparent; color: rgb(49, 62, 106); border-color: transparent;">06:51:04</span> <label class="form-label">Current Time</label> </div>
            <div class="form-group"> <label class="form-label">IP Address</label> <input type="text" class="form-control" placeholder="225.192.145.1" disabled=""> </div>
            <div class="form-group">
               <label class="form-label">Working Form</label> 
               <select name="projects" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-49-y4c1">
                  <option label="Select" data-select2-id="select2-data-51-2d41"></option>
                  <option value="1">Office</option>
                  <option value="2">Home</option>
                  <option value="3">Others</option>
               </select>
               <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-50-jokd" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-projects-jw-container"><span class="select2-selection__rendered" id="select2-projects-jw-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> 
            </div>
            <div class="form-group"> <label class="form-label">Note:</label> <textarea class="form-control" rows="3">Some text here...</textarea> </div>
         </div>
         <div class="modal-footer"> <button class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button> <button class="btn btn-primary">Clock In</button> </div>
      </div>
   </div>
</div>


<?php include (SHARED_PATH . '/footer.php') ?>
<script src="<?php echo url_for('assets/js/employee/emp-attendance.js') ?>"></script>



