<?php
require_once('../private/initialize.php');

$page = 'Attendance';
$page_title = 'Attendance List';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Attendance By User</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list"> <a href="hr-attmark.html" class="btn btn-primary me-3">Mark Attendance</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<!-- End Row --->
<div class="hrattview-buttons"> <a href="<?php echo url_for('attendance/hr-attlist.php') ?>" class="ms-5">Attendance Overview</a> <a href="#" class="active ">Attendance By User</a> </div>
<div class="row">
   <div class="col-xl-12 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-body">
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
            <div class="row mt-5">
               <div class="col-md-12 col-lg-5">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Employee Name:</label> 
                           <select class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Employee" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-37-b0ke">
                              <option label="Select Employee"></option>
                              <option value="1" selected="" data-select2-id="select2-data-39-h1fl">Faith Harris</option>
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
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Select Date:</label> 
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <div class="input-group-text"> <i class="feather feather-calendar"></i> </div>
                              </div>
                              <input class="form-control fc-datepicker hasDatepicker" placeholder="DD-MM-YYYY" type="text" id="dp1642572288335"> 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 col-lg-5">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Month:</label> 
                           <select class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Month" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-53-vhz5">
                              <option label="Select Month"></option>
                              <option value="1" selected="" data-select2-id="select2-data-55-qt4j">January</option>
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
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="form-label">Year:</label> 
                           <select name="attendance" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Year" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-73-c183">
                              <option label="Select Year"></option>
                              <option value="1">2024</option>
                              <option value="2">2023</option>
                              <option value="3">2022</option>
                              <option value="4" selected="" data-select2-id="select2-data-75-r7ut">2021</option>
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
                  </div>
               </div>
               <div class="col-md-12 col-lg-2">
                  <div class="form-group mt-5"> <a href="#" class="btn btn-primary btn-block">Search</a> </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="emp-attendance_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="emp-attendance" role="grid" aria-describedby="emp-attendance_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 180.917px;">Date</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Day: activate to sort column ascending" style="width: 183.521px;">Day</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 332.271px;">Status</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Clock In: activate to sort column ascending" style="width: 158.75px;">Clock In</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Clock Out: activate to sort column ascending" style="width: 162.042px;">Clock Out</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Progress" style="width: 152.854px;">Progress</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 120.979px;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td>28-01-2021</td>
                                 <td>Thursday</td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td> <a class="btn btn-light btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>27-01-2021</td>
                                 <td>Wednesday</td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td> <a class="btn btn-light btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>26-01-2021</td>
                                 <td>Tuesday</td>
                                 <td><span class="badge badge-pink-light">Holiday (Republic Day)</span></td>
                                 <td>--</td>
                                 <td>--</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar w-100"></div>
                                    </div>
                                 </td>
                                 <td> <a class="btn btn-light btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>25-01-2021</td>
                                 <td>Monday</td>
                                 <td><span class="badge badge-orange-light">Late</span></td>
                                 <td>09:50 AM</td>
                                 <td>06:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm">
                                       <div class="progress-bar bg-success w-80"></div>
                                       <div class="progress-bar bg-orange w-20"></div>
                                    </div>
                                 </td>
                                 <td> <a class="btn btn-light btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>24-01-2021</td>
                                 <td>Sunday</td>
                                 <td><span class="badge badge-pink-light">Holiday (Sunday)</span></td>
                                 <td>--</td>
                                 <td>--</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar"></div>
                                    </div>
                                 </td>
                                 <td> <a class="btn btn-light btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>23-01-2021</td>
                                 <td>Saturday</td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td> <a class="btn btn-light btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>22-01-2021</td>
                                 <td>Friday</td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td> <a class="btn btn-light btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>21-01-2021</td>
                                 <td>Thursday</td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td> <a class="btn btn-light btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>20-01-2021</td>
                                 <td>Wednesday</td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td> <a class="btn btn-light btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </td>
                              </tr>
                              <tr class="even">
                                 <td>19-01-2021</td>
                                 <td>Tuesday</td>
                                 <td><span class="badge badge-success-light">Present</span></td>
                                 <td>09:30 AM</td>
                                 <td>06:30 PM</td>
                                 <td>
                                    <div class="progress progress-sm d-block">
                                       <div class="progress-bar bg-success w-100"></div>
                                    </div>
                                 </td>
                                 <td> <a class="btn btn-light btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#presentmodal"> <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""></i> </a> </td>
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

<script type="text/javascript">
   $(function(e){

      // //________ DataTable
      // var table = $('#hr-attendance').DataTable( {
      //    rowReorder: true,
      //    columnDefs: [
      //       { orderable: true, className: 'reorder', targets: 0 },
      //       { orderable: false, targets: '_all' }
      //    ]
      // } );
      

      // //________ DataTable
      // $('#emp-attendance').DataTable({
      //    "order": [[ 0, "asec" ]],
      //    order: [],
      //    columnDefs: [ { orderable: false, targets: [5, 6] } ],
      //    language: {
      //       searchPlaceholder: 'Search...',
      //       sSearch: '',
            
      //    }
      // });

      //________ Timepicker
      $('.timepicker').timepicker({
         showInputs: false,
      });
      
      //________ Datepicker
      $( ".fc-datepicker" ).datepicker({
         dateFormat: "dd MM yy",
         monthNamesShort: [ "Jan", "Feb", "Mar", "Apr", "Maj", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec" ]
      });
      $('.fc-datepicker').datepicker('setDate', 'today');

      //______Select2
      $('.select2').select2({
         minimumResultsForSearch: Infinity,
         width: '100%'
      });
      
    });
</script>