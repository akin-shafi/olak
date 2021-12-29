<?php 
	require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Departments';
include(SHARED_PATH . '/admin_header.php'); 
?>
 <div class="page-wrapper">
    <div class="content container-fluid">
       <div class="page-header">
          <div class="row align-items-center">
             <div class="col">
                <h3 class="page-title">Department</h3>
                <ul class="breadcrumb">
                   <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                   <li class="breadcrumb-item active">Department</li>
                </ul>
             </div>
             <div class="col-auto float-end ms-auto">
                <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_department"><i class="fa fa-plus"></i> Add Department</a>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-12">
             <div>
                <table class="table table-striped custom-table mb-0 datatable">
                   <thead>
                      <tr>
                         <th style="width: 30px;">#</th>
                         <th>Department Name</th>
                         <th class="text-end">Action</th>
                      </tr>
                   </thead>
                   <tbody>
                      <tr>
                         <td>1</td>
                         <td>Web Development</td>
                         <td class="text-end">
                            <div class="dropdown dropdown-action">
                               <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                               <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_department"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                               </div>
                            </div>
                         </td>
                      </tr>
                      <tr>
                         <td>2</td>
                         <td>Application Development</td>
                         <td class="text-end">
                            <div class="dropdown dropdown-action">
                               <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                               <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_department"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                               </div>
                            </div>
                         </td>
                      </tr>
                      <tr>
                         <td>3</td>
                         <td>IT Management</td>
                         <td class="text-end">
                            <div class="dropdown dropdown-action">
                               <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                               <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_department"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                               </div>
                            </div>
                         </td>
                      </tr>
                      <tr>
                         <td>4</td>
                         <td>Accounts Management</td>
                         <td class="text-end">
                            <div class="dropdown dropdown-action">
                               <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                               <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_department"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                               </div>
                            </div>
                         </td>
                      </tr>
                      <tr>
                         <td>5</td>
                         <td>Support Management</td>
                         <td class="text-end">
                            <div class="dropdown dropdown-action">
                               <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                               <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_department"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                               </div>
                            </div>
                         </td>
                      </tr>
                      <tr>
                         <td>6</td>
                         <td>Marketing</td>
                         <td class="text-end">
                            <div class="dropdown dropdown-action">
                               <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                               <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_department"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                               </div>
                            </div>
                         </td>
                      </tr>
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
    <div id="add_department" class="modal custom-modal fade" role="dialog">
       <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body">
                <form>
                   <div class="form-group">
                      <label>Department Name <span class="text-danger">*</span></label>
                      <input class="form-control" type="text">
                   </div>
                   <div class="submit-section">
                      <button class="btn btn-primary submit-btn">Submit</button>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
    <div id="edit_department" class="modal custom-modal fade" role="dialog">
       <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Edit Department</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body">
                <form>
                   <div class="form-group">
                      <label>Department Name <span class="text-danger">*</span></label>
                      <input class="form-control" value="IT Management" type="text">
                   </div>
                   <div class="submit-section">
                      <button class="btn btn-primary submit-btn">Save</button>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
    <div class="modal custom-modal fade" id="delete_department" role="dialog">
       <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
             <div class="modal-body">
                <div class="form-header">
                   <h3>Delete Department</h3>
                   <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                   <div class="row">
                      <div class="col-6">
                         <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                      </div>
                      <div class="col-6">
                         <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
<?php include(SHARED_PATH . '/admin_footer.php');  ?>  