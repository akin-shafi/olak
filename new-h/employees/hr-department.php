<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Department';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>
<div class="side-app">
  
   <!--/app header--> <!--Page header--> 
   <div class="page-header d-xl-flex d-block">
      <div class="page-leftheader">
         <h4 class="page-title">Department</h4>
      </div>
      <div class="page-rightheader ms-md-auto">
         <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
            <div class="btn-list"> <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#adddepartmentmodal">Add Department</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
         </div>
      </div>
   </div>
   <!--End Page header--> <!-- Row --> 
   <div class="row">
      <div class="col-xl-12 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header  border-0">
               <h4 class="card-title">Department Summary</h4>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                     
                     <div class="row">
                        <div class="col-sm-12">
                           <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-table" role="grid" aria-describedby="hr-table_info">
                              <thead>
                                 <tr role="row">
                                    <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                                    <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Department Name: activate to sort column ascending" style="width: 678.872px;">Department Name</th>
                                    <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr class="odd">
                                    <td>#01</td>
                                    <td>Designing Department</td>
                                    <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#editdepartmentmodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                                 </tr>
                                 <tr class="even">
                                    <td>#02</td>
                                    <td>Development Department</td>
                                    <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#editdepartmentmodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                                 </tr>
                                 <tr class="odd">
                                    <td>#03</td>
                                    <td>Marketing Department</td>
                                    <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#editdepartmentmodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                                 </tr>
                                 <tr class="even">
                                    <td>#04</td>
                                    <td>Human Resource Department</td>
                                    <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#editdepartmentmodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                                 </tr>
                                 <tr class="odd">
                                    <td>#05</td>
                                    <td>Managers Department</td>
                                    <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#editdepartmentmodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                                 </tr>
                                 <tr class="even">
                                    <td>#06</td>
                                    <td>Application Department</td>
                                    <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#editdepartmentmodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                                 </tr>
                                 <tr class="odd">
                                    <td>#07</td>
                                    <td>Support Department</td>
                                    <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#editdepartmentmodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                                 </tr>
                                 <tr class="even">
                                    <td>#08</td>
                                    <td>IT Department</td>
                                    <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#editdepartmentmodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                                 </tr>
                                 <tr class="odd">
                                    <td>#09</td>
                                    <td>Technical Department</td>
                                    <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#editdepartmentmodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
                                 </tr>
                                 <tr class="even">
                                    <td>#10</td>
                                    <td>Accounts Department</td>
                                    <td> <a class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#editdepartmentmodal"> <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i> </a> <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a> </td>
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
   <!-- End Row--> 
</div>

<?php include(SHARED_PATH . '/footer.php');?>
<script src="../../assets/plugins/circle-progress/circle-progress.min.js"></script>