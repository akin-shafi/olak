<div id="employee_modal" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="employee-title">Add Employee</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="showAlert"></div>

        <form id="add_employee_form">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                <input class="form-control" name="employee[first_name]" id="first_name" type="text">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-form-label">Last Name</label>
                <input class="form-control" name="employee[last_name]" id="last_name" type="text">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                <input class="form-control" name="employee[email]" id="email" type="email">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="col-form-label">Password</label>
                <input class="form-control" name="employee[password]" id="password" type="password">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="col-form-label">Confirm Password</label>
                <input class="form-control" name="employee[confirm_password]" id="confirm_password" type="password">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="employee[employee_id]" id="employee_id">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                <input class="form-control" name="employee[date_employed]" id="date_employed" type="date">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="col-form-label">Phone </label>
                <input class="form-control" name="employee[phone]" id="phone" type="text">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Department <span class="text-danger">*</span></label>
                <select class="select" name="employee[department_id]" id="department_id">
                  <option value="">Select Department</option>
                  <?php foreach (Department::find_by_undeleted() as $department) : ?>
                    <option value="<?php echo $department->id ?>">
                      <?php echo ucwords($department->department_name) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Designation <span class="text-danger">*</span></label>
                <select class="select" name="employee[designation_id]" id="designation_id">
                  <option value="">Select Designation</option>
                  <?php foreach (Designation::find_by_undeleted() as $designation) : ?>
                    <option value="<?php echo $designation->id ?>">
                      <?php echo ucwords($designation->designation_name) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Employment Type <span class="text-danger">*</span></label>
                <select class="select" name="employee[employment_type]" id="employment_type">
                  <option value="">Select Type</option>
                  <?php foreach (Employee::EMPLOYMENT_TYPE as $key => $employment) : ?>
                    <option value="<?php echo $key ?>">
                      <?php echo ucwords($employment) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-md-6 m-auto">
              <div class="form-group">
                <label class="col-form-label">Profile Image </label>
                <input type="file" name="profile_image" class="form-control" id="profile_image">
              </div>
            </div>

          </div>

          <div class="table-responsive m-t-15 d-none">
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

              </tbody>
            </table>
          </div>

          <div class="submit-section">
            <button class="btn btn-primary submit-btn" id="add_employee_btn">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>