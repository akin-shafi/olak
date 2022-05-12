<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if (!isset($admin)) {
  // redirect_to(url_for('/staff/admins/index.php'));
}
$company_id = 1;
?>

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
    <!-- <input class="form-control" type="text" name="admin[admin_level]" value="<?php //echo h($admin->admin_level); ?>"> -->
     <select name="admin[admin_level]" id="admin_level" class="form-control">
        <option value="">Select Admin level</option>
        <?php if ($loggedInAdmin->id == 1) { ?>
          <?php foreach (Admin::ADMIN_LEVEL as $key => $value) { ?>
            <option value="<?php echo $key; ?>" <?php echo $key == $admin->admin_level ? 'selected' : '' ?>><?php echo $value; ?></option>
          <?php } ?>
        <?php }elseif($loggedInAdmin->id == 2){ ?>
          
            <?php foreach (Admin::ADMIN_LEVEL as $key => $value) { ?>
              <?php if ( $loggedInAdmin->admin_level == !in_array($key, [1])) { ?>
              <option value="<?php echo $key; ?>" <?php echo $key == $admin->admin_level ? 'selected' : '' ?>><?php echo $value; ?></option>
              <?php } ?>
            <?php } ?>
          
        <?php }else{ ?>
          <?php foreach (Admin::ADMIN_LEVEL as $key => $value) { ?>
              <?php if ( $loggedInAdmin->admin_level == !in_array($key, [1,2])) { ?>
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
    
    <select name="admin[company_id]" class="form-control" id="company_id" required>
      <option value="">Company Name</option>
      <?php foreach (Company::find_by_undeleted() as $value) : ?>
        <option value="<?php echo $value->id ?>" <?php echo $value->id == $company_id ? 'selected' : '' ?>><?php echo ucwords($value->company_name) ?></option>
      <?php endforeach; ?>
    </select>

  </div>
</div>

<div class="form-group row">
  <label class="col-lg-3 col-form-label form-control-label text-right">Branch</label>
  <div class="col-lg-9">

    <select name="admin[branch_id]" class="form-control" id="branch_id" required>
      <option value="">Branch Name</option>
      <?php foreach (Branch::find_by_undeleted() as $value) : ?>
        <option value="<?php echo $value->id ?>" <?php echo $value->id == $admin->branch_id ? 'selected' : '' ?>><?php echo ucwords($value->branch_name) ?></option>
      <?php endforeach; ?>
    </select>

  </div>
</div>



