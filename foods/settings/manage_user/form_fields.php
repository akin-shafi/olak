<?php require_once('../../private/initialize.php');
$company = Company::find_by_id($loggedInAdmin->company_id);
$companyId = isset($company->id) ? $company->id : '1';
$branches = Branch::find_all_branch(['company_id' => $companyId]);
$permissions = AccessControl::PERMISSION;
?>


<form id="user_form" enctype="multipart/form-data">
  <input type="hidden" name="user[created_by]" value="<?php echo $loggedInAdmin->id ?>" readonly>
  <div class="modal-body">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <label for="fName" class="col-form-label">Full Name</label>
          <input type="text" class="form-control" name="user[full_name]" id="fName" placeholder="Full name">
        </div>

        <?php if ($loggedInAdmin->admin_level == 1) : ?>
          <div class="col-md-6">
            <label for="aLevel" class="col-form-label">Admin Level</label>
            <select name="user[admin_level]" class="form-control" id="aLevel" required>
              <option value="">select level</option>
              <?php foreach (Admin::ADMIN_LEVEL as $key => $data) : ?>
                <option value="<?php echo $key ?>"><?php echo $data ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        <?php endif; ?>

        <div class="col-md-12 mt-4 mb-3">
          <h5 class="mb-3 text-secondary">Assign Permission</h5>
          <div class="container">
            <div class="row shadow pt-3">
              <?php foreach ($permissions as $permit) :
                $exp = explode('_', $permit);
                $imp = implode(' ', $exp);
                $fullProp = ucwords($imp);

              ?>
                <div class="col-md-3">
                  <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input permit" name="permit[<?php echo $permit; ?>]" id="<?php echo $permit; ?>">
                    <label class="custom-control-label" for="<?php echo $permit; ?>"><?php echo $fullProp; ?></label>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <label for="cName" class="col-form-label">Company Name</label>
          <input type="text" class="form-control" id="cName" value="<?php echo isset($company->name) ? $company->name : 'Not set' ?>" disabled>
        </div>
        <div class="col-md-4">
          <label for="regNo" class="col-form-label">Branch</label>
          <select name="user[branch_id]" class="form-control" id="bId" required>
            <option value="">select branch</option>
            <?php foreach ($branches as $data) : ?>
              <option value="<?php echo $data->id ?>"><?php echo ucwords($data->name) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label for="email" class="col-form-label">Email</label>
          <input type="email" class="form-control" name="user[email]" id="email" placeholder="Email" required>
        </div>
        <div class="col-md-4">
          <label for="phone" class="col-form-label">Phone</label>
          <input type="tel" class="form-control" name="user[phone]" id="phone" placeholder="Phone number" required>
        </div>
        <div class="col-md-4">
          <label for="password" class="col-form-label">Password</label>
          <input type="password" class="form-control" name="user[password]" id="password" placeholder="********">
        </div>
        <div class="col-md-4">
          <label for="cPass" class="col-form-label">Confirm password</label>
          <input type="password" class="form-control" name="user[confirm_password]" id="cPass" placeholder="********">
        </div>
        <div class="col-md-12">
          <label for="address" class="col-form-label">Address</label>
          <textarea name="user[address]" id="address" class="form-control" placeholder="Contact address" rows="2"></textarea>
        </div>
        <div class="col-md-6 m-auto">
          <label for="avatar" class="col-form-label">Profile Image</label>
          <input type="file" class="form-control" name="profile" id="avatar">
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>