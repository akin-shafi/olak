<div class="card">
  <div class="card-body">

    <div class="row">
      <div class="form-group col-md-6 col-sm-6 col-12">
        <input type="hidden" name="created_by" value="<?php echo $loggedInAdmin->id ?? ""; ?>" class="form-control">
        <input type="hidden" name="company_id" value="<?php echo $loggedInAdmin->company_id ?? ""; ?>" class="form-control">
        <input type="hidden" name="branch_id" value="<?php echo $loggedInAdmin->branch_id ?? ""; ?>" class="form-control">
        <input type="text" name="first_name" value="<?php echo $client->first_name ?? ""; ?>" class="form-control" id="first_name" placeholder="First Name">
      </div>
      <div class="form-group col-md-6 col-sm-6 col-12">
        <input type="text" name="last_name" value="<?php echo $client->last_name ?? ""; ?>" class="form-control" id="last_name" placeholder="Last Name">
      </div>
      <div class="form-group col-md-12 col-sm-12 col-12">
        <textarea name="address" class="form-control" id="address" placeholder="Address"><?php echo $client->address ?? ""; ?></textarea>
      </div>
      <div class="form-group col-md-4 col-sm-6 col-12">
        <input type="text" name="phone" value="<?php echo $client->phone ?? ""; ?>" class="form-control" id="phone" placeholder="Phone Number">
      </div>
      <div class="form-group col-md-4 col-sm-6 col-12">
        <input type="text" name="email" value="<?php echo $client->email ?? ""; ?>" class="form-control" id="email" placeholder="Email">
      </div>
      <?php if ($accessControl->can_approve == 1) { ?>
      <div class="form-group col-md-4 col-sm-6 col-12">
        <div class="custom-control custom-switch mt-2">
          <input type="checkbox" class="custom-control-input permit" name="credit_facility" id="credit">
          <label class="custom-control-label" for="credit">Credit Facility?</label>
        </div>
      </div>

      <div class="form-group col-md-4 col-sm-6 col-12">
        <div class="form-group">
          <label class="control-label" for="credit_capcity">Maximum Credit Capacity ?</label>
          <input type="number" class="form-control" id="credit_capcity" name="credit_capacity">
          
        </div>
      </div>

      <?php } ?>

      
      

    </div>
  </div>

  
</div>