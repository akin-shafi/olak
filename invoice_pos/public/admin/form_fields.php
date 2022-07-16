<?php

$company_id = 1;
$permissions = AccessControl::PERMISSION;
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label text-right">First Name</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="admin[first_name]" value="<?php echo h($admin->first_name); ?>">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label text-right">Last name</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="admin[last_name]" value="<?php echo h($admin->last_name); ?>">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label text-right"> Phone Number</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="admin[phone]" value="<?php echo h($admin->phone); ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label text-right">Email</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="admin[email]" value="<?php echo h($admin->email); ?>">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label text-right">Admin Level</label>
        <div class="col-lg-9">
          <select name="admin[admin_level]" id="admin_level" class="form-control">
            <option value="">Select Admin level</option>
            <?php if ($loggedInAdmin->id == 1) { ?>
              <?php foreach (Admin::ADMIN_LEVEL as $key => $value) { ?>
                <option value="<?php echo $key; ?>" <?php echo $key == $admin->admin_level ? 'selected' : '' ?>><?php echo $value; ?></option>
              <?php } ?>
            <?php } elseif ($loggedInAdmin->id == 2) { ?>

              <?php foreach (Admin::ADMIN_LEVEL as $key => $value) { ?>
                <?php if ($loggedInAdmin->admin_level == !in_array($key, [1])) { ?>
                  <option value="<?php echo $key; ?>" <?php echo $key == $admin->admin_level ? 'selected' : '' ?>><?php echo $value; ?></option>
                <?php } ?>
              <?php } ?>

            <?php } else { ?>
              <?php foreach (Admin::ADMIN_LEVEL as $key => $value) { ?>
                <?php if ($loggedInAdmin->admin_level == !in_array($key, [1, 2])) { ?>
                  <option value="<?php echo $key; ?>" <?php echo $key == $admin->admin_level ? 'selected' : '' ?>><?php echo $value; ?></option>
                <?php } ?>
              <?php } ?>
            <?php } ?>


          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label text-right">Password</label>
        <div class="col-lg-9">
          <input class="form-control" type="password" name="admin[password]" value="<?php echo h($admin->password); ?>">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label text-right">Confirm Password</label>
        <div class="col-lg-9">
          <input class="form-control" type="password" name="admin[confirm_password]">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label text-right">Company</label>
        <div class="col-lg-9">

          <input type="hidden" name="admin[company_id]" class="form-control" value="<?php echo $company_id ?>" id="company_id" />

          <select class="form-control" disabled>
            <?php foreach (Company::find_by_undeleted() as $value) : ?>
              <option value="<?php echo $value->id ?>" <?php echo $value->id == $company_id ? 'selected' : '' ?>><?php echo ucwords($value->company_name) ?></option>
            <?php endforeach; ?>
          </select>

        </div>
      </div>

      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label text-right">Branch</label>
        <div class="col-lg-9">

          <?php //if ($admin->admin_level == 1) : 
          ?>
          <select name="admin[branch_id]" class="form-control" id="branch_id" required>
            <option value="">Branch Name</option>
            <?php foreach (Branch::find_by_undeleted() as $value) : ?>
              <option value="<?php echo $value->id ?>" <?php echo $value->id == $admin->branch_id ? 'selected' : '' ?>><?php echo ucwords($value->branch_name) ?></option>
            <?php endforeach; ?>
          </select>
          <?php //endif; 
          ?>

        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="container">
        <h5 class="mb-3 text-secondary">Permission Management</h5>
        <div class="row p-3">
          <?php foreach ($permissions as $permit) :
            $exp = explode('_', $permit);
            $imp = implode(' ', $exp);
            $fullProp = ucwords($imp);
            if (isset($id)) {
              $access = AccessControl::find_by_user_id($id);
            }
          ?>
            <?php if (isset($access->id)) : ?>
              <div class="d-flex justify-content-between align-items-center" style="min-width: 150px;">
                <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input permit" name="permit[<?php echo $permit; ?>]" id="<?php echo $permit; ?>" <?php echo $access->$permit == 1 ? 'checked' : ''; ?>>
                  <label class="custom-control-label" for="<?php echo $permit; ?>"><?php echo $fullProp; ?></label>
                </div>
              </div>
            <?php else : ?>
              <div class="d-flex justify-content-between align-items-center" style="min-width: 150px;">
                <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input permit" name="permit[<?php echo $permit; ?>]" id="<?php echo $permit; ?>">
                  <label class="custom-control-label" for="<?php echo $permit; ?>"><?php echo $fullProp; ?></label>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>