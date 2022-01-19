    <div id="department_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="department-title">Add Department</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add_department_form">
              <input type="hidden" name="departmentId" id="departmentId" readonly>
              <div class="form-group">
                <label>Department Name <span class="text-danger">*</span></label>
                <input class="form-control" name="department[department_name]" id="dept_name" type="text">
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" id="add_department_btn">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="designation_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="designation-title">Add Designation</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add_designation_form">
              <input type="hidden" name="designationId" id="designationId" readonly>
              <div class="form-group">
                <label>Job Title <span class="text-danger">*</span></label>
                <input class="form-control" name="designation[designation_name]" id="des_name" type="text">
              </div>
              <div class="form-group d-none">
                <label>Department <span class="text-danger">*</span></label>
                <select class="form-control" name="designation[department_id]" id="dept_id">
                  <option value="">Select Department</option>
                  <?php foreach (Department::find_by_undeleted() as $dept) : ?>
                    <option value="<?php echo $dept->id ?>">
                      <?php echo ucwords($dept->department_name) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" id="add_designation_btn">Submit</button>
              </div>
            </form>
          </div>
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

    <div id="company_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="company-title">Add Company</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add_company_form">
              <input type="hidden" name="companyId" id="companyId" readonly>
              <div class="form-group">
                <label>Company <span class="text-danger">*</span></label>
                <div class="row">
                  <div class="col-md-8">
                    <input class="form-control" name="company[company_name]" id="comp_name" type="text" placeholder="Company Name">
                  </div>
                  <div class="col-md-4">
                    <input class="form-control" name="company[company_label]" id="comp_label" type="text" placeholder="Company Label">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Registration Number <span class="text-danger">*</span></label>
                <input class="form-control" name="company[registration_no]" id="comp_reg" type="text" placeholder="Registration Number">
              </div>
              <div class="form-group">
                <label>Company Logo</label><input class="form-control" name="logo" type="file">
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" id="add_company_btn">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="branch_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="branch-title">Add Branch</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add_branch_form" method="POST">
              <input type="hidden" name="branchId" id="branchId" readonly>
              <div class="form-group">
                <label>Company <span class="text-danger">*</span></label>
                <select name="branch[company_id]" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Company Name" required>
                  <option label="Company Name"></option>
                  <?php foreach (Company::find_by_undeleted() as $value) : ?>
                    <option value="<?php echo $value->id ?>"><?php echo ucwords($value->company_name) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Branch <span class="text-danger">*</span></label>
                <div class="row">
                  <div class="col-md-8">
                    <input class="form-control" name="branch[branch_name]" id="branch_name" type="text" placeholder="Branch Name">
                  </div>
                  <div class="col-md-4">
                    <input class="form-control" name="branch[branch_name]" id="branch_name" type="text" placeholder="Branch Label">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Address <span class="text-danger">*</span></label>
                <input class="form-control" name="branch[address]" id="branch_address" type="text" placeholder="Branch Address">
              </div>
              <div class="form-group">
                <label>State <span class="text-danger">*</span></label>
                <input class="form-control" name="branch[state]" id="branch_state" type="text" placeholder="Branch State">
              </div>
              <div class="form-group">
                <label>City <span class="text-danger">*</span></label>
                <input class="form-control" name="branch[city]" id="branch_city" type="text" placeholder="Branch City">
              </div>
              <div class="form-group">
                <label>Establishment Date <span class="text-danger">*</span></label>
                <input class="form-control" name="branch[established_id]" id="established_id" type="date">
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" id="add_branch_btn">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="employee_type_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eType-title">Add EMployee Type</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add_eType_form">
              <input type="hidden" name="eTypeId" id="eTypeId" readonly>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-8">
                    <label>Name <span class="text-danger">*</span></label>
                    <input class="form-control" name="eType[name]" id="e_name" type="text" placeholder="Employee Type">
                  </div>
                  <div class="col-md-4">
                    <label>Label <span class="text-danger">*</span></label>
                    <input class="form-control" name="eType[label]" id="e_label" type="text" placeholder="Employee Type Label">
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button class="btn btn-primary" id="add_e_type_btn">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>