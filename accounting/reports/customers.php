<?php 
	require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Designation';
include(SHARED_PATH . '/admin_header.php'); 
?>

 <div class="content-wrapper">
       <section class="content">
           <div class="container">
               <div class="row">
                   <div class="col-md-12">
                       <h2 class="mb-25">Income by Customer <a href="#" class="btn btn-default btn-rounded print pull-right"><i class="fa fa-print"></i> Print </a></h2>

                       
                       <form method="GET" class="sort_report_form validate-form" action="http://accufy.originlabsoft.com/admin/reports/customers">
                           <div class="reprt-box">
                             <div class="row pl-15">
                         
                                 <div class="col-md-4 col-xs-12 pl-0 mb-5 mt-5">
                                     <select class="form-control single_select" name="customer">
                                         <option value="">All Customers</option>
                                                                           </select>
                                 </div>

                                 <div class="col-md-2 col-xs-12 pl-0 mb-5 mt-5">
                                     <div class="input-group">
                                         <input type="text" class="inv-dpick form-control datepicker" placeholder="From" name="start" value="2021-01-01" autocomplete="off">
                                         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                     </div>
                                     <small>Start date</small>
                                 </div>

                                 <div class="col-md-2 col-xs-12 pl-0 mb-5 mt-5">
                                     <div class="input-group">
                                         <input type="text" class="inv-dpick form-control datepicker" placeholder="To" name="end" value="2021-12-17" autocomplete="off">
                                         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                     </div>
                                     <small>End date</small>
                                 </div>
                         
                                 <div class="col-md-4 col-xs-12 pr-20 mb-5 mt-5 text-right">
                                     <button type="submit" class="btn btn-info btn-report"><i class="fa fa-search"></i> Show Report</button>
                                 </div>
                             </div>

                           </div>
                       </form>
                   </div>
               </div>
                 
               <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-50 p-0 print_area">
                 <table class="table table-hover">
                     <thead class="bg-light">
                         <tr>
                             <th>Customers</th>
                             <th class="text-right">All Income</th>
                             <th class="text-right">Paid Income</th>
                         </tr>
                     </thead>

                     <tbody>
                                           
                                           
                       <thead>
                           <tr>
                               <th class="">Total Income</th>
                               <th class="text-right bbt-1 fs-20">NGN 0.00</th>
                               <th class="text-right bbt-1 fs-20">NGN 0.00</th>
                           </tr>
                       </thead>
                     </tbody>

                 </table>
               </div>
              
           </div>
       </section>
   </div>

<?php include(SHARED_PATH . '/admin_footer.php');  ?> 
