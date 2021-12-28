<?php 
	require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'All Employees';
include(SHARED_PATH . '/admin_header.php'); 

?>
	<div class="page-wrapper" style="min-height: 708px;">
	   <div class="content container-fluid">
	      <div class="page-header">
	         <div class="row align-items-center">
	            <div class="col">
	               <h3 class="page-title">Employee</h3>
	               <ul class="breadcrumb">
	                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
	                  <li class="breadcrumb-item active">Employee</li>
	               </ul>
	            </div>
	            <div class="col-auto float-end ms-auto">
	               <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
	               <div class="view-icons">
	                  <a href="<?php echo url_for('employees/') ?>" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
	                  <a href="<?php echo url_for('employees/employees-list.php') ?>" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
	               </div>
	            </div>
	         </div>
	      </div>
	      <div class="row filter-row">
	         <div class="col-sm-6 col-md-3">
	            <div class="form-group form-focus">
	               <input type="text" class="form-control floating">
	               <label class="focus-label">Employee ID</label>
	            </div>
	         </div>
	         <div class="col-sm-6 col-md-3">
	            <div class="form-group form-focus">
	               <input type="text" class="form-control floating">
	               <label class="focus-label">Employee Name</label>
	            </div>
	         </div>
	         <div class="col-sm-6 col-md-3">
	            <div class="form-group form-focus select-focus focused">
	               <select class="select floating select2-hidden-accessible" data-select2-id="select2-data-1-8h87" tabindex="-1" aria-hidden="true">
	                  <option data-select2-id="select2-data-3-rwkw">Select Designation</option>
	                  <option>Web Developer</option>
	                  <option>Web Designer</option>
	                  <option>Android Developer</option>
	                  <option>Ios Developer</option>
	               </select>

	            </div>
	         </div>
	         <div class="col-sm-6 col-md-3">
	            <div class="d-grid">
	               <a href="#" class="btn btn-success w-100"> Search </a>
	            </div>
	         </div>
	      </div>
	      <div class="row staff-grid-row">
	         <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
	            <div class="profile-widget">
	               <div class="profile-img">
	                  <a href="profile.php" class="avatar"><img src="<?php echo url_for('assets/img/profiles/avatar-02.jpg') ?>" alt=""></a>
	               </div>
	               <div class="dropdown profile-action">
	                  <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
	                  <div class="dropdown-menu dropdown-menu-right">
	                     <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
	                     <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
	                  </div>
	               </div>
	               <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.php">John Doe</a></h4>
	               <div class="small text-muted">Web Designer</div>
	            </div>
	         </div>
	         <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
	            <div class="profile-widget">
	               <div class="profile-img">
	                  <a href="profile.php" class="avatar"><img src="<?php echo url_for('assets/img/profiles/avatar-09.jpg') ?>" alt=""></a>
	               </div>
	               <div class="dropdown profile-action">
	                  <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
	                  <div class="dropdown-menu dropdown-menu-right">
	                     <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
	                     <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
	                  </div>
	               </div>
	               <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.php">Richard Miles</a></h4>
	               <div class="small text-muted">Web Developer</div>
	            </div>
	         </div>
	         
	      </div>
	   </div>
	   <div id="add_employee" class="modal custom-modal fade" role="dialog">
	      <div class="modal-dialog modal-dialog-centered modal-lg">
	         <div class="modal-content">
	            <div class="modal-header">
	               <h5 class="modal-title">Add Employee</h5>
	               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
	               <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	               <form>
	                  <div class="row">
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">First Name <span class="text-danger">*</span></label>
	                           <input class="form-control" type="text">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Last Name</label>
	                           <input class="form-control" type="text">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Username <span class="text-danger">*</span></label>
	                           <input class="form-control" type="text">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Email <span class="text-danger">*</span></label>
	                           <input class="form-control" type="email">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Password</label>
	                           <input class="form-control" type="password">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Confirm Password</label>
	                           <input class="form-control" type="password">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
	                           <input type="text" class="form-control">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
	                           <div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Phone </label>
	                           <input class="form-control" type="text">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Company</label>
	                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-4-9qie" tabindex="-1" aria-hidden="true">
	                              <option value="" data-select2-id="select2-data-6-bmj8">Global Technologies</option>
	                              <option value="1">Delta Infotech</option>
	                           </select>
	                           
	                        </div>
	                     </div>
	                     <div class="col-md-6">
	                        <div class="form-group">
	                           <label>Department <span class="text-danger">*</span></label>
	                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-7-my28" tabindex="-1" aria-hidden="true">
	                              <option data-select2-id="select2-data-9-onlm">Select Department</option>
	                              <option>Web Development</option>
	                              <option>IT Management</option>
	                              <option>Marketing</option>
	                           </select>
	                           
	                        </div>
	                     </div>
	                     <div class="col-md-6">
	                        <div class="form-group">
	                           <label>Designation <span class="text-danger">*</span></label>
	                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-10-7q2a" tabindex="-1" aria-hidden="true">
	                              <option data-select2-id="select2-data-12-pslm">Select Designation</option>
	                              <option>Web Designer</option>
	                              <option>Web Developer</option>
	                              <option>Android Developer</option>
	                           </select>
	                           
	                        </div>
	                     </div>
	                  </div>
	                  <div class="table-responsive m-t-15">
	                     <table class="table table-striped custom-table">
	                        <thead>
	                           <tr>
	                              <th>Module Permission</th>
	                              <th class="text-center">Read</th>
	                              <th class="text-center">Write</th>
	                              <th class="text-center">Create</th>
	                              <th class="text-center">Delete</th>
	                              <th class="text-center">Import</th>
	                              <th class="text-center">Export</th>
	                           </tr>
	                        </thead>
	                        <tbody>
	                           <tr>
	                              <td>Holidays</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Leaves</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Clients</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Projects</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Tasks</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Chats</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Assets</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Timing Sheets</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                        </tbody>
	                     </table>
	                  </div>
	                  <div class="submit-section">
	                     <button class="btn btn-primary submit-btn">Submit</button>
	                  </div>
	               </form>
	            </div>
	         </div>
	      </div>
	   </div>
	   <div id="edit_employee" class="modal custom-modal fade" role="dialog">
	      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	         <div class="modal-content">
	            <div class="modal-header">
	               <h5 class="modal-title">Edit Employee</h5>
	               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
	               <span aria-hidden="true">×</span>
	               </button>
	            </div>
	            <div class="modal-body">
	               <form>
	                  <div class="row">
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">First Name <span class="text-danger">*</span></label>
	                           <input class="form-control" value="John" type="text">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Last Name</label>
	                           <input class="form-control" value="Doe" type="text">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Username <span class="text-danger">*</span></label>
	                           <input class="form-control" value="johndoe" type="text">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Email <span class="text-danger">*</span></label>
	                           <input class="form-control" value="johndoe@example.com" type="email">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Password</label>
	                           <input class="form-control" value="johndoe" type="password">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Confirm Password</label>
	                           <input class="form-control" value="johndoe" type="password">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
	                           <input type="text" value="FT-0001" readonly="" class="form-control floating">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
	                           <div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Phone </label>
	                           <input class="form-control" value="9876543210" type="text">
	                        </div>
	                     </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                           <label class="col-form-label">Company</label>
	                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-13-ube9" tabindex="-1" aria-hidden="true">
	                              <option>Global Technologies</option>
	                              <option>Delta Infotech</option>
	                              <option selected="" data-select2-id="select2-data-15-4xpx">International Software Inc</option>
	                           </select>
	                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-14-hacw" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-4pm0-container" aria-controls="select2-4pm0-container"><span class="select2-selection__rendered" id="select2-4pm0-container" role="textbox" aria-readonly="true" title="International Software Inc">International Software Inc</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
	                        </div>
	                     </div>
	                     <div class="col-md-6">
	                        <div class="form-group">
	                           <label>Department <span class="text-danger">*</span></label>
	                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-16-kit5" tabindex="-1" aria-hidden="true">
	                              <option data-select2-id="select2-data-18-4bh4">Select Department</option>
	                              <option>Web Development</option>
	                              <option>IT Management</option>
	                              <option>Marketing</option>
	                           </select>
	                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-17-jk97" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-vp34-container" aria-controls="select2-vp34-container"><span class="select2-selection__rendered" id="select2-vp34-container" role="textbox" aria-readonly="true" title="Select Department">Select Department</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
	                        </div>
	                     </div>
	                     <div class="col-md-6">
	                        <div class="form-group">
	                           <label>Designation <span class="text-danger">*</span></label>
	                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-19-bqdc" tabindex="-1" aria-hidden="true">
	                              <option data-select2-id="select2-data-21-02w9">Select Designation</option>
	                              <option>Web Designer</option>
	                              <option>Web Developer</option>
	                              <option>Android Developer</option>
	                           </select>
	                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-20-uxyx" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-9dfe-container" aria-controls="select2-9dfe-container"><span class="select2-selection__rendered" id="select2-9dfe-container" role="textbox" aria-readonly="true" title="Select Designation">Select Designation</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
	                        </div>
	                     </div>
	                  </div>
	                  <div class="table-responsive m-t-15">
	                     <table class="table table-striped custom-table">
	                        <thead>
	                           <tr>
	                              <th>Module Permission</th>
	                              <th class="text-center">Read</th>
	                              <th class="text-center">Write</th>
	                              <th class="text-center">Create</th>
	                              <th class="text-center">Delete</th>
	                              <th class="text-center">Import</th>
	                              <th class="text-center">Export</th>
	                           </tr>
	                        </thead>
	                        <tbody>
	                           <tr>
	                              <td>Holidays</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Leaves</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Clients</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Projects</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Tasks</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Chats</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Assets</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                           <tr>
	                              <td>Timing Sheets</td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input checked="" type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                              <td class="text-center">
	                                 <input type="checkbox">
	                              </td>
	                           </tr>
	                        </tbody>
	                     </table>
	                  </div>
	                  <div class="submit-section">
	                     <button class="btn btn-primary submit-btn">Save</button>
	                  </div>
	               </form>
	            </div>
	         </div>
	      </div>
	   </div>
	   <div class="modal custom-modal fade" id="delete_employee" role="dialog">
	      <div class="modal-dialog modal-dialog-centered">
	         <div class="modal-content">
	            <div class="modal-body">
	               <div class="form-header">
	                  <h3>Delete Employee</h3>
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
