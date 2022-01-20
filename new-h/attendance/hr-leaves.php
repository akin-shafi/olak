<?php
require_once('../private/initialize.php');

$page = 'Blank';
$page_title = 'Blank';
include(SHARED_PATH . '/header.php');

?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Leave Settings</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list"> <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addleavemodal">Add Leave Type</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Leaves Types</h4>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="hr-leavestypes_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  <div class="row">
                     <div class="col-sm-12 col-md-6"></div>
                     <div class="col-sm-12 col-md-6"></div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-leavestypes" role="grid">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" style="width: 477.062px;">Leaves Type</th>
                                 <th class="border-bottom-0 text-center sorting_disabled" rowspan="1" colspan="1" style="width: 398.938px;">No.of Leaves</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" style="width: 383.333px;">Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td>Casual Leaves</td>
                                 <td class="text-center font-weight-semibold">14</td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editleavemodal"><i class="feather feather-eye primary text-primary"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td>Sick Leaves</td>
                                 <td class="text-center font-weight-semibold">07</td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editleavemodal"><i class="feather feather-eye primary text-primary"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td>Maternity Leaves</td>
                                 <td class="text-center font-weight-semibold">20</td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editleavemodal"><i class="feather feather-eye primary text-primary"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td>Paternity Leaves</td>
                                 <td class="text-center font-weight-semibold">00</td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editleavemodal"><i class="feather feather-eye primary text-primary"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td>Annual Leaves</td>
                                 <td class="text-center font-weight-semibold">00</td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editleavemodal"><i class="feather feather-eye primary text-primary"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td>Unpaid Leaves</td>
                                 <td class="text-center font-weight-semibold">00</td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editleavemodal"><i class="feather feather-eye primary text-primary"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td>Other Leaves</td>
                                 <td class="text-center font-weight-semibold">00</td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editleavemodal"><i class="feather feather-eye primary text-primary"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-5"></div>
                     <div class="col-sm-12 col-md-7"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<?php include (SHARED_PATH . '/footer.php') ?>