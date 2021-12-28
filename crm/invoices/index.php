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
                        <h2>Invoices 
                           <a href="http://accufy.originlabsoft.com/admin/invoice/create" class="btn btn-info btn-rounded pull-right"><i class="fa fa-plus"></i> Create New Invoices</a>
                        </h2>
                        <form method="GET" class="sort_invoice_form" action="http://accufy.originlabsoft.com/admin/invoice/type/3">
                           <div class="row p-15 mt-20 mb-20">
                              <div class="col-md-4 col-xs-12 mt-5 pl-0">
                                 <select class="form-control single_select sort" name="customer">
                                    <option value="">All customers</option>
                                 </select>
                              </div>
                              <div class="col-md-3 col-xs-12 mt-5 pl-0">
                                 <select class="form-control single_select sort" name="status">
                                    <option value="" >All status</option>
                                    <option value="2"  >Paid</option>
                                    <option value="1"  >Unpaid</option>
                                    <option value="4"  >Draft</option>
                                    <option value="3"  >Sent</option>
                                 </select>
                              </div>
                              <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                 <div class="input-group">
                                    <input type="text" class="inv-dpick form-control datepicker" placeholder="From " name="start_date" value="" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                 </div>
                              </div>
                              <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                 <div class="input-group">
                                    <input type="text" class="inv-dpick form-control datepicker" placeholder="To " name="end_date" value="" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                 </div>
                              </div>
                              <div class="col-md-1 col-xs-12 mt-5 pl-0">
                                 <button type="submit" class="btn btn-info btn-report btn-block custom_search"><i class="flaticon-magnifying-glass"></i></button>
                              </div>
                           </div>
                        </form>
                        <ul class="nav nav-tabs custab" role="tablist">
                           <li class="nav-item"> <a class="nav-link active" href="http://accufy.originlabsoft.com/admin/invoice/type/1" role="tab" aria-selected="true"> <span class="hidden-xs-downs">Unpaid <span class="label-count">0</span></span></a> </li>
                           <li class="nav-item"> <a class="nav-link " href="http://accufy.originlabsoft.com/admin/invoice/type/0" role="tab" aria-selected="false"> <span class="hidden-xs-downs">Draft <span class="label-count">0</span></span></a> </li>
                           <li class="nav-item"> <a class="nav-link " href="http://accufy.originlabsoft.com/admin/invoice/type/3" role="tab" aria-selected="false"> <span class="hidden-xs-downs">All Invoices <span class="label-count">0</span></span></a> </li>
                           <li class="nav-item"> <a class="nav-link " href="http://accufy.originlabsoft.com/admin/invoice/type/3?recurring=1" role="tab" aria-selected="false"> <span class="hidden-xs-downs">Recurring Invoice <span class="label-count">0</span></span></a> </li>
                        </ul>
                        <div class="tab-content">
                           <!-- All -->
                           <div class="tab-pane active" id="messages2" role="tabpanel">
                              <div class="pt-30"><strong>No data founds</strong></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 text-center mt-50">
                     </div>
                  </div>
               </div>
            </section>
         </div>

         <footer class="main-footer">
            <div class="pull-right d-none d-sm-inline-block">
               <div id="floating-container">
                  <div class="circle1 circle-blue1"></div>
                  <div class="floating-menus" style="display:none;">
                     <div>
                        <a href="http://accufy.originlabsoft.com/admin/invoice/create"> Create new Invoice              <i class="fa fa-file-text-o"></i></a>
                     </div>
                     <div>
                        <a href="http://accufy.originlabsoft.com/admin/estimate/create"> Create new Estimate              <i class="fa fa-file-text"></i></a>
                     </div>
                     <div>
                        <a href="http://accufy.originlabsoft.com/admin/bills/create">Create New Bill              <i class="fa fa-file-text-o"></i></a>
                     </div>
                     <div>
                        <a href="http://accufy.originlabsoft.com/admin/customer">Add Customer               <i class="fa fa-user-o"></i></a>
                     </div>
                     <div>
                        <a href="http://accufy.originlabsoft.com/admin/vendor">Add Vendor              <i class="fa ti-user"></i></a>
                     </div>
                  </div>
                  <div class="fab-button">
                     <i class="ti-plus" aria-hidden="true"></i>
                  </div>
               </div>
            </div>
         </footer>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>