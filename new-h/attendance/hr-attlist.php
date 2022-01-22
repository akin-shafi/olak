<?php
require_once('../private/initialize.php');

$page = 'Attendance';
$page_title = 'Attendance List';
include(SHARED_PATH . '/header.php');

?>
<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Attendance</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list"> 
            <a href="<?php echo url_for('attendance/hr-attmark.php') ?>" class="btn btn-primary me-3">Mark Attendance</a> 
            <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>


<div class="hrattview-buttons"> <a href="#" class="active ms-5">Attendance Overview</a> <a href="<?php echo url_for('attendance/hr-attuser.php') ?>" class="">Attendance By User</a> </div>
<div class="row">
   <div class="col-xl-12 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="row mt-5">
               <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                     <label class="form-label">Employee Name:</label> 
                     <select class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Employee" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-37-7xkd">
                        <option label="Select Employee" data-select2-id="select2-data-39-ncyx"></option>
                        <option value="1">Faith Harris</option>
                        <option value="2">Austin Bell</option>
                        <option value="3">Maria Bower</option>
                        <option value="4">Peter Hill</option>
                        <option value="5">Victoria Lyman</option>
                        <option value="6">Adam Quinn</option>
                        <option value="7">Melanie Coleman</option>
                        <option value="8">Max Wilson</option>
                        <option value="9">Amelia Russell</option>
                        <option value="10">Justin Metcalfe</option>
                        <option value="11">Ryan Young</option>
                        <option value="12">Jennifer Hardacre</option>
                        <option value="13">Justin Parr</option>
                        <option value="14">Julia Hodges</option>
                        <option value="15">Michael Sutherland</option>
                     </select>
                     
                  </div>
               </div>
               <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                     <label class="form-label">Month:</label> 
                     <select class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Month" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-53-0b88">
                        <option label="Select Month" data-select2-id="select2-data-55-moyh"></option>
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
               <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                     <label class="form-label">Year:</label> 
                     <select class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Year" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-73-czd0">
                        <option label="Select Year" data-select2-id="select2-data-75-ehux"></option>
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
               <div class="col-md-6 col-lg-3">
                  <div class="form-group mt-5"> <a href="#" class="btn btn-primary btn-block">Search</a> </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="d-flex mb-6 mt-5">
               <div class="me-3"> <label class="form-label">Note:</label> </div>
               <div> <span class="badge badge-success-light me-2"><i class="feather feather-check-circle text-success"></i> ---&gt; Present</span> <span class="badge badge-danger-light me-2"><i class="feather feather-x-circle text-danger"></i> ---&gt; Absent</span> <span class="badge badge-warning-light me-2"><i class="fa fa-star text-warning"></i> ---&gt; Holiday</span> <span class="badge badge-orange-light me-2"><i class="fa fa-adjust text-orange"></i> ---&gt; Half Day</span> </div>
            </div>
            <div class="table-responsive hr-attlist">
               <div id="hr-attendance_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  <div class="row">
                     <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="hr-attendance_length">
                           <label>
                              Show 
                              <select name="hr-attendance_length" aria-controls="hr-attendance" class="form-select form-select-sm">
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
                        <div id="hr-attendance_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="hr-attendance"></label></div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-attendance" role="grid" aria-describedby="hr-attendance_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 reorder sorting sorting_asc" tabindex="0" aria-controls="hr-attendance" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Employee Name: activate to sort column descending" style="width: 165.021px;">Employee Name</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="1" style="width: 14.5px;">1</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="2" style="width: 14.5px;">2</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="3" style="width: 13.4583px;">3</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="4" style="width: 14.5px;">4</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="5" style="width: 14.5px;">5</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="6" style="width: 14.5px;">6</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="7" style="width: 14.5px;">7</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="8" style="width: 14.5px;">8</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="9" style="width: 14.5px;">9</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="10" style="width: 16.0833px;">10</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="11" style="width: 16.0833px;">11</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="12" style="width: 16.0833px;">12</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="13" style="width: 16.0833px;">13</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="14" style="width: 16.0833px;">14</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="15" style="width: 16.0833px;">15</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="16" style="width: 16.0833px;">16</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="17" style="width: 16.0833px;">17</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="18" style="width: 16.0833px;">18</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="19" style="width: 16.0833px;">19</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="20" style="width: 16.0833px;">20</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="21" style="width: 16.0833px;">21</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="22" style="width: 16.0833px;">22</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="23" style="width: 16.0833px;">23</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="24" style="width: 16.0833px;">24</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="25" style="width: 16.0833px;">25</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="26" style="width: 16.0833px;">26</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="27" style="width: 16.0833px;">27</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="28" style="width: 16.0833px;">28</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="29" style="width: 16.0833px;">29</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="30" style="width: 16.0833px;">30</th>
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="31" style="width: 16.0833px;">31</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Total" style="width: 44.6042px;">Total</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td class="reorder sorting_1">
                                    <div class="d-flex">
                                       <span class="avatar avatar brround me-3" style="background-image: url(../../assets/images/users/11.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-2 d-block">
                                          <h6 class="mb-1 fs-14">Adam Quinn</h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Republic Day" aria-label="Republic Day"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <h6 class="mb-0"> <span class="text-primary">16</span> <span class="my-auto fs-8 font-weight-normal text-muted">/</span> <span class="">31</span> </h6>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td class="reorder sorting_1">
                                    <div class="d-flex">
                                       <span class="avatar avatar brround me-3" style="background-image: url(../../assets/images/users/5.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-2 d-block">
                                          <h6 class="mb-1 fs-14">Amelia Russell</h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#halfpresentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Republic Day" aria-label="Republic Day"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <h6 class="mb-0"> <span class="text-primary">24</span> <span class="my-auto fs-8 font-weight-normal text-muted">/</span> <span class="">31</span> </h6>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td class="reorder sorting_1">
                                    <div class="d-flex">
                                       <span class="avatar avatar brround me-3" style="background-image: url(../../assets/images/users/9.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-2 d-block">
                                          <h6 class="mb-1 fs-14">Austin Bell</h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#halfpresentmodal" class="hr-listmodal"></a> <span class="fa fa-adjust text-orange"></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#halfpresentmodal" class="hr-listmodal"></a> <span class="fa fa-adjust text-orange"></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#halfpresentmodal" class="hr-listmodal"></a> <span class="fa fa-adjust text-orange"></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Republic Day" aria-label="Republic Day"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <h6 class="mb-0"> <span class="text-primary">24</span> <span class="my-auto fs-8 font-weight-normal text-muted">/</span> <span class="">31</span> </h6>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td class="reorder sorting_1">
                                    <div class="d-flex">
                                       <span class="avatar avatar brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-2 d-block">
                                          <h6 class="mb-1 fs-14">Faith Harris</h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning " data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#halfpresentmodal" class="hr-listmodal"></a> <span class="fa fa-adjust text-orange "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning " data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="feather feather-x-circle text-danger "></span></td>
                                 <td><span class="feather feather-x-circle text-danger "></span></td>
                                 <td><span class="feather feather-x-circle text-danger "></span></td>
                                 <td><span class="feather feather-x-circle text-danger "></span></td>
                                 <td><span class="fa fa-star text-warning " data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning " data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Republic Day" aria-label="Republic Day"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <h6 class="mb-0"> <span class="text-primary">21</span> <span class="my-auto fs-8 font-weight-normal text-muted">/</span> <span class="">31</span> </h6>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td class="reorder sorting_1">
                                    <div class="d-flex">
                                       <span class="avatar avatar brround me-3" style="background-image: url(../../assets/images/users/2.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-2 d-block">
                                          <h6 class="mb-1 fs-14">Maria Bower</h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#halfpresentmodal" class="hr-listmodal"></a> <span class="fa fa-adjust text-orange"></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Republic Day" aria-label="Republic Day"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <h6 class="mb-0"> <span class="text-primary">17</span> <span class="my-auto fs-8 font-weight-normal text-muted">/</span> <span class="">31</span> </h6>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td class="reorder sorting_1">
                                    <div class="d-flex">
                                       <span class="avatar avatar brround me-3" style="background-image: url(../../assets/images/users/12.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-2 d-block">
                                          <h6 class="mb-1 fs-14">Max Wilson</h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#halfpresentmodal" class="hr-listmodal"></a> <span class="fa fa-adjust text-orange "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Republic Day" aria-label="Republic Day"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <h6 class="mb-0"> <span class="text-primary">21</span> <span class="my-auto fs-8 font-weight-normal text-muted">/</span> <span class="">31</span> </h6>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td class="reorder sorting_1">
                                    <div class="d-flex">
                                       <span class="avatar avatar brround me-3" style="background-image: url(../../assets/images/users/4.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-2 d-block">
                                          <h6 class="mb-1 fs-14">Melanie Coleman</h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#halfpresentmodal" class="hr-listmodal"></a> <span class="fa fa-adjust text-orange"></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td><span class="feather feather-x-circle text-danger"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <h6 class="mb-0"> <span class="text-primary">23</span> <span class="my-auto fs-8 font-weight-normal text-muted">/</span> <span class="">31</span> </h6>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td class="reorder sorting_1">
                                    <div class="d-flex">
                                       <span class="avatar avatar brround me-3" style="background-image: url(../../assets/images/users/10.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-2 d-block">
                                          <h6 class="mb-1 fs-14">Peter Hill</h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#halfpresentmodal" class="hr-listmodal"></a> <span class="fa fa-adjust text-orange"></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Republic Day" aria-label="Republic Day"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <h6 class="mb-0"> <span class="text-primary">25</span> <span class="my-auto fs-8 font-weight-normal text-muted">/</span> <span class="">31</span> </h6>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td class="reorder sorting_1">
                                    <div class="d-flex">
                                       <span class="avatar avatar brround me-3" style="background-image: url(../../assets/images/users/3.jpg)"></span> 
                                       <div class="me-3 mt-0 mt-sm-2 d-block">
                                          <h6 class="mb-1 fs-14">Victoria Lyman</h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sunday" aria-label="Sunday"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td><span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Republic Day" aria-label="Republic Day"></span></td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <div class="hr-listd"> <a href="#" data-bs-toggle="modal" data-bs-target="#presentmodal" class="hr-listmodal"></a> <span class="feather feather-check-circle text-success "></span> </div>
                                 </td>
                                 <td>
                                    <h6 class="mb-0"> <span class="text-primary">26</span> <span class="my-auto fs-8 font-weight-normal text-muted">/</span> <span class="">31</span> </h6>
                                 </td>
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

<?php include (SHARED_PATH . '/footer.php') ?>