<?php 
  require_once('../private/initialize.php');

$page = 'Dashboard';
$page_title = 'User Dashboard';
include(SHARED_PATH . '/admin_header.php'); 

?>
<div class="content-wrapper">
            <section class="content">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <h2 class="mb-25">Sales Tax Report <a href="#" class="btn btn-default btn-rounded print pull-right"><i class="fa fa-print"></i> Print </a></h2>
                        <form method="GET" class="sort_report_form validate-form" action="http://accufy.originlabsoft.com/admin/reports/sales_tax">
                           <div class="reprt-box">
                              <div class="row pl-15">
                                 <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                    <select class="form-control single_select report_type" required name="report_type">
                                       <option value="">Report Types</option>
                                       <option selected value="1">Paid & Unpaid</option>
                                       <option  value="2">Paid</option>
                                    </select>
                                 </div>
                                 <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                    <div class="input-group">
                                       <input type="text" class="inv-dpick form-control datepicker" placeholder="From" name="start" value="2021-01-01" autocomplete="off">
                                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <small>Start date</small>
                                 </div>
                                 <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                    <div class="input-group">
                                       <input type="text" class="inv-dpick form-control datepicker" placeholder="To" name="end" value="2021-12-17" autocomplete="off">
                                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <small>End date</small>
                                 </div>
                                 <div class="col-md-6 col-xs-12 mt-5 pl-0 text-right">
                                    <button type="submit" class="btn btn-info btn-report"><i class="fa fa-search"></i> Show Report</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-50 p-0 print_area">
                     <table class="table cushover table-hover">
                        <thead class="bg-pale-secondary">
                           <tr>
                              <th>Tax</th>
                              <th>Sales Product to tax</th>
                              <th>Tax Amount on Sales</th>
                              <th>Purchases Subject to Tax</th>
                              <th>Tax Amount on Purchases</th>
                              <th>Net Tax Owing</th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <thead class="bg-light">
                           <tr>
                              <th class="fs-20">Total</th>
                              <th></th>
                              <th class="fs-20">NGN 0.00</th>
                              <th></th>
                              <th class="fs-20">NGN 0.00</th>
                              <th class="fs-20">NGN 0.00</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
            </section>
         </div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>