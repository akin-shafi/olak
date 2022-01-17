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
                <label>Designation Name <span class="text-danger">*</span></label>
                <input class="form-control" name="designation[designation_name]" id="des_name" type="text">
              </div>
              <div class="form-group">
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