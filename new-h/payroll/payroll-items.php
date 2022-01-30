<?php
require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payroll Settings';
include(SHARED_PATH . '/header.php');
$datatable = '';
$select2 = '';
?>


<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Payroll Items</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list mt-3 mt-lg-0"> <button type="button" class="btn btn-primary me-3" id="add_item">Add Item</button>
            

             <button class="d-none btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="d-none btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="d-none btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
         </div>
      </div>
   </div>
</div>


<div class="row">
   <div class="col-md-12">
		<div class="card">
		   <div class="card-header border-bottom-0">
		      <!-- <h3 class="card-title">Tabs Style 2</h3> -->
		   </div>
		   <div class="card-body">
		      <div class="panel panel-primary">
		         <div class=" tab-menu-heading p-0 bg-light">
		            <div class="tabs-menu1 ">
		               <!-- Tabs --> 
		               <ul class="nav panel-tabs">
		                  <li class=""><a href="#tab1" class="active" data-bs-toggle="tab">Addition</a></li>
		                  <li><a href="#tab2" data-bs-toggle="tab" class="">Overtime</a></li>
		                  <li><a href="#tab3" data-bs-toggle="tab" class="">Deduction</a></li>
		               </ul>
		            </div>
		         </div>
		         <div class="panel-body tabs-menu-body">
		            <div class="tab-content">
		               <div class="tab-pane active" id="tab1">
		                 <div class="tab-pane show active" id="tab_additions">
						   <div class="text-end mb-4 clearfix d-none">
						      <button class="btn btn-primary add-btn" type="button" data-bs-toggle="modal" data-bs-target="#add_addition"><i class="fa fa-plus"></i> Add Addition</button>
						   </div>
						   <div class="payroll-table card">
						      <div class="table-responsive">
						         <table class="table table-vcenter text-nowrap table-bordered border-bottom mt-5" id="" role="grid" aria-describedby="hr-payroll_xxinfo">
						            <thead>
						               <tr>
						                  <th>Name</th>
						                  <!-- <th>Category</th> -->
						                  <th>Default(Unit Amount/Percentage)</th>
						                  <th class="text-end">Action</th>
						               </tr>
						            </thead>
						            <tbody>
						            	<?php  
						            		foreach (PayrollItem::find_by_category(1) as $key => $value) { ?>
							               <tr>
							                  <th><?php echo $value->item; ?></th>
							                  <td><?php echo $value->amount ?></td>
							                  <td class="text-start"> 
							                  	

							                  	<a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> 

							                  	<a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-trash text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> 

							                  	
							                  </td>
							               </tr>
						               <?php 
						               	 } ?>
						               
						            </tbody>
						         </table>
						      </div>
						   </div>
						</div>

		               </div>

		               <!-- Tab 1 End -->
		               

					   	<div class="tab-pane " id="tab2">
						  
						   <div class="payroll-table card">
						      <div class="table-responsive">
						         <table class="table table-vcenter text-nowrap table-bordered border-bottom mt-5" role="grid" aria-describedby="hr-payroll_xxinfo">
						            <thead>
						               <tr>
						                  <th>Name</th>
						                  <th>Rate</th>
						                  <th class="text-end">Action</th>
						               </tr>
						            </thead>
						            <tbody>
						               <tr>
						                  <th>Normal day OT 1.5x</th>
						                  <td>Hourly 1.5</td>
						                  <td class="text-end">
						                     <div class="dropdown dropdown-action">
						                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
						                        <div class="dropdown-menu dropdown-menu-right">
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_overtime"><i class="fa fa-pencil m-r-5"></i> Edit</a>
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_overtime"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
						                        </div>
						                     </div>
						                  </td>
						               </tr>
						               <tr>
						                  <th>Public holiday OT 3.0x</th>
						                  <td>Hourly 3</td>
						                  <td class="text-end">
						                     <div class="dropdown dropdown-action">
						                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
						                        <div class="dropdown-menu dropdown-menu-right">
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_overtime"><i class="fa fa-pencil m-r-5"></i> Edit</a>
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_overtime"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
						                        </div>
						                     </div>
						                  </td>
						               </tr>
						               <tr>
						                  <th>Rest day OT 2.0x</th>
						                  <td>Hourly 2</td>
						                  <td class="text-end">
						                     <div class="dropdown dropdown-action">
						                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
						                        <div class="dropdown-menu dropdown-menu-right">
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_overtime"><i class="fa fa-pencil m-r-5"></i> Edit</a>
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_overtime"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
						                        </div>
						                     </div>
						                  </td>
						               </tr>
						            </tbody>
						         </table>
						      </div>
						   </div>
						</div>



		               <!-- Tab 2 End -->
		               <div class="tab-pane" id="tab3">
		                  	<div class="text-end mb-4 clearfix d-none">
						      <button class="btn btn-primary add-btn" type="button" data-bs-toggle="modal" data-bs-target="#add_addition"><i class="fa fa-plus"></i> Add Addition</button>
						   </div>
							<div class="payroll-table card">

							   <div class="table-responsive">
							      <table class="table table-vcenter text-nowrap table-bordered border-bottom mt-5" id="hr-payroll" role="grid" aria-describedby="hr-payroll_xxinfo">
							         <thead>
							            <tr>
							               <th>Name</th>
							               <th>Default(Unit Amount/Percentage)</th>
							               <th class="text-end">Action</th>
							            </tr>
							         </thead>
							         <tbody>
							            <?php  
						            		foreach (PayrollItem::find_by_category(3) as $key => $value) { ?>
							               <tr>
							                  <th><?php echo $value->item; ?></th>
							                  <td><?php echo $value->amount ?></td>
							                  <td class="text-start"> 
							                  	

							                  	<a href="hr-editpayroll.html" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"> <i class="feather feather-edit text-info"></i> </a> 

							                  	<a href="#" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal"> <i class="feather feather-trash text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"></i> </a> 

							                  	
							                  </td>
							               </tr>
						               <?php } ?>
							            
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
	</div>
