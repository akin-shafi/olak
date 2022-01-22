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
         <div class="btn-list mt-3 mt-lg-0"> <button type="button" class="btn btn-primary me-3" id="generate_payslip">Add Item</button>
            

             <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
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
						                  <th>Category</th>
						                  <th>Default/Unit Amount</th>
						                  <th class="text-end">Action</th>
						               </tr>
						            </thead>
						            <tbody>
						               <tr>
						                  <th>Leave balance amount</th>
						                  <td>Monthly remuneration</td>
						                  <td>$5</td>
						                  <td class="text-end">
						                     <div class="dropdown dropdown-action">
						                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
						                        <div class="dropdown-menu dropdown-menu-right">
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_addition"><i class="fa fa-pencil m-r-5"></i> Edit</a>
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_addition"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
						                        </div>
						                     </div>
						                  </td>
						               </tr>
						               <tr>
						                  <th>Arrears of salary</th>
						                  <td>Additional remuneration</td>
						                  <td>$8</td>
						                  <td class="text-end">
						                     <div class="dropdown dropdown-action">
						                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
						                        <div class="dropdown-menu dropdown-menu-right">
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_addition"><i class="fa fa-pencil m-r-5"></i> Edit</a>
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_addition"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
						                        </div>
						                     </div>
						                  </td>
						               </tr>
						               <tr>
						                  <th>Gratuity</th>
						                  <td>Monthly remuneration</td>
						                  <td>$20</td>
						                  <td class="text-end">
						                     <div class="dropdown dropdown-action">
						                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
						                        <div class="dropdown-menu dropdown-menu-right">
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_addition"><i class="fa fa-pencil m-r-5"></i> Edit</a>
						                           <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_addition"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
						                        </div>
						                     </div>
						                  </td>
						               </tr>
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
							               <th>Default/Unit Amount</th>
							               <th class="text-end">Action</th>
							            </tr>
							         </thead>
							         <tbody>
							            <tr>
							               <th>Absent amount</th>
							               <td>$12</td>
							               <td class="text-end">
							                  <div class="dropdown dropdown-action">
							                     <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
							                     <div class="dropdown-menu dropdown-menu-right">
							                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_deduction"><i class="fa fa-pencil m-r-5"></i> Edit</a>
							                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_deduction"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
							                     </div>
							                  </div>
							               </td>
							            </tr>
							            <tr>
							               <th>Advance</th>
							               <td>$7</td>
							               <td class="text-end">
							                  <div class="dropdown dropdown-action">
							                     <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
							                     <div class="dropdown-menu dropdown-menu-right">
							                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_deduction"><i class="fa fa-pencil m-r-5"></i> Edit</a>
							                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_deduction"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
							                     </div>
							                  </div>
							               </td>
							            </tr>
							            <tr>
							               <th>Unpaid leave</th>
							               <td>$3</td>
							               <td class="text-end">
							                  <div class="dropdown dropdown-action">
							                     <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
							                     <div class="dropdown-menu dropdown-menu-right">
							                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_deduction"><i class="fa fa-pencil m-r-5"></i> Edit</a>
							                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_deduction"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
							                     </div>
							                  </div>
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
	</div>
</div>




<!-- <div class="modal fade in" data-easein="flipYIn" id="addModal" style="display: block; padding-left: 0px;" aria-hidden="false">
   <div class="modal-dialog modal-lg modal-dialog-top" role="document" style="opacity: 1; display: block;">
      <div class="modal-content">
         <div class="modal-header d-flex justify-content-between">
            <h3 class="modal-title" id="exampleModalCenterTitle">New Category </h3>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
         </div>
         <center id="errors"></center>
         <form class="form-group" method="post" id="itemForm">
            <input type="hidden" name="created_by" value="1">
            <div class="modal-body">
               <div class="table-responsive">
                  <span id="error"></span>
                  <table class="table table-sm table-borderless">
                     <thead>
                        <tr class="fs-12">
                           <th class="fs-12">SN.</th>
                           <th>Category:</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="items">
                        <tr>
                           <td>1.</td>
                           <td>
                              <input type="text" name="category[]" id="category1" class="form-control category" placeholder="Enter Category">
                           </td>
                           <td><span class="btn" id="add"><i class="fa fa-plus text-success"></i></span></td>
                        </tr>
                        <tr id="row_id2">
                           <td><span id="sr_no">2.</span></td>
                           <td><input type="text" name="category[]" id="category2" data-srno="2" class="form-control category" placeholder="Enter Category"></td>
                           <td><span class="btn remove" id="2"><i class="fa fa-minus text-danger bold fs-22"></i></span></td>
                        </tr>
                     </tbody>
                  </table>
                  Total: <b class="text-danger total_item">2 items</b> 
                  <input type="hidden" name="total_item" id="item_amt" value="2">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary " id="btnAdd">Add</button>
               <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Cancel</button>
            </div>
         </form>
      </div>
   </div>
