<?php 
	require_once('../private/initialize.php');

$page = 'Reports';
$page_title = 'General Report';
include(SHARED_PATH . '/admin_header.php'); 
?>
	<div class="content-wrapper">
       <section class="content">
           <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <h2>
                       <i class="flaticon-bar-chart"></i> Reports                    <span class="pull-right"></span>
                     </h2>
                     <form method="GET" class="sort_report_form validate-form" action="http://accufy.originlabsoft.com/admin/reports/generate">
                         <div class="reprt-box">
                           <div class="row mb-10 pl-15">
                               <div class="col-md-3 col-xs-12 mt-5 pl-0">
                                   <select class="form-control single_select report_types" required name="report_types">
                                       <option value="">Report Types</option>
                                       <option  value="1">Invoices</option>
                                       <option  value="2">Estimates</option>
                                       <option  value="3">Expenses</option>
                                   </select>
                               </div>

                               <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                   <div class="input-group">
                                       <input type="text" class="inv-dpick form-control datepicker" placeholder="From" name="start_date" value="" autocomplete="off">
                                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                   </div>
                               </div>

                               <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                   <div class="input-group">
                                       <input type="text" class="inv-dpick form-control datepicker" placeholder="To" name="end_date" value="" autocomplete="off">
                                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                   </div>
                               </div>
                           
                               <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                   <select class="form-control single_select" name="tax_info">
                                       <option value="">Tax Info</option>
                                       <option  value="0">All</option>
                                       <option  value="1">Including Tax</option>
                                       <option  value="2">Excluding Tax</option>
                                   </select>
                               </div>

                               <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                   <select class="form-control single_select income_items" name="status">
                                       <option value="0">All status</option>
                                       <option value="2"                                       >Paid</option>
                                       <option value="1"                                       >Unpaid</option>
                                   </select>
                               </div>

                               <div class="col-md-4 col-xs-12 mt-5 pl-0 expense_items" style="display: none;">
                                   <select class="form-control single_select" name="vendor">
                                       <option value="0">Vendors</option>
                                                                       </select>
                               </div>

                               <div class="col-md-4 col-xs-12 mt-5 pl-0 income_items" style="display: none;">
                                   <select class="form-control single_select" name="customer">
                                       <option value="0">All customers</option>
                                                                       </select>
                               </div>
                           </div>

                           <div class="col-md-12 col-xs-12 mt-15 pl-0">
                               <button type="submit" class="btn btn-info btn-report"><i class="fa fa-search"></i> Show Report</button>
                               <a href="http://accufy.originlabsoft.com/admin/reports" class="btn btn-default reset-report"><i class="flaticon-reload"></i> Reset Filter</a>
                           </div>
                         </div>
                     </form>
                 </div>



                                 <div class="col-md-12 text-center">
                       <div class="p-50 smshadow">
                           <h4 class="m-auto">No data founds</h4>
                       </div>
                   </div>
                 

        
                 
                 
             </div>
           </div>
       </section>
   </div>
<?php include(SHARED_PATH . '/admin_footer.php');  ?> 