</div>




<div id="add_addition" class="modal custom-modal fade" role="dialog" >
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add Addition</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="add_item_form">
            	<input type="hidden" name="addPayrollItem">
               <div class="form-group">
                  <label>Name <span class="text-danger">*</span></label>
                  <input class="form-control" type="text" name="item">
               </div>
               <div class="form-group">
                  <label>Category <span class="text-danger">*</span></label>
                  <select class="select form-control" name="category">
                     <option>Select a category</option>
                     <?php foreach (PayrollItem::PAYROLL_CATEGORY as $key => $value) : ?>
	                     <option value="<?php echo $key ?>"><?php echo $value ?></option>
	                  <?php endforeach ?>
                  </select>
                  
               </div>
               
               <div class="form-group">
                  <label>Unit Amount/Percentage</label>
                  <div class="input-group">
                     <span class="input-group-text"><?php echo $currency ?></span>
                     <input type="text" class="form-control" name="amount">
                     <span class="input-group-text">.00</span>
                  </div>
               </div>
               <!-- <div class="form-group d-none">
                  <label class="d-block">Assignee</label>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="addition_assignee" id="addition_no_emp" value="option1" checked="">
                     <label class="form-check-label" for="addition_no_emp">
                     No assignee
                     </label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="addition_assignee" id="addition_all_emp" value="option2">
                     <label class="form-check-label" for="addition_all_emp">
                     All employees
                     </label>
                  </div>
                  <div class="form-check form-check-inline d-none">
                     <input class="form-check-input" type="radio" name="addition_assignee" id="addition_single_emp" value="option3">
                     <label class="form-check-label" for="addition_single_emp">
                     Select Employee
                     </label>
                  </div>
                  <div class="form-group">
                     <select class="select form-control select2 d-none" name="employee_id">
                        <option data-select2-id="select2-data-6-3351">Select All</option>
                        <?php foreach (Employee::find_by_undeleted() as $key => $value) : ?>
	                        <option value="<?php echo $key ?>"><?php echo Employee::find_by_id($value->id)->full_name() ?></option>
	                     <?php endforeach ?>
                     </select>
                     
                  </div>
               </div> -->
               <div class="submit-section">
                  <button class="btn btn-primary submit-btn">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>

<script type="text/javascript">
	$(document).on('click', '#add_item', function() {
		$('#add_addition').modal('show')
	});

	$(document).on('submit', '#add_item_form', function(e) {
		e.preventDefault()
		$.ajax({
         url: '../inc/payroll/payroll_script.php',
         method:"POST",
         data: $(this).serialize(),
         dataType: 'json',
         success: function (data) {
             if (data.success == true) {
             	$('#add_addition').modal('hide')
                 successAlert(data.msg);
             }else{
                 errorAlert(data.msg);
             }
         }
     })
  })

  
</script>






