<?php 
	require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payslip';
include(SHARED_PATH . '/admin_header.php'); 
?>
         <div class="page-wrapper">
            <div class="content container-fluid">
               <div class="page-header">
                  <div class="row align-items-center">
                     <div class="col">
                        <h3 class="page-title">Payslip</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Payslip</li>
                        </ul>
                     </div>
                     <div class="col-auto float-end ms-auto">
                        <div class="btn-group btn-group-sm">
                           <button class="btn btn-white">CSV</button>
                           <button class="btn btn-white">PDF</button>
                           <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="payslip-title">Payslip for the month of Feb 2019</h4>
                           <div class="row">
                              <div class="col-sm-6 m-b-20">
                                 <img src="assets/img/logo2.png" class="inv-logo" alt="">
                                 <ul class="list-unstyled mb-0">
                                    <li>Olak Integrated</li>
                                    <li>Plot 5, Irewolede Industrial Estate, </li>
                                    <li>New Yidi Road Ilorin,</li>
                                    <li>Kwara State Nigeria.</li>
                                 </ul>
                              </div>
                              <div class="col-sm-6 m-b-20">
                                 <div class="invoice-details">
                                    <h3 class="text-uppercase">Payslip #49029</h3>
                                    <ul class="list-unstyled">
                                       <li>Salary Month: <span>March, 2019</span></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-12 m-b-20">
                                 <ul class="list-unstyled">
                                    <li>
                                       <h5 class="mb-0"><strong>John Doe</strong></h5>
                                    </li>
                                    <li><span>Web Designer</span></li>
                                    <li>Employee ID: FT-0009</li>
                                    <li>Joining Date: 1 Jan 2013</li>
                                 </ul>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <div>
                                    <h4 class="m-b-10"><strong>Earnings</strong></h4>
                                    <table class="table table-bordered">

                                       <tbody>
                                          <tr>
                                             <td><strong>Basic Salary</strong> <span class="float-end">₦26,194.45</span></td>
                                          </tr>
                                          <tr>
                                             <td><strong>House Rent Allowance (H.R.A.)</strong> <span class="float-end">₦26,194.45</span></td>
                                          </tr>
                                          <tr>
                                             <td><strong>Conveyance(Transport Allowance)</strong> <span class="float-end">₦26,194.45</span></td>
                                          </tr>
                                          <tr>
                                             <td><strong>Medical Allowance</strong> <span class="float-end">₦52,388.89</span></td>
                                          </tr>
                                          <tr>
                                             <td><strong>Furniture Allowance</strong> <span class="float-end">₦183,361.12</span></td>
                                          </tr>
                                          <tr>
                                             <td><strong>Meal Allowance</strong> <span class="float-end">₦78,583.34</span></td>
                                          </tr>
                                          <tr>
                                             <td><strong>Entertainment & Passage</strong> <span class="float-end">₦130,972.23</span></td>
                                          </tr>
                                          
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div>
                                    <h4 class="m-b-10"><strong>Deductions</strong></h4>
                                    <table class="table table-bordered">
                                       <tbody>
                                          <tr>
                                             <td><strong>Tax (PAYE)</strong> <span class="float-end">₦17,602.25</span></td>
                                          </tr>
                                          <tr>
                                             <td><strong>Employee Pension </strong> <span class="float-end">₦6,286.67</span></td>
                                          </tr>
                                          
                                          <tr>
                                             <td><strong>Total Deductions</strong> <span class="float-end"><strong>₦23,888.92</strong></span></td>
                                          </tr>
                                          <tr>
                                             <td><strong>Monthly Gross Salary</strong> <span class="float-end"><strong>₦523,888.93</strong></span></td>
                                          </tr>
                                          <tr>
                                             <td><strong>Monthly Net Salary</strong> <span class="float-end"><strong>₦500,000.00</strong></span></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <p><strong>Net Salary: ₦6,000,000.00</strong> (Six million.)</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
<?php include(SHARED_PATH . '/admin_footer.php');  ?> 