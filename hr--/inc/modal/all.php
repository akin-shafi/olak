    <div id="department_modal" class="modal custom-modal fade select_modal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="department-title">Add Department</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form id="add_department_form" class="mb-0">
            <div class="modal-body">
              <input type="hidden" name="departmentId" id="departmentId" readonly>
              <div class="form-group">
                <label>Department Name <span class="text-danger">*</span></label>
                <input class="form-control" name="department[department_name]" id="dept_name" type="text">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="add_department_btn">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="designation_modal" class="modal custom-modal fade select_modal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="designation-title">Add Designation</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="add_designation_form" class="mb-0">
            <div class="modal-body">
              <input type="hidden" name="designationId" id="designationId" readonly>
              <div class="form-group">
                <label>Job Title <span class="text-danger">*</span></label>
                <input class="form-control" name="designation[designation_name]" id="des_name" type="text">
              </div>
              <div class="form-group ">
                <label>Company <span class="text-danger">*</span></label>
                <select class="form-control" name="designation[company_name]" id="company_name">
                  <option value="">Select Company</option>
                  <?php foreach (Company::find_by_undeleted() as $company) : ?>
                    <option value="<?php echo $company->company_name ?>">
                      <?php echo ucwords($company->company_name) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="add_designation_btn">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="clock_in_modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><span class="feather feather-clock  me-1"></span>Clock In</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
          </div>

          <form id="attendance_form">
            <input type="hidden" name="employeeId" value="<?php echo $loggedInAdmin->id; ?>" readonly>

            <div class="modal-body">
              <div class="countdowntimer"><span id="clocktimer" class="border-0 style size_md" style="background: transparent; color: rgb(49, 62, 106); border-color: transparent;">
                  <div id="clockDisplay" class="clock" onload="showTime()"></div>
                </span>
              </div>

              <div class="form-group">
                <label class="form-label">Note:</label>
                <textarea class="form-control" rows="3" name="attendance[note]"></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">
                <?php if (!$isClockedIn) : ?>
                  Clock In
                <?php else : ?>
                  Clock Out
                <?php endif; ?>
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>

    <div id="company_modal" class="modal custom-modal fade select_modal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="company-title">Add Company</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="add_company_form" class="mb-0">
            <div class="modal-body">
              <input type="hidden" name="companyId" id="companyId" readonly>
              <div class="form-group">
                <label>Company <span class="text-danger">*</span></label>
                <input class="form-control" name="company[company_name]" id="comp_name" type="text" placeholder="Company Name">
              </div>
              <div class="form-group">
                <label>Registration Number <span class="text-danger">*</span></label>
                <input class="form-control" name="company[registration_no]" id="comp_reg" type="text" placeholder="Registration Number">
              </div>
              <div class="form-group">
                <label>Company Logo</label><input class="form-control" name="logo" type="file">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="add_company_btn">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="branch_modal" class="modal custom-modal fade select_modal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="branch-title">Add Branch</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="add_branch_form" class="mb-0">
            <div class="modal-body">
              <input type="hidden" name="branchId" id="branchId" readonly>
              <div class="form-group">
                <label>Company <span class="text-danger">*</span></label>
                <select name="branch[company_id]" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Company Name" id="company_id" required>
                  <option label="Company Name"></option>
                  <?php foreach (Company::find_by_undeleted() as $value) : ?>
                    <option value="<?php echo $value->id ?>"><?php echo ucwords($value->company_name) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Branch <span class="text-danger">*</span></label>
                <input class="form-control" name="branch[branch_name]" id="branch_name" type="text" placeholder="Branch Name">
              </div>
              <div class="form-group">
                <label>Address <span class="text-danger">*</span></label>
                <input class="form-control" name="branch[address]" id="branch_address" type="text" placeholder="Branch Address">
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>State <span class="text-danger">*</span></label>
                    <input class="form-control" name="branch[state]" id="branch_state" type="text" placeholder="Branch State">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>City <span class="text-danger">*</span></label>
                    <input class="form-control" name="branch[city]" id="branch_city" type="text" placeholder="Branch City">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Establishment Date <span class="text-danger">*</span></label>
                <input class="form-control" name="branch[established_id]" id="established_id" type="date">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="add_branch_btn">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="employee_type_modal" class="modal custom-modal fade select_modal" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eType-title">Add Employee Type</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="add_eType_form" class="mb-0">
            <div class="modal-body">
              <input type="hidden" name="eTypeId" id="eTypeId" readonly>
              <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input class="form-control" name="eType[name]" id="e_name" type="text" placeholder="Employee Type">
              </div>

            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="add_e_type_btn">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="leave_type_modal" class="modal custom-modal fade select_modal" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="leave-title">Add Leave Type</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="add_leave_type_form" class="mb-0">
            <div class="modal-body">
              <input type="hidden" name="leaveId" id="leaveId" readonly>
              <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input class="form-control" name="leave[name]" id="leave_name" type="text" placeholder="Leave Type">
              </div>

              <div class="form-group">
                <label>Duration <span class="text-danger">*</span></label>
                <input class="form-control" name="leave[duration]" id="leave_duration" type="text" placeholder="Duration of leave">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="add_l_type_btn">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade select_leave" id="leave_modal" aria-hidden="true">
      <div class="modal-dialog" role="document" data-select2-id="select2-data-26-l5v6">
        <div class="modal-content" data-select2-id="select2-data-25-cvqx">
          <div class="modal-header">
            <h5 class="modal-title">Apply Leaves</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
          </div>
          <form id="add_leave_form">
            <div class="modal-body">
              <div class="leave-types" data-select2-id="select2-data-24-j2g1">
                <div class="form-group">
                  <label class="form-label">Employee Name</label>
                  <select name="leave[employee_id]" class="select2" data-placeholder="Select Employee">
                    <option label="select"></option>
                    <?php foreach (Employee::find_by_undeleted() as $employee) : ?>
                      <option value="<?php echo $employee->id ?>">
                        <?php echo ucwords($employee->full_name()) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label class="form-label">Leaves Types</label>
                  <select name="leave[leave_type]" class="select2" data-placeholder="Select Leave Type" id="select-leave">
                    <option label="select"></option>
                    <?php foreach (EmployeeLeaveType::find_by_undeleted() as $leaveType) : ?>
                      <option value="<?php echo $leaveType->id ?>">
                        <?php echo ucwords($leaveType->name) ?> (<?php echo ucwords($leaveType->duration) ?>)</option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="leave-content" id="multiple" style="display: block;">
                  <div class="form-group">
                    <label class="form-label">Leave Date Range:</label>
                    <div class="input-group">
                      <input type="text" name="daterange" class="form-control" placeholder="select dates">
                      <div class="input-group-append">
                        <div class="input-group-text"> <i class="bx bx-calendar"></i> </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group"> <label class="form-label">Reason:</label> <textarea name="leave[reason]" class="form-control" rows="5"></textarea> </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="ms-auto"> <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="loan_request_closed" class="modal custom-modal fade select_modal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loan-request-title">Loan Request</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="d-flex align-items-center">
              <span class="feather feather-alert-triangle fs-2 me-1 text-danger"></span>
              <h4 class="mb-0">Loan request closed for this month. Thank you!</h4>
            </div>
          </div>

          <div class="modal-footer">
            <button class="btn btn-primary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>