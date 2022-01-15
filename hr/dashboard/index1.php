<?php 
	require_once('../private/initialize.php');

$page = 'Dashboard';
$page_title = 'Home';
include(SHARED_PATH . '/admin_header.php'); 

?>

     <div class="page-wrapper">
        <div class="content container-fluid">
           <div class="page-header">
              <div class="row">
                 <div class="col-sm-12">
                    <h3 class="page-title">Welcome Admin! </h3>
                    <ul class="breadcrumb">
                       <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                 </div>
              </div>
           </div>
           <div class="row ">
              <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                 <div class="card dash-widget">
                    <div class="card-body">
                       <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                       <div class="dash-widget-info">
                          <h3 class="font-12">₦15,000,000</h3>
                          <span>Revenue</span>
                       </div>
                    </div>
                 </div>
              </div>
              <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                 <div class="card dash-widget">
                    <div class="card-body">
                       <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                       <div class="dash-widget-info">
                          <h3>₦1,298,980.00</h3>
                          <span>Tax</span>
                       </div>
                    </div>
                 </div>
              </div>
              <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                 <div class="card dash-widget">
                    <div class="card-body">
                       <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                       <div class="dash-widget-info">
                          <h3>37</h3>
                          <span>Vendors</span>
                       </div>
                    </div>
                 </div>
              </div>
              <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                 <div class="card dash-widget">
                    <div class="card-body">
                       <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                       <div class="dash-widget-info">
                          <h3>718</h3>
                          <span>Customers</span>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
           <div class="row">
              <div class="col-md-12">
                 <div class="card-group m-b-30">
                    <div class="card">
                       <div class="card-body">
                          <div class="d-flex justify-content-between mb-3">
                             <div>
                                <span class="d-block">Official Employees</span>
                             </div>
                             <div>
                                <span class="text-success">+10%</span>
                             </div>
                          </div>
                          <h3 class="mb-3">356</h3>
                          <div class="progress mb-2" style="height: 5px;">
                             <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mb-0">Casual Employees 108</p>
                       </div>
                    </div>
                    <div class="card">
                       <div class="card-body">
                          <div class="d-flex justify-content-between mb-3">
                             <div>
                                <span class="d-block">Salary</span>
                             </div>
                             <div>
                                <span class="text-success">+12.5%</span>
                             </div>
                          </div>
                          <h3 class="mb-3">₦1,42,300</h3>
                          <div class="progress mb-2" style="height: 5px;">
                             <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mb-0">Wages <span class="text-muted">₦1,15,852</span></p>
                       </div>
                    </div>
                    <div class="card">
                       <div class="card-body">
                          <div class="d-flex justify-content-between mb-3">
                             <div>
                                <span class="d-block">Expenses</span>
                             </div>
                             <div>
                                <span class="text-danger">-2.8%</span>
                             </div>
                          </div>
                          <h3 class="mb-3">₦8,500</h3>
                          <div class="progress mb-2" style="height: 5px;">
                             <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mb-0">Previous Month <span class="text-muted">₦7,500</span></p>
                       </div>
                    </div>
                    <div class="card">
                       <div class="card-body">
                          <div class="d-flex justify-content-between mb-3">
                             <div>
                                <span class="d-block">Profit</span>
                             </div>
                             <div>
                                <span class="text-danger">-75%</span>
                             </div>
                          </div>
                          <h3 class="mb-3">₦1,12,000</h3>
                          <div class="progress mb-2" style="height: 5px;">
                             <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mb-0">Previous Month <span class="text-muted">₦1,42,000</span></p>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
           <div class="row">
              <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-6 text-center">
                       <div class="card">
                          <div class="card-body">
                             <h3 class="card-title">Total Revenue</h3>
                             <div id="bar-charts"></div>
                          </div>
                       </div>
                    </div>
                    <div class="col-md-6 text-center">
                       <div class="card">
                          <div class="card-body">
                             <h3 class="card-title">Sales Overview</h3>
                             <div id="line-charts"></div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
           
           <div class="row">
              <div class="col-md-6 d-flex">
                 <div class="card card-table flex-fill">
                    <div class="card-header">
                       <h3 class="card-title mb-0">Invoices</h3>
                    </div>
                    <div class="card-body">
                       <div class="table-responsive">
                          <table class="table table-nowrap custom-table mb-0">
                             <thead>
                                <tr>
                                   <th>Invoice ID</th>
                                   <th>Client</th>
                                   <th>Due Date</th>
                                   <th>Total</th>
                                   <th>Status</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                   <td><a href="invoice-view.html">#INV-0001</a></td>
                                   <td>
                                      <h2><a href="#">Global Technologies</a></h2>
                                   </td>
                                   <td>11 Mar 2019</td>
                                   <td>₦380</td>
                                   <td>
                                      <span class="badge bg-inverse-warning">Partially Paid</span>
                                   </td>
                                </tr>
                                <tr>
                                   <td><a href="invoice-view.html">#INV-0002</a></td>
                                   <td>
                                      <h2><a href="#">Delta Infotech</a></h2>
                                   </td>
                                   <td>8 Feb 2019</td>
                                   <td>₦500</td>
                                   <td>
                                      <span class="badge bg-inverse-success">Paid</span>
                                   </td>
                                </tr>
                                <tr>
                                   <td><a href="invoice-view.html">#INV-0003</a></td>
                                   <td>
                                      <h2><a href="#">Cream Inc</a></h2>
                                   </td>
                                   <td>23 Jan 2019</td>
                                   <td>₦60</td>
                                   <td>
                                      <span class="badge bg-inverse-danger">Unpaid</span>
                                   </td>
                                </tr>
                             </tbody>
                          </table>
                       </div>
                    </div>
                    <div class="card-footer">
                       <a href="invoices.html">View all invoices</a>
                    </div>
                 </div>
              </div>
              <div class="col-md-6 d-flex">
                 <div class="card card-table flex-fill">
                    <div class="card-header">
                       <h3 class="card-title mb-0">Payments</h3>
                    </div>
                    <div class="card-body">
                       <div class="table-responsive">
                          <table class="table custom-table table-nowrap mb-0">
                             <thead>
                                <tr>
                                   <th>Invoice ID</th>
                                   <th>Client</th>
                                   <th>Payment Type</th>
                                   <th>Paid Date</th>
                                   <th>Paid Amount</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                   <td><a href="invoice-view.html">#INV-0001</a></td>
                                   <td>
                                      <h2><a href="#">Global Technologies</a></h2>
                                   </td>
                                   <td>Paypal</td>
                                   <td>11 Mar 2019</td>
                                   <td>₦380</td>
                                </tr>
                                <tr>
                                   <td><a href="invoice-view.html">#INV-0002</a></td>
                                   <td>
                                      <h2><a href="#">Delta Infotech</a></h2>
                                   </td>
                                   <td>Paypal</td>
                                   <td>8 Feb 2019</td>
                                   <td>₦500</td>
                                </tr>
                                <tr>
                                   <td><a href="invoice-view.html">#INV-0003</a></td>
                                   <td>
                                      <h2><a href="#">Cream Inc</a></h2>
                                   </td>
                                   <td>Paypal</td>
                                   <td>23 Jan 2019</td>
                                   <td>₦60</td>
                                </tr>
                             </tbody>
                          </table>
                       </div>
                    </div>
                    <div class="card-footer">
                       <a href="payments.html">View all payments</a>
                    </div>
                 </div>
              </div>
           </div>
           <div class="row">
              <div class="col-md-6 d-flex">
                 <div class="card card-table flex-fill">
                    <div class="card-header">
                       <h3 class="card-title mb-0">Clients</h3>
                    </div>
                    <div class="card-body">
                       <div class="table-responsive">
                          <table class="table custom-table mb-0">
                             <thead>
                                <tr>
                                   <th>Name</th>
                                   <th>Email</th>
                                   <th>Status</th>
                                   <th class="text-end">Action</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                   <td>
                                      <h2 class="table-avatar">
                                         <a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-19.jpg"></a>
                                         <a href="client-profile.html">Barry Cuda <span>CEO</span></a>
                                      </h2>
                                   </td>
                                   <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="25474457575c4650414465405d44485549400b464a48">[email&#160;protected]</a></td>
                                   <td>
                                      <div class="dropdown action-label">
                                         <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="fa fa-dot-circle-o text-success"></i> Active
                                         </a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                         </div>
                                      </div>
                                   </td>
                                   <td class="text-end">
                                      <div class="dropdown dropdown-action">
                                         <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td>
                                      <h2 class="table-avatar">
                                         <a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-19.jpg"></a>
                                         <a href="client-profile.html">Tressa Wexler <span>Manager</span></a>
                                      </h2>
                                   </td>
                                   <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="403432253333213725382c2532002538212d302c256e232f2d">[email&#160;protected]</a></td>
                                   <td>
                                      <div class="dropdown action-label">
                                         <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                         </a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                         </div>
                                      </div>
                                   </td>
                                   <td class="text-end">
                                      <div class="dropdown dropdown-action">
                                         <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td>
                                      <h2 class="table-avatar">
                                         <a href="client-profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-07.jpg"></a>
                                         <a href="client-profile.html">Ruby Bartlett <span>CEO</span></a>
                                      </h2>
                                   </td>
                                   <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f78582958e959685839b928383b7928f969a879b92d994989a">[email&#160;protected]</a></td>
                                   <td>
                                      <div class="dropdown action-label">
                                         <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                         </a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                         </div>
                                      </div>
                                   </td>
                                   <td class="text-end">
                                      <div class="dropdown dropdown-action">
                                         <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td>
                                      <h2 class="table-avatar">
                                         <a href="client-profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-06.jpg"></a>
                                         <a href="client-profile.html"> Misty Tison <span>CEO</span></a>
                                      </h2>
                                   </td>
                                   <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="5934302a2d202d302a3637193c21383429353c773a3634">[email&#160;protected]</a></td>
                                   <td>
                                      <div class="dropdown action-label">
                                         <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="fa fa-dot-circle-o text-success"></i> Active
                                         </a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                         </div>
                                      </div>
                                   </td>
                                   <td class="text-end">
                                      <div class="dropdown dropdown-action">
                                         <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td>
                                      <h2 class="table-avatar">
                                         <a href="client-profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-14.jpg"></a>
                                         <a href="client-profile.html"> Daniel Deacon <span>CEO</span></a>
                                      </h2>
                                   </td>
                                   <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="771316191e121b13121614181937120f161a071b125914181a">[email&#160;protected]</a></td>
                                   <td>
                                      <div class="dropdown action-label">
                                         <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                         </a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                         </div>
                                      </div>
                                   </td>
                                   <td class="text-end">
                                      <div class="dropdown dropdown-action">
                                         <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                             </tbody>
                          </table>
                       </div>
                    </div>
                    <div class="card-footer">
                       <a href="clients.html">View all clients</a>
                    </div>
                 </div>
              </div>
              <div class="col-md-6 d-flex">
                 <div class="card card-table flex-fill">
                    <div class="card-header">
                       <h3 class="card-title mb-0">Recent Projects</h3>
                    </div>
                    <div class="card-body">
                       <div class="table-responsive">
                          <table class="table custom-table mb-0">
                             <thead>
                                <tr>
                                   <th>Project Name </th>
                                   <th>Progress</th>
                                   <th class="text-end">Action</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                   <td>
                                      <h2><a href="project-view.html">Office Management</a></h2>
                                      <small class="block text-ellipsis">
                                      <span>1</span> <span class="text-muted">open tasks, </span>
                                      <span>9</span> <span class="text-muted">tasks completed</span>
                                      </small>
                                   </td>
                                   <td>
                                      <div class="progress progress-xs progress-striped">
                                         <div class="progress-bar" role="progressbar" data-bs-toggle="tooltip" title="65%" style="width: 65%"></div>
                                      </div>
                                   </td>
                                   <td class="text-end">
                                      <div class="dropdown dropdown-action">
                                         <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td>
                                      <h2><a href="project-view.html">Project Management</a></h2>
                                      <small class="block text-ellipsis">
                                      <span>2</span> <span class="text-muted">open tasks, </span>
                                      <span>5</span> <span class="text-muted">tasks completed</span>
                                      </small>
                                   </td>
                                   <td>
                                      <div class="progress progress-xs progress-striped">
                                         <div class="progress-bar" role="progressbar" data-bs-toggle="tooltip" title="15%" style="width: 15%"></div>
                                      </div>
                                   </td>
                                   <td class="text-end">
                                      <div class="dropdown dropdown-action">
                                         <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td>
                                      <h2><a href="project-view.html">Video Calling App</a></h2>
                                      <small class="block text-ellipsis">
                                      <span>3</span> <span class="text-muted">open tasks, </span>
                                      <span>3</span> <span class="text-muted">tasks completed</span>
                                      </small>
                                   </td>
                                   <td>
                                      <div class="progress progress-xs progress-striped">
                                         <div class="progress-bar" role="progressbar" data-bs-toggle="tooltip" title="49%" style="width: 49%"></div>
                                      </div>
                                   </td>
                                   <td class="text-end">
                                      <div class="dropdown dropdown-action">
                                         <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td>
                                      <h2><a href="project-view.html">Hospital Administration</a></h2>
                                      <small class="block text-ellipsis">
                                      <span>12</span> <span class="text-muted">open tasks, </span>
                                      <span>4</span> <span class="text-muted">tasks completed</span>
                                      </small>
                                   </td>
                                   <td>
                                      <div class="progress progress-xs progress-striped">
                                         <div class="progress-bar" role="progressbar" data-bs-toggle="tooltip" title="88%" style="width: 88%"></div>
                                      </div>
                                   </td>
                                   <td class="text-end">
                                      <div class="dropdown dropdown-action">
                                         <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td>
                                      <h2><a href="project-view.html">Digital Marketplace</a></h2>
                                      <small class="block text-ellipsis">
                                      <span>7</span> <span class="text-muted">open tasks, </span>
                                      <span>14</span> <span class="text-muted">tasks completed</span>
                                      </small>
                                   </td>
                                   <td>
                                      <div class="progress progress-xs progress-striped">
                                         <div class="progress-bar" role="progressbar" data-bs-toggle="tooltip" title="100%" style="width: 100%"></div>
                                      </div>
                                   </td>
                                   <td class="text-end">
                                      <div class="dropdown dropdown-action">
                                         <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                             </tbody>
                          </table>
                       </div>
                    </div>
                    <div class="card-footer">
                       <a href="projects.html">View all projects</a>
                    </div>
                 </div>
              </div>
           </div>
           
           
        </div>
     </div>
<?php include(SHARED_PATH . '/admin_footer.php');  ?>  
