<?php
require_once('../private/initialize.php');

$page = 'Holiday';
$page_title = 'Holiday';
include(SHARED_PATH . '/header.php');

?>
<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Holidays</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list"> <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#holidaymodal">Add Holiday</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12 col-lg-8">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Holidays Lists</h4>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="hr-holiday_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  <div class="row">
                     <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="hr-holiday_length">
                           <label>
                              Show 
                              <select name="hr-holiday_length" aria-controls="hr-holiday" class="form-select form-select-sm">
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
                        <div id="hr-holiday_filter" class="dataTables_filter"><label><input type="search" class="form-control form-control-sm" placeholder="Search..." aria-controls="hr-holiday"></label></div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-holiday" role="grid" aria-describedby="hr-holiday_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 w-5 sorting" tabindex="0" aria-controls="hr-holiday" rowspan="1" colspan="1" aria-label="No: activate to sort column ascending" style="width: 24px;">No</th>
                                 <th class="border-bottom-0 w-5 sorting" tabindex="0" aria-controls="hr-holiday" rowspan="1" colspan="1" aria-label="Day: activate to sort column ascending" style="width: 71.9167px;">Day</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-holiday" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 181.604px;">Date</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-holiday" rowspan="1" colspan="1" aria-label="Holidays: activate to sort column ascending" style="width: 375.104px;">Holidays</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 171.375px;">Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td>01</td>
                                 <td>Thursday</td>
                                 <td>14-01-2021</td>
                                 <td class="font-weight-semibold">Pongal Holiday</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#holidaymodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                              </tr>
                              <tr class="even">
                                 <td>02</td>
                                 <td>Thuesday</td>
                                 <td>26-01-2021</td>
                                 <td class="font-weight-semibold">Republic Holiday</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#holidaymodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>03</td>
                                 <td>Thursday</td>
                                 <td>11-03-2021</td>
                                 <td class="font-weight-semibold">Mahashivratri Holiday</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#holidaymodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                              </tr>
                              <tr class="even">
                                 <td>04</td>
                                 <td>Monday</td>
                                 <td>29-03-2021</td>
                                 <td class="font-weight-semibold">Holi Holiday</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#holidaymodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>05</td>
                                 <td>Tuesday</td>
                                 <td>13-04-2021</td>
                                 <td class="font-weight-semibold">Ugadi Holiday</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#holidaymodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                              </tr>
                              <tr class="even">
                                 <td>06</td>
                                 <td>Wednesday</td>
                                 <td>14-04-2021</td>
                                 <td class="font-weight-semibold">Ambedkar Jayanti Holiday</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#holidaymodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>07</td>
                                 <td>Sunday</td>
                                 <td>15-08-2021</td>
                                 <td class="font-weight-semibold">Independence Day Holiday</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#holidaymodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                              </tr>
                              <tr class="even">
                                 <td>08</td>
                                 <td>Friday</td>
                                 <td>10-09-2021</td>
                                 <td class="font-weight-semibold">Ganesh Chaturthi Holiday</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#holidaymodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                              </tr>
                              <tr class="odd">
                                 <td>09</td>
                                 <td>Friday</td>
                                 <td>02-10-2021</td>
                                 <td class="font-weight-semibold">Gandhi Jayanti Holiday</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#holidaymodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                              </tr>
                              <tr class="even">
                                 <td>10</td>
                                 <td>Friday</td>
                                 <td>14-10-2021</td>
                                 <td class="font-weight-semibold">Dussehra Holiday</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#holidaymodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="hr-holiday_info" role="status" aria-live="polite">Showing 1 to 10 of 12 entries</div>
                     </div>
                     <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="hr-holiday_paginate">
                           <ul class="pagination">
                              <li class="paginate_button page-item previous disabled" id="hr-holiday_previous"><a href="#" aria-controls="hr-holiday" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                              <li class="paginate_button page-item active"><a href="#" aria-controls="hr-holiday" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                              <li class="paginate_button page-item "><a href="#" aria-controls="hr-holiday" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                              <li class="paginate_button page-item next" id="hr-holiday_next"><a href="#" aria-controls="hr-holiday" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12 col-lg-4">
      <div class="card">
         <div class="card-body">
            <div class="holiday-calender">
               <div id="calendar1" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="holidaymodal">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add Holidays</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label class="form-label">Select Date</label> 
               <div class="input-group">
                  <div class="input-group-prepend">
                     <div class="input-group-text"> <i class="feather feather-calendar"></i> </div>
                  </div>
                  <input class="form-control" data-bs-toggle="modaldatepicker" placeholder="MM/DD/YYYY"> 
               </div>
            </div>
            <div class="form-group"> <label class="form-label">Enter Occasion</label> <input class="form-control" placeholder="occasion title"> </div>
         </div>
         <div class="modal-footer"> <button class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button> <button class="btn btn-primary">Add</button> </div>
      </div>
   </div>
</div>


<?php include (SHARED_PATH . '/footer.php') ?>

<script src="<?php echo url_for('assets/plugins/fullcalendar/fullcalendar.min.js') ?>"></script>

<script type="text/javascript">
	$(function(e){

		//________ Datepicker
		$( '.fc-datepicker').datepicker({
			dateFormat: "dd MM yy",
			zIndex: 1,
		});


		//________ Datepicker
		$( '[data-bs-toggle="modaldatepicker"]').datepicker({
			autoHide: true,
			// zIndex: 999998,
			zIndex: 200000,
		});

		//________ Data Table
		$('#hr-holiday').DataTable({
			"order": [[ 0, "desc" ]],
			order: [],
			columnDefs: [ { orderable: false, targets: [4] } ],
			language: {
				searchPlaceholder: 'Search...',
				sSearch: '',
				
			}
		});
		

		//________ Select2
		$('.select2').select2({
			minimumResultsForSearch: Infinity,
			width:'100%'
		});

	});

	/*---- Full Calendar -----*/
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar1');
		var calendar = new FullCalendar.Calendar(calendarEl, {
		   headerToolbar: {
			left: 'prev',
			center: 'title',
			right: 'next'
		  },
		  navLinks: true, // can click day/week names to navigate views
		  businessHours: true, // display business hours
		  editable: true,
		  selectable: true,
		  selectMirror: true,
		  droppable: true, // this allows things to be dropped onto the calendar
		  drop: function(arg) {
			// is the "remove after drop" checkbox checked?
			if (document.getElementById('drop-remove').checked) {
			  // if so, remove the element from the "Draggable Events" list
			  arg.draggedEl.parentNode.removeChild(arg.draggedEl);
			}
		  },
		  select: function(arg) {
			var title = prompt('Event Title:');
			if (title) {
			  calendar.addEvent({
				title: title,
				start: arg.start,
				end: arg.end,
				allDay: arg.allDay
			  })
			}
			calendar.unselect()
		  },
		  eventClick: function(arg) {
			if (confirm('Are you sure you want to delete this event?')) {
			  arg.event.remove()
			}
		  },
		  editable: true,
		  dayMaxEvents: true, // allow "more" link when too many events
		  eventRender: function (event, element) {
			debugger;
			if ((event.description).toString() == "Halfday"){
				element.find(".fc-event-time").after($("<span class=\"fc-event-icons\"></span>").html("<i class='fe fe-view'></i> "));
			}
		  },
		  events: [
			{
				title: 'Pongal',
				start: '2021-01-14',
				color:'rgba(255, 173, 0, 0.1)',
			},
			{
				title: 'Republic',
				start: '2021-01-26',
				color:'rgba(255, 173, 0, 0.1)',
			},
		  ]
		});
		calendar.render();
	});	
</script>