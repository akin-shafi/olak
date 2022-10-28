<?php
require_once('../private/initialize.php');

$page = 'Notice Board';
$page_title = 'Notice Board';
include(SHARED_PATH . '/header.php');

?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Notice Board</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list"> <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addnoticemodal">Add New Notice</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Notice Summary</h4>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div id="hr-notice_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  <div class="row">
                     <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="hr-notice_length">
                           <label>
                              Show 
                              <select name="hr-notice_length" aria-controls="hr-notice" class="form-select form-select-sm">
                                 <option value="10">10</option>
                                 <option value="25">25</option>
                                 <option value="50">50</option>
                                 <option value="100">100</option>
                              </select>
                              entries
                           </label>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6">
                        <div id="hr-notice_filter" class="dataTables_filter"><label><input type="search" class="form-control form-control-sm" placeholder="Search..." aria-controls="hr-notice"></label></div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-notice" role="grid" aria-describedby="hr-notice_info">
                           <thead>
                              <tr role="row">
                                 <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="No" style="width: 24px;">No</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-notice" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending" style="width: 228.833px;">Title</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-notice" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width: 542.917px;">Description</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-notice" rowspan="1" colspan="1" aria-label="To: activate to sort column ascending" style="width: 74.7083px;">To</th>
                                 <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-notice" rowspan="1" colspan="1" aria-label="Create On: activate to sort column ascending" style="width: 77.5417px;">Create On</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Status" style="width: 74.4167px;">Status</th>
                                 <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 87.5833px;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td>01</td>
                                 <td>Board meeting Completed</td>
                                 <td>Attend the company mangers &amp; teamleads.</td>
                                 <td>Employees</td>
                                 <td>18-02-2021</td>
                                 <td><span class="badge badge-success">Active</span></td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editnoticemodal"><i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit/View" aria-label="Edit/View"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td>02</td>
                                 <td>Updated the Company Policy</td>
                                 <td>some changes &amp; add the terms &amp; conditions.</td>
                                 <td>Employees</td>
                                 <td>16-02-2021</td>
                                 <td><span class="badge badge-success">Active</span></td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editnoticemodal"><i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit/View" aria-label="Edit/View"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td>03</td>
                                 <td>Office Timings Changed</td>
                                 <td>This effetct after March 01st 9:00 Am To 5:00 Pm</td>
                                 <td>Employees</td>
                                 <td>17-02-2021</td>
                                 <td><span class="badge badge-success">Active</span></td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editnoticemodal"><i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit/View" aria-label="Edit/View"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td>04</td>
                                 <td>Republic Day Celebrated</td>
                                 <td>Participate the all employess</td>
                                 <td>Employees</td>
                                 <td>26-01-2021</td>
                                 <td><span class="badge badge-success">Active</span></td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editnoticemodal"><i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit/View" aria-label="Edit/View"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td>05</td>
                                 <td>Client meeting Completed</td>
                                 <td>Participate the all the managers</td>
                                 <td>Employees</td>
                                 <td>12-01-2021</td>
                                 <td><span class="badge badge-danger">InActive</span></td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editnoticemodal"><i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit/View" aria-label="Edit/View"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td>06</td>
                                 <td>Update the Employee Leave Policy</td>
                                 <td>Participate the all employess</td>
                                 <td>Employees</td>
                                 <td>02-01-2021</td>
                                 <td><span class="badge badge-success">Active</span></td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editnoticemodal"><i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit/View" aria-label="Edit/View"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="odd">
                                 <td>07</td>
                                 <td>Faith Harris, Please sent the email</td>
                                 <td>Sed ut perspiciatis unde omnis iste natus error sit voluptatem</td>
                                 <td>Employees</td>
                                 <td>26-01-2021</td>
                                 <td><span class="badge badge-success">Active</span></td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editnoticemodal"><i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit/View" aria-label="Edit/View"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                              <tr class="even">
                                 <td>08</td>
                                 <td>Update the Agreement Policy</td>
                                 <td>There are many variations of passages of but the majority have suffered alteration </td>
                                 <td>Employees</td>
                                 <td>12-02-2021</td>
                                 <td><span class="badge badge-danger">InActive</span></td>
                                 <td>
                                    <div class="d-flex"> <a href="#" class="action-btns1" data-bs-toggle="modal" data-bs-target="#editnoticemodal"><i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit/View" aria-label="Edit/View"></i></a> <a href="#" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="feather feather-trash-2 text-danger"></i></a> </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="hr-notice_info" role="status" aria-live="polite">Showing 1 to 8 of 8 entries</div>
                     </div>
                     <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="hr-notice_paginate">
                           <ul class="pagination">
                              <li class="paginate_button page-item previous disabled" id="hr-notice_previous"><a href="#" aria-controls="hr-notice" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                              <li class="paginate_button page-item active"><a href="#" aria-controls="hr-notice" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                              <li class="paginate_button page-item next disabled" id="hr-notice_next"><a href="#" aria-controls="hr-notice" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="addnoticemodal" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add New Notice</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
         </div>
         <div class="modal-body">
            <div class="form-group"> <label class="form-label">Title</label> <input class="form-control" placeholder="Text"> </div>
            <div class="form-group">
               <div class="custom-controls-stacked d-md-flex"> <label class="custom-control custom-radio success me-4"> <input type="radio" class="custom-control-input" name="example-radios1" value="option1"> <span class="custom-control-label">To Employees</span> </label> <label class="custom-control custom-radio success"> <input type="radio" class="custom-control-input" name="example-radios1" value="option2"> <span class="custom-control-label">To Clients</span> </label> </div>
            </div>
            <div class="form-group">
               <label class="form-label">Select Date:</label> 
               <div class="input-group">
                  <div class="input-group-prepend">
                     <div class="input-group-text"> <i class="feather feather-calendar"></i> </div>
                  </div>
                  <input class="form-control fc-datepicker" placeholder="DD-MM-YYYY" type="text"> 
               </div>
            </div>
            <div class="form-group">
               <label class="form-label">Description:</label> 
               <div class="summernote"></div>
            </div>
            <div class="form-group">
               <label class="form-label">Attachment:</label> 
               <div class="form-group"> <label for="form-label" class="form-label"></label> <input class="form-control" type="file"> </div>
            </div>
            <div class="custom-controls-stacked d-md-flex"> <label class="form-label mt-1 me-5">Status :</label> <label class="custom-control custom-radio success me-4"> <input type="radio" class="custom-control-input" name="example-radios2" value="option3"> <span class="custom-control-label">To Employees</span> </label> <label class="custom-control custom-radio success"> <input type="radio" class="custom-control-input" name="example-radios2" value="option4"> <span class="custom-control-label">To Clients</span> </label> </div>
         </div>
         <div class="modal-footer"> <button class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button> <button class="btn btn-success">Save</button> </div>
      </div>
   </div>
