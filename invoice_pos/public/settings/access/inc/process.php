<?php require_once('../../../../private/initialize.php');

if (is_post_request()) {
  // *************** ACCESS CONTROL
  if (isset($_POST['edit_access'])) {
    $aId = $_POST['aId'];
    $req = $_POST['access'];
    $access = AccessControl::find_by_id($aId);

    $args = [
      'dashboard'             => isset($req['dashboard'])      ? 1 : 0,
      'product_mgt'           => isset($req['product_mgt'])    ? 1 : 0,
      'customer_mgt'          => isset($req['customer_mgt'])   ? 1 : 0,
      'wallet_mgt'            => isset($req['wallet_mgt'])     ? 1 : 0,
      'stock_mgt'             => isset($req['stock_mgt'])      ? 1 : 0,
      'settings_mgt'          => isset($req['settings_mgt'])   ? 1 : 0,
      'sales_mgt'             => isset($req['sales_mgt'])      ? 1 : 0,
      'special_sales'         => isset($req['special_sales'])  ? 1 : 0,
      'add_sales'             => isset($req['add_sales'])      ? 1 : 0,
      'edit_sales'            => isset($req['edit_sales'])     ? 1 : 0,
      'manage_sales'          => isset($req['manage_sales'])   ? 1 : 0,
      'expenses_mgt'          => isset($req['expenses_mgt'])   ? 1 : 0,
      'add_exp'               => isset($req['add_exp'])        ? 1 : 0,
      'edit_exp'              => isset($req['edit_exp'])       ? 1 : 0,
      'delete_exp'            => isset($req['delete_exp'])     ? 1 : 0,
      'report_mgt'            => isset($req['report_mgt'])     ? 1 : 0,
      'access_control'        => isset($req['access_control']) ? 1 : 0,
      'can_approve'           => isset($req['can_approve'])    ? 1 : 0,
      'company_setup'         => isset($req['company_setup'])  ? 1 : 0,
      'user_mgt'              => isset($req['user_mgt'])       ? 1 : 0,
      'filtering'             => isset($req['filtering'])      ? 1 : 0,
      'process_waybill'       => isset($req['process_waybill'])      ? 1 : 0,
    ];

    $access->merge_attributes($args);
    $access->save();

    if ($access == true) :
      exit(json_encode(['success' => true, 'msg' => 'Access control updated successfully!']));
    endif;
  }
}


if (is_get_request()) {
  if (isset($_GET['get_access'])) :
    $aId = $_GET['aId'];
    $permissions = AccessControl::PERMISSION;
    $admins = Admin::find_by_undeleted();
    $control = AccessControl::find_by_id($aId);
?>

    <div class="container">
      <div class="col-md-12">
        <div class="form-group">
          <div class="mb-3">
            <label for="staff" class="col-form-label">All Staff</label>
            <select class="form-control" name="access[user_id]" id="staff">
              <option value="">select staff</option>
              <?php foreach ($admins as $admin) : ?>
                <option value="<?php echo $admin->id ?>" <?php echo ($admin->id == $control->user_id) ? 'selected' : ''; ?>>
                  <?php echo ucwords($admin->full_name()) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>


      <div class="col-md-12 mt-4 mb-3">
        <h5 class="mb-3 text-secondary">Edit Permission</h5>
        <div class="row shadow pt-3">
          <?php foreach ($permissions as $permit) :
            $exp = explode('_', $permit);
            $imp = implode(' ', $exp);
            $fullProp = ucwords($imp);
            $access = AccessControl::find_by_id($aId);
          ?>
            <div class="col-md-3">
              <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input permit" name="access[<?php echo $permit; ?>]" id="<?php echo $permit; ?>" <?php echo $access->$permit == 1 ? 'checked' : ''; ?>>
                <label class="custom-control-label" for="<?php echo $permit; ?>"><?php echo $fullProp; ?></label>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>

<?php
  endif;
}
