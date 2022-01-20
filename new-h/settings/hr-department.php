<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Department';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="side-app">

   <div class="page-header d-xl-flex d-block">
      <div class="page-leftheader">
         <h4 class="page-title">Department / Designation</h4>
      </div>
      <div class="page-rightheader ms-md-auto">
         <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
            <div class="btn-list">
               <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button>
               <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button>
               <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
            </div>
         </div>
      </div>
   </div>

   <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="col-xl-6 col-md-12 col-lg-12">
               <div class="card">
                  <div class="card-header  border-0">
                     <h4 class="card-title">Department Summary</h4>
                     <div class="page-rightheader ms-md-auto">
                        <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                           <div class="btn-list">
                              <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#department_modal">
                                 Add Department</a>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card-body">
                     <div class="table-responsive">
                        <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                           <div class="row">
                              <div class="col-sm-12">
                                 <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="dept-table" role="grid" aria-describedby="hr-table_info">
                                    <thead>
                                       <tr role="row">
                                          <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Department Name: activate to sort column ascending" style="width: 678.872px;">Department Name</th>
                                          <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php $sn = 1;
                                       foreach (Department::find_by_undeleted() as $department) : ?>
                                          <tr class="odd">
                                             <td><?php echo $sn++ ?></td>
                                             <td><?php echo ucwords($department->department_name) ?></td>

                                             <td>
                                                <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $department->id ?>" id="edit-dept-btn">
                                                   <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                                </a>
                                                <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $department->id ?>" id="delete_dept">
                                                   <i class="feather feather-trash-2"></i>
                                                </a>
                                             </td>
                                          </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-xl-6 col-md-12 col-lg-12">
               <div class="card">
                  <div class="card-header  border-0">
                     <h4 class="card-title">Job Title</h4>
                     <div class="page-rightheader ms-md-auto">
                        <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                           <div class="btn-list">
                              <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#designation_modal">
                                 Add Job Title</a>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card-body">
                     <div class="table-responsive">
                        <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                           <div class="row">
                              <div class="col-sm-12">
                                 <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="des-table" role="grid" aria-describedby="hr-table_info">
                                    <thead>
                                       <tr role="row">
                                          <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                                          <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Designation Name: activate to sort column ascending" style="width: 678.872px;">Designation Name</th>
                                          <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php $sn = 1;
                                       foreach (Designation::find_by_undeleted() as $designate) : ?>
                                          <tr class="odd">
                                             <td><?php echo $sn++ ?></td>
                                             <td><?php echo ucwords($designate->designation_name) ?></td>

                                             <td>
                                                <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $designate->id ?>" id="edit_des">
                                                   <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                                </a>
                                                <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $designate->id ?>" id="delete_des">
                                                   <i class="feather feather-trash-2"></i>
                                                </a>
                                             </td>
                                          </tr>
                                       <?php endforeach; ?>
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
      </div>
   </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
<script src="../../assets/plugins/circle-progress/circle-progress.min.js"></script>