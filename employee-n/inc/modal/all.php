<div class="modal fade select_modal" id="reportmodal" style="display: none;" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Report</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
      <div class="modal-body">
        <div class="form-group"> <label class="form-label">Email Address</label> <input type="text" class="form-control" placeholder="hr@gmail.com" value="" readonly=""> </div>
        <div class="form-group"> <label class="form-label">Subject</label> <textarea class="form-control" rows="3">Some text here...</textarea> </div>
      </div>
      <div class="modal-footer"> <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a> <a href="#" class="btn btn-primary">Submit</a> </div>
    </div>
  </div>
</div>

<div class="modal fade select_modal" id="leave_modal" aria-hidden="true">
  <div class="modal-dialog" role="document" data-select2-id="select2-data-26-l5v6">
    <div class="modal-content" data-select2-id="select2-data-25-cvqx">
      <div class="modal-header">
        <h5 class="modal-title">Apply Leaves</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
      <form id="add_leave_form">
        <div class="modal-body">
          <div class="leave-types" data-select2-id="select2-data-24-j2g1">
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
            <div class="form-group">
              <label class="form-label">Leaves Types</label>
              <select name="leave[leave_type]" class="select2" data-placeholder="Select Leave Type" id="select-leave">
                <option label="select"></option>
                <?php foreach (EmployeeLeaveType::find_by_undeleted() as $leaveType) : ?>
                  <option value="<?php echo $leaveType->id ?>"><?php echo ucwords($leaveType->name) ?></option>
                <?php endforeach; ?>

              </select>
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