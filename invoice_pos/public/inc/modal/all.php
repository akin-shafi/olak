

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

   