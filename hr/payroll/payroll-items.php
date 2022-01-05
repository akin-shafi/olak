<?php 
	require_once('../private/initialize.php');

$page = 'Payroll';
$page_title = 'Payroll Items';
include(SHARED_PATH . '/admin_header.php'); 
?>
<div class="page-wrapper">
            <div class="content container-fluid">
               <div class="page-header">
                  <div class="row align-items-center">
                     <div class="col">
                        <h3 class="page-title">Payroll Items</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Payroll Items</li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="page-menu">
                  <div class="row">
                     <div class="col-sm-12">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                           <li class="nav-item">
                              <a class="nav-link active" data-bs-toggle="tab" href="#tab_additions">Additions</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-bs-toggle="tab" href="#tab_overtime">Overtime</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-bs-toggle="tab" href="#tab_deductions">Deductions</a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="tab-content">
                  <div class="tab-pane show active" id="tab_additions">
                     <div class="text-end mb-4 clearfix">
                        <button class="btn btn-primary add-btn" type="button" data-bs-toggle="modal" data-bs-target="#add_addition"><i class="fa fa-plus"></i> Add Addition</button>
                     </div>
                     <div class="payroll-table card">
                        <div class="table-responsive">
                           <table class="table table-hover table-radius">
                              <thead>
                                 <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Default/Unit Amount</th>
                                    <th class="text-end">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <th>Leave balance amount</th>
                                    <td>Monthly remuneration</td>
                                    <td>$5</td>
                                    <td class="text-end">
                                       <div class="dropdown dropdown-action">
                                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_addition"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_addition"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Arrears of salary</th>
                                    <td>Additional remuneration</td>
                                    <td>$8</td>
                                    <td class="text-end">
                                       <div class="dropdown dropdown-action">
                                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_addition"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_addition"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Gratuity</th>
                                    <td>Monthly remuneration</td>
                                    <td>$20</td>
                                    <td class="text-end">
                                       <div class="dropdown dropdown-action">
                                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_addition"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_addition"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab_overtime">
                     <div class="text-end mb-4 clearfix">
                        <button class="btn btn-primary add-btn" type="button" data-bs-toggle="modal" data-bs-target="#add_overtime"><i class="fa fa-plus"></i> Add Overtime</button>
                     </div>
                     <div class="payroll-table card">
                        <div class="table-responsive">
                           <table class="table table-hover table-radius">
                              <thead>
                                 <tr>
                                    <th>Name</th>
                                    <th>Rate</th>
                                    <th class="text-end">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <th>Normal day OT 1.5x</th>
                                    <td>Hourly 1.5</td>
                                    <td class="text-end">
                                       <div class="dropdown dropdown-action">
                                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_overtime"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_overtime"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Public holiday OT 3.0x</th>
                                    <td>Hourly 3</td>
                                    <td class="text-end">
                                       <div class="dropdown dropdown-action">
                                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_overtime"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_overtime"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Rest day OT 2.0x</th>
                                    <td>Hourly 2</td>
                                    <td class="text-end">
                                       <div class="dropdown dropdown-action">
                                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_overtime"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_overtime"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab_deductions">
                     <div class="text-end mb-4 clearfix">
                        <button class="btn btn-primary add-btn" type="button" data-bs-toggle="modal" data-bs-target="#add_deduction"><i class="fa fa-plus"></i> Add Deduction</button>
                     </div>
                     <div class="payroll-table card">
                        <div class="table-responsive">
                           <table class="table table-hover table-radius">
                              <thead>
                                 <tr>
                                    <th>Name</th>
                                    <th>Default/Unit Amount</th>
                                    <th class="text-end">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <th>Absent amount</th>
                                    <td>$12</td>
                                    <td class="text-end">
                                       <div class="dropdown dropdown-action">
                                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_deduction"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_deduction"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Advance</th>
                                    <td>$7</td>
                                    <td class="text-end">
                                       <div class="dropdown dropdown-action">
                                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_deduction"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_deduction"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Unpaid leave</th>
                                    <td>$3</td>
                                    <td class="text-end">
                                       <div class="dropdown dropdown-action">
                                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_deduction"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_deduction"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
            </div>
            <div id="add_addition" class="modal custom-modal fade" role="dialog">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Add Addition</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form>
                           <div class="form-group">
                              <label>Name <span class="text-danger">*</span></label>
                              <input class="form-control" type="text">
                           </div>
                           <div class="form-group">
                              <label>Category <span class="text-danger">*</span></label>
                              <select class="select">
                                 <option>Select a category</option>
                                 <option>Monthly remuneration</option>
                                 <option>Additional remuneration</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="d-block">Unit calculation</label>
                              <div class="status-toggle">
                                 <input type="checkbox" id="unit_calculation" class="check">
                                 <label for="unit_calculation" class="checktoggle">checkbox</label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Unit Amount</label>
                              <div class="input-group">
                                 <span class="input-group-text">$</span>
                                 <input type="text" class="form-control">
                                 <span class="input-group-text">.00</span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="d-block">Assignee</label>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="addition_assignee" id="addition_no_emp" value="option1" checked>
                                 <label class="form-check-label" for="addition_no_emp">
                                 No assignee
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="addition_assignee" id="addition_all_emp" value="option2">
                                 <label class="form-check-label" for="addition_all_emp">
                                 All employees
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="addition_assignee" id="addition_single_emp" value="option3">
                                 <label class="form-check-label" for="addition_single_emp">
                                 Select Employee
                                 </label>
                              </div>
                              <div class="form-group">
                                 <select class="select">
                                    <option>-</option>
                                    <option>Select All</option>
                                    <option>John Doe</option>
                                    <option>Richard Miles</option>
                                 </select>
                              </div>
                           </div>
                           <div class="submit-section">
                              <button class="btn btn-primary submit-btn">Submit</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div id="edit_addition" class="modal custom-modal fade" role="dialog">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Edit Addition</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form>
                           <div class="form-group">
                              <label>Name <span class="text-danger">*</span></label>
                              <input class="form-control" type="text">
                           </div>
                           <div class="form-group">
                              <label>Category <span class="text-danger">*</span></label>
                              <select class="select">
                                 <option>Select a category</option>
                                 <option>Monthly remuneration</option>
                                 <option>Additional remuneration</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="d-block">Unit calculation</label>
                              <div class="status-toggle">
                                 <input type="checkbox" id="edit_unit_calculation" class="check">
                                 <label for="edit_unit_calculation" class="checktoggle">checkbox</label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Unit Amount</label>
                              <div class="input-group">
                                 <span class="input-group-text">$</span>
                                 <input type="text" class="form-control">
                                 <span class="input-group-text">.00</span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="d-block">Assignee</label>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="edit_addition_assignee" id="edit_addition_no_emp" value="option1" checked>
                                 <label class="form-check-label" for="edit_addition_no_emp">
                                 No assignee
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="edit_addition_assignee" id="edit_addition_all_emp" value="option2">
                                 <label class="form-check-label" for="edit_addition_all_emp">
                                 All employees
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="edit_addition_assignee" id="edit_addition_single_emp" value="option3">
                                 <label class="form-check-label" for="edit_addition_single_emp">
                                 Select Employee
                                 </label>
                              </div>
                              <div class="form-group">
                                 <select class="select">
                                    <option>-</option>
                                    <option>Select All</option>
                                    <option>John Doe</option>
                                    <option>Richard Miles</option>
                                 </select>
                              </div>
                           </div>
                           <div class="submit-section">
                              <button class="btn btn-primary submit-btn">Save</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal custom-modal fade" id="delete_addition" role="dialog">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                     <div class="modal-body">
                        <div class="form-header">
                           <h3>Delete Addition</h3>
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
            <div id="add_overtime" class="modal custom-modal fade" role="dialog">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Add Overtime</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form>
                           <div class="form-group">
                              <label>Name <span class="text-danger">*</span></label>
                              <input class="form-control" type="text">
                           </div>
                           <div class="form-group">
                              <label>Rate Type <span class="text-danger">*</span></label>
                              <select class="select">
                                 <option>-</option>
                                 <option>Daily Rate</option>
                                 <option>Hourly Rate</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label>Rate <span class="text-danger">*</span></label>
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
            <div id="edit_overtime" class="modal custom-modal fade" role="dialog">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Edit Overtime</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form>
                           <div class="form-group">
                              <label>Name <span class="text-danger">*</span></label>
                              <input class="form-control" type="text">
                           </div>
                           <div class="form-group">
                              <label>Rate Type <span class="text-danger">*</span></label>
                              <select class="select">
                                 <option>-</option>
                                 <option>Daily Rate</option>
                                 <option>Hourly Rate</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label>Rate <span class="text-danger">*</span></label>
                              <input class="form-control" type="text">
                           </div>
                           <div class="submit-section">
                              <button class="btn btn-primary submit-btn">Save</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal custom-modal fade" id="delete_overtime" role="dialog">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                     <div class="modal-body">
                        <div class="form-header">
                           <h3>Delete Overtime</h3>
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
            <div id="add_deduction" class="modal custom-modal fade" role="dialog">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Add Deduction</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form>
                           <div class="form-group">
                              <label>Name <span class="text-danger">*</span></label>
                              <input class="form-control" type="text">
                           </div>
                           <div class="form-group">
                              <label class="d-block">Unit calculation</label>
                              <div class="status-toggle">
                                 <input type="checkbox" id="unit_calculation_deduction" class="check">
                                 <label for="unit_calculation_deduction" class="checktoggle">checkbox</label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Unit Amount</label>
                              <div class="input-group">
                                 <span class="input-group-text">$</span>
                                 <input type="text" class="form-control">
                                 <span class="input-group-text">.00</span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="d-block">Assignee</label>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="deduction_assignee" id="deduction_no_emp" value="option1" checked>
                                 <label class="form-check-label" for="deduction_no_emp">
                                 No assignee
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="deduction_assignee" id="deduction_all_emp" value="option2">
                                 <label class="form-check-label" for="deduction_all_emp">
                                 All employees
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="deduction_assignee" id="deduction_single_emp" value="option3">
                                 <label class="form-check-label" for="deduction_single_emp">
                                 Select Employee
                                 </label>
                              </div>
                              <div class="form-group">
                                 <select class="select">
                                    <option>-</option>
                                    <option>Select All</option>
                                    <option>John Doe</option>
                                    <option>Richard Miles</option>
                                 </select>
                              </div>
                           </div>
                           <div class="submit-section">
                              <button class="btn btn-primary submit-btn">Submit</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div id="edit_deduction" class="modal custom-modal fade" role="dialog">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Edit Deduction</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form>
                           <div class="form-group">
                              <label>Name <span class="text-danger">*</span></label>
                              <input class="form-control" type="text">
                           </div>
                           <div class="form-group">
                              <label class="d-block">Unit calculation</label>
                              <div class="status-toggle">
                                 <input type="checkbox" id="edit_unit_calculation_deduction" class="check">
                                 <label for="edit_unit_calculation_deduction" class="checktoggle">checkbox</label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Unit Amount</label>
                              <div class="input-group">
                                 <span class="input-group-text">$</span>
                                 <input type="text" class="form-control">
                                 <span class="input-group-text">.00</span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="d-block">Assignee</label>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="edit_deduction_assignee" id="edit_deduction_no_emp" value="option1" checked>
                                 <label class="form-check-label" for="edit_deduction_no_emp">
                                 No assignee
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="edit_deduction_assignee" id="edit_deduction_all_emp" value="option2">
                                 <label class="form-check-label" for="edit_deduction_all_emp">
                                 All employees
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="edit_deduction_assignee" id="edit_deduction_single_emp" value="option3">
                                 <label class="form-check-label" for="edit_deduction_single_emp">
                                 Select Employee
                                 </label>
                              </div>
                              <div class="form-group">
                                 <select class="select">
                                    <option>-</option>
                                    <option>Select All</option>
                                    <option>John Doe</option>
                                    <option>Richard Miles</option>
                                 </select>
                              </div>
                           </div>
                           <div class="submit-section">
                              <button class="btn btn-primary submit-btn">Save</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal custom-modal fade" id="delete_deduction" role="dialog">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                     <div class="modal-body">
                        <div class="form-header">
                           <h3>Delete Deduction</h3>
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