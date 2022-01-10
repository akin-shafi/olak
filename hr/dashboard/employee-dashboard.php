<?php 
	require_once('../private/initialize.php');

$page = 'Dashboard';
$page_title = 'Employee Dashboard';
include(SHARED_PATH . '/admin_header.php'); 
?>

         <div class="page-wrapper">
            <div class="content container-fluid">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="page-title">All Loan Request</h3>
                     <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Loan</li>
                     </ul>
                  </div>
                  <div class="col-auto float-end ms-auto">
                     <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#employee_modal"><i class="fa fa-plus"></i> Add Loan Request</a>
                     <div class="view-icons">
                        <a href="/olak/hr/employees/" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                        <a href="/olak/hr/employees/employees-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                     </div>
                  </div>
               </div>


               
               <!-- Status 
            new 
            paid
            rejected
         -->
         <div class="col-md-12">
            <div class="p-2">
              <div class="row">
               <ol class="col-6 list-group">
                 <li class="list-group-item d-flex justify-content-between align-items-start">
                   <div class="ms-2 me-auto">
                     <div class="fw-bold">Total loan Requested</div>
                   </div>
                   <span class="">900,0000.00</span>
                 </li>
                </ol>

               <ol class="col-6 list-group ">
                 <li class="list-group-item d-flex justify-content-between align-items-start">
                   <div class="ms-2 me-auto">
                     <div class="fw-bold">Total loan Paid</div>
                   </div>
                   <span class="">700,0000.00</span>
                 </li>
               </ol>
              </div>
            </div>


            <div class="card card-table flex-fill">
               <!-- <div class="card-header">
                  <h3 class="card-title mb-0">All Loan Request</h3>
               </div> -->
               <div class="card-body ">
                  <div class="table-responsive table-wrap p-2 ">
                     <table class="table table-nowrap custom-table mb-0 datatable">
                        <thead>
                           <tr>
                              <th>Ref No.</th>
                              <th>Amount</th>
                              <th>Date requested</th>
                              <th>Status</th>
                              <th class="text-end">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td><a href="invoice-view.html">#REF-0001</a></td>
                              <td>
                                 <h2><a href="#">150,000</a></h2>
                              </td>
                              <td>11 Jan, 2022</td>
                              <td>
                                 <span class="badge bg-inverse-warning">New</span>
                              </td>
                              <td class="text-end">
                                 <div class="btn-group btn-group-sm">
                                   <div class="btn btn-sm btn-outline-primary">Approve</div>
                                   <div class="btn btn-sm btn-outline-danger">Reject</div>
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

<?php include(SHARED_PATH . '/admin_footer.php');  ?> 