</div>
<div class="modal fade" id="editnoticemodal">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Leaves</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
         </div>
         <div class="modal-body">
            <div class="form-group"> <label class="form-label">Title</label> <input class="form-control" placeholder="Text" value="Board meeting Completed"> </div>
            <div class="form-group">
               <div class="custom-controls-stacked d-md-flex"> <label class="custom-control custom-radio success me-4"> <input type="radio" class="custom-control-input" name="example-radios3" value="option5" checked=""> <span class="custom-control-label">To Employees</span> </label> <label class="custom-control custom-radio success"> <input type="radio" class="custom-control-input" name="example-radios3" value="option6"> <span class="custom-control-label">To Clients</span> </label> </div>
            </div>
            <div class="form-group">
               <label class="form-label">Select Date:</label> 
               <div class="input-group">
                  <div class="input-group-prepend">
                     <div class="input-group-text"> <i class="feather feather-calendar"></i> </div>
                  </div>
                  <input class="form-control fc-datepicker" placeholder="18-02-2021" type="text"> 
               </div>
            </div>
            <div class="form-group">
               <label class="form-label">Description:</label> 
               <div class="editor" style="display: none;"></div>
               <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr" lang="en" aria-labelledby="ck-editor__label_eecbe68d320e75a26014e9ef571491c6b">
                  <label class="ck ck-label ck-voice-label" id="ck-editor__label_eecbe68d320e75a26014e9ef571491c6b">Rich Text Editor</label>
                  
                  
               </div>
            </div>
            <div class="form-group"> <label for="form-label" class="form-label">Attachment:</label> <input class="form-control" type="file"> </div>
            <div class="custom-controls-stacked d-md-flex"> <label class="form-label mt-1 me-5">Status :</label> <label class="custom-control custom-radio success me-4"> <input type="radio" class="custom-control-input" name="example-radios2" value="option7" checked=""> <span class="custom-control-label">Active</span> </label> <label class="custom-control custom-radio success"> <input type="radio" class="custom-control-input" name="example-radios2" value="option8"> <span class="custom-control-label">Inactive</span> </label> </div>
         </div>
         <div class="modal-footer"> <button class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button> <button class="btn btn-success">Update</button> </div>
      </div>
   </div>
</div>

<?php include (SHARED_PATH . '/footer.php') ?>

<script src="<?php echo url_for('assets/plugins/ckeditor/build/ckeditor.js') ?>"></script>

<script src="<?php echo url_for('assets/plugins/ckeditor/js/ckeditor.js') ?>"></script>