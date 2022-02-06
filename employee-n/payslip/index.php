<?php
require_once('../private/initialize.php');

$page = 'Payslip';
$page_title = 'Payslip';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Payslips</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
         <div class="btn-list"> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xl-12 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">My Payslips Summary</h4>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="emp-attendance_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="emp-attendance" role="grid" aria-describedby="emp-attendance_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 text-center sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 157.312px;">#ID</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Month: activate to sort column ascending" style="width: 202.792px;">Month</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Year: activate to sort column ascending" style="width: 119.688px;">Year</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="$ Net Salary: activate to sort column ascending" style="width: 223.188px;">$ Net Salary</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="emp-attendance" rowspan="1" colspan="1" aria-label="Generated Date: activate to sort column ascending" style="width: 270.458px;">Generated Date</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 355.229px;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td class="text-center">#10029</td>
                                 <td>January</td>
                                 <td>2021</td>
                                 <td class="font-weight-semibold">$32,000</td>
                                 <td>01-02-2021</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""><i class="feather feather-eye"></i></a> <a class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" data-bs-original-title="" title=""><i class="feather feather-download"></i></a> <a class="btn btn-info btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Print" onclick="javascript:window.print();" data-bs-original-title="" title=""><i class="feather feather-printer"></i></a> <a class="btn btn-warning btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Share" data-bs-original-title="" title=""><i class="feather feather-share-2"></i></a> </td>
                              </tr>
                              <tr class="even">
                                 <td class="text-center">#10321</td>
                                 <td>December</td>
                                 <td>2020</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-01-2021</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""><i class="feather feather-eye"></i></a> <a class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" data-bs-original-title="" title=""><i class="feather feather-download"></i></a> <a class="btn btn-info btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Print" onclick="javascript:window.print();" data-bs-original-title="" title=""><i class="feather feather-printer"></i></a> <a class="btn btn-warning btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Share" data-bs-original-title="" title=""><i class="feather feather-share-2"></i></a> </td>
                              </tr>
                              <tr class="odd">
                                 <td class="text-center">#10598</td>
                                 <td>November</td>
                                 <td>2020</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-12-2020</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""><i class="feather feather-eye"></i></a> <a class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" data-bs-original-title="" title=""><i class="feather feather-download"></i></a> <a class="btn btn-info btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Print" onclick="javascript:window.print();" data-bs-original-title="" title=""><i class="feather feather-printer"></i></a> <a class="btn btn-warning btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Share" data-bs-original-title="" title=""><i class="feather feather-share-2"></i></a> </td>
                              </tr>
                              <tr class="even">
                                 <td class="text-center">#10438</td>
                                 <td>October</td>
                                 <td>2020</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-11-2020</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""><i class="feather feather-eye"></i></a> <a class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" data-bs-original-title="" title=""><i class="feather feather-download"></i></a> <a class="btn btn-info btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Print" onclick="javascript:window.print();" data-bs-original-title="" title=""><i class="feather feather-printer"></i></a> <a class="btn btn-warning btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Share" data-bs-original-title="" title=""><i class="feather feather-share-2"></i></a> </td>
                              </tr>
                              <tr class="odd">
                                 <td class="text-center">#10837</td>
                                 <td>September</td>
                                 <td>2020</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-10-2020</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""><i class="feather feather-eye"></i></a> <a class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" data-bs-original-title="" title=""><i class="feather feather-download"></i></a> <a class="btn btn-info btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Print" onclick="javascript:window.print();" data-bs-original-title="" title=""><i class="feather feather-printer"></i></a> <a class="btn btn-warning btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Share" data-bs-original-title="" title=""><i class="feather feather-share-2"></i></a> </td>
                              </tr>
                              <tr class="even">
                                 <td class="text-center">#10391</td>
                                 <td>August</td>
                                 <td>2020</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-09-2020</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""><i class="feather feather-eye"></i></a> <a class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" data-bs-original-title="" title=""><i class="feather feather-download"></i></a> <a class="btn btn-info btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Print" onclick="javascript:window.print();" data-bs-original-title="" title=""><i class="feather feather-printer"></i></a> <a class="btn btn-warning btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Share" data-bs-original-title="" title=""><i class="feather feather-share-2"></i></a> </td>
                              </tr>
                              <tr class="odd">
                                 <td class="text-center">#11073</td>
                                 <td>July</td>
                                 <td>2020</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>02-08-2020</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""><i class="feather feather-eye"></i></a> <a class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" data-bs-original-title="" title=""><i class="feather feather-download"></i></a> <a class="btn btn-info btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Print" onclick="javascript:window.print();" data-bs-original-title="" title=""><i class="feather feather-printer"></i></a> <a class="btn btn-warning btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Share" data-bs-original-title="" title=""><i class="feather feather-share-2"></i></a> </td>
                              </tr>
                              <tr class="even">
                                 <td class="text-center">#10839</td>
                                 <td>June</td>
                                 <td>2020</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>02-07-2020</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""><i class="feather feather-eye"></i></a> <a class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" data-bs-original-title="" title=""><i class="feather feather-download"></i></a> <a class="btn btn-info btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Print" onclick="javascript:window.print();" data-bs-original-title="" title=""><i class="feather feather-printer"></i></a> <a class="btn btn-warning btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Share" data-bs-original-title="" title=""><i class="feather feather-share-2"></i></a> </td>
                              </tr>
                              <tr class="odd">
                                 <td class="text-center">#10289</td>
                                 <td>May</td>
                                 <td>2020</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-06-2020</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""><i class="feather feather-eye"></i></a> <a class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" data-bs-original-title="" title=""><i class="feather feather-download"></i></a> <a class="btn btn-info btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Print" onclick="javascript:window.print();" data-bs-original-title="" title=""><i class="feather feather-printer"></i></a> <a class="btn btn-warning btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Share" data-bs-original-title="" title=""><i class="feather feather-share-2"></i></a> </td>
                              </tr>
                              <tr class="even">
                                 <td class="text-center">#10422</td>
                                 <td>April</td>
                                 <td>2020</td>
                                 <td class="font-weight-semibold">$28,000</td>
                                 <td>01-05-2020</td>
                                 <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="View" data-bs-original-title="" title=""><i class="feather feather-eye"></i></a> <a class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" data-bs-original-title="" title=""><i class="feather feather-download"></i></a> <a class="btn btn-info btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Print" onclick="javascript:window.print();" data-bs-original-title="" title=""><i class="feather feather-printer"></i></a> <a class="btn btn-warning btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Share" data-bs-original-title="" title=""><i class="feather feather-share-2"></i></a> </td>
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

<?php include (SHARED_PATH . '/footer.php') ?>