</div> -->

<?php include(SHARED_PATH . '/footer.php'); ?>
<!-- <script type="text/javascript">
	addMultipleFormInput();
	function addMultipleFormInput(){


	   var final_total_amount = $('#final_total_amount').text();
	      // console.log(final_total_amount)
	      
	      var count = 1;
	      $(document).on('click', '#add', function() {
	        count = count + 1;

	        if (count <= 1) {
	          $('.total_item').text(count + ' item');
	          $('#item_amt').val(count);
	        } else {
	          $('.total_item').text(count + ' items');
	          $('#item_amt').val(count);
	        }

	        var html_code = '';
	        html_code += '<tr id="row_id' + count + '">';
	        html_code += '<td><span id="sr_no">'+count+'.</span></td>';
	        html_code += '<td><input type="text"  name="category[]" id="category' + count + '" data-srno="' + count + '" class="form-control category" placeholder="Enter Category"></td>';
	        

	        html_code += '<td><span class="btn remove" id="' + count + '"><i class="fa fa-minus text-danger bold fs-22"></i></span></td>';

	        $('#items').append(html_code);

	      });


	      // Remove Item

	      $(document).on('click', '.remove', function() {
	          var row_id = $(this).attr('id');	          
	          $('#row_id' + row_id).remove();
	          count = count - 1;
	          if (count <= 1) {
	            $('.total_item').text(count + ' item');
	            // $('#item_amt').val(count);
	          } else { 
	            $('.total_item').text(count + ' items');
	             // $('#item_amt').val(count);
	          }
	      });


	      $(document).on('click', '#btnAdd', function(e) {
	        e.preventDefault();
	        var error = '';
	        $('.category').each(function() {
	          var count = 1;
	          if ($(this).val() == '') {
	            $('.category').removeClass('suc');
	            $('.category').addClass('err');
	            error += 'Enter item type at row ' + count + '. ';
	            return false;
	          } else {
	            $('.category').removeClass('err');
	            $('.category').addClass('suc');
	            return true;
	          }
	          count = count + 1;
	      });
	      

	      // var formData = $(this).serialize();
	      if (error == '') {
	        
	        $.ajax({
	          url: 'category/inc/addItem.php',
	          method: 'POST',
	          data: $('#itemForm').serialize(),
	          dataType: 'json',
	          success: function(r) {
	            if (r.msg == 'OK') {
	              $("#addModal").modal("hide");
	              $("#itemForm")[0].reset();
	              successAlert("Invoice raised successfully.")
	              window.location.href = eUrl
	            }else{
	                errorAlert("Error: Something went wrong.")
	            }
	          }
	        });
	      } else {
	          errorAlert("TO CONTINUE PLEASE, FILL ALL THE NECCESSARY FIELDS.");
	      }



	    });
	     
	   
	}

	$(document).on("click", ".editItem", function(){
	  $("#editModal").modal("show");
	    var eid = $(this).data('id');
	    $.ajax({
	            url: 'category/inc/fetch_form.php',
	            method: 'post',
	            data: {
	              stockForm: 1,
	              id: eid,
	            },
	            success: function(r) {
	              $("#fetchForm").html(r)       
	            }
	    });
	})

	// Edit Stock
	
	$(document).on("click", ".deleteItem", function(){
	  // $("#editModal").modal("show");
	    var eid = $(this).data('id');
	    $.ajax({
	            url: 'category/inc/category_crud.php',
	            method: 'post',
	            data: {
	              delete: 1,
	              id: eid,
	            },
	            dataType: 'json',
	            success: function(r) {
	              if (r.msg == 'OK') {
	                successTime("Deleted Succesfully");
	                window.location.href = eUrl
	              }else{
	                errorAlert(r.msg)
	              }         
	            }
	    });
	})
</script> -->





