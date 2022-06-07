<?php require_once('../private/initialize.php');
$permissions = AccessControl::PERMISSION;

?>

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